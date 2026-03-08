<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_model extends CI_Model
{
    private $table = 'tbl_notifications';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function getUserNotifications($userId, $limit = 10)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->order_by('createdDtm', 'DESC');
        $this->db->limit($limit);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    public function countUnread($userId)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isRead', 0);
        $this->db->where('isDeleted', 0);
        return $this->db->count_all_results($this->table);
    }
    
    public function markAsRead($notificationId)
    {
        $this->db->where('notificationId', $notificationId);
        return $this->db->update($this->table, ['isRead' => 1, 'readAt' => date('Y-m-d H:i:s')]);
    }
    
    public function addNotification($data)
    {
        $data['createdDtm'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $data);
    }
}