<div class="content-wrapper" style="background: #f4f6f9;">
    
    <!-- Content Header -->
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                <i class="fa fa-pencil-square-o" style="color: #2c5f2d; margin-right: 10px;"></i>
                Author Dashboard
                <small style="color: #777;">Welcome back, <?= $user->name ?></small>
            </h1>
        </div>
    </section>

    <section class="content">
        <!-- Welcome Card -->
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; background: linear-gradient(135deg, #2c5f2d 0%, #3e7c40 100%); color: white; overflow: hidden;">
                    <div class="box-body" style="padding: 30px;">
                        <div class="row">
                            <div class="col-md-8">
                                <h2 style="margin-top: 0;">Welcome to OJAS Author Portal</h2>
                                <p style="font-size: 1.1em; opacity: 0.9;">Submit and track your manuscripts, collaborate with co-authors, and publish your research.</p>
                                <a href="<?= base_url('author/manuscript/submit') ?>" class="btn btn-lg" style="background: white; color: #2c5f2d; border-radius: 25px; padding: 10px 30px; margin-top: 15px; font-weight: 600;">
                                    <i class="fa fa-upload"></i> New Submission
                                </a>
                            </div>
                            <div class="col-md-4 text-center">
                                <i class="fa fa-file-text" style="font-size: 8em; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua" style="border-radius: 10px; overflow: hidden;">
                    <div class="inner">
                        <h3><?= $totalSubmissions ?></h3>
                        <p>Total Submissions</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text"></i>
                    </div>
                    <a href="<?= base_url('author/manuscript') ?>" class="small-box-footer">View all <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow" style="border-radius: 10px; overflow: hidden;">
                    <div class="inner">
                        <h3><?= $underReview ?></h3>
                        <p>Under Review</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <a href="<?= base_url('author/manuscript?status=under_review') ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green" style="border-radius: 10px; overflow: hidden;">
                    <div class="inner">
                        <h3><?= $accepted + $published ?></h3>
                        <p>Accepted/Published</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check-circle"></i>
                    </div>
                    <a href="<?= base_url('author/manuscript?status=accepted') ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red" style="border-radius: 10px; overflow: hidden;">
                    <div class="inner">
                        <h3><?= $rejected ?></h3>
                        <p>Rejected</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-times-circle"></i>
                    </div>
                    <a href="<?= base_url('author/manuscript?status=rejected') ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header with-border" style="background: #f8fafc; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title"><i class="fa fa-bolt" style="color: #2c5f2d;"></i> Quick Actions</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('author/manuscript/submit') ?>" class="btn btn-block btn-lg" style="background: #2c5f2d; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-upload fa-2x"></i><br>
                                    New Submission
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('author/manuscript') ?>" class="btn btn-block btn-lg" style="background: #17a2b8; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-list fa-2x"></i><br>
                                    My Submissions
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('author/dashboard/profile') ?>" class="btn btn-block btn-lg" style="background: #ffc107; color: #333; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-user fa-2x"></i><br>
                                    Update Profile
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('journal/author-guidelines') ?>" class="btn btn-block btn-lg" style="background: #6c757d; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-book fa-2x"></i><br>
                                    Author Guidelines
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('author/manuscript/revision-notifications') ?>" class="btn btn-block btn-lg" style="background: #fd7e14; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-bell fa-2x"></i><br>
                                    Revision Alerts
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 12px;">
                    <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-bell"></i> Notifications</h3></div>
                    <div class="box-body">
                        <?php if (!empty($notifications)): ?>
                            <ul class="list-group">
                                <?php foreach($notifications as $n): ?>
                                    <li class="list-group-item">
                                        <strong><?= html_escape($n->subject) ?></strong><br>
                                        <span class="text-muted"><?= html_escape($n->message) ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">No new notifications.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Submissions -->
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header with-border" style="background: #f8fafc; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title"><i class="fa fa-history" style="color: #2c5f2d;"></i> Recent Submissions</h3>
                        <div class="box-tools pull-right">
                            <a href="<?= base_url('author/manuscript') ?>" class="btn btn-sm btn-default">View All</a>
                        </div>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <?php if(!empty($recentManuscripts)): ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Manuscript #</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Submitted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recentManuscripts as $m): ?>
                                <tr>
                                    <td><strong><?= $m->manuscriptNumber ?></strong></td>
                                    <td><?= substr($m->title, 0, 50) ?>...</td>
                                    <td><?= ucfirst(str_replace('_', ' ', $m->articleType)) ?></td>
                                    <td>
                                        <?php
                                        $statusClass = [
                                            'draft' => 'default',
                                            'submitted' => 'info',
                                            'under_review' => 'warning',
                                            'revision_required' => 'primary',
                                            'accepted' => 'success',
                                            'rejected' => 'danger',
                                            'published' => 'success'
                                        ];
                                        $class = isset($statusClass[$m->status]) ? $statusClass[$m->status] : 'default';
                                        ?>
                                        <span class="label label-<?= $class ?>"><?= ucfirst(str_replace('_', ' ', $m->status)) ?></span>
                                    </td>
                                    <td><?= date('d M Y', strtotime($m->createdDtm)) ?></td>
                                    <td>
                                        <a href="<?= base_url('author/manuscript/view/'.$m->manuscriptId) ?>" class="btn btn-xs btn-info">
                                            <i class="fa fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php else: ?>
                        <div class="text-center" style="padding: 40px;">
                            <i class="fa fa-file-text" style="font-size: 4em; color: #ccc;"></i>
                            <h4>No submissions yet</h4>
                            <p>Start by submitting your first manuscript</p>
                            <a href="<?= base_url('author/manuscript/submit') ?>" class="btn btn-success">
                                <i class="fa fa-upload"></i> New Submission
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
