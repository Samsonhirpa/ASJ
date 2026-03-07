<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get published articles
     */
    public function get_published_articles($limit = 10, $offset = 0) {
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
        return $query->result();
    }
    
    /**
     * Get single published article
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
     * Search articles
     */
    public function search_articles($keyword, $filters = array()) {
        $this->db->select('
            pa.*, 
            m.title, 
            m.abstract,
            m.keywords,
            m.articleType,
            ji.volume,
            ji.issueNumber,
            ji.year,
            GROUP_CONCAT(u.name SEPARATOR ", ") as author_names
        ');
        $this->db->from('tbl_published_articles pa');
        $this->db->join('tbl_manuscripts m', 'pa.manuscriptId = m.manuscriptId');
        $this->db->join('tbl_journal_issues ji', 'pa.issueId = ji.issueId');
        $this->db->join('tbl_manuscript_authors ma', 'm.manuscriptId = ma.manuscriptId');
        $this->db->join('tbl_users u', 'ma.userId = u.userId');
        $this->db->where('m.status', 'published');
        
        // Search condition
        $this->db->group_start();
        $this->db->like('m.title', $keyword);
        $this->db->or_like('m.abstract', $keyword);
        $this->db->or_like('m.keywords', $keyword);
        $this->db->or_like('u.name', $keyword);
        $this->db->group_end();
        
        // Apply filters
        if(!empty($filters['year'])) {
            $this->db->where('ji.year', $filters['year']);
        }
        
        if(!empty($filters['articleType'])) {
            $this->db->where('m.articleType', $filters['articleType']);
        }
        
        $this->db->group_by('pa.articleId');
        $this->db->order_by('pa.publishedDate', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
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
     * Get latest issue
     */
    public function get_latest_issue() {
        $this->load->model('Issue_model');
        return $this->Issue_model->get_latest_issue();
    }
}