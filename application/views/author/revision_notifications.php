<div class="content-wrapper" style="background:#f4f6f9;">
    <section class="content-header">
        <h1>Author Revision Notifications <small>Reviewer comments and revision upload</small></h1>
    </section>
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bell"></i> Revision Required Manuscripts</h3>
            </div>
            <div class="box-body">
                <?php if (!empty($manuscripts)): ?>
                    <?php foreach ($manuscripts as $item): ?>
                        <div class="panel panel-default" style="margin-bottom:18px;">
                            <div class="panel-heading">
                                <strong><?= html_escape($item->manuscriptNumber) ?></strong> - <?= html_escape($item->title) ?>
                                <span class="label label-warning pull-right">Revision Required</span>
                            </div>
                            <div class="panel-body">
                                <h4>Reviewer Comments</h4>
                                <pre style="white-space:pre-wrap;background:#f8f9fb;border:1px solid #eee;"><?= html_escape($item->reviewerComments ?: 'No public reviewer comments found.') ?></pre>

                                <form method="post" action="<?= base_url('author/manuscript/resubmit-revision/' . (int)$item->manuscriptId) ?>" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Author Response to Reviewers (optional)</label>
                                        <textarea class="form-control" name="authorRevisionResponse" rows="3" placeholder="Summarize what you changed."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Upload Revised Main Manuscript</label>
                                        <input type="file" class="form-control" name="revised_main_file" required>
                                    </div>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Re-submit Revision</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">No revision requests at this time.</div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>
