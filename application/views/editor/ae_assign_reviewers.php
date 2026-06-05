<!-- Assign Reviewers Page -->
<div class="content-wrapper assign-reviewers-page">
    <style>
        :root {
            --primary-dark: #0f2b3d;
            --primary: #1a6d7e;
            --primary-light: #2a9d8f;
            --accent: #e9c46a;
            --gray-bg: #f8fafc;
            --border-light: #e2e8f0;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --transition: all 0.2s ease;
        }

        .assign-reviewers-page {
            background: #f1f5f9;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .assign-reviewers-page .content-header h1 {
            font-weight: 700;
            font-size: 26px;
            color: var(--primary-dark);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .assign-reviewers-page .content-header {
            padding: 24px 24px 16px 24px;
        }

        /* Stats Cards */
        .stats-row {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            padding: 0 24px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 18px 24px;
            flex: 1;
            min-width: 160px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-card .stat-number {
            font-size: 32px;
            font-weight: 800;
            color: var(--primary);
            line-height: 1.2;
        }

        .stat-card .stat-label {
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            font-weight: 600;
            margin-top: 4px;
        }

        /* Main Container */
        .manuscripts-container {
            background: white;
            border-radius: 24px;
            margin: 0 24px 24px 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
            overflow: hidden;
        }

        /* Table Styles */
        .manuscripts-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .manuscripts-table thead tr {
            background: var(--gray-bg);
        }

        .manuscripts-table th {
            padding: 18px 16px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-light);
        }

        .manuscripts-table td {
            padding: 18px 16px;
            font-size: 14px;
            color: var(--text-dark);
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
        }

        .manuscripts-table tbody tr {
            transition: var(--transition);
        }

        .manuscripts-table tbody tr:hover {
            background: #fafcff;
        }

        /* Title cell */
        .title-cell {
            max-width: 280px;
        }

        .title-text {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 500;
        }

        /* Thematic Area Badge */
        .thematic-badge {
            background: #e0f2fe;
            color: #0369a1;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }

        /* Assign Button */
        .btn-assign {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 8px 20px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition);
            border: none;
        }

        .btn-assign:hover {
            transform: translateY(-2px);
            filter: brightness(1.05);
            color: white;
        }

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
            color: var(--text-muted);
            font-size: 15px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .assign-reviewers-page .content-header {
                padding: 20px 16px 12px 16px;
            }

            .stats-row {
                padding: 0 16px;
                gap: 12px;
            }

            .stat-card {
                padding: 12px 16px;
                min-width: 100px;
            }

            .stat-card .stat-number {
                font-size: 24px;
            }

            .manuscripts-container {
                margin: 0 16px 20px 16px;
                overflow-x: auto;
            }

            .manuscripts-table {
                min-width: 550px;
            }

            .manuscripts-table th,
            .manuscripts-table td {
                padding: 12px 12px;
            }
        }
    </style>

    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus" style="color: var(--primary); margin-right: 10px;"></i>
            Assign Reviewers
        </h1>
    </section>

    <section class="content">
        <?php 
        $total = !empty($manuscripts) ? count($manuscripts) : 0;
        ?>

        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-number"><?= $total ?></div>
                <div class="stat-label">Accepted Manuscripts</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $total ?></div>
                <div class="stat-label">Awaiting Reviewer Assignment</div>
            </div>
        </div>

        <div class="manuscripts-container">
            <div class="table-responsive">
                <table class="manuscripts-table">
                    <thead>
                        <tr>
                            <th>Manuscript #</th>
                            <th>Title</th>
                            <th>Thematic Area</th>
                            <th>Keywords</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($manuscripts)): foreach($manuscripts as $m): ?>
                        <tr>
                            <td data-label="Manuscript #" style="font-weight: 600; color: var(--primary);">
                                <?= html_escape($m->manuscriptNumber) ?>
                            </td>
                            <td class="title-cell" data-label="Title">
                                <span class="title-text" title="<?= html_escape($m->title) ?>">
                                    <?= html_escape($m->title) ?>
                                </span>
                            </td>
                            <td data-label="Thematic Area">
                                <?php if(!empty($m->thematicArea)): ?>
                                    <span class="thematic-badge"><?= html_escape($m->thematicArea) ?></span>
                                <?php else: ?>
                                    <span style="color: var(--text-muted);">—</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Keywords">
                                <?php 
                                $keywords = html_escape($m->keywords ?: '');
                                if($keywords && $keywords !== '-'):
                                    $kwArray = array_slice(explode(',', $keywords), 0, 2);
                                    $displayKw = implode(', ', $kwArray);
                                    if(count(explode(',', $keywords)) > 2) $displayKw .= '…';
                                ?>
                                    <span title="<?= $keywords ?>"><?= $displayKw ?></span>
                                <?php else: ?>
                                    <span style="color: var(--text-muted);">—</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Action" style="text-align: center;">
                                <a class="btn-assign" href="<?= base_url('editor/ae-assign-reviewers/'.$m->manuscriptId) ?>">
                                    <i class="fa fa-users"></i> Assign Reviewers
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="5" class="empty-state">
                                <i class="fa fa-check-circle-o"></i>
                                <p>No accepted manuscripts found. All manuscripts have been assigned reviewers!</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Accepted Manuscript Details Page -->
<div class="content-wrapper manuscript-detail-page">
    <style>
        .manuscript-detail-page {
            background: #f1f5f9;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .manuscript-detail-page .content-header h1 {
            font-weight: 700;
            font-size: 26px;
            color: var(--primary-dark);
            margin: 0;
        }

        .manuscript-detail-page .content-header {
            padding: 24px 24px 16px 24px;
        }

        /* Detail Container */
        .detail-container {
            background: white;
            border-radius: 24px;
            margin: 0 24px 24px 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
            overflow: hidden;
        }

        .detail-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            padding: 24px 28px;
            color: white;
        }

        .detail-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
        }

        .detail-header .manuscript-code {
            font-size: 13px;
            opacity: 0.8;
            margin-top: 6px;
            letter-spacing: 0.5px;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .info-card {
            background: var(--gray-bg);
            border-radius: 16px;
            padding: 18px 20px;
            border: 1px solid var(--border-light);
            transition: var(--transition);
        }

        .info-card:hover {
            border-color: var(--primary-light);
            background: white;
        }

        .info-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            margin-bottom: 8px;
            display: block;
        }

        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: var(--text-dark);
            word-break: break-word;
        }

        .abstract-box {
            background: var(--gray-bg);
            border-radius: 16px;
            padding: 20px;
            margin: 20px 0;
            border: 1px solid var(--border-light);
        }

        .abstract-box h4 {
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 12px 0;
            color: var(--text-dark);
        }

        .abstract-text {
            line-height: 1.7;
            color: var(--text-dark);
            font-size: 14px;
        }

        /* Files Section */
        .files-section {
            background: var(--gray-bg);
            border-radius: 16px;
            padding: 20px;
            margin: 20px 0;
        }

        .files-section h4 {
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 16px 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .file-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .file-list li {
            margin-bottom: 10px;
        }

        .file-list a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            background: white;
            border-radius: 40px;
            text-decoration: none;
            color: var(--primary);
            font-weight: 500;
            font-size: 13px;
            border: 1px solid var(--border-light);
            transition: var(--transition);
        }

        .file-list a:hover {
            border-color: var(--primary-light);
            transform: translateX(4px);
        }

        /* Comments Well */
        .comments-well {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 20px;
            padding: 22px;
            margin: 20px 0;
        }

        .comments-well h4 {
            margin: 0 0 16px 0;
            font-size: 16px;
            font-weight: 700;
            color: #b45309;
        }

        .comment-block {
            margin-bottom: 20px;
        }

        .comment-block strong {
            display: block;
            margin-bottom: 8px;
            color: var(--text-dark);
        }

        .comment-block p {
            margin: 0;
            line-height: 1.6;
            color: var(--text-dark);
        }

        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-accepted { background: #ecfdf5; color: #065f46; }
        .status-under_review { background: #fffbeb; color: #b45309; }
        .status-rejected { background: #fef2f2; color: #991b1b; }
        .status-default { background: #f1f5f9; color: #475569; }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            flex-wrap: wrap;
        }

        .btn-back {
            background: var(--gray-bg);
            color: var(--text-dark);
            padding: 10px 24px;
            border-radius: 40px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid var(--border-light);
            transition: var(--transition);
        }

        .btn-back:hover {
            background: white;
            border-color: var(--primary-light);
        }

        @media (max-width: 768px) {
            .manuscript-detail-page .content-header {
                padding: 20px 16px 12px 16px;
            }

            .detail-container {
                margin: 0 16px 20px 16px;
            }

            .detail-header {
                padding: 18px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-back {
                justify-content: center;
            }
        }
    </style>

    <section class="content-header">
        <h1>
            <i class="fa fa-file-text-o" style="color: var(--primary); margin-right: 10px;"></i>
            Accepted Manuscript Details
        </h1>
    </section>

    <section class="content">
        <div class="detail-container">
            <div class="detail-header">
                <div class="manuscript-code"><?= html_escape($manuscript->manuscriptNumber ?? 'N/A') ?></div>
                <h3><?= html_escape($manuscript->title ?? 'Untitled Manuscript') ?></h3>
            </div>

            <div style="padding: 28px;">
                <div class="info-grid">
                    <div class="info-card">
                        <span class="info-label">📂 Thematic Area</span>
                        <span class="info-value"><?= html_escape($manuscript->thematicArea ?: '-') ?></span>
                    </div>
                    <div class="info-card">
                        <span class="info-label">🏷️ Keywords</span>
                        <span class="info-value"><?= html_escape($manuscript->keywords ?: '-') ?></span>
                    </div>
                    <div class="info-card">
                        <span class="info-label">📊 Status</span>
                        <span class="info-value">
                            <span class="status-badge status-<?= html_escape($manuscript->status ?? 'default') ?>">
                                <?= html_escape(ucfirst($manuscript->status ?? 'Unknown')) ?>
                            </span>
                        </span>
                    </div>
                    <div class="info-card">
                        <span class="info-label">⚖️ EIC Decision</span>
                        <span class="info-value"><?= html_escape(ucfirst($manuscript->eicMeDecision ?: 'Pending')) ?></span>
                    </div>
                    <div class="info-card">
                        <span class="info-label">🔬 ME Screening Result</span>
                        <span class="info-value">
                            <?= html_escape(ucfirst($manuscript->meResultStatus ?: 'Pending')) ?>
                            <?php if(isset($manuscript->totalScore) && $manuscript->totalScore !== '' && $manuscript->totalScore !== null): ?>
                                (<?= (int)$manuscript->totalScore ?>/100)
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="info-card">
                        <span class="info-label">📅 Submitted Date</span>
                        <span class="info-value"><?= !empty($manuscript->createdDtm) ? date('d M Y, H:i', strtotime($manuscript->createdDtm)) : '-' ?></span>
                    </div>
                </div>

                <div class="abstract-box">
                    <h4>📖 Abstract</h4>
                    <div class="abstract-text">
                        <?= !empty($manuscript->abstract) ? nl2br(html_escape($manuscript->abstract)) : '<span style="color: #94a3b8;">No abstract provided.</span>' ?>
                    </div>
                </div>

                <div class="files-section">
                    <h4><i class="fa fa-paperclip"></i> Manuscript Files</h4>
                    <ul class="file-list">
                        <?php if (!empty($manuscript->file)): ?>
                            <li><a href="<?= base_url($manuscript->file) ?>" target="_blank"><i class="fa fa-file-pdf-o"></i> Main Manuscript File</a></li>
                        <?php else: ?>
                            <li><span style="color: #94a3b8;"><i class="fa fa-file-o"></i> No main file uploaded</span></li>
                        <?php endif; ?>
                        <?php if (!empty($manuscript->coverLetter)): ?>
                            <li><a href="<?= base_url($manuscript->coverLetter) ?>" target="_blank"><i class="fa fa-envelope-o"></i> Cover Letter</a></li>
                        <?php endif; ?>
                        <?php if (!empty($manuscript->resultFilePath)): ?>
                            <li><a href="<?= base_url($manuscript->resultFilePath) ?>" target="_blank"><i class="fa fa-bar-chart"></i> ME Screening File</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="comments-well">
                    <h4><i class="fa fa-comments-o"></i> Editorial Comments</h4>
                    <div class="comment-block">
                        <strong>📝 Editor-in-Chief Comments:</strong>
                        <p><?= nl2br(html_escape($manuscript->technicalScreeningNotes ?: 'No EIC comments yet.')) ?></p>
                    </div>
                    <div class="comment-block">
                        <strong>💬 Managing Editor Comments:</strong>
                        <p><?= nl2br(html_escape($manuscript->meComments ?: 'No ME comments yet.')) ?></p>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="<?= base_url('editor/ae-assignments') ?>" class="btn-back">
                        <i class="fa fa-arrow-left"></i> Back to Assignments
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Font Awesome 4.7 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">