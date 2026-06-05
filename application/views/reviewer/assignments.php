<div class="content-wrapper">
    <style>
        /* Modern CSS for Review Assignments */
        .review-assignments-container {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --success: #10b981;
            --success-dark: #059669;
            --danger: #ef4444;
            --danger-dark: #dc2626;
            --warning: #f59e0b;
            --info: #06b6d4;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --radius-md: 12px;
            --radius-lg: 16px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --transition: all 0.2s ease;
        }

        .review-assignments-container .content-header {
            padding: 24px 24px 20px 24px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: var(--radius-lg);
            margin-bottom: 24px;
            border-left: 4px solid var(--primary);
        }

        .review-assignments-container .content-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0 0 6px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .review-assignments-container .content-header h1 i {
            color: var(--primary);
            font-size: 28px;
        }

        .review-assignments-container .content-header h1 small {
            font-size: 14px;
            font-weight: 400;
            color: var(--gray-500);
            margin-left: 4px;
        }

        /* Stats Summary Cards */
        .stats-summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            padding: 0 24px;
            margin-bottom: 28px;
        }

        @media (max-width: 992px) {
            .stats-summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .stats-summary {
                grid-template-columns: 1fr;
                padding: 0 16px;
            }
        }

        .stat-summary-card {
            background: white;
            border-radius: var(--radius-md);
            padding: 16px 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: var(--transition);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-summary-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-summary-info h4 {
            font-size: 28px;
            font-weight: 800;
            margin: 0;
            line-height: 1.2;
        }

        .stat-summary-info p {
            font-size: 12px;
            color: var(--gray-500);
            margin: 6px 0 0 0;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-summary-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-pending .stat-summary-info h4 { color: var(--warning); }
        .stat-pending .stat-summary-icon { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .stat-accepted .stat-summary-info h4 { color: var(--success); }
        .stat-accepted .stat-summary-icon { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-declined .stat-summary-info h4 { color: var(--danger); }
        .stat-declined .stat-summary-icon { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
        .stat-overdue .stat-summary-info h4 { color: var(--danger); }
        .stat-overdue .stat-summary-icon { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

        /* Main Table Card */
        .table-card {
            background: white;
            border-radius: var(--radius-lg);
            margin: 0 24px 24px 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .table-header {
            padding: 18px 24px;
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .table-header h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .table-header h3 i {
            color: var(--primary);
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 30px;
            padding: 6px 16px;
        }

        .search-box i {
            color: var(--gray-400);
        }

        .search-box input {
            border: none;
            outline: none;
            padding: 6px 0;
            width: 200px;
            font-size: 13px;
        }

        @media (max-width: 640px) {
            .search-box input {
                width: 140px;
            }
        }

        /* Modern Table */
        .modern-table {
            width: 100%;
            border-collapse: collapse;
        }

        .modern-table thead th {
            text-align: left;
            padding: 16px 16px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-500);
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
        }

        .modern-table tbody td {
            padding: 18px 16px;
            font-size: 13px;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }

        .modern-table tbody tr {
            transition: var(--transition);
        }

        .modern-table tbody tr:hover {
            background: var(--gray-50);
        }

        /* Badges */
        .badge-modern {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-warning { background: #fed7aa; color: #92400e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-default { background: var(--gray-100); color: var(--gray-600); }
        .badge-primary { background: #dbeafe; color: #1e40af; }

        /* Action Buttons */
        .action-group {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            align-items: center;
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
        }

        .btn-icon:hover {
            transform: translateY(-1px);
            text-decoration: none;
        }

        .btn-info {
            background: var(--primary);
            color: white;
        }
        .btn-info:hover { background: var(--primary-dark); color: white; }

        .btn-success {
            background: var(--success);
            color: white;
        }
        .btn-success:hover { background: var(--success-dark); color: white; }

        .btn-danger {
            background: var(--danger);
            color: white;
        }
        .btn-danger:hover { background: var(--danger-dark); color: white; }

        .inline-form {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }

        .reason-input {
            padding: 6px 10px;
            border: 1px solid var(--gray-200);
            border-radius: 30px;
            font-size: 11px;
            width: 150px;
            outline: none;
            transition: var(--transition);
        }

        .reason-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
        }

        .manuscript-title {
            font-weight: 500;
            max-width: 280px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        .manuscript-number {
            font-weight: 700;
            color: var(--primary);
            font-family: monospace;
        }

        .response-reason {
            font-size: 10px;
            color: var(--gray-500);
            margin-top: 4px;
            max-width: 180px;
            word-break: break-word;
        }

        .empty-state {
            text-align: center;
            padding: 60px 24px;
        }

        .empty-state i {
            font-size: 48px;
            color: var(--gray-300);
            margin-bottom: 16px;
            display: block;
        }

        .empty-state p {
            color: var(--gray-500);
            font-size: 14px;
            margin: 0;
        }

        /* Tooltip */
        .tooltip-text {
            cursor: help;
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .modern-table {
                min-width: 800px;
            }
        }

        @media (max-width: 768px) {
            .review-assignments-container .content-header {
                margin: 16px;
                padding: 16px 20px;
            }
            .review-assignments-container .content-header h1 {
                font-size: 20px;
            }
            .stats-summary {
                padding: 0 16px;
            }
            .table-card {
                margin: 0 16px 20px 16px;
                overflow-x: auto;
            }
            .table-header {
                padding: 14px 18px;
                flex-direction: column;
                align-items: flex-start;
            }
            .search-box input {
                width: 100%;
            }
            .action-group {
                flex-direction: column;
                align-items: flex-start;
            }
            .inline-form {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }
            .reason-input {
                width: 100%;
            }
        }

        /* Due date overdue styling */
        .due-overdue {
            color: var(--danger);
            font-weight: 600;
        }

        .due-soon {
            color: var(--warning);
        }
    </style>

    <div class="review-assignments-container">
        <section class="content-header">
            <h1>
                <i class="fa fa-tasks"></i>
                Review Assignments
                <small>Accept or decline invitations and monitor deadlines</small>
            </h1>
        </section>

        <section class="content">
            <?php
                // Calculate statistics from assignments
                $totalAssignments = !empty($assignments) ? count($assignments) : 0;
                $pendingCount = 0;
                $acceptedCount = 0;
                $declinedCount = 0;
                $overdueCount = 0;
                $currentDate = date('Y-m-d');

                if (!empty($assignments)) {
                    foreach ($assignments as $item) {
                        $responseStatus = $item->responseStatus ?? 'pending';
                        if ($responseStatus === 'pending') $pendingCount++;
                        elseif ($responseStatus === 'accepted') $acceptedCount++;
                        elseif ($responseStatus === 'declined') $declinedCount++;

                        // Check for overdue (due date passed and not completed)
                        if (!empty($item->reviewDueDate) && $item->reviewDueDate < $currentDate) {
                            if ($responseStatus !== 'declined') {
                                $overdueCount++;
                            }
                        }
                    }
                }
            ?>

            <!-- Stats Summary -->
            <div class="stats-summary">
                <div class="stat-summary-card">
                    <div class="stat-summary-info">
                        <h4><?php echo $totalAssignments; ?></h4>
                        <p>Total Assignments</p>
                    </div>
                    <div class="stat-summary-icon"><i class="fa fa-file-text-o"></i></div>
                </div>
                <div class="stat-summary-card stat-pending">
                    <div class="stat-summary-info">
                        <h4><?php echo $pendingCount; ?></h4>
                        <p>Pending Response</p>
                    </div>
                    <div class="stat-summary-icon"><i class="fa fa-clock-o"></i></div>
                </div>
                <div class="stat-summary-card stat-accepted">
                    <div class="stat-summary-info">
                        <h4><?php echo $acceptedCount; ?></h4>
                        <p>Accepted</p>
                    </div>
                    <div class="stat-summary-icon"><i class="fa fa-check-circle"></i></div>
                </div>
                <div class="stat-summary-card stat-declined">
                    <div class="stat-summary-info">
                        <h4><?php echo $declinedCount; ?></h4>
                        <p>Declined</p>
                    </div>
                    <div class="stat-summary-icon"><i class="fa fa-times-circle"></i></div>
                </div>
            </div>

            <!-- Main Table -->
            <div class="table-card">
                <div class="table-header">
                    <h3>
                        <i class="fa fa-list-ul"></i>
                        All Review Assignments
                        <span style="font-size: 12px; font-weight: normal; background: var(--gray-100); padding: 2px 8px; border-radius: 30px;">Newest first</span>
                    </h3>
                    <div class="search-box">
                        <i class="fa fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Search by manuscript # or title...">
                    </div>
                </div>
                <div style="overflow-x: auto;">
                    <table class="modern-table" id="assignmentsTable">
                        <thead>
                            <tr>
                                <th>Manuscript #</th>
                                <th>Title</th>
                                <th>Manuscript Status</th>
                                <th>Due Date</th>
                                <th>Invitation</th>
                                <th>Review Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($assignments)): ?>
                                <?php 
                                // Sort assignments in descending order by assignmentId or created date
                                $sortedAssignments = $assignments;
                                usort($sortedAssignments, function($a, $b) {
                                    $idA = isset($a->assignmentId) ? (int)$a->assignmentId : 0;
                                    $idB = isset($b->assignmentId) ? (int)$b->assignmentId : 0;
                                    return $idB - $idA;
                                });
                                foreach ($sortedAssignments as $item): 
                                    $dueDate = $item->reviewDueDate ?? '';
                                    $dueClass = '';
                                    $dueText = '-';
                                    if (!empty($dueDate)) {
                                        $dueTimestamp = strtotime($dueDate);
                                        $dueText = date('d M Y', $dueTimestamp);
                                        if ($dueDate < $currentDate && ($item->responseStatus ?? '') !== 'declined' && ($item->status ?? '') !== 'completed') {
                                            $dueClass = 'due-overdue';
                                        } elseif ($dueDate < date('Y-m-d', strtotime('+7 days')) && ($item->responseStatus ?? '') !== 'declined') {
                                            $dueClass = 'due-soon';
                                        }
                                    }
                                ?>
                                <tr>
                                    <td><span class="manuscript-number"><?php echo html_escape($item->manuscriptNumber ?? '-'); ?></span></td>
                                    <td>
                                        <span class="manuscript-title" title="<?php echo html_escape($item->title ?? ''); ?>">
                                            <?php echo html_escape(strlen($item->title ?? '') > 70 ? substr($item->title, 0, 70) . '...' : ($item->title ?? '-')); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $msStatus = $item->manuscriptStatus ?? 'submitted';
                                        $msClass = 'badge-info';
                                        if ($msStatus === 'accepted') $msClass = 'badge-success';
                                        elseif ($msStatus === 'rejected') $msClass = 'badge-danger';
                                        elseif ($msStatus === 'under_review') $msClass = 'badge-warning';
                                        ?>
                                        <span class="badge-modern <?php echo $msClass; ?>">
                                            <?php echo html_escape(ucfirst(str_replace('_', ' ', $msStatus))); ?>
                                        </span>
                                    </td>
                                    <td class="<?php echo $dueClass; ?>">
                                        <i class="fa fa-calendar"></i> <?php echo $dueText; ?>
                                        <?php if ($dueClass === 'due-overdue'): ?>
                                            <br><small class="text-danger">Overdue!</small>
                                        <?php elseif ($dueClass === 'due-soon'): ?>
                                            <br><small class="text-warning">Due soon</small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $responseStatus = $item->responseStatus ?? 'pending';
                                        $responseClass = 'badge-warning';
                                        if ($responseStatus === 'accepted') $responseClass = 'badge-success';
                                        elseif ($responseStatus === 'declined') $responseClass = 'badge-danger';
                                        ?>
                                        <span class="badge-modern <?php echo $responseClass; ?>">
                                            <i class="fa <?php echo $responseStatus === 'accepted' ? 'fa-check' : ($responseStatus === 'declined' ? 'fa-times' : 'fa-clock-o'); ?>"></i>
                                            <?php echo ucfirst($responseStatus); ?>
                                        </span>
                                        <?php if (!empty($item->responseReason)): ?>
                                            <div class="response-reason" title="<?php echo html_escape($item->responseReason); ?>">
                                                <i class="fa fa-comment-o"></i> <?php echo html_escape(strlen($item->responseReason) > 40 ? substr($item->responseReason, 0, 40) . '...' : $item->responseReason); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $reviewStatus = $item->status ?? 'pending';
                                        $statusClass = 'badge-default';
                                        if ($reviewStatus === 'completed') $statusClass = 'badge-success';
                                        elseif ($reviewStatus === 'in_progress') $statusClass = 'badge-warning';
                                        ?>
                                        <span class="badge-modern <?php echo $statusClass; ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $reviewStatus)); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-group">
                                            <a class="btn-icon btn-info" href="<?php echo base_url('reviewer/assignment/'.($item->assignmentId ?? 0)); ?>">
                                                <i class="fa fa-eye"></i> Open
                                            </a>
                                            <?php if ($responseStatus === 'pending'): ?>
                                                <form method="post" action="<?php echo base_url('reviewer/assignment/accept/'.($item->assignmentId ?? 0)); ?>" class="inline-form" onsubmit="return confirm('Accept this review invitation?');">
                                                    <input type="text" name="responseReason" class="reason-input" placeholder="Reason for accepting" required>
                                                    <button class="btn-icon btn-success" type="submit">
                                                        <i class="fa fa-check"></i> Accept
                                                    </button>
                                                </form>
                                                <form method="post" action="<?php echo base_url('reviewer/assignment/decline/'.($item->assignmentId ?? 0)); ?>" class="inline-form" onsubmit="return confirm('Decline this review invitation?');">
                                                    <input type="text" name="responseReason" class="reason-input" placeholder="Reason for declining" required>
                                                    <button class="btn-icon btn-danger" type="submit">
                                                        <i class="fa fa-times"></i> Decline
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="empty-state">
                                        <i class="fa fa-inbox"></i>
                                        <p>No review assignments available.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let table = document.getElementById('assignmentsTable');
            let rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                let manuscriptCell = rows[i].getElementsByTagName('td')[0];
                let titleCell = rows[i].getElementsByTagName('td')[1];
                
                if (manuscriptCell && titleCell) {
                    let manuscriptText = manuscriptCell.textContent || manuscriptCell.innerText;
                    let titleText = titleCell.textContent || titleCell.innerText;
                    
                    if (manuscriptText.toLowerCase().indexOf(searchValue) > -1 || 
                        titleText.toLowerCase().indexOf(searchValue) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        });
    </script>
</div>