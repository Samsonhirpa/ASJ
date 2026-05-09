<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manuscript extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();

        if (!$this->hasRole(self::ROLE_MANAGING_EDITOR) && !$this->isAdmin()) {
            $this->loadThis();
            return;
        }

        $this->load->model('editor_model');
        $this->load->library('form_validation');
    }

    public function pending()
    {
        $filters = [
            'q' => $this->input->get('q', true),
            'status' => $this->input->get('status', true) ?: 'pending',
            'articleType' => $this->input->get('articleType', true)
        ];

        $data['filters'] = $filters;
        $data['stats'] = $this->editor_model->getManagingEditorDashboardStats();
        $data['manuscripts'] = $this->editor_model->getManagingEditorPendingManuscripts($filters);

        $this->global['pageTitle'] = 'Managing Editor Pending Manuscripts - OJAS';
        $this->global['activeMenu'] = 'mePending';
        $this->loadViews('managing_editor/pending', $this->global, $data, NULL);
    }

    public function screen($manuscriptId)
    {
        $manuscriptId = (int)$manuscriptId;
        $data['manuscript'] = $this->editor_model->getManuscript($manuscriptId);
        if (!$data['manuscript'] || $data['manuscript']->eicScreeningDecision !== 'accepted') {
            $this->session->set_flashdata('error', 'Only manuscripts accepted by the Editor-in-Chief are available for Managing Editor screening.');
            redirect('managing-editor/pending');
        }

        $data['files'] = $this->editor_model->getManuscriptFiles($manuscriptId);
        $data['screening'] = $this->editor_model->getManagingEditorScreening($manuscriptId);
        if (!empty($data['screening'])) {
            $this->session->set_flashdata('error', 'Screening result is already registered for this manuscript and cannot be submitted again.');
            redirect('managing-editor/pending');
        }
        $this->global['pageTitle'] = 'Managing Editor Screening - OJAS';
        $this->global['activeMenu'] = 'mePending';
        $this->loadViews('managing_editor/screen', $this->global, $data, NULL);
    }

    public function saveScreening($manuscriptId)
    {
        $manuscriptId = (int)$manuscriptId;
        $existing = $this->editor_model->getManagingEditorScreening($manuscriptId);
        if (!empty($existing)) {
            $this->session->set_flashdata('error', 'Screening result is already registered for this manuscript and cannot be submitted again.');
            redirect('managing-editor/pending');
        }

        $scoreRules = 'required|integer|greater_than_equal_to[0]|less_than_equal_to[25]';
        $this->form_validation->set_rules('formattingScore', 'Formatting Score', $scoreRules);
        $this->form_validation->set_rules('completenessScore', 'Completeness Score', $scoreRules);
        $this->form_validation->set_rules('qualityScore', 'Quality Score', $scoreRules);
        $this->form_validation->set_rules('templateScore', 'Template Check Score', $scoreRules);
        $this->form_validation->set_rules('comments', 'Comments', 'trim|required|min_length[10]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('managing-editor/pending/screen/' . $manuscriptId);
        }

        $uploadPath = $this->uploadResultComment();
        if ($uploadPath === false) {
            redirect('managing-editor/pending/screen/' . $manuscriptId);
        }

        $scores = [
            'formattingScore' => (int)$this->input->post('formattingScore'),
            'completenessScore' => (int)$this->input->post('completenessScore'),
            'qualityScore' => (int)$this->input->post('qualityScore'),
            'templateScore' => (int)$this->input->post('templateScore')
        ];

        $ok = $this->editor_model->saveManagingEditorScreening(
            $manuscriptId,
            (int)$this->vendorId,
            $scores,
            $this->input->post('comments', true),
            $uploadPath
        );

        $total = array_sum($scores);
        $message = $ok
            ? 'Managing Editor screening saved with a total score of ' . $total . '/100.'
            : 'Failed to save Managing Editor screening. Confirm the manuscript was accepted by the Editor-in-Chief.';
        $this->session->set_flashdata($ok ? 'success' : 'error', $message);
        redirect('managing-editor/pending');
    }

    private function uploadResultComment()
    {
        if (empty($_FILES['resultComment']['name'])) {
            return null;
        }

        if (!is_dir('./uploads/managing_editor/')) {
            mkdir('./uploads/managing_editor/', 0777, true);
        }

        $config['upload_path'] = './uploads/managing_editor/';
        $config['allowed_types'] = 'pdf|doc|docx|txt|jpg|jpeg|png';
        $config['max_size'] = 5120;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('resultComment')) {
            $fileData = $this->upload->data();
            return 'uploads/managing_editor/' . $fileData['file_name'];
        }

        $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
        return false;
    }
}
