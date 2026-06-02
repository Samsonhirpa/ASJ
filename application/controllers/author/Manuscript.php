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
     * Article types available during manuscript submission.
     */
    private function getArticleTypes()
    {
        return array(
            'research' => 'Research Article',
            'review' => 'Review Article',
            'short_communication' => 'Short Communication',
            'case_study' => 'Case Study',
            'technical_note' => 'Technical Note'
        );
    }

    /**
     * Thematic areas/sections available during manuscript submission.
     */
    private function getThematicAreas()
    {
        return array(
            'agricultural_biotechnology' => 'Agricultural Biotechnology',
            'agricultural_economics_extension' => 'Agricultural Economics and Extension',
            'agricultural_engineering' => 'Agricultural Engineering',
            'animal_sciences' => 'Animal Sciences',
            'apiculture' => 'Apiculture',
            'climate_change_adaptation' => 'Climate Change Adaptation',
            'crop_sciences' => 'Crop Sciences',
            'digital_agriculture' => 'Digital Agriculture',
            'fisheries_aquatic_life' => 'Fisheries and Aquatic Life',
            'food_science' => 'Food Science',
            'precision_farming' => 'Precision Farming',
            'soil_science' => 'Soil Science',
            'water_conservation' => 'Water Conservation',
            'agroecology' => 'Agroecology',
            'biodiversity_conservation' => 'Biodiversity Conservation',
            'land_use_policy' => 'Land Use Policy'
        );
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
        $this->global['activeMenu'] = 'submissions';
        
        $this->loadViews("author/manuscripts", $this->global, $data, NULL);
    }

    public function payment()
    {
        $data['payments'] = $this->manuscript_model->getAuthorPaymentQueue($this->vendorId);
        $this->global['pageTitle'] = 'Pay Publishing Fee - OJAS';
        $this->global['activeMenu'] = 'authorpayment';
        $this->loadViews("author/payment", $this->global, $data, NULL);
    }

    public function submitPayment($manuscriptId)
    {
        $this->form_validation->set_rules('transactionReference', 'Transaction Reference', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('paymentNote', 'Payment Note', 'trim');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('author/manuscript/payment');
        }

        $ok = $this->manuscript_model->submitAuthorPayment(
            (int)$manuscriptId,
            (int)$this->vendorId,
            $this->input->post('transactionReference', true),
            $this->input->post('paymentNote', true)
        );

        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Payment submitted successfully.' : 'Unable to submit payment for this manuscript.');
        redirect('author/manuscript/payment');
    }
    
    /**
     * Submit new manuscript (Step 1)
     */
    public function submit()
    {
        $data['articleTypes'] = $this->getArticleTypes();
        $data['thematicAreas'] = $this->getThematicAreas();
        
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
        $this->form_validation->set_rules('thematicArea', 'Thematic Area (Section)', 'required');
        
        if($this->form_validation->run() == FALSE) {
            // Reload step 1 with validation errors
            $data['articleTypes'] = $this->getArticleTypes();
            $data['thematicAreas'] = $this->getThematicAreas();
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
                'submission_thematicArea' => $this->input->post('thematicArea'),
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
        $data['authorDefaults'] = $this->getAuthorDefaultsFromAccount($currentUser);
        $data['institutionSuggestions'] = $this->getInstitutionSuggestions();
        
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
    $middle_names = $this->input->post('middle_name');
    $last_names = $this->input->post('last_name');
    $titles = $this->input->post('title');
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
        $email = isset($emails[$index]) ? trim($emails[$index]) : '';
        $institution = isset($institutions[$index]) ? trim($institutions[$index]) : '';
        $country = isset($countries[$index]) ? trim($countries[$index]) : '';

        $title = isset($titles[$index]) ? trim($titles[$index]) : '';
        $middle_name = isset($middle_names[$index]) ? trim($middle_names[$index]) : '';
        $fullName = trim($title . ' ' . $first_name . ' ' . $middle_name . ' ' . $last_names[$index]);

        if(isset($user_ids[$index]) && $user_ids[$index] == 'new') {
            // For new authors, create a temporary record with provided info
            $authorData[] = array(
                'name' => $fullName,
                'email' => $email,
                'institution' => $institution,
                'country' => $country,
                'orcid' => isset($orcids[$index]) ? $orcids[$index] : '',
                'title' => $title,
                'firstName' => $first_name,
                'middleName' => $middle_name,
                'lastName' => isset($last_names[$index]) ? $last_names[$index] : '',
                'isCorresponding' => $isCorresponding,
                'authorOrder' => $index + 1,
                'isNew' => true
            );
        } else {
            // Existing user (including the main author)
            $userId = isset($user_ids[$index]) ? $user_ids[$index] : $this->vendorId;
            
            $authorData[] = array(
                'userId' => $userId,
                'name' => $fullName,
                'email' => $email,
                'institution' => $institution,
                'country' => $country,
                'title' => $title,
                'firstName' => $first_name,
                'middleName' => $middle_name,
                'lastName' => isset($last_names[$index]) ? $last_names[$index] : '',
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

    public function preview()
    {
        if(!$this->session->userdata('submission_title') || !$this->session->userdata('submission_authors')) {
            $this->session->set_flashdata('error', 'Please complete submission steps before preview.');
            redirect('author/manuscript/submit');
        }
        $data['authors'] = json_decode($this->session->userdata('submission_authors'), true);
        $this->global['pageTitle'] = 'Submission Preview - OJAS';
        $this->loadViews("author/submit_preview", $this->global, $data, NULL);
    }

    public function saveDraft()
    {
        if(!$this->session->userdata('submission_title') || !$this->session->userdata('submission_authors')) {
            $this->session->set_flashdata('error', 'Please complete details and authors before saving draft.');
            redirect('author/manuscript/submit');
        }

        $manuscriptId = $this->persistSubmission('draft');
        if (!$manuscriptId) {
            $this->session->set_flashdata('error', 'Could not save draft. Please check your uploaded files and try again.');
            redirect('author/manuscript/step3');
        }

        $this->clearSubmissionSession();
        $this->session->set_flashdata('success', 'Draft saved successfully. You can submit it later from the manuscript details page.');
        redirect('author/manuscript/view/' . (int)$manuscriptId);
    }

    public function submitDraft($manuscriptId)
    {
        $manuscript = $this->manuscript_model->getManuscript((int)$manuscriptId);

        if(!$manuscript) {
            $this->session->set_flashdata('error', 'Manuscript not found');
            redirect('author/manuscript');
        }

        if($manuscript->submittedBy != $this->vendorId && $this->isAdmin != 1) {
            $this->loadThis();
            return;
        }

        if($manuscript->status !== 'draft') {
            $this->session->set_flashdata('error', 'Only draft manuscripts can be submitted.');
            redirect('author/manuscript/view/' . (int)$manuscriptId);
        }

        $this->db->where('manuscriptId', (int)$manuscriptId);
        $this->db->where('fileType', 'main');
        $this->db->where('isDeleted', 0);
        if($this->db->count_all_results('tbl_manuscript_files') < 1) {
            $this->session->set_flashdata('error', 'Please upload a main manuscript file before submitting this draft.');
            redirect('author/manuscript/view/' . (int)$manuscriptId);
        }

        $ok = $this->manuscript_model->updateManuscript((int)$manuscriptId, array('status' => 'submitted'));
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Draft submitted successfully.' : 'Unable to submit draft.');
        redirect('author/manuscript/view/' . (int)$manuscriptId);
    }
    

    public function editDraftDetails($manuscriptId)
    {
        $manuscript = $this->requireAuthorDraft($manuscriptId);
        if (!$manuscript) {
            return;
        }

        $data['manuscript'] = $manuscript;
        $data['articleTypes'] = $this->getArticleTypes();
        $data['thematicAreas'] = $this->getThematicAreas();
        $data['currentDraftStep'] = 1;
        $data['draftStepStatus'] = $this->getDraftStepStatus((int)$manuscriptId, $manuscript);
        $this->global['pageTitle'] = 'Edit Draft Details - OJAS';
        $this->global['activeMenu'] = 'submissions';
        $this->loadViews('author/edit_draft_step1', $this->global, $data, NULL);
    }

    public function updateDraftDetails($manuscriptId)
    {
        $manuscript = $this->requireAuthorDraft($manuscriptId);
        if (!$manuscript) {
            return;
        }

        $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[500]');
        $this->form_validation->set_rules('abstract', 'Abstract', 'trim|required');
        $this->form_validation->set_rules('keywords', 'Keywords', 'trim|required');
        $this->form_validation->set_rules('articleType', 'Article Type', 'required');
        $this->form_validation->set_rules('thematicArea', 'Thematic Area (Section)', 'required');

        if ($this->form_validation->run() == FALSE) {
            return $this->editDraftDetails($manuscriptId);
        }

        $ok = $this->manuscript_model->updateManuscript((int)$manuscriptId, [
            'title' => $this->input->post('title', true),
            'abstract' => $this->input->post('abstract', true),
            'keywords' => $this->input->post('keywords', true),
            'articleType' => $this->input->post('articleType', true),
            'thematicArea' => $this->input->post('thematicArea', true),
            'coverLetter' => $this->input->post('coverLetter', true)
        ]);

        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Step 1 saved. You can now edit co-authors.' : 'Unable to update draft details.');
        redirect('author/manuscript/draft/' . (int)$manuscriptId . '/authors');
    }

    public function editDraftAuthors($manuscriptId)
    {
        $manuscript = $this->requireAuthorDraft($manuscriptId);
        if (!$manuscript) {
            return;
        }

        $data['manuscript'] = $manuscript;
        $data['authors'] = $this->getManuscriptAuthorsForView((int)$manuscriptId);
        $data['institutionSuggestions'] = $this->getInstitutionSuggestions();
        $data['currentDraftStep'] = 2;
        $data['draftStepStatus'] = $this->getDraftStepStatus((int)$manuscriptId, $manuscript);
        $this->global['pageTitle'] = 'Edit Draft Authors - OJAS';
        $this->global['activeMenu'] = 'submissions';
        $this->loadViews('author/edit_draft_step2', $this->global, $data, NULL);
    }

    public function updateDraftAuthors($manuscriptId)
    {
        $manuscript = $this->requireAuthorDraft($manuscriptId);
        if (!$manuscript) {
            return;
        }

        $authorData = $this->buildAuthorDataFromPost();
        if (empty($authorData)) {
            $this->session->set_flashdata('error', 'Please keep at least one author on the draft.');
            redirect('author/manuscript/draft/' . (int)$manuscriptId . '/authors');
            return;
        }

        $ok = $this->manuscript_model->replaceDraftAuthors((int)$manuscriptId, $authorData);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Step 2 saved. You can now manage uploaded files.' : 'Unable to update draft authors.');
        redirect('author/manuscript/draft/' . (int)$manuscriptId . '/files');
    }

    public function editDraftFiles($manuscriptId)
    {
        $manuscript = $this->requireAuthorDraft($manuscriptId);
        if (!$manuscript) {
            return;
        }

        $data['manuscript'] = $manuscript;
        $data['files'] = $this->manuscript_model->getManuscriptFiles((int)$manuscriptId);
        $data['currentDraftStep'] = 3;
        $data['draftStepStatus'] = $this->getDraftStepStatus((int)$manuscriptId, $manuscript);
        $this->global['pageTitle'] = 'Edit Draft Files - OJAS';
        $this->global['activeMenu'] = 'submissions';
        $this->loadViews('author/edit_draft_step3', $this->global, $data, NULL);
    }

    public function updateDraftFiles($manuscriptId)
    {
        $manuscript = $this->requireAuthorDraft($manuscriptId);
        if (!$manuscript) {
            return;
        }

        $uploadMessages = [];
        $success = true;

        if (!empty($_FILES['main_file']['name'])) {
            $mainUpload = $this->file_model->uploadFile((int)$manuscriptId, 'main_file', 'main');
            if ($mainUpload !== true && $mainUpload !== null) {
                $success = false;
                $uploadMessages[] = 'Main file: ' . $mainUpload;
            }
        }

        if (!empty($_FILES['figures_files']['name'][0])) {
            $figuresUpload = $this->handleMultipleFileUpload((int)$manuscriptId, 'figures_files', 'figure');
            if ($figuresUpload !== true) {
                $success = false;
                $uploadMessages[] = 'Figures: ' . $figuresUpload;
            }
        }

        if (!empty($_FILES['supplementary_files']['name'][0])) {
            $supplementaryUpload = $this->handleMultipleFileUpload((int)$manuscriptId, 'supplementary_files', 'supplementary');
            if ($supplementaryUpload !== true) {
                $success = false;
                $uploadMessages[] = 'Supplementary files: ' . $supplementaryUpload;
            }
        }

        if ($success) {
            $this->manuscript_model->updateManuscript((int)$manuscriptId, []);
        }

        $this->session->set_flashdata($success ? 'success' : 'error', $success ? 'Draft files updated successfully.' : implode(' ', $uploadMessages));
        redirect('author/manuscript/draft/' . (int)$manuscriptId . '/files');
    }

    public function deleteDraftFile($manuscriptId, $fileId)
    {
        $manuscript = $this->requireAuthorDraft($manuscriptId);
        if (!$manuscript) {
            return;
        }

        $ok = $this->file_model->deleteManuscriptFile((int)$fileId, (int)$manuscriptId);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Draft file deleted successfully.' : 'Unable to delete draft file.');
        redirect('author/manuscript/draft/' . (int)$manuscriptId . '/files');
    }

    public function deleteDraft($manuscriptId)
    {
        $ok = $this->manuscript_model->deleteDraft((int)$manuscriptId, (int)$this->vendorId, $this->isAdmin == 1);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Draft deleted successfully.' : 'Only your draft manuscripts can be deleted.');
        redirect('author/manuscript');
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

        $manuscriptId = $this->persistSubmission('submitted');
        if(!$manuscriptId) {
            $this->session->set_flashdata('error', 'Failed to submit manuscript. Please check your uploaded files and try again.');
            redirect('author/manuscript/step3');
        }

        // Get the manuscript number for success message
        $manuscript = $this->manuscript_model->getManuscript($manuscriptId);

        // Clear session
        $this->clearSubmissionSession();

        $this->session->set_flashdata('success', 'Manuscript submitted successfully! Manuscript Number: ' . $manuscript->manuscriptNumber);
        redirect('author/manuscript/view/' . $manuscriptId);
    }

    private function persistSubmission($status)
    {
        // Prepare manuscript data
        $manuscriptData = array(
            'title' => $this->session->userdata('submission_title'),
            'abstract' => $this->session->userdata('submission_abstract'),
            'keywords' => $this->session->userdata('submission_keywords'),
            'articleType' => $this->session->userdata('submission_articleType'),
            'thematicArea' => $this->session->userdata('submission_thematicArea'),
            'coverLetter' => $this->session->userdata('submission_coverLetter'),
            'submittedBy' => $this->vendorId,
            'correspondingAuthorId' => $this->vendorId,
            'status' => $status
        );

        $this->db->trans_begin();

        // Insert manuscript
        $manuscriptId = $this->manuscript_model->submit($manuscriptData);
        if(!$manuscriptId) {
            $this->db->trans_rollback();
            return false;
        }

        // Upload main file when provided. Drafts may be saved before a file is selected.
        if(!empty($_FILES['main_file']['name'])) {
            $mainUpload = $this->file_model->uploadFile($manuscriptId, 'main_file', 'main');
            if($mainUpload !== true && $mainUpload !== null) {
                log_message('error', 'Manuscript file upload failed while saving ' . $status . ': ' . $mainUpload);
                $this->db->trans_rollback();
                return false;
            }
        }

        // Upload figures files if any
        if(!empty($_FILES['figures_files']['name'][0])) {
            $figuresUpload = $this->handleMultipleFileUpload($manuscriptId, 'figures_files', 'figure');
            if($figuresUpload !== true) {
                log_message('error', 'Figure upload failed while saving ' . $status . ': ' . $figuresUpload);
                $this->db->trans_rollback();
                return false;
            }
        }

        // Upload supplementary files if any
        if(!empty($_FILES['supplementary_files']['name'][0])) {
            $supplementaryUpload = $this->handleMultipleFileUpload($manuscriptId, 'supplementary_files', 'supplementary');
            if($supplementaryUpload !== true) {
                log_message('error', 'Supplementary upload failed while saving ' . $status . ': ' . $supplementaryUpload);
                $this->db->trans_rollback();
                return false;
            }
        }

        $this->saveSubmissionAuthors($manuscriptId);

        if($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return $manuscriptId;
    }

    private function saveSubmissionAuthors($manuscriptId)
    {
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
    }

    private function clearSubmissionSession()
    {
        $this->session->unset_userdata([
            'submission_title', 'submission_abstract', 'submission_keywords',
            'submission_articleType', 'submission_thematicArea', 'submission_coverLetter', 'submission_authors'
        ]);
    }

    /**
     * Handle multiple file uploads
     */
    private function handleMultipleFileUpload($manuscriptId, $fieldName, $fileType)
    {
        $files = $_FILES[$fieldName];
        $fileCount = count($files['name']);
        
        for($i = 0; $i < $fileCount; $i++) {
            if(empty($files['name'][$i])) {
                continue;
            }

            $_FILES['single_file']['name'] = $files['name'][$i];
            $_FILES['single_file']['type'] = $files['type'][$i];
            $_FILES['single_file']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['single_file']['error'] = $files['error'][$i];
            $_FILES['single_file']['size'] = $files['size'][$i];
            
            $upload = $this->file_model->uploadFile($manuscriptId, 'single_file', $fileType);
            if($upload !== true && $upload !== null) {
                return $upload;
            }
        }

        return true;
    }

    private function getInstitutionSuggestions()
    {
        $rows = $this->db->distinct()->select('institution')->from('tbl_users')->where("institution IS NOT NULL AND TRIM(institution) != ''", null, false)->get()->result();
        return array_values(array_filter(array_map(function ($row) {
            return trim($row->institution);
        }, $rows)));
    }
    

    private function getAuthorDefaultsFromAccount($currentUser)
    {
        $defaults = array(
            'title' => 'Mr',
            'firstName' => '',
            'middleName' => '',
            'lastName' => '',
            'email' => '',
            'country' => ''
        );

        if (!$currentUser) {
            return $defaults;
        }

        $name = trim((string)$currentUser->name);
        if ($name !== '') {
            $parts = preg_split('/\s+/', $name);
            if (count($parts) === 1) {
                $defaults['firstName'] = $parts[0];
            } elseif (count($parts) === 2) {
                $defaults['firstName'] = $parts[0];
                $defaults['lastName'] = $parts[1];
            } else {
                $defaults['firstName'] = array_shift($parts);
                $defaults['lastName'] = array_pop($parts);
                $defaults['middleName'] = implode(' ', $parts);
            }
        }

        $defaults['email'] = isset($currentUser->email) ? (string)$currentUser->email : '';
        $defaults['country'] = isset($currentUser->country) ? (string)$currentUser->country : '';

        return $defaults;
    }


    private function requireAuthorDraft($manuscriptId)
    {
        $manuscript = $this->manuscript_model->getAuthorDraft((int)$manuscriptId, (int)$this->vendorId, $this->isAdmin == 1);
        if (!$manuscript) {
            $this->session->set_flashdata('error', 'Draft manuscript not found or not editable.');
            redirect('author/manuscript');
            return false;
        }

        return $manuscript;
    }


    private function getDraftStepStatus($manuscriptId, $manuscript = null)
    {
        if ($manuscript === null) {
            $manuscript = $this->manuscript_model->getManuscript((int)$manuscriptId);
        }

        $detailsComplete = !empty($manuscript)
            && trim((string)$manuscript->title) !== ''
            && trim((string)$manuscript->abstract) !== ''
            && trim((string)$manuscript->keywords) !== ''
            && trim((string)$manuscript->articleType) !== ''
            && trim((string)$manuscript->thematicArea) !== '';

        $registeredAuthors = $this->db->where('manuscriptId', (int)$manuscriptId)->count_all_results('tbl_manuscript_authors');
        $nonRegisteredAuthors = 0;
        if ($this->db->table_exists('tbl_manuscript_author_details')) {
            $nonRegisteredAuthors = $this->db->where('manuscriptId', (int)$manuscriptId)->count_all_results('tbl_manuscript_author_details');
        }

        $uploadedFiles = $this->db->where('manuscriptId', (int)$manuscriptId)
            ->where('isDeleted', 0)
            ->count_all_results('tbl_manuscript_files');

        return [
            'detailsComplete' => $detailsComplete,
            'authorsComplete' => ($registeredAuthors + $nonRegisteredAuthors) > 0,
            'filesUploaded' => $uploadedFiles > 0
        ];
    }

    private function getManuscriptAuthorsForView($manuscriptId)
    {
        $this->db->select('u.userId, u.name, u.email, u.institution, u.country, NULL as orcid, ma.isCorresponding, ma.authorOrder, 0 as isNew', false);
        $this->db->from('tbl_manuscript_authors ma');
        $this->db->join('tbl_users u', 'ma.userId = u.userId');
        $this->db->where('ma.manuscriptId', $manuscriptId);
        $registered = $this->db->get()->result();

        $nonRegistered = [];
        if ($this->db->table_exists('tbl_manuscript_author_details')) {
            $this->db->select('NULL as userId, name, email, institution, country, orcid, isCorresponding, authorOrder, 1 as isNew', false);
            $this->db->where('manuscriptId', $manuscriptId);
            $nonRegistered = $this->db->get('tbl_manuscript_author_details')->result();
        }

        $authors = array_merge($registered, $nonRegistered);
        usort($authors, function($a, $b) {
            return (int)$a->authorOrder - (int)$b->authorOrder;
        });

        return $authors;
    }

    private function buildAuthorDataFromPost()
    {
        $first_names = (array)$this->input->post('first_name');
        $middle_names = (array)$this->input->post('middle_name');
        $last_names = (array)$this->input->post('last_name');
        $titles = (array)$this->input->post('title');
        $emails = (array)$this->input->post('email');
        $institutions = (array)$this->input->post('institution');
        $orcids = (array)$this->input->post('orcid');
        $countries = (array)$this->input->post('country');
        $user_ids = (array)$this->input->post('user_id');
        $corresponding_index = $this->input->post('corresponding');

        $authorData = array();
        $hasCorresponding = false;
        $order = 1;

        foreach ($first_names as $index => $first_name) {
            $first_name = trim((string)$first_name);
            $last_name = isset($last_names[$index]) ? trim((string)$last_names[$index]) : '';
            $email = isset($emails[$index]) ? trim((string)$emails[$index]) : '';

            if ($first_name === '' && $last_name === '' && $email === '') {
                continue;
            }

            $isCorresponding = 0;
            if ($corresponding_index !== null && (string)$corresponding_index === (string)$index) {
                $isCorresponding = 1;
                $hasCorresponding = true;
            }

            if (!$hasCorresponding && empty($authorData)) {
                $isCorresponding = 1;
                $hasCorresponding = true;
            }

            $title = isset($titles[$index]) ? trim((string)$titles[$index]) : '';
            $middle_name = isset($middle_names[$index]) ? trim((string)$middle_names[$index]) : '';
            $fullName = trim($title . ' ' . $first_name . ' ' . $middle_name . ' ' . $last_name);
            $userId = isset($user_ids[$index]) ? $user_ids[$index] : 'new';

            if ($userId === 'new' || $userId === '' || !is_numeric($userId)) {
                $authorData[] = array(
                    'name' => $fullName,
                    'email' => $email,
                    'institution' => isset($institutions[$index]) ? trim((string)$institutions[$index]) : '',
                    'country' => isset($countries[$index]) ? trim((string)$countries[$index]) : '',
                    'orcid' => isset($orcids[$index]) ? trim((string)$orcids[$index]) : '',
                    'isCorresponding' => $isCorresponding,
                    'authorOrder' => $order++,
                    'isNew' => true
                );
            } else {
                $authorData[] = array(
                    'userId' => (int)$userId,
                    'name' => $fullName,
                    'email' => $email,
                    'institution' => isset($institutions[$index]) ? trim((string)$institutions[$index]) : '',
                    'country' => isset($countries[$index]) ? trim((string)$countries[$index]) : '',
                    'isCorresponding' => $isCorresponding,
                    'authorOrder' => $order++
                );
            }
        }

        return $authorData;
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
        
        if($manuscript->status === 'draft') {
            redirect('author/manuscript/draft/' . (int)$manuscriptId . '/details');
        }

        $data['manuscript'] = $manuscript;
        $data['files'] = $this->manuscript_model->getManuscriptFiles($manuscriptId);
        $data['reviewComments'] = $this->manuscript_model->getManuscriptReviewerComments($manuscriptId);
        
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
        $this->global['activeMenu'] = 'submissions';
        
        $this->loadViews("author/view_manuscript", $this->global, $data, NULL);
    }

    public function revisionNotifications()
    {
        $authorId = $this->vendorId;
        $data['manuscripts'] = $this->manuscript_model->getAuthorRevisionNotifications($authorId);
        $this->global['pageTitle'] = 'Revision Notifications - OJAS';
        $this->global['activeMenu'] = 'revisionNotifications';
        $this->loadViews("author/revision_notifications", $this->global, $data, NULL);
    }

    public function resubmitRevision($manuscriptId)
    {
        $manuscript = $this->manuscript_model->getManuscript((int)$manuscriptId);
        if (!$manuscript || (int)$manuscript->submittedBy !== (int)$this->vendorId || $manuscript->status !== 'revision_required') {
            $this->session->set_flashdata('error', 'This manuscript is not available for revision resubmission.');
            redirect('author/manuscript/revision-notifications');
        }

        if (empty($_FILES['revised_main_file']['name'])) {
            $this->session->set_flashdata('error', 'Please upload a revised manuscript file.');
            redirect('author/manuscript/revision-notifications');
        }

        $upload = $this->file_model->uploadFile((int)$manuscriptId, 'revised_main_file', 'revised_main');
        if ($upload !== true) {
            $this->session->set_flashdata('error', 'Revision upload failed: ' . $upload);
            redirect('author/manuscript/revision-notifications');
        }

        $response = trim((string)$this->input->post('authorRevisionResponse', true));
        $this->manuscript_model->markRevisionResubmitted((int)$manuscriptId, (int)$this->vendorId, $response);

        $reviewers = $this->db->select('reviewerId')
            ->from('tbl_reviewer_assignments')
            ->where('manuscriptId', (int)$manuscriptId)
            ->where('isDeleted', 0)
            ->get()->result();

        foreach ($reviewers as $reviewer) {
            $this->db->insert('tbl_notifications', [
                'userId' => $reviewer->reviewerId,
                'type' => 'revision_resubmitted',
                'subject' => 'Revised manuscript is available for your review',
                'message' => 'The author resubmitted manuscript ' . $manuscript->manuscriptNumber . '. You can continue reviewing without new assignment.',
                'referenceId' => (int)$manuscriptId,
                'referenceType' => 'manuscript',
                'createdDtm' => date('Y-m-d H:i:s')
            ]);
        }

        if (!empty($manuscript->assignedEditorId)) {
            $this->db->insert('tbl_notifications', [
                'userId' => $manuscript->assignedEditorId,
                'type' => 'revision_resubmitted',
                'subject' => 'Author revised manuscript resubmitted',
                'message' => 'Manuscript ' . $manuscript->manuscriptNumber . ' was resubmitted and returned to review workflow.',
                'referenceId' => (int)$manuscriptId,
                'referenceType' => 'manuscript',
                'createdDtm' => date('Y-m-d H:i:s')
            ]);
        }

        $this->session->set_flashdata('success', 'Revision submitted successfully. Reviewers have been notified.');
        redirect('author/manuscript/revision-notifications');
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
