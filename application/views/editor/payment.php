<div class="content-wrapper">
    <section class="content-header">
        <h1>Payment Queue</h1>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">Accepted manuscripts waiting for payment</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Manuscript #</th>
                            <th>Document Name</th>
                            <th>Status</th>
                            <th>Pending Payments</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($payments)): foreach ($payments as $item): ?>
                        <tr>
                            <td><?= html_escape($item->manuscriptNumber) ?></td>
                            <td><?= html_escape($item->title) ?></td>
                            <td><?= html_escape(ucwords(str_replace('_', ' ', $item->status))) ?></td>
                            <td><?= (int)$item->pendingPayments ?></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center text-muted">No manuscripts in payment queue.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
