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
                                <p><strong>Editor Approval:</strong> <?= html_escape($review->editorReviewApprovalStatus ?: 'pending') ?></p>
                                <p><strong>Due Date:</strong> <?= !empty($review->reviewDueDate) ? html_escape(date('d M Y', strtotime($review->reviewDueDate))) : '-' ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">No reviewer comments are available yet.</div>
                <?php endif; ?>

                <hr>
                <h4>Editorial Decision</h4>
                <form method="post" action="<?= base_url('editor/assignments/decision/' . (int)$manuscript->manuscriptId) ?>">
                    <div class="form-group">
                        <label>Decision Note</label>
                        <textarea name="decisionReason" class="form-control" rows="4" required placeholder="Write the note that will be sent to author/reviewers as applicable."></textarea>
                    </div>
                    <div class="form-group">
                        <button name="decision" value="accept" class="btn btn-success" type="submit">Approval</button>
                        <button name="decision" value="reject" class="btn btn-danger" type="submit">Reject</button>
                        <button name="decision" value="rereview" class="btn btn-warning" type="submit">Request Re-Review</button>
                        <button name="decision" value="minor_review" class="btn btn-primary" type="submit">Minor Review</button>
                        <button name="decision" value="major_review" class="btn btn-info" type="submit">Major Review</button>
                        <a href="<?= base_url('editor/assignments') ?>" class="btn btn-default">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
