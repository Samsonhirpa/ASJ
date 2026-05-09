<div class="content-wrapper"><section class="content-header"><h1>ME Result Detail</h1></section><section class="content">
<div class="box box-default"><div class="box-body">
<h4><?= html_escape($manuscript->manuscriptNumber) ?> - <?= html_escape($manuscript->title) ?></h4>
<p><strong>EIC Technical Notes:</strong><br><?= nl2br(html_escape($manuscript->technicalScreeningNotes ?: '-')) ?></p>
<p><strong>EIC Scope Notes:</strong><br><?= nl2br(html_escape($manuscript->scopeScreeningNotes ?: '-')) ?></p>
<p><strong>ME Total Score:</strong> <?= (int)($screening->totalScore ?? 0) ?>/100</p>
<p><strong>ME Comments:</strong><br><?= nl2br(html_escape($screening->comments ?? '-')) ?></p>
<h4>Files</h4>
<ul><?php foreach($files as $f): ?><li><a href="<?= base_url($f->filePath) ?>" target="_blank"><?= html_escape($f->fileName) ?></a></li><?php endforeach; ?></ul>
</div></div></section></div>
