<div class="content-wrapper">
    <section class="content-header"><h1>Final Editorial Decision</h1></section>
    <section class="content">
        <div class="box">
            <div class="box-header"><h3 class="box-title">Accepted manuscripts from Associate Editor (First Editorial Decision)</h3></div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Manuscript #</th><th>Title</th><th>Author</th><th>Associate Editor</th><th>First Decision Date</th><th>Status</th><th>Final EiC Decision</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($manuscripts)): ?>
                        <tr><td colspan="7" class="text-center">No accepted first-decision manuscripts found.</td></tr>
                    <?php else: foreach ($manuscripts as $m): ?>
                        <tr>
                            <td><?= html_escape($m->manuscriptNumber) ?></td>
                            <td><?= html_escape($m->title) ?></td>
                            <td><?= html_escape($m->authorName ?: '-') ?></td>
                            <td><?= html_escape($m->associateEditorName ?: '-') ?></td>
                            <td><?= !empty($m->firstEditorialDecisionDtm) ? date('Y-m-d H:i', strtotime($m->firstEditorialDecisionDtm)) : '-' ?></td>
                            <td><span class="label label-info"><?= html_escape($m->status) ?></span></td>
                            <td>
                                <form method="post" action="<?= base_url('editor/final-decisions/apply/' . (int)$m->manuscriptId) ?>" style="display:inline-block; margin-right:5px;">
                                    <input type="hidden" name="decision" value="approved">
                                    <button type="submit" class="btn btn-success btn-xs" onclick="return confirm('Accept manuscript and move to Production Stage?')">Approve</button>
                                </form>
                                <form method="post" action="<?= base_url('editor/final-decisions/apply/' . (int)$m->manuscriptId) ?>" style="display:inline-block;">
                                    <input type="hidden" name="decision" value="rejected">
                                    <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Reject manuscript and end workflow?')">Reject</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
