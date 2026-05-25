<div class="content-wrapper">
    <section class="content-header">
        <h1>Pending Manuscripts <small>Managing Editor portal</small></h1>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-header with-border"><h3 class="box-title">Filter Manuscripts</h3></div>
            <form method="get" action="<?= base_url('managing-editor/pending') ?>">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4"><label>Search</label><input type="text" name="q" value="<?= html_escape($filters['q']) ?>" class="form-control" placeholder="Title, manuscript #, or author"></div>
                        <div class="col-md-3"><label>Status</label><select name="status" class="form-control">
                            <?php foreach (['pending' => 'Pending', 'approved' => 'Approved', 'rejected' => 'Rejected', 'all' => 'All EIC Accepted'] as $value => $label): ?>
                                <option value="<?= $value ?>" <?= $filters['status'] === $value ? 'selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select></div>
                        <div class="col-md-3"><label>Article Type</label><input type="text" name="articleType" value="<?= html_escape($filters['articleType']) ?>" class="form-control" placeholder="e.g. research_article"></div>
                        <div class="col-md-2"><label>&nbsp;</label><button type="submit" class="btn btn-primary btn-block"><i class="fa fa-filter"></i> Filter</button></div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-3"><div class="info-box"><span class="info-box-icon bg-yellow"><i class="fa fa-clock-o"></i></span><div class="info-box-content"><span class="info-box-text">Pending</span><span class="info-box-number"><?= (int)$stats['pending'] ?></span></div></div></div>
            <div class="col-md-3"><div class="info-box"><span class="info-box-icon bg-green"><i class="fa fa-check"></i></span><div class="info-box-content"><span class="info-box-text">Approved</span><span class="info-box-number"><?= (int)$stats['passed'] ?></span></div></div></div>
            <div class="col-md-3"><div class="info-box"><span class="info-box-icon bg-red"><i class="fa fa-times"></i></span><div class="info-box-content"><span class="info-box-text">Rejected</span><span class="info-box-number"><?= (int)$stats['failed'] ?></span></div></div></div>
            <div class="col-md-3"><div class="info-box"><span class="info-box-icon bg-aqua"><i class="fa fa-list"></i></span><div class="info-box-content"><span class="info-box-text">EIC Accepted</span><span class="info-box-number"><?= (int)$stats['totalAcceptedByEic'] ?></span></div></div></div>
        </div>

        <div class="box box-warning">
            <div class="box-header with-border"><h3 class="box-title">Manuscripts Accepted by EIC</h3></div>
            <div class="box-body table-responsive">
                <table class="table table-hover table-striped">
                    <thead><tr><th>#</th><th>Title</th><th>Author</th><th>Article Type</th><th>EIC Decision</th><th>ME Result</th><th>Submitted</th><th></th></tr></thead>
                    <tbody>
                    <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                        <tr>
                            <td><?= html_escape($m->manuscriptNumber) ?></td>
                            <td><?= html_escape($m->title) ?></td>
                            <td><?= html_escape($m->authorName ?: '-') ?></td>
                            <td><?= html_escape(ucwords(str_replace('_', ' ', $m->articleType))) ?></td>
                            <td><span class="label label-success">Accepted by EIC</span></td>
                            <td><?php if (!empty($m->meResultStatus)): ?><span class="label label-<?= $m->meResultStatus === 'passed' ? 'success' : 'danger' ?>"><?= html_escape($m->meResultStatus === 'passed' ? 'approved' : 'rejected') ?></span><?php else: ?><span class="label label-warning">pending</span><?php endif; ?></td>
                            <td><?= date('d M Y', strtotime($m->createdDtm)) ?></td>
                            <td><a class="btn btn-xs btn-primary" href="<?= base_url('managing-editor/pending/screen/'.$m->manuscriptId) ?>"><i class="fa fa-search"></i> Screen</a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="8" class="text-center text-muted">No manuscripts match the selected filters.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
