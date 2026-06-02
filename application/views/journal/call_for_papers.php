<div style="background: #f9fafb; padding: 40px 0; min-height: 70vh;">
    <div class="container">
        <!-- Page Header -->
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h1 style="color: #0f3b2c; font-size: 3em; font-weight: 800; margin-bottom: 20px;">Call for Papers</h1>
                <p class="lead text-secondary" style="max-width: 800px; margin: 0 auto;">
                    OJAS invites researchers to submit original work to our upcoming special issues and thematic collections.
                </p>
            </div>
        </div>

        <!-- Open Calls Section -->
        <?php if (!empty($open_calls)): ?>
            <div class="mb-5">
                <h2 class="fw-bold text-success mb-4"><i class="fas fa-bullhorn me-2"></i> Open Calls</h2>
                <div class="row g-4">
                    <?php foreach ($open_calls as $call): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                                <div class="card-header bg-success text-white py-3" style="background: #0f3b2c;">
                                    <h5 class="mb-0 fw-bold"><?= htmlspecialchars($call->title) ?></h5>
                                </div>
                                <div class="card-body p-4">
                                    <p class="text-secondary small mb-2">
                                        <i class="fas fa-calendar-alt me-1 text-warning"></i> 
                                        <strong>Deadline:</strong> <?= date('F d, Y', strtotime($call->submissionDeadline)) ?>
                                    </p>
                                    <?php if (!empty($call->guest_editor_name)): ?>
                                        <p class="text-secondary small mb-3">
                                            <i class="fas fa-user-edit me-1 text-warning"></i> 
                                            <strong>Guest Editor:</strong> <?= htmlspecialchars($call->guest_editor_name) ?>
                                        </p>
                                    <?php endif; ?>
                                    <p class="text-secondary small">
                                        <?= nl2br(htmlspecialchars(substr($call->description ?? $call->theme, 0, 150))) ?>
                                        <?= (strlen($call->description ?? $call->theme) > 150) ? '...' : '' ?>
                                    </p>
                                    <div class="mt-3">
                                        <a href="<?= base_url('journal/special-issue/' . $call->specialIssueId) ?>" class="btn btn-outline-success rounded-pill px-4">
                                            View Details <i class="fas fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info mb-5">
                <i class="fas fa-info-circle me-2"></i> No open calls at the moment. Please check back soon.
            </div>
        <?php endif; ?>

        <!-- General Call for Papers (static) -->
        <div class="card border-0 shadow-sm rounded-4 mb-5">
            <div class="card-body p-4 p-lg-5">
                <h2 class="fw-bold text-success mb-4">General Call for Papers</h2>
                <p class="text-secondary">OJAS accepts submissions year-round for its regular issues. All manuscripts undergo rigorous peer review and are published open access.</p>
                <div class="row g-4 mt-2">
                    <div class="col-md-6">
                        <div class="bg-light rounded-3 p-3">
                            <i class="fas fa-pen-fancy fa-2x text-success mb-2"></i>
                            <h5 class="fw-bold">Submission Guidelines</h5>
                            <p class="small text-secondary">Follow our author guidelines for formatting, ethical compliance, and online submission.</p>
                            <a href="<?= base_url('journal/author-guidelines') ?>" class="btn btn-sm btn-link text-success p-0">Read more →</a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light rounded-3 p-3">
                            <i class="fas fa-chart-line fa-2x text-success mb-2"></i>
                            <h5 class="fw-bold">Why Publish with OJAS?</h5>
                            <p class="small text-secondary">Open access, no APCs, global visibility, rapid peer review, and indexing in major databases.</p>
                            <a href="<?= base_url('journal/about') ?>" class="btn btn-sm btn-link text-success p-0">Learn more →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Calls (if any) -->
        <?php if (!empty($upcoming_calls)): ?>
            <div class="mb-5">
                <h2 class="fw-bold text-success mb-4"><i class="fas fa-clock me-2"></i> Upcoming Calls</h2>
                <div class="row g-4">
                    <?php foreach ($upcoming_calls as $call): ?>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm rounded-4 h-100">
                                <div class="card-body p-4">
                                    <h5 class="fw-bold"><?= htmlspecialchars($call->title) ?></h5>
                                    <p class="text-muted small">Opens soon</p>
                                    <a href="<?= base_url('journal/special-issue/' . $call->specialIssueId) ?>" class="btn btn-sm btn-outline-secondary rounded-pill">Notify me</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Past Calls (Optional) -->
        <?php if (!empty($closed_calls)): ?>
            <div class="mt-5">
                <h2 class="fw-bold text-success mb-4"><i class="fas fa-archive me-2"></i> Past Special Issues</h2>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Title</th>
                                <th>Guest Editor</th>
                                <th>Deadline</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($closed_calls as $call): ?>
                                <tr>
                                    <td><?= htmlspecialchars($call->title) ?></td>
                                    <td><?= htmlspecialchars($call->guest_editor_name ?? '—') ?></td>
                                    <td><?= date('M d, Y', strtotime($call->submissionDeadline)) ?></td>
                                    <td><span class="badge bg-secondary">Closed</span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- Call to Action -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="bg-light rounded-4 p-5 text-center">
                    <h3 class="fw-bold text-success">Propose a Special Issue</h3>
                    <p class="text-secondary mb-3">Interested in guest editing a thematic collection? Submit your proposal to the editorial office.</p>
                    <a href="<?= base_url('journal/contact') ?>" class="btn btn-success btn-lg px-5 rounded-pill">
                        <i class="fas fa-envelope me-2"></i> Contact Editors
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>