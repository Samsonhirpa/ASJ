<div style="background: #f9fafb; padding: 40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 style="color: #0f3b2c; font-size: 3em; font-weight: 800; margin-bottom: 20px;">Editorial Board</h1>
                <p class="lead text-secondary" style="max-width: 800px; margin: 0 auto 40px;">
                    Meet the distinguished scholars and experts guiding OJAS's editorial vision.
                </p>
            </div>
        </div>

        <?php if (!empty($board_members)): ?>
            <?php 
            $grouped = [];
            foreach ($board_members as $member) {
                $grouped[$member->role_title][] = $member;
            }
            ?>

            <?php foreach ($grouped as $role => $members): ?>
                <div class="card border-0 shadow-sm rounded-4 mb-5 overflow-hidden">
                    <div class="card-header bg-success text-white py-3 px-4" style="background: #0f3b2c;">
                        <h3 class="h4 mb-0 fw-bold"><?= htmlspecialchars($role) ?></h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <?php foreach ($members as $member): ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="d-flex align-items-start gap-3 p-3 bg-light rounded-3 h-100">
                                        <div class="flex-shrink-0">
                                            <?php if (!empty($member->profile_image) && file_exists(FCPATH . 'assets/uploads/profile/' . $member->profile_image)): ?>
                                                <img src="<?= base_url('assets/uploads/profile/' . $member->profile_image) ?>" alt="<?= htmlspecialchars($member->name) ?>" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                            <?php else: ?>
                                                <div class="rounded-circle bg-success bg-opacity-25 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                                    <i class="fas fa-user-graduate fa-2x text-success"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fw-bold text-success mb-1"><?= htmlspecialchars($member->name) ?></h5>
                                            <p class="text-muted small mb-2">
                                                <?= !empty($member->institution) ? htmlspecialchars($member->institution) : 'IQQO' ?>
                                                <?= !empty($member->department) ? ' · ' . htmlspecialchars($member->department) : '' ?>
                                            </p>
                                            <?php if (!empty($member->bio)): ?>
                                                <p class="small text-secondary mb-2"><?= nl2br(htmlspecialchars(substr($member->bio, 0, 120))) . (strlen($member->bio) > 120 ? '...' : '') ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($member->email)): ?>
                                                <a href="mailto:<?= htmlspecialchars($member->email) ?>" class="text-decoration-none small">
                                                    <i class="fas fa-envelope me-1"></i> <?= htmlspecialchars($member->email) ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($member->country)): ?>
                                                <div class="small text-muted mt-1">
                                                    <i class="fas fa-map-marker-alt me-1"></i> <?= htmlspecialchars($member->country) ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info text-center p-5">
                <i class="fas fa-info-circle fa-3x mb-3"></i>
                <h4>Editorial Board Members will be listed soon.</h4>
                <p>Please check back later.</p>
            </div>
        <?php endif; ?>

        <div class="row mt-5">
            <div class="col-12">
                <div class="bg-light rounded-4 p-5 text-center">
                    <h3 class="fw-bold text-success">Interested in Joining Our Editorial Team?</h3>
                    <p class="text-secondary mb-3">Exceptional researchers are welcome to apply for editorial positions.</p>
                    <a href="<?= base_url('journal/contact') ?>" class="btn btn-success btn-lg px-5 rounded-pill">
                        <i class="fas fa-envelope me-2"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>