<div class="content-wrapper"><section class="content-header"><h1>Assign Reviewers</h1></section>
<section class="content"><div class="box box-default"><div class="box-body table-responsive">
<table class="table table-striped table-bordered">
    <thead><tr><th>Manuscript #</th><th>Title</th><th>Thematic Area</th><th>Keywords</th><th>Action</th></tr></thead>
    <tbody>
    <?php if(!empty($manuscripts)): foreach($manuscripts as $m): ?>
        <tr>
            <td><?= html_escape($m->manuscriptNumber) ?></td>
            <td><?= html_escape($m->title) ?></td>
            <td><?= html_escape($m->thematicArea ?: '-') ?></td>
            <td><?= html_escape($m->keywords ?: '-') ?></td>
            <td><a class="btn btn-xs btn-primary" href="<?= base_url('editor/ae-assign-reviewers/'.$m->manuscriptId) ?>">Assign</a></td>
        </tr>
    <?php endforeach; else: ?>
        <tr><td colspan="5" class="text-center">No accepted manuscripts found.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</div></div></section></div>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Accepted Manuscript Details</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= html_escape($manuscript->manuscriptNumber) ?> — <?= html_escape($manuscript->title) ?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Thematic Area:</strong> <?= html_escape($manuscript->thematicArea ?: '-') ?></p>
                        <p><strong>Keywords:</strong> <?= html_escape($manuscript->keywords ?: '-') ?></p>
                        <p><strong>Abstract:</strong><br><?= nl2br(html_escape($manuscript->abstract ?: '-')) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Status:</strong> <?= html_escape($manuscript->status) ?></p>
                        <p><strong>EIC Decision:</strong> <?= html_escape($manuscript->eicMeDecision ?: '-') ?></p>
                        <p><strong>ME Screening Result:</strong> <?= html_escape($manuscript->meResultStatus ?: '-') ?> (<?= (int)$manuscript->totalScore ?>/100)</p>
                        <p><strong>Submitted Date:</strong> <?= !empty($manuscript->createdDtm) ? date('d M Y H:i', strtotime($manuscript->createdDtm)) : '-' ?></p>
                    </div>
                </div>
                <hr>
                <h4>Files</h4>
                <ul>
                    <?php if (!empty($manuscript->file)): ?>
                        <li><a href="<?= base_url($manuscript->file) ?>" target="_blank">Main Manuscript File</a></li>
                    <?php endif; ?>
                    <?php if (!empty($manuscript->coverLetter)): ?>
                        <li><a href="<?= base_url($manuscript->coverLetter) ?>" target="_blank">Cover Letter</a></li>
                    <?php endif; ?>
                    <?php if (!empty($manuscript->resultFilePath)): ?>
                        <li><a href="<?= base_url($manuscript->resultFilePath) ?>" target="_blank">ME Screening File</a></li>
                    <?php endif; ?>
                </ul>
                <div class="well" style="margin-top:20px;">
                    <h4 style="margin-top:0;">Editorial Comments</h4>
                    <p><strong>Editor-in-Chief Comments:</strong><br><?= nl2br(html_escape($manuscript->technicalScreeningNotes ?: 'No EIC comments yet.')) ?></p>
                    <p><strong>Managing Editor Comments:</strong><br><?= nl2br(html_escape($manuscript->meComments ?: 'No ME comments yet.')) ?></p>
                </div>
                <a href="<?= base_url('editor/ae-assignments') ?>" class="btn btn-default">Back</a>
            </div>
        </div>
    </section>
</div>