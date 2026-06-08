<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->ensurePublishedVisibilityColumn();
    }

    private function ensurePublishedVisibilityColumn() {
        if ($this->db->table_exists('tbl_published_articles')) {
            $fields = $this->db->list_fields('tbl_published_articles');
            if (!in_array('isHidden', $fields)) {
                $this->db->query("ALTER TABLE tbl_published_articles ADD COLUMN isHidden TINYINT(1) NOT NULL DEFAULT 0 AFTER doi");
            }
        }
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

        // Published articles visible through the new publisher workflow.
        $this->db->from('tbl_published_articles pa');
        $this->db->join('tbl_manuscripts m', 'pa.manuscriptId = m.manuscriptId');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.status', 'published');
        $this->db->where('m.author_proof_decision', 'accepted');
        $this->db->where('m.proof_file_path IS NOT NULL', null, false);
        $this->db->where('pa.isHidden', 0);
        $published = $this->db->count_all_results();

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
        return $this->get_published_articles($limit);
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
        $this->db->select('
            pa.articleId,
            pa.issueId,
            pa.doi,
            pa.publishedDate,
            m.manuscriptId,
            m.title,
            m.abstract,
            m.abstract as abstract_text,
            m.keywords,
            m.manuscriptNumber,
            m.articleType,
            m.thematicArea,
            ji.volume,
            ji.issueNumber,
            ji.year,
            GROUP_CONCAT(u.name SEPARATOR ", ") as author_names
        ');
        $this->db->from('tbl_published_articles pa');
        $this->db->join('tbl_manuscripts m', 'pa.manuscriptId = m.manuscriptId');
        $this->db->join('tbl_journal_issues ji', 'pa.issueId = ji.issueId', 'left');
        $this->db->join('tbl_manuscript_authors ma', 'm.manuscriptId = ma.manuscriptId', 'left');
        $this->db->join('tbl_users u', 'ma.userId = u.userId', 'left');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.status', 'published');
        $this->db->where('m.author_proof_decision', 'accepted');
        $this->db->where('m.proof_file_path IS NOT NULL', null, false);
        $this->db->where('pa.isHidden', 0);
        $this->db->group_by('pa.articleId');
        $this->db->order_by('pa.publishedDate', 'DESC');
        $this->db->limit($limit, $offset);

        $results = $this->db->get()->result();
        foreach ($results as $article) {
            if (empty($article->author_names)) {
                $article->author_names = 'OJAS Editorial';
            }
            $article->year = $article->year ?? date('Y', strtotime($article->publishedDate));
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
            pa.articleId,
            pa.issueId,
            pa.doi,
            pa.publishedDate,
            m.manuscriptId,
            m.title,
            m.abstract,
            m.abstract as abstract_text,
            m.keywords,
            m.articleType,
            m.thematicArea,
            m.manuscriptNumber,
            ji.volume,
            ji.issueNumber,
            ji.year,
            GROUP_CONCAT(u.name SEPARATOR ", ") as author_names
        ');
        $this->db->from('tbl_published_articles pa');
        $this->db->join('tbl_manuscripts m', 'pa.manuscriptId = m.manuscriptId');
        $this->db->join('tbl_journal_issues ji', 'pa.issueId = ji.issueId', 'left');
        $this->db->join('tbl_manuscript_authors ma', 'm.manuscriptId = ma.manuscriptId', 'left');
        $this->db->join('tbl_users u', 'ma.userId = u.userId', 'left');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.status', 'published');
        $this->db->where('m.author_proof_decision', 'accepted');
        $this->db->where('m.proof_file_path IS NOT NULL', null, false);
        $this->db->where('pa.isHidden', 0);

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('m.title', $keyword);
            $this->db->or_like('m.abstract', $keyword);
            $this->db->or_like('m.keywords', $keyword);
            $this->db->or_like('m.manuscriptNumber', $keyword);
            $this->db->or_like('u.name', $keyword);
            $this->db->group_end();
        }

        if (!empty($filters['articleType'])) {
            $this->db->where('m.articleType', $filters['articleType']);
        }
        if (!empty($filters['year'])) {
            $this->db->where('ji.year', (int)$filters['year']);
        }
        if (!empty($filters['issueId'])) {
            $this->db->where('pa.issueId', (int)$filters['issueId']);
        }

        $this->db->group_by('pa.articleId');
        $this->db->order_by('pa.publishedDate', 'DESC');
        $this->db->limit(50);

        $results = $this->db->get()->result();
        foreach ($results as $article) {
            if (empty($article->author_names)) {
                $article->author_names = 'OJAS Editorial';
            }
            $article->year = $article->year ?? date('Y', strtotime($article->publishedDate));
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
        $this->db->where('m.status', 'published');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.author_proof_decision', 'accepted');
        $this->db->where('m.proof_file_path IS NOT NULL', null, false);
        $this->db->where('pa.isHidden', 0);
        
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
        $this->db->select('pa.articleId, pa.issueId, pa.doi, pa.publishedDate, m.manuscriptId, m.title, m.abstract, m.keywords, m.articleType, m.manuscriptNumber, m.proof_file_name, m.proof_file_path, m.author_proof_decision, ji.volume, ji.issueNumber, ji.year as issue_year, ji.month as issue_month');
        $this->db->from('tbl_published_articles pa');
        $this->db->join('tbl_manuscripts m', 'pa.manuscriptId = m.manuscriptId');
        $this->db->join('tbl_journal_issues ji', 'pa.issueId = ji.issueId', 'left');
        $this->db->where('m.status', 'published');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.author_proof_decision', 'accepted');
        $this->db->where('m.proof_file_path IS NOT NULL', null, false);
        $this->db->where('pa.isHidden', 0);
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
        $this->db->where('pa.isHidden', 0);
        $this->db->where('m.status', 'published');
        $this->db->where('m.author_proof_decision', 'accepted');
        $this->db->where('m.proof_file_path IS NOT NULL', null, false);
        $this->db->group_by('pa.articleId');
        $this->db->order_by('pa.publishedDate', 'ASC');
        $issue->articles = $this->db->get()->result();
    }
    
    return $issue;
}
    
}