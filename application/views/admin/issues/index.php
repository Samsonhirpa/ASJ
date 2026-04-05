<div class="content-wrapper">
    <section class="content-header">
        <h1>Journal Issues</h1>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Manage Issues</h3>
                <div class="box-tools pull-right">
                    <a href="<?= base_url('admin/issues/create') ?>" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> New Issue
                    </a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Volume</th>
                            <th>Issue</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Published Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($issues)): foreach ($issues as $issue): ?>
                            <tr>
                                <td><?= (int)$issue->issueId ?></td>
                                <td><?= (int)$issue->volume ?></td>
                                <td><?= (int)$issue->issueNumber ?></td>
                                <td><?= (int)$issue->year ?></td>
                                <td><?= html_escape($issue->month ?: '-') ?></td>
                                <td><?= html_escape($issue->title ?: '-') ?></td>
                                <td>
                                    <span class="label label-<?= $issue->status === 'published' ? 'success' : 'default' ?>">
                                        <?= html_escape(ucfirst($issue->status)) ?>
                                    </span>
                                </td>
                                <td><?= !empty($issue->publishedDate) ? html_escape($issue->publishedDate) : '-' ?></td>
                                <td>
                                    <a href="<?= base_url('admin/issues/edit/' . (int)$issue->issueId) ?>" class="btn btn-xs btn-info">Edit</a>
                                    <?php if ($issue->status !== 'published'): ?>
                                        <a href="<?= base_url('admin/issues/publish/' . (int)$issue->issueId) ?>" class="btn btn-xs btn-success" onclick="return confirm('Publish this issue now?');">Publish</a>
                                    <?php endif; ?>
                                    <a href="<?= base_url('admin/issues/delete/' . (int)$issue->issueId) ?>" class="btn btn-xs btn-danger" onclick="return confirm('Delete this issue?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted">No journal issues found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
