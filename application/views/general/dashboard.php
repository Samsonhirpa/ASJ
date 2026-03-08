<div class="content-wrapper" style="background: #f4f6f9;">
    
    <!-- Content Header -->
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                <i class="fa fa-dashboard" style="color: #2c5f2d; margin-right: 10px;"></i>
                Dashboard
                <small style="color: #777;">Welcome back, <?= $name ?></small>
            </h1>
        </div>
    </section>

    <section class="content">
        
        <!-- Welcome Banner -->
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; background: linear-gradient(135deg, #2c5f2d 0%, #3e7c40 100%); color: white; overflow: hidden;">
                    <div class="box-body" style="padding: 30px;">
                        <div class="row">
                            <div class="col-md-8">
                                <h2 style="margin-top: 0; font-weight: 600;">
                                    <?php
                                    // Role-specific greeting
                                    switch($role) {
                                        case 21:
                                            echo '📝 Author Dashboard';
                                            break;
                                        case 19:
                                            echo '🔍 Reviewer Dashboard';
                                            break;
                                        case 13:
                                        case 14:
                                        case 15:
                                        case 16:
                                        case 17:
                                        case 18:
                                        case 20:
                                            echo '✏️ Editorial Dashboard';
                                            break;
                                        default:
                                            echo '📊 Dashboard';
                                    }
                                    ?>
                                </h2>
                                <p style="font-size: 1.1em; opacity: 0.9; margin-bottom: 5px;">
                                    <?php echo $role_text; ?> • <?= $institution ?: 'Oromia Journal of Agricultural Sciences' ?>
                                </p>
                                <p style="opacity: 0.8;">
                                    <i class="fa fa-clock-o"></i> Last login: <?= empty($last_login) ? 'First time' : date('d M Y, h:i A', strtotime($last_login)) ?>
                                </p>
                            </div>
                            <div class="col-md-4 text-right">
                                <i class="fa fa-user-circle" style="font-size: 6em; opacity: 0.3;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role-Specific Quick Actions -->
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header with-border" style="background: #f8fafc; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title"><i class="fa fa-bolt" style="color: #2c5f2d;"></i> Quick Actions</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <div class="row">
                            
                            <!-- System Admin Actions -->
                            <?php if($is_admin == 1): ?>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('userListing') ?>" class="btn btn-block btn-lg" style="background: #2c5f2d; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-users fa-2x"></i><br>
                                    Manage Users
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('addNew') ?>" class="btn btn-block btn-lg" style="background: #17a2b8; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-user-plus fa-2x"></i><br>
                                    Add User
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Author Actions -->
                            <?php if($role == 21): ?>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('author/manuscript/submit') ?>" class="btn btn-block btn-lg" style="background: #2c5f2d; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-upload fa-2x"></i><br>
                                    New Submission
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('author/manuscript') ?>" class="btn btn-block btn-lg" style="background: #17a2b8; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-file-text fa-2x"></i><br>
                                    My Submissions
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Reviewer Actions -->
                            <?php if($role == 19): ?>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('reviewer/assignments') ?>" class="btn btn-block btn-lg" style="background: #2c5f2d; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-tasks fa-2x"></i><br>
                                    Review Assignments
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Editor Actions -->
                            <?php if(in_array($role, [13,14,15,16,17,18,20])): ?>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('editor/pending') ?>" class="btn btn-block btn-lg" style="background: #2c5f2d; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-clock-o fa-2x"></i><br>
                                    Pending Manuscripts
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('editor/all') ?>" class="btn btn-block btn-lg" style="background: #17a2b8; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-list fa-2x"></i><br>
                                    All Manuscripts
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Common Actions (Everyone) -->
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('profile') ?>" class="btn btn-block btn-lg" style="background: #ffc107; color: #333; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-user fa-2x"></i><br>
                                    My Profile
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('journal/current-issue') ?>" class="btn btn-block btn-lg" style="background: #6c757d; color: white; padding: 15px; border-radius: 10px; margin-bottom: 10px;">
                                    <i class="fa fa-book fa-2x"></i><br>
                                    Current Issue
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards (Role-Specific) -->
        <div class="row">
            
            <!-- Admin Stats -->
            <?php if($is_admin == 1): ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= $total_users ?? 0 ?></h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <a href="<?= base_url('userListing') ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= $total_manuscripts ?? 0 ?></h3>
                        <p>Total Manuscripts</p>
                    </div>
                    <div class="icon"><i class="fa fa-file-text"></i></div>
                    <a href="#" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Author Stats -->
            <?php if($role == 21): ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= $total_submissions ?? 0 ?></h3>
                        <p>My Submissions</p>
                    </div>
                    <div class="icon"><i class="fa fa-file-text"></i></div>
                    <a href="<?= base_url('author/manuscript') ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= $under_review ?? 0 ?></h3>
                        <p>Under Review</p>
                    </div>
                    <div class="icon"><i class="fa fa-clock-o"></i></div>
                    <a href="#" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= ($accepted ?? 0) + ($published ?? 0) ?></h3>
                        <p>Accepted/Published</p>
                    </div>
                    <div class="icon"><i class="fa fa-check-circle"></i></div>
                    <a href="#" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Reviewer Stats -->
            <?php if($role == 19): ?>
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-aqua" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= $pending_reviews ?? 0 ?></h3>
                        <p>Pending Reviews</p>
                    </div>
                    <div class="icon"><i class="fa fa-clock-o"></i></div>
                    <a href="#" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6">
                <div class="small-box bg-green" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= $completed_reviews ?? 0 ?></h3>
                        <p>Completed Reviews</p>
                    </div>
                    <div class="icon"><i class="fa fa-check-circle"></i></div>
                    <a href="#" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Editor Stats -->
            <?php if(in_array($role, [13,14,15,16,17,18,20])): ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= $pending_manuscripts ?? 0 ?></h3>
                        <p>Pending</p>
                    </div>
                    <div class="icon"><i class="fa fa-clock-o"></i></div>
                    <a href="#" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= $under_review_manuscripts ?? 0 ?></h3>
                        <p>Under Review</p>
                    </div>
                    <div class="icon"><i class="fa fa-refresh"></i></div>
                    <a href="#" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= $accepted_manuscripts ?? 0 ?></h3>
                        <p>Accepted</p>
                    </div>
                    <div class="icon"><i class="fa fa-check-circle"></i></div>
                    <a href="#" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php endif; ?>
            
            <!-- Common Stats (Everyone) -->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-primary" style="border-radius: 10px;">
                    <div class="inner">
                        <h3><?= $total_issues ?? 0 ?></h3>
                        <p>Journal Issues</p>
                    </div>
                    <div class="icon"><i class="fa fa-book"></i></div>
                    <a href="<?= base_url('journal/archive') ?>" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
        </div>

        <!-- Recent Activity (Role-Specific) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header with-border" style="background: #f8fafc; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title"><i class="fa fa-history" style="color: #2c5f2d;"></i> Recent Activity</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        
                        <!-- Admin Recent Activity -->
                        <?php if($is_admin == 1 && !empty($recent_users)): ?>
                        <h4>Recently Registered Users</h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Registered</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recent_users as $user): ?>
                                <tr>
                                    <td><?= $user->name ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $user->role ?></td>
                                    <td><?= date('d M Y', strtotime($user->createdDtm)) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                        
                        <!-- Author Recent Activity -->
                        <?php if($role == 21 && !empty($recent_manuscripts)): ?>
                        <h4>Recent Submissions</h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Manuscript #</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Submitted</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recent_manuscripts as $m): ?>
                                <tr>
                                    <td><strong><?= $m->manuscriptNumber ?></strong></td>
                                    <td><?= substr($m->title, 0, 50) ?>...</td>
                                    <td>
                                        <span class="label label-<?= $m->status == 'submitted' ? 'info' : ($m->status == 'accepted' ? 'success' : 'warning') ?>">
                                            <?= ucfirst($m->status) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d M Y', strtotime($m->createdDtm)) ?></td>
                                    <td>
                                        <a href="<?= base_url('author/manuscript/view/'.$m->manuscriptId) ?>" class="btn btn-xs btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                        
                        <!-- If no recent activity -->
                        <?php if(empty($recent_users) && empty($recent_manuscripts)): ?>
                        <div class="text-center" style="padding: 30px;">
                            <i class="fa fa-inbox" style="font-size: 3em; color: #ccc;"></i>
                            <h4>No recent activity</h4>
                            <p class="text-muted">Your recent activity will appear here</p>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quick Links (Role-Specific) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header with-border" style="background: #f8fafc; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title"><i class="fa fa-link" style="color: #2c5f2d;"></i> Useful Links</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <div class="row">
                            
                            <!-- Admin Links -->
                            <?php if($is_admin == 1): ?>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('roleListing') ?>" style="display: block; padding: 10px; color: #495057;">
                                    <i class="fa fa-tags"></i> Manage Roles
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Author Links -->
                            <?php if($role == 21): ?>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('journal/author-guidelines') ?>" style="display: block; padding: 10px; color: #495057;">
                                    <i class="fa fa-book"></i> Author Guidelines
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Reviewer Links -->
                            <?php if($role == 19): ?>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('journal/reviewer-guidelines') ?>" style="display: block; padding: 10px; color: #495057;">
                                    <i class="fa fa-gavel"></i> Review Guidelines
                                </a>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Common Links (Everyone) -->
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('profile') ?>" style="display: block; padding: 10px; color: #495057;">
                                    <i class="fa fa-user"></i> My Profile
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('changePassword') ?>" style="display: block; padding: 10px; color: #495057;">
                                    <i class="fa fa-key"></i> Change Password
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <a href="<?= base_url('journal/contact') ?>" style="display: block; padding: 10px; color: #495057;">
                                    <i class="fa fa-envelope"></i> Contact Support
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
</div>