<div class="content-wrapper">
    <section class="content-header">
        <h1>Pending Manuscripts <small>Managing Editor</small></h1>
    </section>
    <section class="content">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Manuscripts accepted by Editor-in-Chief</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Submitted</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                        <tr>
                            <td><?= html_escape($m->manuscriptNumber) ?></td>
                            <td><?= html_escape($m->title) ?></td>
                            <td><?= html_escape($m->authorName) ?></td>
                            <td><?= date('d M Y', strtotime($m->createdDtm)) ?></td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="<?= base_url('editor/managing-editor/screen/'.$m->manuscriptId) ?>">Screen</a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center">No pending manuscripts accepted by Editor-in-Chief.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
