<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Chief extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();

        if ((!$this->isEditorInChief() && !$this->isAdmin())) {
            $this->loadThis();
            return;
        }

        $this->load->model('editor_model');
        $this->load->library('form_validation');
    }

    public function board()
    {
        $data['boardMembers'] = $this->editor_model->getEditorialBoardMembers();
        $data['stats'] = $this->editor_model->getDashboardStats();
        $this->global['pageTitle'] = 'Editorial Board - OJAS';
        $this->global['activeMenu'] = 'editorboard';
        $this->loadViews('editor/board', $this->global, $data, NULL);
    }

    public function ethics()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('title', 'Case Title', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('details', 'Case Details', 'trim|required|min_length[10]');

            if ($this->form_validation->run() !== false) {
                $ok = $this->editor_model->createEthicsCase(
                    $this->vendorId,
                    $this->input->post('title', true),
                    $this->input->post('details', true),
                    $this->input->post('manuscriptId')
                );
                $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Ethics case logged.' : 'Failed to log ethics case.');
                redirect('editor/ethics');
            }
        }

        $data['cases'] = $this->editor_model->getEthicsCases();
        $data['manuscripts'] = $this->editor_model->getAllManuscripts();
        $this->global['pageTitle'] = 'Ethics Cases - OJAS';
        $this->global['activeMenu'] = 'ethics';
        $this->loadViews('editor/ethics', $this->global, $data, NULL);
    }

    public function overrideDecision($manuscriptId)
    {
        $this->form_validation->set_rules('status', 'Override Status', 'required|in_list[accepted,rejected,revision_required,under_review]');
        $this->form_validation->set_rules('reason', 'Reason', 'trim|required|min_length[10]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('editor/board');
        }

        $ok = $this->editor_model->overrideDecision(
            $manuscriptId,
            $this->vendorId,
            $this->input->post('status', true),
            $this->input->post('reason', true)
        );

        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Decision overridden successfully.' : 'Failed to override decision.');
        redirect('editor/board');
    }

    public function policies()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('policyKey', 'Policy Key', 'trim|required|alpha_dash');
            $this->form_validation->set_rules('policyTitle', 'Policy Title', 'trim|required|min_length[5]');
            $this->form_validation->set_rules('policyContent', 'Policy Content', 'trim|required|min_length[10]');

            if ($this->form_validation->run() !== false) {
                $ok = $this->editor_model->savePolicy(
                    $this->vendorId,
                    $this->input->post('policyKey', true),
                    $this->input->post('policyTitle', true),
                    $this->input->post('policyContent', true)
                );

                $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Policy saved.' : 'Failed to save policy.');
                redirect('editor/policies');
            }
        }

        $data['policies'] = $this->editor_model->getJournalPolicies();
        $this->global['pageTitle'] = 'Journal Policies - OJAS';
        $this->global['activeMenu'] = 'policies';
        $this->loadViews('editor/policies', $this->global, $data, NULL);
    }
}
