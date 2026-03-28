<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Manuscript extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();

        if (!$this->isEditor() && !$this->isAdmin()) {
            $this->loadThis();
            return;
        }

        $this->load->model('editor_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['manuscripts'] = $this->editor_model->getAllManuscripts();
        $this->global['pageTitle'] = 'All Manuscripts - OJAS';
        $this->global['activeMenu'] = 'allmanuscripts';
        $this->loadViews('editor/manuscripts', $this->global, $data, NULL);
    }

    public function pending()
    {
        $data['manuscripts'] = $this->editor_model->getPendingManuscripts();
        $this->global['pageTitle'] = 'Pending Manuscripts - OJAS';
        $this->global['activeMenu'] = 'pending';
        $this->loadViews('editor/pending', $this->global, $data, NULL);
    }

    public function view($manuscriptId)
    {
        $data['manuscript'] = $this->editor_model->getManuscript($manuscriptId);
        if (!$data['manuscript']) {
            $this->session->set_flashdata('error', 'Manuscript not found.');
            redirect('editor/all-manuscripts');
        }

        $data['assignments'] = $this->editor_model->getReviewerAssignments($manuscriptId);
        $data['reviewers'] = $this->editor_model->getAvailableReviewers();

        $this->global['pageTitle'] = 'Manuscript Details - OJAS';
        $this->global['activeMenu'] = 'allmanuscripts';
        $this->loadViews('editor/manuscript_view', $this->global, $data, NULL);
    }

    public function reviewProgress()
    {
        $data['assignments'] = $this->editor_model->getReviewProgressList();
        $this->global['pageTitle'] = 'Track Review Progress - OJAS';
        $this->global['activeMenu'] = 'reviewprogress';
        $this->loadViews('editor/review_progress', $this->global, $data, NULL);
    }

    public function reviewProgressView($manuscriptId)
    {
        $data['manuscript'] = $this->editor_model->getManuscript((int)$manuscriptId);
        if (!$data['manuscript']) {
            $this->session->set_flashdata('error', 'Manuscript not found.');
            redirect('editor/assignments');
        }

        $data['reviews'] = $this->editor_model->getReviewProgressDetails((int)$manuscriptId);
        $this->global['pageTitle'] = 'Review Progress Details - OJAS';
        $this->global['activeMenu'] = 'reviewprogress';
        $this->loadViews('editor/review_progress_view', $this->global, $data, NULL);
    }

    public function reviewProgressDecision($manuscriptId)
    {
        $this->form_validation->set_rules('decision', 'Decision', 'required|in_list[accept,reject,rereview,minor_review,major_review]');
        $this->form_validation->set_rules('decisionReason', 'Decision Note', 'trim|required|min_length[10]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('editor/assignments/view/' . (int)$manuscriptId);
        }

        $ok = $this->editor_model->applyProgressDecision(
            (int)$manuscriptId,
            (int)$this->vendorId,
            $this->input->post('decision', true),
            $this->input->post('decisionReason', true)
        );

        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Editorial decision saved successfully.' : 'Failed to save editorial decision.');
        redirect('editor/assignments/view/' . (int)$manuscriptId);
    }

    public function payment()
    {
        $data['payments'] = $this->editor_model->getPaymentQueue();
        $this->global['pageTitle'] = 'Payment Queue - OJAS';
        $this->global['activeMenu'] = 'payment';
        $this->loadViews('editor/payment', $this->global, $data, NULL);
    }

    public function screening($manuscriptId)
    {
        $this->form_validation->set_rules('screeningStatus', 'Screening Status', 'required|in_list[pending,passed,failed]');
        $this->form_validation->set_rules('screeningNotes', 'Screening Notes', 'trim|required|min_length[5]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('editor/manuscript/' . (int)$manuscriptId);
        }

        $ok = $this->editor_model->runInitialScreening(
            $manuscriptId,
            $this->vendorId,
            $this->input->post('screeningStatus', true),
            $this->input->post('screeningNotes', true)
        );

        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Initial screening saved.' : 'Failed to save screening.');
        redirect('editor/manuscript/' . (int)$manuscriptId);
    }

    public function plagiarism($manuscriptId)
    {
        $this->form_validation->set_rules('plagiarismScore', 'Plagiarism Score', 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('editor/manuscript/' . (int)$manuscriptId);
        }

        $ok = $this->editor_model->savePlagiarismScore($manuscriptId, $this->vendorId, $this->input->post('plagiarismScore'));
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Plagiarism score updated.' : 'Failed to update score.');
        redirect('editor/manuscript/' . (int)$manuscriptId);
    }

    public function assignReviewers($manuscriptId)
    {
        $reviewerIds = $this->input->post('reviewerIds');
        $dueDate = $this->input->post('reviewDueDate', true);

        if (!is_array($reviewerIds) || count($reviewerIds) < 2 || count($reviewerIds) > 3) {
            $this->session->set_flashdata('error', 'Assign 2 to 3 reviewers per manuscript.');
            redirect('editor/manuscript/' . (int)$manuscriptId);
        }

        if (empty($dueDate)) {
            $this->session->set_flashdata('error', 'Review due date is required.');
            redirect('editor/manuscript/' . (int)$manuscriptId);
        }

        $assigned = $this->editor_model->assignReviewers($manuscriptId, $this->vendorId, $reviewerIds, $dueDate);
        $message = $assigned > 0 ? $assigned . ' reviewer(s) assigned successfully.' : 'Selected reviewers were already assigned.';
        $this->session->set_flashdata($assigned > 0 ? 'success' : 'error', $message);
        redirect('editor/manuscript/' . (int)$manuscriptId);
    }

    public function makeDecision($manuscriptId)
    {
        $this->form_validation->set_rules('decision', 'Decision', 'required|in_list[accept,reject,revision]');
        $this->form_validation->set_rules('decisionLetter', 'Decision Letter', 'trim|required|min_length[10]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('editor/manuscript/' . (int)$manuscriptId);
        }

        $ok = $this->editor_model->makeDecision(
            $manuscriptId,
            $this->vendorId,
            $this->input->post('decision', true),
            $this->input->post('decisionLetter', true)
        );

        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Decision recorded and letter sent.' : 'Failed to process decision.');
        redirect('editor/manuscript/' . (int)$manuscriptId);
    }

    public function approveReview($manuscriptId, $assignmentId)
    {
        $this->form_validation->set_rules('approvalStatus', 'Approval Status', 'required|in_list[approved,rejected]');
        $this->form_validation->set_rules('approvalReason', 'Approval Reason', 'trim|required|min_length[5]');

        $approvalStatus = $this->input->post('approvalStatus', true);
        if ($approvalStatus === 'approved') {
            $this->form_validation->set_rules('editorSetPrice', 'Price', 'required|numeric|greater_than[0]');
        }

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('editor/manuscript/' . (int)$manuscriptId);
        }

        $price = $approvalStatus === 'approved' ? (float)$this->input->post('editorSetPrice') : null;
        $ok = $this->editor_model->processReviewApproval(
            (int)$assignmentId,
            $this->vendorId,
            $approvalStatus,
            $this->input->post('approvalReason', true),
            $price
        );

        if ($ok) {
            $msg = $approvalStatus === 'approved'
                ? 'Review comments approved. Sent to payment gateway queue with editor-defined price.'
                : 'Review comments rejected and reviewer notified.';
            $this->session->set_flashdata('success', $msg);
        } else {
            $this->session->set_flashdata('error', 'Failed to process review approval. Ensure review is completed first.');
        }

        redirect('editor/assignments/view/' . (int)$manuscriptId);
    }
}
