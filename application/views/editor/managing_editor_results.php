<div class="content-wrapper">
    <section class="content-header">
        <h1>Managing Editor Results <small>EIC action queue</small></h1>
    </section>
    <section class="content">
        <div class="box box-info">
            <div class="box-header with-border"><h3 class="box-title">Technical screening results</h3></div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Manuscript</th>
                        <th>Managing Editor</th>
                        <th>Scores</th>
                        <th>Recommendation</th>
                        <th>Comments</th>
                        <th>EIC Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($results)): ?>
                        <tr><td colspan="6" class="text-center">No Managing Editor results registered yet.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($results as $r): ?>
                        <tr>
                            <td>
                                <strong><?= html_escape($r->manuscriptNumber) ?></strong><br>
                                <?= html_escape($r->title) ?><br>
                                <small>Stage: <?= html_escape($r->workflowStage) ?></small>
                            </td>
                            <td><?= html_escape($r->managingEditorName) ?></td>
                            <td>
                                Formatting: <?= number_format($r->formattingScore, 2) ?>/25<br>
                                Completeness: <?= number_format($r->completenessScore, 2) ?>/25<br>
                                Quality: <?= number_format($r->qualityScore, 2) ?>/25<br>
                                Template: <?= number_format($r->templateScore, 2) ?>/25<br>
                                <strong>Total: <?= number_format($r->totalScore, 2) ?>/100</strong>
                            </td>
                            <td><span class="label label-default"><?= html_escape(ucfirst($r->recommendation)) ?></span></td>
                            <td>
                                <?= nl2br(html_escape($r->comments)) ?>
                                <?php if (!empty($r->resultFile)): ?><br><a href="<?= base_url($r->resultFile) ?>" target="_blank">View upload</a><?php endif; ?>
                            </td>
                            <td style="min-width:260px;">
                                <?php if ($r->workflowStage === 'eic_managing_result_decision'): ?>
                                    <form method="post" action="<?= base_url('editor/managing-editor-results/action/'.$r->manuscriptId) ?>">
                                        <select name="decision" class="form-control result-decision" required>
                                            <option value="accept">Accept → assign Associate Editor</option>
                                            <option value="revision">Revision → author</option>
                                            <option value="reject">Reject → end</option>
                                        </select>
                                        <select name="associateEditorId" class="form-control associate-editor-select" style="margin-top:8px;">
                                            <option value="">Select Associate Editor</option>
                                            <?php foreach ($associateEditors as $ae): ?>
                                                <option value="<?= (int)$ae->userId ?>"><?= html_escape($ae->name) ?><?= $ae->department ? ' - '.html_escape($ae->department) : '' ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <textarea name="reason" class="form-control" rows="3" style="margin-top:8px;" placeholder="EIC reason / instruction" required></textarea>
                                        <button class="btn btn-info" style="margin-top:8px;">Save Action</button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted">Action already processed.</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
