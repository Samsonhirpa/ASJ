<div class="content-wrapper">
    <section class="content-header">
        <h1>Track Review Progress</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reviewer Assignment Status</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Manuscript</th>
                                    <th>Reviewer</th>
                                    <th>Status</th>
                                    <th>Recommendation</th>
                                    <th>Editor Approval</th>
                                    <th>Due Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($assignments)): foreach ($assignments as $a): ?>
                                <?php $approvalStatus = isset($a->editorReviewApprovalStatus) ? $a->editorReviewApprovalStatus : 'pending'; ?>
                                <tr>
                                    <td>
                                        <strong><?= html_escape($a->manuscriptNumber) ?></strong><br>
                                        <span class="small text-muted"><?= html_escape($a->manuscriptTitle) ?></span>
                                    </td>
                                    <td>
                                        <?= html_escape($a->reviewerName) ?><br>
                                        <span class="small text-muted"><?= html_escape($a->reviewerEmail) ?></span>
                                    </td>
                                    <td><?= html_escape($a->status) ?></td>
                                    <td><?= html_escape(!empty($a->recommendationDecision) ? $a->recommendationDecision : '-') ?></td>
                                    <td>
                                        <span class="label label-<?= $approvalStatus === 'approved' ? 'success' : ($approvalStatus === 'rejected' ? 'danger' : 'warning') ?>">
                                            <?= ucfirst($approvalStatus) ?>
                                        </span>
                                        <?php if (!empty($a->editorSetPrice)): ?>
                                            <div class="small text-success">Price: $<?= number_format((float)$a->editorSetPrice, 2) ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= html_escape($a->reviewDueDate) ?></td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="<?= base_url('editor/manuscript/' . (int)$a->manuscriptId) ?>">Open Workflow</a>
                                    </td>
                                </tr>
                                <?php if ($a->status === 'completed' && $approvalStatus === 'pending'): ?>
                                    <tr>
                                        <td colspan="7" style="background:#fafafa;">
                                            <form method="post" action="<?= base_url('editor/review-approval/' . (int)$a->manuscriptId . '/' . (int)$a->assignmentId) ?>" class="form-inline">
                                                <select name="approvalStatus" class="form-control input-sm approval-status" required>
                                                    <option value="approved">Approve Reviewer Comment</option>
                                                    <option value="rejected">Reject Reviewer Comment</option>
                                                </select>
                                                <input type="text" name="approvalReason" class="form-control input-sm" style="min-width:220px;" placeholder="Reason for approval/rejection" required>
                                                <input type="number" step="0.01" min="0.01" name="editorSetPrice" class="form-control input-sm approval-price" placeholder="Price for payment gateway">
                                                <button class="btn btn-xs btn-primary" type="submit">Submit Editor Approval</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; else: ?>
                                <tr><td colspan="7">No reviewer assignments found.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    (function() {
        var rows = document.querySelectorAll('.form-inline');
        rows.forEach(function(form) {
            var status = form.querySelector('.approval-status');
            var price = form.querySelector('.approval-price');
            if (!status || !price) return;
            var toggle = function() {
                if (status.value === 'approved') {
                    price.required = true;
                    price.disabled = false;
                } else {
                    price.required = false;
                    price.disabled = true;
                    price.value = '';
                }
            };
            status.addEventListener('change', toggle);
            toggle();
        });
    })();
</script>
