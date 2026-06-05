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
    .ae-detail-page .hero-card {
        background: linear-gradient(135deg, #123c69 0%, #1f6f8b 60%, #2a9d8f 100%);
        color: #fff;
        border-radius: 14px;
        padding: 26px 30px;
        box-shadow: 0 18px 35px rgba(18, 60, 105, 0.18);
        margin-bottom: 20px;
    }
    .ae-detail-page .hero-card h1,
    .ae-detail-page .hero-card h3,
    .ae-detail-page .hero-card p { color: #fff; }
    .ae-detail-page .hero-card h1 { margin: 0 0 10px; font-size: 28px; font-weight: 700; line-height: 1.25; }
    .ae-detail-page .hero-meta { margin-top: 16px; }
    .ae-detail-page .hero-meta .meta-pill {
        display: inline-block;
        background: rgba(255, 255, 255, 0.16);
        border: 1px solid rgba(255, 255, 255, 0.24);
        border-radius: 30px;
        padding: 7px 13px;
        margin: 4px 6px 4px 0;
        font-size: 12px;
        letter-spacing: .2px;
    }
    .ae-detail-page .summary-card,
    .ae-detail-page .professional-box {
        border: 0;
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.07);
        overflow: hidden;
    }
    .ae-detail-page .professional-box .box-header {
        border-bottom: 1px solid #eef2f7;
        padding: 15px 18px;
    }
    .ae-detail-page .professional-box .box-title { font-weight: 700; color: #1f2937; }
    .ae-detail-page .info-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
    .ae-detail-page .info-item {
        background: #f8fafc;
        border: 1px solid #edf2f7;
        border-radius: 10px;
        padding: 12px 14px;
        min-height: 72px;
    }
    .ae-detail-page .info-label {
        color: #64748b;
        display: block;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .04em;
        margin-bottom: 5px;
        font-weight: 700;
    }
    .ae-detail-page .info-value { color: #111827; font-weight: 600; word-break: break-word; }
    .ae-detail-page .section-text {
        background: #fff;
        border: 1px solid #edf2f7;
        border-radius: 10px;
        padding: 15px;
        white-space: pre-line;
        line-height: 1.65;
    }
    .ae-detail-page .author-card {
        border: 1px solid #edf2f7;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 12px;
        background: #fff;
    }
    .ae-detail-page .author-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: #e0f2fe;
        color: #0369a1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        margin-right: 10px;
        vertical-align: middle;
    }
    .ae-detail-page .author-name { font-size: 16px; font-weight: 700; color: #111827; }
    .ae-detail-page .author-contact { color: #64748b; margin-top: 8px; line-height: 1.7; }
    .ae-detail-page .file-table > tbody > tr > td { vertical-align: middle; }
    .ae-detail-page .file-type-badge {
        display: inline-block;
        min-width: 96px;
        text-align: center;
        border-radius: 30px;
        padding: 6px 10px;
        background: #eef6ff;
        color: #1d4ed8;
        font-weight: 700;
        font-size: 12px;
    }
    .ae-detail-page .quick-action {
        border-radius: 10px;
        padding: 11px 13px;
        margin-bottom: 8px;
        text-align: left;
        font-weight: 700;
    }
    @media (max-width: 767px) {
        .ae-detail-page .info-grid { grid-template-columns: 1fr; }
        .ae-detail-page .hero-card { padding: 20px; }
    }
</style>

<div class="content-wrapper ae-detail-page">
    <section class="content-header">
        <h1>Accepted Manuscript Details <small>Associate Editor Workspace</small></h1>
    </section>

    <section class="content">
        <div class="hero-card">
            <div class="row">
                <div class="col-md-9">
                    <div class="text-uppercase" style="opacity:.9;font-weight:700;letter-spacing:.08em;margin-bottom:8px;">
                        <?= html_escape($manuscript->manuscriptNumber) ?>
                    </div>
                    <h1><?= html_escape($manuscript->title) ?></h1>
                    <p style="font-size:15px;margin-bottom:0;opacity:.94;">
                        Submitted by <strong><?= html_escape($manuscript->submitterName ?: '-') ?></strong>
                        <?php if (!empty($manuscript->submitterEmail)): ?> · <?= html_escape($manuscript->submitterEmail) ?><?php endif; ?>
                    </p>
                    <div class="hero-meta">
                        <span class="meta-pill"><i class="fa fa-file-text-o"></i> <?= html_escape($humanize($manuscript->articleType ?: 'Article')) ?></span>
                        <span class="meta-pill"><i class="fa fa-bookmark-o"></i> <?= html_escape($manuscript->thematicArea ?: 'No thematic area') ?></span>
                        <span class="meta-pill"><i class="fa fa-calendar"></i> Submitted <?= html_escape($formatDate($manuscript->createdDtm)) ?></span>
                    </div>
                </div>
                <div class="col-md-3 text-right">
                    <span class="label label-<?= $statusClass($manuscript->status) ?>" style="font-size:13px;padding:8px 12px;display:inline-block;margin-bottom:10px;">
                        <?= html_escape($humanize($manuscript->status)) ?>
                    </span><br>
                    <span class="label label-<?= $statusClass($manuscript->eicMeDecision) ?>" style="font-size:13px;padding:8px 12px;display:inline-block;">
                        EIC: <?= html_escape($humanize($manuscript->eicMeDecision ?: 'pending')) ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box professional-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-info-circle text-aqua"></i> Manuscript Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="info-grid">
                            <div class="info-item"><span class="info-label">Manuscript Number</span><span class="info-value"><?= html_escape($manuscript->manuscriptNumber) ?></span></div>
                            <div class="info-item"><span class="info-label">Article Type</span><span class="info-value"><?= html_escape($humanize($manuscript->articleType ?: '-')) ?></span></div>
                            <div class="info-item"><span class="info-label">Thematic Area</span><span class="info-value"><?= html_escape($manuscript->thematicArea ?: '-') ?></span></div>
                            <div class="info-item"><span class="info-label">Word Count</span><span class="info-value"><?= !empty($manuscript->wordCount) ? number_format((int)$manuscript->wordCount) : '-' ?></span></div>
                            <div class="info-item"><span class="info-label">Plagiarism Score</span><span class="info-value"><?= $manuscript->plagiarismScore !== null && $manuscript->plagiarismScore !== '' ? html_escape($manuscript->plagiarismScore) . '%' : '-' ?></span></div>
                            <div class="info-item"><span class="info-label">Last Updated</span><span class="info-value"><?= html_escape($formatDate($manuscript->updatedDtm)) ?></span></div>
                        </div>

                        <h4 style="margin-top:24px;font-weight:700;">Abstract</h4>
                        <div class="section-text"><?= html_escape($manuscript->abstract ?: 'No abstract provided.') ?></div>

                        <h4 style="margin-top:20px;font-weight:700;">Keywords</h4>
                        <div class="section-text"><?= html_escape($manuscript->keywords ?: 'No keywords provided.') ?></div>

                        <h4 style="margin-top:20px;font-weight:700;">Cover Letter</h4>
                        <div class="section-text"><?= html_escape($manuscript->coverLetter ?: 'No cover letter provided.') ?></div>
                    </div>
                </div>

                <div class="box professional-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-users text-green"></i> Author Information</h3>
                    </div>
                    <div class="box-body">
                        <?php if (!empty($authors)): ?>
                            <?php foreach ($authors as $author): ?>
                                <?php $initial = strtoupper(substr(trim((string)$author->name), 0, 1)); ?>
                                <div class="author-card">
                                    <div>
                                        <span class="author-avatar"><?= html_escape($initial ?: 'A') ?></span>
                                        <span class="author-name"><?= html_escape($author->name ?: '-') ?></span>
                                        <?php if (!empty($author->isCorresponding)): ?>
                                            <span class="label label-primary" style="margin-left:8px;">Corresponding</span>
                                        <?php endif; ?>
                                        <span class="label label-default" style="margin-left:4px;">#<?= (int)$author->authorOrder ?></span>
                                    </div>
                                    <div class="author-contact row">
                                        <div class="col-sm-6"><i class="fa fa-envelope-o"></i> <?= html_escape($author->email ?: '-') ?></div>
                                        <div class="col-sm-6"><i class="fa fa-phone"></i> <?= html_escape($author->mobile ?: '-') ?></div>
                                        <div class="col-sm-6"><i class="fa fa-university"></i> <?= html_escape($author->institution ?: '-') ?></div>
                                        <div class="col-sm-6"><i class="fa fa-building-o"></i> <?= html_escape($author->department ?: '-') ?></div>
                                        <div class="col-sm-6"><i class="fa fa-map-marker"></i> <?= html_escape(trim(($author->city ?: '') . (!empty($author->city) && !empty($author->country) ? ', ' : '') . ($author->country ?: '')) ?: '-') ?></div>
                                        <div class="col-sm-6"><i class="fa fa-id-card-o"></i> ORCID: <?= html_escape($author->orcid ?: '-') ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-info" style="margin-bottom:0;">No author records are available for this manuscript.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="box professional-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-folder-open text-orange"></i> Manuscript Files</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-hover file-table">
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
                                        <td><strong><?= html_escape($file->fileName) ?></strong><br><small class="text-muted"><?= html_escape($file->mimeType ?: '') ?></small></td>
                                        <td><?= html_escape($formatFileSize($file->fileSize)) ?></td>
                                        <td>v<?= (int)$file->version ?></td>
                                        <td><?= html_escape($formatDate($file->createdDtm)) ?></td>
                                        <td class="text-right">
                                            <a class="btn btn-xs btn-default" href="<?= base_url($file->filePath) ?>" target="_blank"><i class="fa fa-external-link"></i> Open</a>
                                            <a class="btn btn-xs btn-success" href="<?= base_url('editor/ae-assignments/view/' . (int)$manuscript->manuscriptId . '/file/' . (int)$file->fileId . '/download') ?>"><i class="fa fa-download"></i> Download</a>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="6" class="text-center text-muted">No files uploaded for this manuscript.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="box professional-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-comments-o text-purple"></i> Editorial Notes and Screening</h3>
                    </div>
                    <div class="box-body">
                        <div class="info-grid" style="margin-bottom:16px;">
                            <div class="info-item"><span class="info-label">ME Screening Result</span><span class="info-value"><?= html_escape($humanize($manuscript->meResultStatus ?: '-')) ?></span></div>
                            <div class="info-item"><span class="info-label">ME Total Score</span><span class="info-value"><?= $manuscript->totalScore !== null && $manuscript->totalScore !== '' ? (int)$manuscript->totalScore . '/100' : '-' ?></span></div>
                        </div>
                        <h4 style="font-weight:700;">Editor-in-Chief Comments</h4>
                        <div class="section-text"><?= html_escape($manuscript->technicalScreeningNotes ?: 'No EIC comments yet.') ?></div>
                        <h4 style="margin-top:18px;font-weight:700;">Managing Editor Comments</h4>
                        <div class="section-text"><?= html_escape($manuscript->meComments ?: 'No ME comments yet.') ?></div>
                        <?php if (!empty($manuscript->resultFilePath)): ?>
                            <div style="margin-top:15px;">
                                <a href="<?= base_url($manuscript->resultFilePath) ?>" target="_blank" class="btn btn-default"><i class="fa fa-download"></i> Open ME Screening File</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box professional-box summary-card">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user-md text-blue"></i> Corresponding Author</h3>
                    </div>
                    <div class="box-body">
                        <h4 style="margin-top:0;font-weight:700;"><?= html_escape($manuscript->correspondingAuthorName ?: '-') ?></h4>
                        <p><i class="fa fa-envelope-o text-muted"></i> <?= html_escape($manuscript->correspondingAuthorEmail ?: '-') ?></p>
                        <p><i class="fa fa-phone text-muted"></i> <?= html_escape($manuscript->correspondingAuthorMobile ?: '-') ?></p>
                        <p><i class="fa fa-university text-muted"></i> <?= html_escape($manuscript->correspondingAuthorInstitution ?: '-') ?></p>
                        <p><i class="fa fa-building-o text-muted"></i> <?= html_escape($manuscript->correspondingAuthorDepartment ?: '-') ?></p>
                        <p><i class="fa fa-map-marker text-muted"></i> <?= html_escape(trim(($manuscript->correspondingAuthorCity ?: '') . (!empty($manuscript->correspondingAuthorCity) && !empty($manuscript->correspondingAuthorCountry) ? ', ' : '') . ($manuscript->correspondingAuthorCountry ?: '')) ?: '-') ?></p>
                        <p><i class="fa fa-id-card-o text-muted"></i> ORCID: <?= html_escape($manuscript->correspondingAuthorOrcid ?: '-') ?></p>
                    </div>
                </div>

                <div class="box professional-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-bolt text-yellow"></i> Quick Actions</h3>
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
                            <a class="btn btn-success btn-block quick-action" href="<?= base_url('editor/ae-assignments/view/' . (int)$manuscript->manuscriptId . '/file/' . (int)$mainFile->fileId . '/download') ?>"><i class="fa fa-download"></i> Download Main Manuscript</a>
                            <a class="btn btn-default btn-block quick-action" href="<?= base_url($mainFile->filePath) ?>" target="_blank"><i class="fa fa-external-link"></i> Open Main Manuscript</a>
                        <?php endif; ?>
                        <a class="btn btn-primary btn-block quick-action" href="<?= base_url('editor/ae-assign-reviewers/' . (int)$manuscript->manuscriptId) ?>"><i class="fa fa-user-plus"></i> Assign / Manage Reviewers</a>
                        <a class="btn btn-default btn-block quick-action" href="<?= base_url('editor/ae-assignments') ?>"><i class="fa fa-arrow-left"></i> Back to Assignments</a>
                    </div>
                </div>

                <div class="box professional-box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-clock-o text-muted"></i> Timeline</h3>
                    </div>
                    <div class="box-body">
                        <ul class="list-unstyled" style="line-height:2;">
                            <li><strong>Submitted:</strong> <?= html_escape($formatDate($manuscript->createdDtm)) ?></li>
                            <li><strong>Updated:</strong> <?= html_escape($formatDate($manuscript->updatedDtm)) ?></li>
                            <li><strong>ME Screened:</strong> <?= html_escape($formatDate($manuscript->screenedDtm)) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
