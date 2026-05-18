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

        if (!in_array('technicalScreeningNotes', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN technicalScreeningNotes TEXT DEFAULT NULL AFTER screeningNotes");
        }

        if (!in_array('scopeScreeningNotes', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN scopeScreeningNotes TEXT DEFAULT NULL AFTER technicalScreeningNotes");
        }

        if (!in_array('eicScreeningDecision', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN eicScreeningDecision ENUM('pending','accepted','rejected') DEFAULT 'pending' AFTER scopeScreeningNotes");
        }

        if (!in_array('eicScreenedBy', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN eicScreenedBy INT(11) DEFAULT NULL AFTER eicScreeningDecision");
        }

        if (!in_array('eicScreenedDtm', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN eicScreenedDtm DATETIME DEFAULT NULL AFTER eicScreenedBy");
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

        if (!in_array('managingEditorScreeningStatus', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN managingEditorScreeningStatus ENUM('pending','passed','failed') DEFAULT 'pending' AFTER eicScreenedDtm");
        }

        if (!in_array('managingEditorScreeningScore', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN managingEditorScreeningScore INT(3) DEFAULT NULL AFTER managingEditorScreeningStatus");
        }

        if (!in_array('managingEditorScreenedBy', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN managingEditorScreenedBy INT(11) DEFAULT NULL AFTER managingEditorScreeningScore");
        }

        if (!in_array('managingEditorScreenedDtm', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN managingEditorScreenedDtm DATETIME DEFAULT NULL AFTER managingEditorScreenedBy");
        }


        if (!in_array('eicMeDecision', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN eicMeDecision ENUM('pending','approved','rejected') DEFAULT 'pending' AFTER managingEditorScreenedDtm");
        }

        if (!in_array('aeAssignmentResponse', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN aeAssignmentResponse ENUM('pending','accepted','declined') DEFAULT 'pending' AFTER eicMeDecision");
        }

        if (!in_array('firstEditorialDecision', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN firstEditorialDecision ENUM('accept_present','reject','minor_revision','major_revision','reject_resubmit') DEFAULT NULL AFTER aeAssignmentResponse");
        }

        if (!in_array('firstEditorialDecisionBy', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN firstEditorialDecisionBy INT(11) DEFAULT NULL AFTER firstEditorialDecision");
        }

        if (!in_array('firstEditorialDecisionDtm', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN firstEditorialDecisionDtm DATETIME DEFAULT NULL AFTER firstEditorialDecisionBy");
        }

        if (!in_array('revisionDueDtm', $manuscriptFields)) {
            $this->db->query("ALTER TABLE tbl_manuscripts ADD COLUMN revisionDueDtm DATETIME DEFAULT NULL AFTER firstEditorialDecisionDtm");
        }

        if (!$this->db->table_exists('tbl_managing_editor_screenings')) {
            $this->db->query("CREATE TABLE tbl_managing_editor_screenings (
                screeningId INT(11) NOT NULL AUTO_INCREMENT,
                manuscriptId INT(11) NOT NULL,
                managingEditorId INT(11) NOT NULL,
                formattingScore TINYINT(3) NOT NULL DEFAULT 0,
                completenessScore TINYINT(3) NOT NULL DEFAULT 0,
                qualityScore TINYINT(3) NOT NULL DEFAULT 0,
                templateScore TINYINT(3) NOT NULL DEFAULT 0,
                totalScore TINYINT(3) NOT NULL DEFAULT 0,
                comments TEXT NOT NULL,
                resultFilePath VARCHAR(255) DEFAULT NULL,
                resultStatus ENUM('passed','failed') NOT NULL,
                screenedDtm DATETIME NOT NULL,
                createdBy INT(11) NOT NULL,
                createdDtm DATETIME NOT NULL,
                updatedBy INT(11) DEFAULT NULL,
                updatedDtm DATETIME DEFAULT NULL,
                PRIMARY KEY (screeningId),
                UNIQUE KEY unique_me_screening_manuscript (manuscriptId),
                KEY idx_me_result_status (resultStatus)
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

    public function getReviewProgressList($completedOnly = false, $associateEditorId = null)
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
        if ($completedOnly) {
            $this->db->where('ra.status', 'completed');
        }
        if ($associateEditorId !== null) {
            $this->db->where('m.assignedEditorId', (int)$associateEditorId);
        }
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

    public function getManuscriptFiles($manuscriptId)
    {
        $this->db->from('tbl_manuscript_files');
        $this->db->where('manuscriptId', $manuscriptId);
        $this->db->where('isDeleted', 0);
        $this->db->order_by('fileType', 'ASC');
        $this->db->order_by('createdDtm', 'DESC');
        return $this->db->get()->result();
    }

    public function runTechnicalScopeScreening($manuscriptId, $editorId, $decision, $technicalNotes, $scopeNotes)
    {
        if (!in_array($decision, ['accept', 'reject'], true)) {
            return false;
        }

        $manuscript = $this->getManuscript($manuscriptId);
        if (!$manuscript) {
            return false;
        }

        $screeningStatus = $decision === 'accept' ? 'passed' : 'failed';
        $eicDecision = $decision === 'accept' ? 'accepted' : 'rejected';
        $status = $decision === 'accept' ? 'under_review' : 'rejected';
        $label = $decision === 'accept' ? 'Accepted by EIC and sent to Managing Editor screening' : 'Rejected at technical and scope screening';
        $notes = "Technical Screening:
" . trim($technicalNotes) . "

Scope Screening:
" . trim($scopeNotes);

        $this->db->trans_start();

        $this->db->where('manuscriptId', $manuscriptId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_manuscripts', [
            'status' => $status,
            'screeningStatus' => $screeningStatus,
            'screeningNotes' => $notes,
            'technicalScreeningNotes' => $technicalNotes,
            'scopeScreeningNotes' => $scopeNotes,
            'eicScreeningDecision' => $eicDecision,
            'eicScreenedBy' => $editorId,
            'eicScreenedDtm' => date('Y-m-d H:i:s'),
            'assignedEditorId' => $editorId,
            'updatedBy' => $editorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ]);

        $this->db->insert('tbl_notifications', [
            'userId' => $manuscript->submittedBy,
            'type' => 'technical_scope_screening',
            'subject' => 'Technical and scope screening for manuscript ' . $manuscript->manuscriptNumber,
            'message' => $label . '. ' . $notes,
            'referenceId' => $manuscriptId,
            'referenceType' => 'manuscript',
            'createdDtm' => date('Y-m-d H:i:s')
        ]);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }


    public function getManagingEditorDashboardStats()
    {
        $base = function () {
            $this->db->from('tbl_manuscripts m');
            $this->db->where('m.isDeleted', 0);
            $this->db->where('m.eicScreeningDecision', 'accepted');
        };

        $base();
        $totalAcceptedByEic = $this->db->count_all_results();

        $base();
        $this->db->where('(m.managingEditorScreeningStatus IS NULL OR m.managingEditorScreeningStatus = "pending")', null, false);
        $pending = $this->db->count_all_results();

        $base();
        $this->db->where('m.managingEditorScreeningStatus', 'passed');
        $passed = $this->db->count_all_results();

        $base();
        $this->db->where('m.managingEditorScreeningStatus', 'failed');
        $failed = $this->db->count_all_results();

        return [
            'totalAcceptedByEic' => $totalAcceptedByEic,
            'pending' => $pending,
            'passed' => $passed,
            'failed' => $failed
        ];
    }

    public function getManagingEditorPendingManuscripts($filters = [])
    {
        $this->db->select('m.*, u.name as authorName, u.email as authorEmail, mes.totalScore, mes.resultStatus as meResultStatus, mes.screenedDtm');
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_users u', 'u.userId = m.submittedBy', 'left');
        $this->db->join('tbl_managing_editor_screenings mes', 'mes.manuscriptId = m.manuscriptId', 'left');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.eicScreeningDecision', 'accepted');

        $status = isset($filters['status']) ? $filters['status'] : 'pending';
        if ($status === 'pending') {
            $this->db->where('(m.managingEditorScreeningStatus IS NULL OR m.managingEditorScreeningStatus = "pending")', null, false);
        } elseif (in_array($status, ['passed', 'failed'], true)) {
            $this->db->where('m.managingEditorScreeningStatus', $status);
        }

        if (!empty($filters['q'])) {
            $this->db->group_start();
            $this->db->like('m.title', $filters['q']);
            $this->db->or_like('m.manuscriptNumber', $filters['q']);
            $this->db->or_like('u.name', $filters['q']);
            $this->db->group_end();
        }

        if (!empty($filters['articleType'])) {
            $this->db->where('m.articleType', $filters['articleType']);
        }

        $this->db->order_by('m.eicScreenedDtm', 'ASC');
        $this->db->order_by('m.createdDtm', 'ASC');
        return $this->db->get()->result();
    }

    public function getManagingEditorScreening($manuscriptId)
    {
        return $this->db->get_where('tbl_managing_editor_screenings', ['manuscriptId' => $manuscriptId])->row();
    }

    public function saveManagingEditorScreening($manuscriptId, $editorId, $scores, $comments, $resultFilePath = null)
    {
        $manuscript = $this->getManuscript($manuscriptId);
        if (!$manuscript || $manuscript->eicScreeningDecision !== 'accepted') {
            return false;
        }

        $totalScore = (int)$scores['formattingScore'] + (int)$scores['completenessScore'] + (int)$scores['qualityScore'] + (int)$scores['templateScore'];
        $resultStatus = $totalScore >= 70 ? 'passed' : 'failed';
        $now = date('Y-m-d H:i:s');

        $data = [
            'manuscriptId' => $manuscriptId,
            'managingEditorId' => $editorId,
            'formattingScore' => (int)$scores['formattingScore'],
            'completenessScore' => (int)$scores['completenessScore'],
            'qualityScore' => (int)$scores['qualityScore'],
            'templateScore' => (int)$scores['templateScore'],
            'totalScore' => $totalScore,
            'comments' => $comments,
            'resultStatus' => $resultStatus,
            'screenedDtm' => $now,
            'updatedBy' => $editorId,
            'updatedDtm' => $now
        ];

        if (!empty($resultFilePath)) {
            $data['resultFilePath'] = $resultFilePath;
        }

        $existing = $this->getManagingEditorScreening($manuscriptId);

        $this->db->trans_start();
        if ($existing) {
            $this->db->trans_complete();
            return false;
        }

        $data['createdBy'] = $editorId;
        $data['createdDtm'] = $now;
        $this->db->insert('tbl_managing_editor_screenings', $data);

        $this->db->where('manuscriptId', $manuscriptId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_manuscripts', [
            'managingEditorScreeningStatus' => $resultStatus,
            'managingEditorScreeningScore' => $totalScore,
            'managingEditorScreenedBy' => $editorId,
            'managingEditorScreenedDtm' => $now,
            'eicMeDecision' => 'pending',
            'updatedBy' => $editorId,
            'updatedDtm' => $now
        ]);

        $this->db->insert('tbl_notifications', [
            'userId' => $manuscript->submittedBy,
            'type' => 'managing_editor_screening',
            'subject' => 'Managing Editor screening for manuscript ' . $manuscript->manuscriptNumber,
            'message' => 'Managing Editor screening ' . $resultStatus . ' with a score of ' . $totalScore . '/100. ' . $comments,
            'referenceId' => $manuscriptId,
            'referenceType' => 'manuscript',
            'createdDtm' => $now
        ]);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }


    public function getManagingEditorScreenedManuscripts($status = 'all')
    {
        $this->db->select('m.*, mes.totalScore, mes.resultStatus as meResultStatus, mes.comments as meComments, mes.screenedDtm, mes.resultFilePath, meUser.name as managingEditorName, assignedUser.name as assignedAssociateEditorName');
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_managing_editor_screenings mes', 'mes.manuscriptId = m.manuscriptId', 'inner');
        $this->db->join('tbl_users meUser', 'meUser.userId = mes.managingEditorId', 'left');
        $this->db->join('tbl_users assignedUser', 'assignedUser.userId = m.assignedEditorId AND assignedUser.roleId = 16', 'left');
        $this->db->where('m.isDeleted', 0);
        if (in_array($status, ['passed','failed'], true)) {
            $this->db->where('mes.resultStatus', $status);
        }
        $this->db->order_by('mes.screenedDtm', 'DESC');
        return $this->db->get()->result();
    }

    public function getMeResultDetail($manuscriptId)
    {
        return $this->db->select('m.*, mes.totalScore, mes.comments as meComments, mes.resultStatus as meResultStatus, mes.screenedDtm, mes.resultFilePath, meUser.name as managingEditorName, assignedUser.name as assignedAssociateEditorName')
            ->from('tbl_manuscripts m')
            ->join('tbl_managing_editor_screenings mes', 'mes.manuscriptId = m.manuscriptId', 'left')
            ->join('tbl_users meUser', 'meUser.userId = mes.managingEditorId', 'left')
            ->join('tbl_users assignedUser', 'assignedUser.userId = m.assignedEditorId AND assignedUser.roleId = 16', 'left')
            ->where('m.manuscriptId', (int)$manuscriptId)
            ->where('m.isDeleted', 0)
            ->get()->row();
    }

    public function updateManagingEditorResultStatus($manuscriptId, $eicId, $decision)
    {
        $allowed = ['approved', 'rejected'];
        if (!in_array($decision, $allowed, true)) {
            return false;
        }
        $status = $decision === 'approved' ? 'under_review' : 'rejected';
        $this->db->where('manuscriptId', (int)$manuscriptId);
        $this->db->where('isDeleted', 0);
        $ok = $this->db->update('tbl_manuscripts', [
            'status' => $status,
            'eicMeDecision' => $decision,
            'assignedEditorId' => (int)$eicId,
            'updatedBy' => (int)$eicId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ]);
        if (!$ok || $decision !== 'rejected') {
            return $ok;
        }
        $manuscript = $this->db->select('submittedBy, manuscriptNumber')->from('tbl_manuscripts')->where('manuscriptId', (int)$manuscriptId)->get()->row();
        if (!$manuscript || empty($manuscript->submittedBy)) {
            return true;
        }
        $this->db->insert('tbl_notifications', [
            'userId' => (int)$manuscript->submittedBy,
            'type' => 'manuscript_rejected',
            'subject' => 'Manuscript rejected after Managing Editor screening',
            'message' => 'Your manuscript ' . $manuscript->manuscriptNumber . ' was rejected by the Editor-in-Chief after Managing Editor screening.',
            'referenceId' => (int)$manuscriptId,
            'referenceType' => 'manuscript',
            'createdDtm' => date('Y-m-d H:i:s')
        ]);
        return true;
    }

    public function getAvailableAssociateEditors()
    {
        $this->db->select('userId, name, email, expertise_area');
        $this->db->from('tbl_users');
        $this->db->where('roleId', 16);
        $this->db->where('isDeleted', 0);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result();
    }

    public function assignAssociateEditor($manuscriptId, $eicId, $associateEditorId)
    {
        $this->db->where('manuscriptId', (int)$manuscriptId);
        $this->db->where('isDeleted', 0);
        return $this->db->update('tbl_manuscripts', [
            'assignedEditorId' => (int)$associateEditorId,
            'status' => 'under_review',
            'eicMeDecision' => 'approved',
            'aeAssignmentResponse' => 'pending',
            'updatedBy' => (int)$eicId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ]);
    }

    public function notifyAssociateEditorAssignment($manuscriptId, $associateEditorId)
    {
        $manuscript = $this->db->select('manuscriptNumber')->from('tbl_manuscripts')->where('manuscriptId', (int)$manuscriptId)->get()->row();
        if (!$manuscript) {
            return false;
        }
        return $this->db->insert('tbl_notifications', [
            'userId' => (int)$associateEditorId,
            'type' => 'ae_assignment',
            'subject' => 'New Associate Editor assignment',
            'message' => 'You were assigned manuscript ' . $manuscript->manuscriptNumber . '. Please accept or decline this request.',
            'referenceId' => (int)$manuscriptId,
            'referenceType' => 'manuscript',
            'createdDtm' => date('Y-m-d H:i:s')
        ]);
    }

    public function getAeAssignments($associateEditorId)
    {
        return $this->db->select('m.manuscriptId,m.manuscriptNumber,m.title,m.thematicArea,m.keywords,m.status,m.aeAssignmentResponse,m.updatedDtm')
            ->from('tbl_manuscripts m')
            ->where('m.isDeleted', 0)
            ->where('m.assignedEditorId', (int)$associateEditorId)
            ->where('m.eicMeDecision', 'approved')
            ->order_by('m.updatedDtm', 'DESC')
            ->get()->result();
    }

    public function respondAeAssignment($manuscriptId, $associateEditorId, $decision)
    {
        if (!in_array($decision, ['accepted', 'declined'], true)) return false;
        $this->db->where('manuscriptId', (int)$manuscriptId)->where('assignedEditorId', (int)$associateEditorId)->where('eicMeDecision', 'approved');
        return $this->db->update('tbl_manuscripts', ['aeAssignmentResponse' => $decision, 'updatedDtm' => date('Y-m-d H:i:s')]);
    }

    public function getAeAssignmentDetail($manuscriptId, $associateEditorId)
    {
        return $this->db->select('m.*, mes.totalScore, mes.comments as meComments, mes.resultStatus as meResultStatus, mes.resultFilePath')
            ->from('tbl_manuscripts m')
            ->join('tbl_managing_editor_screenings mes', 'mes.manuscriptId = m.manuscriptId', 'left')
            ->where('m.manuscriptId', (int)$manuscriptId)
            ->where('m.assignedEditorId', (int)$associateEditorId)
            ->where('m.aeAssignmentResponse', 'accepted')
            ->where('m.eicMeDecision', 'approved')
            ->get()->row();
    }

     public function getAcceptedAeManuscripts($associateEditorId)
    {
        return $this->db->select('m.manuscriptId,m.manuscriptNumber,m.title,m.thematicArea,m.keywords,m.updatedDtm')
            ->from('tbl_manuscripts m')
            ->where('m.isDeleted', 0)
            ->where('m.assignedEditorId', (int)$associateEditorId)
            ->where('m.aeAssignmentResponse', 'accepted')
            ->where('m.eicMeDecision', 'approved')
            ->order_by('m.updatedDtm', 'DESC')
            ->get()->result();
    }

    public function getAssignedReviewersForManuscript($manuscriptId)
    {
        return $this->db->select('ra.assignmentId,ra.reviewDueDate,ra.status,u.userId,u.name,u.email,u.mobile,u.institution,u.department,u.expertise_area')
            ->from('tbl_reviewer_assignments ra')
            ->join('tbl_users u', 'u.userId = ra.reviewerId', 'left')
            ->where('ra.manuscriptId', (int)$manuscriptId)
            ->where('ra.isDeleted', 0)
            ->order_by('ra.assignedDate', 'DESC')
            ->get()->result();
    }

    public function getAvailableReviewersForManuscript($manuscriptId)
    {
        return $this->db->select('u.userId,u.name,u.email,u.mobile,u.institution,u.department,u.expertise_area,ra.assignmentId,ra.status as assignmentStatus,ra.responseStatus')
            ->from('tbl_users u')
            ->join('tbl_reviewer_assignments ra', 'ra.reviewerId = u.userId AND ra.manuscriptId = ' . (int)$manuscriptId . ' AND ra.isDeleted = 0', 'left')
            ->where('u.roleId', 19)
            ->where('u.isDeleted', 0)
            ->order_by('u.name', 'ASC')
            ->get()->result();
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
        $allowed = ['accept_present', 'reject', 'minor_revision', 'major_revision', 'reject_resubmit'];
        if (!in_array($decision, $allowed, true)) {
            return false;
        }

        $manuscript = $this->getManuscript($manuscriptId);
        if (!$manuscript) {
            return false;
        }

        $statusMap = [
            'accept_present' => 'accepted',
            'minor_revision' => 'revision_required',
            'major_revision' => 'revision_required',
            'reject_resubmit' => 'rejected',
            'reject' => 'rejected'
        ];

        $labelMap = [
            'accept_present' => 'Accept in Present Form',
            'minor_revision' => 'Accept after Minor Revision (7-day revision time)',
            'major_revision' => 'Reconsider after Major Revision (15-day revision time)',
            'reject_resubmit' => 'Reject and Encourage Resubmission (if extensive new experiments are needed)',
            'reject' => 'Reject'
        ];

        $recommendations = $this->db->select('recommendationDecision')
            ->from('tbl_reviewer_assignments')
            ->where('manuscriptId', $manuscriptId)
            ->where('isDeleted', 0)
            ->where('status', 'completed')
            ->get()->result();

        $hasRevisionRecommendation = false;
        foreach ($recommendations as $rec) {
            if (in_array($rec->recommendationDecision, ['minor_revision', 'major_revision'], true)) {
                $hasRevisionRecommendation = true;
                break;
            }
        }

        $now = date('Y-m-d H:i:s');
        $revisionDueDtm = null;
        if ($decision === 'minor_revision') {
            $revisionDueDtm = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($now)));
        } elseif ($decision === 'major_revision') {
            $revisionDueDtm = date('Y-m-d H:i:s', strtotime('+15 days', strtotime($now)));
        }

        $this->db->trans_start();

        $this->db->where('manuscriptId', $manuscriptId);
        $this->db->update('tbl_manuscripts', [
            'status' => $statusMap[$decision],
            'decisionLetter' => $labelMap[$decision] . ': ' . $reason,
            'firstEditorialDecision' => $decision,
            'firstEditorialDecisionBy' => $editorId,
            'firstEditorialDecisionDtm' => $now,
            'revisionDueDtm' => $revisionDueDtm,
            'updatedBy' => $editorId,
            'updatedDtm' => $now
        ]);

        if ($decision === 'accept_present') {
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

        if (in_array($decision, ['minor_revision', 'major_revision'], true)) {
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

        $compiledComments = '';
        if (in_array($decision, ['minor_revision', 'major_revision'], true) || ($decision === 'accept_present' && $hasRevisionRecommendation)) {
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

        if ($decision === 'accept_present') {
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

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function requestReReview($manuscriptId, $editorId, $reason)
    {
        return $this->applyProgressDecision($manuscriptId, $editorId, 'rereview', $reason);
    }

    public function getFirstEditorialDecisionManuscripts($viewerId, $roleId, $isAdmin = false)
    {
        $this->db->select('m.manuscriptId, m.manuscriptNumber, m.title, m.status, m.firstEditorialDecision, m.firstEditorialDecisionBy, m.firstEditorialDecisionDtm, m.revisionDueDtm, m.decisionLetter, author.name as authorName, ae.name as associateEditorName');
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_users author', 'author.userId = m.submittedBy', 'left');
        $this->db->join('tbl_users ae', 'ae.userId = m.firstEditorialDecisionBy', 'left');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.firstEditorialDecision IS NOT NULL', null, false);

        if (!$isAdmin && (int)$roleId === 16) {
            $this->db->where('m.assignedEditorId', (int)$viewerId);
        }

        $this->db->order_by('m.firstEditorialDecisionDtm', 'DESC');
        return $this->db->get()->result();
    }

    public function getAcceptedFirstDecisionManuscripts()
    {
        return $this->db->select('m.manuscriptId, m.manuscriptNumber, m.title, m.status, m.firstEditorialDecision, m.firstEditorialDecisionDtm, ae.name as associateEditorName, author.name as authorName')
            ->from('tbl_manuscripts m')
            ->join('tbl_users ae', 'ae.userId = m.firstEditorialDecisionBy', 'left')
            ->join('tbl_users author', 'author.userId = m.submittedBy', 'left')
            ->where('m.isDeleted', 0)
            ->where('m.firstEditorialDecision', 'accept_present')
            ->where('m.status !=', 'rejected')
            ->order_by('m.firstEditorialDecisionDtm', 'DESC')
            ->get()->result();
    }

    public function applyFinalEicDecision($manuscriptId, $eicId, $decision)
    {
        if (!in_array($decision, ['approved', 'rejected'], true)) {
            return false;
        }

        $status = $decision === 'approved' ? 'accepted' : 'rejected';
        $now = date('Y-m-d H:i:s');

        $ok = $this->db->where('manuscriptId', (int)$manuscriptId)
            ->where('isDeleted', 0)
            ->update('tbl_manuscripts', [
                'status' => $status,
                'production_status' => (($decision === 'approved') ? 'in_production' : null),
                'production_assigned_to' => (($decision === 'approved') ? $this->getFirstPublisherId() : null),
                'production_started_at' => (($decision === 'approved') ? $now : null),
                'updatedBy' => (int)$eicId,
                'updatedDtm' => $now,
                'decisionLetter' => (($decision === 'approved') ? 'Final EIC Decision: Accepted. Moved to Production Stage.' : 'Final EIC Decision: Rejected. Workflow ended.')
            ]);

        if (!$ok || $decision !== 'approved') {
            return $ok;
        }

        $publishers = $this->db->select('userId')->from('tbl_users')->where('roleId', 17)->where('isDeleted', 0)->get()->result();
        foreach ($publishers as $publisher) {
            $this->db->insert('tbl_notifications', [
                'userId' => (int)$publisher->userId,
                'type' => 'production_assignment',
                'subject' => 'New manuscript in Production Stage',
                'message' => 'A manuscript has been accepted by EiC and is now ready for production work.',
                'referenceId' => (int)$manuscriptId,
                'referenceType' => 'manuscript',
                'createdDtm' => $now
            ]);
        }

        return true;
    }

    private function getFirstPublisherId()
    {
        $row = $this->db->select('userId')->from('tbl_users')->where('roleId', 17)->where('isDeleted', 0)->order_by('userId', 'ASC')->limit(1)->get()->row();
        return $row ? (int)$row->userId : null;
    }

    public function getProductionQueue($publisherId, $isAdmin = false)
    {
        $this->db->select('m.*, author.name as authorName');
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_users author', 'author.userId = m.submittedBy', 'left');
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.firstEditorialDecision', 'accept_present');
        if (!$isAdmin) {
            $this->db->where('m.production_assigned_to', (int)$publisherId);
        }
        return $this->db->order_by('m.updatedDtm', 'DESC')->get()->result();
    }

    public function updateProductionStage($manuscriptId, $payload)
    {
        return $this->db->where('manuscriptId', (int)$manuscriptId)->where('isDeleted', 0)->update('tbl_manuscripts', $payload);
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
