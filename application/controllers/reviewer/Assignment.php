<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Assignment extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();

        if (!$this->isReviewer() && !$this->isAdmin()) {
            $this->loadThis();
            return;
        }

        $this->load->model('reviewer_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['assignments'] = $this->reviewer_model->getAssignedManuscripts($this->vendorId);
        $this->global['pageTitle'] = 'Review Assignments - OJAS';
        $this->global['activeMenu'] = 'reviewAssignments';
        $this->loadViews('reviewer/assignments', $this->global, $data, NULL);
    }

    public function completed()
    {
        $data['completedReviews'] = $this->reviewer_model->getCompletedReviews($this->vendorId);
        $this->global['pageTitle'] = 'Completed Reviews - OJAS';
        $this->global['activeMenu'] = 'completedReviews';
        $this->loadViews('reviewer/completed', $this->global, $data, NULL);
    }

    public function view($assignmentId)
    {
        $assignment = $this->reviewer_model->getAssignmentForReviewer($assignmentId, $this->vendorId);

        if (!$assignment) {
            $this->session->set_flashdata('error', 'Assignment not found or you do not have access.');
            redirect('reviewer/assignments');
        }

        $data['assignment'] = $assignment;
        $this->global['pageTitle'] = 'Review Form - OJAS';
        $this->global['activeMenu'] = 'reviewAssignments';
        $this->loadViews('reviewer/review_form', $this->global, $data, NULL);
    }

    public function accept($assignmentId)
    {
        $reason = trim((string)$this->input->post('responseReason', true));
        if ($reason === '') {
            $this->session->set_flashdata('error', 'Please provide a reason while accepting the assignment.');
            redirect('reviewer/assignments');
        }

        if ($this->reviewer_model->updateInvitationResponse($assignmentId, $this->vendorId, 'accepted', $reason)) {
            $this->notifyEditorOnInvitationResponse($assignmentId, 'accepted', $reason);
            $this->session->set_flashdata('success', 'Review invitation accepted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Unable to accept this invitation. It may already be responded to.');
        }

        redirect('reviewer/assignments');
    }

    public function decline($assignmentId)
    {
        $reason = trim((string)$this->input->post('responseReason', true));
        if ($reason === '') {
            $this->session->set_flashdata('error', 'Please provide a reason while rejecting the assignment.');
            redirect('reviewer/assignments');
        }

        if ($this->reviewer_model->updateInvitationResponse($assignmentId, $this->vendorId, 'declined', $reason)) {
            $this->notifyEditorOnInvitationResponse($assignmentId, 'declined', $reason);
            $this->session->set_flashdata('success', 'Review invitation declined.');
        } else {
            $this->session->set_flashdata('error', 'Unable to decline this invitation. It may already be responded to.');
        }

        redirect('reviewer/assignments');
    }

    public function submitReview($assignmentId)
    {
        $assignment = $this->reviewer_model->getAssignmentForReviewer($assignmentId, $this->vendorId);

        if (
            !$assignment
            || $assignment->status !== 'accepted'
            || !empty($assignment->recommendationDecision)
        ) {
            $this->session->set_flashdata('error', 'This review cannot be submitted in its current state.');
            redirect('reviewer/assignments');
        }

        $this->form_validation->set_rules('recommendationDecision', 'Recommendation', 'trim|required|in_list[accept,reject,minor_review,major_review]');
        $this->form_validation->set_rules('commentsToAuthor', 'Comments to Author', 'trim|required|min_length[20]');
        $this->form_validation->set_rules('commentsToEditor', 'Comments to Editor', 'trim|required|min_length[20]');
        $this->form_validation->set_rules('score', 'Score', 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]');

        if ($this->form_validation->run() === FALSE) {
            $data['assignment'] = $assignment;
            $this->global['pageTitle'] = 'Review Form - OJAS';
            $this->loadViews('reviewer/review_form', $this->global, $data, NULL);
            return;
        }

        $reviewFilePath = null;
        if (!empty($_FILES['reviewAttachment']['name'])) {
            $reviewFilePath = $this->uploadReviewAttachment();
            if ($reviewFilePath === false) {
                redirect('reviewer/assignment/' . $assignmentId);
                return;
            }
        }

        $payload = [
            'recommendationDecision' => $this->input->post('recommendationDecision', true),
            'commentsToAuthor' => $this->input->post('commentsToAuthor', true),
            'commentsToEditor' => $this->input->post('commentsToEditor', true),
            'score' => (int)$this->input->post('score'),
            'reviewFilePath' => $reviewFilePath
        ];

        if ($this->reviewer_model->submitReview($assignmentId, $this->vendorId, $payload)) {
            $this->notifyEditorReviewSubmitted($assignment);
            $this->session->set_flashdata('success', 'Review submitted successfully. Thank you for your contribution.');
        } else {
            $this->session->set_flashdata('error', 'Failed to submit review. Please try again.');
        }

        redirect('reviewer/completed');
    }

    public function guidelines()
    {
        $this->global['pageTitle'] = 'Reviewer Guidelines - OJAS';
        $this->global['activeMenu'] = 'reviewGuidelines';
        $this->loadViews('reviewer/guidelines', $this->global, [], NULL);
    }

    public function downloadManuscript($assignmentId)
    {
        $assignment = $this->reviewer_model->getAssignmentForReviewer($assignmentId, $this->vendorId);

        if (!$assignment) {
            $this->session->set_flashdata('error', 'Assignment not found or you do not have access.');
            redirect('reviewer/assignments');
        }

        if (!in_array($assignment->status, ['accepted', 'completed'], true)) {
            $this->session->set_flashdata('error', 'Please accept the assignment before downloading the manuscript.');
            redirect('reviewer/assignment/' . (int)$assignmentId);
        }

        if (empty($assignment->mainFilePath)) {
            $this->session->set_flashdata('error', 'Main manuscript file is not available.');
            redirect('reviewer/assignment/' . (int)$assignmentId);
        }

        $absolutePath = FCPATH . ltrim($assignment->mainFilePath, '/');
        if (!is_file($absolutePath)) {
            $this->session->set_flashdata('error', 'Manuscript file could not be found on the server.');
            redirect('reviewer/assignment/' . (int)$assignmentId);
        }

        $this->load->helper('download');
        force_download($absolutePath, null);
    }

    private function uploadReviewAttachment()
    {
        if (!is_dir('./uploads/reviews/')) {
            mkdir('./uploads/reviews/', 0777, true);
        }

        $config['upload_path'] = './uploads/reviews/';
        $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|txt|zip';
        $config['max_size'] = 5120;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('reviewAttachment')) {
            $fileData = $this->upload->data();
            return 'uploads/reviews/' . $fileData['file_name'];
        }

        $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
        return false;
    }

    private function notifyEditorOnInvitationResponse($assignmentId, $response, $reason)
    {
        $assignment = $this->db->select('ra.*, m.manuscriptNumber, u.name as reviewerName')
            ->from('tbl_reviewer_assignments ra')
            ->join('tbl_manuscripts m', 'm.manuscriptId = ra.manuscriptId')
            ->join('tbl_users u', 'u.userId = ra.reviewerId')
            ->where('ra.assignmentId', $assignmentId)
            ->get()->row();

        if (!$assignment || empty($assignment->assignedBy)) {
            return;
        }

        $this->db->insert('tbl_notifications', [
            'userId' => $assignment->assignedBy,
            'type' => 'review_invitation_response',
            'subject' => 'Reviewer has ' . $response . ' the assignment',
            'message' => $assignment->reviewerName . ' has ' . $response . ' manuscript ' . $assignment->manuscriptNumber . '. Reason: ' . $reason,
            'referenceId' => $assignmentId,
            'referenceType' => 'review_assignment',
            'createdDtm' => date('Y-m-d H:i:s')
        ]);
    }

    private function notifyEditorReviewSubmitted($assignment)
    {
        if (empty($assignment->assignedBy)) {
            return;
        }

        $this->db->insert('tbl_notifications', [
            'userId' => $assignment->assignedBy,
            'type' => 'review_submitted',
            'subject' => 'New reviewer comments submitted',
            'message' => 'A reviewer submitted comments for manuscript ' . $assignment->manuscriptNumber . '. Please approve or reject the review comments.',
            'referenceId' => $assignment->assignmentId,
            'referenceType' => 'review_assignment',
            'createdDtm' => date('Y-m-d H:i:s')
        ]);
    }
}
