<div class="content-wrapper">
<section class="content-header"><h1>ME Result Detail</h1></section>
<section class="content">
<div class="box box-primary">
<div class="box-body">
<h3><?= html_escape($manuscript->manuscriptNumber) ?> - <?= html_escape($manuscript->title) ?></h3>
<hr>
<h4>Manuscript Status Steps</h4>
<ol>
<li><strong>EIC Technical Screening:</strong> <?= !empty($manuscript->technicalScreeningNotes) ? 'Completed' : 'Pending' ?><br><small><?= nl2br(html_escape($manuscript->technicalScreeningNotes ?: 'No technical screening note yet.')) ?></small></li>
<li><strong>EIC Scope Screening:</strong> <?= !empty($manuscript->scopeScreeningNotes) ? 'Completed' : 'Pending' ?><br><small><?= nl2br(html_escape($manuscript->scopeScreeningNotes ?: 'No scope screening note yet.')) ?></small></li>
<li><strong>Managing Editor Screening:</strong> <?= html_escape(ucfirst($manuscript->meResultStatus ?: 'pending')) ?> (<?= (int)$manuscript->totalScore ?>/100)<br><small><?= nl2br(html_escape($manuscript->meComments ?: 'No managing editor comment.')) ?></small></li>
<li><strong>EIC Decision on ME Result:</strong> <?= html_escape(ucfirst($manuscript->eicMeDecision ?: 'pending')) ?></li>
<li><strong>Associate Editor Assignment:</strong>
    <?php if(!empty($manuscript->assignedAssociateEditorName)): ?>
        Assigned to <?= html_escape($manuscript->assignedAssociateEditorName) ?>
    <?php else: ?>
        Not yet assigned
    <?php endif; ?>
</li>
<li><strong>Associate Editor Response:</strong> <?= html_escape(ucfirst($manuscript->aeAssignmentResponse ?: 'pending')) ?></li>
</ol>
</div>
</div>
</section>
</div>
