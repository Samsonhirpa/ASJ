<div class="content-wrapper"><section class="content-header"><h1>Assign Reviewers: <?= html_escape($manuscript->manuscriptNumber) ?></h1></section>
<section class="content">
<?php
    $totalAssigned = !empty($assignedReviewers) ? count($assignedReviewers) : 0;
    $acceptedAssigned = 0;
    if (!empty($assignedReviewers)) {
        foreach ($assignedReviewers as $assignedReviewer) {
            if (in_array($assignedReviewer->status, ['accepted', 'completed'], true)) {
                $acceptedAssigned++;
            }
        }
    }
?>
<div class="box box-success"><div class="box-header with-border"><h3 class="box-title">Assigned Reviewers <small>(Accepted: <?= $acceptedAssigned ?>/<?= $totalAssigned ?>)</small></h3></div><div class="box-body table-responsive">
<table class="table table-bordered"><thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Institution</th><th>Department</th><th>Expertise</th><th>Status</th></tr></thead><tbody>
<?php if(!empty($assignedReviewers)): foreach($assignedReviewers as $r): ?>
<tr><td><?= html_escape($r->name) ?></td><td><?= html_escape($r->email) ?></td><td><?= html_escape($r->mobile ?: '-') ?></td><td><?= html_escape($r->institution ?: '-') ?></td><td><?= html_escape($r->department ?: '-') ?></td><td><?= html_escape($r->expertise_area ?: '-') ?></td><td><?= html_escape($r->status) ?></td></tr>
<?php endforeach; else: ?><tr><td colspan="7" class="text-center">No reviewers assigned yet.</td></tr><?php endif; ?>
</tbody></table>
</div></div>

<div class="box box-primary"><div class="box-header with-border"><h3 class="box-title">Available Registered Reviewers</h3></div><div class="box-body table-responsive">
<table class="table table-striped table-bordered"><thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Institution</th><th>Department</th><th>Areas of Expertise</th><th>Action</th></tr></thead><tbody>
<?php if(!empty($reviewers)): foreach($reviewers as $r): ?>
<?php $isAlreadyAssigned = !empty($r->assignmentId); ?>
<tr><td><?= html_escape($r->name) ?></td><td><?= html_escape($r->email) ?></td><td><?= html_escape($r->mobile ?: '-') ?></td><td><?= html_escape($r->institution ?: '-') ?></td><td><?= html_escape($r->department ?: '-') ?></td><td><?= html_escape($r->expertise_area ?: '-') ?></td><td>
<?php if($isAlreadyAssigned): ?>
    <span class="label label-info">Assigned<?= !empty($r->assignmentStatus) ? ' ('.html_escape($r->assignmentStatus).')' : '' ?></span>
<?php else: ?>
    <a class="btn btn-xs btn-success" href="<?= base_url('editor/ae-assign-reviewers/'.$manuscript->manuscriptId.'/assign/'.$r->userId) ?>">Assign</a>
<?php endif; ?>
</td></tr>
<?php endforeach; else: ?><tr><td colspan="7" class="text-center">No reviewers found.</td></tr><?php endif; ?>
</tbody></table>
</div></div>
<a href="<?= base_url('editor/ae-assign-reviewers') ?>" class="btn btn-default">Back</a>
</section></div>
