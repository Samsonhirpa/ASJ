<div style="background: #f9fafb; padding: 40px 0;">
    <div class="container">
        
        <!-- Page Header -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 style="color: #0f3b2c; font-size: 3em; font-weight: 800; margin-bottom: 20px;">Journal Archive</h1>
                <p class="lead text-secondary" style="max-width: 800px; margin: 0 auto 40px;">
                    Browse all published issues of OJAS, from the inaugural volume to the latest research.
                </p>
            </div>
        </div>

        <?php if (!empty($issues)): ?>
            <?php 
            // Group issues by year
            $grouped_issues = [];
            foreach ($issues as $issue) {
                $year = $issue->year ?? date('Y', strtotime($issue->publishedDate));
                $grouped_issues[$year][] = $issue;
            }
            krsort($grouped_issues); // Most recent year first
            ?>

            <?php foreach ($grouped_issues as $year => $year_issues): ?>
                <div class="mb-5">
                    <h2 class="fw-bold text-success mb-4 pb-2 border-bottom" style="border-bottom: 3px solid #ffc857; display: inline-block;">
                        <i class="fas fa-calendar-alt me-2"></i> <?= $year ?>
                    </h2>
                    
                    <div class="row g-4 mt-2">
                        <?php foreach ($year_issues as $issue): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                                    <?php if (!empty($issue->coverImage)): ?>
                                        <img src="<?= base_url($issue->coverImage) ?>" class="card-img-top" alt="Cover Volume <?= $issue->volume ?>" style="height: 220px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 220px;">
                                            <i class="fas fa-book-open fa-4x text-secondary"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-body p-4">
                                        <span class="badge bg-success text-white mb-2 px-3 py-2 rounded-pill" style="background: #0f3b2c;">
                                            Volume <?= $issue->volume ?>, Issue <?= $issue->issueNumber ?>
                                        </span>
                                        <h5 class="card-title fw-bold mt-2">
                                            <?php if (!empty($issue->title)): ?>
                                                <?= htmlspecialchars($issue->title) ?>
                                            <?php else: ?>
                                                Volume <?= $issue->volume ?> · Issue <?= $issue->issueNumber ?>
                                            <?php endif; ?>
                                        </h5>
                                        <p class="card-text text-muted small">
                                            <i class="fas fa-calendar-week me-1"></i> 
                                            <?php if (!empty($issue->month)): ?>
                                                <?= date('F', strtotime("2000-{$issue->month}-01")) ?> <?= $issue->year ?>
                                            <?php else: ?>
                                                Published: <?= date('F d, Y', strtotime($issue->publishedDate)) ?>
                                            <?php endif; ?>
                                        </p>
                                        <?php if (!empty($issue->description)): ?>
                                            <p class="card-text text-secondary small">
                                                <?= nl2br(htmlspecialchars(substr($issue->description, 0, 100))) . (strlen($issue->description) > 100 ? '...' : '') ?>
                                            </p>
                                        <?php endif; ?>
                                        <div class="mt-3">
                                            <a href="<?= base_url('journal/issue/' . $issue->issueId) ?>" class="btn btn-outline-success rounded-pill px-4">
                                                View Issue <i class="fas fa-arrow-right ms-2"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            
        <?php else: ?>
            <div class="alert alert-info text-center p-5">
                <i class="fas fa-info-circle fa-3x mb-3"></i>
                <h4>No Issues Archived Yet</h4>
                <p>Check back soon for published issues.</p>
            </div>
        <?php endif; ?>
        
        <!-- Call to Action -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="bg-light rounded-4 p-5 text-center">
                    <h3 class="fw-bold text-success">Looking for Older Issues?</h3>
                    <p class="text-secondary mb-3">Our complete archive is being digitized. Contact us for pre‑2025 issues.</p>
                    <a href="<?= base_url('journal/contact') ?>" class="btn btn-success btn-lg px-5 rounded-pill">
                        <i class="fas fa-envelope me-2"></i> Request Information
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>