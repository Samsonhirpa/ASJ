<div class="content-wrapper"><section class="content-header"><h1>Managing Editor Results</h1></section><section class="content">
<div class="box box-warning"><div class="box-body table-responsive">
<table class="table table-striped"><thead><tr><th>#</th><th>Title</th><th>Managing Editor</th><th>Total</th><th>ME Result</th><th>Action</th></tr></thead><tbody>
<?php if(!empty($manuscripts)): foreach($manuscripts as $m): ?>
<tr>
<td><?= html_escape($m->manuscriptNumber) ?></td>
<td><?= html_escape($m->title) ?></td>
<td><?= html_escape($m->managingEditorName ?: 'N/A') ?></td>
<td><?= (int)$m->totalScore ?>/100</td>
<td><?= html_escape($m->meResultStatus) ?></td>
<td>
<a class="btn btn-xs btn-info" href="<?= base_url('editor/me-results/detail/'.$m->manuscriptId) ?>">Details</a>
<form method="post" action="<?= base_url('editor/me-results/decision/'.$m->manuscriptId) ?>" style="display:inline-block;">
<button name="decision" value="approved" class="btn btn-xs btn-success" <?= $m->eicMeDecision==='approved'?'disabled':'' ?>>Approve</button>
<button name="decision" value="rejected" class="btn btn-xs btn-danger" <?= $m->eicMeDecision==='approved'?'disabled':'' ?>>Reject</button>
<input type="text" name="reason" placeholder="Reject reason" class="form-control input-sm" style="width:130px;display:inline-block;" />
</form>
<?php if($m->eicMeDecision==='approved'): ?>
<a class="btn btn-xs btn-primary" href="<?= base_url('editor/me-results/assign/'.$m->manuscriptId) ?>">Assign</a>
<?php endif; ?>
</td>
</tr>
<?php endforeach; else: ?><tr><td colspan="6">No records found.</td></tr><?php endif; ?>
</tbody></table></div></div></section></div>
