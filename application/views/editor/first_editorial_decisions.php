<div class="content-wrapper" style="background: #f0f2f5;">
    <style>
        /* Modern CSS for Editorial Decisions */
        .editorial-container {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --success: #10b981;
            --success-dark: #059669;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #06b6d4;
            --purple: #8b5cf6;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        .editorial-container .content-header {
            padding: 24px 30px 20px 30px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: var(--radius-lg);
            margin-bottom: 24px;
            border-left: 4px solid var(--primary);
            box-shadow: var(--shadow-sm);
        }

        .editorial-container .content-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .editorial-container .content-header h1 i {
            color: var(--primary);
            font-size: 28px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            padding: 0 24px;
            margin-bottom: 28px;
        }

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                padding: 0 16px;
                gap: 12px;
            }
        }

        @media (max-width: 480px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 18px 20px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .stat-info h4 {
            font-size: 28px;
            font-weight: 800;
            margin: 0;
            line-height: 1.2;
        }

        .stat-info p {
            font-size: 11px;
            color: var(--gray-500);
            margin: 6px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .stat-card.primary .stat-info h4 { color: var(--primary); }
        .stat-card.primary .stat-icon { background: rgba(59, 130, 246, 0.1); color: var(--primary); }

        .stat-card.success .stat-info h4 { color: var(--success); }
        .stat-card.success .stat-icon { background: rgba(16, 185, 129, 0.1); color: var(--success); }

        .stat-card.warning .stat-info h4 { color: var(--warning); }
        .stat-card.warning .stat-icon { background: rgba(245, 158, 11, 0.1); color: var(--warning); }

        .stat-card.danger .stat-info h4 { color: var(--danger); }
        .stat-card.danger .stat-icon { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

        .stat-card.purple .stat-info h4 { color: var(--purple); }
        .stat-card.purple .stat-icon { background: rgba(139, 92, 246, 0.1); color: var(--purple); }

        /* Main Table Card */
        .table-card {
            background: white;
            border-radius: var(--radius-xl);
            margin: 0 24px 24px 24px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .table-header {
            padding: 20px 24px;
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
            gap: 10px;
        }

        .table-header h3 i {
            color: var(--primary);
        }

        .badge-count {
            background: var(--primary);
            color: white;
            padding: 2px 10px;
            border-radius: 30px;
            font-size: 12px;
            margin-left: 8px;
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
            width: 220px;
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
            padding: 20px 16px;
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

        /* Manuscript Info */
        .manuscript-number {
            font-weight: 700;
            color: var(--primary);
            font-family: monospace;
            font-size: 13px;
        }

        .manuscript-title {
            display: block;
            font-size: 13px;
            color: var(--gray-600);
            margin-top: 4px;
            max-width: 280px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .associate-editor {
            display: block;
            font-size: 11px;
            color: var(--gray-400);
            margin-top: 4px;
        }

        /* Decision Badge */
        .decision-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
        }

        .decision-accept {
            background: #d1fae5;
            color: #065f46;
        }
        .decision-minor {
            background: #dbeafe;
            color: #1e40af;
        }
        .decision-major {
            background: #fed7aa;
            color: #92400e;
        }
        .decision-reject {
            background: #fee2e2;
            color: #991b1b;
        }
        .decision-resubmit {
            background: #fef3c7;
            color: #b45309;
        }

        .decision-date {
            font-size: 11px;
            color: var(--gray-400);
            margin-top: 4px;
            display: block;
        }

        /* Next Step */
        .next-step {
            font-size: 12px;
            color: var(--gray-600);
            max-width: 200px;
            line-height: 1.4;
        }

        /* Countdown */
        .countdown-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            text-align: center;
        }

        .countdown-info {
            background: #dbeafe;
            color: #1e40af;
        }
        .countdown-warning {
            background: #fed7aa;
            color: #92400e;
        }
        .countdown-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .due-date {
            font-size: 10px;
            color: var(--gray-400);
            margin-top: 4px;
            display: block;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-under_review {
            background: #dbeafe;
            color: #1e40af;
        }
        .status-revision {
            background: #fed7aa;
            color: #92400e;
        }
        .status-accepted {
            background: #d1fae5;
            color: #065f46;
        }
        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }
        .status-default {
            background: var(--gray-100);
            color: var(--gray-600);
        }

        /* Action Button */
        .btn-view {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-view:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 24px;
        }

        .empty-state i {
            font-size: 56px;
            color: var(--gray-300);
            margin-bottom: 16px;
            display: block;
        }

        .empty-state p {
            color: var(--gray-500);
            font-size: 14px;
            margin: 0;
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .modern-table {
                min-width: 800px;
            }
        }

        @media (max-width: 768px) {
            .editorial-container .content-header {
                margin: 16px;
                padding: 16px 20px;
            }
            .editorial-container .content-header h1 {
                font-size: 20px;
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
        }
    </style>

    <div class="editorial-container">
        <section class="content-header">
            <h1>
                <i class="fa fa-gavel"></i>
                First Editorial Decisions
                <small>Manage and track editorial decisions</small>
            </h1>
        </section>

        <section class="content">
            <?php
            // Calculate statistics
            $totalManuscripts = !empty($manuscripts) ? count($manuscripts) : 0;
            $accepted = 0;
            $minorRevision = 0;
            $majorRevision = 0;
            $rejected = 0;
            $resubmit = 0;
            $overdue = 0;
            $currentDate = date('Y-m-d H:i:s');

            if (!empty($manuscripts)) {
                foreach ($manuscripts as $m) {
                    $decision = !empty($m->firstEditorialDecision) ? $m->firstEditorialDecision : '';
                    switch ($decision) {
                        case 'accept_present': $accepted++; break;
                        case 'minor_revision': $minorRevision++; break;
                        case 'major_revision': $majorRevision++; break;
                        case 'reject': $rejected++; break;
                        case 'reject_resubmit': $resubmit++; break;
                    }
                    
                    if (!empty($m->revisionDueDtm) && $m->revisionDueDtm < $currentDate) {
                        $overdue++;
                    }
                }
            }
            ?>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card primary">
                    <div class="stat-info">
                        <h4><?php echo $totalManuscripts; ?></h4>
                        <p>Total Decisions</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-file-text-o"></i></div>
                </div>
                <div class="stat-card success">
                    <div class="stat-info">
                        <h4><?php echo $accepted; ?></h4>
                        <p>Accepted</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-check-circle"></i></div>
                </div>
                <div class="stat-card warning">
                    <div class="stat-info">
                        <h4><?php echo $minorRevision + $majorRevision; ?></h4>
                        <p>Revisions Required</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-edit"></i></div>
                </div>
                <div class="stat-card danger">
                    <div class="stat-info">
                        <h4><?php echo $rejected; ?></h4>
                        <p>Rejected</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-times-circle"></i></div>
                </div>
                <div class="stat-card purple">
                    <div class="stat-info">
                        <h4><?php echo $overdue; ?></h4>
                        <p>Overdue Revisions</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-exclamation-triangle"></i></div>
                </div>
            </div>

            <!-- Main Table -->
            <div class="table-card">
                <div class="table-header">
                    <h3>
                        <i class="fa fa-list-ul"></i>
                        Manuscripts with Editorial Decisions
                        <span class="badge-count"><?php echo $totalManuscripts; ?></span>
                    </h3>
                    <div class="search-box">
                        <i class="fa fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Search by manuscript # or title...">
                    </div>
                </div>
                <div style="overflow-x: auto;">
                    <table class="modern-table" id="decisionsTable">
                        <thead>
                            <tr>
                                <th>Manuscript</th>
                                <th>Editor Decision</th>
                                <th>Next Step</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th style="text-align: center;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $decisionLabels = [
                                'accept_present' => 'Accept in Present Form',
                                'reject' => 'Reject',
                                'minor_revision' => 'Accept after Minor Revision',
                                'major_revision' => 'Reconsider after Major Revision',
                                'reject_resubmit' => 'Reject and Encourage Resubmission'
                            ];
                            $decisionClasses = [
                                'accept_present' => 'decision-accept',
                                'reject' => 'decision-reject',
                                'minor_revision' => 'decision-minor',
                                'major_revision' => 'decision-major',
                                'reject_resubmit' => 'decision-resubmit'
                            ];
                            $nextSteps = [
                                'accept_present' => '🎉 Ready to be published',
                                'reject' => '❌ Fully rejected - No further action',
                                'minor_revision' => '📝 Author to submit revised manuscript and response to reviewers',
                                'major_revision' => '🔄 Author to submit revised manuscript and response to reviewers',
                                'reject_resubmit' => '📧 Author to prepare new resubmission when extensive new experiments are completed'
                            ];
                            ?>
                            <?php if (!empty($manuscripts)): ?>
                                <?php foreach ($manuscripts as $m): ?>
                                    <?php
                                    $decision = !empty($m->firstEditorialDecision) ? $m->firstEditorialDecision : '';
                                    $decisionLabel = isset($decisionLabels[$decision]) ? $decisionLabels[$decision] : $decision;
                                    $decisionClass = isset($decisionClasses[$decision]) ? $decisionClasses[$decision] : 'decision-default';
                                    $nextStep = isset($nextSteps[$decision]) ? $nextSteps[$decision] : '-';
                                    
                                    $countdownText = '-';
                                    $countdownClass = 'countdown-info';
                                    $dueDisplay = '';

                                    if (!empty($m->revisionDueDtm)) {
                                        $remainingSeconds = strtotime($m->revisionDueDtm) - time();
                                        $days = (int)ceil(abs($remainingSeconds) / 86400);
                                        if ($remainingSeconds >= 0) {
                                            $countdownText = $days . ' day' . ($days === 1 ? '' : 's') . ' remaining';
                                            $countdownClass = $days <= 2 ? 'countdown-warning' : 'countdown-info';
                                        } else {
                                            $countdownText = $days . ' day' . ($days === 1 ? '' : 's') . ' overdue';
                                            $countdownClass = 'countdown-danger';
                                        }
                                        $dueDisplay = date('d M Y', strtotime($m->revisionDueDtm));
                                    }
                                    
                                    $status = !empty($m->status) ? $m->status : 'pending';
                                    $statusClass = 'status-default';
                                    if ($status == 'under_review') $statusClass = 'status-under_review';
                                    elseif ($status == 'revision') $statusClass = 'status-revision';
                                    elseif ($status == 'accepted') $statusClass = 'status-accepted';
                                    elseif ($status == 'rejected') $statusClass = 'status-rejected';
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="manuscript-number"><?php echo html_escape($m->manuscriptNumber); ?></span>
                                            <span class="manuscript-title" title="<?php echo html_escape($m->title); ?>"><?php echo html_escape(strlen($m->title) > 60 ? substr($m->title, 0, 60) . '...' : $m->title); ?></span>
                                            <span class="associate-editor"><i class="fa fa-user-md"></i> AE: <?php echo html_escape(!empty($m->associateEditorName) ? $m->associateEditorName : '-'); ?></span>
                                        </td>
                                        <td>
                                            <span class="decision-badge <?php echo $decisionClass; ?>">
                                                <i class="fa <?php echo $decision == 'accept_present' ? 'fa-check-circle' : ($decision == 'reject' ? 'fa-times-circle' : 'fa-edit'); ?>"></i>
                                                <?php echo html_escape($decisionLabel); ?>
                                            </span>
                                            <span class="decision-date">
                                                <i class="fa fa-calendar"></i> 
                                                <?php echo !empty($m->firstEditorialDecisionDtm) ? date('d M Y', strtotime($m->firstEditorialDecisionDtm)) : '-'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="next-step"><?php echo html_escape($nextStep); ?></div>
                                        </td>
                                        <td>
                                            <?php if (!empty($m->revisionDueDtm)): ?>
                                                <span class="countdown-badge <?php echo $countdownClass; ?>">
                                                    <i class="fa fa-hourglass-half"></i> <?php echo $countdownText; ?>
                                                </span>
                                                <span class="due-date">
                                                    <i class="fa fa-calendar-check-o"></i> Due: <?php echo $dueDisplay; ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-muted">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="status-badge <?php echo $statusClass; ?>">
                                                <?php echo ucwords(str_replace('_', ' ', $status)); ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <a class="btn-view" href="<?php echo base_url('editor/assignments/view/' . (int)$m->manuscriptId); ?>">
                                                <i class="fa fa-eye"></i> View Details
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="empty-state">
                                        <i class="fa fa-inbox"></i>
                                        <p>No first editorial decisions have been submitted yet.</p>
                                    </table>
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
            let table = document.getElementById('decisionsTable');
            let rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            
            for (let i = 0; i < rows.length; i++) {
                let manuscriptCell = rows[i].getElementsByTagName('td')[0];
                
                if (manuscriptCell) {
                    let manuscriptText = manuscriptCell.textContent || manuscriptCell.innerText;
                    
                    if (manuscriptText.toLowerCase().indexOf(searchValue) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        });
    </script>
</div>