<div class="content-wrapper">
    <section class="content-header">
        <h1>Assign Associate Editor <small>Match manuscript with expertise</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-user-plus"></i> Assignment Form</h3>
                    </div>
                    <form method="post">
                        <div class="box-body">
                            <div class="alert alert-info">
                                <strong>Manuscript:</strong> <?= html_escape($manuscript->manuscriptNumber) ?> — <?= html_escape($manuscript->title) ?><br>
                                <strong>Thematic Area:</strong> <?= html_escape($manuscript->thematicArea ?: 'Not provided') ?>
                            </div>
                            <div class="form-group">
                                <label>Select Associate Editor</label>
                                <select name="associateEditorId" class="form-control" required>
                                    <option value="">Choose from registered Associate Editors</option>
                                    <?php foreach($associateEditors as $ae): ?>
                                        <option value="<?= (int)$ae->userId ?>"><?= html_escape($ae->name) ?> <small>- <?= html_escape($ae->expertise_area ?: 'No expertise listed') ?></small></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success" type="submit"><i class="fa fa-check-circle"></i> Assign Editor</button>
                            <a href="<?= base_url('editor/me-results') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
