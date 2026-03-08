<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manuscript_model extends CI_Model
{
    private $table = 'tbl_manuscripts';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Generate unique manuscript number
     * Format: OJAS-YYYY-XXXX
     */
    public function generateManuscriptNumber()
    {
        $year = date('Y');
        $this->db->select('COUNT(*) as count');
        $this->db->where('YEAR(createdDtm)', $year);
        $query = $this->db->get($this->table);
        $count = $query->row()->count + 1;
        
        return 'OJAS-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
    
    /**
     * Submit new manuscript
     */
    public function submit($data)
    {
        $data['manuscriptNumber'] = $this->generateManuscriptNumber();
        $data['status'] = 'submitted';
        $data['createdBy'] = $this->session->userdata('userId');
        $data['createdDtm'] = date('Y-m-d H:i:s');
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Get author's manuscripts
     */
    public function getAuthorManuscripts($userId, $limit = null)
    {
        $this->db->select('m.*, 
            (SELECT COUNT(*) FROM tbl_reviewer_assignments WHERE manuscriptId = m.manuscriptId) as reviewerCount,
            (SELECT COUNT(*) FROM tbl_reviewer_assignments WHERE manuscriptId = m.manuscriptId AND reviewSubmittedDate IS NOT NULL) as reviewsCompleted');
        $this->db->from($this->table . ' m');
        $this->db->where('m.submittedBy', $userId);
        $this->db->where('m.isDeleted', 0);
        $this->db->order_by('m.createdDtm', 'DESC');
        
        if($limit) {
            $this->db->limit($limit);
        }
        
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * Get single manuscript
     */
    public function getManuscript($manuscriptId)
    {
        $this->db->select('m.*, u.name as submitterName, u.email as submitterEmail');
        $this->db->from($this->table . ' m');
        $this->db->join('tbl_users u', 'm.submittedBy = u.userId');
        $this->db->where('m.manuscriptId', $manuscriptId);
        $this->db->where('m.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    /**
     * Count author's manuscripts
     */
    public function countAuthorManuscripts($userId)
    {
        $this->db->where('submittedBy', $userId);
        $this->db->where('isDeleted', 0);
        return $this->db->count_all_results($this->table);
    }
    
    /**
     * Count author's manuscripts by status
     */
    public function countAuthorManuscriptsByStatus($userId, $status)
    {
        $this->db->where('submittedBy', $userId);
        $this->db->where('status', $status);
        $this->db->where('isDeleted', 0);
        return $this->db->count_all_results($this->table);
    }
    
    /**
     * Update manuscript
     */
    public function updateManuscript($manuscriptId, $data)
    {
        $data['updatedBy'] = $this->session->userdata('userId');
        $data['updatedDtm'] = date('Y-m-d H:i:s');
        
        $this->db->where('manuscriptId', $manuscriptId);
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Get manuscript files
     */
    public function getManuscriptFiles($manuscriptId)
    {
        $this->db->where('manuscriptId', $manuscriptId);
        $this->db->where('isDeleted', 0);
        $this->db->order_by('fileType', 'ASC');
        $query = $this->db->get('tbl_manuscript_files');
        return $query->result();
    }
}