<div class="content-wrapper">
    <section class="content-header">
        <h1>Managing Editor Dashboard <small>Formatting and guideline screening</small></h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6"><div class="small-box bg-aqua"><div class="inner"><h3><?= (int)$stats['totalAcceptedByEic'] ?></h3><p>EIC Accepted</p></div><div class="icon"><i class="fa fa-check-circle"></i></div></div></div>
            <div class="col-lg-3 col-xs-6"><div class="small-box bg-yellow"><div class="inner"><h3><?= (int)$stats['pending'] ?></h3><p>Pending ME Screening</p></div><div class="icon"><i class="fa fa-clock-o"></i></div></div></div>
            <div class="col-lg-3 col-xs-6"><div class="small-box bg-green"><div class="inner"><h3><?= (int)$stats['passed'] ?></h3><p>Passed</p></div><div class="icon"><i class="fa fa-thumbs-up"></i></div></div></div>
            <div class="col-lg-3 col-xs-6"><div class="small-box bg-red"><div class="inner"><h3><?= (int)$stats['failed'] ?></h3><p>Failed</p></div><div class="icon"><i class="fa fa-times-circle"></i></div></div></div>
        </div>

        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Pending Manuscripts Accepted by EIC</h3>
                <div class="box-tools"><a href="<?= base_url('managing-editor/pending') ?>" class="btn btn-sm btn-primary">Manage Pending Manuscripts</a></div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <thead><tr><th>#</th><th>Title</th><th>Author</th><th>EIC Screened</th><th></th></tr></thead>
                    <tbody>
                    <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                        <tr>
                            <td><?= html_escape($m->manuscriptNumber) ?></td>
                            <td><?= html_escape($m->title) ?></td>
                            <td>Blind Review</td>
                            <td><?= !empty($m->eicScreenedDtm) ? date('d M Y', strtotime($m->eicScreenedDtm)) : '-' ?></td>
                            <td><a class="btn btn-xs btn-primary" href="<?= base_url('managing-editor/pending/screen/'.$m->manuscriptId) ?>"><i class="fa fa-search"></i> Screen</a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center text-muted">No EIC-accepted manuscripts are pending Managing Editor screening.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
