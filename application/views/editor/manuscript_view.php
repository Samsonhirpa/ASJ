<div class="content-wrapper">
    <section class="content-header">
        <h1>Editorial Workflow <small><?= html_escape($manuscript->manuscriptNumber) ?></small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border"><h3 class="box-title"><?= html_escape($manuscript->title) ?></h3></div>
                    <div class="box-body">
                        <p><strong>Author:</strong> <?= html_escape($manuscript->authorName) ?> (<?= html_escape($manuscript->authorEmail) ?>)</p>
                        <p><strong>Status:</strong> <?= html_escape($manuscript->status) ?> | <strong>Screening:</strong> <?= html_escape($manuscript->screeningStatus ?: 'pending') ?> | <strong>Plagiarism:</strong> <?= $manuscript->plagiarismScore !== null ? number_format($manuscript->plagiarismScore, 2).'%' : 'N/A' ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header with-border"><h3 class="box-title">1) Initial Screening</h3></div>
                    <form method="post" action="<?= base_url('editor/screening/'.$manuscript->manuscriptId) ?>">
                        <div class="box-body">
                            <select name="screeningStatus" class="form-control" required>
                                <option value="pending">Pending</option><option value="passed">Passed</option><option value="failed">Failed</option>
                            </select>
                            <textarea name="screeningNotes" class="form-control" rows="4" style="margin-top:10px" placeholder="Screening notes" required><?= html_escape($manuscript->screeningNotes) ?></textarea>
                        </div>
                        <div class="box-footer"><button class="btn btn-info">Save Screening</button></div>
                    </form>
                </div>
                <div class="box box-warning">
                    <div class="box-header with-border"><h3 class="box-title">2) Plagiarism Check Integration</h3></div>
                    <form method="post" action="<?= base_url('editor/plagiarism/'.$manuscript->manuscriptId) ?>">
                        <div class="box-body"><input type="number" min="0" max="100" step="0.01" name="plagiarismScore" class="form-control" placeholder="Score %" required></div>
                        <div class="box-footer"><button class="btn btn-warning">Update Score</button></div>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header with-border"><h3 class="box-title">3) Assign Reviewers (2-3)</h3></div>
                    <form method="post" action="<?= base_url('editor/assign-reviewers/'.$manuscript->manuscriptId) ?>">
                        <div class="box-body">
                            <select name="reviewerIds[]" class="form-control" multiple required style="height:160px;">
                                <?php foreach ($reviewers as $r): ?>
                                    <option value="<?= (int)$r->userId ?>"><?= html_escape($r->name) ?> (<?= html_escape($r->email) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                            <input type="date" name="reviewDueDate" class="form-control" style="margin-top:10px" required>
                        </div>
                        <div class="box-footer"><button class="btn btn-success">Assign</button></div>
                    </form>
                </div>

                <div class="box box-default">
                    <div class="box-header with-border"><h3 class="box-title">4) Track Review Progress</h3></div>
                    <div class="box-body">
                        <p>Track reviewer status, recommendations, and editor approval from the dedicated progress page.</p>
                        <a class="btn btn-default" href="<?= base_url('editor/assignments') ?>">
                            <i class="fa fa-line-chart"></i> Open Track Review Progress
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-danger">
                    <div class="box-header with-border"><h3 class="box-title">5-8) Editorial Decision & Letters</h3></div>
                    <form method="post" action="<?= base_url('editor/decision/'.$manuscript->manuscriptId) ?>">
                        <div class="box-body">
                            <select name="decision" class="form-control" required>
                                <option value="revision">Request Revision</option>
                                <option value="accept">Final Acceptance</option>
                                <option value="reject">Final Rejection</option>
                            </select>
                            <textarea name="decisionLetter" class="form-control" rows="8" style="margin-top:10px" placeholder="Decision letter to author" required></textarea>
                            <p class="help-block">This action sends decision letters and supports revision requests/final decisions.</p>
                        </div>
                        <div class="box-footer"><button class="btn btn-danger">Send Decision</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
