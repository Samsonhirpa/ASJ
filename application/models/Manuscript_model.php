<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manuscript_model extends CI_Model
{
    private $table = 'tbl_manuscripts';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->ensureManuscriptSchema();
        $this->ensurePaymentSchema();
    }

    private function ensureManuscriptSchema()
    {
        if (!$this->db->table_exists($this->table)) {
            return;
        }

        $fields = $this->db->list_fields($this->table);

        if (!in_array('thematicArea', $fields)) {
            $this->db->query("ALTER TABLE {$this->table} ADD COLUMN thematicArea VARCHAR(100) DEFAULT NULL AFTER articleType");
        }


        $proofColumns = [
            'production_status' => "ALTER TABLE {$this->table} ADD COLUMN production_status VARCHAR(50) DEFAULT NULL AFTER updatedDtm",
            'proof_message' => "ALTER TABLE {$this->table} ADD COLUMN proof_message TEXT DEFAULT NULL AFTER production_status",
            'proof_file_name' => "ALTER TABLE {$this->table} ADD COLUMN proof_file_name VARCHAR(255) DEFAULT NULL AFTER proof_message",
            'proof_file_path' => "ALTER TABLE {$this->table} ADD COLUMN proof_file_path VARCHAR(500) DEFAULT NULL AFTER proof_file_name",
            'proof_sent_at' => "ALTER TABLE {$this->table} ADD COLUMN proof_sent_at DATETIME DEFAULT NULL AFTER proof_file_path",
            'author_proof_comment' => "ALTER TABLE {$this->table} ADD COLUMN author_proof_comment TEXT DEFAULT NULL AFTER proof_sent_at",
            'author_proof_file_name' => "ALTER TABLE {$this->table} ADD COLUMN author_proof_file_name VARCHAR(255) DEFAULT NULL AFTER author_proof_comment",
            'author_proof_file_path' => "ALTER TABLE {$this->table} ADD COLUMN author_proof_file_path VARCHAR(500) DEFAULT NULL AFTER author_proof_file_name",
            'author_proof_decision' => "ALTER TABLE {$this->table} ADD COLUMN author_proof_decision ENUM('pending','accepted','updated','rejected') DEFAULT 'pending' AFTER author_proof_file_path",
            'author_proof_responded_at' => "ALTER TABLE {$this->table} ADD COLUMN author_proof_responded_at DATETIME DEFAULT NULL AFTER author_proof_decision",
        ];

        foreach ($proofColumns as $column => $sql) {
            if (!in_array($column, $fields)) {
                $this->db->query($sql);
                $fields[] = $column;
            }
        }
    }

    private function ensurePaymentSchema()
    {
        if (!$this->db->table_exists('tbl_manuscript_payments')) {
            return;
        }

        $fields = $this->db->list_fields('tbl_manuscript_payments');

        if (!in_array('transactionReference', $fields)) {
            $this->db->query("ALTER TABLE tbl_manuscript_payments ADD COLUMN transactionReference VARCHAR(120) DEFAULT NULL AFTER otherDetails");
        }

        if (!in_array('paidBy', $fields)) {
            $this->db->query("ALTER TABLE tbl_manuscript_payments ADD COLUMN paidBy INT(11) DEFAULT NULL AFTER paymentStatus");
        }

        if (!in_array('paidDtm', $fields)) {
            $this->db->query("ALTER TABLE tbl_manuscript_payments ADD COLUMN paidDtm DATETIME DEFAULT NULL AFTER paidBy");
        }
    }
    
    /**
     * Generate unique manuscript number
     * Format: OJAS-YYYY-XXXX
     */
    public function generateManuscriptNumber()
    {
        $year = date('Y');
        $this->db->select('COUNT(*) as count');
        $this->db->where('YEAR(createdDtm)', $year);
        $query = $this->db->get($this->table);
        $count = $query->row()->count + 1;
        
        return 'OJAS-' . $year . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }
    
    /**
     * Submit new manuscript
     */
    public function submit($data)
    {
        $data['manuscriptNumber'] = $this->generateManuscriptNumber();
        if (empty($data['status'])) {
            $data['status'] = 'submitted';
        }
        $data['createdBy'] = $this->session->userdata('userId');
        $data['createdDtm'] = date('Y-m-d H:i:s');
        
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    /**
     * Get author's manuscripts
     */
    public function getAuthorManuscripts($userId, $limit = null)
    {
        $this->db->select('m.*, 
            (SELECT COUNT(*) FROM tbl_reviewer_assignments WHERE manuscriptId = m.manuscriptId) as reviewerCount,
            (SELECT COUNT(*) FROM tbl_reviewer_assignments WHERE manuscriptId = m.manuscriptId AND reviewSubmittedDate IS NOT NULL) as reviewsCompleted');
        $this->db->from($this->table . ' m');
        $this->db->where('m.submittedBy', $userId);
        $this->db->where('m.isDeleted', 0);
        // No joins in this query; group only by manuscript to avoid unknown alias errors
        $this->db->group_by('m.manuscriptId');
        $this->db->order_by('m.createdDtm', 'DESC');
        
        if($limit) {
            $this->db->limit($limit);
        }
        
        $query = $this->db->get();
        return $query->result();
    }
    
    /**
     * Get single manuscript
     */
    public function getManuscript($manuscriptId)
    {
        $this->db->select('m.*, u.name as submitterName, u.email as submitterEmail, rr.roundNumber, MAX(ra.reviewDueDate) as reviewDueDate, (SELECT COUNT(*) FROM tbl_manuscript_files mf WHERE mf.manuscriptId = m.manuscriptId AND mf.fileType = "revised_main" AND mf.isDeleted = 0) as revisedSubmissionCount');
        $this->db->from($this->table . ' m');
        $this->db->join('tbl_users u', 'm.submittedBy = u.userId');
        $this->db->join('tbl_review_rounds rr', 'rr.manuscriptId = m.manuscriptId AND rr.status = "active"', 'left');
        $this->db->join('tbl_reviewer_assignments ra', 'ra.manuscriptId = m.manuscriptId AND ra.isDeleted = 0', 'left');
        $this->db->where('m.manuscriptId', $manuscriptId);
        $this->db->where('m.isDeleted', 0);
        $this->db->group_by(['m.manuscriptId', 'u.userId', 'rr.roundNumber']);
        $query = $this->db->get();
        
        return $query->row();
    }
    

    /**
     * Get draft manuscript that belongs to an author.
     */
    public function getAuthorDraft($manuscriptId, $authorId, $isAdmin = false)
    {
        $this->db->where('manuscriptId', $manuscriptId);
        $this->db->where('status', 'draft');
        $this->db->where('isDeleted', 0);
        if (!$isAdmin) {
            $this->db->where('submittedBy', $authorId);
        }

        return $this->db->get($this->table)->row();
    }

    /**
     * Replace all authors for a draft manuscript.
     */
    public function replaceDraftAuthors($manuscriptId, $authors)
    {
        $this->db->trans_start();

        $this->db->where('manuscriptId', $manuscriptId)->delete('tbl_manuscript_authors');
        if ($this->db->table_exists('tbl_manuscript_author_details')) {
            $this->db->where('manuscriptId', $manuscriptId)->delete('tbl_manuscript_author_details');
        }

        foreach ($authors as $author) {
            if (!empty($author['isNew'])) {
                $this->ensureAuthorDetailsTable();
                $this->db->insert('tbl_manuscript_author_details', [
                    'manuscriptId' => $manuscriptId,
                    'title' => isset($author['title']) ? $author['title'] : '',
                    'first_name' => isset($author['firstName']) ? $author['firstName'] : '',
                    'middle_name' => isset($author['middleName']) ? $author['middleName'] : '',
                    'last_name' => isset($author['lastName']) ? $author['lastName'] : '',
                    'email' => $author['email'],
                    'institution' => $author['institution'],
                    'country' => $author['country'],
                    'orcid' => $author['orcid'],
                    'isCorresponding' => $author['isCorresponding'],
                    'authorOrder' => $author['authorOrder'],
                    'createdDtm' => date('Y-m-d H:i:s')
                ]);
            } else {
                $this->updateRegisteredAuthorNameParts($author);
                $this->db->insert('tbl_manuscript_authors', [
                    'manuscriptId' => $manuscriptId,
                    'userId' => $author['userId'],
                    'isCorresponding' => $author['isCorresponding'],
                    'authorOrder' => $author['authorOrder'],
                    'createdDtm' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $this->updateManuscript($manuscriptId, []);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    private function updateRegisteredAuthorNameParts($author)
    {
        if (empty($author['userId']) || (int)$author['userId'] !== (int)$this->session->userdata('userId')) {
            return;
        }

        $this->db->where('userId', (int)$author['userId'])->update('tbl_users', [
            'title' => isset($author['title']) ? $author['title'] : '',
            'first_name' => isset($author['firstName']) ? $author['firstName'] : '',
            'middle_name' => isset($author['middleName']) ? $author['middleName'] : '',
            'last_name' => isset($author['lastName']) ? $author['lastName'] : ''
        ]);
    }

    /**
     * Mark a draft and its files as deleted.
     */
    public function deleteDraft($manuscriptId, $authorId, $isAdmin = false)
    {
        $draft = $this->getAuthorDraft($manuscriptId, $authorId, $isAdmin);
        if (!$draft) {
            return false;
        }

        $this->db->trans_start();
        $this->db->where('manuscriptId', $manuscriptId)->update($this->table, [
            'isDeleted' => 1,
            'updatedBy' => $this->session->userdata('userId'),
            'updatedDtm' => date('Y-m-d H:i:s')
        ]);
        $this->db->where('manuscriptId', $manuscriptId)->update('tbl_manuscript_files', ['isDeleted' => 1]);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    private function ensureAuthorDetailsTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `tbl_manuscript_author_details` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `manuscriptId` INT(11) NOT NULL,
            `title` VARCHAR(20) NOT NULL DEFAULT '',
            `first_name` VARCHAR(64) NOT NULL DEFAULT '',
            `middle_name` VARCHAR(64) NOT NULL DEFAULT '',
            `last_name` VARCHAR(64) NOT NULL DEFAULT '',
            `email` VARCHAR(128) NOT NULL,
            `institution` VARCHAR(255) DEFAULT NULL,
            `country` VARCHAR(100) DEFAULT NULL,
            `orcid` VARCHAR(50) DEFAULT NULL,
            `isCorresponding` TINYINT(1) DEFAULT 0,
            `authorOrder` INT(11) NOT NULL,
            `createdDtm` DATETIME NOT NULL,
            PRIMARY KEY (`id`),
            KEY `manuscriptId` (`manuscriptId`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
        $this->db->query($sql);
        $this->migrateAuthorDetailsNameColumns();
    }

    private function migrateAuthorDetailsNameColumns()
    {
        if (!$this->db->table_exists('tbl_manuscript_author_details')) {
            return;
        }

        $fieldDefinitions = [
            'title' => "VARCHAR(20) NOT NULL DEFAULT ''",
            'first_name' => "VARCHAR(64) NOT NULL DEFAULT ''",
            'middle_name' => "VARCHAR(64) NOT NULL DEFAULT ''",
            'last_name' => "VARCHAR(64) NOT NULL DEFAULT ''"
        ];

        $previousField = 'manuscriptId';
        foreach ($fieldDefinitions as $field => $definition) {
            if (!$this->db->field_exists($field, 'tbl_manuscript_author_details')) {
                $this->db->query("ALTER TABLE `tbl_manuscript_author_details` ADD COLUMN `{$field}` {$definition} AFTER `{$previousField}`");
            }
            $previousField = $field;
        }

        if ($this->db->field_exists('name', 'tbl_manuscript_author_details')) {
            $rows = $this->db->select('id, name')->get('tbl_manuscript_author_details')->result();
            foreach ($rows as $row) {
                $this->db->where('id', (int)$row->id)->update('tbl_manuscript_author_details', $this->splitStoredAuthorName($row->name));
            }
            $this->db->query('ALTER TABLE `tbl_manuscript_author_details` DROP COLUMN `name`');
        }
    }

    private function splitStoredAuthorName($name)
    {
        $parts = preg_split('/\s+/', trim((string)$name));
        $titles = ['Mr','Mrs','Ms','Miss','Dr','Prof'];
        $result = ['title' => '', 'first_name' => '', 'middle_name' => '', 'last_name' => ''];

        if (in_array($parts[0] ?? '', $titles, true)) {
            $result['title'] = array_shift($parts);
        }
        if (count($parts) === 1) {
            $result['first_name'] = $parts[0];
        } elseif (count($parts) === 2) {
            $result['first_name'] = $parts[0];
            $result['last_name'] = $parts[1];
        } elseif (count($parts) > 2) {
            $result['first_name'] = array_shift($parts);
            $result['last_name'] = array_pop($parts);
            $result['middle_name'] = implode(' ', $parts);
        }

        return $result;
    }

    /**
     * Count author's manuscripts
     */
    public function countAuthorManuscripts($userId)
    {
        $this->db->where('submittedBy', $userId);
        $this->db->where('isDeleted', 0);
        return $this->db->count_all_results($this->table);
    }
    
    /**
     * Count author's manuscripts by status
     */
    public function countAuthorManuscriptsByStatus($userId, $status)
    {
        $this->db->where('submittedBy', $userId);
        $this->db->where('status', $status);
        $this->db->where('isDeleted', 0);
        return $this->db->count_all_results($this->table);
    }
    
    /**
     * Update manuscript
     */
    public function updateManuscript($manuscriptId, $data)
    {
        $data['updatedBy'] = $this->session->userdata('userId');
        $data['updatedDtm'] = date('Y-m-d H:i:s');
        
        $this->db->where('manuscriptId', $manuscriptId);
        return $this->db->update($this->table, $data);
    }
    
    /**
     * Get manuscript files
     */
    public function getManuscriptFiles($manuscriptId)
    {
        $this->db->where('manuscriptId', $manuscriptId);
        $this->db->where('isDeleted', 0);
        $this->db->order_by('fileType', 'ASC');
        $query = $this->db->get('tbl_manuscript_files');
        return $query->result();
    }

    public function getAuthorPaymentQueue($authorId)
    {
        $this->db->select('
            m.manuscriptId,
            m.manuscriptNumber,
            m.title,
            m.status,
            p.paymentId,
            p.paymentMethod,
            p.amount,
            p.paymentStatus,
            p.otherDetails,
            p.transactionReference,
            p.paidDtm
        ');
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_manuscript_payments p', 'p.manuscriptId = m.manuscriptId', 'left');
        $this->db->where('m.submittedBy', $authorId);
        $this->db->where('m.isDeleted', 0);
        $this->db->where_in('m.status', ['accepted', 'published']);
        $this->db->order_by('m.updatedDtm', 'DESC');
        return $this->db->get()->result();
    }

    public function submitAuthorPayment($manuscriptId, $authorId, $reference, $note = null)
    {
        $payment = $this->db->select('p.*, m.submittedBy, m.status as manuscriptStatus')
            ->from('tbl_manuscript_payments p')
            ->join('tbl_manuscripts m', 'm.manuscriptId = p.manuscriptId')
            ->where('p.manuscriptId', $manuscriptId)
            ->order_by('p.paymentId', 'DESC')
            ->limit(1)
            ->get()->row();

        if (!$payment || (int)$payment->submittedBy !== (int)$authorId || !in_array($payment->manuscriptStatus, ['accepted', 'published'], true)) {
            return false;
        }

        if ($payment->paymentStatus === 'free' || (float)$payment->amount === 0.0) {
            return false;
        }

        $update = [
            'paymentStatus' => 'paid',
            'transactionReference' => $reference,
            'otherDetails' => $note,
            'paidBy' => $authorId,
            'paidDtm' => date('Y-m-d H:i:s'),
            'updatedBy' => $authorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ];

        $ok = $this->db->where('paymentId', $payment->paymentId)->update('tbl_manuscript_payments', $update);
        if ($ok) {
            $manuscript = $this->db->select('manuscriptNumber, assignedEditorId')
                ->from('tbl_manuscripts')
                ->where('manuscriptId', $manuscriptId)
                ->limit(1)
                ->get()->row();

            if ($manuscript && !empty($manuscript->assignedEditorId)) {
                $this->db->insert('tbl_notifications', [
                    'userId' => $manuscript->assignedEditorId,
                    'type' => 'payment_submitted',
                    'subject' => 'Author submitted payment',
                    'message' => 'Author submitted payment for manuscript ' . $manuscript->manuscriptNumber . '.',
                    'referenceId' => $manuscriptId,
                    'referenceType' => 'manuscript',
                    'createdDtm' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return $ok;
    }


    public function getAuthorProofingQueue($authorId)
    {
        $this->db->select('manuscriptId, manuscriptNumber, title, thematicArea, production_status, author_proof_decision, proof_sent_at, updatedDtm');
        $this->db->from($this->table);
        $this->db->where('submittedBy', (int)$authorId);
        $this->db->where('isDeleted', 0);
        $this->db->where('production_status IS NOT NULL', null, false);
        $this->db->where_in('production_status', ['proof_sent', 'proof_commented', 'proof_rejected', 'proof_approved']);
        $this->db->order_by('COALESCE(author_proof_responded_at, proof_sent_at, updatedDtm)', 'DESC', false);
        return $this->db->get()->result();
    }

    public function getAuthorProofingManuscript($manuscriptId, $authorId)
    {
        $this->db->select('manuscriptId, manuscriptNumber, title, thematicArea, proof_message, proof_file_name, proof_file_path, proof_sent_at, production_status, author_proof_comment, author_proof_file_name, author_proof_file_path, author_proof_decision');
        $this->db->from($this->table);
        $this->db->where('manuscriptId', (int)$manuscriptId);
        $this->db->where('submittedBy', (int)$authorId);
        $this->db->where('isDeleted', 0);
        $this->db->where_in('production_status', ['proof_sent', 'proof_commented', 'proof_rejected', 'proof_approved']);
        return $this->db->get()->row();
    }

    public function saveAuthorProofResponse($manuscriptId, $authorId, $decision, $comment, $fileData = [])
    {
        if (!in_array($decision, ['accepted', 'updated', 'rejected'], true)) {
            return false;
        }

        $statusMap = [
            'accepted' => 'proof_approved',
            'updated' => 'proof_commented',
            'rejected' => 'proof_rejected',
        ];

        $payload = [
            'author_proof_comment' => $comment,
            'author_proof_decision' => $decision,
            'author_proof_responded_at' => date('Y-m-d H:i:s'),
            'production_status' => $statusMap[$decision],
            'updatedBy' => (int)$authorId,
            'updatedDtm' => date('Y-m-d H:i:s'),
        ];

        if (!empty($fileData['file_name']) && !empty($fileData['file_path'])) {
            $payload['author_proof_file_name'] = $fileData['file_name'];
            $payload['author_proof_file_path'] = $fileData['file_path'];
        }

        $this->db->where('manuscriptId', (int)$manuscriptId);
        $this->db->where('submittedBy', (int)$authorId);
        $this->db->where('isDeleted', 0);
        return $this->db->update($this->table, $payload);
    }

    public function countAuthorRevisionRequired($authorId)
    {
        $this->db->from('tbl_manuscripts');
        $this->db->where('submittedBy', $authorId);
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 'revision_required');
        return (int)$this->db->count_all_results();
    }

    public function getAuthorRevisionNotifications($authorId)
    {
        $this->db->select('
            m.manuscriptId,
            m.manuscriptNumber,
            m.title,
            m.status,
            m.updatedDtm,
            rr.roundNumber,
            MAX(ra.reviewDueDate) as reviewerDueDate,
            "pending" as reviseSubmissionStatus,
            GROUP_CONCAT(CONCAT(u.name, ": ", LEFT(COALESCE(ra.commentsToAuthor, ""), 220)) SEPARATOR "\n") as reviewerComments
        ', false);
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_reviewer_assignments ra', 'ra.manuscriptId = m.manuscriptId AND ra.isDeleted = 0', 'left');
        $this->db->join('tbl_users u', 'u.userId = ra.reviewerId', 'left');
        $this->db->join('tbl_review_rounds rr', 'rr.manuscriptId = m.manuscriptId AND rr.status = "active"', 'left');
        $this->db->where('m.submittedBy', $authorId);
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.status', 'revision_required');
        $this->db->group_by(['m.manuscriptId', 'm.manuscriptNumber', 'm.title', 'm.status', 'm.updatedDtm', 'rr.roundNumber']);
        $this->db->order_by('m.updatedDtm', 'DESC');
        return $this->db->get()->result();
    }

    public function getManuscriptReviewerComments($manuscriptId)
    {
        $this->db->select('u.name as reviewerName, ra.recommendationDecision, ra.commentsToAuthor, ra.reviewSubmittedDate');
        $this->db->from('tbl_reviewer_assignments ra');
        $this->db->join('tbl_users u', 'u.userId = ra.reviewerId', 'left');
        $this->db->where('ra.manuscriptId', $manuscriptId);
        $this->db->where('ra.isDeleted', 0);
        $this->db->where('ra.commentsToAuthor IS NOT NULL', null, false);
        $this->db->order_by('ra.reviewSubmittedDate', 'DESC');
        return $this->db->get()->result();
    }

    public function markRevisionResubmitted($manuscriptId, $authorId, $responseNote = '')
    {
        $this->db->trans_start();

        $this->db->where('manuscriptId', $manuscriptId);
        $this->db->where('submittedBy', $authorId);
        $this->db->where('status', 'revision_required');
        $this->db->update('tbl_manuscripts', [
            'status' => 'under_review',
            'decisionLetter' => trim('Author resubmitted revision. ' . $responseNote),
            'updatedBy' => $authorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ]);

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
            'updatedBy' => $authorId,
            'updatedDtm' => date('Y-m-d H:i:s')
        ]);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
