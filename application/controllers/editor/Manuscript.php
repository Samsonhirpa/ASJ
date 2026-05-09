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

    public function pendingScreen($manuscriptId)
    {
        if (!$this->isEditorInChief() && !$this->isAdmin()) {
            $this->loadThis();
            return;
        }

        $data['manuscript'] = $this->editor_model->getManuscript((int)$manuscriptId);
        if (!$data['manuscript']) {
            $this->session->set_flashdata('error', 'Manuscript not found.');
            redirect('editor/pending');
        }

        $data['files'] = $this->editor_model->getManuscriptFiles((int)$manuscriptId);
        $data['manuscript']->authorName = 'Blind Review';
        $data['manuscript']->authorEmail = 'Hidden during screening';
        $this->global['pageTitle'] = 'Technical and Scope Screening - OJAS';
        $this->global['activeMenu'] = 'pending';
        $this->loadViews('editor/technical_scope_screening', $this->global, $data, NULL);
    }

    public function technicalScopeScreening($manuscriptId)
    {
        if (!$this->isEditorInChief() && !$this->isAdmin()) {
            $this->loadThis();
            return;
        }

        $this->form_validation->set_rules('decision', 'Screening Decision', 'required|in_list[accept,reject]');
        $this->form_validation->set_rules('technicalNotes', 'Technical Screening Notes', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('scopeNotes', 'Scope Screening Notes', 'trim|required|min_length[5]');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('editor/pending/screen/' . (int)$manuscriptId);
        }

        $decision = $this->input->post('decision', true);
        $ok = $this->editor_model->runTechnicalScopeScreening(
            (int)$manuscriptId,
            (int)$this->vendorId,
            $decision,
            $this->input->post('technicalNotes', true),
            $this->input->post('scopeNotes', true)
        );

        $message = $decision === 'accept'
            ? 'Manuscript accepted by EIC and moved to the Managing Editor pending manuscript queue.'
            : 'Manuscript rejected at technical and scope screening.';
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? $message : 'Failed to save technical and scope screening decision.');
        redirect('editor/pending');
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


    public function managingEditorResults()
    {
        if (!$this->isEditorInChief() && !$this->isAdmin()) {
            $this->loadThis();
            return;
        }

        $status = $this->input->get('status', true) ?: 'all';
        $data['status'] = $status;
        $data['manuscripts'] = $this->editor_model->getManagingEditorScreenedManuscripts($status);
        $this->global['pageTitle'] = 'Managing Editor Results - OJAS';
        $this->global['activeMenu'] = 'meResults';
        $this->loadViews('editor/managing_editor_results', $this->global, $data, NULL);
    }

    public function meResultDecision($manuscriptId)
    {
        if (!$this->isEditorInChief() && !$this->isAdmin()) { $this->loadThis(); return; }
        $decision = $this->input->post('decision', true);
        if (!in_array($decision, ['approved', 'rejected'], true)) {
            $this->session->set_flashdata('error', 'Invalid decision.');
            redirect('editor/me-results');
        }
        $ok = $this->editor_model->updateManagingEditorResultStatus((int)$manuscriptId, (int)$this->vendorId, $decision);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Decision saved.' : 'Failed to save decision.');
        redirect('editor/me-results');
    }

    public function meResultView($manuscriptId)
    {
        if (!$this->isEditorInChief() && !$this->isAdmin()) { $this->loadThis(); return; }
        $data['manuscript'] = $this->editor_model->getMeResultDetail((int)$manuscriptId);
        if (!$data['manuscript']) {
            $this->session->set_flashdata('error', 'Manuscript not found.');
            redirect('editor/me-results');
        }
        $this->global['pageTitle'] = 'Managing Editor Result Detail - OJAS';
        $this->global['activeMenu'] = 'meResults';
        $this->loadViews('editor/me_result_detail', $this->global, $data, NULL);
    }

    public function assignAssociateEditor($manuscriptId)
    {
        if (!$this->isEditorInChief() && !$this->isAdmin()) { $this->loadThis(); return; }
        $manuscript = $this->editor_model->getManuscript((int)$manuscriptId);
        if (!$manuscript || $manuscript->managingEditorScreeningStatus !== 'passed') {
            $this->session->set_flashdata('error', 'Only passed manuscripts can be assigned.');
            redirect('editor/me-results');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('associateEditorId', 'Associate Editor', 'required|integer');
            if ($this->form_validation->run() !== false) {
                $ok = $this->editor_model->assignAssociateEditor((int)$manuscriptId, (int)$this->vendorId, (int)$this->input->post('associateEditorId'));
                if ($ok) {
                    $this->editor_model->notifyAssociateEditorAssignment((int)$manuscriptId, (int)$this->input->post('associateEditorId'));
                }
                $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Associate Editor assigned.' : 'Failed to assign Associate Editor.');
                redirect('editor/me-results');
            }
        }

        $data['manuscript'] = $manuscript;
        $data['associateEditors'] = $this->editor_model->getAvailableAssociateEditors($manuscript->thematicArea);
        $this->global['pageTitle'] = 'Assign Associate Editor - OJAS';
        $this->global['activeMenu'] = 'meResults';
        $this->loadViews('editor/assign_associate_editor', $this->global, $data, NULL);
    }

    public function aeAssignments()
    {
        if ($this->role != 16 && !$this->isAdmin()) { $this->loadThis(); return; }
        $data['assignments'] = $this->editor_model->getAeAssignments((int)$this->vendorId);
        $this->global['pageTitle'] = 'Associate Editor Assignments - OJAS';
        $this->global['activeMenu'] = 'aeAssignments';
        $this->loadViews('editor/ae_assignments', $this->global, $data, NULL);
    }

    public function aeRespond($manuscriptId, $decision)
    {
        if ($this->role != 16 && !$this->isAdmin()) { $this->loadThis(); return; }
        $ok = $this->editor_model->respondAeAssignment((int)$manuscriptId, (int)$this->vendorId, $decision);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Response saved.' : 'Unable to update assignment response.');
        redirect('editor/ae-assignments');
    }

    public function aeAssignmentView($manuscriptId)
    {
        if ($this->role != 16 && !$this->isAdmin()) { $this->loadThis(); return; }
        $data['manuscript'] = $this->editor_model->getAeAssignmentDetail((int)$manuscriptId, (int)$this->vendorId);
        if (!$data['manuscript']) {
            $this->session->set_flashdata('error', 'Assignment not found or not yet accepted.');
            redirect('editor/ae-assignments');
        }
        $this->global['pageTitle'] = 'Assigned Manuscript Details - OJAS';
        $this->global['activeMenu'] = 'aeAssignments';
        $this->loadViews('editor/ae_assignment_view', $this->global, $data, NULL);
    }

    public function aeAssignReviewers()
    {
        if ($this->role != 16 && !$this->isAdmin()) { $this->loadThis(); return; }
        $data['manuscripts'] = $this->editor_model->getAcceptedAeManuscripts((int)$this->vendorId);
        $this->global['pageTitle'] = 'Assign Reviewers - OJAS';
        $this->global['activeMenu'] = 'aeAssignReviewers';
        $this->loadViews('editor/ae_assign_reviewers', $this->global, $data, NULL);
    }

    public function aeAssignReviewersForm($manuscriptId)
    {
        if ($this->role != 16 && !$this->isAdmin()) { $this->loadThis(); return; }
        $manuscript = $this->editor_model->getAeAssignmentDetail((int)$manuscriptId, (int)$this->vendorId);
        if (!$manuscript) {
            $this->session->set_flashdata('error', 'Accepted manuscript not found.');
            redirect('editor/ae-assign-reviewers');
        }

        $data['manuscript'] = $manuscript;
        $data['assignedReviewers'] = $this->editor_model->getAssignedReviewersForManuscript((int)$manuscriptId);
        $data['reviewers'] = $this->editor_model->getAvailableReviewersForManuscript((int)$manuscriptId);
        $this->global['pageTitle'] = 'Assign Reviewers to Manuscript - OJAS';
        $this->global['activeMenu'] = 'aeAssignReviewers';
        $this->loadViews('editor/ae_assign_reviewers_form', $this->global, $data, NULL);
    }

    public function aeAssignReviewer($manuscriptId, $reviewerId)
    {
        if ($this->role != 16 && !$this->isAdmin()) { $this->loadThis(); return; }
        $dueDate = date('Y-m-d', strtotime('+14 days'));
        $assigned = $this->editor_model->assignReviewers((int)$manuscriptId, (int)$this->vendorId, [(int)$reviewerId], $dueDate);
        $this->session->set_flashdata($assigned > 0 ? 'success' : 'error', $assigned > 0 ? 'Reviewer assigned successfully.' : 'Reviewer already assigned or assignment failed.');
        redirect('editor/ae-assign-reviewers/' . (int)$manuscriptId);
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
        $decision = $this->input->post('decision', true);
        $allowed = ['accept', 'rereview'];
        if (!in_array($decision, $allowed, true)) {
            $this->session->set_flashdata('error', 'Invalid reviewer result action selected.');
            redirect('editor/assignments/view/' . (int)$manuscriptId);
        }

        $reasonField = $decision === 'rereview' ? 'rereviewReason' : 'approvalReason';
        $label = $decision === 'rereview' ? 'Reason for re-review' : 'Approval reason';
        $minLength = $decision === 'rereview' ? 10 : 5;
        $this->form_validation->set_rules($reasonField, $label, 'trim|required|min_length[' . $minLength . ']');
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('editor/assignments/view/' . (int)$manuscriptId);
        }

        $ok = $this->editor_model->applyProgressDecision(
            (int)$manuscriptId,
            (int)$this->vendorId,
            $decision,
            $this->input->post($reasonField, true)
        );

        $successMessage = 'Reviewer action saved successfully.';
        if ($ok && $decision === 'accept') {
            $updated = $this->editor_model->getManuscript((int)$manuscriptId);
            if ($updated && $updated->status === 'revision_required') {
                $successMessage = 'Reviewer comments accepted. Major/minor revision sent to author notification page.';
            } else {
                $successMessage = 'Reviewer comments accepted. Manuscript moved to payment gateway queue.';
            }
        } elseif ($ok && $decision === 'rereview') {
            $successMessage = 'Re-review requested successfully.';
        }

        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? $successMessage : 'Failed to save reviewer result action.');
        redirect('editor/assignments/view/' . (int)$manuscriptId);
    }

    public function payment()
    {
        $data['payments'] = $this->editor_model->getPaymentQueue();
        $data['hasPublishedIssue'] = $this->editor_model->hasPublishedIssue();
        $this->global['pageTitle'] = 'Payment Queue - OJAS';
        $this->global['activeMenu'] = 'payment';
        $this->loadViews('editor/payment', $this->global, $data, NULL);
    }

    public function published()
    {
        $data['manuscripts'] = $this->editor_model->getPublishedManuscripts();
        $this->global['pageTitle'] = 'Published Manuscripts - OJAS';
        $this->global['activeMenu'] = 'published';
        $this->loadViews('editor/published', $this->global, $data, NULL);
    }

    public function savePayment($manuscriptId)
    {
        $this->form_validation->set_rules('paymentMethod', 'Payment Method', 'trim|required');
        $this->form_validation->set_rules('paymentAmount', 'Amount', 'required|numeric|greater_than_equal_to[0]');
        $this->form_validation->set_rules('paymentOther', 'Other Details', 'trim');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', validation_errors('', ''));
            redirect('editor/payment');
        }

        $ok = $this->editor_model->savePaymentAction(
            (int)$manuscriptId,
            (int)$this->vendorId,
            $this->input->post('paymentMethod', true),
            (float)$this->input->post('paymentAmount'),
            $this->input->post('paymentOther', true)
        );

        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Payment action saved.' : 'Failed to save payment action.');
        redirect('editor/payment');
    }

    public function publishFromPayment($manuscriptId)
    {
        if (!$this->editor_model->hasPublishedIssue()) {
            $this->session->set_flashdata('error', 'Cannot publish yet. Please publish at least one journal issue first (Admin > Issues).');
            redirect('editor/payment');
        }

        $ok = $this->editor_model->publishFromPayment((int)$manuscriptId, (int)$this->vendorId);
        $this->session->set_flashdata(
            $ok ? 'success' : 'error',
            $ok
                ? 'Manuscript published successfully and now appears on the journal home page.'
                : 'Cannot publish yet. Confirm payment status is free/paid and manuscript status is accepted.'
        );
        redirect('editor/payment');
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
