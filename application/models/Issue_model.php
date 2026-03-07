<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Issue_model extends CI_Model {
    
    private $table = 'tbl_journal_issues';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Get all issues
     */
    public function get_issues($publishedOnly = false) {
        $this->db->where('isDeleted', 0);
        if($publishedOnly) {
            $this->db->where('status', 'published');
        }
        $this->db->order_by('year DESC, volume DESC, issueNumber DESC');
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    /**
     * Get single issue
     */
    public function get_issue($issueId) {
        $this->db->where('issueId', $issueId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    /**
     * Get issue with articles
     */
    public function get_issue_with_articles($issueId) {
        // Get issue
        $this->db->where('issueId', $issueId);
        $this->db->where('isDeleted', 0);
        $issue = $this->db->get($this->table)->row();
        
        if($issue) {
            // Get articles in this issue
            $this->db->select('
                pa.*, 
                m.title, 
                m.abstract,
                m.manuscriptNumber,
                m.articleType,
                GROUP_CONCAT(u.name SEPARATOR ", ") as author_names
            ');
            $this->db->from('tbl_published_articles pa');
            $this->db->join('tbl_manuscripts m', 'pa.manuscriptId = m.manuscriptId');
            $this->db->join('tbl_manuscript_authors ma', 'm.manuscriptId = ma.manuscriptId');
            $this->db->join('tbl_users u', 'ma.userId = u.userId');
            $this->db->where('pa.issueId', $issueId);
            $this->db->group_by('pa.articleId');
            $this->db->order_by('pa.pageStart', 'ASC');
            $issue->articles = $this->db->get()->result();
        }
        
        return $issue;
    }
    
    /**
     * Create new issue
     */
    public function create_issue($data) {
        $data['createdBy'] = $this->session->userdata('user_id');
        $data['createdDtm'] = date('Y-m-d H:i:s');
        
        return $this->db->insert($this->table, $data);
    }
    
    /**
     * Update issue
     */
    public function update_issue($issueId, $data) {
        $data['updatedBy'] = $this->session->userdata('user_id');
        $data['updatedDtm'] = date('Y-m-d H:i:s');
        
        $this->db->where('issueId', $issueId);
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Delete issue (soft delete)
     */
    public function delete_issue($issueId) {
        $data = array(
            'isDeleted' => 1,
            'updatedBy' => $this->session->userdata('user_id'),
            'updatedDtm' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('issueId', $issueId);
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Get latest issue
     */
    public function get_latest_issue() {
        $this->db->where('status', 'published');
        $this->db->where('isDeleted', 0);
        $this->db->order_by('year DESC, volume DESC, issueNumber DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row();
    }
}