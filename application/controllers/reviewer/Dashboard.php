<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
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
        $this->load->model('user_model');
        $this->load->model('notification_model');
    }

    public function index()
    {
        $reviewerId = $this->vendorId;

        $data['summary'] = $this->reviewer_model->getDashboardSummary($reviewerId);
        $data['assignedManuscripts'] = $this->reviewer_model->getAssignedManuscripts($reviewerId, 10);
        $data['completedReviews'] = $this->reviewer_model->getCompletedReviews($reviewerId, 5);
        $data['performance'] = $this->reviewer_model->getPerformanceMetrics($reviewerId);
        $data['user'] = $this->user_model->getUserInfo($reviewerId);
        $data['notifications'] = $this->notification_model->getUserNotifications($reviewerId, 5);

        $this->global['pageTitle'] = 'Reviewer Dashboard - OJAS';
        $this->global['activeMenu'] = 'reviewerDashboard';

        $this->loadViews('reviewer/dashboard', $this->global, $data, NULL);
    }

    public function reminders()
    {
        $sent = $this->reviewer_model->sendPendingReviewReminders();
        $this->session->set_flashdata('success', $sent . ' reminder notification(s) generated successfully.');
        redirect('reviewer/dashboard');
    }
}
