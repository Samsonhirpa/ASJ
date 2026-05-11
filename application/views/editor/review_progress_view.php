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
                                    <strong>Uploaded File:</strong>
                                    <?php if (!empty($review->reviewFilePath)): ?>
                                        <a href="<?= base_url($review->reviewFilePath) ?>" target="_blank">View attachment</a>
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
                <h4>First Editorial Decision</h4>
                <div class="alert alert-info">
                    After reviewer comments are submitted, the Associate Editor can submit a first editorial decision.
                </div>
                <form method="post" action="<?= base_url('editor/assignments/decision/' . (int)$manuscript->manuscriptId) ?>" id="reviewerResultActionForm">
                    <div class="form-group">
                        <label>Decision note</label>
                        <textarea name="approvalReason" id="approvalReason" class="form-control" rows="3" placeholder="Add concise rationale for the first editorial decision." required></textarea>
                    </div>
                    <div class="form-group">
                        <button name="decision" value="approve" class="btn btn-success" type="submit">Approve</button>
                        <button name="decision" value="rereview" class="btn btn-warning" type="submit">Re-review</button>
                        <a href="<?= base_url('editor/assignments') ?>" class="btn btn-default">Back</a>
                    </div>
                    <div class="form-group" id="rereviewReasonGroup" style="display:none;">
                        <label>Reason for re-review</label>
                        <textarea name="rereviewReason" id="rereviewReason" class="form-control" rows="3" placeholder="Explain why reviewers should review this manuscript again."></textarea>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    (function() {
        var form = document.getElementById('reviewerResultActionForm');
        var reReviewGroup = document.getElementById('rereviewReasonGroup');
        var reReviewReason = document.getElementById('rereviewReason');
        form.querySelectorAll('button[name="decision"]').forEach(function(btn) {
            btn.addEventListener('click', function(event) {
                if (btn.value === 'rereview') {
                    reReviewGroup.style.display = 'block';
                    reReviewReason.required = true;
                } else {
                    reReviewGroup.style.display = 'none';
                    reReviewReason.required = false;
                }
                if (!confirm('Submit this first editorial decision?')) {
                    event.preventDefault();
                }
            });
        });
    })();
</script>
