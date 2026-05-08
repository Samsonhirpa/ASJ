<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
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
    }

    public function index()
    {
        $data['stats'] = $this->editor_model->getManagingEditorDashboardStats();
        $data['manuscripts'] = $this->editor_model->getManagingEditorPendingManuscripts(['status' => 'pending']);

        $this->global['pageTitle'] = 'Managing Editor Dashboard - OJAS';
        $this->global['activeMenu'] = 'meDashboard';
        $this->loadViews('managing_editor/dashboard', $this->global, $data, NULL);
    }
}
