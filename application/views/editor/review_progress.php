<div class="content-wrapper track-review-page">
    <style>
        .track-review-page {
            background: #f1f5f9;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }

        .track-review-page .content-header {
            padding: 24px 24px 16px 24px;
        }

        .track-review-page .content-header h1 {
            font-weight: 700;
            font-size: 26px;
            color: #0f2b3d;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .track-review-page .content-header h1:before {
            content: '\f0e0';
            font-family: FontAwesome;
            color: #1a6d7e;
            margin-right: 10px;
            font-size: 24px;
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
            min-width: 140px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .stat-card .stat-number {
            font-size: 32px;
            font-weight: 800;
            line-height: 1.2;
        }

        .stat-card .stat-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #64748b;
            font-weight: 600;
            margin-top: 6px;
        }

        .stat-card.total .stat-number { color: #1a6d7e; }
        .stat-card.pending .stat-number { color: #d97706; }
        .stat-card.completed .stat-number { color: #059669; }
        .stat-card.overdue .stat-number { color: #dc2626; }

        /* Main Container */
        .track-container {
            background: white;
            border-radius: 24px;
            margin: 0 24px 24px 24px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        /* Table Styles */
        .track-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .track-table thead tr {
            background: #f8fafc;
        }

        .track-table th {
            padding: 18px 16px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
        }

        .track-table td {
            padding: 20px 16px;
            font-size: 13px;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .track-table tbody tr {
            transition: all 0.2s ease;
        }

        .track-table tbody tr:hover {
            background: #fafcff;
        }

        /* Manuscript Info */
        .manuscript-title {
            font-weight: 600;
            color: #0f2b3d;
            display: block;
            margin-bottom: 4px;
        }

        .manuscript-code {
            font-size: 11px;
            color: #64748b;
            font-family: monospace;
        }

        /* Reviewers List */
        .reviewers-list {
            max-width: 250px;
        }

        .reviewer-item {
            display: inline-block;
            background: #f1f5f9;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
            color: #1e293b;
            margin: 2px;
            white-space: nowrap;
        }

        .reviewer-count {
            display: inline-block;
            background: #e0f2fe;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            color: #0369a1;
            cursor: pointer;
        }

        /* Status Badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 40px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-pending {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
        }

        .status-in-progress {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #bfdbfe;
        }

        .status-completed {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #a7f3d0;
        }

        .status-overdue {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        /* Recommendation Badge */
        .recommendation-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .rec-accepted {
            background: #ecfdf5;
            color: #059669;
        }

        .rec-rejected {
            background: #fef2f2;
            color: #dc2626;
        }

        .rec-minor {
            background: #fffbeb;
            color: #d97706;
        }

        .rec-major {
            background: #fef3c7;
            color: #b45309;
        }

        .rec-default {
            background: #f1f5f9;
            color: #64748b;
        }

        /* Editor Approval */
        .approval-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .approval-approved {
            background: #ecfdf5;
            color: #059669;
        }

        .approval-pending {
            background: #fffbeb;
            color: #d97706;
        }

        .approval-rejected {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Due Date */
        .due-date {
            font-weight: 500;
        }

        .due-overdue {
            color: #dc2626;
            font-weight: 700;
        }

        .due-soon {
            color: #d97706;
        }

        /* Action Button */
        .btn-review-action {
            background: linear-gradient(135deg, #1a6d7e, #2a9d8f);
            color: white;
            padding: 7px 16px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            border: none;
            white-space: nowrap;
        }

        .btn-review-action:hover {
            transform: translateY(-1px);
            filter: brightness(1.05);
            color: white;
            text-decoration: none;
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
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        /* Tooltip */
        .reviewer-tooltip {
            position: relative;
            cursor: pointer;
        }

        .reviewer-tooltip .tooltip-text {
            visibility: hidden;
            background-color: #1e293b;
            color: white;
            text-align: left;
            border-radius: 12px;
            padding: 12px 16px;
            position: absolute;
            z-index: 10;
            bottom: 125%;
            left: 0;
            white-space: nowrap;
            font-size: 12px;
            font-weight: normal;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            opacity: 0;
            transition: opacity 0.2s;
        }

        .reviewer-tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .track-table {
                min-width: 800px;
            }
        }

        @media (max-width: 768px) {
            .track-review-page .content-header {
                padding: 20px 16px 12px 16px;
            }

            .track-review-page .content-header h1 {
                font-size: 22px;
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

            .track-container {
                margin: 0 16px 20px 16px;
                overflow-x: auto;
            }

            .btn-review-action {
                padding: 6px 12px;
                font-size: 10px;
            }
        }
    </style>

    <section class="content-header">
        <h1>Track Review Progress</h1>
    </section>

    <section class="content">
        <?php 
        // Calculate statistics
        $total = !empty($assignments) ? count($assignments) : 0;
        $pending = 0;
        $completed = 0;
        $overdue = 0;
        $currentDate = date('Y-m-d');
        
        if (!empty($assignments)) {
            foreach ($assignments as $a) {
                $status = isset($a->assignmentStatus) ? strtolower($a->assignmentStatus) : '';
                if ($status == 'completed' || $status == 'submitted') {
                    $completed++;
                } elseif ($status == 'pending' || $status == 'invited') {
                    $pending++;
                }
                
                // Check for overdue (if due date passed and not completed)
                if (!empty($a->reviewDueDate) && $a->reviewDueDate < $currentDate) {
                    if ($status != 'completed' && $status != 'submitted') {
                        $overdue++;
                    }
                }
            }
        }
        ?>

        <!-- Stats Cards -->
        <div class="stats-row">
            <div class="stat-card total">
                <div class="stat-number"><?php echo $total; ?></div>
                <div class="stat-label">Total Assignments</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-number"><?php echo $pending; ?></div>
                <div class="stat-label">In Progress</div>
            </div>
            <div class="stat-card completed">
                <div class="stat-number"><?php echo $completed; ?></div>
                <div class="stat-label">Completed</div>
            </div>
            <div class="stat-card overdue">
                <div class="stat-number"><?php echo $overdue; ?></div>
                <div class="stat-label">Overdue</div>
            </div>
        </div>

        <!-- Main Table -->
        <div class="track-container">
            <div class="table-responsive">
                <table class="track-table">
                    <thead>
                        <tr>
                            <th>Manuscript</th>
                            <th>Reviewers</th>
                            <th>Status</th>
                            <th>Recommendation</th>
                            <th>Editor Approval</th>
                            <th>Due Date</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($assignments)): ?>
                            <?php foreach ($assignments as $a): ?>
                                <?php 
                                    $status = isset($a->assignmentStatus) ? strtolower($a->assignmentStatus) : 'pending';
                                    $statusClass = 'pending';
                                    if ($status == 'completed' || $status == 'submitted') {
                                        $statusClass = 'completed';
                                    } elseif ($status == 'in_progress' || $status == 'in-progress') {
                                        $statusClass = 'in-progress';
                                    }
                                    
                                    $recommendation = isset($a->recommendation) ? strtolower($a->recommendation) : '';
                                    $recClass = 'default';
                                    if ($recommendation == 'accepted' || $recommendation == 'accept') {
                                        $recClass = 'accepted';
                                    } elseif ($recommendation == 'rejected' || $recommendation == 'reject') {
                                        $recClass = 'rejected';
                                    } elseif ($recommendation == 'minor_revisions' || $recommendation == 'minor') {
                                        $recClass = 'minor';
                                    } elseif ($recommendation == 'major_revisions' || $recommendation == 'major') {
                                        $recClass = 'major';
                                    }
                                    
                                    $editorApproval = isset($a->editorApproval) ? strtolower($a->editorApproval) : 'pending';
                                    $approvalClass = 'pending';
                                    if ($editorApproval == 'approved' || $editorApproval == 'accept') {
                                        $approvalClass = 'approved';
                                    } elseif ($editorApproval == 'rejected' || $editorApproval == 'decline') {
                                        $approvalClass = 'rejected';
                                    }
                                    
                                    $dueDate = isset($a->reviewDueDate) ? $a->reviewDueDate : '';
                                    $dueClass = '';
                                    $dueText = '-';
                                    if (!empty($dueDate)) {
                                        $dueTimestamp = strtotime($dueDate);
                                        $dueText = date('d M Y', $dueTimestamp);
                                        if ($dueDate < $currentDate && $statusClass != 'completed') {
                                            $dueClass = 'due-overdue';
                                        } elseif ($dueDate < date('Y-m-d', strtotime('+7 days')) && $statusClass != 'completed') {
                                            $dueClass = 'due-soon';
                                        }
                                    }
                                    
                                    $reviewerNames = isset($a->reviewerNames) ? $a->reviewerNames : '';
                                    $reviewerCount = !empty($reviewerNames) ? count(explode(',', $reviewerNames)) : 0;
                                ?>
                                <tr>
                                    <td>
                                        <span class="manuscript-title"><?php echo html_escape(isset($a->manuscriptTitle) ? $a->manuscriptTitle : '-'); ?></span>
                                        <span class="manuscript-code"><?php echo html_escape(isset($a->manuscriptNumber) ? $a->manuscriptNumber : '-'); ?></span>
                                    </td>
                                    <td>
                                        <?php if (!empty($reviewerNames) && $reviewerNames != '-'): ?>
                                            <div class="reviewers-list">
                                                <?php 
                                                    $reviewers = explode(',', $reviewerNames);
                                                    $displayCount = min(3, count($reviewers));
                                                    for ($i = 0; $i < $displayCount; $i++): 
                                                ?>
                                                    <span class="reviewer-item"><?php echo html_escape(trim($reviewers[$i])); ?></span>
                                                <?php endfor; ?>
                                                <?php if (count($reviewers) > 3): ?>
                                                    <span class="reviewer-count reviewer-tooltip">
                                                        +<?php echo (count($reviewers) - 3); ?> more
                                                        <span class="tooltip-text">
                                                            <?php 
                                                                for ($i = 3; $i < count($reviewers); $i++): 
                                                                    echo html_escape(trim($reviewers[$i])) . '<br>';
                                                                endfor; 
                                                            ?>
                                                        </span>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="status-badge status-<?php echo $statusClass; ?>">
                                            <i class="fa <?php echo ($statusClass == 'completed') ? 'fa-check-circle' : (($statusClass == 'in-progress') ? 'fa-spinner fa-pulse' : 'fa-clock-o'); ?>"></i>
                                            <?php echo html_escape(isset($a->assignmentStatus) ? ucfirst($a->assignmentStatus) : 'Pending'); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($recommendation) && $recommendation != '-'): ?>
                                            <span class="recommendation-badge rec-<?php echo $recClass; ?>">
                                                <?php echo html_escape(ucfirst(str_replace('_', ' ', $recommendation))); ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="approval-badge approval-<?php echo $approvalClass; ?>">
                                            <i class="fa <?php echo ($approvalClass == 'approved') ? 'fa-check' : (($approvalClass == 'rejected') ? 'fa-times' : 'fa-hourglass-half'); ?>"></i>
                                            <?php echo html_escape(ucfirst($editorApproval)); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($dueText != '-'): ?>
                                            <span class="due-date <?php echo $dueClass; ?>">
                                                <i class="fa fa-calendar"></i> <?php echo $dueText; ?>
                                                <?php if ($dueClass == 'due-overdue'): ?>
                                                    <br><small class="text-danger">Overdue!</small>
                                                <?php elseif ($dueClass == 'due-soon'): ?>
                                                    <br><small class="text-warning">Due soon</small>
                                                <?php endif; ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <a class="btn-review-action" href="<?php echo base_url('editor/assignments/view/' . (isset($a->manuscriptId) ? (int)$a->manuscriptId : 0)); ?>">
                                            <i class="fa fa-eye"></i> Review Result
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fa fa-inbox"></i>
                                    <p>No reviewer assignments found.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">