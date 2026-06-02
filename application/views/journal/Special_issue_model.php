<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Special_issue_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get open special issues (submission deadline not passed and status = 'open')
     */
    public function get_open_calls() {
        $today = date('Y-m-d');
        $this->db->select('s.*, u.name as guest_editor_name');
        $this->db->from('tbl_special_issues s');
        $this->db->join('tbl_users u', 's.guestEditorId = u.userId', 'left');
        $this->db->where('s.status', 'open');
        $this->db->where('s.submissionDeadline >=', $today);
        $this->db->where('s.isDeleted', 0);
        $this->db->order_by('s.submissionDeadline', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get upcoming calls (future dates but status may be 'draft' or not yet open)
     */
    public function get_upcoming_calls() {
        $today = date('Y-m-d');
        $this->db->select('s.*, u.name as guest_editor_name');
        $this->db->from('tbl_special_issues s');
        $this->db->join('tbl_users u', 's.guestEditorId = u.userId', 'left');
        $this->db->where('s.status', 'open');
        $this->db->where('s.submissionDeadline <', $today);
        $this->db->where('s.isDeleted', 0);
        $this->db->order_by('s.submissionDeadline', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get closed/published special issues
     */
    public function get_closed_calls() {
        $this->db->select('s.*, u.name as guest_editor_name');
        $this->db->from('tbl_special_issues s');
        $this->db->join('tbl_users u', 's.guestEditorId = u.userId', 'left');
        $this->db->where_in('s.status', ['closed', 'published']);
        $this->db->where('s.isDeleted', 0);
        $this->db->order_by('s.submissionDeadline', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result();
    }

    /**
 * Get all special issues (for admin list)
 */
public function get_all_special_issues() {
    $this->db->select('s.*, u.name as guest_editor_name');
    $this->db->from('tbl_special_issues s');
    $this->db->join('tbl_users u', 's.guestEditorId = u.userId', 'left');
    $this->db->where('s.isDeleted', 0);
    $this->db->order_by('s.createdDtm', 'DESC');
    $query = $this->db->get();
    return $query->result();
}

/**
 * Get single special issue by ID
 */
public function get_special_issue($id) {
    $this->db->select('s.*, u.name as guest_editor_name');
    $this->db->from('tbl_special_issues s');
    $this->db->join('tbl_users u', 's.guestEditorId = u.userId', 'left');
    $this->db->where('s.specialIssueId', $id);
    $this->db->where('s.isDeleted', 0);
    $query = $this->db->get();
    return $query->row();
}

/**
 * Insert new special issue
 */
public function insert_special_issue($data) {
    $this->db->insert('tbl_special_issues', $data);
    return $this->db->insert_id();
}

/**
 * Update special issue
 */
public function update_special_issue($id, $data) {
    $this->db->where('specialIssueId', $id);
    return $this->db->update('tbl_special_issues', $data);
}

/**
 * Soft delete special issue
 */
public function delete_special_issue($id) {
    $this->db->where('specialIssueId', $id);
    return $this->db->update('tbl_special_issues', ['isDeleted' => 1]);
}
}