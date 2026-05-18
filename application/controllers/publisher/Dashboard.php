<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->model('Editor_model', 'editor_model');
        $this->load->model('Issue_model', 'issue_model');
    }

    public function index()
    {
        if ((int)$this->role !== 17 && !$this->isAdmin()) { $this->loadThis(); return; }

        $data['productionQueue'] = $this->editor_model->getProductionQueue((int)$this->vendorId, $this->isAdmin());
        $data['issues'] = $this->issue_model->get_issues(false);

        $this->global['pageTitle'] = 'Publisher Dashboard - OJAS';
        $this->global['activeMenu'] = 'publisherDashboard';
        $this->loadViews('publisher/dashboard', $this->global, $data, NULL);
    }
}
