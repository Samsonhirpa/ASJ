<div class="content-wrapper">
    <section class="content-header">
        <h1>Payment Queue</h1>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Approved manuscripts waiting for payment action</h3>
                <div class="box-tools pull-right">
                    <a href="<?= base_url('editor/published') ?>" class="btn btn-success btn-sm">
                        <i class="fa fa-newspaper-o"></i> View Published Manuscripts
                    </a>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Manuscript #</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Payment Method</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Actions</th>
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
                            <td><?= html_escape($item->paymentStatus ?: 'pending') ?></td>
                            <td>
                                <button
                                    class="btn btn-xs btn-primary open-payment-modal"
                                    data-manuscript-id="<?= (int)$item->manuscriptId ?>"
                                    data-manuscript="<?= html_escape($item->manuscriptNumber . ' - ' . $item->title) ?>"
                                >
                                    Payment Action
                                </button>
                                <form method="post" action="<?= base_url('editor/payment/publish/' . (int)$item->manuscriptId) ?>" style="display:inline-block;">
                                    <button class="btn btn-xs btn-success" type="submit" <?= ($item->paymentStatus === 'free' || $item->paymentStatus === 'paid') ? '' : 'disabled' ?>>
                                        Publish
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center text-muted">No manuscripts in payment queue.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="paymentActionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" id="paymentActionForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Payment Action</h4>
                </div>
                <div class="modal-body">
                    <p id="paymentManuscriptLabel" class="text-muted"></p>
                    <div class="form-group">
                        <label>Select Method</label>
                        <select name="paymentMethod" class="form-control" required>
                            <option value="">Choose method</option>
                            <option value="telebirr">Telebirr</option>
                            <option value="cbe">CBE</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" step="0.01" min="0" name="paymentAmount" class="form-control" required>
                        <p class="help-block">If free to publish, set amount to 0.</p>
                    </div>
                    <div class="form-group">
                        <label>Other</label>
                        <textarea name="paymentOther" class="form-control" rows="3" placeholder="Optional notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Payment Action</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        var buttons = document.querySelectorAll('.open-payment-modal');
        var form = document.getElementById('paymentActionForm');
        var label = document.getElementById('paymentManuscriptLabel');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                var manuscriptId = button.getAttribute('data-manuscript-id');
                var manuscriptLabel = button.getAttribute('data-manuscript');
                form.action = '<?= base_url('editor/payment/save/') ?>' + manuscriptId;
                label.textContent = manuscriptLabel;
                $('#paymentActionModal').modal('show');
            });
        });
    })();
</script>
