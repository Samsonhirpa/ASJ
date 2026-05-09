<div class="content-wrapper"><section class="content-header"><h1>Manuscript Details</h1></section>
<section class="content"><div class="box box-primary"><div class="box-body">
<p><strong>Manuscript:</strong> <?= html_escape($manuscript->manuscriptNumber) ?> - <?= html_escape($manuscript->title) ?></p>
<p><strong>Status:</strong> <?= html_escape($manuscript->status) ?></p>
<p><strong>EiC Decision (ME result):</strong> <?= html_escape($manuscript->eicMeDecision) ?></p>
<p><strong>Managing Editor Screening:</strong> <?= html_escape($manuscript->meResultStatus ?: '-') ?> (<?= (int)$manuscript->totalScore ?>/100)</p>
<p><strong>ME Comments:</strong><br><?= nl2br(html_escape($manuscript->meComments ?: '-')) ?></p>
<?php if(!empty($manuscript->file)): ?>
<p><strong>Manuscript File:</strong> <a href="<?= base_url($manuscript->file) ?>" target="_blank">Open file</a></p>
<?php endif; ?>
<?php if(!empty($manuscript->resultFilePath)): ?>
<p><strong>ME Screening File:</strong> <a href="<?= base_url($manuscript->resultFilePath) ?>" target="_blank">Open result file</a></p>
<?php endif; ?>
<a href="<?= base_url('editor/ae-assignments') ?>" class="btn btn-default">Back</a>
</div></div></section></div>
