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
        if ($this->reviewer_model->updateInvitationResponse($assignmentId, $this->vendorId, 'accepted')) {
            $this->session->set_flashdata('success', 'Review invitation accepted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Unable to accept this invitation. It may already be responded to.');
        }

        redirect('reviewer/assignments');
    }

    public function decline($assignmentId)
    {
        if ($this->reviewer_model->updateInvitationResponse($assignmentId, $this->vendorId, 'declined')) {
            $this->session->set_flashdata('success', 'Review invitation declined.');
        } else {
            $this->session->set_flashdata('error', 'Unable to decline this invitation. It may already be responded to.');
        }

        redirect('reviewer/assignments');
    }

    public function submitReview($assignmentId)
    {
        $assignment = $this->reviewer_model->getAssignmentForReviewer($assignmentId, $this->vendorId);

        if (!$assignment || $assignment->status !== 'accepted') {
            $this->session->set_flashdata('error', 'This review cannot be submitted in its current state.');
            redirect('reviewer/assignments');
        }

        $this->form_validation->set_rules('recommendationDecision', 'Recommendation', 'trim|required|in_list[accept,minor_revision,major_revision,reject]');
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
            $this->session->set_flashdata('success', 'Review submitted successfully. Thank you for your contribution.');
        } else {
            $this->session->set_flashdata('error', 'Failed to submit review. Please try again.');
        }

        redirect('reviewer/completed');
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
}
