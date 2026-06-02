<!DOCTYPE html>
<html lang="<?= $site_lang ?? 'en' ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($title) ? htmlspecialchars($title) : 'OJAS' ?> | Oromia Journal of Agricultural Sciences</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes">
    
    <!-- Bootstrap 5 + Icons + Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        :root {
            --primary: #0f3b2c;
            --primary-dark: #0a2a1f;
            --secondary: #2c7a4d;
            --accent: #ffc857;
            --light-bg: #f9fafb;
        }
        body {
            background-color: var(--light-bg);
            color: #1e293b;
        }
        /* Modern Navbar */
        .navbar-ojas {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 0.8rem 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.2s;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: white !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .navbar-logo {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(255,255,255,0.3);
        }
        .navbar-nav .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            padding: 0.6rem 1rem;
            transition: 0.2s;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: white !important;
            background: rgba(255,255,255,0.12);
            border-radius: 40px;
        }
        .dropdown-menu {
            border-radius: 16px;
            border: none;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
            margin-top: 8px;
        }
        .dropdown-item:hover {
            background-color: #eef2f0;
            color: var(--primary);
        }
        .btn-outline-light-nav {
            border: 1px solid rgba(255,255,255,0.5);
            background: transparent;
            color: white;
            border-radius: 40px;
            padding: 0.4rem 1.2rem;
            transition: 0.2s;
        }
        .btn-outline-light-nav:hover {
            background: white;
            color: var(--primary);
        }
        .btn-submit-nav {
            background: white;
            color: var(--primary);
            border-radius: 40px;
            padding: 0.4rem 1.2rem;
            font-weight: 600;
            transition: 0.2s;
        }
        .btn-submit-nav:hover {
            background: var(--accent);
            color: var(--primary-dark);
            transform: translateY(-2px);
        }
        /* Language switcher */
        .lang-dropdown .dropdown-toggle {
            background: rgba(255,255,255,0.15);
            border-radius: 40px;
            padding: 0.4rem 1rem;
            color: white;
        }
        @media (max-width: 992px) {
            .navbar-brand { font-size: 1.4rem; }
        }
    </style>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        'motto' => '"International, peer‑reviewed open access journal"',
        'language' => 'Language'
    ),
    'om' => array(
        'home' => 'Mana',
        'about' => 'Waaʼee',
        'about_journal' => 'Waaʼee Joornaalii',
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
        'logout' => 'Baʼi',
        'login' => 'Seeni',
        'register' => 'Galmaaʼi',
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

$text = $uiText[$currentLanguage] ?? $uiText['en'];
$current_uri = uri_string();
?>

<!-- Navigation Bar Only (No Journal Header) -->
<nav class="navbar navbar-expand-lg navbar-ojas sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('journal') ?>">
            <img src="<?= base_url('assets/images/logo.jpg') ?>" alt="OJAS Logo" class="navbar-logo">
            <span>OJAS</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ojasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="ojasNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center gap-1">
                <li class="nav-item"><a class="nav-link <?= ($current_uri == 'journal') ? 'active' : '' ?>" href="<?= base_url('journal') ?>"><?= $text['home'] ?></a></li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown"><?= $text['about'] ?></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('journal/about') ?>"><?= $text['about_journal'] ?></a></li>
                        <li><a class="dropdown-item" href="<?= base_url('journal/aims-scope') ?>"><?= $text['aims_scope'] ?></a></li>
                        <li><a class="dropdown-item" href="<?= base_url('journal/editorial-board') ?>"><?= $text['editorial_board'] ?></a></li>
                    </ul>
                </li>
                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="issuesDropdown" role="button" data-bs-toggle="dropdown"><?= $text['issues'] ?></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?= base_url('journal/current-issue') ?>"><?= $text['current_issue'] ?></a></li>
                        <li><a class="dropdown-item" href="<?= base_url('journal/archive') ?>"><?= $text['archive'] ?></a></li>
                        <!-- <a href="<?= base_url('journal/call_for_papers') ?>">Call for Papers</a> -->

                        <li><a class="dropdown-item" href="<?= base_url('journal/call_for_papers') ?>">Call for Papers</a></li>
                    </ul>
                </li>
                
                <li class="nav-item"><a class="nav-link" href="<?= base_url('journal/search') ?>"><i class="fas fa-search me-1"></i> <?= $text['search'] ?></a></li>
                <li class="nav-item"><a class="nav-link" href="<?= base_url('journal/contact') ?>"><?= $text['contact'] ?></a></li>
                
                <!-- Language Switcher -->
                <li class="nav-item dropdown lang-dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-globe"></i> <?= $languageOptions[$currentLanguage] ?? 'English' ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php foreach ($languageOptions as $code => $name): ?>
                        <li><a class="dropdown-item" href="?lang=<?= $code ?>"><?= $name ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                
                <?php if($this->session->userdata('isLoggedIn')): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> <?= htmlspecialchars($this->session->userdata('name')) ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= base_url('dashboard') ?>"><i class="fas fa-dashboard"></i> <?= $text['dashboard'] ?></a></li>
                        <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="fas fa-user-edit"></i> <?= $text['profile'] ?></a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> <?= $text['logout'] ?></a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item"><a class="btn btn-outline-light-nav" href="<?= base_url('login') ?>"><i class="fas fa-sign-in-alt"></i> <?= $text['login'] ?></a></li>
                <li class="nav-item ms-1"><a class="btn btn-submit-nav" href="<?= base_url('register') ?>"><i class="fas fa-user-plus"></i> <?= $text['submit_manuscript'] ?></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content Container Opens Here (No extra header banner) -->
<div class="container">