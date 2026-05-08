<div class="content-wrapper">
    <section class="content-header">
        <h1>Managing Editor Screening <small>Author guidelines compliance</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Manuscript Details</h3>
                        <div class="box-tools"><a class="btn btn-sm btn-default" href="<?= base_url('managing-editor/pending') ?>"><i class="fa fa-arrow-left"></i> Back to Pending</a></div>
                    </div>
                    <div class="box-body">
                        <h3 style="margin-top:0;"><?= html_escape($manuscript->title) ?></h3>
                        <dl class="dl-horizontal">
                            <dt>Manuscript #</dt><dd><?= html_escape($manuscript->manuscriptNumber) ?></dd>
                            <dt>Author</dt><dd><?= html_escape($manuscript->authorName) ?> (<?= html_escape($manuscript->authorEmail) ?>)</dd>
                            <dt>Article Type</dt><dd><?= html_escape(ucwords(str_replace('_', ' ', $manuscript->articleType))) ?></dd>
                            <dt>Thematic Area</dt><dd><?= html_escape($manuscript->thematicArea ?: 'Not provided') ?></dd>
                            <dt>Word Count</dt><dd><?= $manuscript->wordCount ? (int)$manuscript->wordCount : 'Not provided' ?></dd>
                            <dt>EIC Decision</dt><dd><span class="label label-success">Accepted by EIC</span></dd>
                            <dt>ME Status</dt><dd><span class="label label-<?= !empty($manuscript->managingEditorScreeningStatus) && $manuscript->managingEditorScreeningStatus === 'failed' ? 'danger' : 'default' ?>"><?= html_escape($manuscript->managingEditorScreeningStatus ?: 'pending') ?></span></dd>
                        </dl>

                        <h4>Abstract</h4>
                        <p style="white-space:pre-line;"><?= html_escape($manuscript->abstract ?: 'No abstract provided.') ?></p>

                        <h4>Author Guidelines Checklist</h4>
                        <div class="callout callout-info">
                            <p>Score each category from 0 to 25. The total is calculated out of 100%: formatting (25%), completeness (25%), quality (25%), and template check (25%).</p>
                            <p><a href="<?= base_url('journal/author-guidelines') ?>" target="_blank"><i class="fa fa-external-link"></i> Open Author Guidelines</a></p>
                        </div>
                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-header with-border"><h3 class="box-title">Uploaded Manuscript Files</h3></div>
                    <div class="box-body table-responsive">
                        <table class="table table-striped">
                            <thead><tr><th>Type</th><th>File</th><th>Size</th><th></th></tr></thead>
                            <tbody>
                            <?php if (!empty($files)): foreach ($files as $file): ?>
                                <tr>
                                    <td><?= html_escape(ucwords(str_replace('_', ' ', $file->fileType))) ?></td>
                                    <td><?= html_escape($file->fileName) ?></td>
                                    <td><?= number_format(((int)$file->fileSize) / 1024, 1) ?> KB</td>
                                    <td><a class="btn btn-xs btn-default" href="<?= base_url($file->filePath) ?>" target="_blank"><i class="fa fa-download"></i> Open</a></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="4" class="text-center text-muted">No files uploaded for this manuscript.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-warning">
                    <div class="box-header with-border"><h3 class="box-title">Register Screening Result</h3></div>
                    <form method="post" enctype="multipart/form-data" action="<?= base_url('managing-editor/pending/save/'.$manuscript->manuscriptId) ?>">
                        <div class="box-body">
                            <?php $existing = $screening ?: (object)['formattingScore' => '', 'completenessScore' => '', 'qualityScore' => '', 'templateScore' => '', 'comments' => '', 'resultFilePath' => '']; ?>
                            <div class="form-group"><label>Formatting (25%)</label><input type="number" min="0" max="25" name="formattingScore" class="form-control me-score" required value="<?= html_escape($existing->formattingScore) ?>"></div>
                            <div class="form-group"><label>Completeness (25%)</label><input type="number" min="0" max="25" name="completenessScore" class="form-control me-score" required value="<?= html_escape($existing->completenessScore) ?>"></div>
                            <div class="form-group"><label>Quality (25%)</label><input type="number" min="0" max="25" name="qualityScore" class="form-control me-score" required value="<?= html_escape($existing->qualityScore) ?>"></div>
                            <div class="form-group"><label>Template Check (25%)</label><input type="number" min="0" max="25" name="templateScore" class="form-control me-score" required value="<?= html_escape($existing->templateScore) ?>"></div>
                            <div class="alert alert-info"><strong>Total:</strong> <span id="meTotal"><?= !empty($screening) ? (int)$screening->totalScore : 0 ?></span>/100</div>
                            <div class="form-group"><label>Comments</label><textarea name="comments" rows="5" class="form-control" required placeholder="Record guideline findings, corrections needed, or readiness for the next workflow step."><?= html_escape($existing->comments) ?></textarea></div>
                            <div class="form-group"><label>Upload Result Comment <small>(optional)</small></label><input type="file" name="resultComment" class="form-control"><p class="help-block">Allowed: PDF, Word, text, JPG, PNG. Max 5 MB.</p>
                                <?php if (!empty($existing->resultFilePath)): ?><a href="<?= base_url($existing->resultFilePath) ?>" target="_blank"><i class="fa fa-paperclip"></i> View current result file</a><?php endif; ?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Register this Managing Editor screening result?');"><i class="fa fa-save"></i> Register Result</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
(function () {
    function updateTotal() {
        var total = 0;
        var inputs = document.querySelectorAll('.me-score');
        for (var i = 0; i < inputs.length; i++) {
            total += parseInt(inputs[i].value || 0, 10);
        }
        document.getElementById('meTotal').innerHTML = total;
    }
    var inputs = document.querySelectorAll('.me-score');
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].addEventListener('input', updateTotal);
    }
    updateTotal();
})();
</script>
