<div class="content-wrapper">
<section class="content-header"><h1>Screened Manuscripts</h1></section>
<section class="content">
<div class="box box-default"><div class="box-body">
<form method="get" class="form-inline" action="<?= base_url('managing-editor/screened') ?>">
<label style="margin-right:8px;">Filter</label>
<select name="status" class="form-control">
<?php foreach (['all' => 'All', 'approved' => 'Approved', 'rejected' => 'Rejected'] as $value => $label): ?>
<option value="<?= $value ?>" <?= (($filters['status'] ?? 'all') === $value) ? 'selected' : '' ?>><?= $label ?></option>
<?php endforeach; ?>
</select>
<button class="btn btn-primary" style="margin-left:8px;">Apply</button>
</form>
</div></div>
<div class="box box-success"><div class="box-body table-responsive">
<table class="table table-striped"><thead><tr><th>#</th><th>Title</th><th>Result</th><th>Date</th></tr></thead><tbody>
<?php if(!empty($manuscripts)): foreach($manuscripts as $m): ?>
<tr><td><?= html_escape($m->manuscriptNumber) ?></td><td><?= html_escape($m->title) ?></td><td><span class="label label-<?= $m->meResultStatus==='passed'?'success':'danger' ?>"><?= html_escape($m->meResultStatus==='passed' ? 'approved' : 'rejected') ?></span></td><td><?= !empty($m->screenedDtm)?date('d M Y',strtotime($m->screenedDtm)):'-' ?></td></tr>
<?php endforeach; else: ?><tr><td colspan="4">No screened manuscripts.</td></tr><?php endif; ?>
</tbody></table></div></div></section></div>
