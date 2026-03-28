<div class="content-wrapper">
    <section class="content-header">
        <h1>Double-Blind Review Form <small><?= $assignment->manuscriptNumber ?></small></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border"><h3 class="box-title">Manuscript Information</h3></div>
                    <div class="box-body">
                        <p><strong>Title:</strong><br><?= html_escape($assignment->title) ?></p>
                        <p><strong>Article Type:</strong> <?= ucwords(str_replace('_', ' ', $assignment->articleType)) ?></p>
                        <p><strong>Review Round:</strong> <?= $assignment->roundNumber ?: 1 ?></p>
                        <p><strong>Due Date:</strong> <?= $assignment->reviewDueDate ? date('d M Y', strtotime($assignment->reviewDueDate)) : 'Not set' ?></p>
                        <p><strong>Keywords:</strong> <?= html_escape($assignment->keywords) ?></p>
                        <hr>
                        <p class="text-muted"><i class="fa fa-user-secret"></i> Author identities are intentionally hidden.</p>
                        <a href="<?= base_url('journal/reviewer-guidelines') ?>" class="btn btn-sm btn-default"><i class="fa fa-book"></i> Review Guidelines</a>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border"><h3 class="box-title">Submit Your Review</h3></div>
                    <form method="post" action="<?= base_url('reviewer/assignment/submit/'.$assignment->assignmentId) ?>" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if (validation_errors()): ?>
                                <div class="alert alert-danger"><?= validation_errors() ?></div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label>Recommendation</label>
                                <select name="recommendationDecision" class="form-control" required>
                                    <option value="">Select Recommendation (Standard)</option>
                                    <option value="accept">Accept</option>
                                    <option value="minor_review">Minor Review</option>
                                    <option value="major_review">Major Review</option>
                                    <option value="reject">Reject</option>
                                </select>
                                <p class="help-block">Use one of the standard outcomes: accept, reject, minor review, or major review.</p>
                            </div>

                            <div class="form-group">
                                <label>Score / Rating (1-5)</label>
                                <input type="number" min="1" max="5" name="score" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Comments to Authors (Public)</label>
                                <textarea name="commentsToAuthor" rows="6" class="form-control" required placeholder="These comments are shared with the authors."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Comments to Editor (Confidential)</label>
                                <textarea name="commentsToEditor" rows="6" class="form-control" required placeholder="These comments are visible only to editors."></textarea>
                            </div>

                            <div class="form-group">
                                <label>Review Attachment (optional)</label>
                                <input type="file" name="reviewAttachment" class="form-control">
                                <p class="help-block">Allowed: pdf, doc, docx, xls, xlsx, txt, zip (max 5MB).</p>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php if ($assignment->status === 'accepted'): ?>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit Review</button>
                            <?php else: ?>
                                <div class="alert alert-warning" style="margin-bottom: 0;">Please accept the invitation before submitting your review.</div>
                            <?php endif; ?>
                            <a href="<?= base_url('reviewer/assignments') ?>" class="btn btn-default">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
