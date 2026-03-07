<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2c5f2d;
            --secondary-color: #97bc62;
            --accent-color: #ffc857;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar-custom {
            background-color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white;
        }
        
        .navbar-custom .nav-link:hover {
            color: var(--accent-color);
        }
        
        .journal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .journal-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .journal-header .motto {
            font-size: 1.2rem;
            opacity: 0.9;
            font-style: italic;
        }
        
        .footer {
            background-color: #343a40;
            color: white;
            padding: 3rem 0 2rem;
            margin-top: 4rem;
        }
        
        .footer a {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .footer a:hover {
            color: var(--accent-color);
        }
        
        .article-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            transition: transform 0.2s, box-shadow 0.2s;
            margin-bottom: 1.5rem;
            padding: 1.5rem;
        }
        
        .article-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0,0,0,.15);
        }
        
        .article-meta {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .article-meta i {
            margin-right: 0.3rem;
        }
        
        .btn-ojas {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        
        .btn-ojas:hover {
            background-color: var(--secondary-color);
            color: white;
        }
        
        .badge-ojas {
            background-color: var(--accent-color);
            color: #333;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url('journal'); ?>">
                <img src="<?php echo base_url('assets/images/logo200.jpg'); ?>" alt="IQQO" height="40" class="d-inline-block align-top">
                <span class="ms-2">OJAS</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('journal'); ?>">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown">
                            About
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url('journal/about'); ?>">About the Journal</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('journal/aims_scope'); ?>">Aims & Scope</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('journal/editorial_board'); ?>">Editorial Board</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="issuesDropdown" role="button" data-bs-toggle="dropdown">
                            Issues
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url('journal/current_issue'); ?>">Current Issue</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('journal/archive'); ?>">Archive</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="authorsDropdown" role="button" data-bs-toggle="dropdown">
                            For Authors
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url('journal/author_guidelines'); ?>">Author Guidelines</a></li>
                            <li><a class="dropdown-item" href="<?php echo base_url('author/manuscript/submit'); ?>">Submit Manuscript</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('journal/reviewer_guidelines'); ?>">For Reviewers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('journal/search'); ?>">
                            <i class="fas fa-search"></i> Search
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('journal/contact'); ?>">Contact</a>
                    </li>
                    <?php if($this->session->userdata('logged_in')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> <?php echo $this->session->userdata('name'); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('Login'); ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('Login'); ?>">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Page Header (if needed) -->
    <?php if(isset($show_header) && $show_header !== false): ?>
    <div class="journal-header">
        <div class="container text-center">
            <h1>Oromia Journal of Agricultural Sciences</h1>
            <p class="motto">"Connecting Agriculture and Science for a Sustainable Future"</p>
            <p class="mt-3">ISSN: XXXXX-XXXX | Open Access | Peer-Reviewed</p>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Main Content -->
    <div class="container min-vh-100">