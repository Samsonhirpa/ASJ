<div class="content-wrapper">
<section class="content-header"><h1>Managing Editor Results</h1></section>
<section class="content">
<div class="box box-default"><div class="box-body">
<form method="get" class="form-inline" action="<?= base_url('editor/me-results') ?>">
<select name="status" class="form-control">
<?php foreach (['all'=>'All','passed'=>'Approved','failed'=>'Rejected'] as $k=>$v): ?>
<option value="<?= $k ?>" <?= $status===$k?'selected':'' ?>><?= $v ?></option>
<?php endforeach; ?>
</select>
<button class="btn btn-primary">Filter</button>
</form></div></div>
<div class="box box-warning"><div class="box-body table-responsive">
<table class="table table-striped"><thead><tr><th>#</th><th>Title</th><th>ME Total</th><th>Managing Editor</th><th>ME Result</th><th>Assign Status</th><th>AE Status</th><th>Actions</th></tr></thead><tbody>
<?php if(!empty($manuscripts)): foreach($manuscripts as $m): ?>
<tr>
<td><?= html_escape($m->manuscriptNumber) ?></td>
<td><?= html_escape($m->title) ?></td>
<td><?= (int)$m->totalScore ?>/100</td>
<td><?= html_escape($m->managingEditorName ?: '-') ?></td>
<td><span class="label label-<?= $m->meResultStatus==='passed'?'success':'danger' ?>"><?= html_escape($m->meResultStatus==='passed' ? 'approved' : 'rejected') ?></span></td>
<?php $isAssigned = !empty($m->assignedAssociateEditorName); ?>
<td>
<?php if ($isAssigned): ?>
<span class="label label-success">Assigned: <?= html_escape($m->assignedAssociateEditorName) ?></span>
<?php else: ?>
<span class="label label-default">Not assigned</span>
<?php endif; ?>
</td>
<td><span class="label label-<?= ($m->aeAssignmentResponse ?? 'pending') === 'accepted' ? 'success' : (($m->aeAssignmentResponse ?? 'pending') === 'declined' ? 'danger' : 'warning') ?>"><?= html_escape(ucfirst($m->aeAssignmentResponse ?? 'pending')) ?></span></td>
<td>
<?php $isRejected = isset($m->eicMeDecision) && $m->eicMeDecision === 'rejected'; ?>
<?php $isApproved = isset($m->eicMeDecision) && $m->eicMeDecision === 'approved'; ?>
<form method="post" action="<?= base_url('editor/me-results/decision/'.$m->manuscriptId) ?>" style="display:inline-block;">
<button name="decision" value="approved" class="btn btn-xs btn-success" <?= $isRejected ? 'disabled' : '' ?>>Approve</button>
<button name="decision" value="rejected" class="btn btn-xs btn-danger" <?= $isApproved ? 'disabled' : '' ?>>Reject</button>
</form>
<?php if($isApproved && !$isRejected): ?>
<a class="btn btn-xs btn-primary" href="<?= base_url('editor/me-results/assign/'.$m->manuscriptId) ?>">Assign</a>
<?php endif; ?>
<a class="btn btn-xs btn-info" href="<?= base_url('editor/me-results/view/'.$m->manuscriptId) ?>">View</a>
</td>
</tr>
<?php endforeach; else: ?><tr><td colspan="8">No records found.</td></tr><?php endif; ?>
</tbody></table>
</div></div>
</section></div>
