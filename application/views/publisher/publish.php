<div class="content-wrapper"><section class="content-header"><h1>Publish</h1></section><section class="content"><div class="box"><div class="box-header"><h3 class="box-title">Manuscripts with complete metadata and proof</h3></div><div class="box-body table-responsive"><table class="table table-bordered"><thead><tr><th>Manuscript</th><th>Title</th><th>Production Status</th><th>Action</th></tr></thead><tbody>
<?php if (empty($manuscripts ?? [])): ?>
<tr><td colspan="4" class="text-center text-muted">No manuscripts are ready for final publishing.</td></tr>
<?php else: foreach(($manuscripts ?? []) as $m): ?><tr><td><?= html_escape($m->manuscriptNumber) ?></td><td><?= html_escape($m->title) ?></td><td><?= html_escape((string)$m->production_status) ?></td><td><a class="btn btn-xs btn-primary" href="<?= base_url('publisher/publish/process/' . (int)$m->manuscriptId) ?>">Finalize Publish</a></td></tr><?php endforeach; endif; ?>
</tbody></table></div></div></section></div>
