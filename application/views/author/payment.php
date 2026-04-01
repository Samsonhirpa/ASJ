<div class="content-wrapper">
    <section class="content-header">
        <h1>Pay Publishing Fee</h1>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Accepted manuscripts payment status</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Manuscript #</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Method</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Reference</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($payments)): foreach ($payments as $item): ?>
                        <tr>
                            <td><?= html_escape($item->manuscriptNumber) ?></td>
                            <td><?= html_escape($item->title) ?></td>
                            <td><?= html_escape(ucwords(str_replace('_', ' ', $item->status))) ?></td>
                            <td><?= html_escape($item->paymentMethod ?: '-') ?></td>
                            <td><?= $item->amount !== null ? number_format((float)$item->amount, 2) : '-' ?></td>
                            <td>
                                <span class="label label-<?= ($item->paymentStatus === 'paid' || $item->paymentStatus === 'free') ? 'success' : 'warning' ?>">
                                    <?= html_escape($item->paymentStatus ?: 'pending') ?>
                                </span>
                            </td>
                            <td><?= html_escape($item->transactionReference ?: '-') ?></td>
                            <td>
                                <?php if ($item->paymentStatus === 'pending' && (float)$item->amount > 0): ?>
                                    <button
                                        class="btn btn-xs btn-primary open-author-payment-modal"
                                        data-manuscript-id="<?= (int)$item->manuscriptId ?>"
                                        data-manuscript="<?= html_escape($item->manuscriptNumber . ' - ' . $item->title) ?>"
                                        data-method="<?= html_escape(strtoupper((string)$item->paymentMethod)) ?>"
                                        data-amount="<?= number_format((float)$item->amount, 2) ?>"
                                    >
                                        Pay Fee
                                    </button>
                                <?php else: ?>
                                    <span class="text-muted">No action</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="8" class="text-center text-muted">No accepted manuscripts in payment queue.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="authorPaymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="authorPaymentForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Submit Payment</h4>
                </div>
                <div class="modal-body">
                    <p id="authorPaymentLabel" class="text-muted"></p>
                    <p class="text-muted" id="authorPaymentCharge"></p>
                    <div class="form-group">
                        <label>Transaction Reference</label>
                        <input type="text" name="transactionReference" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Payment Note (optional)</label>
                        <textarea name="paymentNote" class="form-control" rows="3" placeholder="Bank slip info, sender name, etc."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        var buttons = document.querySelectorAll('.open-author-payment-modal');
        var form = document.getElementById('authorPaymentForm');
        var label = document.getElementById('authorPaymentLabel');
        var charge = document.getElementById('authorPaymentCharge');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var manuscriptId = button.getAttribute('data-manuscript-id');
                var manuscriptLabel = button.getAttribute('data-manuscript');
                var method = button.getAttribute('data-method');
                var amount = button.getAttribute('data-amount');

                form.action = '<?= base_url('author/manuscript/payment/submit/') ?>' + manuscriptId;
                label.textContent = manuscriptLabel;
                charge.textContent = 'Please pay using ' + method + '. Required amount: ' + amount;
                $('#authorPaymentModal').modal('show');
            });
        });
    })();
</script>
