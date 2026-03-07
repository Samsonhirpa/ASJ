<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('journal'); // Load journal helper
        // Load models conditionally - only when needed
    }
    
    public function index() {
        $this->load->model('Journal_model');
        $this->load->model('Issue_model');
        
        $data['title'] = 'Oromia Journal of Agricultural Sciences';
        $data['latest_issue'] = $this->Journal_model->get_latest_issue();
        $data['recent_articles'] = $this->Journal_model->get_published_articles(5);
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/home', $data);
        $this->load->view('journal/footer');
    }
    
    public function about() {
        $data['title'] = 'About - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/about');
        $this->load->view('journal/footer');
    }
    
    public function aims_scope() {
        $data['title'] = 'Aims & Scope - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/aims_scope');
        $this->load->view('journal/footer');
    }
    
    public function editorial_board() {
        $data['title'] = 'Editorial Board - OJAS';
        $this->load->model('User_model');
        $data['board_members'] = $this->User_model->get_editorial_board();
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/editorial_board', $data);
        $this->load->view('journal/footer');
    }
    
    public function current_issue() {
        $this->load->model('Journal_model');
        $data['title'] = 'Current Issue - OJAS';
        $data['issue'] = $this->Journal_model->get_latest_issue();
        
        if(!$data['issue']) {
            show_404();
        }
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/current_issue', $data);
        $this->load->view('journal/footer');
    }
    
    public function archive() {
        $this->load->model('Issue_model');
        $data['title'] = 'Archive - OJAS';
        $data['issues'] = $this->Issue_model->get_issues(true);
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/archive', $data);
        $this->load->view('journal/footer');
    }
    
    public function issue($issueId) {
        $this->load->model('Issue_model');
        $data['issue'] = $this->Issue_model->get_issue_with_articles($issueId);
        
        if(!$data['issue'] || $data['issue']->status != 'published') {
            show_404();
        }
        
        $data['title'] = 'Volume ' . $data['issue']->volume . ', Issue ' . $data['issue']->issueNumber . ' - OJAS';
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/issue', $data);
        $this->load->view('journal/footer');
    }
    
    public function article($identifier) {
        $this->load->model('Journal_model');
        $data['article'] = $this->Journal_model->get_published_article($identifier);
        
        if(!$data['article']) {
            show_404();
        }
        
        $data['title'] = $data['article']->title . ' - OJAS';
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/article', $data);
        $this->load->view('journal/footer');
    }
    
    public function search() {
        $this->load->model('Journal_model');
        $keyword = $this->input->get('q');
        $data['title'] = 'Search Results - OJAS';
        $data['keyword'] = $keyword;
        
        if($keyword) {
            $filters = array(
                'year' => $this->input->get('year'),
                'articleType' => $this->input->get('type')
            );
            $data['results'] = $this->Journal_model->search_articles($keyword, $filters);
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
    
    public function author_guidelines() {
        $data['title'] = 'Author Guidelines - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/author_guidelines');
        $this->load->view('journal/footer');
    }
    
    public function reviewer_guidelines() {
        $data['title'] = 'Reviewer Guidelines - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/reviewer_guidelines');
        $this->load->view('journal/footer');
    }
    
    public function contact() {
        $data['title'] = 'Contact Us - OJAS';
        
        if($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('message', 'Message', 'required');
            
            if($this->form_validation->run()) {
                // For now, just show success message
                $this->session->set_flashdata('success', 'Your message has been sent. Thank you!');
                redirect('journal/contact');
            }
        }
        
        $this->load->view('journal/header', $data);
        $this->load->view('journal/contact', $data);
        $this->load->view('journal/footer');
    }
}