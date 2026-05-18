<div class="content-wrapper">
    <section class="content-header">
        <h1>Publishing Process</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Finalize Publishing: <?= html_escape($manuscript->manuscriptNumber) ?> - <?= html_escape($manuscript->title) ?></h3>
            </div>
            <div class="box-body">
                <form method="post" action="<?= base_url('publisher/publish/submit/' . (int)$manuscript->manuscriptId) ?>">
                    <h4>DOI Assignment</h4>
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label>DOI Prefix</label><input class="form-control" name="doi_prefix" value="<?= html_escape((string)$manuscript->doi_prefix) ?>" required></div></div>
                        <div class="col-md-6"><div class="form-group"><label>DOI Suffix</label><input class="form-control" name="doi_suffix" value="<?= html_escape((string)$manuscript->doi_suffix) ?>" required></div></div>
                    </div>
                    <div class="form-group">
                        <label>Select Issue</label>
                        <select class="form-control" name="issueId" required>
                            <option value="">Select Issue</option>
                            <?php foreach(($issues??[]) as $issue): ?>
                                <option value="<?= (int)$issue->issueId ?>">Vol <?= (int)$issue->volume ?>, Issue <?= (int)$issue->issueNumber ?><?= !empty($issue->title) ? ' - ' . html_escape($issue->title) : '' ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Fee Status</label>
                        <select class="form-control" id="feeStatus" name="feeStatus" required>
                            <option value="free">Free</option>
                            <option value="need_fee">Need Fee</option>
                        </select>
                    </div>

                    <div id="paymentFields" style="display:none; border:1px solid #ddd; padding:10px; margin-bottom:10px;">
                        <h4>Payment Setup (from EiC workflow)</h4>
                        <div class="form-group"><label>Payment Method</label><input class="form-control" name="paymentMethod" placeholder="Bank transfer / gateway / etc"></div>
                        <div class="form-group"><label>Payment Amount</label><input type="number" step="0.01" min="0" class="form-control" name="paymentAmount"></div>
                        <div class="form-group"><label>Payment Details</label><textarea class="form-control" name="paymentOther" rows="3"></textarea></div>
                    </div>

                    <button class="btn btn-primary" type="submit">Submit Publishing Process</button>
                </form>
                <hr>
                <form method="post" action="<?= base_url('publisher/publish/do-publish/' . (int)$manuscript->manuscriptId) ?>">
                    <?php $canPublish = !empty($payment) && in_array((string)$payment->paymentStatus, ['free', 'paid'], true); ?>
                    <button class="btn btn-success" type="submit" <?= $canPublish ? '' : 'disabled' ?>>Publish</button>
                    <p class="help-block">If fee is required, Publish button is enabled after author payment is marked as paid.</p>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
(function(){
    var feeStatus = document.getElementById('feeStatus');
    var paymentFields = document.getElementById('paymentFields');
    if (!feeStatus || !paymentFields) return;
    function toggleFields() {
        paymentFields.style.display = feeStatus.value === 'need_fee' ? 'block' : 'none';
    }
    feeStatus.addEventListener('change', toggleFields);
    toggleFields();
})();
</script>
