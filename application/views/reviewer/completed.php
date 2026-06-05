<div class="content-wrapper">
    <style>
        /* Modern CSS for Completed Reviews */
        .completed-reviews-container {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --success: #10b981;
            --success-dark: #059669;
            --warning: #f59e0b;
            --danger: #ef4444;
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
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --transition: all 0.2s ease;
        }

        .completed-reviews-container .content-header {
            padding: 24px 24px 20px 24px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: var(--radius-lg);
            margin-bottom: 24px;
            border-left: 4px solid var(--primary);
        }

        .completed-reviews-container .content-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .completed-reviews-container .content-header h1 i {
            color: var(--primary);
            font-size: 28px;
        }

        .completed-reviews-container .content-header h1 small {
            font-size: 14px;
            font-weight: 400;
            color: var(--gray-500);
            background: var(--gray-100);
            padding: 4px 12px;
            border-radius: 30px;
        }

        /* Stats Summary Cards */
        .stats-summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 0 24px;
            margin-bottom: 28px;
        }

        @media (max-width: 992px) {
            .stats-summary {
                grid-template-columns: repeat(2, 1fr);
                gap: 16px;
            }
        }

        @media (max-width: 576px) {
            .stats-summary {
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
            box-shadow: var(--shadow-md);
        }

        .stat-info h3 {
            font-size: 32px;
            font-weight: 800;
            margin: 0;
            line-height: 1.2;
        }

        .stat-info p {
            font-size: 12px;
            color: var(--gray-500);
            margin: 6px 0 0 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .stat-total .stat-info h3 { color: var(--primary); }
        .stat-total .stat-icon { background: rgba(59, 130, 246, 0.1); color: var(--primary); }
        
        .stat-score .stat-info h3 { color: var(--warning); }
        .stat-score .stat-icon { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
        
        .stat-days .stat-info h3 { color: var(--success); }
        .stat-days .stat-icon { background: rgba(16, 185, 129, 0.1); color: var(--success); }
        
        .stat-latest .stat-info h3 { color: var(--gray-600); }
        .stat-latest .stat-icon { background: rgba(107, 114, 128, 0.1); color: var(--gray-600); }

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

        /* Recommendation Badges */
        .rec-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 600;
        }

        .rec-accept_present, .rec-accept {
            background: #d1fae5;
            color: #065f46;
        }

        .rec-minor_revision, .rec-minor {
            background: #dbeafe;
            color: #1e40af;
        }

        .rec-major_revision, .rec-major {
            background: #fed7aa;
            color: #92400e;
        }

        .rec-reject_resubmit {
            background: #fef3c7;
            color: #b45309;
        }

        .rec-reject_serious, .rec-reject {
            background: #fee2e2;
            color: #991b1b;
        }

        .rec-default {
            background: var(--gray-100);
            color: var(--gray-600);
        }

        /* Score Badge */
        .score-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 700;
        }

        .score-high {
            background: #d1fae5;
            color: #065f46;
        }

        .score-medium {
            background: #fed7aa;
            color: #92400e;
        }

        .score-low {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Manuscript Title */
        .manuscript-title {
            font-weight: 500;
            max-width: 320px;
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

        /* Download Button */
        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
            background: var(--gray-100);
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
        }

        .btn-download:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-1px);
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
                min-width: 700px;
            }
        }

        @media (max-width: 768px) {
            .completed-reviews-container .content-header {
                margin: 16px;
                padding: 16px 20px;
            }
            .completed-reviews-container .content-header h1 {
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
        }
    </style>

    <div class="completed-reviews-container">
        <section class="content-header">
            <h1>
                <i class="fa fa-check-circle-o"></i>
                Completed Reviews
                <small>Your review history and contributions</small>
            </h1>
        </section>

        <section class="content">
            <?php
                // Calculate statistics
                $totalReviews = !empty($completedReviews) ? count($completedReviews) : 0;
                $averageScore = 0;
                $totalScore = 0;
                $recommendationCounts = [];
                $latestReviewDate = null;

                if (!empty($completedReviews)) {
                    foreach ($completedReviews as $item) {
                        if (!empty($item->score)) {
                            $totalScore += (int)$item->score;
                        }
                        $rec = $item->recommendationDecision ?? 'unknown';
                        $recommendationCounts[$rec] = ($recommendationCounts[$rec] ?? 0) + 1;
                        
                        if (!empty($item->reviewSubmittedDate)) {
                            if ($latestReviewDate === null || strtotime($item->reviewSubmittedDate) > strtotime($latestReviewDate)) {
                                $latestReviewDate = $item->reviewSubmittedDate;
                            }
                        }
                    }
                    $averageScore = $totalReviews > 0 ? round($totalScore / $totalReviews, 1) : 0;
                }
            ?>

            <!-- Stats Summary -->
            <div class="stats-summary">
                <div class="stat-card stat-total">
                    <div class="stat-info">
                        <h3><?php echo $totalReviews; ?></h3>
                        <p>Total Reviews</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-file-text-o"></i></div>
                </div>
                <div class="stat-card stat-score">
                    <div class="stat-info">
                        <h3><?php echo $averageScore; ?>/5</h3>
                        <p>Average Score</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-star-o"></i></div>
                </div>
                <div class="stat-card stat-days">
                    <div class="stat-info">
                        <h3><?php echo count($recommendationCounts); ?></h3>
                        <p>Recommendation Types</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-bar-chart"></i></div>
                </div>
                <div class="stat-card stat-latest">
                    <div class="stat-info">
                        <h3><small><?php echo $latestReviewDate ? date('d M Y', strtotime($latestReviewDate)) : '-'; ?></small></h3>
                        <p>Latest Review</p>
                    </div>
                    <div class="stat-icon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>

            <!-- Main Table -->
            <div class="table-card">
                <div class="table-header">
                    <h3>
                        <i class="fa fa-history"></i>
                        Review History
                        <span style="font-size: 12px; font-weight: normal; background: var(--gray-100); padding: 2px 8px; border-radius: 30px;">
                            <?php echo $totalReviews; ?> record<?php echo $totalReviews !== 1 ? 's' : ''; ?>
                        </span>
                    </h3>
                    <div class="search-box">
                        <i class="fa fa-search"></i>
                        <input type="text" id="searchInput" placeholder="Search by manuscript # or title...">
                    </div>
                </div>
                <div style="overflow-x: auto;">
                    <table class="modern-table" id="reviewsTable">
                        <thead>
                            <tr>
                                <th>Manuscript #</th>
                                <th>Title</th>
                                <th>Recommendation</th>
                                <th>Score</th>
                                <th>Submitted Date</th>
                                <th>Attachment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($completedReviews)): ?>
                                <?php 
                                // Sort by submitted date descending (newest first)
                                $sortedReviews = $completedReviews;
                                usort($sortedReviews, function($a, $b) {
                                    $dateA = isset($a->reviewSubmittedDate) ? strtotime($a->reviewSubmittedDate) : 0;
                                    $dateB = isset($b->reviewSubmittedDate) ? strtotime($b->reviewSubmittedDate) : 0;
                                    return $dateB - $dateA;
                                });
                                foreach ($sortedReviews as $item): 
                                    $recommendation = $item->recommendationDecision ?? '';
                                    $recClass = 'rec-default';
                                    if (in_array($recommendation, ['accept_present', 'accept'])) $recClass = 'rec-accept_present';
                                    elseif (in_array($recommendation, ['minor_revision', 'minor'])) $recClass = 'rec-minor_revision';
                                    elseif (in_array($recommendation, ['major_revision', 'major'])) $recClass = 'rec-major_revision';
                                    elseif ($recommendation === 'reject_resubmit') $recClass = 'rec-reject_resubmit';
                                    elseif (in_array($recommendation, ['reject_serious', 'reject'])) $recClass = 'rec-reject_serious';
                                    
                                    $score = (int)($item->score ?? 0);
                                    $scoreClass = 'score-low';
                                    if ($score >= 4) $scoreClass = 'score-high';
                                    elseif ($score >= 2.5) $scoreClass = 'score-medium';
                                ?>
                                <tr>
                                    <td><span class="manuscript-number"><?php echo html_escape($item->manuscriptNumber ?? '-'); ?></span></td>
                                    <td>
                                        <span class="manuscript-title" title="<?php echo html_escape($item->title ?? ''); ?>">
                                            <?php echo html_escape(strlen($item->title ?? '') > 80 ? substr($item->title, 0, 80) . '...' : ($item->title ?? '-')); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="rec-badge <?php echo $recClass; ?>">
                                            <i class="fa <?php echo $recClass === 'rec-accept_present' ? 'fa-check-circle' : ($recClass === 'rec-reject_serious' ? 'fa-times-circle' : 'fa-edit'); ?>"></i>
                                            <?php echo ucwords(str_replace('_', ' ', $recommendation ?: '-')); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($score > 0): ?>
                                            <span class="score-badge <?php echo $scoreClass; ?>">
                                                <?php if ($score >= 4): ?>
                                                    <i class="fa fa-star"></i>
                                                <?php elseif ($score >= 2.5): ?>
                                                    <i class="fa fa-star-half-o"></i>
                                                <?php else: ?>
                                                    <i class="fa fa-star-o"></i>
                                                <?php endif; ?>
                                                <?php echo $score; ?>/5
                                            </span>
                                        <?php else: echo '-'; endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($item->reviewSubmittedDate)): ?>
                                            <i class="fa fa-calendar-check-o"></i> <?php echo date('d M Y, H:i', strtotime($item->reviewSubmittedDate)); ?>
                                        <?php else: echo '-'; endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($item->reviewFilePath)): ?>
                                            <a href="<?php echo base_url($item->reviewFilePath); ?>" target="_blank" class="btn-download">
                                                <i class="fa fa-download"></i> Download
                                            </a>
                                        <?php else: ?>
                                            <span style="color: var(--gray-400);">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="empty-state">
                                        <i class="fa fa-inbox"></i>
                                        <p>No completed reviews yet. Your completed reviews will appear here.</p>
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
            let table = document.getElementById('reviewsTable');
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