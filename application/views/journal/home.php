<style>
    :root {
        --ojas-brand-900: #123524;
        --ojas-brand-700: #1f5a3e;
        --ojas-brand-500: #2f7a52;
        --ojas-accent: #f2c14e;
        --ojas-bg: #f4f8f5;
        --ojas-text: #1f2933;
        --ojas-muted: #5f6f66;
        --ojas-border: #dce9df;
    }

    .navbar-ojas {
        background: linear-gradient(135deg, var(--ojas-brand-900) 0%, var(--ojas-brand-700) 100%) !important;
    }

    .footer {
        background: linear-gradient(180deg, #0f2d1f 0%, #0a1f15 100%) !important;
        border-top: 4px solid var(--ojas-accent);
    }

    .journal-home-pro {
        background: var(--ojas-bg);
        color: var(--ojas-text);
        padding-bottom: 50px;
    }

    .jh-hero {
        background: linear-gradient(125deg, var(--ojas-brand-900), var(--ojas-brand-500));
        color: #fff;
        padding: 55px 0;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .jh-hero:after {
        content: '';
        position: absolute;
        right: -120px;
        top: -60px;
        width: 320px;
        height: 320px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
    }

    .jh-hero h1 {
        font-size: 36px;
        font-weight: 700;
        margin: 0 0 12px;
        line-height: 1.25;
    }

    .jh-hero p {
        font-size: 16px;
        opacity: 0.95;
        max-width: 760px;
    }

    .jh-kpi {
        background: #fff;
        border: 1px solid var(--ojas-border);
        border-radius: 12px;
        padding: 15px;
        text-align: center;
        margin-top: 16px;
        box-shadow: 0 6px 18px rgba(15, 45, 31, 0.08);
    }

    .jh-kpi .num {
        display: block;
        font-size: 24px;
        font-weight: 700;
        color: var(--ojas-brand-700);
    }

    .jh-kpi .lbl {
        color: var(--ojas-muted);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .jh-section-title {
        margin: 0 0 16px;
        font-size: 27px;
        font-weight: 700;
        color: var(--ojas-brand-900);
    }

    .jh-card {
        background: #fff;
        border: 1px solid var(--ojas-border);
        border-radius: 12px;
        padding: 22px;
        margin-bottom: 22px;
        box-shadow: 0 8px 20px rgba(18, 53, 36, 0.05);
    }

    .jh-pill {
        display: inline-block;
        padding: 6px 10px;
        background: #e9f5ed;
        color: var(--ojas-brand-700);
        border-radius: 100px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .jh-meta {
        color: var(--ojas-muted);
        font-size: 13px;
        margin: 8px 0 0;
    }

    .jh-article {
        height: 100%;
    }

    .jh-article h4 {
        margin: 8px 0 10px;
        font-size: 19px;
        line-height: 1.4;
    }

    .jh-article h4 a {
        color: var(--ojas-text);
        text-decoration: none;
    }

    .jh-article h4 a:hover {
        color: var(--ojas-brand-700);
    }

    .jh-authors {
        color: var(--ojas-muted);
        font-size: 13px;
        margin-bottom: 12px;
    }

    .jh-link {
        color: var(--ojas-brand-700);
        font-weight: 600;
        text-decoration: none;
    }

    .jh-link:hover {
        color: var(--ojas-brand-900);
        text-decoration: underline;
    }

    .jh-sidebar-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .jh-sidebar-list li {
        border-bottom: 1px dashed #d8e6dc;
        padding: 10px 0;
        color: #3d4a43;
    }

    .jh-empty {
        color: var(--ojas-muted);
        font-style: italic;
    }

    .jh-cta {
        background: linear-gradient(135deg, #f6fff8 0%, #e9f4ec 100%);
        border: 1px solid var(--ojas-border);
        border-radius: 12px;
        padding: 24px;
    }

    .btn-ojas-pro {
        background: var(--ojas-brand-700);
        color: #fff !important;
        border-radius: 6px;
        border: 1px solid var(--ojas-brand-700);
        padding: 9px 15px;
        text-decoration: none;
        display: inline-block;
        margin-right: 8px;
    }

    .btn-ojas-pro:hover {
        background: var(--ojas-brand-900);
        border-color: var(--ojas-brand-900);
    }

    .btn-ojas-ghost {
        background: #fff;
        color: var(--ojas-brand-700) !important;
        border-radius: 6px;
        border: 1px solid var(--ojas-brand-700);
        padding: 9px 15px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-ojas-ghost:hover {
        background: #eaf4ee;
    }
</style>

<div class="journal-home-pro">
    <section class="jh-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h1>Oromia Journal of Agricultural Sciences (OJAS)</h1>
                    <p>
                        A peer-reviewed, open-access platform advancing agricultural research, innovation, and evidence-based policy for Ethiopia and the wider region.
                    </p>
                    <a class="btn-ojas-pro" href="<?= base_url('author/manuscript/submit') ?>"><i class="fa fa-upload"></i> Submit Manuscript</a>
                    <a class="btn-ojas-ghost" href="<?= base_url('journal/archive') ?>"><i class="fa fa-book"></i> Browse Archive</a>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="jh-kpi">
                                <span class="num"><?= !empty($recent_articles) ? count($recent_articles) : 0 ?></span>
                                <span class="lbl">Recent Articles</span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="jh-kpi">
                                <span class="num"><?= isset($latest_issue) && $latest_issue ? (int)$latest_issue->year : date('Y') ?></span>
                                <span class="lbl">Current Year</span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="jh-kpi">
                                <span class="num">Open</span>
                                <span class="lbl">Access Model</span>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="jh-kpi">
                                <span class="num">Double</span>
                                <span class="lbl">Blind Review</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="jh-section-title">Recent Published Articles</h2>
                <?php if (!empty($recent_articles)): ?>
                    <div class="row">
                        <?php foreach ($recent_articles as $article): ?>
                            <div class="col-sm-6">
                                <div class="jh-card jh-article">
                                    <span class="jh-pill"><?= html_escape(get_article_type_name($article->articleType)); ?></span>
                                    <h4>
                                        <a href="<?= base_url('journal/manuscript/' . $article->manuscriptId); ?>">
                                            <?= html_escape($article->title); ?>
                                        </a>
                                    </h4>
                                    <div class="jh-authors">
                                        <i class="fa fa-user"></i>
                                        <?= html_escape($article->author_names); ?>
                                    </div>
                                    <p class="jh-meta">
                                        <i class="fa fa-calendar"></i>
                                        Volume <?= (int)$article->volume; ?>, Issue <?= (int)$article->issueNumber; ?>
                                        <?php if (!empty($article->issue_year)): ?>
                                            (<?= (int)$article->issue_year; ?>)
                                        <?php endif; ?>
                                    </p>
                                    <a class="jh-link" href="<?= base_url('journal/manuscript/' . $article->manuscriptId); ?>">Read article <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="jh-card">
                        <p class="jh-empty">No published articles are available yet. Published manuscripts will appear here once editors complete payment verification and publishing.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-4">
                <h2 class="jh-section-title">Current Issue</h2>
                <div class="jh-card">
                    <?php if (isset($latest_issue) && $latest_issue): ?>
                        <p class="jh-pill">Latest Issue</p>
                        <h4 style="margin-top:10px;">Volume <?= (int)$latest_issue->volume; ?> · Issue <?= (int)$latest_issue->issueNumber; ?></h4>
                        <p class="jh-meta"><i class="fa fa-calendar"></i> <?= (int)$latest_issue->year; ?> <?= !empty($latest_issue->month) ? html_escape($latest_issue->month) : ''; ?></p>
                        <p style="margin-top:12px;"><?= !empty($latest_issue->title) ? html_escape($latest_issue->title) : 'Official issue release of OJAS.'; ?></p>
                        <a class="jh-link" href="<?= base_url('journal/current-issue'); ?>">View current issue <i class="fa fa-arrow-right"></i></a>
                    <?php else: ?>
                        <p class="jh-empty">No published issue is currently available.</p>
                    <?php endif; ?>
                </div>

                <div class="jh-card">
                    <h4 style="margin-top:0;">Why publish with OJAS?</h4>
                    <ul class="jh-sidebar-list">
                        <li><i class="fa fa-check-circle text-success"></i> Rigorous and ethical peer-review process.</li>
                        <li><i class="fa fa-check-circle text-success"></i> Open-access dissemination for wider impact.</li>
                        <li><i class="fa fa-check-circle text-success"></i> Focus on context-relevant agricultural science.</li>
                        <li><i class="fa fa-check-circle text-success"></i> Editorial support for authors and reviewers.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="container" style="margin-top:10px;">
        <div class="jh-cta">
            <div class="row">
                <div class="col-md-8">
                    <h3 style="margin-top:0; color: var(--ojas-brand-900);">Contribute to evidence-driven agricultural transformation</h3>
                    <p style="color:#42554a; margin-bottom:0;">Submit original research, reviews, and technical notes that shape practice and policy.</p>
                </div>
                <div class="col-md-4 text-right" style="margin-top:10px;">
                    <a class="btn-ojas-pro" href="<?= base_url('journal/author-guidelines') ?>"><i class="fa fa-file-text"></i> Author Guidelines</a>
                    <a class="btn-ojas-ghost" href="<?= base_url('journal/search') ?>"><i class="fa fa-search"></i> Search Articles</a>
                </div>
            </div>
        </div>
    </section>
</div>
