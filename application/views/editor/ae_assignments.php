<div class="content-wrapper ae-assignments-page">
    <style>
        :root {
            --primary-dark: #0f2b3d;
            --primary: #1a6d7e;
            --primary-light: #2a9d8f;
            --accent: #e9c46a;
            --warning-bg: #fffbeb;
            --warning-border: #fde68a;
            --warning-text: #b45309;
            --success-bg: #ecfdf5;
            --success-border: #a7f3d0;
            --success-text: #065f46;
            --danger-bg: #fef2f2;
            --danger-border: #fecaca;
            --danger-text: #991b1b;
            --gray-bg: #f8fafc;
            --border-light: #e2e8f0;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.2s ease;
        }

        .ae-assignments-page {
            background: #f1f5f9;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }

        .ae-assignments-page .content-header h1 {
            font-weight: 700;
            font-size: 26px;
            color: var(--primary-dark);
            margin: 0 0 8px 0;
            letter-spacing: -0.02em;
        }

        .ae-assignments-page .content-header {
            padding: 24px 24px 16px 24px;
        }

        /* Stats Bar */
        .stats-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 28px;
            padding: 0 24px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 16px 24px;
            flex: 1;
            min-width: 140px;
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
        }

        .stat-card.pending .stat-number { color: #d97706; }
        .stat-card.accepted .stat-number { color: #059669; }
        .stat-card.declined .stat-number { color: #dc2626; }

        /* Main Container */
        .ae-assignments-page .assignments-container {
            background: white;
            border-radius: 24px;
            margin: 0 24px 24px 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-light);
            overflow: hidden;
        }

        /* Table Styles */
        .ae-assignments-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .ae-assignments-table thead tr {
            background: var(--gray-bg);
        }

        .ae-assignments-table th {
            padding: 18px 16px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border-light);
            background: #f8fafc;
        }

        .ae-assignments-table td {
            padding: 18px 16px;
            font-size: 14px;
            color: var(--text-dark);
            border-bottom: 1px solid var(--border-light);
            vertical-align: middle;
        }

        .ae-assignments-table tbody tr {
            transition: var(--transition);
        }

        .ae-assignments-table tbody tr:hover {
            background: #fafcff;
        }

        /* Custom Badges */
        .response-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .response-badge i {
            font-size: 12px;
        }

        .response-badge.accepted {
            background: var(--success-bg);
            color: var(--success-text);
            border: 1px solid var(--success-border);
        }

        .response-badge.declined {
            background: var(--danger-bg);
            color: var(--danger-text);
            border: 1px solid var(--danger-border);
        }

        .response-badge.pending {
            background: var(--warning-bg);
            color: var(--warning-text);
            border: 1px solid var(--warning-border);
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .btn-action {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
        }

        .btn-action i {
            font-size: 12px;
        }

        .btn-accept {
            background: #059669;
            color: white;
        }

        .btn-accept:hover {
            background: #047857;
            transform: translateY(-1px);
        }

        .btn-decline {
            background: #dc2626;
            color: white;
        }

        .btn-decline:hover {
            background: #b91c1c;
            transform: translateY(-1px);
        }

        .btn-view {
            background: var(--primary);
            color: white;
        }

        .btn-view:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        /* Title cell with truncation */
        .title-cell {
            max-width: 280px;
            font-weight: 500;
        }

        .title-cell .title-text {
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
            margin: 0;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .ae-assignments-page .content-header {
                padding: 20px 16px 12px 16px;
            }

            .stats-bar {
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

            .ae-assignments-page .assignments-container {
                margin: 0 16px 20px 16px;
                border-radius: 20px;
                overflow-x: auto;
            }

            .ae-assignments-table {
                min-width: 600px;
            }

            .ae-assignments-table th,
            .ae-assignments-table td {
                padding: 12px 12px;
            }

            .title-cell {
                max-width: 180px;
            }

            .action-group {
                flex-direction: column;
                gap: 6px;
            }

            .btn-action {
                justify-content: center;
                width: 100%;
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .stats-bar {
                flex-wrap: wrap;
            }
            
            .stat-card {
                flex: 1 1 calc(33% - 12px);
                min-width: 0;
            }
        }

        /* Tooltip */
        [data-tooltip] {
            position: relative;
            cursor: help;
        }

        [data-tooltip]:before {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 4px 10px;
            background: #1e293b;
            color: white;
            font-size: 11px;
            border-radius: 20px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
            z-index: 10;
        }

        [data-tooltip]:hover:before {
            opacity: 1;
        }
    </style>

    <section class="content-header">
        <h1>
            <i class="fa fa-tasks" style="color: var(--primary); margin-right: 10px;"></i>
            Associate Editor Assignments
        </h1>
    </section>

    <section class="content">
        <?php 
        // Calculate statistics
        $total = count($assignments);
        $pending = 0;
        $accepted = 0;
        $declined = 0;
        if(!empty($assignments)) {
            foreach($assignments as $m) {
                if($m->aeAssignmentResponse === 'pending') $pending++;
                elseif($m->aeAssignmentResponse === 'accepted') $accepted++;
                elseif($m->aeAssignmentResponse === 'declined') $declined++;
            }
        }
        ?>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="stat-card">
                <div class="stat-number"><?= $total ?></div>
                <div class="stat-label">Total Assignments</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-number"><?= $pending ?></div>
                <div class="stat-label">Pending Response</div>
            </div>
            <div class="stat-card accepted">
                <div class="stat-number"><?= $accepted ?></div>
                <div class="stat-label">Accepted</div>
            </div>
            <div class="stat-card declined">
                <div class="stat-number"><?= $declined ?></div>
                <div class="stat-label">Declined</div>
            </div>
        </div>

        <!-- Main Table Container -->
        <div class="assignments-container">
            <div class="table-responsive">
                <table class="ae-assignments-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Thematic Area</th>
                            <th>Keywords</th>
                            <th>Response</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($assignments)): foreach($assignments as $m): ?>
                        <tr>
                            <td data-label="#" style="font-weight: 600; color: var(--primary);">
                                <?= html_escape($m->manuscriptNumber) ?>
                            </td>
                            <td class="title-cell" data-label="Title">
                                <span class="title-text" data-tooltip="<?= html_escape($m->title) ?>">
                                    <?= html_escape($m->title) ?>
                                </span>
                            </td>
                            <td data-label="Thematic Area">
                                <?php if(!empty($m->thematicArea)): ?>
                                    <span style="background: #e0f2fe; padding: 4px 10px; border-radius: 30px; font-size: 12px; display: inline-block;">
                                        <?= html_escape($m->thematicArea) ?>
                                    </span>
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
                                    <span data-tooltip="<?= $keywords ?>">
                                        <?= $displayKw ?>
                                    </span>
                                <?php else: ?>
                                    <span style="color: var(--text-muted);">—</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Response">
                                <?php 
                                $response = $m->aeAssignmentResponse;
                                $responseClass = '';
                                $responseIcon = '';
                                if($response === 'accepted') {
                                    $responseClass = 'accepted';
                                    $responseIcon = 'fa-check-circle';
                                } elseif($response === 'declined') {
                                    $responseClass = 'declined';
                                    $responseIcon = 'fa-times-circle';
                                } else {
                                    $responseClass = 'pending';
                                    $responseIcon = 'fa-clock-o';
                                }
                                ?>
                                <span class="response-badge <?= $responseClass ?>">
                                    <i class="fa <?= $responseIcon ?>"></i>
                                    <?= html_escape(ucfirst($response)) ?>
                                </span>
                            </td>
                            <td data-label="Actions" style="text-align: center;">
                                <div class="action-group">
                                    <?php if($m->aeAssignmentResponse === 'pending'): ?>
                                        <a class="btn-action btn-accept" href="<?= base_url('editor/ae-assignments/respond/'.$m->manuscriptId.'/accepted') ?>" 
                                           onclick="return confirm('Accept this assignment? You will be able to review the manuscript details afterward.')">
                                            <i class="fa fa-check"></i> Accept
                                        </a>
                                        <a class="btn-action btn-decline" href="<?= base_url('editor/ae-assignments/respond/'.$m->manuscriptId.'/declined') ?>"
                                           onclick="return confirm('Decline this assignment? This action cannot be undone.')">
                                            <i class="fa fa-times"></i> Decline
                                        </a>
                                    <?php endif; ?>
                                    
                                    <?php if($m->aeAssignmentResponse === 'accepted'): ?>
                                        <a class="btn-action btn-view" href="<?= base_url('editor/ae-assignments/view/'.$m->manuscriptId) ?>">
                                            <i class="fa fa-eye"></i> View Details
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="6" class="empty-state">
                                <i class="fa fa-inbox"></i>
                                <p>No assignments found. You're all caught up!</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Font Awesome 4.7 if not already loaded -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">