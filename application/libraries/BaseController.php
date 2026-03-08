<?php
defined('BASEPATH') or exit('No direct script access allowed'); 

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class BaseController extends CI_Controller {
    protected $role = '';
    protected $vendorId = '';
    protected $name = '';
    protected $roleText = '';
    protected $isAdmin = 0;
    protected $accessInfo = [];
    protected $global = array();
    protected $lastLogin = '';
    protected $module = '';
    
    // Properties for journal system
    protected $profileImage = '';
    protected $institution = '';

    /**
     * Role constants for journal system
     */
    const ROLE_SYSTEM_ADMIN = 1;
    const ROLE_EDITOR_IN_CHIEF = 13;
    const ROLE_ASSOCIATE_EDITOR_IN_CHIEF = 14;
    const ROLE_MANAGING_EDITOR = 15;
    const ROLE_ASSOCIATE_EDITOR = 16;
    const ROLE_SPECIALTY_CHIEF_EDITOR = 17;
    const ROLE_EDITORIAL_ADVISORY_BOARD = 18;
    const ROLE_REVIEWER = 19;
    const ROLE_GUEST_EDITOR = 20;
    const ROLE_AUTHOR = 21;

    /**
     * This is default constructor
     */
    public function __construct() {
        parent::__construct();
        
        // Load necessary models for profile data
        $this->load->model('user_model');
        
        // Check if user is logged in
        if($this->session->userdata('isLoggedIn')) {
            $this->loadUserData();
        }
    }
    
    /**
     * Load user data from session and database
     */
    private function loadUserData() {
        // Load session data
        $this->role = $this->session->userdata('role');
        $this->vendorId = $this->session->userdata('userId');
        $this->name = $this->session->userdata('name');
        $this->roleText = $this->session->userdata('roleText');
        $this->lastLogin = $this->session->userdata('lastLogin');
        $this->isAdmin = $this->session->userdata('isAdmin');
        $this->accessInfo = $this->session->userdata('accessInfo') ?: [];
        
        // Load additional profile data from database
        if(!empty($this->vendorId)) {
            $userInfo = $this->user_model->getUserInfo($this->vendorId);
            if($userInfo) {
                $this->profileImage = $userInfo->profile_image ?? '';
                $this->institution = $userInfo->institution ?? '';
            }
        }
        
        // Set global array for views
        $this->global['name'] = $this->name;
        $this->global['role'] = $this->role;
        $this->global['role_text'] = $this->roleText;
        $this->global['last_login'] = $this->lastLogin;
        $this->global['is_admin'] = $this->isAdmin;
        $this->global['access_info'] = $this->accessInfo;
        $this->global['profile_image'] = $this->profileImage;
        $this->global['institution'] = $this->institution;
    }
    
    /**
     * This function used to check the user is logged in or not
     */
    function isLoggedIn() {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        
        // Refresh user data
        $this->loadUserData();
        
        return true;
    }
    
    /**
     * This function is used to check the access
     */
    function isAdmin() {
        return ($this->isAdmin == 1);
    }

    /**
     * Check if user has specific role
     * @param mixed $roleIds Single role ID or array of role IDs
     * @return boolean
     */
    protected function hasRole($roleIds) {
        if(!is_array($roleIds)) {
            $roleIds = array($roleIds);
        }
        return in_array($this->role, $roleIds);
    }
    
    /**
     * Check if user is Author (roleId = 21)
     * @return boolean
     */
    protected function isAuthor() {
        return ($this->role == self::ROLE_AUTHOR);
    }
    
    /**
     * Check if user is Reviewer (roleId = 19)
     * @return boolean
     */
    protected function isReviewer() {
        return ($this->role == self::ROLE_REVIEWER);
    }
    
    /**
     * Check if user is Editor (any editorial role)
     * @return boolean
     */
    protected function isEditor() {
        $editorRoles = [
            self::ROLE_EDITOR_IN_CHIEF,
            self::ROLE_ASSOCIATE_EDITOR_IN_CHIEF,
            self::ROLE_MANAGING_EDITOR,
            self::ROLE_ASSOCIATE_EDITOR,
            self::ROLE_SPECIALTY_CHIEF_EDITOR,
            self::ROLE_EDITORIAL_ADVISORY_BOARD,
            self::ROLE_GUEST_EDITOR
        ];
        return in_array($this->role, $editorRoles);
    }
    
    /**
     * Check if user is Editor-in-Chief (roleId = 13)
     * @return boolean
     */
    protected function isEditorInChief() {
        return ($this->role == self::ROLE_EDITOR_IN_CHIEF);
    }
    
    /**
     * Get dashboard URL based on user role
     * @return string
     */
    protected function getDashboardUrl() {
        if($this->isAdmin()) {
            return 'admin/dashboard';
        }
        
        switch($this->role) {
            case self::ROLE_EDITOR_IN_CHIEF:
            case self::ROLE_ASSOCIATE_EDITOR_IN_CHIEF:
            case self::ROLE_MANAGING_EDITOR:
            case self::ROLE_ASSOCIATE_EDITOR:
            case self::ROLE_SPECIALTY_CHIEF_EDITOR:
            case self::ROLE_EDITORIAL_ADVISORY_BOARD:
            case self::ROLE_GUEST_EDITOR:
                return 'editor/dashboard';
                
            case self::ROLE_REVIEWER:
                return 'reviewer/dashboard';
                
            case self::ROLE_AUTHOR:
                return 'author/dashboard';
                
            default:
                return 'dashboard';
        }
    }
    
    /**
     * Get role-specific menu items for sidebar
     * @return array
     */
    protected function getRoleMenuItems() {
        $menu = [];
        
        if($this->isAdmin()) {
            $menu[] = [
                'header' => 'ADMINISTRATION',
                'items' => [
                    ['url' => 'userListing', 'icon' => 'fa-users', 'text' => 'User Management'],
                    ['url' => 'addNew', 'icon' => 'fa-user-plus', 'text' => 'Add User'],
                    ['url' => 'roleListing', 'icon' => 'fa-tags', 'text' => 'Roles']
                ]
            ];
        }
        
        if($this->isAuthor()) {
            $menu[] = [
                'header' => 'AUTHOR ZONE',
                'items' => [
                    ['url' => 'author/manuscript', 'icon' => 'fa-file-text', 'text' => 'My Submissions'],
                    ['url' => 'author/manuscript/submit', 'icon' => 'fa-upload', 'text' => 'New Submission']
                ]
            ];
        }
        
        if($this->isReviewer()) {
            $menu[] = [
                'header' => 'REVIEWER ZONE',
                'items' => [
                    ['url' => 'reviewer/assignments', 'icon' => 'fa-tasks', 'text' => 'Review Assignments'],
                    ['url' => 'reviewer/completed', 'icon' => 'fa-check-circle', 'text' => 'Completed Reviews']
                ]
            ];
        }
        
        if($this->isEditor()) {
            $menu[] = [
                'header' => 'EDITORIAL ZONE',
                'items' => [
                    ['url' => 'editor/pending', 'icon' => 'fa-clock-o', 'text' => 'Pending Manuscripts'],
                    ['url' => 'editor/all', 'icon' => 'fa-list', 'text' => 'All Manuscripts'],
                    ['url' => 'editor/assignments', 'icon' => 'fa-users', 'text' => 'Reviewer Assignments']
                ]
            ];
        }
        
        // Common menu items for all users
        $menu[] = [
            'header' => 'JOURNAL',
            'items' => [
                ['url' => 'journal/current-issue', 'icon' => 'fa-book', 'text' => 'Current Issue'],
                ['url' => 'journal/archive', 'icon' => 'fa-archive', 'text' => 'Archive'],
                ['url' => 'journal/search', 'icon' => 'fa-search', 'text' => 'Search Articles']
            ]
        ];
        
        $menu[] = [
            'header' => 'USER',
            'items' => [
                ['url' => 'profile', 'icon' => 'fa-user', 'text' => 'My Profile'],
                ['url' => 'logout', 'icon' => 'fa-sign-out', 'text' => 'Logout']
            ]
        ];
        
        return $menu;
    }

    /**
     * This function is used to check the user having list access or not
     */
    protected function hasListAccess() {
        if ($this->isAdmin() ||
            (array_key_exists($this->module, $this->accessInfo) 
            && ($this->accessInfo[$this->module]['list'] == 1 
            || $this->accessInfo[$this->module]['total_access'] == 1)))
        {
            return true;
        }
        return false;
    }

    /**
     * This function is used to check the user having create access or not
     */
    protected function hasCreateAccess() {
        if ($this->isAdmin() ||
            (array_key_exists($this->module, $this->accessInfo) 
            && ($this->accessInfo[$this->module]['create_records'] == 1 
            || $this->accessInfo[$this->module]['total_access'] == 1)))
        {
            return true;
        }
        return false;
    }

    /**
     * This function is used to check the user having update access or not
     */
    protected function hasUpdateAccess() {
        if ($this->isAdmin() ||
            (array_key_exists($this->module, $this->accessInfo) 
            && ($this->accessInfo[$this->module]['edit_records'] == 1 
            || $this->accessInfo[$this->module]['total_access'] == 1)))
        {
            return true;
        }
        return false;
    }

    /**
     * This function is used to check the user having delete access or not
     */
    protected function hasDeleteAccess() {
        if ($this->isAdmin() ||
            (array_key_exists($this->module, $this->accessInfo) 
            && ($this->accessInfo[$this->module]['delete_records'] == 1 
            || $this->accessInfo[$this->module]['total_access'] == 1)))
        {
            return true;
        }
        return false;
    }

    /**
     * This function is used to load the set of views
     */
    function loadThis() {
        $this->global['pageTitle'] = 'OJAS : Access Denied';
        
        $this->load->view('includes/header', $this->global);
        $this->load->view('general/access');
        $this->load->view('includes/footer');
    }
    
    /**
     * This function is used to logged out user from system
     */
    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

    /**
     * This function used to load views
     * @param {string} $viewName : This is view name
     * @param {mixed} $headerInfo : This is array of header information
     * @param {mixed} $pageInfo : This is array of page information
     * @param {mixed} $footerInfo : This is array of footer information
     * @return {null} $result : null
     */
    function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL) {
        // Merge global data with header info
        $headerData = $this->global;
        if(is_array($headerInfo)) {
            $headerData = array_merge($headerData, $headerInfo);
        }
        
        $this->load->view('includes/header', $headerData);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('includes/footer', $footerInfo);
    }
    
    /**
     * This function used provide the pagination resources
     * @param {string} $link : This is page link
     * @param {number} $count : This is page count
     * @param {number} $perPage : This is records per page limit
     * @return {mixed} $result : This is array of records and pagination data
     */
    function paginationCompress($link, $count, $perPage = 10, $segment = SEGMENT) {
        $this->load->library('pagination');

        $config['base_url'] = base_url() . $link;
        $config['total_rows'] = $count;
        $config['uri_segment'] = $segment;
        $config['per_page'] = $perPage;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_tag_open'] = '<li class="arrow">';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="arrow">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="arrow">';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="arrow">';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</li>';
    
        $this->pagination->initialize($config);
        $page = $config['per_page'];
        $segment = $this->uri->segment($segment);
    
        return array(
            "page" => $page,
            "segment" => $segment
        );
    }
    
    /**
     * Get user profile image URL
     * @return string
     */
    protected function getProfileImageUrl() {
        if(!empty($this->profileImage) && file_exists('./uploads/profile_images/' . $this->profileImage)) {
            return base_url('uploads/profile_images/' . $this->profileImage);
        }
        return base_url('assets/dist/img/avatar-default.png');
    }
    
    /**
     * Refresh user data from database
     */
    protected function refreshUserData() {
        if(!empty($this->vendorId)) {
            $userInfo = $this->user_model->getUserInfo($this->vendorId);
            if($userInfo) {
                $this->profileImage = $userInfo->profile_image ?? '';
                $this->institution = $userInfo->institution ?? '';
                
                // Update global array
                $this->global['profile_image'] = $this->profileImage;
                $this->global['institution'] = $this->institution;
            }
        }
    }
}