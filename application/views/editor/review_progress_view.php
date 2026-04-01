<div class="content-wrapper">
    <section class="content-header">
        <h1>Review Progress Details <small><?= html_escape($manuscript->manuscriptNumber) ?></small></h1>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><?= html_escape($manuscript->title) ?></h3>
            </div>
            <div class="box-body">
                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $idx => $review): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>Reviewer <?= (int)$idx + 1 ?>:</strong> <?= html_escape($review->reviewerName) ?>
                                <span class="pull-right">
                                    Status: <strong><?= html_escape($review->status) ?></strong>
                                </span>
                            </div>
                            <div class="panel-body">
                                <p><strong>Recommendation:</strong> <?= html_escape($review->recommendationDecision ?: 'pending') ?></p>
                                <p><strong>Comments to Author:</strong><br><?= nl2br(html_escape($review->commentsToAuthor ?: '-')) ?></p>
                                <p><strong>Comments to Editor:</strong><br><?= nl2br(html_escape($review->commentsToEditor ?: '-')) ?></p>
                                <p>
                                    <strong>Reviewer Attachment:</strong>
                                    <?php if (!empty($review->reviewFilePath)): ?>
                                        <a href="<?= base_url($review->reviewFilePath) ?>" target="_blank">View/Download File</a>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </p>
                                <p><strong>Editor Approval:</strong> <?= html_escape($review->editorReviewApprovalStatus ?: 'pending') ?></p>
                                <p><strong>Due Date:</strong> <?= !empty($review->reviewDueDate) ? html_escape(date('d M Y', strtotime($review->reviewDueDate))) : '-' ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">No reviewer comments are available yet.</div>
                <?php endif; ?>

                <hr>
                <h4>Reviewer Result Actions</h4>
                <form method="post" action="<?= base_url('editor/assignments/approve/' . (int)$manuscript->manuscriptId) ?>" style="margin-bottom:15px;">
                    <div class="form-group">
                        <label>Approval Note</label>
                        <textarea name="approvalNote" class="form-control" rows="3" required placeholder="Write short note before approving reviewer comments."></textarea>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit">Approve Reviewer Comment</button>
                    </div>
                </form>

                <form method="post" action="<?= base_url('editor/assignments/rereview/' . (int)$manuscript->manuscriptId) ?>">
                    <div class="form-group">
                        <label>Why to Review Again</label>
                        <textarea name="rereviewReason" class="form-control" rows="3" required placeholder="Explain why this manuscript should be re-reviewed."></textarea>
                    </div>
                    <button class="btn btn-warning" type="submit">Re-Review</button>
                    <a href="<?= base_url('editor/assignments') ?>" class="btn btn-default">Back</a>
                </form>
            </div>
        </div>
    </section>
</div>
