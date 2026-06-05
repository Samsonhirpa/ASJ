
<?php
$formatDate = function ($value) {
    return !empty($value) ? date('d M Y H:i', strtotime($value)) : '-';
};

$formatFileSize = function ($bytes) {
    $bytes = (int)$bytes;
    if ($bytes <= 0) {
        return '-';
    }
    $units = ['B', 'KB', 'MB', 'GB'];
    $index = 0;
    while ($bytes >= 1024 && $index < count($units) - 1) {
        $bytes = $bytes / 1024;
        $index++;
    }
    return number_format($bytes, $index === 0 ? 0 : 1) . ' ' . $units[$index];
};

$humanize = function ($value) {
    return ucwords(str_replace('_', ' ', (string)$value));
};

$statusClass = function ($status) {
    switch ($status) {
        case 'accepted':
        case 'approved':
        case 'passed':
            return 'success';
        case 'rejected':
        case 'failed':
            return 'danger';
        case 'under_review':
        case 'submitted':
            return 'info';
        default:
            return 'default';
    }
};
?>
<style>
    :root {
        --primary-dark: #0f2b3d;
        --primary: #1a6d7e;
        --primary-light: #2a9d8f;
        --accent: #e9c46a;
        --gray-light: #f8fafc;
        --gray-border: #e2e8f0;
        --text-dark: #1e293b;
        --text-muted: #64748b;
        --shadow-sm: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
        --shadow-md: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.01);
        --transition: all 0.2s ease;
    }

    .ae-detail-page {
        background: #f1f5f9;
        font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    .ae-detail-page .hero-card {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 60%, var(--primary-light) 100%);
        border-radius: 24px;
        padding: 32px 36px;
        margin-bottom: 32px;
        box-shadow: var(--shadow-md);
        position: relative;
        overflow: hidden;
    }

    .ae-detail-page .hero-card::before {
        content: '';
        position: absolute;
        top: -30%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .ae-detail-page .hero-card::after {
        content: '';
        position: absolute;
        bottom: -20%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        pointer-events: none;
    }

    .ae-detail-page .hero-card h1 {
        font-size: 32px;
        font-weight: 700;
        letter-spacing: -0.02em;
        margin: 8px 0 12px;
        line-height: 1.3;
    }

    .ae-detail-page .hero-meta {
        margin-top: 24px;
    }

    .ae-detail-page .hero-meta .meta-pill {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(4px);
        border-radius: 40px;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 500;
        transition: var(--transition);
    }

    .ae-detail-page .hero-meta .meta-pill:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-1px);
    }

    .ae-detail-page .professional-box {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--gray-border);
        margin-bottom: 28px;
        transition: var(--transition);
        overflow: hidden;
    }

    .ae-detail-page .professional-box:hover {
        box-shadow: var(--shadow-md);
    }

    .ae-detail-page .professional-box .box-header {
        padding: 20px 24px 16px;
        background: transparent;
        border-bottom: 2px solid #f1f5f9;
    }

    .ae-detail-page .professional-box .box-title {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ae-detail-page .professional-box .box-title i {
        color: var(--primary);
        font-size: 20px;
    }

    .ae-detail-page .professional-box .box-body {
        padding: 20px 24px 24px;
    }

    .ae-detail-page .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 16px;
        margin-bottom: 28px;
    }

    .ae-detail-page .info-item {
        background: var(--gray-light);
        border-radius: 16px;
        padding: 16px 18px;
        border: 1px solid var(--gray-border);
        transition: var(--transition);
    }

    .ae-detail-page .info-item:hover {
        border-color: var(--primary-light);
        background: white;
    }

    .ae-detail-page .info-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-muted);
        margin-bottom: 8px;
        display: block;
    }

    .ae-detail-page .info-value {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-dark);
        word-break: break-word;
    }

    .ae-detail-page .section-text {
        background: var(--gray-light);
        border-radius: 16px;
        padding: 20px;
        border: 1px solid var(--gray-border);
        line-height: 1.65;
        color: var(--text-dark);
        font-size: 14px;
    }

    .ae-detail-page h4 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 28px 0 16px 0;
        letter-spacing: -0.01em;
    }

    .ae-detail-page .author-card {
        background: var(--gray-light);
        border-radius: 18px;
        padding: 20px;
        margin-bottom: 16px;
        border: 1px solid var(--gray-border);
        transition: var(--transition);
    }

    .ae-detail-page .author-card:hover {
        background: white;
        border-color: var(--primary-light);
        transform: translateY(-2px);
    }

    .ae-detail-page .author-avatar {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: white;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 18px;
        margin-right: 14px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    .ae-detail-page .author-name {
        font-size: 17px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .ae-detail-page .author-contact {
        margin-top: 14px;
        padding-top: 8px;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        color: var(--text-muted);
        font-size: 13px;
    }

    .ae-detail-page .author-contact > div {
        flex: 1 1 200px;
    }

    .ae-detail-page .author-contact i {
        width: 20px;
        color: var(--primary);
    }

    .ae-detail-page .file-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .ae-detail-page .file-table thead th {
        background: transparent;
        color: var(--text-muted);
        font-weight: 600;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        padding: 12px 8px;
        border-bottom: 1px solid var(--gray-border);
    }

    .ae-detail-page .file-table tbody tr {
        background: var(--gray-light);
        border-radius: 16px;
        transition: var(--transition);
    }

    .ae-detail-page .file-table tbody tr:hover {
        background: white;
        box-shadow: var(--shadow-sm);
    }

    .ae-detail-page .file-table td {
        padding: 16px 8px;
        border: none;
        vertical-align: middle;
    }

    .ae-detail-page .file-type-badge {
        background: #e0f2fe;
        color: #0369a1;
        padding: 5px 12px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 12px;
        display: inline-block;
        text-align: center;
        min-width: 80px;
    }

    .ae-detail-page .quick-action {
        border-radius: 14px;
        padding: 12px 16px;
        margin-bottom: 12px;
        font-weight: 600;
        transition: var(--transition);
        text-align: left;
        border: none;
    }

    .ae-detail-page .quick-action:hover {
        transform: translateY(-2px);
        filter: brightness(1.02);
    }

    .ae-detail-page .label {
        padding: 6px 14px;
        font-weight: 600;
        border-radius: 40px;
        font-size: 12px;
    }

    .ae-detail-page .btn-xs {
        padding: 4px 12px;
        font-size: 12px;
        border-radius: 30px;
        margin: 0 3px;
    }

    @media (max-width: 768px) {
        .ae-detail-page .hero-card {
            padding: 24px;
        }
        .ae-detail-page .hero-card h1 {
            font-size: 24px;
        }
        .ae-detail-page .professional-box .box-body {
            padding: 16px;
        }
        .ae-detail-page .info-grid {
            grid-template-columns: 1fr;
        }
        .ae-detail-page .author-contact > div {
            flex: 1 1 100%;
        }
    }
</style>

<div class="content-wrapper ae-detail-page">
    <section class="content-header" style="padding: 0 15px 20px 15px;">
        <h1 style="font-weight: 700; font-size: 24px; color: #0f2b3d;">Accepted Manuscript Details <span style="font-size: 14px; font-weight: normal; color: #64748b;">Associate Editor Workspace</span></h1>
    </section>

    <section class="content" style="padding: 0 15px;">
        <!-- Hero Card -->
        <div class="hero-card">
            <div class="row align-items-center">
                <div class="col-md-9">
                    <div style="font-size: 13px; font-weight: 600; letter-spacing: 0.1em; opacity: 0.8; margin-bottom: 8px;">
                        📄 <?= html_escape($manuscript->manuscriptNumber) ?>
                    </div>
                    <h1><?= html_escape($manuscript->title) ?></h1>
                    <p style="font-size: 15px; margin-top: 12px; opacity: 0.9;">
                        Submitted by <strong><?= html_escape($manuscript->submitterName ?: '-') ?></strong>
                        <?php if (!empty($manuscript->submitterEmail)): ?> · <?= html_escape($manuscript->submitterEmail) ?><?php endif; ?>
                    </p>
                    <div class="hero-meta">
                        <span class="meta-pill">📂 <?= html_escape($humanize($manuscript->articleType ?: 'Article')) ?></span>
                        <span class="meta-pill">🏷️ <?= html_escape($manuscript->thematicArea ?: 'No thematic area') ?></span>
                        <span class="meta-pill">📅 Submitted <?= html_escape($formatDate($manuscript->createdDtm)) ?></span>
                    </div>
                </div>
                <div class="col-md-3 text-md-end" style="margin-top: 20px;">
                    <div>
                        <span class="label label-<?= $statusClass($manuscript->status) ?>" style="font-size: 14px; padding: 8px 18px; margin-bottom: 12px; display: inline-block;">
                            <?= html_escape($humanize($manuscript->status)) ?>
                        </span>
                    </div>
                    <div>
                        <span class="label label-<?= $statusClass($manuscript->eicMeDecision) ?>" style="font-size: 13px; padding: 6px 14px; background: rgba(255,255,255,0.2);">
                            EIC: <?= html_escape($humanize($manuscript->eicMeDecision ?: 'pending')) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <!-- Manuscript Information -->
                <div class="professional-box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-info-circle"></i> Manuscript Information
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Manuscript Number</span>
                                <span class="info-value"><?= html_escape($manuscript->manuscriptNumber) ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Article Type</span>
                                <span class="info-value"><?= html_escape($humanize($manuscript->articleType ?: '-')) ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Thematic Area</span>
                                <span class="info-value"><?= html_escape($manuscript->thematicArea ?: '-') ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Last Updated</span>
                                <span class="info-value"><?= html_escape($formatDate($manuscript->updatedDtm)) ?></span>
                            </div>
                        </div>

                        <h4>📄 Abstract</h4>
                        <div class="section-text"><?= html_escape($manuscript->abstract ?: 'No abstract provided.') ?></div>

                        <h4>🔑 Keywords</h4>
                        <div class="section-text"><?= html_escape($manuscript->keywords ?: 'No keywords provided.') ?></div>

                        <h4>✉️ Cover Letter</h4>
                        <div class="section-text"><?= html_escape($manuscript->coverLetter ?: 'No cover letter provided.') ?></div>
                    </div>
                </div>

                <!-- Author Information -->
                <div class="professional-box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-users"></i> Author Information
                        </h3>
                    </div>
                    <div class="box-body">
                        <?php if (!empty($authors)): ?>
                            <?php foreach ($authors as $author): ?>
                                <?php $initial = strtoupper(substr(trim((string)$author->name), 0, 1)); ?>
                                <div class="author-card">
                                    <div style="display: flex; align-items: center; flex-wrap: wrap; gap: 10px;">
                                        <span class="author-avatar"><?= html_escape($initial ?: 'A') ?></span>
                                        <span class="author-name"><?= html_escape($author->name ?: '-') ?></span>
                                        <?php if (!empty($author->isCorresponding)): ?>
                                            <span class="label label-primary" style="background: #2a9d8f;">Corresponding</span>
                                        <?php endif; ?>
                                        <span class="label label-default" style="background: #e2e8f0; color: #475569;">#<?= (int)$author->authorOrder ?></span>
                                    </div>
                                    <div class="author-contact">
                                        <div><i class="fa fa-envelope-o"></i> <?= html_escape($author->email ?: '-') ?></div>
                                        <div><i class="fa fa-phone"></i> <?= html_escape($author->mobile ?: '-') ?></div>
                                        <div><i class="fa fa-university"></i> <?= html_escape($author->institution ?: '-') ?></div>
                                        <div><i class="fa fa-building-o"></i> <?= html_escape($author->department ?: '-') ?></div>
                                        <div><i class="fa fa-map-marker"></i> <?= html_escape(trim(($author->city ?: '') . (!empty($author->city) && !empty($author->country) ? ', ' : '') . ($author->country ?: '')) ?: '-') ?></div>
                                        <div><i class="fa fa-id-card-o"></i> ORCID: <?= html_escape($author->orcid ?: '-') ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-info" style="border-radius: 16px; margin: 0;">No author records are available for this manuscript.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Manuscript Files -->
                <div class="professional-box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-folder-open"></i> Manuscript Files
                        </h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="file-table">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>File Name</th>
                                    <th>Size</th>
                                    <th>Version</th>
                                    <th>Uploaded</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($files)): foreach ($files as $file): ?>
                                    <tr>
                                        <td><span class="file-type-badge"><?= html_escape($humanize($file->fileType)) ?></span></td>
                                        <td><strong><?= html_escape($file->fileName) ?></strong><br><small style="color: #94a3b8;"><?= html_escape($file->mimeType ?: '') ?></small></td>
                                        <td><?= html_escape($formatFileSize($file->fileSize)) ?></td>
                                        <td>v<?= (int)$file->version ?></td>
                                        <td><?= html_escape($formatDate($file->createdDtm)) ?></td>
                                        <td class="text-right">
                                            <a class="btn btn-xs btn-default" href="<?= base_url($file->filePath) ?>" target="_blank"><i class="fa fa-external-link"></i> Open</a>
                                            <a class="btn btn-xs btn-success" href="<?= base_url('editor/ae-assignments/view/' . (int)$manuscript->manuscriptId . '/file/' . (int)$file->fileId . '/download') ?>"><i class="fa fa-download"></i> Download</a>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="6" class="text-center text-muted" style="padding: 40px;">No files uploaded for this manuscript.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Editorial Notes and Screening -->
                <div class="professional-box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-comments-o"></i> Editorial Notes and Screening
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="info-grid" style="margin-bottom: 20px;">
                            <div class="info-item">
                                <span class="info-label">ME Screening Result</span>
                                <span class="info-value"><?= html_escape($humanize($manuscript->meResultStatus ?: '-')) ?></span>
                            </div>
                        </div>
                        <h4>📝 Editor-in-Chief Comments</h4>
                        <div class="section-text"><?= html_escape($manuscript->technicalScreeningNotes ?: 'No EIC comments yet.') ?></div>
                        <h4 style="margin-top: 20px;">💬 Managing Editor Comments</h4>
                        <div class="section-text"><?= html_escape($manuscript->meComments ?: 'No ME comments yet.') ?></div>
                        <?php if (!empty($manuscript->resultFilePath)): ?>
                            <div style="margin-top: 20px;">
                                <a href="<?= base_url($manuscript->resultFilePath) ?>" target="_blank" class="btn btn-default" style="border-radius: 30px;"><i class="fa fa-download"></i> Open ME Screening File</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Corresponding Author -->
                <div class="professional-box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-user-md"></i> Corresponding Author
                        </h3>
                    </div>
                    <div class="box-body">
                        <h4 style="margin-top: 0; font-weight: 700; font-size: 18px;"><?= html_escape($manuscript->correspondingAuthorName ?: '-') ?></h4>
                        <p><i class="fa fa-envelope-o" style="width: 22px;"></i> <?= html_escape($manuscript->correspondingAuthorEmail ?: '-') ?></p>
                        <p><i class="fa fa-phone" style="width: 22px;"></i> <?= html_escape($manuscript->correspondingAuthorMobile ?: '-') ?></p>
                        <p><i class="fa fa-university" style="width: 22px;"></i> <?= html_escape($manuscript->correspondingAuthorInstitution ?: '-') ?></p>
                        <p><i class="fa fa-building-o" style="width: 22px;"></i> <?= html_escape($manuscript->correspondingAuthorDepartment ?: '-') ?></p>
                        <p><i class="fa fa-map-marker" style="width: 22px;"></i> <?= html_escape(trim(($manuscript->correspondingAuthorCity ?: '') . (!empty($manuscript->correspondingAuthorCity) && !empty($manuscript->correspondingAuthorCountry) ? ', ' : '') . ($manuscript->correspondingAuthorCountry ?: '')) ?: '-') ?></p>
                        <p><i class="fa fa-id-card-o" style="width: 22px;"></i> ORCID: <?= html_escape($manuscript->correspondingAuthorOrcid ?: '-') ?></p>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="professional-box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-bolt"></i> Quick Actions
                        </h3>
                    </div>
                    <div class="box-body">
                        <?php
                        $mainFile = null;
                        if (!empty($files)) {
                            foreach ($files as $candidate) {
                                if ($candidate->fileType === 'main') { $mainFile = $candidate; break; }
                            }
                        }
                        ?>
                        <?php if ($mainFile): ?>
                            <a class="btn btn-success quick-action" href="<?= base_url('editor/ae-assignments/view/' . (int)$manuscript->manuscriptId . '/file/' . (int)$mainFile->fileId . '/download') ?>" style="background: #2a9d8f; color: white; width: 100%;"><i class="fa fa-download"></i> Download Main Manuscript</a>
                            <a class="btn btn-default quick-action" href="<?= base_url($mainFile->filePath) ?>" target="_blank" style="background: #f1f5f9; color: #1e293b; width: 100%;"><i class="fa fa-external-link"></i> Open Main Manuscript</a>
                        <?php endif; ?>
                        <a class="btn btn-primary quick-action" href="<?= base_url('editor/ae-assign-reviewers/' . (int)$manuscript->manuscriptId) ?>" style="background: #1a6d7e; width: 100%;"><i class="fa fa-user-plus"></i> Assign / Manage Reviewers</a>
                        <a class="btn btn-default quick-action" href="<?= base_url('editor/ae-assignments') ?>" style="background: #f1f5f9; color: #475569; width: 100%;"><i class="fa fa-arrow-left"></i> Back to Assignments</a>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="professional-box">
                    <div class="box-header">
                        <h3 class="box-title">
                            <i class="fa fa-clock-o"></i> Timeline
                        </h3>
                    </div>
                    <div class="box-body">
                        <ul style="list-style: none; padding: 0; margin: 0; line-height: 2.2;">
                            <li><strong>📅 Submitted:</strong> <?= html_escape($formatDate($manuscript->createdDtm)) ?></li>
                            <li><strong>🔄 Updated:</strong> <?= html_escape($formatDate($manuscript->updatedDtm)) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
