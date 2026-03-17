<div class="ojas-home">
    <section class="ojas-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <span class="ojas-pill">Peer Reviewed • Open Access • International</span>
                    <h1>Research-driven agriculture for resilient food systems.</h1>
                    <p>
                        Oromia Journal of Agricultural Sciences (OJAS) publishes high-impact studies in crop science,
                        livestock, natural resources, and agri-innovation.
                    </p>
                    <div class="ojas-hero-actions">
                        <a href="<?php echo base_url('journal/current_issue'); ?>" class="btn btn-ojas-primary">Current Issue</a>
                        <a href="<?php echo base_url('author/manuscript/submit'); ?>" class="btn btn-ojas-outline">Submit Manuscript</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="ojas-highlight-card">
                        <h4>Why publish with OJAS?</h4>
                        <ul>
                            <li><i class="fa fa-check-circle"></i> Rigorous double-blind review workflow.</li>
                            <li><i class="fa fa-check-circle"></i> Regional relevance with global scholarly visibility.</li>
                            <li><i class="fa fa-check-circle"></i> Fast editorial communication and transparent decisions.</li>
                        </ul>
                        <a href="<?php echo base_url('journal/author_guidelines'); ?>" class="link">Read author guidelines <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ojas-metrics container">
        <div class="row">
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="metric-box">
                    <h3>500+</h3>
                    <p>Published articles</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 mb-3">
                <div class="metric-box">
                    <h3>2–4 weeks</h3>
                    <p>Average first decision</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 mb-3">
                <div class="metric-box">
                    <h3>50+ countries</h3>
                    <p>Authors and reviewers network</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container ojas-section">
        <div class="section-head">
            <div>
                <small>Latest publication</small>
                <h2>Featured issue</h2>
            </div>
            <a href="<?php echo base_url('journal/archive'); ?>" class="btn btn-ojas-outline btn-sm">Browse archive</a>
        </div>

        <?php if (isset($latest_issue) && $latest_issue): ?>
            <div class="issue-panel">
                <div class="issue-meta">
                    <h3>Volume <?php echo $latest_issue->volume; ?>, Issue <?php echo $latest_issue->issueNumber; ?></h3>
                    <p><?php echo $latest_issue->year; ?></p>
                </div>

                <?php if (!empty($latest_issue->articles)): ?>
                    <?php $featured = $latest_issue->articles[0]; ?>
                    <div class="featured-article">
                        <span class="type-tag"><?php echo get_article_type_name($featured->articleType); ?></span>
                        <h4>
                            <a href="<?php echo base_url('journal/article/' . $featured->articleId); ?>">
                                <?php echo $featured->title; ?>
                            </a>
                        </h4>
                        <p class="authors"><i class="fa fa-users"></i> <?php echo $featured->author_names; ?></p>
                        <p><?php echo substr(strip_tags($featured->abstract), 0, 260); ?>...</p>
                        <a href="<?php echo base_url('journal/article/' . $featured->articleId); ?>" class="btn btn-ojas-primary btn-sm">Read article</a>
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

    <section class="container ojas-section">
        <div class="section-head">
            <div>
                <small>Fresh research</small>
                <h2>Recently published articles</h2>
            </div>
            <a href="<?php echo base_url('journal/search'); ?>" class="btn btn-ojas-outline btn-sm">Search all articles</a>
        </div>

        <div class="row">
            <?php if (isset($recent_articles) && !empty($recent_articles)): ?>
                <?php foreach ($recent_articles as $article): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <article class="article-tile">
                            <span class="type-tag"><?php echo get_article_type_name($article->articleType); ?></span>
                            <h5>
                                <a href="<?php echo base_url('journal/article/' . $article->articleId); ?>">
                                    <?php echo substr($article->title, 0, 110); ?>...
                                </a>
                            </h5>
                            <p class="authors"><?php echo substr($article->author_names, 0, 80); ?>...</p>
                            <div class="tile-footer">
                                <small>Vol <?php echo $article->volume; ?> (<?php echo $article->issueNumber; ?>)</small>
                                <a href="<?php echo base_url('journal/article/' . $article->articleId); ?>">View <i class="fa fa-arrow-right"></i></a>
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

    <section class="container">
        <div class="ojas-cta">
            <div>
                <h3>Join the OJAS scholarly community</h3>
                <p>Contribute evidence that improves agriculture, livelihoods, and sustainability across regions.</p>
            </div>
            <div class="cta-actions">
                <a href="<?php echo base_url('journal/about'); ?>" class="btn btn-ojas-outline">About OJAS</a>
                <a href="<?php echo base_url('login'); ?>" class="btn btn-ojas-primary">Author login</a>
            </div>
        </div>
    </section>
</div>

<style>
    .ojas-home {
        background: #f6f8f4;
        padding-bottom: 50px;
    }

    .ojas-hero {
        background: linear-gradient(130deg, #0f3d2e 0%, #2f6949 100%);
        color: #fff;
        padding: 80px 0;
        margin-bottom: 25px;
    }

    .ojas-pill {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.15);
        margin-bottom: 12px;
        font-size: 12px;
    }

    .ojas-hero h1 {
        font-size: 44px;
        line-height: 1.2;
        margin: 0 0 12px;
        font-weight: 800;
    }

    .ojas-hero p {
        max-width: 620px;
        opacity: 0.9;
    }

    .ojas-hero-actions {
        margin-top: 22px;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .ojas-highlight-card {
        background: #fff;
        color: #1f2937;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 14px 35px rgba(0, 0, 0, 0.18);
    }

    .ojas-highlight-card ul {
        list-style: none;
        padding-left: 0;
        margin-top: 16px;
    }

    .ojas-highlight-card li {
        margin-bottom: 10px;
    }

    .ojas-highlight-card i {
        color: #2f6949;
        margin-right: 8px;
    }

    .ojas-highlight-card .link {
        font-weight: 600;
        color: #2f6949;
        text-decoration: none;
    }

    .btn-ojas-primary {
        background: #f6c64b;
        color: #173027;
        border: none;
        border-radius: 999px;
        padding: 10px 22px;
        font-weight: 700;
    }

    .btn-ojas-outline {
        background: transparent;
        color: #2f6949;
        border: 1px solid #2f6949;
        border-radius: 999px;
        padding: 10px 22px;
        font-weight: 700;
    }

    .ojas-metrics {
        margin-bottom: 30px;
    }

    .metric-box,
    .issue-panel,
    .article-tile,
    .ojas-cta {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
    }

    .metric-box {
        padding: 20px;
        text-align: center;
        height: 100%;
    }

    .metric-box h3 {
        color: #2f6949;
        margin: 0 0 6px;
        font-weight: 800;
    }

    .ojas-section {
        margin-bottom: 30px;
    }

    .section-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        gap: 10px;
    }

    .section-head small {
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .section-head h2 {
        margin: 2px 0 0;
        color: #173027;
    }

    .issue-panel {
        padding: 22px;
    }

    .issue-meta h3 {
        margin-top: 0;
        color: #2f6949;
    }

    .featured-article {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #e5e7eb;
    }

    .type-tag {
        display: inline-block;
        font-size: 12px;
        border-radius: 999px;
        padding: 5px 10px;
        background: #e8f2ec;
        color: #2f6949;
        margin-bottom: 8px;
    }

    .featured-article h4 a,
    .article-tile h5 a {
        color: #111827;
        text-decoration: none;
    }

    .authors {
        color: #6b7280;
    }

    .article-tile {
        padding: 18px;
        height: 100%;
    }

    .tile-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
    }

    .tile-footer a {
        color: #2f6949;
        font-weight: 600;
        text-decoration: none;
    }

    .no-data {
        margin: 0;
        color: #6b7280;
    }

    .ojas-cta {
        margin-top: 8px;
        padding: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 20px;
    }

    .ojas-cta h3 {
        margin-top: 0;
        margin-bottom: 6px;
        color: #173027;
    }

    .cta-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    @media (max-width: 768px) {
        .ojas-hero h1 {
            font-size: 32px;
        }

        .ojas-cta {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
