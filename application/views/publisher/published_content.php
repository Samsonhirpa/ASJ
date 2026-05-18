<div class="content-wrapper">
    <section class="content-header">
        <h1>Manage Published Content</h1>
    </section>

    <section class="content">
        <div class="box box-success">
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
                            <td><?= html_escape($m->manuscriptNumber) ?></td>
                            <td><?= html_escape($m->title) ?></td>
                            <td>Vol <?= (int)$m->volume ?>, Issue <?= (int)$m->issueNumber ?> (<?= (int)$m->year ?>)</td>
                            <td><?= !empty($m->doi) ? html_escape($m->doi) : '-' ?></td>
                            <td><?= !empty($m->publishedDate) ? date('Y-m-d H:i', strtotime($m->publishedDate)) : '-' ?></td>
                            <td>
                                <a href="<?= base_url('journal/manuscript/' . (int)$m->manuscriptId) ?>" target="_blank" class="btn btn-xs btn-success">View Public</a>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center text-muted">No published content available.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
