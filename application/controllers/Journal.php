<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller
{
    private $supported_languages = array('en', 'om', 'am');

    public function __construct() {
        parent::__construct();
        $this->load->model('journal_model');
        $this->load->model('issue_model');
        $this->load->model('user_model');   // already used in editorial_board()
        $this->load->helper('journal');

        // Language handling (unchanged)
        $requestedLanguage = strtolower((string) $this->input->get('lang', true));
        if (in_array($requestedLanguage, $this->supported_languages, true)) {
            $this->session->set_userdata('site_lang', $requestedLanguage);
        }

        $siteLanguage = $this->session->userdata('site_lang');
        if (!in_array($siteLanguage, $this->supported_languages, true)) {
            $siteLanguage = 'en';
            $this->session->set_userdata('site_lang', $siteLanguage);
        }

        $this->load->vars(array('site_lang' => $siteLanguage));
    }

    // -----------------------------------------------------------------
    //  NEW / UPDATED METHODS FOR HOMEPAGE
    // -----------------------------------------------------------------

    /**
     * Journal Homepage - PUBLIC ACCESS
     * Now includes dynamic statistics, featured articles, and current issue
     */
    public function index() {
        // Basic data
        $data['title'] = 'Oromia Journal of Agricultural Sciences';
        $data['latest_issue'] = $this->journal_model->get_latest_issue();
        $data['recent_articles'] = $this->journal_model->get_published_articles(5); // kept for backward compatibility

        // ----- NEW: Statistics for hero section -----
        $data['stats'] = $this->_get_stats();

        // ----- NEW: Formatted current issue for the highlight card -----
        $data['current_issue'] = $this->_format_issue_for_display($data['latest_issue']);

        // ----- NEW: Featured articles (latest 6 accepted/published) -----
        $data['featured_articles'] = $this->journal_model->get_published_articles(6);

        // ----- NEW: Call for papers (static or can be fetched from DB) -----
        $data['call_for_papers'] = $this->_get_call_for_papers();

        // Load views (unchanged structure)
        $this->load->view('journal/header', $data);
        $this->load->view('journal/home', $data);
        $this->load->view('journal/footer');
    }

    /**
     * AJAX Search API - Enhanced to return volume/issue data for modern frontend
     * (already existed, but improved to ensure volume/issue fields are present)
     */
    public function search_api() {
        $keyword = trim((string)$this->input->get('q', true));
        $field   = $this->input->get('field', true);
        $filters = array(
            'year'        => $this->input->get('year', true),
            'articleType' => $this->input->get('type', true),
            'issueId'     => $this->input->get('issue', true)
        );

        $results = $this->journal_model->search_articles($keyword, $filters);

        // Apply field‑specific filtering (if requested)
        if ($field && $field !== 'all' && $keyword !== '') {
            $k = strtolower($keyword);
            $results = array_values(array_filter($results, function($item) use ($field, $k) {
                if ($field === 'title') {
                    return strpos(strtolower((string)$item->title), $k) !== false;
                }
                if ($field === 'author') {
                    return strpos(strtolower((string)$item->author_names), $k) !== false;
                }
                if ($field === 'abstract') {
                    return strpos(strtolower(strip_tags((string)$item->abstract)), $k) !== false;
                }
                return true;
            }));
        }

        // Build payload with all fields needed by the frontend (including volume/issue)
        $payload = array();
        $default_issue = $this->journal_model->get_latest_issue(); // fallback for volume/issue
        foreach (array_slice($results, 0, 20) as $r) {
            // Ensure volume/issue exist (if not, use default issue values)
            $volume = isset($r->volume) ? $r->volume : ($default_issue->volume ?? 10);
            $issueNum = isset($r->issueNumber) ? $r->issueNumber : ($default_issue->issueNumber ?? 1);
            $year = isset($r->year) ? $r->year : date('Y');

            $payload[] = array(
                'articleId'     => $r->articleId,
                'title'         => $r->title,
                'author_names'  => $r->author_names,
                'abstract_text' => strip_tags((string)$r->abstract),
                'volume'        => $volume,
                'issueNumber'   => $issueNum,
                'year'          => $year,
                'articleType'   => $r->articleType ?? 'research',
                'manuscriptNumber' => $r->manuscriptNumber ?? ''
            );
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array('count' => count($payload), 'results' => $payload)));
    }

    // -----------------------------------------------------------------
    //  PRIVATE HELPER METHODS
    // -----------------------------------------------------------------

    /**
     * Get journal statistics from database
     * @return array
     */
    private function _get_stats() {
        // Total submissions (all manuscripts, not deleted)
        $total_submissions = $this->db->where('isDeleted', 0)->count_all_results('tbl_manuscripts');

        // Published articles (status = 'accepted' or 'published')
        $this->db->where('isDeleted', 0);
        $this->db->where_in('status', ['accepted', 'published']);
        $published = $this->db->count_all_results('tbl_manuscripts');

        // Active reviewers (roleId = 19)
        $reviewers = $this->db->where('roleId', 19)->where('isDeleted', 0)->count_all_results('tbl_users');

        // Acceptance rate
        $acceptance_rate = ($total_submissions > 0) ? round(($published / $total_submissions) * 100, 1) : 0;

        return [
            'submissions' => $total_submissions,
            'published'   => $published,
            'reviewers'   => $reviewers,
            'acceptance'  => $acceptance_rate
        ];
    }

    /**
     * Format issue object for display on homepage
     * @param object $issue (from get_latest_issue())
     * @return array
     */
    private function _format_issue_for_display($issue) {
        if (!$issue) {
            return [
                'title'       => 'Volume 10, Issue 1 (June 2026)',
                'description' => 'Exploring breakthrough innovations in agroecology, climate resilience, and precision farming.',
                'cover'       => null
            ];
        }

        $monthName = '';
        if (!empty($issue->month)) {
            $monthName = date('F', strtotime("2000-{$issue->month}-01"));
        } elseif (!empty($issue->publishedDate)) {
            $monthName = date('F', strtotime($issue->publishedDate));
        }

        $title = "Volume {$issue->volume}, Issue {$issue->issueNumber}";
        if ($monthName) {
            $title .= " ({$monthName} {$issue->year})";
        } elseif ($issue->year) {
            $title .= " ({$issue->year})";
        }

        return [
            'title'       => $title,
            'description' => !empty($issue->description) ? $issue->description : 'Latest peer‑reviewed research published open access.',
            'cover'       => $issue->coverImage ?? null
        ];
    }

    /**
     * Get Call for Papers data (static or from DB)
     * @return array
     */
    private function _get_call_for_papers() {
        // You can replace this with a database query if you store CFPs in a table
        return [
            'title'       => 'Call for Papers – Special Issue: “Digital Agriculture & AI”',
            'description' => 'Submission deadline: October 30, 2026. Guest editors invite original research, reviews, and case studies on AI-driven farm management, remote sensing, and smart irrigation.',
            'deadline'    => '2026-10-30',
            'link'        => '#'
        ];
    }

    // -----------------------------------------------------------------
    //  EXISTING PUBLIC METHODS (KEPT INTACT)
    // -----------------------------------------------------------------

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
    $this->load->model('user_model');
    $data['board_members'] = $this->user_model->get_editorial_board();
    $this->load->view('journal/header', $data);
    $this->load->view('journal/editorial_board', $data);
    $this->load->view('journal/footer');
}

    public function current_issue() {
        $data['title'] = 'Current Issue - OJAS';
        $data['issue'] = $this->journal_model->get_latest_issue();
        if(!$data['issue']) show_404();
        $this->load->view('journal/header', $data);
        $this->load->view('journal/current_issue', $data);
        $this->load->view('journal/footer');
    }

    public function archive() {
    $data['title'] = 'Archive - OJAS';
    $this->load->model('issue_model');
    $data['issues'] = $this->issue_model->get_issues(true); // published only
    $this->load->view('journal/header', $data);
    $this->load->view('journal/archive', $data);
    $this->load->view('journal/footer');
}

    public function issue($issueId) {
        $data['issue'] = $this->issue_model->get_issue_with_articles($issueId);
        if(!$data['issue'] || $data['issue']->status != 'published') show_404();
        $data['title'] = 'Volume ' . $data['issue']->volume . ', Issue ' . $data['issue']->issueNumber . ' - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/issue', $data);
        $this->load->view('journal/footer');
    }

    public function article($identifier) {
        $data['article'] = $this->journal_model->get_published_article($identifier);
        if(!$data['article']) show_404();
        $data['title'] = $data['article']->title . ' - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/article', $data);
        $this->load->view('journal/footer');
    }

    public function manuscript($manuscriptId) {
        $data['article'] = $this->journal_model->get_published_manuscript((int)$manuscriptId);
        if(!$data['article']) show_404();
        $data['title'] = $data['article']->title . ' - OJAS';
        $this->load->view('journal/header', $data);
        $this->load->view('journal/manuscript_detail', $data);
        $this->load->view('journal/footer');
    }

    public function search() {
    $keyword = $this->input->get('q');
    $data['title'] = 'Search Results - OJAS';
    $data['keyword'] = $keyword;
    
    if($keyword) {
        $filters = array(
            'year' => $this->input->get('year'),
            'articleType' => $this->input->get('type'),
            'issueId' => $this->input->get('issue')
        );
        $data['results'] = $this->journal_model->search_articles($keyword, $filters);
    } else {
        $data['results'] = array();
    }
    
    // FIXED: Get distinct years without backticks issue
    $this->db->distinct();
    $this->db->select('year');
    $this->db->from('tbl_journal_issues');
    $this->db->where('status', 'published');
    $this->db->order_by('year', 'DESC');
    $data['years'] = $this->db->get()->result();

    $data['issues'] = $this->issue_model->get_issues(true);
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

    /**
 * Call for Papers - PUBLIC ACCESS
 * Shows open special issues and submission guidelines
 */
public function call_for_papers() {
    $data['title'] = 'Call for Papers - OJAS';
    $this->load->model('special_issue_model');
    $data['open_calls'] = $this->special_issue_model->get_open_calls();
    $data['upcoming_calls'] = $this->special_issue_model->get_upcoming_calls();
    $data['closed_calls'] = $this->special_issue_model->get_closed_calls();
    
    $this->load->view('journal/header', $data);
    $this->load->view('journal/call_for_papers', $data);
    $this->load->view('journal/footer');
}
}