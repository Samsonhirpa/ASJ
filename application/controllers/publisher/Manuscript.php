<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manuscript extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('Editor_model', 'editor_model');
        $this->load->model('Issue_model', 'issue_model');
    }

    private function guardPublisher()
    {
        if ((int)$this->role !== 17 && !$this->isAdmin()) {
            $this->loadThis();
            return false;
        }
        return true;
    }

    public function pendingProduction()
    {
        if (!$this->guardPublisher()) { return; }
        $data['manuscripts'] = $this->editor_model->getProductionQueue((int)$this->vendorId, $this->isAdmin());
        $this->global['pageTitle'] = 'Pending Production - OJAS';
        $this->global['activeMenu'] = 'publisherPendingProduction';
        $this->loadViews('publisher/pending_production', $this->global, $data, NULL);
    }

    public function saveProductionStep($manuscriptId)
    {
        if (!$this->guardPublisher()) { return; }
        $_POST['step'] = $this->input->post('step', true);
        // Reuse existing production save logic
        redirect('editor/production-stage/save/' . (int)$manuscriptId);
    }

    public function manageIssues()
    {
        if (!$this->guardPublisher()) { return; }
        $data['issues'] = $this->issue_model->get_issues(false);
        $this->global['pageTitle'] = 'Manage Issues - OJAS';
        $this->global['activeMenu'] = 'publisherManageIssues';
        $this->loadViews('publisher/manage_issues', $this->global, $data, NULL);
    }

    public function saveIssue()
    {
        if (!$this->guardPublisher()) { return; }
        $issueId = (int)$this->input->post('issueId');
        $payload = [
            'title' => trim((string)$this->input->post('title')),
            'volume' => (int)$this->input->post('volume'),
            'issueNumber' => (int)$this->input->post('issueNumber'),
            'year' => (int)$this->input->post('year'),
            'month' => trim((string)$this->input->post('month')),
            'status' => $this->input->post('status', true) === 'published' ? 'published' : 'draft'
        ];
        if ($payload['status'] === 'published') {
            $payload['publishedDate'] = date('Y-m-d');
        }
        $ok = $issueId > 0
            ? $this->issue_model->update_issue($issueId, $payload, (int)$this->vendorId)
            : $this->issue_model->create_issue($payload, (int)$this->vendorId);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Issue saved successfully.' : 'Failed to save issue.');
        redirect('publisher/issues');
    }

    public function deleteIssue($issueId)
    {
        if (!$this->guardPublisher()) { return; }
        $ok = $this->issue_model->delete_issue((int)$issueId, (int)$this->vendorId);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Issue deleted successfully.' : 'Failed to delete issue.');
        redirect('publisher/issues');
    }

    public function publish()
    {
        if (!$this->guardPublisher()) { return; }
        $data['manuscripts'] = $this->editor_model->getProductionReadyManuscripts((int)$this->vendorId, $this->isAdmin());
        $data['issues'] = $this->issue_model->get_issues(false);
        $this->global['pageTitle'] = 'Final Publishing - OJAS';
        $this->global['activeMenu'] = 'publisherPublish';
        $this->loadViews('publisher/publish', $this->global, $data, NULL);
    }

    public function publishedContent()
    {
        if (!$this->guardPublisher()) { return; }
        $data['manuscripts'] = $this->editor_model->getPublishedManuscripts();
        $this->global['pageTitle'] = 'Manage Published Content - OJAS';
        $this->global['activeMenu'] = 'publisherPublishedContent';
        $this->loadViews('publisher/published_content', $this->global, $data, NULL);
    }
}
