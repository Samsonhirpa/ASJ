<div class="content-wrapper">
    <section class="content-header">
        <h1>ME Result Detail <small>Screening + manuscript package</small></h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= html_escape($manuscript->manuscriptNumber) ?> — <?= html_escape($manuscript->title) ?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6"><div class="callout callout-info"><h4>EIC Technical Notes</h4><p><?= nl2br(html_escape($manuscript->technicalScreeningNotes ?: '-')) ?></p></div></div>
                    <div class="col-md-6"><div class="callout callout-warning"><h4>EIC Scope Notes</h4><p><?= nl2br(html_escape($manuscript->scopeScreeningNotes ?: '-')) ?></p></div></div>
                </div>
                <div class="callout callout-success">
                    <h4>Managing Editor Evaluation</h4>
                    <p><strong>Total Score:</strong> <?= (int)($screening->totalScore ?? 0) ?>/100</p>
                    <p><strong>Comments:</strong><br><?= nl2br(html_escape($screening->comments ?? '-')) ?></p>
                </div>
                <h4><i class="fa fa-files-o"></i> Manuscript Files</h4>
                <table class="table table-bordered table-striped">
                    <thead><tr><th>Type</th><th>Name</th><th>Action</th></tr></thead>
                    <tbody>
                    <?php if(!empty($files)): foreach($files as $f): ?>
                        <tr><td><?= html_escape($f->fileType) ?></td><td><?= html_escape($f->fileName) ?></td><td><a class="btn btn-xs btn-default" href="<?= base_url($f->filePath) ?>" target="_blank"><i class="fa fa-download"></i> Open</a></td></tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="3" class="text-center text-muted">No files available.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
