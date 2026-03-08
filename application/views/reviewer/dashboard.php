<div class="content-wrapper" style="background: #f4f6f9;">
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #3c8dbc;">
            <h1 style="color: #333; font-size: 2em; margin: 0;">
                <i class="fa fa-search" style="color: #3c8dbc; margin-right: 10px;"></i>
                Reviewer Dashboard
                <small style="color: #777;">Welcome back, <?= $user->name ?></small>
            </h1>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6"><div class="small-box bg-aqua"><div class="inner"><h3><?= $summary['totalAssigned'] ?></h3><p>Total Assignments</p></div><div class="icon"><i class="fa fa-tasks"></i></div></div></div>
            <div class="col-lg-3 col-xs-6"><div class="small-box bg-yellow"><div class="inner"><h3><?= $summary['pendingInvitations'] ?></h3><p>Pending Invitations</p></div><div class="icon"><i class="fa fa-envelope-open"></i></div></div></div>
            <div class="col-lg-3 col-xs-6"><div class="small-box bg-green"><div class="inner"><h3><?= $summary['completed'] ?></h3><p>Completed Reviews</p></div><div class="icon"><i class="fa fa-check-circle"></i></div></div></div>
            <div class="col-lg-3 col-xs-6"><div class="small-box bg-red"><div class="inner"><h3><?= $summary['overdue'] ?></h3><p>Overdue Reviews</p></div><div class="icon"><i class="fa fa-exclamation-triangle"></i></div></div></div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-clock-o"></i> Assigned Manuscripts & Deadlines</h3>
                        <div class="box-tools pull-right">
                            <a href="<?= base_url('reviewer/assignments') ?>" class="btn btn-xs btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-hover">
                            <thead><tr><th>Manuscript #</th><th>Title</th><th>Due Date</th><th>Status</th><th>Action</th></tr></thead>
                            <tbody>
                            <?php if (!empty($assignedManuscripts)): foreach($assignedManuscripts as $item): ?>
                                <tr>
                                    <td><strong><?= $item->manuscriptNumber ?></strong></td>
                                    <td><?= html_escape(strlen($item->title) > 70 ? substr($item->title,0,70).'...' : $item->title) ?></td>
                                    <td><?= $item->reviewDueDate ? date('d M Y', strtotime($item->reviewDueDate)) : '-' ?></td>
                                    <td><span class="label label-<?= $item->status === 'completed' ? 'success' : ($item->status === 'accepted' ? 'info' : 'warning') ?>"><?= ucfirst($item->status) ?></span></td>
                                    <td><a href="<?= base_url('reviewer/assignment/'.$item->assignmentId) ?>" class="btn btn-xs btn-default">Open</a></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="5" class="text-center text-muted">No assignments found.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-trophy"></i> Recognition & Performance</h3></div>
                    <div class="box-body">
                        <p><strong>Recognition:</strong> <?= $performance['recognitionLevel'] ?></p>
                        <p><strong>Average Score:</strong> <?= $performance['averageScore'] ?>/5</p>
                        <p><strong>Average Turnaround:</strong> <?= $performance['averageTurnaroundDays'] ?> days</p>
                        <p><strong>On-time Rate:</strong> <?= $performance['onTimeRate'] ?>%</p>
                        <hr>
                        <a href="<?= base_url('journal/reviewer-guidelines') ?>" class="btn btn-block btn-default"><i class="fa fa-book"></i> Review Guidelines</a>
                        <a href="<?= base_url('reviewer/dashboard/reminders') ?>" class="btn btn-block btn-warning"><i class="fa fa-bell"></i> Send Pending Review Reminders</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-history"></i> Completed Reviews</h3></div>
                    <div class="box-body table-responsive">
                        <table class="table table-striped">
                            <thead><tr><th>Manuscript #</th><th>Title</th><th>Recommendation</th><th>Score</th><th>Submitted</th></tr></thead>
                            <tbody>
                            <?php if (!empty($completedReviews)): foreach($completedReviews as $review): ?>
                                <tr>
                                    <td><?= $review->manuscriptNumber ?></td>
                                    <td><?= html_escape(strlen($review->title) > 80 ? substr($review->title,0,80).'...' : $review->title) ?></td>
                                    <td><?= ucwords(str_replace('_', ' ', $review->recommendationDecision ?: '-')) ?></td>
                                    <td><?= $review->score ?: '-' ?></td>
                                    <td><?= $review->reviewSubmittedDate ? date('d M Y', strtotime($review->reviewSubmittedDate)) : '-' ?></td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="5" class="text-center text-muted">No completed reviews yet.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
