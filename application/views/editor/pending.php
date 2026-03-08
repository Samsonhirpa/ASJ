<div class="content-wrapper">
    <section class="content-header"><h1>Pending Manuscripts</h1></section>
    <section class="content">
        <div class="box box-warning">
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <thead><tr><th>#</th><th>Title</th><th>Status</th><th>Submitted</th><th></th></tr></thead>
                    <tbody>
                    <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                        <tr>
                            <td><?= html_escape($m->manuscriptNumber) ?></td>
                            <td><?= html_escape($m->title) ?></td>
                            <td><?= html_escape($m->status) ?></td>
                            <td><?= date('d M Y', strtotime($m->createdDtm)) ?></td>
                            <td><a class="btn btn-xs btn-primary" href="<?= base_url('editor/manuscript/'.$m->manuscriptId) ?>">Screen</a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center">No pending manuscripts.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
