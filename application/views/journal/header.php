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
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-logo {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.4);
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

<?php
$currentLanguage = isset($site_lang) ? $site_lang : 'en';
$languageOptions = array(
    'en' => 'English',
    'om' => 'Afaan Oromo',
    'am' => 'አማርኛ'
);

$uiText = array(
    'en' => array(
        'home' => 'Home',
        'about' => 'About',
        'about_journal' => 'About the Journal',
        'aims_scope' => 'Aims & Scope',
        'editorial_board' => 'Editorial Board',
        'issues' => 'Issues',
        'current_issue' => 'Current Issue',
        'archive' => 'Archive',
        'for_authors' => 'For Authors',
        'for_reviewers' => 'For Reviewers',
        'search' => 'Search',
        'contact' => 'Contact',
        'dashboard' => 'Dashboard',
        'profile' => 'Profile',
        'logout' => 'Logout',
        'login' => 'Login',
        'register' => 'Register',
        'author_login' => 'Author Login',
        'submit_manuscript' => 'Submit Manuscript',
        'motto' => '"Connecting Agriculture and Science for a Sustainable Future"',
        'language' => 'Language'
    ),
    'om' => array(
        'home' => 'Mana',
        'about' => 'Waa\'ee',
        'about_journal' => 'Waa\'ee Joornaalii',
        'aims_scope' => 'Kaayyoo fi Daangaa',
        'editorial_board' => 'Garee Editoraa',
        'issues' => 'Maxxansoota',
        'current_issue' => 'Maxxansa Ammaa',
        'archive' => 'Kuusaa',
        'for_authors' => 'Barreessitootaaf',
        'for_reviewers' => 'Qorattootaaf',
        'search' => 'Barbaadi',
        'contact' => 'Nu Quunnamaa',
        'dashboard' => 'Daashboordii',
        'profile' => 'Piroofaayilii',
        'logout' => 'Ba\'i',
        'login' => 'Seeni',
        'register' => 'Galmaa\'i',
        'author_login' => 'Seensa Barreessaa',
        'submit_manuscript' => 'Barreeffama Galchi',
        'motto' => '"Qonna fi Saayinsii Itti Walqabsiisnee Itti Fufiinsaaf"',
        'language' => 'Afaan'
    ),
    'am' => array(
        'home' => 'መነሻ',
        'about' => 'ስለ እኛ',
        'about_journal' => 'ስለ ጆርናሉ',
        'aims_scope' => 'ዓላማ እና ወሰን',
        'editorial_board' => 'የኤዲቶሪያል ቦርድ',
        'issues' => 'እትሞች',
        'current_issue' => 'የአሁኑ እትም',
        'archive' => 'ማህደር',
        'for_authors' => 'ለደራሲዎች',
        'for_reviewers' => 'ለገምጋሚዎች',
        'search' => 'ፈልግ',
        'contact' => 'ያግኙን',
        'dashboard' => 'ዳሽቦርድ',
        'profile' => 'መገለጫ',
        'logout' => 'ውጣ',
        'login' => 'ግባ',
        'register' => 'ይመዝገቡ',
        'author_login' => 'የደራሲ መግቢያ',
        'submit_manuscript' => 'ጽሁፍ አስገባ',
        'motto' => '"ግብርናን እና ሳይንስን ለዘላቂ ወደፊት ማገናኘት"',
        'language' => 'ቋንቋ'
    )
);

$text = isset($uiText[$currentLanguage]) ? $uiText[$currentLanguage] : $uiText['en'];
?>

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
                <img src="<?= base_url('assets/images/logo.jpg') ?>" alt="OJAS Logo" class="navbar-logo">
                <span>OJAS | IQQO</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="<?= (uri_string() == 'journal') ? 'active' : '' ?>">
                    <a href="<?= base_url('journal') ?>"><?= $text['home'] ?></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $text['about'] ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('journal/about') ?>"><?= $text['about_journal'] ?></a></li>
                        <li><a href="<?= base_url('journal/aims-scope') ?>"><?= $text['aims_scope'] ?></a></li>
                        <li><a href="<?= base_url('journal/editorial-board') ?>"><?= $text['editorial_board'] ?></a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $text['issues'] ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('journal/current-issue') ?>"><?= $text['current_issue'] ?></a></li>
                        <li><a href="<?= base_url('journal/archive') ?>"><?= $text['archive'] ?></a></li>
                    </ul>
                </li>
                <li><a href="<?= base_url('journal/search') ?>"><i class="fa fa-search"></i> <?= $text['search'] ?></a></li>
                <li><a href="<?= base_url('journal/contact') ?>"><?= $text['contact'] ?></a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <?php if($this->session->userdata('isLoggedIn')): ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> <?= $this->session->userdata('name') ?> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> <?= $text['dashboard'] ?></a></li>
                        <li><a href="<?= base_url('profile') ?>"><i class="fa fa-user-circle"></i> <?= $text['profile'] ?></a></li>
                        <li class="divider"></li>
                        <li><a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out"></i> <?= $text['logout'] ?></a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li><a href="<?= base_url('login') ?>" class="btn-outline-ojas" style="padding: 8px 20px; margin-top: 8px;"><i class="fa fa-sign-in"></i> <?= $text['login'] ?></a></li>
                <li><a href="<?= base_url('register') ?>" class="btn-ojas" style="padding: 8px 20px; margin-top: 8px; margin-left: 5px;"><i class="fa fa-user-plus"></i> <?= $text['register'] ?></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Journal Header -->
<div class="journal-header">
    <div class="container">
        <h1>Oromia Journal of Agricultural Sciences</h1>
        <p class="motto"><?= $text['motto'] ?></p>
        <p>ISSN: XXXXX-XXXX | Open Access | Peer-Reviewed</p>
        <img src="<?= base_url('assets/images/logo.jpg') ?>" alt="OJAS Official Logo" style="width: 90px; height: 90px; border-radius: 50%; border: 3px solid rgba(255,255,255,0.4); margin-top: 10px; box-shadow: 0 8px 20px rgba(0,0,0,0.2);">
        
        <div class="auth-buttons">
            <?php if(!$this->session->userdata('isLoggedIn')): ?>
            <a href="<?= base_url('login') ?>" class="btn btn-lg btn-outline-ojas"><?= $text['author_login'] ?></a>
            <a href="<?= base_url('register') ?>" class="btn btn-lg btn-ojas"><?= $text['submit_manuscript'] ?></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Main Content Container -->
<div class="container">
