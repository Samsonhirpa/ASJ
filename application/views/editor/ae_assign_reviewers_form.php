<div class="content-wrapper assign-reviewers-detail-page">
    <style>
        .assign-reviewers-detail-page {
            background: #f1f5f9;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }

        .assign-reviewers-detail-page .content-header {
            padding: 24px 24px 16px 24px;
        }

        .assign-reviewers-detail-page .content-header h1 {
            font-weight: 700;
            font-size: 26px;
            color: #0f2b3d;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .assign-reviewers-detail-page .content-header h1 small {
            font-size: 14px;
            color: #64748b;
            font-weight: 400;
            margin-left: 8px;
        }

        .stats-grid {
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
        .stat-card.accepted .stat-number { color: #059669; }
        .stat-card.pending .stat-number { color: #d97706; }

        .section-box {
            background: white;
            border-radius: 24px;
            margin: 0 24px 28px 24px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }

        .section-header {
            padding: 18px 24px;
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .section-header h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-header h3 i {
            color: #1a6d7e;
            font-size: 20px;
        }

        .section-header h3 small {
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
            margin-left: 8px;
        }

        .section-body {
            padding: 0;
        }

        .reviewers-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .reviewers-table thead tr {
            background: #f8fafc;
        }

        .reviewers-table th {
            padding: 16px 14px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
        }

        .reviewers-table td {
            padding: 16px 14px;
            font-size: 13px;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }

        .reviewers-table tbody tr:hover {
            background: #fafcff;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 40px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-accepted, .status-completed {
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

        .status-default {
            background: #f8fafc;
            color: #64748b;
        }

        .expertise-tag {
            display: inline-block;
            background: #e0f2fe;
            color: #0369a1;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
            margin: 2px;
        }

        .btn-assign {
            background: linear-gradient(135deg, #1a6d7e, #2a9d8f);
            color: white;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-assign:hover {
            transform: translateY(-1px);
            filter: brightness(1.05);
            color: white;
            text-decoration: none;
        }

        .assigned-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f0f9ff;
            color: #0284c7;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            color: #1e293b;
            padding: 10px 24px;
            border-radius: 40px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
            margin: 0 24px 24px 24px;
        }

        .back-button:hover {
            border-color: #2a9d8f;
            transform: translateX(-2px);
            text-decoration: none;
            color: #1e293b;
        }

        .empty-state {
            text-align: center;
            padding: 48px 24px;
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

        @media (max-width: 992px) {
            .reviewers-table {
                min-width: 800px;
            }
        }

        @media (max-width: 768px) {
            .assign-reviewers-detail-page .content-header {
                padding: 20px 16px 12px 16px;
            }

            .assign-reviewers-detail-page .content-header h1 {
                font-size: 22px;
            }

            .stats-grid {
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

            .section-box {
                margin: 0 16px 20px 16px;
                overflow-x: auto;
            }

            .section-header {
                padding: 14px 18px;
            }

            .back-button {
                margin: 0 16px 20px 16px;
            }
        }
    </style>

    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus" style="color: #1a6d7e; margin-right: 10px;"></i>
            Assign Reviewers
            <small><?php echo html_escape(isset($manuscript->manuscriptNumber) ? $manuscript->manuscriptNumber : 'N/A'); ?> — <?php echo html_escape(isset($manuscript->title) ? $manuscript->title : 'Untitled'); ?></small>
        </h1>
    </section>

    <section class="content">
        <?php
            $totalAssigned = !empty($assignedReviewers) ? count($assignedReviewers) : 0;
            $acceptedAssigned = 0;
            $pendingAssigned = 0;
            if (!empty($assignedReviewers)) {
                foreach ($assignedReviewers as $assignedReviewer) {
                    $status = isset($assignedReviewer->status) ? strtolower($assignedReviewer->status) : '';
                    if ($status == 'accepted' || $status == 'completed') {
                        $acceptedAssigned++;
                    } elseif ($status == 'pending' || $status == 'invited') {
                        $pendingAssigned++;
                    }
                }
            }
        ?>

        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-number"><?php echo $totalAssigned; ?></div>
                <div class="stat-label">Total Assigned</div>
            </div>
            <div class="stat-card accepted">
                <div class="stat-number"><?php echo $acceptedAssigned; ?></div>
                <div class="stat-label">Accepted / Completed</div>
            </div>
            <div class="stat-card pending">
                <div class="stat-number"><?php echo $pendingAssigned; ?></div>
                <div class="stat-label">Pending Response</div>
            </div>
        </div>

        <div class="section-box">
            <div class="section-header">
                <h3>
                    <i class="fa fa-check-circle"></i>
                    Assigned Reviewers
                    <small>(<?php echo $acceptedAssigned; ?> of <?php echo $totalAssigned; ?> have accepted)</small>
                </h3>
            </div>
            <div class="section-body table-responsive">
                <table class="reviewers-table">
                    <thead>
                        <tr>
                            <th>Reviewer</th>
                            <th>Contact</th>
                            <th>Institution</th>
                            <th>Expertise</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($assignedReviewers)): ?>
                            <?php foreach($assignedReviewers as $r): ?>
                                <?php 
                                    $status = isset($r->status) ? strtolower($r->status) : 'pending';
                                    $statusClass = 'default';
                                    $statusIcon = 'fa-question-circle';
                                    
                                    if ($status == 'accepted' || $status == 'completed') {
                                        $statusClass = 'accepted';
                                        $statusIcon = 'fa-check-circle';
                                    } elseif ($status == 'pending' || $status == 'invited') {
                                        $statusClass = 'pending';
                                        $statusIcon = 'fa-clock-o';
                                    } elseif ($status == 'declined') {
                                        $statusClass = 'declined';
                                        $statusIcon = 'fa-times-circle';
                                    }
                                ?>
                                <tr>
                                    <td>
                                        <strong><?php echo html_escape(isset($r->name) ? $r->name : '-'); ?></strong>
                                    </td>
                                    <td>
                                        <div><i class="fa fa-envelope-o" style="width: 16px; color: #64748b;"></i> <?php echo html_escape(isset($r->email) ? $r->email : '-'); ?></div>
                                        <div><i class="fa fa-phone" style="width: 16px; color: #64748b;"></i> <?php echo html_escape(isset($r->mobile) ? $r->mobile : '-'); ?></div>
                                    </td>
                                    <td>
                                        <?php echo html_escape(isset($r->institution) ? $r->institution : '-'); ?><br>
                                        <small class="text-muted"><?php echo html_escape(isset($r->department) ? $r->department : ''); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                                        $expertise = isset($r->expertise_area) ? html_escape($r->expertise_area) : '';
                                        if($expertise && $expertise != '-'):
                                            $tags = explode(',', $expertise);
                                            $tags = array_slice($tags, 0, 2);
                                            foreach($tags as $tag):
                                        ?>
                                            <span class="expertise-tag"><?php echo trim($tag); ?></span>
                                        <?php 
                                            endforeach;
                                        else: 
                                            echo '<span class="text-muted">—</span>';
                                        endif; 
                                        ?>
                                    </td>
                                    <td>
                                        <span class="status-badge status-<?php echo $statusClass; ?>">
                                            <i class="fa <?php echo $statusIcon; ?>"></i>
                                            <?php echo html_escape(isset($r->status) ? ucfirst($r->status) : 'Pending'); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class="fa fa-users"></i>
                                    <p>No reviewers assigned yet. Use the table below to assign reviewers.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="section-box">
            <div class="section-header">
                <h3>
                    <i class="fa fa-user-md"></i>
                    Available Registered Reviewers
                    <small>Assign reviewers from the list below</small>
                </h3>
            </div>
            <div class="section-body table-responsive">
                <table class="reviewers-table">
                    <thead>
                        <tr>
                            <th>Reviewer</th>
                            <th>Contact</th>
                            <th>Affiliation</th>
                            <th>Areas of Expertise</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($reviewers)): ?>
                            <?php foreach($reviewers as $r): ?>
                                <?php 
                                    $isAlreadyAssigned = !empty($r->assignmentId);
                                    $manuscriptId = isset($manuscript->manuscriptId) ? $manuscript->manuscriptId : 0;
                                    $userId = isset($r->userId) ? $r->userId : 0;
                                    $reviewerName = isset($r->name) ? html_escape($r->name) : 'this reviewer';
                                ?>
                                <tr>
                                    <td>
                                        <strong><?php echo html_escape(isset($r->name) ? $r->name : '-'); ?></strong>
                                    </td>
                                    <td>
                                        <div><i class="fa fa-envelope-o" style="width: 16px; color: #64748b;"></i> <?php echo html_escape(isset($r->email) ? $r->email : '-'); ?></div>
                                        <div><i class="fa fa-phone" style="width: 16px; color: #64748b;"></i> <?php echo html_escape(isset($r->mobile) ? $r->mobile : '-'); ?></div>
                                    </td>
                                    <td>
                                        <?php echo html_escape(isset($r->institution) ? $r->institution : '-'); ?><br>
                                        <small class="text-muted"><?php echo html_escape(isset($r->department) ? $r->department : ''); ?></small>
                                    </td>
                                    <td>
                                        <?php 
                                        $expertise = isset($r->expertise_area) ? html_escape($r->expertise_area) : '';
                                        if($expertise && $expertise != '-'):
                                            $tags = explode(',', $expertise);
                                            $tags = array_slice($tags, 0, 3);
                                            foreach($tags as $tag):
                                        ?>
                                            <span class="expertise-tag"><?php echo trim($tag); ?></span>
                                        <?php 
                                            endforeach;
                                            if(count(explode(',', $expertise)) > 3) {
                                                echo '<span class="expertise-tag">+ more</span>';
                                            }
                                        else 
                                            echo '<span class="text-muted">—</span>';
                                        endif; 
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php if($isAlreadyAssigned): ?>
                                            <span class="assigned-badge">
                                                <i class="fa fa-check"></i> Assigned
                                                <?php if(!empty($r->assignmentStatus)): ?>
                                                     (<?php echo html_escape(ucfirst($r->assignmentStatus)); ?>)
                                                <?php endif; ?>
                                            </span>
                                        <?php else: ?>
                                            <a class="btn-assign" href="<?php echo base_url('editor/ae-assign-reviewers/'.$manuscriptId.'/assign/'.$userId); ?>" 
                                               onclick="return confirm('Assign ' + '<?php echo $reviewerName; ?>' + ' as a reviewer for this manuscript?')">
                                                <i class="fa fa-plus"></i> Assign
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class="fa fa-search"></i>
                                    <p>No registered reviewers found. Please add reviewers to the system first.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <a href="<?php echo base_url('editor/ae-assign-reviewers'); ?>" class="back-button">
            <i class="fa fa-arrow-left"></i> Back to Manuscripts
        </a>
    </section>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">