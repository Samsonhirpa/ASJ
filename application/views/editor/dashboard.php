<div class="content-wrapper">
    <section class="content-header">
        <h1>Editor Dashboard <small>Editorial overview and workflow monitoring</small></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3 col-sm-6"><div class="small-box bg-aqua"><div class="inner"><h3><?= (int)$stats['all'] ?></h3><p>All Manuscripts</p></div><a href="<?= base_url('editor/all-manuscripts') ?>" class="small-box-footer">Open <i class="fa fa-arrow-circle-right"></i></a></div></div>
            <div class="col-md-3 col-sm-6"><div class="small-box bg-yellow"><div class="inner"><h3><?= (int)$stats['pending'] ?></h3><p>Pending Manuscripts</p></div><a href="<?= base_url('editor/pending') ?>" class="small-box-footer">Open <i class="fa fa-arrow-circle-right"></i></a></div></div>
            <div class="col-md-3 col-sm-6"><div class="small-box bg-orange"><div class="inner"><h3><?= (int)$stats['underReview'] ?></h3><p>Under Review</p></div><a href="<?= base_url('editor/all-manuscripts') ?>" class="small-box-footer">Track <i class="fa fa-arrow-circle-right"></i></a></div></div>
            <div class="col-md-3 col-sm-6"><div class="small-box bg-green"><div class="inner"><h3><?= (int)$stats['accepted'] ?> / <?= (int)$stats['rejected'] ?></h3><p>Accepted / Rejected</p></div><a href="<?= base_url('editor/all-manuscripts') ?>" class="small-box-footer">Details <i class="fa fa-arrow-circle-right"></i></a></div></div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border"><h3 class="box-title">Overview of All Manuscripts</h3></div>
                    <div class="box-body table-responsive">
                        <table class="table table-striped">
                            <thead><tr><th>#</th><th>Title</th><th>Status</th><th>Review Progress</th><th>Action</th></tr></thead>
                            <tbody>
                            <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                                <tr>
                                    <td><?= html_escape($m->manuscriptNumber) ?></td>
                                    <td><?= html_escape($m->title) ?></td>
                                    <td><span class="label label-info"><?= html_escape($m->status) ?></span></td>
                                    <td><?= (int)$m->completedReviews ?> / <?= (int)$m->reviewerCount ?> completed</td>
                                    <td><a class="btn btn-xs btn-primary" href="<?= base_url('editor/manuscript/'.$m->manuscriptId) ?>">Open</a></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="5" class="text-center">No manuscripts found.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border"><h3 class="box-title">Recent Activity Feed</h3></div>
                    <div class="box-body">
                        <ul class="timeline timeline-inverse" style="margin:0;">
                            <?php if (!empty($activities)): foreach ($activities as $a): ?>
                                <li>
                                    <i class="fa fa-file-text bg-blue"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> <?= date('d M Y H:i', strtotime($a->updatedDtm ?: $a->createdDtm)) ?></span>
                                        <h3 class="timeline-header"><?= html_escape($a->manuscriptNumber) ?> - <?= html_escape($a->status) ?></h3>
                                        <div class="timeline-body"><?= html_escape($a->title) ?></div>
                                    </div>
                                </li>
                            <?php endforeach; else: ?>
                                <li><div class="timeline-item"><div class="timeline-body">No recent editorial activity.</div></div></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
