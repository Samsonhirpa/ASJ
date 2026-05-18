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
        $this->global['pageTitle'] = 'Final Publishing - OJAS';
        $this->global['activeMenu'] = 'publisherPublish';
        $this->loadViews('publisher/publish', $this->global, $data, NULL);
    }

    public function publishProcess($manuscriptId)
    {
        if (!$this->guardPublisher()) { return; }
        $manuscript = $this->editor_model->getManuscript((int)$manuscriptId);
        if (empty($manuscript)) {
            $this->session->set_flashdata('error', 'Manuscript not found.');
            redirect('publisher/publish');
            return;
        }

        $data['manuscript'] = $manuscript;
        $data['issues'] = $this->issue_model->get_issues(false);
        $data['payment'] = $this->db->select('*')->from('tbl_manuscript_payments')->where('manuscriptId', (int)$manuscriptId)->order_by('paymentId', 'DESC')->limit(1)->get()->row();
        $this->global['pageTitle'] = 'Publishing Process - OJAS';
        $this->global['activeMenu'] = 'publisherPublish';
        $this->loadViews('publisher/publish_process', $this->global, $data, NULL);
    }

    public function finalizePublish($manuscriptId)
    {
        $this->publishProcess($manuscriptId);
    }

    public function submitFinalizePublish($manuscriptId)
    {
        if (!$this->guardPublisher()) { return; }

        $issueId = (int)$this->input->post('issueId');
        if ($issueId <= 0) {
            $this->session->set_flashdata('error', 'Please select an issue.');
            redirect('publisher/publish/process/' . (int)$manuscriptId);
            return;
        }
        $feeStatus = $this->input->post('feeStatus', true) === 'need_fee' ? 'need_fee' : 'free';
        $payload = [
            'updatedBy' => (int)$this->vendorId,
            'updatedDtm' => date('Y-m-d H:i:s'),
            'publication_date' => date('Y-m-d')
        ];

        if ($issueId > 0) {
            $issue = $this->issue_model->get_issue($issueId);
            if (!empty($issue)) {
                $payload['pub_volume'] = (int)$issue->volume;
                $payload['pub_issue'] = (int)$issue->issueNumber;
            }
        }

        $prefix = trim((string)$this->input->post('doi_prefix', true));
        $suffix = trim((string)$this->input->post('doi_suffix', true));
        $payload['doi_prefix'] = $prefix;
        $payload['doi_suffix'] = $suffix;
        $payload['full_doi'] = ($prefix && $suffix) ? ($prefix . '/' . $suffix) : null;
        $payload['production_status'] = $feeStatus === 'free' ? 'doi_prepared' : 'metadata_verified';

        $okStage = $this->editor_model->updateProductionStage((int)$manuscriptId, $payload);

        $paymentOk = true;
        if ($feeStatus === 'need_fee') {
            $this->form_validation->set_rules('paymentMethod', 'Payment Method', 'trim|required');
            $this->form_validation->set_rules('paymentAmount', 'Amount', 'required|numeric|greater_than_equal_to[0.01]');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors('', ''));
                redirect('publisher/publish/process/' . (int)$manuscriptId);
                return;
            }
            $paymentOk = $this->editor_model->savePaymentAction(
                (int)$manuscriptId,
                (int)$this->vendorId,
                $this->input->post('paymentMethod', true),
                (float)$this->input->post('paymentAmount'),
                $this->input->post('paymentOther', true)
            );
        } else {
            $paymentOk = $this->editor_model->savePaymentAction((int)$manuscriptId, (int)$this->vendorId, 'free', 0.0, 'No publication fee required.');
        }

        $this->session->set_flashdata(($okStage && $paymentOk) ? 'success' : 'error', ($okStage && $paymentOk) ? 'Publishing process saved. You can publish once fee status is eligible.' : 'Failed to save publishing process.');
        redirect('publisher/publish/process/' . (int)$manuscriptId);
    }

    public function doPublish($manuscriptId)
    {
        if (!$this->guardPublisher()) { return; }
        $payment = $this->db->select('*')->from('tbl_manuscript_payments')->where('manuscriptId', (int)$manuscriptId)->order_by('paymentId', 'DESC')->limit(1)->get()->row();
        if (!$payment || !in_array((string)$payment->paymentStatus, ['free', 'paid'], true)) {
            $this->session->set_flashdata('error', 'Cannot publish yet. Payment is pending.');
            redirect('publisher/publish/process/' . (int)$manuscriptId);
            return;
        }
        if (!$this->editor_model->hasPublishedIssue()) {
            $this->session->set_flashdata('error', 'Cannot publish yet. Please publish at least one journal issue first.');
            redirect('publisher/publish/process/' . (int)$manuscriptId);
            return;
        }
        $ok = $this->editor_model->publishFromPayment((int)$manuscriptId, (int)$this->vendorId);
        $this->session->set_flashdata($ok ? 'success' : 'error', $ok ? 'Manuscript published successfully.' : 'Cannot publish yet. If payment is required, wait for author payment.');
        redirect('publisher/publish/process/' . (int)$manuscriptId);
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
