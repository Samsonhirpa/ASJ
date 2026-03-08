<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?> | OJAS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Custom CSS for OJAS Public -->
    <style>
        :root {
            --primary-color: #2c5f2d;
            --secondary-color: #97bc62;
            --accent-color: #ffc857;
        }
        
        body {
            font-family: 'Poppins', 'Source Sans Pro', sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar-ojas {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3e7c40 100%);
            border: none;
            border-radius: 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-ojas .navbar-brand {
            color: white;
            font-weight: 600;
            padding: 15px 20px;
        }
        
        .navbar-ojas .navbar-brand:hover {
            color: var(--accent-color);
        }
        
        .navbar-ojas .navbar-nav > li > a {
            color: white;
            font-weight: 500;
            padding: 15px 20px;
            transition: all 0.3s ease;
        }
        
        .navbar-ojas .navbar-nav > li > a:hover {
            background: rgba(255,255,255,0.1);
            color: var(--accent-color);
        }
        
        .navbar-ojas .navbar-nav > .active > a {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        
        .journal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
            text-align: center;
        }
        
        .journal-header h1 {
            font-size: 3em;
            font-weight: 700;
            margin-bottom: 15px;
        }
        
        .journal-header .motto {
            font-size: 1.3em;
            opacity: 0.9;
            font-style: italic;
        }
        
        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0 20px;
            margin-top: 60px;
        }
        
        .footer a {
            color: var(--accent-color);
            text-decoration: none;
        }
        
        .footer a:hover {
            color: white;
        }
        
        .btn-ojas {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .btn-ojas:hover {
            background-color: var(--secondary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44,95,45,0.3);
        }
        
        .btn-outline-ojas {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .btn-outline-ojas:hover {
            background: var(--primary-color);
            color: white;
        }
        
        .article-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 25px;
            transition: transform 0.3s ease;
        }
        
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        
        .auth-buttons {
            margin-top: 10px;
        }
        
        .auth-buttons .btn {
            margin: 0 5px;
        }
    </style>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-ojas">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>journal">
                <i class="fa fa-leaf"></i> OJAS | IQQO
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?= (uri_string() == 'journal') ? 'active' : '' ?>">
                    <a href="<?= base_url('journal') ?>">Home</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">About <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('journal/about') ?>">About the Journal</a></li>
                        <li><a href="<?= base_url('journal/aims-scope') ?>">Aims & Scope</a></li>
                        <li><a href="<?= base_url('journal/editorial-board') ?>">Editorial Board</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Issues <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('journal/current-issue') ?>">Current Issue</a></li>
                        <li><a href="<?= base_url('journal/archive') ?>">Archive</a></li>
                    </ul>
                </li>
                <li><a href="<?= base_url('journal/author-guidelines') ?>">For Authors</a></li>
                <li><a href="<?= base_url('journal/reviewer-guidelines') ?>">For Reviewers</a></li>
                <li><a href="<?= base_url('journal/search') ?>"><i class="fa fa-search"></i> Search</a></li>
                <li><a href="<?= base_url('journal/contact') ?>">Contact</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <?php if($this->session->userdata('isLoggedIn')): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> <?= $this->session->userdata('name') ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a href="<?= base_url('profile') ?>"><i class="fa fa-user-circle"></i> Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li><a href="<?= base_url('login') ?>" class="btn-outline-ojas" style="padding: 8px 20px; margin-top: 8px;"><i class="fa fa-sign-in"></i> Login</a></li>
                <li><a href="<?= base_url('register') ?>" class="btn-ojas" style="padding: 8px 20px; margin-top: 8px; margin-left: 5px;"><i class="fa fa-user-plus"></i> Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Journal Header -->
<div class="journal-header">
    <div class="container">
        <h1>Oromia Journal of Agricultural Sciences</h1>
        <p class="motto">"Connecting Agriculture and Science for a Sustainable Future"</p>
        <p>ISSN: XXXXX-XXXX | Open Access | Peer-Reviewed</p>
        
        <div class="auth-buttons">
            <?php if(!$this->session->userdata('isLoggedIn')): ?>
            <a href="<?= base_url('login') ?>" class="btn btn-lg btn-outline-ojas">Author Login</a>
            <a href="<?= base_url('register') ?>" class="btn btn-lg btn-ojas">Submit Manuscript</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Main Content Container -->
<div class="container">