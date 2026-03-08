<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $pageTitle; ?> | OJAS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Custom CSS for OJAS - WIDER SIDEBAR -->
    <style>
        :root {
            --primary-color: #2c5f2d;
            --primary-dark: #1e4b1f;
            --primary-light: #e8f0e8;
            --accent-color: #ffc857;
            --sidebar-width: 280px;  /* Increased from default 230px */
        }
        
        .error {
            color: #dc3545;
            font-weight: normal;
        }
        
        /* Custom Skin - OJAS Green */
        .skin-ojas .main-header .logo {
            background-color: var(--primary-color);
            color: #fff;
            border-bottom: 0 solid transparent;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            font-weight: 600;
            transition: all 0.3s ease;
            width: var(--sidebar-width);  /* Match sidebar width */
        }
        
        .skin-ojas .main-header .logo:hover {
            background-color: var(--primary-dark);
        }
        
        .skin-ojas .main-header .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3e7c40 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-left: var(--sidebar-width);  /* Match sidebar width */
        }
        
        /* WIDER SIDEBAR - Main modification */
        .skin-ojas .main-sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #1a2634 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            width: var(--sidebar-width);
        }
        
        /* Content wrapper adjustment */
        .skin-ojas .content-wrapper,
        .skin-ojas .right-side,
        .skin-ojas .main-footer {
            margin-left: var(--sidebar-width);
        }
        
        /* Sidebar toggle for mobile */
        @media (max-width: 767px) {
            .skin-ojas .main-sidebar {
                transform: translateX(-var(--sidebar-width));
            }
            .skin-ojas .content-wrapper,
            .skin-ojas .right-side,
            .skin-ojas .main-footer {
                margin-left: 0;
            }
        }
        
        /* User panel in sidebar */
        .skin-ojas .user-panel {
            padding: 20px 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .skin-ojas .user-panel .image img {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border: 3px solid var(--primary-color);
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        
        .skin-ojas .user-panel .info {
            left: 75px;
            padding: 7px 0;
        }
        
        .skin-ojas .user-panel .info p {
            color: #fff;
            margin: 0 0 5px;
            font-weight: 500;
            font-size: 1.1em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 160px;
        }
        
        .skin-ojas .user-panel .info a {
            color: var(--accent-color);
            font-size: 0.9em;
        }
        
        .skin-ojas .sidebar-menu > li.header {
            color: #95a5a6;
            background: transparent;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9em;
            letter-spacing: 1px;
            padding: 15px 25px 5px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .skin-ojas .sidebar-menu > li > a {
            color: #ecf0f1;
            font-weight: 500;
            padding: 15px 25px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            font-size: 1.05em;
        }
        
        .skin-ojas .sidebar-menu > li > a:hover {
            background: rgba(255,255,255,0.05);
            border-left-color: var(--primary-color);
            padding-left: 30px;
        }
        
        .skin-ojas .sidebar-menu > li.active > a {
            background: rgba(44,95,45,0.2);
            border-left-color: var(--primary-color);
            color: #fff;
            font-weight: 600;
        }
        
        .skin-ojas .sidebar-menu > li > a > i {
            color: var(--primary-color);
            width: 30px;
            text-align: center;
            margin-right: 12px;
            font-size: 1.3em;
        }
        
        .skin-ojas .sidebar-menu .treeview-menu {
            background: rgba(0,0,0,0.2);
            padding: 5px 0;
        }
        
        .skin-ojas .sidebar-menu .treeview-menu > li > a {
            color: #bdc3c7;
            padding: 12px 15px 12px 55px;
            transition: all 0.3s ease;
            font-size: 0.98em;
        }
        
        .skin-ojas .sidebar-menu .treeview-menu > li > a:hover {
            color: #fff;
            background: rgba(255,255,255,0.05);
            padding-left: 60px;
        }
        
        .skin-ojas .sidebar-menu .treeview-menu > li > a > i {
            color: var(--primary-color);
            width: 22px;
            font-size: 1em;
        }
        
        /* User menu in header */
        .user-menu .dropdown-menu {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.2);
            border: none;
            overflow: hidden;
            width: 300px;
        }
        
        .user-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3e7c40 100%);
            padding: 25px !important;
        }
        
        .user-header > img {
            border: 3px solid #fff;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
            width: 100px !important;
            height: 100px !important;
            object-fit: cover;
            border-radius: 50%;
        }
        
        .user-header > p {
            color: #fff;
            margin-top: 15px;
            font-size: 1.1em;
        }
        
        .user-header > p > small {
            color: rgba(255,255,255,0.8);
            display: block;
            margin-top: 5px;
            font-size: 0.9em;
        }
        
        .user-footer {
            background: #f8f9fa;
            padding: 15px 25px;
        }
        
        .user-footer .btn {
            border-radius: 20px;
            padding: 6px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .user-footer .btn-warning {
            background: var(--accent-color);
            border: none;
            color: #333;
        }
        
        .user-footer .btn-warning:hover {
            background: #ffb83b;
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(255,200,87,0.3);
        }
        
        .user-footer .btn-default {
            background: #e9ecef;
            border: none;
            color: #495057;
        }
        
        .user-footer .btn-default:hover {
            background: #dee2e6;
            transform: translateY(-2px);
        }
        
        /* Header user image */
        .navbar-custom-menu .user-menu .user-image {
            width: 30px;
            height: 30px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.5);
            margin-right: 5px;
        }
        
        /* Tasks menu */
        .tasks-menu .dropdown-menu {
            width: 280px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.2);
            border: none;
        }
        
        .tasks-menu .header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3e7c40 100%);
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px 20px;
            font-size: 1em;
            border: none;
        }
        
        .logo-lg {
            font-size: 1.5em;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 230px;
        }
        
        .logo-lg b {
            color: var(--accent-color);
            font-weight: 700;
        }
        
        .logo-mini {
            font-size: 1.3em;
            font-weight: 600;
        }
        
        /* Custom scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.05);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 5px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
        
        /* Badge styles */
        .label-ojas {
            background: var(--primary-color);
            color: white;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 0.8em;
        }
        
        /* Animation for sidebar items */
        .sidebar-menu > li {
            animation: slideIn 0.5s ease forwards;
            opacity: 0;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Active menu highlighting */
        .sidebar-menu > li.active > a {
            background: rgba(44,95,45,0.3);
            border-left-color: var(--accent-color);
        }
        
        .sidebar-menu .treeview-menu > li.active > a {
            color: #fff;
            background: rgba(255,255,255,0.1);
        }
    </style>
    
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    
    <!-- HTML5 Shim and Respond.js -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap">
    <style>
        body {
            font-family: 'Poppins', 'Source Sans Pro', sans-serif;
        }
    </style>
  </head>
  
  <body class="hold-transition skin-ojas sidebar-mini">
    <div class="wrapper">
      
      <!-- Header -->
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>dashboard" class="logo">
          <!-- mini logo for sidebar mini -->
          <span class="logo-mini"><i class="fa fa-leaf"></i></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>OJAS</b> | IQQO</span>
        </a>
        
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <i class="fa fa-bars"></i>
          </a>
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              <!-- Last Login Info -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                  <i class="fa fa-clock-o"></i>
                  <span class="label label-ojas">Last</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header"> 
                    <i class="fa fa-history"></i> 
                    <?= empty($last_login) ? "First Time Login" : date('d M Y H:i', strtotime($last_login)); ?>
                  </li>
                </ul>
              </li>
              
              <!-- User Account - WITH PROFILE PICTURE -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php 
                  // Get profile image path
                  $profileImage = !empty($profile_image) ? base_url('uploads/profile_images/'.$profile_image) : base_url('assets/dist/img/avatar-default.png');
                  ?>
                  <img src="<?php echo $profileImage; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image - LARGE PROFILE PICTURE -->
                  <li class="user-header">
                    <img src="<?php echo $profileImage; ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text; ?></small>
                      <?php if(!empty($institution)): ?>
                      <small style="margin-top: 5px;"><i class="fa fa-building"></i> <?php echo $institution; ?></small>
                      <?php endif; ?>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>profile" class="btn btn-warning btn-flat">
                        <i class="fa fa-user-circle"></i> Profile
                      </a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">
                        <i class="fa fa-sign-out"></i> Sign out
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      
      <!-- Left side column - WIDER SIDEBAR with PROFILE PICTURE -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          
          <!-- Sidebar user panel - WITH PROFILE PICTURE -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $profileImage; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $name; ?></p>
              <a href="#">
                <i class="fa fa-circle text-success" style="color: #2ecc71;"></i> Online
              </a>
            </div>
          </div>
          
          <!-- Search form -->
          <form action="<?php echo base_url(); ?>journal/search" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search articles...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
          
          <!-- ========== SIDEBAR MENU - ROLE BASED ========== -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            
            <!-- Dashboard - Everyone sees this -->
            <li class="<?php echo (uri_string() == 'dashboard' || uri_string() == 'author/dashboard' || uri_string() == 'reviewer/dashboard' || uri_string() == 'editor/dashboard') ? 'active' : ''; ?>">
              <a href="<?php 
                // Role-based dashboard URL
                if($role == 21) echo base_url('author/dashboard');
                elseif($role == 19) echo base_url('reviewer/dashboard');
                elseif(in_array($role, [13,14,15,16,17,18,20])) echo base_url('editor/dashboard');
                else echo base_url('dashboard');
              ?>">
                <i class="fa fa-dashboard"></i> 
                <span>Dashboard</span>
              </a>
            </li>
            
            <!-- ========== SYSTEM ADMIN MENU (is_admin == 1) ========== -->
            <?php if($is_admin == 1): ?>
            <li class="header">ADMINISTRATION</li>
            
            <li class="treeview <?php echo (uri_string() == 'userListing' || uri_string() == 'addNew' || uri_string() == 'roleListing') ? 'active' : ''; ?>">
              <a href="#">
                <i class="fa fa-users"></i> 
                <span>User Management</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
              </a>
              <ul class="treeview-menu">
                <li class="<?php echo (uri_string() == 'userListing') ? 'active' : ''; ?>">
                  <a href="<?php echo base_url(); ?>userListing"><i class="fa fa-list"></i> All Users</a>
                </li>
                <li class="<?php echo (uri_string() == 'addNew') ? 'active' : ''; ?>">
                  <a href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus-circle"></i> Add New User</a>
                </li>
                <li class="<?php echo (uri_string() == 'roleListing') ? 'active' : ''; ?>">
                  <a href="<?php echo base_url(); ?>roleListing"><i class="fa fa-tags"></i> Roles & Permissions</a>
                </li>
              </ul>
            </li>
            
            <li>
              <a href="<?php echo base_url(); ?>admin/settings">
                <i class="fa fa-cogs"></i> <span>System Settings</span>
              </a>
            </li>
            <?php endif; ?>
            
            <!-- ========== AUTHOR MENU (role == 21) ========== -->
            <?php if($role == 21): ?>
            <li class="header">AUTHOR ZONE</li>
            
            <li class="<?php echo (uri_string() == 'author/manuscript') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>author/manuscript">
                <i class="fa fa-file-text"></i> 
                <span>My Submissions</span>
              </a>
            </li>
            
            <li class="<?php echo (uri_string() == 'author/manuscript/submit') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>author/manuscript/submit">
                <i class="fa fa-upload"></i> 
                <span>New Submission</span>
              </a>
            </li>
            <?php endif; ?>
            
            <!-- ========== REVIEWER MENU (role == 19) ========== -->
            <?php if($role == 19): ?>
            <li class="header">REVIEWER ZONE</li>
            
            <li class="<?php echo (uri_string() == 'reviewer/assignments') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>reviewer/assignments">
                <i class="fa fa-tasks"></i> 
                <span>Review Assignments</span>
              </a>
            </li>
            
            <li>
              <a href="<?php echo base_url(); ?>reviewer/guidelines">
                <i class="fa fa-book"></i> 
                <span>Review Guidelines</span>
              </a>
            </li>
            <?php endif; ?>
            
            <!-- ========== EDITOR MENU (Editorial Roles) ========== -->
            <?php if(in_array($role, [13,14,15,16,17,18,20])): ?>
            <li class="header">EDITORIAL ZONE</li>
            
            <li class="<?php echo (uri_string() == 'editor/pending') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>editor/pending">
                <i class="fa fa-clock-o"></i> 
                <span>Pending Manuscripts</span>
              </a>
            </li>
            
            <li class="<?php echo (uri_string() == 'editor/all') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>editor/all">
                <i class="fa fa-list"></i> 
                <span>All Manuscripts</span>
              </a>
            </li>
            
            <li class="<?php echo (uri_string() == 'editor/assignments') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>editor/assignments">
                <i class="fa fa-users"></i> 
                <span>Reviewer Assignments</span>
              </a>
            </li>
            
            <!-- Editor-in-Chief only menus -->
            <?php if($role == 13): ?>
            <li class="<?php echo (uri_string() == 'editor/board') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>editor/board">
                <i class="fa fa-address-card"></i> 
                <span>Editorial Board</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>editor/ethics">
                <i class="fa fa-gavel"></i> 
                <span>Ethics Cases</span>
              </a>
            </li>
            <?php endif; ?>
            
            <!-- Guest Editor only menus -->
            <?php if($role == 20): ?>
            <li class="<?php echo (uri_string() == 'editor/special-issues') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>editor/special-issues">
                <i class="fa fa-star"></i> 
                <span>Special Issues</span>
              </a>
            </li>
            <?php endif; ?>
            <?php endif; ?>
            
            <!-- ========== JOURNAL MANAGEMENT (Common for all) ========== -->
            <li class="header">JOURNAL</li>
            
            <li class="<?php echo (uri_string() == 'journal/current-issue') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>journal/current-issue">
                <i class="fa fa-book"></i> 
                <span>Current Issue</span>
              </a>
            </li>
            
            <li class="<?php echo (uri_string() == 'journal/archive') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>journal/archive">
                <i class="fa fa-archive"></i> 
                <span>All Issues</span>
              </a>
            </li>
            
            <li class="treeview <?php echo (uri_string() == 'journal/about' || uri_string() == 'journal/aims-scope' || uri_string() == 'journal/editorial-board') ? 'active' : ''; ?>">
              <a href="#">
                <i class="fa fa-info-circle"></i> 
                <span>About Journal</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>journal/about"><i class="fa fa-info"></i> About OJAS</a></li>
                <li><a href="<?php echo base_url(); ?>journal/aims-scope"><i class="fa fa-bullseye"></i> Aims & Scope</a></li>
                <li><a href="<?php echo base_url(); ?>journal/editorial-board"><i class="fa fa-users"></i> Editorial Board</a></li>
                <li><a href="<?php echo base_url(); ?>journal/author-guidelines"><i class="fa fa-pencil"></i> Author Guidelines</a></li>
                <li><a href="<?php echo base_url(); ?>journal/reviewer-guidelines"><i class="fa fa-eye"></i> Reviewer Guidelines</a></li>
              </ul>
            </li>
            
            <!-- ========== BOOKING & TASKS (If access) ========== -->
            <?php if($is_admin == 1 || (isset($access_info['Booking']) && ($access_info['Booking']['list'] == 1 || $access_info['Booking']['total_access'] == 1))): ?>
            <li class="<?php echo (uri_string() == 'booking') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>booking">
                <i class="fa fa-calendar"></i> 
                <span>Booking</span>
              </a>
            </li>
            <?php endif; ?>
            
            <?php if($is_admin == 1 || (isset($access_info['Task']) && ($access_info['Task']['list'] == 1 || $access_info['Task']['total_access'] == 1))): ?>
            <li class="<?php echo (uri_string() == 'task') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>task">
                <i class="fa fa-tasks"></i> 
                <span>Tasks</span>
              </a>
            </li>
            <?php endif; ?>
            
            <!-- ========== REPORTS SECTION ========== -->
            <li class="header">REPORTS</li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> 
                <span>Analytics</span>
                <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-file-pdf-o"></i> Annual Report</a></li>
                <li><a href="#"><i class="fa fa-file-excel-o"></i> Export Data</a></li>
                <li><a href="#"><i class="fa fa-line-chart"></i> Statistics</a></li>
              </ul>
            </li>
            
            <!-- ========== USER SETTINGS ========== -->
            <li class="header">USER</li>
            
            <li class="<?php echo (uri_string() == 'profile') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>profile">
                <i class="fa fa-user-circle"></i> 
                <span>My Profile</span>
              </a>
            </li>
            
            <li class="<?php echo (uri_string() == 'changePassword') ? 'active' : ''; ?>">
              <a href="<?php echo base_url(); ?>changePassword">
                <i class="fa fa-key"></i> 
                <span>Change Password</span>
              </a>
            </li>
            
            <li>
              <a href="<?php echo base_url(); ?>logout">
                <i class="fa fa-sign-out"></i> 
                <span>Logout</span>
              </a>
            </li>
            
            <!-- Help & Support -->
            <li class="header">SUPPORT</li>
            
            <li>
              <a href="<?php echo base_url(); ?>journal/contact">
                <i class="fa fa-envelope"></i> 
                <span>Contact Us</span>
              </a>
            </li>
            
            <li>
              <a href="<?php echo base_url(); ?>faq">
                <i class="fa fa-question-circle"></i> 
                <span>FAQ</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>