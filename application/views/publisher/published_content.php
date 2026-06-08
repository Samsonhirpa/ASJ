<div class="content-wrapper">
    <section class="content-header">
        <h1>Published Manuscripts</h1>
    </section>

    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Manuscripts published through the new workflow</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Manuscript Number</th>
                            <th>Title</th>
                            <th>Thematic Area</th>
                            <th>Date Published</th>
                            <th>Public Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                        <tr>
                            <td><?= html_escape($m->manuscriptNumber) ?></td>
                            <td><?= html_escape($m->title) ?></td>
                            <td><?= !empty($m->thematicArea) ? html_escape(ucwords(str_replace('_', ' ', $m->thematicArea))) : '-' ?></td>
                            <td><?= !empty($m->publishedDate) ? date('Y-m-d', strtotime($m->publishedDate)) : '-' ?></td>
                            <td>
                                <?php if ((int)($m->isHidden ?? 0) === 1): ?>
                                    <span class="label label-default">Hidden from public</span>
                                <?php else: ?>
                                    <span class="label label-success">Visible</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('journal/article/' . (int)$m->articleId) ?>" target="_blank" class="btn btn-xs btn-success">View Public</a>
                                <form method="post" action="<?= base_url('publisher/published-manuscripts/toggle/' . (int)$m->manuscriptId) ?>" style="display:inline-block;">
                                    <?php if ((int)($m->isHidden ?? 0) === 1): ?>
                                        <button type="submit" class="btn btn-xs btn-primary">Unhide</button>
                                    <?php else: ?>
                                        <button type="submit" class="btn btn-xs btn-warning">Hide</button>
                                    <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center text-muted">No published manuscripts available.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
