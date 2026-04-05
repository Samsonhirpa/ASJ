<div class="content-wrapper">
    <section class="content-header">
        <h1>Published Manuscripts</h1>
    </section>

    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Published list with quick actions</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Manuscript #</th>
                            <th>Title</th>
                            <th>Issue</th>
                            <th>DOI</th>
                            <th>Published Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                        <tr>
                            <td><strong><?= html_escape($m->manuscriptNumber) ?></strong></td>
                            <td><?= html_escape($m->title) ?></td>
                            <td>
                                <?php if (!empty($m->volume) && !empty($m->issueNumber)): ?>
                                    Vol <?= (int)$m->volume ?>, Issue <?= (int)$m->issueNumber ?> (<?= (int)$m->year ?>)
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= !empty($m->doi) ? html_escape($m->doi) : '-' ?></td>
                            <td><?= !empty($m->publishedDate) ? date('Y-m-d H:i', strtotime($m->publishedDate)) : '-' ?></td>
                            <td>
                                <a href="<?= base_url('editor/manuscript/' . (int)$m->manuscriptId) ?>" class="btn btn-xs btn-primary">Workflow</a>
                                <a href="<?= base_url('journal/manuscript/' . (int)$m->manuscriptId) ?>" target="_blank" class="btn btn-xs btn-success">Open Public View</a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">No published manuscripts available.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
