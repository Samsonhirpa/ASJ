<div class="content-wrapper"><section class="content-header"><h1>Associate Editor Assignments</h1></section>
<section class="content"><div class="box box-default"><div class="box-body table-responsive">
<table class="table table-striped table-bordered"><thead><tr><th>#</th><th>Title</th><th>Thematic Area</th><th>Keywords</th><th>Response</th><th>Actions</th></tr></thead><tbody>
<?php if(!empty($assignments)): foreach($assignments as $m): ?>
<tr>
<td><?= html_escape($m->manuscriptNumber) ?></td>
<td><?= html_escape($m->title) ?></td>
<td><?= html_escape($m->thematicArea ?: '-') ?></td>
<td><?= html_escape($m->keywords ?: '-') ?></td>
<td><span class="label label-<?= $m->aeAssignmentResponse==='accepted'?'success':($m->aeAssignmentResponse==='declined'?'danger':'warning') ?>"><?= html_escape($m->aeAssignmentResponse) ?></span></td>
<td>
<?php if($m->aeAssignmentResponse==='pending'): ?>
<a class="btn btn-xs btn-success" href="<?= base_url('editor/ae-assignments/respond/'.$m->manuscriptId.'/accepted') ?>">Accept</a>
<a class="btn btn-xs btn-danger" href="<?= base_url('editor/ae-assignments/respond/'.$m->manuscriptId.'/declined') ?>">Decline</a>
<?php endif; ?>
<?php if($m->aeAssignmentResponse==='accepted'): ?>
<a class="btn btn-xs btn-primary" href="<?= base_url('editor/ae-assignments/view/'.$m->manuscriptId) ?>">View</a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; else: ?><tr><td colspan="6">No assignments found.</td></tr><?php endif; ?>
</tbody></table>
</div></div></section></div>
