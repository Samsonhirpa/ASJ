<aside class="main-sidebar">
    <section class="sidebar">
        
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php 
                $profileImage = !empty($profile_image) ? base_url('uploads/profile_images/'.$profile_image) : base_url('assets/dist/img/avatar-default.png');
                ?>
                <img src="<?= $profileImage ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $name ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        
        <!-- Search form -->
        <form action="<?= base_url('journal/search') ?>" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            
            <!-- Dashboard - Everyone sees this -->
            <li class="<?= (isset($activeMenu) && $activeMenu == 'dashboard') ? 'active' : '' ?>">
                <a href="<?= base_url($this->getDashboardUrl()) ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <!-- ========== SYSTEM ADMIN MENU (isAdmin = 1) ========== -->
            <?php if($is_admin == 1): ?>
            <li class="header">ADMINISTRATION</li>
            
            <li class="treeview <?= (isset($activeMenu) && in_array($activeMenu, ['users', 'roles', 'adduser'])) ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-users"></i> <span>User Management</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= (isset($activeMenu) && $activeMenu == 'users') ? 'active' : '' ?>">
                        <a href="<?= base_url('userListing') ?>"><i class="fa fa-list"></i> All Users</a>
                    </li>
                    <li class="<?= (isset($activeMenu) && $activeMenu == 'adduser') ? 'active' : '' ?>">
                        <a href="<?= base_url('addNew') ?>"><i class="fa fa-plus-circle"></i> Add New User</a>
                    </li>
                    <li class="<?= (isset($activeMenu) && $activeMenu == 'roles') ? 'active' : '' ?>">
                        <a href="<?= base_url('roleListing') ?>"><i class="fa fa-tags"></i> Roles & Permissions</a>
                    </li>
                </ul>
            </li>
            
            <li>
                <a href="<?= base_url('admin/settings') ?>">
                    <i class="fa fa-cogs"></i> <span>System Settings</span>
                </a>
            </li>
            <?php endif; ?>
            
            <!-- ========== AUTHOR MENU (roleId = 21) ========== -->
            <?php if($role == 21): ?>
            <li class="header">AUTHOR ZONE</li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'submissions') ? 'active' : '' ?>">
                <a href="<?= base_url('author/manuscript') ?>">
                    <i class="fa fa-file-text"></i> <span>My Submissions</span>
                    <?php
                    // You can add a count of pending items if needed
                    // $pendingCount = $this->manuscript_model->countPendingByAuthor($vendorId);
                    // if($pendingCount > 0):
                    ?>
                    <!-- <span class="pull-right-container">
                        <small class="label pull-right bg-yellow"><?= $pendingCount ?></small>
                    </span> -->
                    <?php // endif; ?>
                </a>
            </li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'newsubmission') ? 'active' : '' ?>">
                <a href="<?= base_url('author/manuscript/submit') ?>">
                    <i class="fa fa-upload"></i> <span>New Submission</span>
                </a>
            </li>
            <?php endif; ?>
            
            <!-- ========== REVIEWER MENU (roleId = 19) ========== -->
            <?php if($role == 19): ?>
            <li class="header">REVIEWER ZONE</li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'assignments') ? 'active' : '' ?>">
                <a href="<?= base_url('reviewer/assignments') ?>">
                    <i class="fa fa-tasks"></i> <span>Review Assignments</span>
                    <?php
                    // You can add pending count
                    // $pendingReviews = $this->review_model->countPending($vendorId);
                    // if($pendingReviews > 0):
                    ?>
                    <!-- <span class="pull-right-container">
                        <small class="label pull-right bg-yellow"><?= $pendingReviews ?></small>
                    </span> -->
                    <?php // endif; ?>
                </a>
            </li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'completed') ? 'active' : '' ?>">
                <a href="<?= base_url('reviewer/completed') ?>">
                    <i class="fa fa-check-circle"></i> <span>Completed Reviews</span>
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('reviewer/guidelines') ?>">
                    <i class="fa fa-book"></i> <span>Review Guidelines</span>
                </a>
            </li>
            <?php endif; ?>
            
            <!-- ========== EDITOR MENU (Editorial Roles) ========== -->
            <?php if(in_array($role, [13,14,15,16,17,18,20])): ?>
            <li class="header">EDITORIAL ZONE</li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'pending') ? 'active' : '' ?>">
                <a href="<?= base_url('editor/pending') ?>">
                    <i class="fa fa-clock-o"></i> <span>Pending Manuscripts</span>
                    <?php
                    // You can add pending count
                    // $pendingManuscripts = $this->manuscript_model->countPending();
                    // if($pendingManuscripts > 0):
                    ?>
                    <!-- <span class="pull-right-container">
                        <small class="label pull-right bg-red"><?= $pendingManuscripts ?></small>
                    </span> -->
                    <?php // endif; ?>
                </a>
            </li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'allmanuscripts') ? 'active' : '' ?>">
                <a href="<?= base_url('editor/all') ?>">
                    <i class="fa fa-list"></i> <span>All Manuscripts</span>
                </a>
            </li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'reviewprogress') ? 'active' : '' ?>">
                <a href="<?= base_url('editor/assignments') ?>">
                    <i class="fa fa-line-chart"></i> <span>Track Review Progress</span>
                </a>
            </li>

            <li class="<?= (isset($activeMenu) && $activeMenu == 'payment') ? 'active' : '' ?>">
                <a href="<?= base_url('editor/payment') ?>">
                    <i class="fa fa-money"></i> <span>Payment Menu</span>
                </a>
            </li>
            
            <?php if($role == 13): // Editor-in-Chief only ?>
            <li class="<?= (isset($activeMenu) && $activeMenu == 'editorboard') ? 'active' : '' ?>">
                <a href="<?= base_url('editor/board') ?>">
                    <i class="fa fa-address-card"></i> <span>Editorial Board</span>
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('editor/ethics') ?>">
                    <i class="fa fa-gavel"></i> <span>Ethics Cases</span>
                </a>
            </li>
            <?php endif; ?>
            
            <?php if($role == 20): // Guest Editor ?>
            <li class="<?= (isset($activeMenu) && $activeMenu == 'specialissues') ? 'active' : '' ?>">
                <a href="<?= base_url('editor/special-issues') ?>">
                    <i class="fa fa-star"></i> <span>Special Issues</span>
                </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>
            
            <!-- ========== COMMON JOURNAL MENU - Everyone sees ========== -->
            <li class="header">JOURNAL</li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'currentissue') ? 'active' : '' ?>">
                <a href="<?= base_url('journal/current-issue') ?>">
                    <i class="fa fa-book"></i> <span>Current Issue</span>
                </a>
            </li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'archive') ? 'active' : '' ?>">
                <a href="<?= base_url('journal/archive') ?>">
                    <i class="fa fa-archive"></i> <span>All Issues</span>
                </a>
            </li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'search') ? 'active' : '' ?>">
                <a href="<?= base_url('journal/search') ?>">
                    <i class="fa fa-search"></i> <span>Search Articles</span>
                </a>
            </li>
            
            <!-- About Journal Dropdown -->
            <li class="treeview <?= (isset($activeMenu) && in_array($activeMenu, ['about', 'editorialboard', 'aims', 'guidelines'])) ? 'active' : '' ?>">
                <a href="#">
                    <i class="fa fa-info-circle"></i> <span>About Journal</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('journal/about') ?>"><i class="fa fa-info"></i> About OJAS</a></li>
                    <li><a href="<?= base_url('journal/aims-scope') ?>"><i class="fa fa-bullseye"></i> Aims & Scope</a></li>
                    <li><a href="<?= base_url('journal/editorial-board') ?>"><i class="fa fa-users"></i> Editorial Board</a></li>
                    <li><a href="<?= base_url('journal/author-guidelines') ?>"><i class="fa fa-pencil"></i> Author Guidelines</a></li>
                    <li><a href="<?= base_url('journal/reviewer-guidelines') ?>"><i class="fa fa-eye"></i> Reviewer Guidelines</a></li>
                </ul>
            </li>
            
            <!-- ========== USER MENU - Everyone sees ========== -->
            <li class="header">USER</li>
            
            <li class="<?= (isset($activeMenu) && $activeMenu == 'profile') ? 'active' : '' ?>">
                <a href="<?= base_url('profile') ?>">
                    <i class="fa fa-user-circle"></i> <span>My Profile</span>
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('changePassword') ?>">
                    <i class="fa fa-key"></i> <span>Change Password</span>
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('logout') ?>">
                    <i class="fa fa-sign-out"></i> <span>Logout</span>
                </a>
            </li>
            
            <!-- Help & Support -->
            <li class="header">SUPPORT</li>
            
            <li>
                <a href="<?= base_url('journal/contact') ?>">
                    <i class="fa fa-envelope"></i> <span>Contact Us</span>
                </a>
            </li>
            
            <li>
                <a href="<?= base_url('faq') ?>">
                    <i class="fa fa-question-circle"></i> <span>FAQ</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
