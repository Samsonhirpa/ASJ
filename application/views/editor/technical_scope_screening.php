<div class="content-wrapper">
    <section class="content-header">
        <h1>Technical and Scope Screening <small><?= html_escape($manuscript->manuscriptNumber) ?></small></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Manuscript</h3>
                        <div class="box-tools pull-right">
                            <a href="<?= base_url('editor/pending') ?>" class="btn btn-box-tool"><i class="fa fa-arrow-left"></i> Back to Pending</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <h3 style="margin-top:0;"><?= html_escape($manuscript->title) ?></h3>
                        <dl class="dl-horizontal">
                            <dt>Manuscript #</dt>
                            <dd><?= html_escape($manuscript->manuscriptNumber) ?></dd>
                            <dt>Author</dt>
                            <dd><?= html_escape($manuscript->authorName ?: '-') ?><?= !empty($manuscript->authorEmail) ? ' (' . html_escape($manuscript->authorEmail) . ')' : '' ?></dd>
                            <dt>Article Type</dt>
                            <dd><?= html_escape(ucwords(str_replace('_', ' ', $manuscript->articleType))) ?></dd>
                            <dt>Thematic Area</dt>
                            <dd><?= html_escape($manuscript->thematicArea ?: 'Not provided') ?></dd>
                            <dt>Word Count</dt>
                            <dd><?= $manuscript->wordCount ? (int)$manuscript->wordCount : 'Not provided' ?></dd>
                            <dt>Submitted</dt>
                            <dd><?= date('d M Y H:i', strtotime($manuscript->createdDtm)) ?></dd>
                            <dt>Status</dt>
                            <dd><span class="label label-info"><?= html_escape($manuscript->status) ?></span></dd>
                            <dt>EIC Screening</dt>
                            <dd><span class="label label-default"><?= html_escape($manuscript->eicScreeningDecision ?: 'pending') ?></span></dd>
                        </dl>

                        <h4>Abstract</h4>
                        <p style="white-space:pre-line;"><?= html_escape($manuscript->abstract ?: 'No abstract provided.') ?></p>

                        <h4>Keywords</h4>
                        <p><?= html_escape($manuscript->keywords ?: 'No keywords provided.') ?></p>

                        <h4>Cover Letter</h4>
                        <p style="white-space:pre-line;"><?= html_escape($manuscript->coverLetter ?: 'No cover letter provided.') ?></p>
                    </div>
                </div>

                <div class="box box-default">
                    <div class="box-header with-border"><h3 class="box-title">Uploaded Files</h3></div>
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
                    <div class="box-header with-border"><h3 class="box-title">EIC Screening Form</h3></div>
                    <form method="post" action="<?= base_url('editor/technical-scope-screening/'.$manuscript->manuscriptId) ?>">
                        <div class="box-body">
                            <div class="callout callout-info">
                                <p>Use this form to complete the Editor-in-Chief technical and journal-scope screening before reviewer assignment.</p>
                            </div>

                            <div class="form-group">
                                <label for="technicalNotes">Technical Screening Notes</label>
                                <textarea id="technicalNotes" name="technicalNotes" class="form-control" rows="6" required placeholder="Formatting, completeness, file quality, metadata, ethics declarations, and submission requirements."><?= html_escape($manuscript->technicalScreeningNotes ?: '') ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="scopeNotes">Scope Screening Notes</label>
                                <textarea id="scopeNotes" name="scopeNotes" class="form-control" rows="6" required placeholder="Fit with journal aims/scope, article type, thematic area, originality, and audience relevance."><?= html_escape($manuscript->scopeScreeningNotes ?: '') ?></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="decision" value="accept" class="btn btn-success" onclick="return confirm('Accept this manuscript at technical and scope screening?');">
                                <i class="fa fa-check"></i> Accept Manuscript
                            </button>
                            <button type="submit" name="decision" value="reject" class="btn btn-danger pull-right" onclick="return confirm('Reject this manuscript at technical and scope screening?');">
                                <i class="fa fa-times"></i> Reject Manuscript
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
