<div class="content-wrapper">
    <section class="content-header"><h1>Editor-in-Chief Dashboard</h1></section>
    <section class="content">
        <div class="row">
            <div class="col-md-4"><div class="small-box bg-aqua"><div class="inner"><h3><?= (int)$stats['all'] ?></h3><p>View All Manuscripts</p></div></div></div>
            <div class="col-md-4"><div class="small-box bg-green"><div class="inner"><h3><?= (int)$stats['accepted'] ?></h3><p>Accepted</p></div></div></div>
            <div class="col-md-4"><div class="small-box bg-red"><div class="inner"><h3><?= (int)$stats['rejected'] ?></h3><p>Rejected</p></div></div></div>
        </div>

        <div class="box box-primary">
            <div class="box-header with-border"><h3 class="box-title">Manage Editorial Board</h3></div>
            <div class="box-body table-responsive">
                <table class="table table-striped">
                    <thead><tr><th>Name</th><th>Email</th><th>Role ID</th><th>Institution</th></tr></thead>
                    <tbody>
                    <?php foreach ($boardMembers as $m): ?>
                        <tr><td><?= html_escape($m->name) ?></td><td><?= html_escape($m->email) ?></td><td><?= (int)$m->roleId ?></td><td><?= html_escape($m->institution) ?></td></tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box box-warning">
            <div class="box-header with-border"><h3 class="box-title">Override Decisions</h3></div>
            <form method="post" action="<?= base_url('editor/override-decision') ?>" onsubmit="this.action=this.action + '/' + document.getElementById('overrideManuscript').value;">
                <div class="box-body row">
                    <div class="col-md-4"><input id="overrideManuscript" type="number" class="form-control" placeholder="Manuscript ID" required></div>
                    <div class="col-md-4">
                        <select name="status" class="form-control" required>
                            <option value="accepted">Accepted</option><option value="rejected">Rejected</option><option value="revision_required">Revision Required</option><option value="under_review">Under Review</option>
                        </select>
                    </div>
                    <div class="col-md-4"><input name="reason" class="form-control" placeholder="Override reason" required></div>
                </div>
                <div class="box-footer"><button class="btn btn-warning">Apply Override</button></div>
            </form>
        </div>
    </section>
</div>
