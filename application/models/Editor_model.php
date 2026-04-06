<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->ensureSchema();
    }

    private function ensureSchema()
    {
        $manuscriptFields = $this->db->list_fields('tbl_manuscripts');
        $assignmentFields = $this->db->list_fields('tbl_reviewer_assignments');

        if (!in_array('screeningStatus', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN screeningStatus ENUM('pending','passed','failed') DEFAULT 'pending' AFTER status");
        }

        if (!in_array('screeningNotes', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN screeningNotes TEXT DEFAULT NULL AFTER screeningStatus");
        }

        if (!in_array('decisionLetter', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN decisionLetter TEXT DEFAULT NULL AFTER screeningNotes");
        }

        if (!in_array('assignedEditorId', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN assignedEditorId INT(11) DEFAULT NULL AFTER correspondingAuthorId");
        }

        if (!in_array('editorReviewApprovalStatus', $assignmentFields)) {
            $this->db->query("ALTER TABLE tbl_reviewer_assignments ADD COLUMN editorReviewApprovalStatus ENUM('pending','approved','rejected') DEFAULT 'pending' AFTER reviewSubmittedDate");
        }

        if (!in_array('editorReviewApprovalReason', $assignmentFields)) {
            $this->db->query("ALTER TABLE tbl_reviewer_assignments ADD COLUMN editorReviewApprovalReason TEXT DEFAULT NULL AFTER editorReviewApprovalStatus");
        }

        if (!in_array('editorReviewApprovalDate', $assignmentFields)) {
            $this->db->query("ALTER TABLE tbl_reviewer_assignments ADD COLUMN editorReviewApprovalDate DATETIME DEFAULT NULL AFTER editorReviewApprovalReason");
        }

        if (!in_array('editorSetPrice', $assignmentFields)) {
            $this->db->query("ALTER TABLE tbl_reviewer_assignments ADD COLUMN editorSetPrice DECIMAL(10,2) DEFAULT NULL AFTER editorReviewApprovalDate");
        }

        if (!in_array('paymentStatus', $assignmentFields)) {
            $this->db->query("ALTER TABLE tbl_reviewer_assignments ADD COLUMN paymentStatus ENUM('not_ready','pending_gateway','completed') DEFAULT 'not_ready' AFTER editorSetPrice");
        }

        if (!$this->db->table_exists('tbl_ethics_cases')) {
            $this->db->query("CREATE TABLE tbl_ethics_cases (
                ethicsCaseId INT(11) NOT NULL AUTO_INCREMENT,
                manuscriptId INT(11) DEFAULT NULL,
                reportedBy INT(11) NOT NULL,
                status ENUM('open','investigating','resolved','dismissed') DEFAULT 'open',
                title VARCHAR(255) NOT NULL,
                details TEXT NOT NULL,
                resolutionNotes TEXT DEFAULT NULL,
                createdDtm DATETIME NOT NULL,
                updatedDtm DATETIME DEFAULT NULL,
                PRIMARY KEY (ethicsCaseId)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        }

        if (!$this->db->table_exists('tbl_journal_policies')) {
            $this->db->query("CREATE TABLE tbl_journal_policies (
                policyId INT(11) NOT NULL AUTO_INCREMENT,
                policyKey VARCHAR(100) NOT NULL,
                policyTitle VARCHAR(255) NOT NULL,
                policyContent TEXT NOT NULL,
                updatedBy INT(11) NOT NULL,
                updatedDtm DATETIME NOT NULL,
                PRIMARY KEY (policyId),
                UNIQUE KEY unique_policy_key (policyKey)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        }

        if (!$this->db->table_exists('tbl_manuscript_payments')) {
            $this->db->query("CREATE TABLE tbl_manuscript_payments (
                paymentId INT(11) NOT NULL AUTO_INCREMENT,
                manuscriptId INT(11) NOT NULL,
                paymentMethod VARCHAR(50) NOT NULL,
                amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
                otherDetails TEXT DEFAULT NULL,
                paymentStatus ENUM('pending','free','paid') NOT NULL DEFAULT 'pending',
                createdBy INT(11) NOT NULL,
                createdDtm DATETIME NOT NULL,
                updatedBy INT(11) DEFAULT NULL,
                updatedDtm DATETIME DEFAULT NULL,
                PRIMARY KEY (paymentId),
                KEY idx_payment_manuscript (manuscriptId)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        }
    }

    public function getDashboardStats()
    {
        $this->db->from('tbl_manuscripts');
        $this->db->where('isDeleted', 0);
        $all = $this->db->count_all_results();

        $this->db->from('tbl_manuscripts');
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 'submitted');
        $pending = $this->db->count_all_results();

        $this->db->from('tbl_manuscripts');
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 'under_review');
        $underReview = $this->db->count_all_results();

        $this->db->from('tbl_manuscripts');
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 'accepted');
        $accepted = $this->db->count_all_results();

        $this->db->from('tbl_manuscripts');
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 'rejected');
        $rejected = $this->db->count_all_results();

        return [
            'all' => $all,
            'pending' => $pending,
            'underReview' => $underReview,
            'accepted' => $accepted,
            'rejected' => $rejected
        ];
    }

    public function getRecentActivity($limit = 8)
    {
        $this->db->select('manuscriptId, manuscriptNumber, title, status, screeningStatus, updatedDtm, createdDtm');
        $this->db->from('tbl_manuscripts');
        $this->db->where('isDeleted', 0);
        $this->db->order_by('COALESCE(updatedDtm, createdDtm)', 'DESC', false);
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function getAllManuscripts()
    {
        $this->db->select('m.*, u.name as authorName,
            (SELECT COUNT(*) FROM tbl_reviewer_assignments ra WHERE ra.manuscriptId = m.manuscriptId AND ra.isDeleted = 0) as reviewerCount,
            (SELECT COUNT(*) FROM tbl_reviewer_assignments ra WHERE ra.manuscriptId = m.manuscriptId AND ra.status = "completed" AND ra.isDeleted = 0) as completedReviews');
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_users u', 'u.userId = m.submittedBy', 'left');
        $this->db->where('m.isDeleted', 0);
        $this->db->order_by('m.createdDtm', 'DESC');
        return $this->db->get()->result();
    }

    public function getPendingManuscripts()
    {
        $this->db->from('tbl_manuscripts');
        $this->db->where('isDeleted', 0);
        $this->db->where_in('status', ['submitted', 'revision_required']);
        $this->db->order_by('createdDtm', 'ASC');
        return $this->db->get()->result();
    }

    public function getManuscript($manuscriptId)
    {
        $this->db->select('m.*, u.name as authorName, u.email as authorEmail');
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_users u', 'u.userId = m.submittedBy', 'left');
        $this->db->where('m.manuscriptId', $manuscriptId);
        $this->db->where('m.isDeleted', 0);
        return $this->db->get()->row();
    }

    public function getReviewerAssignments($manuscriptId)
    {
        $this->db->select('ra.*, u.name as reviewerName, u.email as reviewerEmail');
        $this->db->from('tbl_reviewer_assignments ra');
        $this->db->join('tbl_users u', 'u.userId = ra.reviewerId');
        $this->db->where('ra.manuscriptId', $manuscriptId);
        $this->db->where('ra.isDeleted', 0);
        return $this->db->get()->result();
    }

    public function getReviewProgressList()
    {
        $this->db->select('
            m.manuscriptId,
            m.manuscriptNumber,
            m.title as manuscriptTitle,
            GROUP_CONCAT(DISTINCT u.name ORDER BY u.name SEPARATOR ", ") as reviewerNames,
            GROUP_CONCAT(DISTINCT ra.status ORDER BY ra.status SEPARATOR ", ") as assignmentStatus,
            GROUP_CONCAT(DISTINCT COALESCE(ra.recommendationDecision, "pending") ORDER BY COALESCE(ra.recommendationDecision, "pending") SEPARATOR ", ") as recommendation,
            GROUP_CONCAT(DISTINCT COALESCE(ra.editorReviewApprovalStatus, "pending") ORDER BY COALESCE(ra.editorReviewApprovalStatus, "pending") SEPARATOR ", ") as editorApproval,
            MIN(ra.reviewDueDate) as reviewDueDate
        ', false);
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_reviewer_assignments ra', 'ra.manuscriptId = m.manuscriptId AND ra.isDeleted = 0', 'left');
        $this->db->join('tbl_users u', 'u.userId = ra.reviewerId', 'left');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('ra.assignmentId IS NOT NULL', null, false);
        $this->db->group_by(['m.manuscriptId', 'm.manuscriptNumber', 'm.title']);
        $this->db->order_by('MAX(ra.assignedDate)', 'DESC', false);
        return $this->db->get()->result();
    }

    public function getReviewProgressDetails($manuscriptId)
    {
        $this->db->select('
            ra.*,
            u.name as reviewerName,
            u.email as reviewerEmail,
            m.manuscriptNumber,
            m.title as manuscriptTitle,
            m.submittedBy as authorId,
            m.status as manuscriptStatus
        ');
        $this->db->from('tbl_reviewer_assignments ra');
        $this->db->join('tbl_users u', 'u.userId = ra.reviewerId', 'left');
        $this->db->join('tbl_manuscripts m', 'm.manuscriptId = ra.manuscriptId', 'left');
        $this->db->where('ra.manuscriptId', $manuscriptId);
        $this->db->where('ra.isDeleted', 0);
        $this->db->where('m.isDeleted', 0);
        $this->db->order_by('ra.assignedDate', 'DESC');
        return $this->db->get()->result();
    }

    public function getAvailableReviewers()
    {
        $this->db->select('userId, name, email, expertise_area');
        $this->db->from('tbl_users');
        $this->db->where('roleId', 19);
        $this->db->where('isDeleted', 0);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result();
    }

    public function runInitialScreening($manuscriptId, $editorId, $status, $notes)
    {
        $data = [
            'screeningStatus' => $status,
            'screeningNotes' => $notes,
            'assignedEditorId' => $editorId,
            'updatedBy' => $editorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ];

        if ($status === 'passed') {
            $data['status'] = 'under_review';
        } elseif ($status === 'failed') {
            $data['status'] = 'rejected';
        }

        $this->db->where('manuscriptId', $manuscriptId);
        return $this->db->update('tbl_manuscripts', $data);
    }

    public function savePlagiarismScore($manuscriptId, $editorId, $score)
    {
        $this->db->where('manuscriptId', $manuscriptId);
        return $this->db->update('tbl_manuscripts', [
            'plagiarismScore' => $score,
            'assignedEditorId' => $editorId,
            'updatedBy' => $editorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ]);
    }

    public function assignReviewers($manuscriptId, $editorId, $reviewerIds, $dueDate)
    {
        $assigned = 0;
        foreach ($reviewerIds as $reviewerId) {
            $exists = $this->db->get_where('tbl_reviewer_assignments', [
                'manuscriptId' => $manuscriptId,
                'reviewerId' => $reviewerId,
                'isDeleted' => 0
            ])->row();

            if ($exists) {
                continue;
            }

            $this->db->insert('tbl_reviewer_assignments', [
                'manuscriptId' => $manuscriptId,
                'reviewerId' => $reviewerId,
                'assignedBy' => $editorId,
                'assignedDate' => date('Y-m-d H:i:s'),
                'reviewDueDate' => $dueDate,
                'status' => 'assigned',
                'responseStatus' => 'pending',
                'createdBy' => $editorId,
                'createdDtm' => date('Y-m-d H:i:s')
            ]);
            $assigned++;

            $this->db->insert('tbl_notifications', [
                'userId' => $reviewerId,
                'type' => 'review_assignment',
                'subject' => 'New manuscript assigned for review',
                'message' => 'You have been assigned a manuscript review. Please respond and submit your review before the due date.',
                'referenceId' => $manuscriptId,
                'referenceType' => 'manuscript',
                'createdDtm' => date('Y-m-d H:i:s')
            ]);
        }

        if ($assigned > 0) {
            $this->db->where('manuscriptId', $manuscriptId);
            $this->db->update('tbl_manuscripts', [
                'status' => 'under_review',
                'assignedEditorId' => $editorId,
                'updatedBy' => $editorId,
                'updatedDtm' => date('Y-m-d H:i:s')
            ]);
        }

        return $assigned;
    }

    public function processReviewApproval($assignmentId, $editorId, $approvalStatus, $reason, $price = null)
    {
        $assignment = $this->db->get_where('tbl_reviewer_assignments', [
            'assignmentId' => $assignmentId,
            'isDeleted' => 0
        ])->row();

        if (!$assignment || $assignment->status !== 'completed') {
            return false;
        }

        $update = [
            'editorReviewApprovalStatus' => $approvalStatus,
            'editorReviewApprovalReason' => $reason,
            'editorReviewApprovalDate' => date('Y-m-d H:i:s'),
            'updatedBy' => $editorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ];

        if ($approvalStatus === 'approved') {
            $update['editorSetPrice'] = $price;
            $update['paymentStatus'] = 'pending_gateway';
        } else {
            $update['editorSetPrice'] = null;
            $update['paymentStatus'] = 'not_ready';
        }

        $this->db->where('assignmentId', $assignmentId);
        $ok = $this->db->update('tbl_reviewer_assignments', $update);

        if ($ok) {
            $assignment = $this->db->select('ra.*, m.manuscriptNumber')
                ->from('tbl_reviewer_assignments ra')
                ->join('tbl_manuscripts m', 'm.manuscriptId = ra.manuscriptId')
                ->where('ra.assignmentId', $assignmentId)
                ->get()->row();

            if ($assignment) {
                $subject = $approvalStatus === 'approved'
                    ? 'Your review has been approved by editor'
                    : 'Your review has been rejected by editor';
                $message = $approvalStatus === 'approved'
                    ? 'Editor approved your review for manuscript ' . $assignment->manuscriptNumber . '. Payment gateway processing is now pending.'
                    : 'Editor rejected your review for manuscript ' . $assignment->manuscriptNumber . '. Reason: ' . $reason;

                $this->db->insert('tbl_notifications', [
                    'userId' => $assignment->reviewerId,
                    'type' => 'review_editor_approval',
                    'subject' => $subject,
                    'message' => $message,
                    'referenceId' => $assignmentId,
                    'referenceType' => 'review_assignment',
                    'createdDtm' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return $ok;
    }

    public function applyProgressDecision($manuscriptId, $editorId, $decision, $reason)
    {
        $allowed = ['accept', 'rereview'];
        if (!in_array($decision, $allowed, true)) {
            return false;
        }

        $manuscript = $this->getManuscript($manuscriptId);
        if (!$manuscript) {
            return false;
        }

        $statusMap = [
            'accept' => 'accepted',
            'rereview' => 'under_review'
        ];

        $labelMap = [
            'accept' => 'Accepted',
            'rereview' => 'Re-review Requested'
        ];

        $recommendations = $this->db->select('recommendationDecision')
            ->from('tbl_reviewer_assignments')
            ->where('manuscriptId', $manuscriptId)
            ->where('isDeleted', 0)
            ->where('status', 'completed')
            ->get()->result();

        $hasRevisionRecommendation = false;
        foreach ($recommendations as $rec) {
            if (in_array($rec->recommendationDecision, ['minor_review', 'major_review'], true)) {
                $hasRevisionRecommendation = true;
                break;
            }
        }

        if ($decision === 'accept' && $hasRevisionRecommendation) {
            $statusMap['accept'] = 'revision_required';
            $labelMap['accept'] = 'Revision Required by Reviewer';
        }

        $this->db->trans_start();

        $this->db->where('manuscriptId', $manuscriptId);
        $this->db->update('tbl_manuscripts', [
            'status' => $statusMap[$decision],
            'decisionLetter' => $labelMap[$decision] . ': ' . $reason,
            'assignedEditorId' => $editorId,
            'updatedBy' => $editorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ]);

        if ($decision === 'accept' && !$hasRevisionRecommendation) {
            $this->db->where('manuscriptId', $manuscriptId);
            $this->db->where('isDeleted', 0);
            $this->db->where('status', 'completed');
            $this->db->update('tbl_reviewer_assignments', [
                'editorReviewApprovalStatus' => 'approved',
                'editorReviewApprovalReason' => $reason,
                'editorReviewApprovalDate' => date('Y-m-d H:i:s'),
                'paymentStatus' => 'pending_gateway',
                'updatedBy' => $editorId,
                'updatedDtm' => date('Y-m-d H:i:s')
            ]);
        }

        if ($decision === 'accept' && $hasRevisionRecommendation) {
            $this->db->where('manuscriptId', $manuscriptId);
            $this->db->where('isDeleted', 0);
            $this->db->where('status', 'completed');
            $this->db->update('tbl_reviewer_assignments', [
                'editorReviewApprovalStatus' => 'approved',
                'editorReviewApprovalReason' => $reason,
                'editorReviewApprovalDate' => date('Y-m-d H:i:s'),
                'paymentStatus' => 'not_ready',
                'updatedBy' => $editorId,
                'updatedDtm' => date('Y-m-d H:i:s')
            ]);
        }

        if ($decision === 'rereview') {
            $this->db->where('manuscriptId', $manuscriptId);
            $this->db->where('isDeleted', 0);
            $this->db->update('tbl_reviewer_assignments', [
                'status' => 'accepted',
                'recommendationDecision' => null,
                'commentsToAuthor' => null,
                'commentsToEditor' => null,
                'confidentialComments' => null,
                'reviewSubmittedDate' => null,
                'editorReviewApprovalStatus' => 'pending',
                'editorReviewApprovalReason' => null,
                'editorReviewApprovalDate' => null,
                'paymentStatus' => 'not_ready',
                'updatedBy' => $editorId,
                'updatedDtm' => date('Y-m-d H:i:s')
            ]);
        }

        $compiledComments = '';
        if ($decision === 'accept' && $hasRevisionRecommendation) {
            $comments = $this->db->select('u.name as reviewerName, ra.commentsToAuthor')
                ->from('tbl_reviewer_assignments ra')
                ->join('tbl_users u', 'u.userId = ra.reviewerId', 'left')
                ->where('ra.manuscriptId', $manuscriptId)
                ->where('ra.isDeleted', 0)
                ->where('ra.commentsToAuthor IS NOT NULL', null, false)
                ->get()->result();

            foreach ($comments as $item) {
                $compiledComments .= "\n- " . $item->reviewerName . ': ' . trim((string)$item->commentsToAuthor);
            }
        }

        $this->db->insert('tbl_notifications', [
            'userId' => $manuscript->submittedBy,
            'type' => 'editorial_decision',
            'subject' => 'Editorial decision for manuscript ' . $manuscript->manuscriptNumber,
            'message' => $labelMap[$decision] . '. ' . $reason . $compiledComments,
            'referenceId' => $manuscriptId,
            'referenceType' => 'manuscript',
            'createdDtm' => date('Y-m-d H:i:s')
        ]);

        if ($decision === 'accept' && !$hasRevisionRecommendation) {
            $this->db->insert('tbl_notifications', [
                'userId' => $manuscript->submittedBy,
                'type' => 'payment_pending',
                'subject' => 'There is new payment pending',
                'message' => 'Your manuscript ' . $manuscript->manuscriptNumber . ' is accepted and moved to payment gateway.',
                'referenceId' => $manuscriptId,
                'referenceType' => 'manuscript',
                'createdDtm' => date('Y-m-d H:i:s')
            ]);
        }

        if ($decision === 'rereview') {
            $reviewers = $this->db->select('reviewerId')
                ->from('tbl_reviewer_assignments')
                ->where('manuscriptId', $manuscriptId)
                ->where('isDeleted', 0)
                ->get()->result();

            foreach ($reviewers as $r) {
                $this->db->insert('tbl_notifications', [
                    'userId' => $r->reviewerId,
                    'type' => 'rereview_request',
                    'subject' => 'Re-review requested for manuscript ' . $manuscript->manuscriptNumber,
                    'message' => 'Please review the manuscript again. Editor note: ' . $reason,
                    'referenceId' => $manuscriptId,
                    'referenceType' => 'manuscript',
                    'createdDtm' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function requestReReview($manuscriptId, $editorId, $reason)
    {
        return $this->applyProgressDecision($manuscriptId, $editorId, 'rereview', $reason);
    }

    public function getPaymentQueue()
    {
        $this->db->select('
            m.manuscriptId,
            m.manuscriptNumber,
            m.title,
            m.status,
            SUM(CASE WHEN ra.paymentStatus = "pending_gateway" THEN 1 ELSE 0 END) as pendingPayments,
            p.paymentMethod,
            p.amount,
            p.otherDetails,
            p.paymentStatus
        ', false);
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_reviewer_assignments ra', 'ra.manuscriptId = m.manuscriptId AND ra.isDeleted = 0', 'left');
        $this->db->join('tbl_manuscript_payments p', 'p.manuscriptId = m.manuscriptId', 'left');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.status', 'accepted');
        $this->db->group_by(['m.manuscriptId', 'm.manuscriptNumber', 'm.title', 'm.status', 'p.paymentMethod', 'p.amount', 'p.otherDetails', 'p.paymentStatus']);
        $this->db->order_by('m.updatedDtm', 'DESC');
        return $this->db->get()->result();
    }

    public function hasPublishedIssue()
    {
        $issue = $this->db->select('issueId')
            ->from('tbl_journal_issues')
            ->where('status', 'published')
            ->where('isDeleted', 0)
            ->limit(1)
            ->get()->row();

        return !empty($issue);
    }


    public function getPublishedManuscripts()
    {
        $this->db->select('m.manuscriptId, m.manuscriptNumber, m.title, m.updatedDtm, p.articleId, p.doi, p.publishedDate, ji.volume, ji.issueNumber, ji.year');
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_published_articles p', 'p.manuscriptId = m.manuscriptId', 'inner');
        $this->db->join('tbl_journal_issues ji', 'ji.issueId = p.issueId', 'left');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.status', 'published');
        $this->db->order_by('p.publishedDate', 'DESC');
        return $this->db->get()->result();
    }

    public function savePaymentAction($manuscriptId, $editorId, $method, $amount, $other)
    {
        $existing = $this->db->select('paymentId')
            ->from('tbl_manuscript_payments')
            ->where('manuscriptId', $manuscriptId)
            ->order_by('paymentId', 'DESC')
            ->limit(1)
            ->get()->row();

        $status = ((float)$amount === 0.0) ? 'free' : 'pending';
        $payload = [
            'paymentMethod' => $method,
            'amount' => $amount,
            'otherDetails' => $other,
            'paymentStatus' => $status,
            'updatedBy' => $editorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ];

        if ($existing) {
            $ok = $this->db->where('paymentId', $existing->paymentId)->update('tbl_manuscript_payments', $payload);
            if ($ok) {
                $this->notifyAuthorPaymentPending($manuscriptId, $status);
            }
            return $ok;
        }

        $payload['manuscriptId'] = $manuscriptId;
        $payload['createdBy'] = $editorId;
        $payload['createdDtm'] = date('Y-m-d H:i:s');
        $ok = $this->db->insert('tbl_manuscript_payments', $payload);
        if ($ok) {
            $this->notifyAuthorPaymentPending($manuscriptId, $status);
        }
        return $ok;
    }

    private function notifyAuthorPaymentPending($manuscriptId, $paymentStatus)
    {
        $manuscript = $this->db->select('manuscriptId, manuscriptNumber, submittedBy')
            ->from('tbl_manuscripts')
            ->where('manuscriptId', $manuscriptId)
            ->where('isDeleted', 0)
            ->limit(1)
            ->get()->row();

        if (!$manuscript) {
            return;
        }

        $message = $paymentStatus === 'free'
            ? 'Your manuscript ' . $manuscript->manuscriptNumber . ' has no publication fee.'
            : 'There is new payment pending for manuscript ' . $manuscript->manuscriptNumber . '.';

        $this->db->insert('tbl_notifications', [
            'userId' => $manuscript->submittedBy,
            'type' => 'payment_pending',
            'subject' => 'Payment update available',
            'message' => $message,
            'referenceId' => $manuscriptId,
            'referenceType' => 'manuscript',
            'createdDtm' => date('Y-m-d H:i:s')
        ]);
    }

    public function publishFromPayment($manuscriptId, $editorId)
    {
        $payment = $this->db->select('*')
            ->from('tbl_manuscript_payments')
            ->where('manuscriptId', $manuscriptId)
            ->order_by('paymentId', 'DESC')
            ->limit(1)
            ->get()->row();

        if (!$payment || !in_array($payment->paymentStatus, ['free', 'paid'], true)) {
            return false;
        }

        $manuscript = $this->db->select('manuscriptId, status, isDeleted')
            ->from('tbl_manuscripts')
            ->where('manuscriptId', $manuscriptId)
            ->limit(1)
            ->get()->row();

        if (!$manuscript || (int)$manuscript->isDeleted === 1 || !in_array($manuscript->status, ['accepted', 'published'], true)) {
            return false;
        }

        $issue = $this->db->select('issueId')
            ->from('tbl_journal_issues')
            ->where('status', 'published')
            ->where('isDeleted', 0)
            ->order_by('year', 'DESC')
            ->order_by('volume', 'DESC')
            ->order_by('issueNumber', 'DESC')
            ->limit(1)
            ->get()->row();

        if (!$issue) {
            return false;
        }

        $published = $this->db->select('articleId')
            ->from('tbl_published_articles')
            ->where('manuscriptId', $manuscriptId)
            ->limit(1)
            ->get()->row();

        $publishedDate = date('Y-m-d H:i:s');
        $this->db->trans_start();

        $this->db->where('manuscriptId', $manuscriptId)->update('tbl_manuscripts', [
            'status' => 'published',
            'updatedBy' => $editorId,
            'updatedDtm' => $publishedDate
        ]);

        if ($published) {
            $this->db->where('articleId', $published->articleId)->update('tbl_published_articles', [
                'issueId' => $issue->issueId,
                'publishedDate' => $publishedDate
            ]);
        } else {
            $doi = '10.1234/ojas.' . date('Y') . '.' . $issue->issueId . '.' . $manuscriptId;
            $this->db->insert('tbl_published_articles', [
                'manuscriptId' => $manuscriptId,
                'issueId' => $issue->issueId,
                'doi' => $doi,
                'publishedDate' => $publishedDate,
                'createdDtm' => $publishedDate
            ]);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function makeDecision($manuscriptId, $editorId, $decision, $letter)
    {
        $map = [
            'accept' => 'accepted',
            'reject' => 'rejected',
            'revision' => 'revision_required'
        ];

        $status = isset($map[$decision]) ? $map[$decision] : 'under_review';

        $this->db->where('manuscriptId', $manuscriptId);
        $ok = $this->db->update('tbl_manuscripts', [
            'status' => $status,
            'decisionLetter' => $letter,
            'assignedEditorId' => $editorId,
            'updatedBy' => $editorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ]);

        if ($ok) {
            $manuscript = $this->getManuscript($manuscriptId);
            if ($manuscript) {
                $this->db->insert('tbl_notifications', [
                    'userId' => $manuscript->submittedBy,
                    'type' => 'editorial_decision',
                    'subject' => 'Editorial decision on your manuscript',
                    'message' => $letter,
                    'referenceId' => $manuscriptId,
                    'referenceType' => 'manuscript',
                    'createdDtm' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return $ok;
    }

    public function getEditorialBoardMembers()
    {
        $editorRoles = [13, 14, 15, 16, 17, 18, 20];
        $this->db->select('userId, name, email, roleId, institution');
        $this->db->from('tbl_users');
        $this->db->where_in('roleId', $editorRoles);
        $this->db->where('isDeleted', 0);
        $this->db->order_by('roleId', 'ASC');
        return $this->db->get()->result();
    }

    public function getEthicsCases()
    {
        $this->db->from('tbl_ethics_cases');
        $this->db->order_by('createdDtm', 'DESC');
        return $this->db->get()->result();
    }

    public function createEthicsCase($editorId, $title, $details, $manuscriptId = null)
    {
        return $this->db->insert('tbl_ethics_cases', [
            'manuscriptId' => $manuscriptId ?: null,
            'reportedBy' => $editorId,
            'title' => $title,
            'details' => $details,
            'status' => 'open',
            'createdDtm' => date('Y-m-d H:i:s')
        ]);
    }

    public function overrideDecision($manuscriptId, $editorId, $status, $reason)
    {
        $ok = $this->db->where('manuscriptId', $manuscriptId)->update('tbl_manuscripts', [
            'status' => $status,
            'decisionLetter' => 'Editor-in-Chief override: ' . $reason,
            'updatedBy' => $editorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ]);

        if ($ok) {
            $manuscript = $this->getManuscript($manuscriptId);
            if ($manuscript) {
                $this->db->insert('tbl_notifications', [
                    'userId' => $manuscript->submittedBy,
                    'type' => 'decision_override',
                    'subject' => 'Decision updated by Editor-in-Chief',
                    'message' => 'The editorial decision has been updated: ' . ucfirst(str_replace('_', ' ', $status)) . '.',
                    'referenceId' => $manuscriptId,
                    'referenceType' => 'manuscript',
                    'createdDtm' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return $ok;
    }

    public function getJournalPolicies()
    {
        $this->db->from('tbl_journal_policies');
        $this->db->order_by('policyTitle', 'ASC');
        return $this->db->get()->result();
    }

    public function savePolicy($editorId, $policyKey, $policyTitle, $policyContent)
    {
        $exists = $this->db->get_where('tbl_journal_policies', ['policyKey' => $policyKey])->row();
        $payload = [
            'policyTitle' => $policyTitle,
            'policyContent' => $policyContent,
            'updatedBy' => $editorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ];

        if ($exists) {
            return $this->db->where('policyKey', $policyKey)->update('tbl_journal_policies', $payload);
        }

        $payload['policyKey'] = $policyKey;
        return $this->db->insert('tbl_journal_policies', $payload);
    }
}
