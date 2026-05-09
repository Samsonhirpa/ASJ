<div class="content-wrapper"><section class="content-header"><h1>Assign Associate Editor</h1></section>
<section class="content"><div class="box box-primary"><div class="box-body">
<p><strong>Manuscript:</strong> <?= html_escape($manuscript->manuscriptNumber) ?> - <?= html_escape($manuscript->title) ?></p>
<p><strong>Thematic Area:</strong> <?= html_escape($manuscript->thematicArea ?: 'Not provided') ?></p>
<form method="post">
<div class="form-group">
<label>Available Associate Editors (matched by expertise)</label>
<select name="associateEditorId" class="form-control" required>
<option value="">Select Associate Editor</option>
<?php foreach($associateEditors as $ae): ?>
<option value="<?= (int)$ae->userId ?>"><?= html_escape($ae->name) ?> (<?= html_escape($ae->expertise_area ?: 'No expertise listed') ?>)</option>
<?php endforeach; ?>
</select></div>
<button class="btn btn-success" type="submit">Assign</button>
<a href="<?= base_url('editor/me-results') ?>" class="btn btn-default">Back</a>
</form>
</div></div></section></div>
