<div class="content-wrapper"><section class="content-header"><h1>Screened Manuscripts</h1></section>
<section class="content"><div class="box box-success"><div class="box-body table-responsive">
<table class="table table-striped"><thead><tr><th>#</th><th>Title</th><th>Result</th><th>Score</th><th>Date</th></tr></thead><tbody>
<?php if(!empty($manuscripts)): foreach($manuscripts as $m): ?>
<tr><td><?= html_escape($m->manuscriptNumber) ?></td><td><?= html_escape($m->title) ?></td><td><?= html_escape($m->meResultStatus) ?></td><td><?= (int)$m->totalScore ?>/100</td><td><?= !empty($m->screenedDtm)?date('d M Y',strtotime($m->screenedDtm)):'-' ?></td></tr>
<?php endforeach; else: ?><tr><td colspan="5">No screened manuscripts.</td></tr><?php endif; ?>
</tbody></table></div></div></section></div>
