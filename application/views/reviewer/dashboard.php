<div class="content-wrapper" style="background: #f5f7fb;">
    <style>
        /* Modern CSS Reset & Variables */
        .reviewer-dashboard {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --success: #10b981;
            --success-dark: #059669;
            --warning: #f59e0b;
            --warning-dark: #d97706;
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
            --shadow-xs: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
        }

        .reviewer-dashboard * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Header Section */
        .dashboard-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: var(--radius-xl);
            padding: 28px 32px;
            margin: 20px 20px 24px 20px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--info), var(--primary));
        }

        .dashboard-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .dashboard-header h1 i {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 32px;
        }

        .welcome-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-top: 12px;
        }

        .welcome-text {
            color: var(--gray-600);
            font-size: 15px;
        }

        .welcome-text strong {
            color: var(--primary);
            font-weight: 700;
        }

        .date-badge {
            background: var(--gray-100);
            padding: 8px 16px;
            border-radius: 40px;
            font-size: 13px;
            color: var(--gray-600);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Stats Grid - 4 Column Modern Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 0 20px;
            margin-bottom: 28px;
        }

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: white;
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-xs);
            border: 1px solid var(--gray-200);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .stat-card .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .stat-card.blue .stat-icon { background: rgba(37, 99, 235, 0.1); color: var(--primary); }
        .stat-card.orange .stat-icon { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        .stat-card.green .stat-icon { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        .stat-card.red .stat-icon { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

        .stat-card h3 {
            font-size: 36px;
            font-weight: 800;
            color: var(--gray-800);
            margin: 0;
            line-height: 1.2;
        }

        .stat-card p {
            font-size: 13px;
            font-weight: 500;
            color: var(--gray-500);
            margin: 8px 0 0 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-trend {
            position: absolute;
            bottom: 16px;
            right: 16px;
            font-size: 11px;
            background: var(--gray-100);
            padding: 4px 8px;
            border-radius: 20px;
            color: var(--gray-600);
        }

        /* Main Content Layout - 2 Column */
        .dashboard-main {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 24px;
            padding: 0 20px;
            margin-bottom: 28px;
        }

        @media (max-width: 992px) {
            .dashboard-main {
                grid-template-columns: 1fr;
            }
        }

        /* Left Column - Manuscripts Table */
        .card {
            background: white;
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            box-shadow: var(--shadow-xs);
        }

        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--gray-200);
            background: var(--gray-50);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-header h3 {
            font-size: 17px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header h3 i {
            color: var(--primary);
            font-size: 18px;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--gray-300);
            padding: 6px 14px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
            color: var(--gray-700);
            transition: all 0.2s;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-outline:hover {
            background: var(--gray-100);
            border-color: var(--gray-400);
            text-decoration: none;
            color: var(--gray-800);
        }

        .btn-primary-small {
            background: var(--primary);
            border: none;
            padding: 6px 14px;
            border-radius: var(--radius-sm);
            font-size: 12px;
            font-weight: 500;
            color: white;
            transition: all 0.2s;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-primary-small:hover {
            background: var(--primary-dark);
            text-decoration: none;
            color: white;
        }

        /* Modern Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            text-align: left;
            padding: 14px 16px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-500);
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
        }

        .data-table td {
            padding: 14px 16px;
            font-size: 14px;
            color: var(--gray-700);
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }

        .data-table tr:hover td {
            background: var(--gray-50);
        }

        /* Status Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-warning {
            background: #fed7aa;
            color: #92400e;
        }

        .badge-info {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Right Column - Performance Card */
        .performance-card {
            background: linear-gradient(135deg, var(--gray-800) 0%, var(--gray-900) 100%);
            color: white;
        }

        .performance-card .card-header {
            background: rgba(255,255,255,0.05);
            border-bottom-color: rgba(255,255,255,0.1);
        }

        .performance-card .card-header h3 {
            color: white;
        }

        .performance-metrics {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 24px;
        }

        .metric {
            text-align: center;
            padding: 16px;
            background: rgba(255,255,255,0.05);
            border-radius: var(--radius-md);
        }

        .metric-value {
            font-size: 28px;
            font-weight: 800;
            color: var(--primary-light);
        }

        .metric-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--gray-400);
            margin-top: 6px;
        }

        .recognition-badge {
            background: linear-gradient(135deg, #f59e0b, #f97316);
            display: inline-block;
            padding: 8px 20px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .action-buttons {
            padding: 0 24px 24px 24px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-block {
            display: block;
            width: 100%;
            text-align: center;
            padding: 10px;
            border-radius: var(--radius-sm);
            font-weight: 500;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-block-primary {
            background: var(--primary);
            color: white;
        }

        .btn-block-primary:hover {
            background: var(--primary-dark);
            color: white;
        }

        .btn-block-outline-light {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
        }

        .btn-block-outline-light:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        /* Notifications Section - Full Width */
        .notifications-section {
            margin: 0 20px 28px 20px;
        }

        .notification-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .notification-item {
            padding: 16px 20px;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: flex-start;
            gap: 14px;
            transition: all 0.2s;
        }

        .notification-item:hover {
            background: var(--gray-50);
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            background: #dbeafe;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 18px;
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 4px;
        }

        .notification-message {
            font-size: 13px;
            color: var(--gray-500);
            line-height: 1.5;
        }

        .empty-state {
            text-align: center;
            padding: 48px;
            color: var(--gray-400);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 12px;
            display: block;
        }

        /* Completed Reviews Table */
        .margin-bottom {
            margin-bottom: 28px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-header {
                padding: 20px;
                margin: 16px;
            }
            .dashboard-header h1 {
                font-size: 22px;
            }
            .stats-grid {
                padding: 0 16px;
                gap: 12px;
            }
            .dashboard-main {
                padding: 0 16px;
                gap: 20px;
            }
            .notifications-section {
                margin: 0 16px 20px 16px;
            }
            .card-header {
                padding: 14px 18px;
                flex-direction: column;
                align-items: flex-start;
            }
            .data-table {
                min-width: 500px;
            }
        }
    </style>

    <div class="reviewer-dashboard">
        <!-- Header -->
        <div class="dashboard-header">
            <h1>
                <i class="fa fa-graduation-cap"></i>
                Reviewer Dashboard
            </h1>
            <div class="welcome-section">
                <div class="welcome-text">
                    <i class="fa fa-user-circle-o"></i> Welcome back, <strong><?php echo html_escape($user->name ?? 'Reviewer'); ?></strong>
                </div>
                <div class="date-badge">
                    <i class="fa fa-calendar"></i>
                    <?php echo date('l, d F Y'); ?>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-icon"><i class="fa fa-file-text-o"></i></div>
                <h3><?php echo number_format($summary['totalAssigned'] ?? 0); ?></h3>
                <p>Total Assignments</p>
                <div class="stat-trend"><i class="fa fa-tasks"></i> All time</div>
            </div>
            <div class="stat-card orange">
                <div class="stat-icon"><i class="fa fa-envelope-open-o"></i></div>
                <h3><?php echo number_format($summary['pendingInvitations'] ?? 0); ?></h3>
                <p>Pending Invitations</p>
                <div class="stat-trend"><i class="fa fa-clock-o"></i> Action required</div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon"><i class="fa fa-check-circle-o"></i></div>
                <h3><?php echo number_format($summary['completed'] ?? 0); ?></h3>
                <p>Completed Reviews</p>
                <div class="stat-trend"><i class="fa fa-star"></i> Well done!</div>
            </div>
            <div class="stat-card red">
                <div class="stat-icon"><i class="fa fa-exclamation-triangle"></i></div>
                <h3><?php echo number_format($summary['overdue'] ?? 0); ?></h3>
                <p>Overdue Reviews</p>
                <div class="stat-trend"><i class="fa fa-warning"></i> Need attention</div>
            </div>
        </div>

        <!-- Main Content Row -->
        <div class="dashboard-main">
            <!-- Left: Assigned Manuscripts -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa fa-clock-o"></i> Assigned Manuscripts</h3>
                    <a href="<?php echo base_url('reviewer/assignments'); ?>" class="btn-outline">
                        <i class="fa fa-arrow-right"></i> View All
                    </a>
                </div>
                <div style="overflow-x: auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Manuscript #</th>
                                <th>Title</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($assignedManuscripts)): ?>
                                <?php foreach($assignedManuscripts as $item): ?>
                                <tr>
                                    <td><strong><?php echo html_escape($item->manuscriptNumber ?? '-'); ?></strong></td>
                                    <td><?php echo html_escape(strlen($item->title ?? '') > 60 ? substr($item->title, 0, 60) . '...' : ($item->title ?? '-')); ?></td>
                                    <td>
                                        <?php if (!empty($item->reviewDueDate)): ?>
                                            <i class="fa fa-calendar"></i> <?php echo date('d M Y', strtotime($item->reviewDueDate)); ?>
                                        <?php else: echo '-'; endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $status = $item->status ?? 'pending';
                                        if ($status === 'completed'): ?>
                                            <span class="badge badge-success"><i class="fa fa-check"></i> Completed</span>
                                        <?php elseif ($status === 'accepted'): ?>
                                            <span class="badge badge-info"><i class="fa fa-check-circle"></i> Accepted</span>
                                        <?php else: ?>
                                            <span class="badge badge-warning"><i class="fa fa-hourglass-half"></i> In Progress</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('reviewer/assignment/'.($item->assignmentId ?? 0)); ?>" class="btn-primary-small">
                                            <i class="fa fa-folder-open-o"></i> Review
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="fa fa-inbox"></i>
                                        No assignments found
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right: Performance Card -->
            <div class="card performance-card">
                <div class="card-header">
                    <h3><i class="fa fa-trophy"></i> My Performance</h3>
                </div>
                <div style="padding: 24px; text-align: center;">
                    <div class="recognition-badge">
                        <i class="fa fa-star"></i> <?php echo html_escape($performance['recognitionLevel'] ?? 'Gold Reviewer'); ?>
                    </div>
                    <div class="performance-metrics">
                        <div class="metric">
                            <div class="metric-value"><?php echo number_format($performance['averageScore'] ?? 0, 1); ?>/5</div>
                            <div class="metric-label">Average Rating</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value"><?php echo number_format($performance['averageTurnaroundDays'] ?? 0); ?>d</div>
                            <div class="metric-label">Avg Turnaround</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value"><?php echo number_format($performance['onTimeRate'] ?? 0); ?>%</div>
                            <div class="metric-label">On-time Rate</div>
                        </div>
                        <div class="metric">
                            <div class="metric-value"><?php echo number_format($performance['totalReviews'] ?? 0); ?></div>
                            <div class="metric-label">Total Reviews</div>
                        </div>
                    </div>
                </div>
                <div class="action-buttons">
                    <a href="<?php echo base_url('reviewer/guidelines'); ?>" class="btn-block btn-block-primary">
                        <i class="fa fa-book"></i> Review Guidelines
                    </a>
                    <a href="<?php echo base_url('reviewer/dashboard/reminders'); ?>" class="btn-block btn-block-outline-light">
                        <i class="fa fa-bell-o"></i> Send Reminders
                    </a>
                </div>
            </div>
        </div>

        <!-- Notifications Section -->
        <div class="notifications-section">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa fa-bell-o"></i> Recent Notifications</h3>
                </div>
                <?php if (!empty($notifications)): ?>
                    <ul class="notification-list">
                        <?php foreach ($notifications as $n): ?>
                            <li class="notification-item">
                                <div class="notification-icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="notification-content">
                                    <div class="notification-title"><?php echo html_escape($n->subject ?? 'Notification'); ?></div>
                                    <div class="notification-message"><?php echo html_escape($n->message ?? ''); ?></div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fa fa-bell-slash-o"></i>
                        No new notifications
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Completed Reviews Section -->
        <div class="notifications-section margin-bottom">
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa fa-history"></i> Recently Completed Reviews</h3>
                </div>
                <div style="overflow-x: auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Manuscript #</th>
                                <th>Title</th>
                                <th>Recommendation</th>
                                <th>Score</th>
                                <th>Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($completedReviews)): ?>
                                <?php foreach($completedReviews as $review): ?>
                                <tr>
                                    <td><strong><?php echo html_escape($review->manuscriptNumber ?? '-'); ?></strong></td>
                                    <td><?php echo html_escape(strlen($review->title ?? '') > 55 ? substr($review->title, 0, 55) . '...' : ($review->title ?? '-')); ?></td>
                                    <td>
                                        <span class="badge badge-success">
                                            <?php echo ucwords(str_replace('_', ' ', $review->recommendationDecision ?? '-')); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if (!empty($review->score)): ?>
                                            <span class="badge" style="background:#fef3c7; color:#92400e;">⭐ <?php echo html_escape($review->score); ?>/5</span>
                                        <?php else: echo '-'; endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($review->reviewSubmittedDate)): ?>
                                            <i class="fa fa-calendar-check-o"></i> <?php echo date('d M Y', strtotime($review->reviewSubmittedDate)); ?>
                                        <?php else: echo '-'; endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="empty-state">
                                        <i class="fa fa-check-circle-o"></i>
                                        No completed reviews yet
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>