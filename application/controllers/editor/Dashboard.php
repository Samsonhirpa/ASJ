<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
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
    }

    public function index()
    {
        $data['stats'] = $this->editor_model->getDashboardStats();
        $data['manuscripts'] = $this->editor_model->getAllManuscripts();
        $data['activities'] = $this->editor_model->getRecentActivity();

        $this->global['pageTitle'] = 'Editor Dashboard - OJAS';
        $this->global['activeMenu'] = 'editorDashboard';
        $this->loadViews('editor/dashboard', $this->global, $data, NULL);
    }
}
