<div class="content-wrapper">
    <section class="content-header">
        <h1>Technical and Scope Screening <small><?= html_escape($manuscript->manuscriptNumber) ?></small></h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= html_escape($manuscript->title) ?></h3>
            </div>
            <div class="box-body">
                <p><strong>Author:</strong> <?= html_escape($manuscript->authorName) ?> (<?= html_escape($manuscript->authorEmail) ?>)</p>
                <p><strong>Status:</strong> <?= html_escape($manuscript->status) ?></p>
                <?php if (!empty($manuscript->abstract)): ?>
                    <p><strong>Abstract:</strong><br><?= nl2br(html_escape($manuscript->abstract)) ?></p>
                <?php endif; ?>
                <?php if (!empty($manuscript->keywords)): ?>
                    <p><strong>Keywords:</strong> <?= html_escape($manuscript->keywords) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Technical and Scope Screening</h3>
            </div>
            <form method="post" action="<?= base_url('editor/eic-scope/'.$manuscript->manuscriptId) ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label>Decision</label>
                        <select name="decision" class="form-control" required>
                            <option value="accept">Accept - Proceed to Managing Editor</option>
                            <option value="reject">Reject - End Workflow</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Technical and Scope Screening Notes</label>
                        <textarea name="notes" class="form-control" rows="6" required><?= html_escape($manuscript->eicScopeNotes) ?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save Decision</button>
                    <a href="<?= base_url('editor/pending') ?>" class="btn btn-default">Back to Pending Manuscripts</a>
                </div>
            </form>
        </div>
    </section>
</div>
