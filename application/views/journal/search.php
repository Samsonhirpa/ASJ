<div style="background: #f9fafb; padding: 40px 0; min-height: 70vh;">
    <div class="container">
        
        <!-- Page Header -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 style="color: #0f3b2c; font-size: 3em; font-weight: 800; margin-bottom: 20px;">Search Articles</h1>
                <p class="lead text-secondary" style="max-width: 800px; margin: 0 auto 40px;">
                    Discover research published in OJAS by keyword, author, title, or abstract.
                </p>
            </div>
        </div>

        <!-- Search Form Card -->
        <div class="card border-0 shadow-sm rounded-4 mb-5">
            <div class="card-body p-4">
                <form method="get" action="<?= base_url('journal/search') ?>" id="searchForm">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Search Keywords</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-search text-success"></i></span>
                                <input type="text" name="q" class="form-control form-control-lg border-start-0" 
                                       placeholder="Title, author, abstract, or keywords..." 
                                       value="<?= htmlspecialchars($keyword ?? '') ?>">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Article Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                <?php foreach ($article_types as $value => $label): ?>
                                    <option value="<?= $value ?>" <?= ($this->input->get('type') == $value) ? 'selected' : '' ?>>
                                        <?= $label ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Year</label>
                            <select name="year" class="form-select">
                                <option value="">All Years</option>
                                <?php foreach ($years as $year): ?>
                                    <option value="<?= $year->year ?>" <?= ($this->input->get('year') == $year->year) ? 'selected' : '' ?>>
                                        <?= $year->year ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Issue</label>
                            <select name="issue" class="form-select">
                                <option value="">All Issues</option>
                                <?php foreach ($issues as $issue): ?>
                                    <option value="<?= $issue->issueId ?>" <?= ($this->input->get('issue') == $issue->issueId) ? 'selected' : '' ?>>
                                        Volume <?= $issue->volume ?>, Issue <?= $issue->issueNumber ?> (<?= $issue->year ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill">
                                <i class="fas fa-search me-2"></i> Search Articles
                            </button>
                            <?php if (!empty($keyword)): ?>
                                <a href="<?= base_url('journal/search') ?>" class="btn btn-outline-secondary btn-lg px-4 rounded-pill ms-2">
                                    <i class="fas fa-times me-2"></i> Clear
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Results Section -->
        <?php if (isset($keyword) && !empty($keyword)): ?>
            <div class="mb-4">
                <h2 class="fw-bold text-success">
                    <i class="fas fa-file-alt me-2"></i> Search Results
                </h2>
                <p class="text-secondary">Found <?= count($results) ?> article(s) for "<strong><?= htmlspecialchars($keyword) ?></strong>"</p>
            </div>
            
            <?php if (!empty($results)): ?>
                <div class="row g-4">
                    <?php foreach ($results as $article): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                            <?= ucfirst(str_replace('_', ' ', $article->articleType ?? 'Research')) ?>
                                        </span>
                                        <?php if (!empty($article->year)): ?>
                                            <small class="text-muted"><i class="fas fa-calendar-alt me-1"></i> <?= $article->year ?></small>
                                        <?php endif; ?>
                                    </div>
                                    <h5 class="card-title fw-bold">
                                        <a href="<?= base_url('journal/article/' . ($article->articleId ?? $article->manuscriptId)) ?>" class="text-decoration-none text-dark">
                                            <?= htmlspecialchars($article->title) ?>
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted small">
                                        <i class="fas fa-user-edit me-1"></i> 
                                        <?= htmlspecialchars($article->author_names ?? 'OJAS Editorial') ?>
                                    </p>
                                    <p class="card-text text-secondary small">
                                        <?= nl2br(htmlspecialchars(substr(strip_tags($article->abstract ?? ''), 0, 150))) ?>
                                        <?= (strlen(strip_tags($article->abstract ?? '')) > 150) ? '...' : '' ?>
                                    </p>
                                    <div class="mt-3">
                                        <a href="<?= base_url('journal/article/' . ($article->articleId ?? $article->manuscriptId)) ?>" class="btn btn-outline-success rounded-pill px-4">
                                            Read More <i class="fas fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center p-5 rounded-4">
                    <i class="fas fa-info-circle fa-3x mb-3"></i>
                    <h4>No articles found</h4>
                    <p>Try different keywords or adjust your filters.</p>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="text-center p-5">
                <i class="fas fa-search fa-4x text-muted mb-3"></i>
                <h3 class="text-secondary">Enter search terms above</h3>
                <p class="text-muted">Search by title, author, abstract, or keywords to find relevant articles.</p>
            </div>
        <?php endif; ?>
        
        <!-- Call to Action -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="bg-light rounded-4 p-5 text-center">
                    <h3 class="fw-bold text-success">Can't Find What You're Looking For?</h3>
                    <p class="text-secondary mb-3">Contact our editorial office for assistance with article access.</p>
                    <a href="<?= base_url('journal/contact') ?>" class="btn btn-success btn-lg px-5 rounded-pill">
                        <i class="fas fa-envelope me-2"></i> Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>