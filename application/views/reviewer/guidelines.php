<div class="content-wrapper" style="background:#f0f2f5;">
    <style>
        /* Modern CSS for Reviewer Guidelines */
        .guidelines-container {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --success: #10b981;
            --warning: #f59e0b;
            --info: #06b6d4;
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

        .guidelines-container .content-header {
            padding: 24px 24px 20px 24px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: var(--radius-lg);
            margin-bottom: 24px;
            border-left: 4px solid var(--primary);
        }

        .guidelines-container .content-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .guidelines-container .content-header h1 i {
            color: var(--primary);
            font-size: 28px;
        }

        .guidelines-container .content-header h1 small {
            font-size: 14px;
            font-weight: 400;
            color: var(--gray-500);
            background: var(--gray-100);
            padding: 4px 12px;
            border-radius: 30px;
        }

        /* Main Card */
        .guidelines-card {
            background: white;
            border-radius: var(--radius-lg);
            margin: 0 24px 24px 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 28px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .card-header h3 {
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body {
            padding: 32px 28px;
        }

        /* Alert Banner */
        .alert-banner {
            background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);
            border-left: 4px solid var(--primary);
            border-radius: var(--radius-md);
            padding: 18px 22px;
            margin-bottom: 32px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .alert-banner i {
            font-size: 28px;
            color: var(--primary);
        }

        .alert-banner-content strong {
            display: block;
            font-size: 15px;
            color: var(--gray-800);
            margin-bottom: 4px;
        }

        .alert-banner-content p {
            margin: 0;
            font-size: 13px;
            color: var(--gray-600);
            line-height: 1.5;
        }

        /* Section Styles */
        .guidelines-section {
            margin-bottom: 32px;
            border-bottom: 1px solid var(--gray-200);
            padding-bottom: 24px;
        }

        .guidelines-section:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title .number-badge {
            width: 32px;
            height: 32px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }

        .section-title i {
            color: var(--primary);
            font-size: 24px;
        }

        /* List Styles */
        .guidelines-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .guidelines-list li {
            padding: 10px 0 10px 28px;
            position: relative;
            font-size: 14px;
            color: var(--gray-700);
            line-height: 1.6;
        }

        .guidelines-list li:before {
            content: '\f00c';
            font-family: FontAwesome;
            position: absolute;
            left: 0;
            color: var(--success);
            font-size: 14px;
        }

        /* Criteria Grid */
        .criteria-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 16px;
            margin-top: 8px;
        }

        .criteria-item {
            background: var(--gray-50);
            border-radius: var(--radius-md);
            padding: 16px 18px;
            border: 1px solid var(--gray-200);
            transition: var(--transition);
        }

        .criteria-item:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
            border-color: var(--primary-light);
        }

        .criteria-icon {
            width: 40px;
            height: 40px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .criteria-icon i {
            font-size: 20px;
            color: var(--primary);
        }

        .criteria-item h5 {
            font-size: 14px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0 0 6px 0;
        }

        .criteria-item p {
            font-size: 12px;
            color: var(--gray-500);
            margin: 0;
            line-height: 1.5;
        }

        /* Recommendation Cards */
        .rec-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin: 16px 0;
        }

        @media (max-width: 768px) {
            .rec-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .rec-cards {
                grid-template-columns: 1fr;
            }
        }

        .rec-card {
            background: white;
            border-radius: var(--radius-md);
            padding: 16px;
            text-align: center;
            border: 2px solid var(--gray-200);
            transition: var(--transition);
        }

        .rec-card.accept { border-color: #d1fae5; }
        .rec-card.minor { border-color: #dbeafe; }
        .rec-card.major { border-color: #fed7aa; }
        .rec-card.reject { border-color: #fee2e2; }

        .rec-card .rec-icon {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .rec-card.accept .rec-icon { color: var(--success); }
        .rec-card.minor .rec-icon { color: var(--primary); }
        .rec-card.major .rec-icon { color: var(--warning); }
        .rec-card.reject .rec-icon { color: var(--danger); }

        .rec-card h5 {
            font-size: 14px;
            font-weight: 700;
            margin: 0 0 4px 0;
        }

        .rec-card p {
            font-size: 11px;
            color: var(--gray-500);
            margin: 0;
        }

        /* Tip Box */
        .tip-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: var(--radius-md);
            padding: 18px 22px;
            margin: 24px 0;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .tip-box i {
            font-size: 24px;
            color: var(--warning);
        }

        .tip-box-content strong {
            display: block;
            font-size: 14px;
            color: #92400e;
            margin-bottom: 4px;
        }

        .tip-box-content p {
            font-size: 13px;
            color: #b45309;
            margin: 0;
            line-height: 1.5;
        }

        /* Workflow Rule */
        .workflow-rule {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-radius: var(--radius-md);
            padding: 18px 22px;
            margin: 24px 0;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .workflow-rule i {
            font-size: 24px;
            color: var(--danger);
        }

        .workflow-rule-content strong {
            display: block;
            font-size: 14px;
            color: #991b1b;
            margin-bottom: 4px;
        }

        .workflow-rule-content p {
            font-size: 13px;
            color: #7f1d1d;
            margin: 0;
            line-height: 1.5;
        }

        /* Button */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--primary);
            color: white;
            padding: 12px 28px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            margin-top: 16px;
            border: none;
            cursor: pointer;
        }

        .btn-back:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .guidelines-container .content-header {
                margin: 16px;
                padding: 16px 20px;
            }
            .guidelines-container .content-header h1 {
                font-size: 20px;
            }
            .guidelines-card {
                margin: 0 16px 20px 16px;
            }
            .card-header {
                padding: 16px 20px;
            }
            .card-body {
                padding: 24px 20px;
            }
            .section-title {
                font-size: 18px;
            }
            .alert-banner {
                flex-direction: column;
            }
            .tip-box, .workflow-rule {
                flex-direction: column;
            }
        }
    </style>

    <div class="guidelines-container">
        <section class="content-header">
            <h1>
                <i class="fa fa-book"></i>
                Reviewer Guidelines
                <small>Single-page practical checklist</small>
            </h1>
        </section>

        <section class="content">
            <div class="guidelines-card">
                <div class="card-header">
                    <h3>
                        <i class="fa fa-graduation-cap"></i>
                        Peer Review Guidelines for Reviewers
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Goal Alert -->
                    <div class="alert-banner">
                        <i class="fa fa-bullseye"></i>
                        <div class="alert-banner-content">
                            <strong>Goal</strong>
                            <p>Submit one complete recommendation only when you are sure. You can submit again only after the editor requests re-review.</p>
                        </div>
                    </div>

                    <!-- Section 1: Before you start -->
                    <div class="guidelines-section">
                        <div class="section-title">
                            <span class="number-badge">1</span>
                            <i class="fa fa-flag-checkered"></i>
                            Before You Start
                        </div>
                        <ul class="guidelines-list">
                            <li>Confirm no conflict of interest with the authors or their institution.</li>
                            <li>Check the review due date and ensure the manuscript aligns with the journal's scope.</li>
                            <li>Read the manuscript thoroughly at least twice before scoring or making recommendations.</li>
                            <li>Take notes on key strengths and weaknesses as you read.</li>
                        </ul>
                    </div>

                    <!-- Section 2: Evaluation Criteria -->
                    <div class="guidelines-section">
                        <div class="section-title">
                            <span class="number-badge">2</span>
                            <i class="fa fa-clipboard-list"></i>
                            Evaluation Criteria
                        </div>
                        <div class="criteria-grid">
                            <div class="criteria-item">
                                <div class="criteria-icon"><i class="fa fa-lightbulb-o"></i></div>
                                <h5>Novelty & Contribution</h5>
                                <p>Originality of research, significance to the field, and advancement of knowledge.</p>
                            </div>
                            <div class="criteria-item">
                                <div class="criteria-icon"><i class="fa fa-flask"></i></div>
                                <h5>Methodological Soundness</h5>
                                <p>Appropriate methodology, reproducibility, and statistical validity.</p>
                            </div>
                            <div class="criteria-item">
                                <div class="criteria-icon"><i class="fa fa-pie-chart"></i></div>
                                <h5>Results & References</h5>
                                <p>Quality of data interpretation, relevant citations, and proper referencing.</p>
                            </div>
                            <div class="criteria-item">
                                <div class="criteria-icon"><i class="fa fa-shield"></i></div>
                                <h5>Ethics & Integrity</h5>
                                <p>Plagiarism check, ethical approval, and publication integrity.</p>
                            </div>
                            <div class="criteria-item">
                                <div class="criteria-icon"><i class="fa fa-language"></i></div>
                                <h5>Language & Structure</h5>
                                <p>Clarity of writing, logical flow, and adherence to journal formatting.</p>
                            </div>
                            <div class="criteria-item">
                                <div class="criteria-icon"><i class="fa fa-repeat"></i></div>
                                <h5>Reproducibility</h5>
                                <p>Sufficient detail for others to replicate the study.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Recommendation Standards -->
                    <div class="guidelines-section">
                        <div class="section-title">
                            <span class="number-badge">3</span>
                            <i class="fa fa-gavel"></i>
                            Recommendation Standards
                        </div>
                        <p style="margin-bottom: 16px; color: var(--gray-600); font-size: 14px;">
                            Choose exactly one recommendation based on your evaluation:
                        </p>
                        <div class="rec-cards">
                            <div class="rec-card accept">
                                <div class="rec-icon"><i class="fa fa-check-circle"></i></div>
                                <h5>Accept</h5>
                                <p>Accept in present form</p>
                            </div>
                            <div class="rec-card minor">
                                <div class="rec-icon"><i class="fa fa-edit"></i></div>
                                <h5>Minor Revision</h5>
                                <p>Accept after minor revisions</p>
                            </div>
                            <div class="rec-card major">
                                <div class="rec-icon"><i class="fa fa-refresh"></i></div>
                                <h5>Major Revision</h5>
                                <p>Reconsider after major revisions</p>
                            </div>
                            <div class="rec-card reject">
                                <div class="rec-icon"><i class="fa fa-times-circle"></i></div>
                                <h5>Reject</h5>
                                <p>Reject with clear justification</p>
                            </div>
                        </div>
                        <p style="font-size: 13px; color: var(--gray-500); margin-top: 12px;">
                            Provide clear comments to the author and confidential comments to the editor.
                        </p>
                    </div>

                    <!-- Section 4: Communication Quality -->
                    <div class="guidelines-section">
                        <div class="section-title">
                            <span class="number-badge">4</span>
                            <i class="fa fa-comments"></i>
                            Communication Quality
                        </div>
                        <ul class="guidelines-list">
                            <li>Be specific and constructive (avoid one-line comments like "needs improvement").</li>
                            <li>Use numbered points for required fixes to make them easy to address.</li>
                            <li>Keep the tone professional, respectful, and unbiased.</li>
                            <li>Distinguish between mandatory changes and optional suggestions.</li>
                            <li>Avoid personal criticism; focus on the scientific content.</li>
                        </ul>

                        <!-- Tip Box -->
                        <div class="tip-box">
                            <i class="fa fa-lightbulb-o"></i>
                            <div class="tip-box-content">
                                <strong>Pro Tip</strong>
                                <p>Start with positive feedback, then provide constructive criticism, and end with an encouraging note. This "sandwich approach" helps authors receive feedback better.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Workflow Rule -->
                    <div class="guidelines-section">
                        <div class="section-title">
                            <span class="number-badge">5</span>
                            <i class="fa fa-share-alt"></i>
                            Workflow Rules
                        </div>
                        <div class="workflow-rule">
                            <i class="fa fa-info-circle"></i>
                            <div class="workflow-rule-content">
                                <strong>Important Workflow Rule</strong>
                                <p>After you submit your review comments, you cannot submit another comment on the same assignment until the editor explicitly requests re-review. Make sure your review is complete and thorough before submission.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section 6: Additional Tips -->
                    <div class="guidelines-section">
                        <div class="section-title">
                            <span class="number-badge">6</span>
                            <i class="fa fa-star"></i>
                            Additional Tips
                        </div>
                        <ul class="guidelines-list">
                            <li>Respect confidentiality: Do not share the manuscript or your review with anyone.</li>
                            <li>Declare any potential conflicts of interest immediately.</li>
                            <li>Meet your deadline to ensure timely publication processing.</li>
                            <li>If unavailable, decline the invitation promptly so editors can find another reviewer.</li>
                            <li>Review the journal's specific guidelines before starting.</li>
                        </ul>
                    </div>

                    <!-- Back Button -->
                    <a href="<?php echo base_url('reviewer/assignments'); ?>" class="btn-back">
                        <i class="fa fa-arrow-left"></i> Back to Assignments
                    </a>
                </div>
            </div>
        </section>
    </div>
</div>