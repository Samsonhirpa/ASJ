<div class="content-wrapper">
    <section class="content-header">
        <h1>Track Review Progress</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reviewer Assignment Status</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Manuscript</th>
                                    <th>Reviewers</th>
                                    <th>Status</th>
                                    <th>Recommendation</th>
                                    <th>Editor Approval</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($assignments)): foreach ($assignments as $a): ?>
                                <tr>
                                    <td>
                                        <strong><?= html_escape($a->manuscriptNumber) ?></strong><br>
                                        <span class="small text-muted"><?= html_escape($a->manuscriptTitle) ?></span>
                                    </td>
                                    <td>
                                        <?= html_escape($a->reviewerNames ?: '-') ?>
                                    </td>
                                    <td><?= html_escape($a->assignmentStatus ?: '-') ?></td>
                                    <td><?= html_escape($a->recommendation ?: '-') ?></td>
                                    <td><?= html_escape($a->editorApproval ?: 'pending') ?></td>
                                    <td><?= !empty($a->reviewDueDate) ? html_escape(date('d M Y', strtotime($a->reviewDueDate))) : '-' ?></td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="<?= base_url('editor/assignments/view/' . (int)$a->manuscriptId) ?>">Reviewer Result</a>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="7">No reviewer assignments found.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
