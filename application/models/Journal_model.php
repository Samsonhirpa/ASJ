<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // -----------------------------------------------------------------
    //  NEW METHODS FOR HOMEPAGE & STATISTICS
    // -----------------------------------------------------------------

    /**
     * Get journal statistics: submissions, published, reviewers, acceptance rate
     */
    public function get_stats() {
        // Total submissions (all manuscripts, not deleted)
        $total_submissions = $this->db->where('isDeleted', 0)->count_all_results('tbl_manuscripts');

        // Published or accepted articles (publicly visible)
        $this->db->where('isDeleted', 0);
        $this->db->where_in('status', ['accepted', 'published']);
        $published = $this->db->count_all_results('tbl_manuscripts');

        // Active reviewers (roleId = 19)
        $reviewers = $this->db->where('roleId', 19)->where('isDeleted', 0)->count_all_results('tbl_users');

        // Acceptance rate
        $acceptance_rate = ($total_submissions > 0) ? round(($published / $total_submissions) * 100, 1) : 0;

        return [
            'submissions' => $total_submissions,
            'published'   => $published,
            'reviewers'   => $reviewers,
            'acceptance'  => $acceptance_rate
        ];
    }

    /**
     * Get featured articles (latest accepted/published manuscripts)
     * Used on homepage and for AJAX search fallback.
     *
     * @param int $limit
     * @return array
     */
    public function get_featured_articles($limit = 6) {
        $this->db->select('
            m.manuscriptId,
            m.manuscriptNumber,
            m.title,
            m.abstract,
            m.articleType,
            m.createdDtm,
            (SELECT GROUP_CONCAT(u.name SEPARATOR ", ")
             FROM tbl_manuscript_authors ma
             JOIN tbl_users u ON ma.userId = u.userId
             WHERE ma.manuscriptId = m.manuscriptId
             GROUP BY ma.manuscriptId) as author_names
        ');
        $this->db->from('tbl_manuscripts m');
        $this->db->where('m.isDeleted', 0);
        $this->db->where_in('m.status', ['accepted', 'published']);
        $this->db->order_by('m.createdDtm', 'DESC');
        $this->db->limit($limit);

        $query = $this->db->get();
        $articles = $query->result();

        // Attach volume/issue info (use latest issue as fallback)
        $latest_issue = $this->get_latest_issue();
        $default_volume = $latest_issue->volume ?? 10;
        $default_issueNumber = $latest_issue->issueNumber ?? 1;
        $default_year = $latest_issue->year ?? date('Y');

        foreach ($articles as $art) {
            $art->volume = $default_volume;
            $art->issueNumber = $default_issueNumber;
            $art->year = date('Y', strtotime($art->createdDtm));
            // If author_names is null, set placeholder
            if (empty($art->author_names)) {
                $art->author_names = 'OJAS Editorial';
            }
        }

        return $articles;
    }

    // -----------------------------------------------------------------
    //  MODIFIED EXISTING METHODS (backward compatible)
    // -----------------------------------------------------------------

    /**
     * Get published articles – now works even if tbl_published_articles is empty.
     * It returns manuscripts with status 'accepted' or 'published'.
     *
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function get_published_articles($limit = 10, $offset = 0) {
        // First try the original method (if there are records in tbl_published_articles)
        $this->db->select('
            pa.*, 
            m.title, 
            m.abstract, 
            m.keywords,
            m.manuscriptNumber,
            m.articleType,
            ji.volume,
            ji.issueNumber,
            ji.year as issue_year,
            GROUP_CONCAT(u.name SEPARATOR ", ") as author_names
        ');
        $this->db->from('tbl_published_articles pa');
        $this->db->join('tbl_manuscripts m', 'pa.manuscriptId = m.manuscriptId');
        $this->db->join('tbl_journal_issues ji', 'pa.issueId = ji.issueId');
        $this->db->join('tbl_manuscript_authors ma', 'm.manuscriptId = ma.manuscriptId');
        $this->db->join('tbl_users u', 'ma.userId = u.userId');
        $this->db->where('m.status', 'published');
        $this->db->group_by('pa.articleId');
        $this->db->order_by('pa.publishedDate', 'DESC');
        $this->db->limit($limit, $offset);

        $query = $this->db->get();
        $results = $query->result();

        // If no results from the joined table, fall back to manuscripts with status 'accepted'/'published'
        if (empty($results)) {
            return $this->get_featured_articles($limit);
        }

        return $results;
    }

    /**
     * Search articles – now searches across accepted/published manuscripts,
     * not relying on tbl_published_articles.
     *
     * @param string $keyword
     * @param array $filters (year, articleType, issueId)
     * @return array
     */
    public function search_articles($keyword, $filters = array()) {
        $this->db->select('
            m.manuscriptId as articleId,
            m.title,
            m.abstract,
            m.keywords,
            m.articleType,
            m.manuscriptNumber,
            m.createdDtm,
            (SELECT GROUP_CONCAT(u.name SEPARATOR ", ")
             FROM tbl_manuscript_authors ma
             JOIN tbl_users u ON ma.userId = u.userId
             WHERE ma.manuscriptId = m.manuscriptId
             GROUP BY ma.manuscriptId) as author_names
        ');
        $this->db->from('tbl_manuscripts m');
        $this->db->where('m.isDeleted', 0);
        $this->db->where_in('m.status', ['accepted', 'published']);

        // Keyword search across title, abstract, keywords, author names (via subquery)
        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('m.title', $keyword);
            $this->db->or_like('m.abstract', $keyword);
            $this->db->or_like('m.keywords', $keyword);
            // Search author names using EXISTS subquery
            $this->db->or_where("EXISTS (
                SELECT 1 FROM tbl_manuscript_authors ma2
                JOIN tbl_users u2 ON ma2.userId = u2.userId
                WHERE ma2.manuscriptId = m.manuscriptId AND u2.name LIKE '%" . $this->db->escape_like_str($keyword) . "%'
            )");
            $this->db->group_end();
        }

        // Apply filters
        if (!empty($filters['articleType'])) {
            $this->db->where('m.articleType', $filters['articleType']);
        }

        // Year filter: we need to get year from issue or created date. Use createdDtm as fallback.
        if (!empty($filters['year'])) {
            $this->db->where('YEAR(m.createdDtm)', $filters['year']);
        }

        // IssueId filter: if there is a relation via tbl_published_articles, join it.
        if (!empty($filters['issueId'])) {
            $this->db->join('tbl_published_articles pa', 'pa.manuscriptId = m.manuscriptId', 'left');
            $this->db->where('pa.issueId', $filters['issueId']);
        }

        $this->db->order_by('m.createdDtm', 'DESC');
        $this->db->limit(50); // safety limit

        $query = $this->db->get();
        $results = $query->result();

        // Attach volume/issue info (use latest issue as default, or try to fetch from tbl_published_articles if available)
        $latest_issue = $this->get_latest_issue();
        $default_volume = $latest_issue->volume ?? 10;
        $default_issueNumber = $latest_issue->issueNumber ?? 1;

        foreach ($results as $r) {
            // If we joined tbl_published_articles, we might have volume/issue there
            if (isset($r->volume) && isset($r->issueNumber)) {
                continue;
            }
            $r->volume = $default_volume;
            $r->issueNumber = $default_issueNumber;
            $r->year = date('Y', strtotime($r->createdDtm));
            if (empty($r->author_names)) {
                $r->author_names = 'OJAS Editorial';
            }
        }

        return $results;
    }

    // -----------------------------------------------------------------
    //  EXISTING METHODS (kept as is, with minor fixes)
    // -----------------------------------------------------------------

    /**
     * Get single published article (by articleId or DOI)
     * Works with tbl_published_articles – if empty, returns null.
     */
    public function get_published_article($identifier) {
        $this->db->select('
            pa.*, 
            m.*,
            ji.volume,
            ji.issueNumber,
            ji.year as issue_year,
            ji.month as issue_month
        ');
        $this->db->from('tbl_published_articles pa');
        $this->db->join('tbl_manuscripts m', 'pa.manuscriptId = m.manuscriptId');
        $this->db->join('tbl_journal_issues ji', 'pa.issueId = ji.issueId');
        
        if(is_numeric($identifier)) {
            $this->db->where('pa.articleId', $identifier);
        } else {
            $this->db->where('pa.doi', $identifier);
        }
        
        $query = $this->db->get();
        $article = $query->row();
        
        if($article) {
            // Get authors
            $this->db->select('u.*, ma.isCorresponding, ma.authorOrder');
            $this->db->from('tbl_manuscript_authors ma');
            $this->db->join('tbl_users u', 'ma.userId = u.userId');
            $this->db->where('ma.manuscriptId', $article->manuscriptId);
            $this->db->order_by('ma.authorOrder', 'ASC');
            $article->authors = $this->db->get()->result();
        }
        
        return $article;
    }
    
    /**
     * Get published manuscript detail by manuscript id
     */
    public function get_published_manuscript($manuscriptId) {
        $this->db->select('pa.articleId, pa.doi, pa.publishedDate, m.manuscriptId, m.title, m.abstract, m.keywords, m.articleType, m.manuscriptNumber, ji.volume, ji.issueNumber, ji.year as issue_year, ji.month as issue_month');
        $this->db->from('tbl_published_articles pa');
        $this->db->join('tbl_manuscripts m', 'pa.manuscriptId = m.manuscriptId');
        $this->db->join('tbl_journal_issues ji', 'pa.issueId = ji.issueId', 'left');
        $this->db->where('m.status', 'published');
        $this->db->where('m.manuscriptId', (int)$manuscriptId);
        $article = $this->db->get()->row();

        if($article) {
            $this->db->select('u.name, ma.authorOrder, ma.isCorresponding');
            $this->db->from('tbl_manuscript_authors ma');
            $this->db->join('tbl_users u', 'ma.userId = u.userId');
            $this->db->where('ma.manuscriptId', $article->manuscriptId);
            $this->db->order_by('ma.authorOrder', 'ASC');
            $article->authors = $this->db->get()->result();
        }

        return $article;
    }
    
    /**
     * Log activity
     */
    public function log_activity($userId, $action, $description, $referenceId = null, $referenceType = null) {
        $data = array(
            'userId' => $userId,
            'action' => $action,
            'description' => $description,
            'ipAddress' => $this->input->ip_address(),
            'userAgent' => $this->input->user_agent(),
            'referenceId' => $referenceId,
            'referenceType' => $referenceType,
            'createdDtm' => date('Y-m-d H:i:s')
        );
        
        return $this->db->insert('tbl_journal_activity', $data);
    }
    
    /**
     * Get latest issue (delegates to Issue_model)
     */
   public function get_latest_issue() {
    $this->db->where('isDeleted', 0);
    $this->db->where('status', 'published');
    $this->db->order_by('publishedDate', 'DESC');
    $this->db->limit(1);
    $issue = $this->db->get('tbl_journal_issues')->row();
    
    if ($issue) {
        // Get articles for this issue
        $this->db->select('pa.articleId, pa.doi, m.title, m.abstract, m.articleType, m.manuscriptNumber, 
                          GROUP_CONCAT(u.name SEPARATOR ", ") as author_names');
        $this->db->from('tbl_published_articles pa');
        $this->db->join('tbl_manuscripts m', 'pa.manuscriptId = m.manuscriptId');
        $this->db->join('tbl_manuscript_authors ma', 'm.manuscriptId = ma.manuscriptId');
        $this->db->join('tbl_users u', 'ma.userId = u.userId');
        $this->db->where('pa.issueId', $issue->issueId);
        $this->db->group_by('pa.articleId');
        $this->db->order_by('pa.publishedDate', 'ASC');
        $issue->articles = $this->db->get()->result();
    }
    
    return $issue;
}
    
}