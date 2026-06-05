<div class="content-wrapper review-details-page">
    <style>
        .review-details-page {
            background: #f1f5f9;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }

        .review-details-page .content-header {
            padding: 24px 24px 16px 24px;
        }

        .review-details-page .content-header h1 {
            font-weight: 700;
            font-size: 26px;
            color: #0f2b3d;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .review-details-page .content-header h1 small {
            font-size: 14px;
            color: #64748b;
            font-weight: 400;
            margin-left: 8px;
        }

        /* Main Container */
        .review-container {
            background: white;
            border-radius: 24px;
            margin: 0 24px 24px 24px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .review-header {
            background: linear-gradient(135deg, #0f2b3d, #1a6d7e);
            padding: 24px 28px;
            color: white;
        }

        .review-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }

        .review-header .manuscript-code {
            font-size: 12px;
            opacity: 0.8;
            margin-top: 6px;
            font-family: monospace;
        }

        /* Progress Timeline */
        .progress-timeline {
            padding: 24px 28px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }

        .timeline-steps {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .timeline-step {
            flex: 1;
            min-width: 120px;
            text-align: center;
            position: relative;
        }

        .step-icon {
            width: 48px;
            height: 48px;
            background: white;
            border: 2px solid #cbd5e1;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            color: #94a3b8;
            font-size: 20px;
            transition: all 0.2s ease;
        }

        .step-icon.active {
            border-color: #2a9d8f;
            background: #2a9d8f;
            color: white;
        }

        .step-icon.completed {
            border-color: #059669;
            background: #059669;
            color: white;
        }

        .step-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
        }

        .step-label.active {
            color: #2a9d8f;
        }

        .step-label.completed {
            color: #059669;
        }

        /* Review Cards Grid */
        .reviews-grid {
            padding: 28px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 24px;
        }

        .review-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .review-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -8px rgba(0, 0, 0, 0.12);
        }

        .review-card-header {
            padding: 18px 20px;
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .reviewer-avatar {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #1a6d7e, #2a9d8f);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .reviewer-name h4 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
        }

        .reviewer-name small {
            font-size: 11px;
            color: #64748b;
        }

        .review-status {
            padding: 5px 14px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-submitted, .status-completed {
            background: #ecfdf5;
            color: #059669;
        }

        .status-pending, .status-invited {
            background: #fffbeb;
            color: #d97706;
        }

        .status-declined {
            background: #fef2f2;
            color: #dc2626;
        }

        .review-card-body {
            padding: 20px;
        }

        .recommendation-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .rec-accepted, .rec-accept {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .rec-rejected, .rec-reject {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .rec-minor, .rec-minor_revision {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .rec-major, .rec-major_revision {
            background: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .rec-pending {
            background: #f1f5f9;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .comment-box {
            background: #f8fafc;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .comment-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #64748b;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .comment-content {
            font-size: 14px;
            line-height: 1.6;
            color: #1e293b;
        }

        .file-attachment {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
        }

        .file-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #f1f5f9;
            border-radius: 40px;
            text-decoration: none;
            color: #1a6d7e;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .file-link:hover {
            background: #e0f2fe;
            text-decoration: none;
            color: #0f2b3d;
        }

        .meta-info {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            font-size: 12px;
            color: #64748b;
        }

        /* Editorial Decision Section */
        .decision-section {
            padding: 28px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }

        .decision-header {
            margin-bottom: 24px;
        }

        .decision-header h4 {
            font-size: 18px;
            font-weight: 700;
            color: #0f2b3d;
            margin: 0 0 8px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-alert {
            background: #e0f2fe;
            border-left: 4px solid #0284c7;
            border-radius: 12px;
            padding: 14px 18px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #0c4a6e;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
            display: block;
            font-size: 13px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            font-size: 14px;
            transition: all 0.2s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #2a9d8f;
            box-shadow: 0 0 0 3px rgba(42, 157, 143, 0.1);
        }

        .button-group {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-decision {
            padding: 10px 20px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-decision:hover {
            transform: translateY(-1px);
        }

        .btn-accept {
            background: #059669;
            color: white;
        }
        .btn-accept:hover { background: #047857; }

        .btn-minor {
            background: #3b82f6;
            color: white;
        }
        .btn-minor:hover { background: #2563eb; }

        .btn-major {
            background: #d97706;
            color: white;
        }
        .btn-major:hover { background: #b45309; }

        .btn-resubmit {
            background: #6b7280;
            color: white;
        }
        .btn-resubmit:hover { background: #4b5563; }

        .btn-reject {
            background: #dc2626;
            color: white;
        }
        .btn-reject:hover { background: #b91c1c; }

        .btn-back {
            background: #f1f5f9;
            color: #1e293b;
            border: 1px solid #e2e8f0;
        }
        .btn-back:hover { background: #e2e8f0; }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 24px;
        }

        .empty-state i {
            font-size: 48px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }

        .empty-state p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .review-details-page .content-header {
                padding: 20px 16px 12px 16px;
            }

            .review-container {
                margin: 0 16px 20px 16px;
            }

            .review-header {
                padding: 18px 20px;
            }

            .progress-timeline {
                padding: 20px;
            }

            .timeline-steps {
                flex-direction: column;
                align-items: stretch;
            }

            .timeline-step {
                text-align: left;
                display: flex;
                align-items: center;
                gap: 16px;
            }

            .reviews-grid {
                padding: 20px;
                grid-template-columns: 1fr;
            }

            .decision-section {
                padding: 20px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn-decision {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <section class="content-header">
        <h1>
            Review Progress Details
            <small><?php echo html_escape(isset($manuscript->manuscriptNumber) ? $manuscript->manuscriptNumber : 'N/A'); ?></small>
        </h1>
    </section>

    <section class="content">
        <div class="review-container">
            <div class="review-header">
                <div class="manuscript-code">Manuscript #<?php echo html_escape(isset($manuscript->manuscriptNumber) ? $manuscript->manuscriptNumber : 'N/A'); ?></div>
                <h3><?php echo html_escape(isset($manuscript->title) ? $manuscript->title : 'Untitled Manuscript'); ?></h3>
            </div>

            <?php 
            $hasCompletedReviews = false;
            if (!empty($reviews)) {
                foreach ($reviews as $review) {
                    $status = isset($review->status) ? strtolower($review->status) : '';
                    if ($status == 'submitted' || $status == 'completed') {
                        $hasCompletedReviews = true;
                        break;
                    }
                }
            }
            ?>

            <div class="progress-timeline">
                <div class="timeline-steps">
                    <div class="timeline-step">
                        <div class="step-icon <?php echo !empty($reviews) ? 'completed' : 'active'; ?>">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="step-label <?php echo !empty($reviews) ? 'completed' : 'active'; ?>">Reviewers Assigned</div>
                    </div>
                    <div class="timeline-step">
                        <div class="step-icon <?php echo $hasCompletedReviews ? 'completed' : ''; ?>">
                            <i class="fa fa-file-text-o"></i>
                        </div>
                        <div class="step-label <?php echo $hasCompletedReviews ? 'completed' : ''; ?>">Reviews Submitted</div>
                    </div>
                    <div class="timeline-step">
                        <div class="step-icon">
                            <i class="fa fa-gavel"></i>
                        </div>
                        <div class="step-label">Editor Decision</div>
                    </div>
                </div>
            </div>

            <?php if (!empty($reviews)): ?>
                <div class="reviews-grid">
                    <?php foreach ($reviews as $idx => $review): ?>
                        <?php 
                            $status = isset($review->status) ? strtolower($review->status) : 'pending';
                            $statusClass = '';
                            if ($status == 'submitted' || $status == 'completed') {
                                $statusClass = 'submitted';
                            } elseif ($status == 'pending' || $status == 'invited') {
                                $statusClass = 'pending';
                            } elseif ($status == 'declined') {
                                $statusClass = 'declined';
                            }
                            
                            $recommendation = isset($review->recommendationDecision) ? strtolower($review->recommendationDecision) : 'pending';
                            $recClass = 'pending';
                            if ($recommendation == 'accepted' || $recommendation == 'accept') {
                                $recClass = 'accepted';
                            } elseif ($recommendation == 'rejected' || $recommendation == 'reject') {
                                $recClass = 'rejected';
                            } elseif ($recommendation == 'minor_revision' || $recommendation == 'minor') {
                                $recClass = 'minor';
                            } elseif ($recommendation == 'major_revision' || $recommendation == 'major') {
                                $recClass = 'major';
                            }
                            
                            $reviewerName = isset($review->reviewerName) ? $review->reviewerName : 'Reviewer';
                            $initial = strtoupper(substr(trim($reviewerName), 0, 1));
                            $initial = $initial ?: 'R';
                        ?>
                        <div class="review-card">
                            <div class="review-card-header">
                                <div class="reviewer-info">
                                    <div class="reviewer-avatar"><?php echo html_escape($initial); ?></div>
                                    <div class="reviewer-name">
                                        <h4>Reviewer <?php echo (int)$idx + 1; ?></h4>
                                        <small><?php echo html_escape($reviewerName); ?></small>
                                    </div>
                                </div>
                                <span class="review-status status-<?php echo $statusClass; ?>">
                                    <i class="fa <?php echo ($statusClass == 'submitted') ? 'fa-check-circle' : (($statusClass == 'pending') ? 'fa-clock-o' : 'fa-times-circle'); ?>"></i>
                                    <?php echo html_escape(isset($review->status) ? ucfirst($review->status) : 'Pending'); ?>
                                </span>
                            </div>
                            <div class="review-card-body">
                                <div class="recommendation-badge rec-<?php echo $recClass; ?>">
                                    <i class="fa <?php echo ($recClass == 'accepted') ? 'fa-thumbs-up' : (($recClass == 'rejected') ? 'fa-thumbs-down' : 'fa-info-circle'); ?>"></i>
                                    Recommendation: <?php echo html_escape(isset($review->recommendationDecision) ? ucfirst(str_replace('_', ' ', $review->recommendationDecision)) : 'Pending'); ?>
                                </div>

                                <div class="comment-box">
                                    <div class="comment-title">
                                        <i class="fa fa-commenting-o"></i> Comments to Author
                                    </div>
                                    <div class="comment-content">
                                        <?php echo !empty($review->commentsToAuthor) ? nl2br(html_escape($review->commentsToAuthor)) : '<em class="text-muted">No comments provided.</em>'; ?>
                                    </div>
                                </div>

                                <div class="comment-box">
                                    <div class="comment-title">
                                        <i class="fa fa-user-secret"></i> Confidential Comments to Editor
                                    </div>
                                    <div class="comment-content">
                                        <?php echo !empty($review->commentsToEditor) ? nl2br(html_escape($review->commentsToEditor)) : '<em class="text-muted">No confidential comments provided.</em>'; ?>
                                    </div>
                                </div>

                                <?php if (!empty($review->reviewFilePath)): ?>
                                    <div class="file-attachment">
                                        <a href="<?php echo base_url($review->reviewFilePath); ?>" target="_blank" class="file-link">
                                            <i class="fa fa-paperclip"></i> View Reviewer Attachment
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="meta-info">
                                    <span><i class="fa fa-flag-o"></i> Editor Approval: <strong><?php echo html_escape(isset($review->editorReviewApprovalStatus) ? ucfirst($review->editorReviewApprovalStatus) : 'Pending'); ?></strong></span>
                                    <span><i class="fa fa-calendar"></i> Due Date: <?php echo !empty($review->reviewDueDate) ? html_escape(date('d M Y', strtotime($review->reviewDueDate))) : '-'; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fa fa-comments-o"></i>
                    <p>No reviewer comments are available yet. Once reviewers submit their feedback, they will appear here.</p>
                </div>
            <?php endif; ?>

            <!-- Editorial Decision Section -->
            <div class="decision-section">
                <div class="decision-header">
                    <h4>
                        <i class="fa fa-gavel"></i> First Editorial Decision
                    </h4>
                </div>

                <div class="info-alert">
                    <i class="fa fa-info-circle"></i> After reviewer comments are submitted, the Associate Editor can submit a first editorial decision.
                </div>

                <form method="post" action="<?php echo base_url('editor/assignments/decision/' . (isset($manuscript->manuscriptId) ? (int)$manuscript->manuscriptId : 0)); ?>" id="reviewerResultActionForm">
                    <div class="form-group">
                        <label><i class="fa fa-pencil-square-o"></i> Decision Note / Rationale</label>
                        <textarea name="approvalReason" id="approvalReason" class="form-control" rows="4" placeholder="Provide a clear and concise rationale for this editorial decision..." required></textarea>
                    </div>

                    <div class="button-group">
                        <button name="decision" value="accept_present" class="btn-decision btn-accept" type="submit">
                            <i class="fa fa-check-circle"></i> Accept in Present Form
                        </button>
                        <button name="decision" value="minor_revision" class="btn-decision btn-minor" type="submit">
                            <i class="fa fa-edit"></i> Accept after Minor Revision (7 days)
                        </button>
                        <button name="decision" value="major_revision" class="btn-decision btn-major" type="submit">
                            <i class="fa fa-refresh"></i> Reconsider after Major Revision (15 days)
                        </button>
                        <button name="decision" value="reject_resubmit" class="btn-decision btn-resubmit" type="submit">
                            <i class="fa fa-mail-reply"></i> Reject & Encourage Resubmission
                        </button>
                        <button name="decision" value="reject" class="btn-decision btn-reject" type="submit">
                            <i class="fa fa-times-circle"></i> Reject
                        </button>
                        <a href="<?php echo base_url('editor/assignments'); ?>" class="btn-decision btn-back">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="form-group" id="rereviewReasonGroup" style="display:none; margin-top: 20px;">
                        <label><i class="fa fa-question-circle"></i> Reason for Re-review</label>
                        <textarea name="rereviewReason" id="rereviewReason" class="form-control" rows="3" placeholder="Explain why reviewers should review this manuscript again..."></textarea>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    (function() {
        var form = document.getElementById('reviewerResultActionForm');
        var rereviewGroup = document.getElementById('rereviewReasonGroup');
        var rereviewReason = document.getElementById('rereviewReason');
        
        form.querySelectorAll('button[name="decision"]').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                var decisionValue = this.value;
                
                // Show/hide re-review reason for major revision and reject_resubmit
                if (decisionValue === 'major_revision' || decisionValue === 'reject_resubmit') {
                    rereviewGroup.style.display = 'block';
                    rereviewReason.setAttribute('required', 'required');
                } else {
                    rereviewGroup.style.display = 'none';
                    rereviewReason.removeAttribute('required');
                }
                
                var confirmMessage = 'Submit this editorial decision: ' + this.innerText.trim() + '?';
                if (!confirm(confirmMessage)) {
                    event.preventDefault();
                }
            });
        });
    })();
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">