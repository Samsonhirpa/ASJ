<div class="content-wrapper" style="background: #f0f2f5;">
    <style>
        /* Modern CSS for Final Editorial Decision */
        .final-decision-container {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #60a5fa;
            --success: #10b981;
            --success-dark: #059669;
            --warning: #f59e0b;
            --danger: #ef4444;
            --danger-dark: #dc2626;
            --info: #06b6d4;
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

        .final-decision-container .content-header {
            padding: 24px 30px 20px 30px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: var(--radius-lg);
            margin-bottom: 24px;
            border-left: 4px solid var(--primary);
            box-shadow: var(--shadow-sm);
        }

        .final-decision-container .content-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .final-decision-container .content-header h1 i {
            color: var(--primary);
            font-size: 28px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 0 24px;
            margin-bottom: 28px;
        }

        @media (max-width: 992px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        @media (max-width: 576px) {
            .stats-grid {
                grid-template-columns: 1fr;
                padding: 0 16px;
            }
        }

        .stat-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 20px 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: var(--transition);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .stat-info h4 {
            font-size: 32px;
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
            width: 52px;
            height: 52px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-card.primary .stat-info h4 { color: var(--primary); }
        .stat-card.primary .stat-icon { background: rgba(59, 130, 246, 0.1); color: var(--primary); }

        .stat-card.success .stat-info h4 { color: var(--success); }
        .stat-card.success .stat-icon { background: rgba(16, 185, 129, 0.1); color: var(--success); }

        .stat-card.warning .stat-info h4 { color: var(--warning); }
        .stat-card.warning .stat-icon { background: rgba(245, 158, 11, 0.1); color: var(--warning); }

        .stat-card.pending .stat-info h4 { color: var(--info); }
        .stat-card.pending .stat-icon { background: rgba(6, 182, 212, 0.1); color: var(--info); }

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

        /* Manuscript Info */
        .manuscript-number {
            font-weight: 700;
            color: var(--primary);
            font-family: monospace;
            font-size: 13px;
            display: block;
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

        /* Author & Editor Info */
        .info-name {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-name i {
            color: var(--primary);
            width: 20px;
            font-size: 12px;
        }

        .info-name span {
            font-size: 13px;
            color: var(--gray-700);
        }

        /* Date Badge */
        .date-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            background: var(--gray-100);
            border-radius: 30px;
            font-size: 11px;
            color: var(--gray-600);
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 5px 14px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-under_review {
            background: #dbeafe;
            color: #1e40af;
        }
        .status-accepted {
            background: #d1fae5;
            color: #065f46;
        }
        .status-revision {
            background: #fed7aa;
            color: #92400e;
        }
        .status-rejected {
            background: #fee2e2;
            color: #991b1b;
        }
        .status-default {
            background: var(--gray-100);
            color: var(--gray-600);
        }

        /* Action Buttons */
        .action-group {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-approve {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            background: linear-gradient(135deg, var(--success), var(--success-dark));
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-approve:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-reject {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            background: linear-gradient(135deg, var(--danger), var(--danger-dark));
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-reject:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
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
            .final-decision-container .content-header {
                margin: 16px;
                padding: 16px 20px;
            }
            .final-decision-container .content-header h1 {
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
            .action-group {
                flex-direction: column;
            }
            .btn-approve, .btn-reject {
                justify-content: center;
                width: 100%;
            }
        }
    </style>

    <div class="final-decision-container">
        <section class="content-header">
            <h1>
                <i class="fa fa-gavel"></i>
                Final Editorial Decision
                <small>EIC Decision Board</small>
            </h1>
        </section>

        <section class="content">
            <?php
            // Calculate statistics
            $totalManuscripts = !empty($manuscripts) ? count($manuscripts) : 0;
            $pendingCount = 0;
            $approvedCount = 0;
            $rejectedCount = 0;

            if (!empty($manuscripts)) {
                foreach ($manuscripts as $m) {
                    $status = !empty($m->status) ? $m->status : '';
                    if ($status == 'accepted' || $status == 'approved') {
                        $approvedCount++;
                    } elseif ($status == 'rejected') {
                        $rejectedCount++;
                    } else {
                        $pendingCount++;
                    }
                }
            }
            ?>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card primary">
                    <div class="stat-info">
                        <h4><?php echo $totalManuscripts; ?></h4>
                        <p>Total Manuscripts</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-file-text-o"></i></div>
                </div>
                <div class="stat-card pending">
                    <div class="stat-info">
                        <h4><?php echo $pendingCount; ?></h4>
                        <p>Pending Decision</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-hourglass-half"></i></div>
                </div>
                <div class="stat-card success">
                    <div class="stat-info">
                        <h4><?php echo $approvedCount; ?></h4>
                        <p>Approved for Publication</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-check-circle"></i></div>
                </div>
                <div class="stat-card warning">
                    <div class="stat-info">
                        <h4><?php echo $rejectedCount; ?></h4>
                        <p>Rejected</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-times-circle"></i></div>
                </div>
            </div>

            <!-- Main Table -->
            <div class="table-card">
                <div class="table-header">
                    <h3>
                        <i class="fa fa-list-ul"></i>
                        Accepted Manuscripts from Associate Editor
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
                                <th>Author</th>
                                <th>Associate Editor</th>
                                <th>First Decision Date</th>
                                <th>Status</th>
                                <th style="text-align: center;">Final EiC Decision</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($manuscripts)): ?>
                                <?php foreach ($manuscripts as $m): ?>
                                    <?php
                                    $status = !empty($m->status) ? $m->status : 'pending';
                                    $statusClass = 'status-default';
                                    if ($status == 'under_review') $statusClass = 'status-under_review';
                                    elseif ($status == 'accepted' || $status == 'approved') $statusClass = 'status-accepted';
                                    elseif ($status == 'revision') $statusClass = 'status-revision';
                                    elseif ($status == 'rejected') $statusClass = 'status-rejected';
                                    ?>
                                    <tr>
                                        <td>
                                            <span class="manuscript-number"><?php echo html_escape($m->manuscriptNumber); ?></span>
                                            <span class="manuscript-title" title="<?php echo html_escape($m->title); ?>"><?php echo html_escape(strlen($m->title) > 60 ? substr($m->title, 0, 60) . '...' : $m->title); ?></span>
                                        </td>
                                        <td>
                                            <div class="info-name">
                                                <i class="fa fa-user-circle-o"></i>
                                                <span><?php echo html_escape($m->authorName ?: '-'); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="info-name">
                                                <i class="fa fa-user-md"></i>
                                                <span><?php echo html_escape($m->associateEditorName ?: '-'); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="date-badge">
                                                <i class="fa fa-calendar"></i>
                                                <?php echo !empty($m->firstEditorialDecisionDtm) ? date('d M Y', strtotime($m->firstEditorialDecisionDtm)) : '-'; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="status-badge <?php echo $statusClass; ?>">
                                                <?php echo ucwords(str_replace('_', ' ', $status)); ?>
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <div class="action-group">
                                                <form method="post" action="<?php echo base_url('editor/final-decisions/apply/' . (int)$m->manuscriptId); ?>" style="display: inline-block;">
                                                    <input type="hidden" name="decision" value="approved">
                                                    <button type="submit" class="btn-approve" onclick="return confirm('✅ Approve this manuscript and move to Production Stage?')">
                                                        <i class="fa fa-check-circle"></i> Approve
                                                    </button>
                                                </form>
                                                <form method="post" action="<?php echo base_url('editor/final-decisions/apply/' . (int)$m->manuscriptId); ?>" style="display: inline-block;">
                                                    <input type="hidden" name="decision" value="rejected">
                                                    <button type="submit" class="btn-reject" onclick="return confirm('❌ Reject this manuscript and end workflow?')">
                                                        <i class="fa fa-times-circle"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="empty-state">
                                        <i class="fa fa-inbox"></i>
                                        <p>No accepted first-decision manuscripts found.</p>
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