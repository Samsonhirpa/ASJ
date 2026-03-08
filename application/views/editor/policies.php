<div class="content-wrapper">
    <section class="content-header"><h1>Manage Journal Policies</h1></section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header with-border"><h3 class="box-title">Add / Update Policy</h3></div>
                    <form method="post" action="<?= base_url('editor/policies') ?>">
                        <div class="box-body">
                            <input name="policyKey" class="form-control" placeholder="policy-key" required>
                            <input name="policyTitle" class="form-control" style="margin-top:10px" placeholder="Policy title" required>
                            <textarea name="policyContent" class="form-control" rows="8" style="margin-top:10px" placeholder="Policy content" required></textarea>
                        </div>
                        <div class="box-footer"><button class="btn btn-primary">Save Policy</button></div>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="box box-default">
                    <div class="box-header with-border"><h3 class="box-title">Current Policies</h3></div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered">
                            <thead><tr><th>Key</th><th>Title</th><th>Updated</th></tr></thead>
                            <tbody>
                            <?php if (!empty($policies)): foreach ($policies as $p): ?>
                                <tr><td><?= html_escape($p->policyKey) ?></td><td><?= html_escape($p->policyTitle) ?></td><td><?= html_escape($p->updatedDtm) ?></td></tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="3">No policies found.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
