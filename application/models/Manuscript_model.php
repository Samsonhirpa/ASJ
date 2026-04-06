<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manuscript_model extends CI_Model
{
    private $table = 'tbl_manuscripts';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->ensurePaymentSchema();
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
        $data['status'] = 'submitted';
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
        $this->db->select('m.*, u.name as submitterName, u.email as submitterEmail');
        $this->db->from($this->table . ' m');
        $this->db->join('tbl_users u', 'm.submittedBy = u.userId');
        $this->db->where('m.manuscriptId', $manuscriptId);
        $this->db->where('m.isDeleted', 0);
        $query = $this->db->get();
        
        return $query->row();
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

    public function getAuthorRevisionNotifications($authorId)
    {
        $this->db->select('
            m.manuscriptId,
            m.manuscriptNumber,
            m.title,
            m.status,
            m.updatedDtm,
            GROUP_CONCAT(CONCAT(u.name, ": ", LEFT(COALESCE(ra.commentsToAuthor, ""), 220)) SEPARATOR "\n") as reviewerComments
        ', false);
        $this->db->from('tbl_manuscripts m');
        $this->db->join('tbl_reviewer_assignments ra', 'ra.manuscriptId = m.manuscriptId AND ra.isDeleted = 0', 'left');
        $this->db->join('tbl_users u', 'u.userId = ra.reviewerId', 'left');
        $this->db->where('m.submittedBy', $authorId);
        $this->db->where('m.isDeleted', 0);
        $this->db->where('m.status', 'revision_required');
        $this->db->group_by(['m.manuscriptId', 'm.manuscriptNumber', 'm.title', 'm.status', 'm.updatedDtm']);
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
