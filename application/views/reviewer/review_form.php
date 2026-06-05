<div class="content-wrapper">
    <style>
        /* Modern CSS for Review Form */
        .review-form-container {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --success: #10b981;
            --success-dark: #059669;
            --warning: #f59e0b;
            --danger: #ef4444;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition: all 0.2s ease;
        }

        .review-form-container .content-header {
            padding: 24px 24px 20px 24px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: var(--radius-lg);
            margin-bottom: 24px;
            border-left: 4px solid var(--primary);
        }

        .review-form-container .content-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .review-form-container .content-header h1 i {
            color: var(--primary);
            font-size: 28px;
        }

        .review-form-container .content-header h1 small {
            font-size: 14px;
            font-weight: 400;
            color: var(--gray-500);
            background: var(--gray-100);
            padding: 4px 12px;
            border-radius: 30px;
        }

        /* Info Card */
        .info-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .info-card-header {
            padding: 18px 24px;
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
        }

        .info-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card-header h3 i {
            color: var(--primary);
        }

        .info-card-body {
            padding: 24px;
        }

        .info-row {
            margin-bottom: 18px;
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
        }

        .info-label {
            width: 110px;
            font-weight: 600;
            color: var(--gray-500);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            flex: 1;
            color: var(--gray-800);
            font-size: 14px;
            word-break: break-word;
        }

        .info-value strong {
            font-weight: 700;
            color: var(--gray-900);
        }

        .divider {
            height: 1px;
            background: var(--gray-200);
            margin: 20px 0;
        }

        .blind-notice {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: var(--radius-sm);
            padding: 12px 16px;
            color: #166534;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .blind-notice i {
            font-size: 18px;
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            background: var(--success);
            color: white;
            margin-right: 8px;
            border: none;
        }

        .btn-download:hover {
            background: var(--success-dark);
            transform: translateY(-1px);
            color: white;
        }

        .btn-guidelines {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            background: var(--gray-100);
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }

        .btn-guidelines:hover {
            background: var(--gray-200);
            transform: translateY(-1px);
            color: var(--gray-800);
        }

        /* Form Card */
        .form-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .form-card-header {
            padding: 18px 24px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .form-card-header h3 {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-card-body {
            padding: 28px 24px;
        }

        .form-footer {
            padding: 18px 24px;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* Form Elements */
        .form-group-modern {
            margin-bottom: 24px;
        }

        .form-group-modern label {
            display: block;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 8px;
            font-size: 13px;
        }

        .form-group-modern label i {
            color: var(--primary);
            margin-right: 6px;
        }

        .form-group-modern .required {
            color: var(--danger);
            margin-left: 4px;
        }

        .form-control-modern {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            font-size: 14px;
            transition: var(--transition);
            font-family: inherit;
        }

        .form-control-modern:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        select.form-control-modern {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }

        textarea.form-control-modern {
            resize: vertical;
            min-height: 120px;
        }

        .help-text {
            font-size: 11px;
            color: var(--gray-500);
            margin-top: 6px;
        }

        /* Alert Styles */
        .alert-modern {
            padding: 14px 18px;
            border-radius: var(--radius-sm);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
        }

        .alert-success {
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            color: #065f46;
        }

        .alert-warning {
            background: #fed7aa;
            border: 1px solid #fdba74;
            color: #92400e;
        }

        .alert-info {
            background: #dbeafe;
            border: 1px solid #bfdbfe;
            color: #1e40af;
        }

        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        /* Buttons */
        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .btn-back {
            background: var(--gray-100);
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
            padding: 10px 20px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            background: var(--gray-200);
            transform: translateY(-1px);
            color: var(--gray-800);
        }

        /* Rating Stars */
        .rating-container {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .rating-stars {
            display: flex;
            gap: 5px;
        }

        .rating-stars i {
            font-size: 24px;
            color: var(--gray-300);
            cursor: pointer;
            transition: var(--transition);
        }

        .rating-stars i:hover,
        .rating-stars i.active {
            color: var(--warning);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .review-form-container .content-header {
                margin: 16px;
                padding: 16px 20px;
            }
            .review-form-container .content-header h1 {
                font-size: 20px;
            }
            .info-card-body {
                padding: 18px;
            }
            .info-row {
                flex-direction: column;
                margin-bottom: 14px;
            }
            .info-label {
                width: 100%;
                margin-bottom: 4px;
            }
            .form-card-body {
                padding: 20px 18px;
            }
            .form-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }
            .btn-submit, .btn-back {
                justify-content: center;
            }
        }

        @media (max-width: 992px) {
            .row {
                display: flex;
                flex-direction: column;
            }
        }
    </style>

    <div class="review-form-container">
        <section class="content-header">
            <h1>
                <i class="fa fa-file-text-o"></i>
                Double-Blind Review Form
                <small><?php echo html_escape($assignment->manuscriptNumber ?? 'N/A'); ?></small>
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-4">
                    <!-- Manuscript Information Card -->
                    <div class="info-card">
                        <div class="info-card-header">
                            <h3><i class="fa fa-info-circle"></i> Manuscript Information</h3>
                        </div>
                        <div class="info-card-body">
                            <div class="info-row">
                                <div class="info-label">Title</div>
                                <div class="info-value"><strong><?php echo html_escape($assignment->title ?? '-'); ?></strong></div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Article Type</div>
                                <div class="info-value"><?php echo ucwords(str_replace('_', ' ', $assignment->articleType ?? '-')); ?></div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Review Round</div>
                                <div class="info-value">Round <?php echo $assignment->roundNumber ?? 1; ?></div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Due Date</div>
                                <div class="info-value">
                                    <?php if (!empty($assignment->reviewDueDate)): ?>
                                        <i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($assignment->reviewDueDate)); ?>
                                    <?php else: echo 'Not set'; endif; ?>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="info-label">Keywords</div>
                                <div class="info-value"><?php echo html_escape($assignment->keywords ?? '-'); ?></div>
                            </div>
                            
                            <div class="divider"></div>
                            
                            <div class="blind-notice">
                                <i class="fa fa-user-secret"></i>
                                <span>Author identities are intentionally hidden to maintain double-blind peer review.</span>
                            </div>
                            
                            <?php $status = $assignment->status ?? ''; ?>
                            <?php if (in_array($status, ['accepted', 'completed'])): ?>
                                <a href="<?php echo base_url('reviewer/assignment/download/' . (int)$assignment->assignmentId); ?>" class="btn-download">
                                    <i class="fa fa-download"></i> Download Manuscript
                                </a>
                            <?php else: ?>
                                <div class="alert-modern alert-warning">
                                    <i class="fa fa-lock"></i>
                                    <span>Download is enabled only after you accept this assignment.</span>
                                </div>
                            <?php endif; ?>
                            
                            <a href="<?php echo base_url('reviewer/guidelines'); ?>" class="btn-guidelines" style="margin-top: 8px; display: inline-flex;">
                                <i class="fa fa-book"></i> Review Guidelines
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <!-- Submit Review Form Card -->
                    <div class="form-card">
                        <div class="form-card-header">
                            <h3><i class="fa fa-pencil-square-o"></i> Submit Your Review</h3>
                        </div>
                        <form method="post" action="<?php echo base_url('reviewer/assignment/submit/'.$assignment->assignmentId); ?>" enctype="multipart/form-data">
                            <div class="form-card-body">
                                <?php if (validation_errors()): ?>
                                    <div class="alert-modern alert-danger">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        <?php echo validation_errors(); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Recommendation -->
                                <div class="form-group-modern">
                                    <label><i class="fa fa-gavel"></i> Recommendation <span class="required">*</span></label>
                                    <select name="recommendationDecision" class="form-control-modern" required>
                                        <option value="">Select Recommendation</option>
                                        <option value="accept_present">✅ Accept in Present Form</option>
                                        <option value="minor_revision">📝 Accept after Minor Revision</option>
                                        <option value="major_revision">🔄 Reconsider after Major Revision</option>
                                        <option value="reject_resubmit">📧 Reject and Encourage Resubmission</option>
                                        <option value="reject_serious">❌ Reject (Serious Flaws)</option>
                                    </select>
                                    <div class="help-text">Select one recommendation for the Associate Editor's decision workflow.</div>
                                </div>

                                <!-- Score / Rating -->
                                <div class="form-group-modern">
                                    <label><i class="fa fa-star-o"></i> Score / Rating (1-5) <span class="required">*</span></label>
                                    <div class="rating-container">
                                        <input type="number" name="score" id="scoreInput" min="1" max="5" class="form-control-modern" style="width: 80px;" required>
                                        <div class="rating-stars" id="ratingStars">
                                            <i class="fa fa-star-o" data-value="1"></i>
                                            <i class="fa fa-star-o" data-value="2"></i>
                                            <i class="fa fa-star-o" data-value="3"></i>
                                            <i class="fa fa-star-o" data-value="4"></i>
                                            <i class="fa fa-star-o" data-value="5"></i>
                                        </div>
                                    </div>
                                    <div class="help-text">Rate the manuscript quality (1 = Poor, 5 = Excellent)</div>
                                </div>

                                <!-- Comments to Authors -->
                                <div class="form-group-modern">
                                    <label><i class="fa fa-commenting-o"></i> Comments to Authors (Public) <span class="required">*</span></label>
                                    <textarea name="commentsToAuthor" rows="6" class="form-control-modern" required placeholder="These comments will be shared with the authors. Please provide constructive feedback..."></textarea>
                                    <div class="help-text">These comments are visible to the authors. Be professional and constructive.</div>
                                </div>

                                <!-- Comments to Editor -->
                                <div class="form-group-modern">
                                    <label><i class="fa fa-lock"></i> Comments to Editor (Confidential) <span class="required">*</span></label>
                                    <textarea name="commentsToEditor" rows="6" class="form-control-modern" required placeholder="Confidential comments for the editor only..."></textarea>
                                    <div class="help-text">These comments are visible only to the editors, not to the authors.</div>
                                </div>

                                <!-- Attachment -->
                                <div class="form-group-modern">
                                    <label><i class="fa fa-paperclip"></i> Review Attachment (optional)</label>
                                    <input type="file" name="reviewAttachment" class="form-control-modern" accept=".pdf,.doc,.docx,.xls,.xlsx,.txt,.zip">
                                    <div class="help-text">Allowed: PDF, DOC, DOCX, XLS, XLSX, TXT, ZIP (Max 5MB)</div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <a href="<?php echo base_url('reviewer/assignments'); ?>" class="btn-back">
                                    <i class="fa fa-arrow-left"></i> Back to Assignments
                                </a>
                                
                                <?php if ($status === 'accepted' && empty($assignment->recommendationDecision)): ?>
                                    <button type="submit" class="btn-submit">
                                        <i class="fa fa-paper-plane"></i> Submit Review
                                    </button>
                                <?php elseif (!empty($assignment->recommendationDecision)): ?>
                                    <div class="alert-modern alert-info" style="margin: 0;">
                                        <i class="fa fa-check-circle"></i>
                                        You have already submitted your recommendation. You can comment again only if the editor requests a re-review.
                                    </div>
                                <?php else: ?>
                                    <div class="alert-modern alert-warning" style="margin: 0;">
                                        <i class="fa fa-info-circle"></i>
                                        Please accept the invitation before submitting your review.
                                    </div>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Star rating functionality
        const stars = document.querySelectorAll('#ratingStars i');
        const scoreInput = document.getElementById('scoreInput');
        
        function updateStars(score) {
            stars.forEach((star, index) => {
                const starValue = parseInt(star.getAttribute('data-value'));
                if (starValue <= score) {
                    star.className = 'fa fa-star';
                } else {
                    star.className = 'fa fa-star-o';
                }
            });
        }
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-value'));
                scoreInput.value = value;
                updateStars(value);
            });
            
            star.addEventListener('mouseenter', function() {
                const value = parseInt(this.getAttribute('data-value'));
                stars.forEach((s, idx) => {
                    const starVal = parseInt(s.getAttribute('data-value'));
                    if (starVal <= value) {
                        s.className = 'fa fa-star';
                    } else {
                        s.className = 'fa fa-star-o';
                    }
                });
            });
        });
        
        document.querySelector('#ratingStars').addEventListener('mouseleave', function() {
            const currentValue = parseInt(scoreInput.value) || 0;
            updateStars(currentValue);
        });
        
        scoreInput.addEventListener('input', function() {
            let value = parseInt(this.value);
            if (value < 1) value = 1;
            if (value > 5) value = 5;
            this.value = value;
            updateStars(value);
        });
    </script>
</div>