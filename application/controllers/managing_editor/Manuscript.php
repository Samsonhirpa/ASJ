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


    public function screened()
    {
        $data['filters'] = ['status' => 'all', 'q' => '', 'articleType' => ''];
        $data['stats'] = $this->editor_model->getManagingEditorDashboardStats();
        $data['manuscripts'] = $this->editor_model->getManagingEditorPendingManuscripts(['status' => 'passed']);
        $this->global['pageTitle'] = 'Screened Manuscripts - OJAS';
        $this->global['activeMenu'] = 'meScreened';
        $this->loadViews('managing_editor/screened', $this->global, $data, NULL);
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

        $this->form_validation->set_rules('formattingNotes', 'Formatting Notes', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('completenessNotes', 'Completeness Notes', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('qualityNotes', 'Quality Notes', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('templateNotes', 'Template Check Notes', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('comments', 'Comments', 'trim|required|min_length[10]');
        $this->form_validation->set_rules('meDecision', 'Managing Editor Decision', 'required|in_list[approved,rejected]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('managing-editor/pending/screen/' . $manuscriptId);
        }

        $uploadPath = $this->uploadResultComment();
        if ($uploadPath === false) {
            redirect('managing-editor/pending/screen/' . $manuscriptId);
        }

        $scores = [
            'formattingScore' => 0,
            'completenessScore' => 0,
            'qualityScore' => 0,
            'templateScore' => 0
        ];
        $meDecision = $this->input->post('meDecision', true);
        $compiledComments = "Formatting Notes:\n" . $this->input->post('formattingNotes', true)
            . "\n\nCompleteness Notes:\n" . $this->input->post('completenessNotes', true)
            . "\n\nQuality Notes:\n" . $this->input->post('qualityNotes', true)
            . "\n\nTemplate Check Notes:\n" . $this->input->post('templateNotes', true)
            . "\n\nGeneral Comments:\n" . $this->input->post('comments', true);

        $ok = $this->editor_model->saveManagingEditorScreening(
            $manuscriptId,
            (int)$this->vendorId,
            $scores,
            $compiledComments,
            $uploadPath,
            $meDecision
        );
        $message = $ok
            ? 'Managing Editor screening saved as ' . ucfirst($meDecision) . '.'
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
