<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        
        // Check if user is Author (roleId = 21) or Admin
        if(!$this->isAuthor() && !$this->isAdmin()) {
            $this->loadThis();
            return;
        }
        
        $this->load->model('manuscript_model');
        $this->load->model('user_model');
        $this->load->model('notification_model');
    }
    
    public function index()
    {
        $userId = $this->vendorId;
        
        // Get author statistics
        $data['totalSubmissions'] = $this->manuscript_model->countAuthorManuscripts($userId);
        $data['underReview'] = $this->manuscript_model->countAuthorManuscriptsByStatus($userId, 'under_review');
        $data['revisionRequired'] = $this->manuscript_model->countAuthorManuscriptsByStatus($userId, 'revision_required');
        $data['accepted'] = $this->manuscript_model->countAuthorManuscriptsByStatus($userId, 'accepted');
        $data['published'] = $this->manuscript_model->countAuthorManuscriptsByStatus($userId, 'published');
        $data['rejected'] = $this->manuscript_model->countAuthorManuscriptsByStatus($userId, 'rejected');
        
        // Get recent manuscripts
        $data['recentManuscripts'] = $this->manuscript_model->getAuthorManuscripts($userId, 5);
        
        // Get user profile
        $data['user'] = $this->user_model->getUserInfo($userId);
        
        // Get notifications
        $data['notifications'] = $this->notification_model->getUserNotifications($userId, 5);
        $data['unreadCount'] = $this->notification_model->countUnread($userId);
        
        $this->global['pageTitle'] = 'Author Dashboard - OJAS';
        $this->global['activeMenu'] = 'dashboard';
        
        $this->loadViews("author/dashboard", $this->global, $data, NULL);
    }
    
    public function profile()
    {
        $userId = $this->vendorId;
        $data['userInfo'] = $this->user_model->getUserInfoWithRole($userId);
        
        $this->global['pageTitle'] = 'My Profile - OJAS';
        $this->global['activeMenu'] = 'profile';
        
        $this->loadViews("author/profile", $this->global, $data, NULL);
    }
    
    public function updateProfile()
    {
        $userId = $this->vendorId;
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('institution', 'Institution', 'trim');
        $this->form_validation->set_rules('country', 'Country', 'trim');
        
        if($this->form_validation->run() == FALSE) {
            $this->profile();
        } else {
            // Handle profile image upload
            $profile_image = $this->uploadProfileImage();
            
            $updateData = array(
                'name' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                'institution' => $this->input->post('institution'),
                'country' => $this->input->post('country'),
                'city' => $this->input->post('city'),
                'orcid_id' => $this->input->post('orcid_id'),
                'expertise_area' => $this->input->post('expertise_area'),
                'bio' => $this->input->post('bio')
            );
            
            if($profile_image) {
                $updateData['profile_image'] = $profile_image;
            }
            
            if($this->user_model->editUser($updateData, $userId)) {
                $this->session->set_flashdata('success', 'Profile updated successfully');
            } else {
                $this->session->set_flashdata('error', 'Profile update failed');
            }
            
            redirect('author/dashboard/profile');
        }
    }
    
    private function uploadProfileImage()
    {
        if(!empty($_FILES['profile_image']['name'])) {
            $config['upload_path'] = './uploads/profile_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = true;
            
            $this->load->library('upload', $config);
            
            if($this->upload->do_upload('profile_image')) {
                $data = $this->upload->data();
                return $data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                return false;
            }
        }
        return false;
    }
}