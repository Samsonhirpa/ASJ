<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Issue extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Issue_model', 'issue_model');
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    private function ensureAdmin()
    {
        if (!$this->isAdmin()) {
            $this->loadThis();
            return false;
        }
        return true;
    }

    public function index()
    {
        if (!$this->ensureAdmin()) {
            return;
        }

        $data['issues'] = $this->issue_model->get_issues(false);
        $this->global['pageTitle'] = 'Journal Issues - OJAS';
        $this->global['activeMenu'] = 'issues';
        $this->loadViews('admin/issues/index', $this->global, $data, NULL);
    }

    public function create()
    {
        if (!$this->ensureAdmin()) {
            return;
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('volume', 'Volume', 'trim|required|integer|greater_than[0]');
            $this->form_validation->set_rules('issueNumber', 'Issue Number', 'trim|required|integer|greater_than[0]');
            $this->form_validation->set_rules('year', 'Year', 'trim|required|integer|greater_than[1900]|less_than_equal_to[2100]');
            $this->form_validation->set_rules('month', 'Month', 'trim');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[255]');
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[draft,published]');

            if ($this->form_validation->run() !== false) {
                $status = $this->input->post('status', true);
                $saved = $this->issue_model->create_issue([
                    'volume' => (int)$this->input->post('volume'),
                    'issueNumber' => (int)$this->input->post('issueNumber'),
                    'year' => (int)$this->input->post('year'),
                    'month' => $this->input->post('month', true),
                    'title' => $this->input->post('title', true),
                    'description' => $this->input->post('description', true),
                    'status' => $status,
                    'publishedDate' => $status === 'published' ? date('Y-m-d') : null
                ], (int)$this->vendorId);

                $this->session->set_flashdata($saved ? 'success' : 'error', $saved ? 'Issue created successfully.' : 'Failed to create issue.');
                redirect('admin/issues');
            }
        }

        $data['issue'] = null;
        $data['formAction'] = base_url('admin/issues/create');
        $data['formTitle'] = 'Create Journal Issue';
        $this->global['pageTitle'] = 'Create Journal Issue - OJAS';
        $this->global['activeMenu'] = 'issues';
        $this->loadViews('admin/issues/form', $this->global, $data, NULL);
    }

    public function edit($issueId)
    {
        if (!$this->ensureAdmin()) {
            return;
        }

        $issue = $this->issue_model->get_issue((int)$issueId);
        if (!$issue) {
            $this->session->set_flashdata('error', 'Issue not found.');
            redirect('admin/issues');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('volume', 'Volume', 'trim|required|integer|greater_than[0]');
            $this->form_validation->set_rules('issueNumber', 'Issue Number', 'trim|required|integer|greater_than[0]');
            $this->form_validation->set_rules('year', 'Year', 'trim|required|integer|greater_than[1900]|less_than_equal_to[2100]');
            $this->form_validation->set_rules('month', 'Month', 'trim');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|max_length[255]');
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|in_list[draft,published]');

            if ($this->form_validation->run() !== false) {
                $status = $this->input->post('status', true);
                $payload = [
                    'volume' => (int)$this->input->post('volume'),
                    'issueNumber' => (int)$this->input->post('issueNumber'),
                    'year' => (int)$this->input->post('year'),
                    'month' => $this->input->post('month', true),
                    'title' => $this->input->post('title', true),
                    'description' => $this->input->post('description', true),
                    'status' => $status
                ];
                if ($status === 'published' && empty($issue->publishedDate)) {
                    $payload['publishedDate'] = date('Y-m-d');
                }

                $saved = $this->issue_model->update_issue((int)$issueId, $payload, (int)$this->vendorId);
                $this->session->set_flashdata($saved ? 'success' : 'error', $saved ? 'Issue updated successfully.' : 'Failed to update issue.');
                redirect('admin/issues');
            }
        }

        $data['issue'] = $issue;
        $data['formAction'] = base_url('admin/issues/edit/' . (int)$issueId);
        $data['formTitle'] = 'Edit Journal Issue';
        $this->global['pageTitle'] = 'Edit Journal Issue - OJAS';
        $this->global['activeMenu'] = 'issues';
        $this->loadViews('admin/issues/form', $this->global, $data, NULL);
    }

    public function publish($issueId)
    {
        if (!$this->ensureAdmin()) {
            return;
        }

        $ok = $this->issue_model->publish_issue((int)$issueId, (int)$this->vendorId);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Issue published successfully.' : 'Failed to publish issue.');
        redirect('admin/issues');
    }

    public function delete($issueId)
    {
        if (!$this->ensureAdmin()) {
            return;
        }

        $ok = $this->issue_model->delete_issue((int)$issueId, (int)$this->vendorId);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Issue deleted successfully.' : 'Failed to delete issue.');
        redirect('admin/issues');
    }
}
