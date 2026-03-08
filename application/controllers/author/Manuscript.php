<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manuscript extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        
        // Check if user is Author (roleId = 21) or Admin
        if($this->role != 21 && $this->isAdmin != 1) {
            $this->loadThis();
            return;
        }
        
        $this->load->model('manuscript_model');
        $this->load->model('file_model');
        $this->load->model('user_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        // Create upload directory if not exists
        $this->createUploadDirectory();
    }
    
    /**
     * Create upload directory for manuscript files
     */
    private function createUploadDirectory()
    {
        $path = './uploads/manuscripts/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }
    
    /**
     * List all manuscripts of the author
     */
    public function index()
    {
        $userId = $this->vendorId;
        $data['manuscripts'] = $this->manuscript_model->getAuthorManuscripts($userId);
        
        $this->global['pageTitle'] = 'My Submissions - OJAS';
        $data['activeTab'] = 'submissions';
        
        $this->loadViews("author/manuscripts", $this->global, $data, NULL);
    }
    
    /**
     * Submit new manuscript (Step 1)
     */
    public function submit()
    {
        $data['articleTypes'] = array(
            'research' => 'Research Article',
            'review' => 'Review Article',
            'short_communication' => 'Short Communication',
            'case_study' => 'Case Study',
            'technical_note' => 'Technical Note'
        );
        
        $this->global['pageTitle'] = 'Submit Manuscript - OJAS';
        $data['step'] = 1;
        
        $this->loadViews("author/submit_step1", $this->global, $data, NULL);
    }
    
    /**
     * Process step 1 of submission
     */
    public function submitStep1()
    {
        $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[500]');
        $this->form_validation->set_rules('abstract', 'Abstract', 'trim|required');
        $this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
        $this->form_validation->set_rules('articleType', 'Article Type', 'required');
        
        if($this->form_validation->run() == FALSE) {
            // Reload step 1 with validation errors
            $data['articleTypes'] = array(
                'research' => 'Research Article',
                'review' => 'Review Article',
                'short_communication' => 'Short Communication',
                'case_study' => 'Case Study',
                'technical_note' => 'Technical Note'
            );
            $this->global['pageTitle'] = 'Submit Manuscript - OJAS';
            $data['step'] = 1;
            $this->loadViews("author/submit_step1", $this->global, $data, NULL);
        } else {
            // Store in session for next step
            $sessionData = array(
                'submission_title' => $this->input->post('title'),
                'submission_abstract' => $this->input->post('abstract'),
                'submission_keywords' => $this->input->post('keywords'),
                'submission_articleType' => $this->input->post('articleType'),
                'submission_coverLetter' => $this->input->post('coverLetter')
            );
            $this->session->set_userdata($sessionData);
            
            // Set success message
            $this->session->set_flashdata('success', 'Step 1 completed. Now add authors.');
            
            redirect('author/manuscript/step2');
        }
    }
    
    /**
     * Step 2 - Authors
     */
    public function step2()
    {
        // Check if step 1 completed
        if(!$this->session->userdata('submission_title')) {
            $this->session->set_flashdata('error', 'Please complete step 1 first');
            redirect('author/manuscript/submit');
        }
        
        // Get current user data to display as first author
        $currentUser = $this->user_model->getUserInfo($this->vendorId);
        $data['currentUser'] = $currentUser;
        
        $this->global['pageTitle'] = 'Add Authors - OJAS';
        $data['step'] = 2;
        
        $this->loadViews("author/submit_step2", $this->global, $data, NULL);
    }
    
    /**
     * Process step 2
     */
    public function submitStep2()
{
    // Get form data
    $first_names = $this->input->post('first_name');
    $last_names = $this->input->post('last_name');
    $emails = $this->input->post('email');
    $institutions = $this->input->post('institution');
    $orcids = $this->input->post('orcid');
    $countries = $this->input->post('country');
    $user_ids = $this->input->post('user_id');
    $is_corresponding = $this->input->post('is_corresponding');
    
    // Get the corresponding author from radio button
    $corresponding_index = $this->input->post('corresponding');
    
    // Log the data for debugging
    log_message('debug', 'SubmitStep2 - POST data: ' . print_r($this->input->post(), true));
    
    // Simple check - at least main author exists
    if(empty($first_names) || empty($first_names[0])) {
        $this->session->set_flashdata('error', 'Please add at least one author');
        redirect('author/manuscript/step2');
    }
    
    $authorData = array();
    $hasCorresponding = false;
    
    foreach($first_names as $index => $first_name) {
        // Determine if this author is corresponding
        $isCorresponding = 0;
        
        // Check if this author is the corresponding one
        if($corresponding_index !== null) {
            if($corresponding_index == 'new_' . ($index + 1) || $corresponding_index == $index) {
                $isCorresponding = 1;
                $hasCorresponding = true;
            }
        }
        
        // If no corresponding selected and this is first author, make them corresponding
        if(!$hasCorresponding && $index == 0) {
            $isCorresponding = 1;
            $hasCorresponding = true;
        }
        
        // Check if this is a new author (not in system)
        if(isset($user_ids[$index]) && $user_ids[$index] == 'new') {
            // For new authors, create a temporary record with provided info
            $authorData[] = array(
                'name' => $first_name . ' ' . $last_names[$index],
                'email' => $emails[$index],
                'institution' => isset($institutions[$index]) ? $institutions[$index] : '',
                'country' => isset($countries[$index]) ? $countries[$index] : '',
                'orcid' => isset($orcids[$index]) ? $orcids[$index] : '',
                'isCorresponding' => $isCorresponding,
                'authorOrder' => $index + 1,
                'isNew' => true
            );
        } else {
            // Existing user (including the main author)
            $userId = isset($user_ids[$index]) ? $user_ids[$index] : $this->vendorId;
            
            $authorData[] = array(
                'userId' => $userId,
                'isCorresponding' => $isCorresponding,
                'authorOrder' => $index + 1
            );
        }
    }
    
    // Store in session
    $this->session->set_userdata('submission_authors', json_encode($authorData));
    
    // Set success message
    $this->session->set_flashdata('success', 'Authors saved successfully. Now upload your files.');
    
    // Redirect to step 3
    redirect('author/manuscript/step3');
}
    
    /**
     * Step 3 - Upload Files
     */
    public function step3()
    {
        // Check if step 1 completed
        if(!$this->session->userdata('submission_title')) {
            $this->session->set_flashdata('error', 'Please complete step 1 first');
            redirect('author/manuscript/submit');
        }
        
        // Check if step 2 completed
        if(!$this->session->userdata('submission_authors')) {
            $this->session->set_flashdata('error', 'Please complete step 2 first');
            redirect('author/manuscript/step2');
        }
        
        $this->global['pageTitle'] = 'Upload Files - OJAS';
        $data['step'] = 3;
        
        $this->loadViews("author/submit_step3", $this->global, $data, NULL);
    }
    
    /**
     * Process final submission
     */
    public function finalSubmit()
    {
        // Check if main file uploaded
        if(empty($_FILES['main_file']['name'])) {
            $this->session->set_flashdata('error', 'Please upload the main manuscript file');
            redirect('author/manuscript/step3');
        }
        
        // Check declaration
        if(!$this->input->post('declaration')) {
            $this->session->set_flashdata('error', 'You must confirm the declaration');
            redirect('author/manuscript/step3');
        }
        
        // Prepare manuscript data
        $manuscriptData = array(
            'title' => $this->session->userdata('submission_title'),
            'abstract' => $this->session->userdata('submission_abstract'),
            'keywords' => $this->session->userdata('submission_keywords'),
            'articleType' => $this->session->userdata('submission_articleType'),
            'coverLetter' => $this->session->userdata('submission_coverLetter'),
            'submittedBy' => $this->vendorId,
            'correspondingAuthorId' => $this->vendorId
        );
        
        // Insert manuscript
        $manuscriptId = $this->manuscript_model->submit($manuscriptData);
        
        if($manuscriptId) {
            // Upload main file
            $mainUpload = $this->file_model->uploadFile($manuscriptId, 'main_file');
            if($mainUpload !== true && $mainUpload !== null) {
                // Upload failed
                $this->session->set_flashdata('error', 'File upload failed: ' . $mainUpload);
                redirect('author/manuscript/step3');
            }
            
            // Upload figures files if any
            if(!empty($_FILES['figures_files']['name'][0])) {
                $this->handleMultipleFileUpload($manuscriptId, 'figures_files', 'figure');
            }
            
            // Upload supplementary files if any
            if(!empty($_FILES['supplementary_files']['name'][0])) {
                $this->handleMultipleFileUpload($manuscriptId, 'supplementary_files', 'supplementary');
            }
            
            // Save authors
            $authors = json_decode($this->session->userdata('submission_authors'), true);
            foreach($authors as $author) {
                if(isset($author['isNew']) && $author['isNew']) {
                    // Check if table exists, if not create it
                    if(!$this->db->table_exists('tbl_manuscript_author_details')) {
                        $this->createAuthorDetailsTable();
                    }
                    
                    // For new authors, store details
                    $authorData = array(
                        'manuscriptId' => $manuscriptId,
                        'name' => $author['name'],
                        'email' => $author['email'],
                        'institution' => $author['institution'],
                        'country' => $author['country'],
                        'orcid' => $author['orcid'],
                        'isCorresponding' => $author['isCorresponding'],
                        'authorOrder' => $author['authorOrder'],
                        'createdDtm' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tbl_manuscript_author_details', $authorData);
                } else {
                    // Existing user
                    $authorData = array(
                        'manuscriptId' => $manuscriptId,
                        'userId' => $author['userId'],
                        'isCorresponding' => $author['isCorresponding'],
                        'authorOrder' => $author['authorOrder'],
                        'createdDtm' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tbl_manuscript_authors', $authorData);
                }
            }
            
            // Get the manuscript number for success message
            $manuscript = $this->manuscript_model->getManuscript($manuscriptId);
            
            // Clear session
            $this->session->unset_userdata([
                'submission_title', 'submission_abstract', 'submission_keywords',
                'submission_articleType', 'submission_coverLetter', 'submission_authors'
            ]);
            
            $this->session->set_flashdata('success', 'Manuscript submitted successfully! Manuscript Number: ' . $manuscript->manuscriptNumber);
            redirect('author/manuscript/view/' . $manuscriptId);
        } else {
            $this->session->set_flashdata('error', 'Failed to submit manuscript');
            redirect('author/manuscript/step3');
        }
    }
    
    /**
     * Handle multiple file uploads
     */
    private function handleMultipleFileUpload($manuscriptId, $fieldName, $fileType)
    {
        $files = $_FILES[$fieldName];
        $fileCount = count($files['name']);
        
        for($i = 0; $i < $fileCount; $i++) {
            $_FILES['single_file']['name'] = $files['name'][$i];
            $_FILES['single_file']['type'] = $files['type'][$i];
            $_FILES['single_file']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['single_file']['error'] = $files['error'][$i];
            $_FILES['single_file']['size'] = $files['size'][$i];
            
            $this->file_model->uploadFile($manuscriptId, 'single_file', $fileType);
        }
    }
    
    /**
     * Create author details table if not exists
     */
    private function createAuthorDetailsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `tbl_manuscript_author_details` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `manuscriptId` INT(11) NOT NULL,
            `name` VARCHAR(255) NOT NULL,
            `email` VARCHAR(128) NOT NULL,
            `institution` VARCHAR(255) DEFAULT NULL,
            `country` VARCHAR(100) DEFAULT NULL,
            `orcid` VARCHAR(50) DEFAULT NULL,
            `isCorresponding` TINYINT(1) DEFAULT '0',
            `authorOrder` INT(11) NOT NULL,
            `createdDtm` DATETIME NOT NULL,
            PRIMARY KEY (`id`),
            KEY `manuscriptId` (`manuscriptId`),
            CONSTRAINT `tbl_manuscript_author_details_ibfk_1` FOREIGN KEY (`manuscriptId`) REFERENCES `tbl_manuscripts` (`manuscriptId`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        
        $this->db->query($sql);
    }
    
    /**
     * View manuscript details
     */
    public function view($manuscriptId)
    {
        $manuscript = $this->manuscript_model->getManuscript($manuscriptId);
        
        if(!$manuscript) {
            $this->session->set_flashdata('error', 'Manuscript not found');
            redirect('author/manuscript');
        }
        
        // Check if user owns this manuscript
        if($manuscript->submittedBy != $this->vendorId && $this->isAdmin != 1) {
            $this->loadThis();
            return;
        }
        
        $data['manuscript'] = $manuscript;
        $data['files'] = $this->manuscript_model->getManuscriptFiles($manuscriptId);
        
        // Get authors (existing users)
        $this->db->select('u.*, ma.isCorresponding, ma.authorOrder');
        $this->db->from('tbl_manuscript_authors ma');
        $this->db->join('tbl_users u', 'ma.userId = u.userId');
        $this->db->where('ma.manuscriptId', $manuscriptId);
        $this->db->order_by('ma.authorOrder', 'ASC');
        $data['authors'] = $this->db->get()->result();
        
        // Also check for non-registered authors
        if($this->db->table_exists('tbl_manuscript_author_details')) {
            $this->db->where('manuscriptId', $manuscriptId);
            $nonRegistered = $this->db->get('tbl_manuscript_author_details')->result();
            $data['authors'] = array_merge($data['authors'], $nonRegistered);
            
            // Sort by authorOrder
            usort($data['authors'], function($a, $b) {
                return $a->authorOrder - $b->authorOrder;
            });
        }
        
        $this->global['pageTitle'] = 'Manuscript Details - OJAS';
        $data['activeTab'] = 'submissions';
        
        $this->loadViews("author/view_manuscript", $this->global, $data, NULL);
    }
    
    /**
     * Withdraw manuscript (AJAX)
     */
    public function withdraw($manuscriptId)
    {
        $manuscript = $this->manuscript_model->getManuscript($manuscriptId);
        
        if(!$manuscript) {
            echo json_encode(['status' => false, 'message' => 'Manuscript not found']);
            return;
        }
        
        // Check if user owns this manuscript
        if($manuscript->submittedBy != $this->vendorId && $this->isAdmin != 1) {
            echo json_encode(['status' => false, 'message' => 'Unauthorized']);
            return;
        }
        
        // Only allow withdrawal if status is draft or submitted
        if($manuscript->status != 'draft' && $manuscript->status != 'submitted') {
            echo json_encode(['status' => false, 'message' => 'Cannot withdraw manuscript at this stage']);
            return;
        }
        
        $result = $this->manuscript_model->updateManuscript($manuscriptId, ['status' => 'withdrawn']);
        
        if($result) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Failed to withdraw manuscript']);
        }
    }
    
    /**
     * Delete file (AJAX)
     */
    public function deleteFile($fileId)
    {
        $result = $this->file_model->deleteFile($fileId);
        
        if($result) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }
}