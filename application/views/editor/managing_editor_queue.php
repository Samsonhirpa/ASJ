<div class="content-wrapper">
    <section class="content-header">
        <h1>Managing Editor Technical Screening <small>Pre-reviewer assignment</small></h1>
    </section>
    <section class="content">
        <?php
            $pendingCount = count($manuscripts);
            $registeredCount = 0;
            foreach ($manuscripts as $item) {
                if (!empty($item->managingTotalScore)) { $registeredCount++; }
            }
        ?>
        <div class="row">
            <div class="col-sm-4"><div class="small-box bg-aqua"><div class="inner"><h3><?= (int)$pendingCount ?></h3><p>Available for screening</p></div><div class="icon"><i class="fa fa-inbox"></i></div></div></div>
            <div class="col-sm-4"><div class="small-box bg-green"><div class="inner"><h3><?= (int)$registeredCount ?></h3><p>Results registered</p></div><div class="icon"><i class="fa fa-check"></i></div></div></div>
            <div class="col-sm-4"><div class="small-box bg-yellow"><div class="inner"><h3>100%</h3><p>Four criteria × 25%</p></div><div class="icon"><i class="fa fa-percent"></i></div></div></div>
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Manuscripts accepted by EIC for technical screening</h3>
                <div class="box-tools"><input type="text" id="meFilter" class="form-control input-sm" placeholder="Filter manuscripts"></div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="meQueueTable">
                    <thead>
                    <tr>
                        <th>Manuscript</th>
                        <th>Author / Department</th>
                        <th>Scores (25% each)</th>
                        <th>Recommendation</th>
                        <th>Comments / Upload</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($manuscripts)): ?>
                        <tr><td colspan="6" class="text-center">No manuscripts are waiting for Managing Editor screening.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($manuscripts as $m): ?>
                        <tr>
                            <form method="post" enctype="multipart/form-data" action="<?= base_url('editor/managing-editor/save/'.$m->manuscriptId) ?>">
                                <td>
                                    <strong><?= html_escape($m->manuscriptNumber) ?></strong><br>
                                    <?= html_escape($m->title) ?><br>
                                    <a href="<?= base_url('editor/manuscript/'.$m->manuscriptId) ?>">Open manuscript</a>
                                </td>
                                <td><?= html_escape($m->authorName) ?><br><small><?= html_escape($m->authorDepartment ?: 'No department') ?></small></td>
                                <td style="min-width:220px;">
                                    <label>Formatting (25%)</label>
                                    <input type="number" min="0" max="25" step="0.01" name="formattingScore" class="form-control" required>
                                    <label>Completeness (25%)</label>
                                    <input type="number" min="0" max="25" step="0.01" name="completenessScore" class="form-control" required>
                                    <label>Quality (25%)</label>
                                    <input type="number" min="0" max="25" step="0.01" name="qualityScore" class="form-control" required>
                                    <label>Template check (25%)</label>
                                    <input type="number" min="0" max="25" step="0.01" name="templateScore" class="form-control" required>
                                </td>
                                <td>
                                    <select name="recommendation" class="form-control" required>
                                        <option value="accept">Accept</option>
                                        <option value="revision">Revision</option>
                                        <option value="reject">Reject</option>
                                    </select>
                                    <p class="help-block">Total is calculated out of 100%.</p>
                                </td>
                                <td style="min-width:240px;">
                                    <textarea name="comments" class="form-control" rows="6" placeholder="Comments using Author Guidelines (optional)"></textarea>
                                    <input type="file" name="resultFile" class="form-control" style="margin-top:8px;">
                                </td>
                                <td><button class="btn btn-primary">Register Result</button></td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
(function () {
    var input = document.getElementById('meFilter');
    var table = document.getElementById('meQueueTable');
    if (!input || !table) { return; }
    input.addEventListener('keyup', function () {
        var term = input.value.toLowerCase();
        Array.prototype.forEach.call(table.querySelectorAll('tbody tr'), function (row) {
            row.style.display = row.textContent.toLowerCase().indexOf(term) === -1 ? 'none' : '';
        });
    });
})();
</script>
