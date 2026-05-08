<div class="content-wrapper">
    <section class="content-header">
        <h1>Managing Editor Screening <small><?= html_escape($manuscript->manuscriptNumber) ?></small></h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= html_escape($manuscript->title) ?></h3>
            </div>
            <div class="box-body">
                <p><strong>Author:</strong> <?= html_escape($manuscript->authorName) ?> (<?= html_escape($manuscript->authorEmail) ?>)</p>
                <p><strong>EIC Screening Notes:</strong><br><?= nl2br(html_escape($manuscript->eicScopeNotes)) ?></p>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Register Technical Screening Result</h3>
            </div>
            <form method="post" enctype="multipart/form-data" action="<?= base_url('editor/managing-editor/save/'.$manuscript->manuscriptId) ?>">
                <div class="box-body">
                    <p class="help-block">Check formatting, completeness, quality, and template compliance using Author Guidelines. Each criterion is scored out of 25%.</p>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Formatting (25%)</label>
                            <input type="number" min="0" max="25" step="0.01" name="formattingScore" class="form-control" required>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Completeness (25%)</label>
                            <input type="number" min="0" max="25" step="0.01" name="completenessScore" class="form-control" required>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Quality (25%)</label>
                            <input type="number" min="0" max="25" step="0.01" name="qualityScore" class="form-control" required>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Template Check (25%)</label>
                            <input type="number" min="0" max="25" step="0.01" name="templateScore" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Recommendation</label>
                        <select name="recommendation" class="form-control" required>
                            <option value="accept">Accept</option>
                            <option value="revision">Revision</option>
                            <option value="reject">Reject</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Comments</label>
                        <textarea name="comments" class="form-control" rows="5" placeholder="Optional comments"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload Result Comment (optional)</label>
                        <input type="file" name="resultFile" class="form-control">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Register Result</button>
                    <a href="<?= base_url('editor/managing-editor') ?>" class="btn btn-default">Back to Pending Manuscripts</a>
                </div>
            </form>
        </div>
    </section>
</div>
