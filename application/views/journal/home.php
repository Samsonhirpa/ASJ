<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>OJAS | Oromia Journal of Agricultural Sciences</title>
    <!-- Font Awesome 6 (free icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap 5 CSS for grid & utilities -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, 'Segoe UI', 'Inter', 'Helvetica Neue', sans-serif;
            background: #f6f8f4;
            line-height: 1.5;
        }

        .ojas-home {
            background: #f6f8f4;
            padding-bottom: 60px;
        }

        .ojas-hero {
            background: linear-gradient(130deg, #0f3d2e 0%, #2f6949 100%);
            color: #fff;
            padding: 80px 0;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .ojas-hero::before {
            content: "";
            position: absolute;
            top: -30%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(246, 198, 75, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }

        .ojas-pill {
            display: inline-block;
            padding: 6px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(2px);
            margin-bottom: 16px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .ojas-hero h1 {
            font-size: 3.2rem;
            line-height: 1.2;
            margin: 0 0 16px;
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .ojas-hero p {
            max-width: 620px;
            opacity: 0.92;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .ojas-hero-actions {
            margin-top: 8px;
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn-ojas-primary {
            background: #f6c64b;
            color: #173027;
            border: none;
            border-radius: 999px;
            padding: 12px 28px;
            font-weight: 700;
            transition: all 0.2s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        
        .btn-ojas-primary:hover {
            background: #f5bc2a;
            transform: translateY(-2px);
            color: #0f3d2e;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .btn-ojas-outline {
            background: transparent;
            color: #2f6949;
            border: 1.5px solid #2f6949;
            border-radius: 999px;
            padding: 10px 26px;
            font-weight: 700;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }
        
        .btn-ojas-outline:hover {
            background: #2f6949;
            color: white;
            transform: translateY(-2px);
        }

        .ojas-highlight-card {
            background: #ffffff;
            color: #1f2937;
            border-radius: 28px;
            padding: 28px 26px;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
        }
        
        .ojas-highlight-card:hover {
            transform: translateY(-4px);
        }
        
        .ojas-highlight-card ul {
            list-style: none;
            padding-left: 0;
            margin: 18px 0 20px;
        }
        
        .ojas-highlight-card li {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }
        
        .ojas-highlight-card i.fa-check-circle {
            color: #2f6949;
            font-size: 1.2rem;
            width: 24px;
        }
        
        .ojas-highlight-card .link {
            font-weight: 700;
            color: #2f6949;
            text-decoration: none;
            border-bottom: 1.5px solid #d4e2da;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .ojas-highlight-card .link:hover {
            border-bottom-color: #2f6949;
        }

        .ojas-metrics {
            margin-bottom: 45px;
        }
        
        .metric-box {
            background: white;
            border-radius: 24px;
            padding: 28px 16px;
            text-align: center;
            height: 100%;
            border: 1px solid #e9efe5;
            transition: all 0.2s;
            box-shadow: 0 6px 12px -8px rgba(0,0,0,0.05);
        }
        
        .metric-box:hover {
            border-color: #c0dbc9;
            box-shadow: 0 12px 22px -12px rgba(0,0,0,0.1);
        }
        
        .metric-box h3 {
            color: #2f6949;
            margin: 0 0 8px;
            font-weight: 800;
            font-size: 2rem;
        }
        
        .metric-box p {
            margin: 0;
            color: #4b5563;
            font-weight: 500;
        }

        .ojas-section {
            margin-bottom: 50px;
        }
        
        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            flex-wrap: wrap;
            margin-bottom: 28px;
            border-bottom: 2px solid #e2e8e0;
            padding-bottom: 12px;
        }
        
        .section-head small {
            color: #5a6e5a;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.8px;
            font-size: 0.75rem;
        }
        
        .section-head h2 {
            margin: 4px 0 0;
            font-size: 1.9rem;
            font-weight: 700;
            color: #173027;
        }

        .issue-panel {
            background: #fff;
            border-radius: 28px;
            border: 1px solid #eef3e9;
            padding: 28px 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.02);
        }
        
        .issue-meta h3 {
            color: #2f6949;
            font-weight: 800;
            font-size: 1.7rem;
            margin: 0 0 6px;
        }
        
        .featured-article {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 2px solid #eef2e7;
        }
        
        .type-tag {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 700;
            border-radius: 40px;
            padding: 5px 14px;
            background: #eef4ea;
            color: #2f6949;
            letter-spacing: 0.3px;
            margin-bottom: 14px;
        }
        
        .featured-article h4 a, .article-tile h5 a {
            color: #111827;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .featured-article h4 a:hover, .article-tile h5 a:hover {
            color: #2f6949;
        }
        
        .authors {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 10px 0 12px;
        }
        
        .authors i {
            margin-right: 6px;
        }

        .article-tile {
            background: white;
            border-radius: 20px;
            padding: 22px;
            height: 100%;
            transition: all 0.25s;
            border: 1px solid #ecf3e8;
            display: flex;
            flex-direction: column;
        }
        
        .article-tile:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.08);
            border-color: #cfe3d3;
        }
        
        .article-tile h5 {
            font-size: 1.1rem;
            font-weight: 700;
            line-height: 1.4;
            margin: 8px 0 12px;
        }
        
        .tile-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 14px;
            border-top: 1px solid #eef2e7;
        }
        
        .tile-footer a {
            font-weight: 700;
            color: #2f6949;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .no-data {
            color: #5a6b5a;
            padding: 20px 0;
            font-style: italic;
        }

        .ojas-cta {
            background: #fff;
            border-radius: 32px;
            margin-top: 20px;
            padding: 32px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 24px;
            border: 1px solid #e2ecd9;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.03);
        }
        
        .ojas-cta h3 {
            font-size: 1.8rem;
            font-weight: 800;
            margin: 0 0 8px;
            color: #173027;
        }
        
        .cta-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        @media (max-width: 992px) {
            .ojas-hero h1 {
                font-size: 2.4rem;
            }
            .section-head h2 {
                font-size: 1.6rem;
            }
        }
        
        @media (max-width: 768px) {
            .ojas-hero {
                padding: 50px 0;
            }
            .ojas-cta {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
                padding: 28px;
            }
            .btn-ojas-primary, .btn-ojas-outline {
                padding: 8px 20px;
            }
            .issue-panel {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<div class="ojas-home">
    <!-- Hero Section -->
    <section class="ojas-hero">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="ojas-pill"><i class="fas fa-check-circle me-1"></i> Peer Reviewed • Open Access • International</span>
                    <h1>Research-driven agriculture for resilient food systems.</h1>
                    <p>
                        Oromia Journal of Agricultural Sciences (OJAS) publishes high-impact studies in crop science,
                        livestock, natural resources, and agri-innovation.
                    </p>
                    <div class="ojas-hero-actions">
                        <a href="javascript:void(0)" class="btn btn-ojas-primary" onclick="window.location.href='<?php echo base_url('journal/current_issue'); ?>'">
                            <i class="fas fa-book-open me-2"></i>Current Issue
                        </a>
                        <a href="javascript:void(0)" class="btn btn-ojas-outline" onclick="window.location.href='<?php echo base_url('author/manuscript/submit'); ?>'">
                            <i class="fas fa-pen-fancy me-2"></i>Submit Manuscript
                        </a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ojas-highlight-card">
                        <h4><i class="fas fa-seedling me-2" style="color:#2f6949;"></i> Why publish with OJAS?</h4>
                        <ul>
                            <li><i class="fas fa-check-circle"></i> Rigorous double-blind review workflow.</li>
                            <li><i class="fas fa-check-circle"></i> Regional relevance with global scholarly visibility.</li>
                            <li><i class="fas fa-check-circle"></i> Fast editorial communication and transparent decisions.</li>
                        </ul>
                        <a href="javascript:void(0)" class="link" onclick="window.location.href='<?php echo base_url('journal/author_guidelines'); ?>'">
                            Read author guidelines <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Metrics Section -->
    <section class="ojas-metrics container">
        <div class="row g-4">
            <div class="col-md-4 col-sm-6">
                <div class="metric-box">
                    <h3>500+</h3>
                    <p>Published articles</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="metric-box">
                    <h3>2–4 weeks</h3>
                    <p>Average first decision</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="metric-box">
                    <h3>50+ countries</h3>
                    <p>Authors and reviewers network</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Issue Section -->
    <section class="container ojas-section">
        <div class="section-head">
            <div>
                <small>Latest publication</small>
                <h2>Featured issue</h2>
            </div>
            <a href="javascript:void(0)" class="btn btn-ojas-outline btn-sm" onclick="window.location.href='<?php echo base_url('journal/archive'); ?>'">
                Browse archive <i class="fas fa-archive ms-1"></i>
            </a>
        </div>

        <?php if (isset($latest_issue) && $latest_issue): ?>
            <div class="issue-panel">
                <div class="issue-meta">
                    <h3>Volume <?php echo $latest_issue->volume; ?>, Issue <?php echo $latest_issue->issueNumber; ?></h3>
                    <p><i class="far fa-calendar-alt me-1"></i> <?php echo $latest_issue->year; ?></p>
                </div>

                <?php if (!empty($latest_issue->articles)): ?>
                    <?php $featured = $latest_issue->articles[0]; ?>
                    <div class="featured-article">
                        <span class="type-tag"><i class="fas fa-microphone-alt"></i> <?php echo get_article_type_name($featured->articleType); ?></span>
                        <h4>
                            <a href="javascript:void(0)" onclick="window.location.href='<?php echo base_url('journal/article/' . $featured->articleId); ?>'">
                                <?php echo $featured->title; ?>
                            </a>
                        </h4>
                        <p class="authors"><i class="fas fa-users"></i> <?php echo $featured->author_names; ?></p>
                        <p><?php echo substr(strip_tags($featured->abstract), 0, 260); ?>...</p>
                        <a href="javascript:void(0)" class="btn btn-ojas-primary btn-sm" onclick="window.location.href='<?php echo base_url('journal/article/' . $featured->articleId); ?>'">
                            <i class="fas fa-file-alt me-1"></i> Read article
                        </a>
                    </div>
                <?php else: ?>
                    <p class="no-data">This issue is available, but article details are not yet listed.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="issue-panel">
                <p class="no-data">No published issue available yet.</p>
            </div>
        <?php endif; ?>
    </section>

    <!-- Recently Published Articles -->
    <section class="container ojas-section">
        <div class="section-head">
            <div>
                <small>Fresh research</small>
                <h2>Recently published articles</h2>
                <p class="mb-0 text-muted">Articles appear here after editor payment verification and publish approval.</p>
            </div>
            <a href="javascript:void(0)" class="btn btn-ojas-outline btn-sm" onclick="window.location.href='<?php echo base_url('journal/search'); ?>'">
                <i class="fas fa-search me-1"></i> Search all articles
            </a>
        </div>

        <div class="row g-4">
            <?php if (isset($recent_articles) && !empty($recent_articles)): ?>
                <?php foreach ($recent_articles as $article): ?>
                    <div class="col-lg-4 col-md-6">
                        <article class="article-tile">
                            <span class="type-tag"><?php echo get_article_type_name($article->articleType); ?></span>
                            <h5>
                                <a href="javascript:void(0)" onclick="window.location.href='<?php echo base_url('journal/article/' . $article->articleId); ?>'">
                                    <?php echo substr($article->title, 0, 110); ?>...
                                </a>
                            </h5>
                            <p class="authors"><i class="fas fa-user-pen"></i> <?php echo substr($article->author_names, 0, 80); ?>...</p>
                            <div class="tile-footer">
                                <small>Vol <?php echo $article->volume; ?> (<?php echo $article->issueNumber; ?>)</small>
                                <a href="javascript:void(0)" onclick="window.location.href='<?php echo base_url('journal/article/' . $article->articleId); ?>'">
                                    View <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="no-data">No recent articles found.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="container">
        <div class="ojas-cta">
            <div>
                <h3><i class="fas fa-hand-peace me-2" style="color:#2f6949;"></i> Join the OJAS scholarly community</h3>
                <p>Contribute evidence that improves agriculture, livelihoods, and sustainability across regions.</p>
            </div>
            <div class="cta-actions">
                <a href="javascript:void(0)" class="btn btn-ojas-outline" onclick="window.location.href='<?php echo base_url('journal/about'); ?>'">
                    <i class="fas fa-info-circle"></i> About OJAS
                </a>
                <a href="javascript:void(0)" class="btn btn-ojas-primary" onclick="window.location.href='<?php echo base_url('login'); ?>'">
                    <i class="fas fa-sign-in-alt"></i> Author login
                </a>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>