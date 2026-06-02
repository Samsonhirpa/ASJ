<?php
// Assume $issue is passed from controller
// Expected properties: volume, issueNumber, year, month, title, description, coverImage, publishedDate, articles (array)
?>

<div style="background: #f9fafb; padding: 40px 0;">
    <div class="container">
        <?php if ($issue): ?>
            <!-- Issue Header -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <?php if (!empty($issue->coverImage)): ?>
                        <img src="<?= base_url($issue->coverImage) ?>" alt="Issue Cover" class="img-fluid rounded-4 shadow-lg w-100">
                    <?php else: ?>
                        <div class="bg-light rounded-4 d-flex align-items-center justify-content-center shadow-sm" style="height: 300px;">
                            <i class="fas fa-book-open fa-4x text-secondary"></i>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <span class="badge bg-success bg-opacity-25 text-success mb-3 px-3 py-2 rounded-pill">
                        <i class="fas fa-calendar-alt me-1"></i> Latest Issue
                    </span>
                    <h1 class="display-4 fw-bold text-success mb-3" style="color: #0f3b2c;">
                        Volume <?= $issue->volume ?>, Issue <?= $issue->issueNumber ?>
                    </h1>
                    <p class="h5 text-secondary mb-3">
                        <?php if (!empty($issue->month)): ?>
                            <?= date('F', strtotime("2000-{$issue->month}-01")) ?> <?= $issue->year ?>
                        <?php else: ?>
                            Published: <?= date('F d, Y', strtotime($issue->publishedDate)) ?>
                        <?php endif; ?>
                    </p>
                    <?php if (!empty($issue->title)): ?>
                        <h3 class="fw-semibold text-dark mb-3"><?= htmlspecialchars($issue->title) ?></h3>
                    <?php endif; ?>
                    <?php if (!empty($issue->description)): ?>
                        <p class="lead text-secondary"><?= nl2br(htmlspecialchars($issue->description)) ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Table of Contents -->
            <div class="card border-0 shadow-sm rounded-4 mb-5">
                <div class="card-header bg-success text-white py-3 px-4" style="background: #0f3b2c;">
                    <h3 class="h4 mb-0 fw-bold"><i class="fas fa-list me-2"></i> Table of Contents</h3>
                </div>
                <div class="card-body p-0">
                    <?php if (!empty($issue->articles) && is_array($issue->articles)): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($issue->articles as $index => $article): ?>
                                <div class="list-group-item p-4 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col-md-1 text-center">
                                            <span class="badge rounded-pill bg-light text-dark fs-6"><?= $index + 1 ?></span>
                                        </div>
                                        <div class="col-md-8">
                                            <h5 class="fw-bold mb-2">
                                                <a href="<?= base_url('journal/article/' . ($article->articleId ?? $article->manuscriptId)) ?>" class="text-decoration-none text-dark">
                                                    <?= htmlspecialchars($article->title) ?>
                                                </a>
                                            </h5>
                                            <p class="text-muted small mb-0">
                                                <i class="fas fa-user-edit me-1"></i> 
                                                <?= htmlspecialchars($article->author_names ?? $article->authors ?? 'OJAS Editorial') ?>
                                            </p>
                                            <?php if (!empty($article->abstract)): ?>
                                                <p class="text-secondary small mt-2 mb-0">
                                                    <?= nl2br(htmlspecialchars(substr(strip_tags($article->abstract), 0, 200))) . (strlen(strip_tags($article->abstract)) > 200 ? '...' : '') ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-3 text-md-end">
                                            <span class="badge bg-light text-dark px-3 py-2">
                                                <?= ucfirst(str_replace('_', ' ', $article->articleType ?? 'Research')) ?>
                                            </span>
                                            <?php if (!empty($article->doi)): ?>
                                                <div class="small text-muted mt-2">DOI: <?= htmlspecialchars($article->doi) ?></div>
                                            <?php endif; ?>
                                            <a href="<?= base_url('journal/article/' . ($article->articleId ?? $article->manuscriptId)) ?>" class="btn btn-sm btn-outline-success mt-2 rounded-pill">
                                                Read More <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="p-5 text-center">
                            <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                            <h4 class="text-secondary">No articles published in this issue yet</h4>
                            <p class="text-muted">Articles will appear here once published.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Issue Information Sidebar -->
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-success mb-3"><i class="fas fa-info-circle me-2"></i> Issue Information</h4>
                            <ul class="list-unstyled">
                                <li class="mb-3 d-flex"><i class="fas fa-hashtag text-success me-3 mt-1"></i> <strong>Volume:</strong> <?= $issue->volume ?></li>
                                <li class="mb-3 d-flex"><i class="fas fa-number text-success me-3 mt-1"></i> <strong>Issue:</strong> <?= $issue->issueNumber ?></li>
                                <li class="mb-3 d-flex"><i class="fas fa-calendar text-success me-3 mt-1"></i> <strong>Published:</strong> <?= date('F d, Y', strtotime($issue->publishedDate)) ?></li>
                                <?php if (!empty($issue->month)): ?>
                                <li class="mb-3 d-flex"><i class="fas fa-leaf text-success me-3 mt-1"></i> <strong>Quarter:</strong> <?= date('F', strtotime("2000-{$issue->month}-01")) ?></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-success mb-3"><i class="fas fa-download me-2"></i> Download Options</h4>
                            <p class="text-secondary">Download the complete issue as a single PDF (if available).</p>
                            <?php if (!empty($issue->pdfFile)): ?>
                                <a href="<?= base_url($issue->pdfFile) ?>" class="btn btn-success rounded-pill px-4">
                                    <i class="fas fa-file-pdf me-2"></i> Download Full Issue PDF
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary rounded-pill px-4" disabled>
                                    <i class="fas fa-file-pdf me-2"></i> PDF Unavailable
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="bg-light rounded-4 p-5 text-center">
                        <h3 class="fw-bold text-success">Submit Your Next Article to OJAS</h3>
                        <p class="text-secondary mb-3">Join our growing community of authors and share your research with the world.</p>
                        <a href="<?= base_url('author/manuscript/submit') ?>" class="btn btn-success btn-lg px-5 rounded-pill">
                            <i class="fas fa-upload me-2"></i> Submit Manuscript
                        </a>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="alert alert-info text-center p-5">
                <i class="fas fa-info-circle fa-3x mb-3"></i>
                <h4>No Issues Published Yet</h4>
                <p>The first issue of OJAS will be published soon. Please check back later.</p>
            </div>
        <?php endif; ?>
    </div>
</div>