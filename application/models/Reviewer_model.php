<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewer_model extends CI_Model
{
    private $table = 'tbl_reviewer_assignments';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->ensureSchema();
    }

    /**
     * Add Phase-1 reviewer columns if they do not exist.
     */
    private function ensureSchema()
    {
        $fields = $this->db->list_fields($this->table);

        if (!in_array('recommendationDecision', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN recommendationDecision VARCHAR(30) DEFAULT NULL AFTER recommendation");
        }

        if (!in_array('score', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN score TINYINT(1) DEFAULT NULL AFTER commentsToAuthor");
        }

        if (!in_array('confidentialComments', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN confidentialComments TEXT DEFAULT NULL AFTER commentsToEditor");
        }

        if (!in_array('reviewerRecognitionPoints', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN reviewerRecognitionPoints INT(11) DEFAULT 0 AFTER status");
        }

        if (!in_array('responseReason', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN responseReason TEXT DEFAULT NULL AFTER responseStatus");
        }

        if (!in_array('editorReviewApprovalStatus', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN editorReviewApprovalStatus ENUM('pending','approved','rejected') DEFAULT 'pending' AFTER reviewSubmittedDate");
        }

        if (!in_array('editorReviewApprovalReason', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN editorReviewApprovalReason TEXT DEFAULT NULL AFTER editorReviewApprovalStatus");
        }

        if (!in_array('editorReviewApprovalDate', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN editorReviewApprovalDate DATETIME DEFAULT NULL AFTER editorReviewApprovalReason");
        }

        if (!in_array('editorSetPrice', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN editorSetPrice DECIMAL(10,2) DEFAULT NULL AFTER editorReviewApprovalDate");
        }

        if (!in_array('paymentStatus', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN paymentStatus ENUM('not_ready','pending_gateway','paid') DEFAULT 'not_ready' AFTER editorSetPrice");
        }
    }

    public function getDashboardSummary($reviewerId)
    {
        $today = date('Y-m-d');

        $this->db->from($this->table);
        $this->db->where('reviewerId', $reviewerId);
        $this->db->where('isDeleted', 0);
        $totalAssigned = $this->db->count_all_results();

        $this->db->from($this->table);
        $this->db->where('reviewerId', $reviewerId);
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 'completed');
        $completed = $this->db->count_all_results();

        $this->db->from($this->table);
        $this->db->where('reviewerId', $reviewerId);
        $this->db->where('isDeleted', 0);
        $this->db->where_in('status', ['assigned', 'accepted']);
        $this->db->where('reviewDueDate <', $today);
        $overdue = $this->db->count_all_results();

        $this->db->from($this->table);
        $this->db->where('reviewerId', $reviewerId);
        $this->db->where('isDeleted', 0);
        $this->db->where('responseStatus', 'pending');
        $pendingInvitations = $this->db->count_all_results();

        return [
            'totalAssigned' => $totalAssigned,
            'completed' => $completed,
            'overdue' => $overdue,
            'pendingInvitations' => $pendingInvitations
        ];
    }

    public function getAssignedManuscripts($reviewerId, $limit = null)
    {
        $this->db->select('ra.*, m.manuscriptNumber, m.title, m.articleType, m.status as manuscriptStatus, rr.roundNumber');
        $this->db->from("{$this->table} ra");
        $this->db->join('tbl_manuscripts m', 'm.manuscriptId = ra.manuscriptId');
        $this->db->join('tbl_review_rounds rr', 'rr.manuscriptId = ra.manuscriptId AND rr.status = "active"', 'left');
        $this->db->where('ra.reviewerId', $reviewerId);
        $this->db->where('ra.isDeleted', 0);
        $this->db->where('m.isDeleted', 0);
        $this->db->order_by('ra.reviewDueDate IS NULL, ra.reviewDueDate ASC', '', false);

        if ($limit !== null) {
            $this->db->limit($limit);
        }

        return $this->db->get()->result();
    }

    public function getCompletedReviews($reviewerId, $limit = null)
    {
        $this->db->select('ra.*, m.manuscriptNumber, m.title, m.articleType');
        $this->db->from("{$this->table} ra");
        $this->db->join('tbl_manuscripts m', 'm.manuscriptId = ra.manuscriptId');
        $this->db->where('ra.reviewerId', $reviewerId);
        $this->db->where('ra.status', 'completed');
        $this->db->where('ra.isDeleted', 0);
        $this->db->order_by('ra.reviewSubmittedDate', 'DESC');

        if ($limit !== null) {
            $this->db->limit($limit);
        }

        return $this->db->get()->result();
    }

    public function getAssignmentForReviewer($assignmentId, $reviewerId)
    {
        $this->db->select('
            ra.*,
            m.manuscriptNumber,
            m.title,
            m.abstract,
            m.keywords,
            m.articleType,
            m.createdDtm as manuscriptSubmittedDate,
            rr.roundNumber,
            (
                SELECT mf.filePath
                FROM tbl_manuscript_files mf
                WHERE mf.manuscriptId = m.manuscriptId
                    AND mf.fileType = "main"
                    AND mf.isDeleted = 0
                ORDER BY mf.createdDtm DESC
                LIMIT 1
            ) as mainFilePath
        ');
        $this->db->from("{$this->table} ra");
        $this->db->join('tbl_manuscripts m', 'm.manuscriptId = ra.manuscriptId');
        $this->db->join('tbl_review_rounds rr', 'rr.manuscriptId = ra.manuscriptId AND rr.status = "active"', 'left');
        $this->db->where('ra.assignmentId', $assignmentId);
        $this->db->where('ra.reviewerId', $reviewerId);
        $this->db->where('ra.isDeleted', 0);

        return $this->db->get()->row();
    }

    public function updateInvitationResponse($assignmentId, $reviewerId, $response, $reason = null)
    {
        $status = ($response === 'accepted') ? 'accepted' : 'declined';

        $update = [
            'responseStatus' => $response,
            'responseReason' => $reason,
            'responseDate' => date('Y-m-d H:i:s'),
            'status' => $status,
            'updatedBy' => $reviewerId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ];

        $this->db->where('assignmentId', $assignmentId);
        $this->db->where('reviewerId', $reviewerId);
        $this->db->where('responseStatus', 'pending');
        return $this->db->update($this->table, $update);
    }

    public function submitReview($assignmentId, $reviewerId, $data)
    {
        $update = [
            'status' => 'completed',
            'reviewSubmittedDate' => date('Y-m-d H:i:s'),
            'recommendationDecision' => $data['recommendationDecision'],
            'commentsToAuthor' => $data['commentsToAuthor'],
            'commentsToEditor' => $data['commentsToEditor'],
            'confidentialComments' => $data['commentsToEditor'],
            'score' => $data['score'],
            'reviewFilePath' => $data['reviewFilePath'],
            'editorReviewApprovalStatus' => 'pending',
            'editorReviewApprovalReason' => null,
            'editorReviewApprovalDate' => null,
            'editorSetPrice' => null,
            'paymentStatus' => 'not_ready',
            'reviewerRecognitionPoints' => 10,
            'updatedBy' => $reviewerId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ];

        $this->db->where('assignmentId', $assignmentId);
        $this->db->where('reviewerId', $reviewerId);
        $this->db->where('status', 'accepted');
        return $this->db->update($this->table, $update);
    }

    public function getPerformanceMetrics($reviewerId)
    {
        $this->db->select('COUNT(*) as totalCompleted, AVG(score) as avgScore, AVG(DATEDIFF(reviewSubmittedDate, assignedDate)) as avgTurnaroundDays');
        $this->db->from($this->table);
        $this->db->where('reviewerId', $reviewerId);
        $this->db->where('status', 'completed');
        $this->db->where('isDeleted', 0);
        $completed = $this->db->get()->row();

        $this->db->from($this->table);
        $this->db->where('reviewerId', $reviewerId);
        $this->db->where('status', 'completed');
        $this->db->where('reviewSubmittedDate <= DATE_ADD(reviewDueDate, INTERVAL 0 DAY)', null, false);
        $this->db->where('isDeleted', 0);
        $onTime = $this->db->count_all_results();

        $totalCompleted = (int)($completed->totalCompleted ?? 0);

        return [
            'totalCompleted' => $totalCompleted,
            'averageScore' => $completed->avgScore ? round($completed->avgScore, 2) : 0,
            'averageTurnaroundDays' => $completed->avgTurnaroundDays ? round($completed->avgTurnaroundDays, 1) : 0,
            'onTimeRate' => $totalCompleted > 0 ? round(($onTime / $totalCompleted) * 100, 1) : 0,
            'recognitionLevel' => $this->getRecognitionLevel($totalCompleted)
        ];
    }

    private function getRecognitionLevel($completedReviews)
    {
        if ($completedReviews >= 20) return 'Platinum Reviewer';
        if ($completedReviews >= 10) return 'Gold Reviewer';
        if ($completedReviews >= 5) return 'Silver Reviewer';
        if ($completedReviews >= 1) return 'Bronze Reviewer';
        return 'New Reviewer';
    }

    public function sendPendingReviewReminders()
    {
        $this->db->select('ra.assignmentId, ra.reviewerId, ra.reviewDueDate, m.title, u.email, u.name');
        $this->db->from("{$this->table} ra");
        $this->db->join('tbl_manuscripts m', 'm.manuscriptId = ra.manuscriptId');
        $this->db->join('tbl_users u', 'u.userId = ra.reviewerId');
        $this->db->where('ra.status', 'accepted');
        $this->db->where('ra.reviewSubmittedDate IS NULL', null, false);
        $this->db->where('ra.reviewDueDate <=', date('Y-m-d', strtotime('+3 days')));
        $this->db->where('ra.isDeleted', 0);

        $assignments = $this->db->get()->result();

        foreach ($assignments as $assignment) {
            $this->db->insert('tbl_notifications', [
                'userId' => $assignment->reviewerId,
                'type' => 'review_reminder',
                'subject' => 'Reminder: Pending review due soon',
                'message' => 'Your review for "' . $assignment->title . '" is due on ' . date('d M Y', strtotime($assignment->reviewDueDate)) . '.',
                'referenceId' => $assignment->assignmentId,
                'referenceType' => 'review_assignment',
                'createdDtm' => date('Y-m-d H:i:s')
            ]);
        }

        return count($assignments);
    }
}
