<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller  // Don't extend BaseController for public pages
{
    public function __construct() {
        parent::__construct();
        $this->load->model('journal_model');
        $this->load->model('issue_model');
        $this->load->helper('journal');
    }
    
    /**
     * Journal Homepage - PUBLIC ACCESS
     */
    public function index() {
        $data['title'] = 'Oromia Journal of Agricultural Sciences';
        $data['latest_issue'] = $this->journal_model->get_latest_issue();
        $data['recent_articles'] = $this->journal_model->get_published_articles(5);
        
        // No login check - public access
        $this->load->view('journal/header', $data);
        $this->load->view('journal/home', $data);
      $this->load->view('journal/footer');
    }
    
    /**
     * About the Journal - PUBLIC ACCESS
     */
    public function about() {
        $data['title'] = 'About - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/about');
        $this->load->view('journal/footer');
    }
    
    /**
     * Aims & Scope - PUBLIC ACCESS
     */
    public function aims_scope() {
        $data['title'] = 'Aims & Scope - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/aims_scope');
        $this->load->view('journal/footer');
    }
    
    /**
     * Editorial Board - PUBLIC ACCESS
     */
    public function editorial_board() {
        $data['title'] = 'Editorial Board - OJAS';
        $this->load->model('user_model');
        $data['board_members'] = $this->user_model->get_editorial_board();
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/editorial_board', $data);
        $this->load->view('journal/footer');
    }
    
    /**
     * Current Issue - PUBLIC ACCESS
     */
    public function current_issue() {
        $data['title'] = 'Current Issue - OJAS';
        $data['issue'] = $this->journal_model->get_latest_issue();
        
        if(!$data['issue']) {
            show_404();
        }
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/current_issue', $data);
        $this->load->view('journal/footer');
    }
    
    /**
     * Archive (All Issues) - PUBLIC ACCESS
     */
    public function archive() {
        $data['title'] = 'Archive - OJAS';
        $this->load->model('issue_model');
        $data['issues'] = $this->issue_model->get_issues(true); // published only
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/archive', $data);
        $this->load->view('journal/footer');
    }
    
    /**
     * View Single Issue - PUBLIC ACCESS
     */
    public function issue($issueId) {
        $this->load->model('issue_model');
        $data['issue'] = $this->issue_model->get_issue_with_articles($issueId);
        
        if(!$data['issue'] || $data['issue']->status != 'published') {
            show_404();
        }
        
        $data['title'] = 'Volume ' . $data['issue']->volume . ', Issue ' . $data['issue']->issueNumber . ' - OJAS';
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/issue', $data);
       $this->load->view('journal/footer');
    }
    
    /**
     * View Article - PUBLIC ACCESS
     */
    public function article($identifier) {
        $data['article'] = $this->journal_model->get_published_article($identifier);
        
        if(!$data['article']) {
            show_404();
        }
        
        $data['title'] = $data['article']->title . ' - OJAS';
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/article', $data);
        $this->load->view('journal/footer');
    }
    
    /**
     * Search - PUBLIC ACCESS
     */
    public function search() {
        $keyword = $this->input->get('q');
        $data['title'] = 'Search Results - OJAS';
        $data['keyword'] = $keyword;
        
        if($keyword) {
            $filters = array(
                'year' => $this->input->get('year'),
                'articleType' => $this->input->get('type')
            );
            $data['results'] = $this->journal_model->search_articles($keyword, $filters);
        } else {
            $data['results'] = array();
        }
        
        // Get filter options
        $this->db->select('DISTINCT year');
        $this->db->from('tbl_journal_issues');
        $this->db->where('status', 'published');
        $this->db->order_by('year', 'DESC');
        $data['years'] = $this->db->get()->result();
        
        $data['article_types'] = array(
            'research' => 'Research Articles',
            'review' => 'Review Articles',
            'short_communication' => 'Short Communications',
            'case_study' => 'Case Studies',
            'technical_note' => 'Technical Notes'
        );
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/search', $data);
        $this->load->view('journal/footer');
    }
    
    /**
     * Guidelines for Authors - PUBLIC ACCESS
     */
    public function author_guidelines() {
        $data['title'] = 'Author Guidelines - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/author_guidelines');
        $this->load->view('journal/footer');
    }
    
    /**
     * Guidelines for Reviewers - PUBLIC ACCESS
     */
    public function reviewer_guidelines() {
        $data['title'] = 'Reviewer Guidelines - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/reviewer_guidelines');
        $this->load->view('journal/footer');
    }
    
    /**
     * Contact Us - PUBLIC ACCESS
     */
    public function contact() {
        $data['title'] = 'Contact Us - OJAS';
        
        if($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('message', 'Message', 'required');
            
            if($this->form_validation->run()) {
                // Send email (configure your email settings)
                $this->load->library('email');
                $this->email->from($this->input->post('email'), $this->input->post('name'));
                $this->email->to('ojas@iqqo.gov.et');
                $this->email->subject('Contact Form: ' . $this->input->post('subject'));
                $this->email->message($this->input->post('message'));
                
                if($this->email->send()) {
                    $this->session->set_flashdata('success', 'Your message has been sent. Thank you!');
                } else {
                    $this->session->set_flashdata('error', 'Failed to send message. Please try again.');
                }
                
                redirect('journal/contact');
            }
        }
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/contact', $data);
        $this->load->view('journal/footer');
    }
}