<div class="content-wrapper"><section class="content-header"><h1>Assign Reviewers</h1></section>
<section class="content"><div class="box box-default"><div class="box-body table-responsive">
<table class="table table-striped table-bordered">
    <thead><tr><th>Manuscript #</th><th>Title</th><th>Thematic Area</th><th>Keywords</th><th>Action</th></tr></thead>
    <tbody>
    <?php if(!empty($manuscripts)): foreach($manuscripts as $m): ?>
        <tr>
            <td><?= html_escape($m->manuscriptNumber) ?></td>
            <td><?= html_escape($m->title) ?></td>
            <td><?= html_escape($m->thematicArea ?: '-') ?></td>
            <td><?= html_escape($m->keywords ?: '-') ?></td>
            <td><a class="btn btn-xs btn-primary" href="<?= base_url('editor/ae-assign-reviewers/'.$m->manuscriptId) ?>">Assign</a></td>
        </tr>
    <?php endforeach; else: ?>
        <tr><td colspan="5" class="text-center">No accepted manuscripts found.</td></tr>
    <?php endif; ?>
    </tbody>
</table>
</div></div></section></div>
