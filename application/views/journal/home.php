<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,600;14..32,700;14..32,800&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: #ffffff;
    }

    /* Full width hero */
    .hero-ojas {
        background: linear-gradient(135deg, #0a2e1f 0%, #1a6b48 50%, #e8a735 100%);
        padding: 6rem 0 8rem;
        position: relative;
        overflow: hidden;
        width: 100%;
    }

    .hero-ojas::before {
        content: '';
        position: absolute;
        width: 150%;
        height: 150%;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 1%, transparent 1%);
        background-size: 50px 50px;
        top: -25%;
        left: -25%;
        animation: moveDots 40s linear infinite;
    }

    @keyframes moveDots {
        0% { transform: translate(0, 0); }
        100% { transform: translate(100px, 100px); }
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.2;
        background: linear-gradient(135deg, #fff 0%, #ffefc0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1.5rem;
        letter-spacing: -0.02em;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.9);
        max-width: 85%;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    /* Floating Stats - Full width container */
    .floating-stats-wrapper {
        background: transparent;
        margin-top: -3rem;
        position: relative;
        z-index: 10;
        width: 100%;
    }

    .stat-box {
        background: white;
        border-radius: 24px;
        padding: 1.8rem;
        text-align: center;
        box-shadow: 0 20px 40px -15px rgba(0,0,0,0.15);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .stat-box:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 50px -20px rgba(0,0,0,0.2);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #1a6b48, #e8a735);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
    }

    /* Full width sections */
    .full-width-section {
        width: 100%;
        padding: 4rem 0;
    }

    .full-width-bg-light {
        background: #fafbf9;
        width: 100%;
    }

    /* Section Headers */
    .section-flair {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-flair-badge {
        display: inline-block;
        padding: 0.4rem 1rem;
        background: linear-gradient(135deg, #e8f5ed, #fff);
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1px;
        color: #1a6b48;
        margin-bottom: 1rem;
        border: 1px solid rgba(26,107,72,0.2);
    }

    .section-flair h2 {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: #0a2e1f;
    }

    .section-flair p {
        color: #6b7280;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Article Cards */
    .magazine-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        height: 100%;
        border: 1px solid #eef2f0;
        position: relative;
    }

    .magazine-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 40px -15px rgba(0,0,0,0.12);
        border-color: transparent;
    }

    .card-content {
        padding: 2rem;
    }

    .card-badge {
        display: inline-block;
        background: linear-gradient(135deg, #e8a735, #f5c45e);
        color: #0a2e1f;
        font-size: 0.7rem;
        font-weight: 800;
        padding: 0.3rem 0.9rem;
        border-radius: 50px;
        margin-bottom: 1rem;
        letter-spacing: 0.5px;
    }

    .magazine-card h3 {
        font-size: 1.35rem;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 0.8rem;
    }

    .magazine-card h3 a {
        color: #0a2e1f;
        text-decoration: none;
        transition: color 0.2s;
    }

    .magazine-card h3 a:hover {
        color: #e8a735;
    }

    .authors {
        font-size: 0.85rem;
        color: #6b7280;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .meta-info {
        font-size: 0.8rem;
        color: #9ca3af;
        padding-bottom: 1rem;
        border-bottom: 1px dashed #eef2f0;
        margin-bottom: 1rem;
    }

    .read-link {
        color: #1a6b48;
        font-weight: 700;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: gap 0.3s;
    }

    .read-link:hover {
        gap: 0.8rem;
    }

    /* Sidebar Cards */
    .premium-card {
        background: linear-gradient(135deg, #fef9f0, #ffffff);
        border-radius: 24px;
        padding: 2rem;
        border: 1px solid rgba(232,167,53,0.2);
        margin-bottom: 1.5rem;
    }

    .premium-card h4 {
        font-size: 1.3rem;
        font-weight: 800;
        color: #0a2e1f;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .feature-list-modern {
        list-style: none;
        padding: 0;
    }

    .feature-list-modern li {
        padding: 0.7rem 0;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        border-bottom: 1px solid #f0f2f0;
    }

    .feature-list-modern li:last-child {
        border-bottom: none;
    }

    .feature-list-modern i {
        color: #e8a735;
        font-size: 1rem;
        width: 20px;
    }

    /* Full width CTA */
    .cta-full {
        width: 100%;
        background: linear-gradient(135deg, #0a2e1f 0%, #1a6b48 100%);
        padding: 4rem 0;
        margin-top: 2rem;
    }

    .cta-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 24px;
    }

    /* Footer */
    .footer-minimal {
        background: #0a0f0c;
        color: #9ca3af;
        padding: 4rem 0 2rem;
        width: 100%;
    }

    .footer-minimal h5 {
        color: white;
        font-weight: 700;
        margin-bottom: 1.2rem;
        font-size: 1.1rem;
    }

    .footer-links-minimal {
        list-style: none;
        padding: 0;
    }

    .footer-links-minimal li {
        margin-bottom: 0.7rem;
    }

    .footer-links-minimal a {
        color: #9ca3af;
        text-decoration: none;
        font-size: 0.85rem;
        transition: color 0.2s;
    }

    .footer-links-minimal a:hover {
        color: #e8a735;
    }

    .footer-bottom-minimal {
        border-top: 1px solid #1a221c;
        margin-top: 3rem;
        padding-top: 2rem;
        text-align: center;
        font-size: 0.8rem;
    }

    @media (max-width: 768px) {
        .hero-title { font-size: 2.2rem; }
        .hero-subtitle { font-size: 1rem; max-width: 100%; }
        .section-flair h2 { font-size: 1.8rem; }
        .stat-number { font-size: 2rem; }
        .stat-box { padding: 1rem; }
        .card-content { padding: 1.2rem; }
        .premium-card { padding: 1.2rem; }
        .full-width-section { padding: 2rem 0; }
        .cta-full { padding: 2rem 0; }
    }
</style>

<div class="ojas-home">
    <!-- Hero Section - Full Width -->
    <section class="hero-ojas">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h1 class="hero-title">Where Agricultural Science <br>Meets Innovation</h1>
                    <p class="hero-subtitle">
                        Oromia Journal of Agricultural Sciences — pioneering open-access research 
                        that transforms Ethiopian agriculture and shapes food security across Africa.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="<?= base_url('author/manuscript/submit') ?>" class="btn" style="background: #e8a735; color: #0a2e1f; font-weight: 700; padding: 0.8rem 2rem; border-radius: 50px; text-decoration: none;">
                            ✦ Submit Manuscript
                        </a>
                        <a href="<?= base_url('journal/archive') ?>" class="btn" style="background: rgba(255,255,255,0.15); color: white; font-weight: 600; padding: 0.8rem 2rem; border-radius: 50px; text-decoration: none; backdrop-filter: blur(10px);">
                            ⟡ Explore Archive
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Floating Stats - Full Width Container -->
    <div class="floating-stats-wrapper">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <div class="stat-box">
                        <div class="stat-number"><?= !empty($recent_articles) ? count($recent_articles) : 0 ?></div>
                        <div style="font-size: 0.75rem; color: #6b7280; font-weight: 600; margin-top: 0.5rem;">RECENT PAPERS</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-box">
                        <div class="stat-number"><?= isset($latest_issue) && $latest_issue ? (int)$latest_issue->year : date('Y') ?></div>
                        <div style="font-size: 0.75rem; color: #6b7280; font-weight: 600; margin-top: 0.5rem;">CURRENT VOLUME</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-box">
                        <div class="stat-number">Open</div>
                        <div style="font-size: 0.75rem; color: #6b7280; font-weight: 600; margin-top: 0.5rem;">ACCESS MODEL</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-box">
                        <div class="stat-number">Double</div>
                        <div style="font-size: 0.75rem; color: #6b7280; font-weight: 600; margin-top: 0.5rem;">PEER REVIEW</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area - Full Width -->
    <div class="full-width-section">
        <div class="container">
            <div class="section-flair">
                <span class="section-flair-badge">✦ LATEST RESEARCH ✦</span>
                <h2>Fresh from the press</h2>
                <p>Peer-reviewed, open-access articles advancing agricultural science</p>
            </div>

            <div class="row g-4">
                <!-- Articles Column -->
                <div class="col-lg-8">
                    <?php if (!empty($recent_articles)): ?>
                        <div class="row g-4">
                            <?php foreach ($recent_articles as $article): ?>
                                <div class="col-md-6">
                                    <div class="magazine-card">
                                        <div class="card-content">
                                            <span class="card-badge"><?= html_escape(get_article_type_name($article->articleType)); ?></span>
                                            <h3>
                                                <a href="<?= base_url('journal/article/' . $article->articleId); ?>">
                                                    <?= html_escape($article->title); ?>
                                                </a>
                                            </h3>
                                            <div class="authors">
                                                <i class="fa fa-user-circle"></i>
                                                <?= html_escape($article->author_names); ?>
                                            </div>
                                            <div class="meta-info">
                                                <i class="fa fa-book"></i> Vol <?= (int)$article->volume; ?> · Iss <?= (int)$article->issueNumber; ?>
                                                <?php if (!empty($article->issue_year)): ?>
                                                    · <?= (int)$article->issue_year; ?>
                                                <?php endif; ?>
                                            </div>
                                            <a class="read-link" href="<?= base_url('journal/article/' . $article->articleId); ?>">
                                                Read full article → 
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="magazine-card">
                            <div class="card-content text-center">
                                <i class="fa fa-leaf" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                                <p style="color: #6b7280;">No published articles yet. First issue coming soon.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="premium-card">
                        <h4>
                            <span>⚡</span> Why OJAS?
                        </h4>
                        <ul class="feature-list-modern">
                            <li><i class="fa fa-check-circle"></i> Rigorous double-blind peer review</li>
                            <li><i class="fa fa-check-circle"></i> Immediate open access</li>
                            <li><i class="fa fa-check-circle"></i> No article processing charges</li>
                            <li><i class="fa fa-check-circle"></i> Indexed in leading databases</li>
                            <li><i class="fa fa-check-circle"></i> Fast publication timeline</li>
                        </ul>
                    </div>

                    <div class="premium-card" style="background: linear-gradient(135deg, #f0f7f3, #ffffff);">
                        <h4>
                            <span>📌</span> Quick Links
                        </h4>
                        <ul class="feature-list-modern">
                            <li><a href="<?= base_url('journal/author-guidelines') ?>" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 0.8rem;"><i class="fa fa-file-text"></i> Author Guidelines</a></li>
                            <li><a href="<?= base_url('journal/search') ?>" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 0.8rem;"><i class="fa fa-search"></i> Advanced Search</a></li>
                            <li><a href="<?= base_url('journal/editorial-board') ?>" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 0.8rem;"><i class="fa fa-users"></i> Editorial Board</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Width CTA Banner -->
    <div class="cta-full">
        <div class="cta-content">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3 style="color: white; font-weight: 800; margin-bottom: 0.5rem; font-size: 1.8rem;">Ready to share your research?</h3>
                    <p style="color: rgba(255,255,255,0.85); margin-bottom: 0; font-size: 1.1rem;">Join Ethiopia's leading agricultural research platform.</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url('author/manuscript/submit') ?>" style="background: #e8a735; color: #0a2e1f; font-weight: 700; padding: 0.8rem 2rem; border-radius: 50px; text-decoration: none; display: inline-block; font-size: 1rem;">
                        Start Submission →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Minimalist Single Footer - Full Width -->
    <footer class="footer-minimal">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>OJAS</h5>
                    <p style="font-size: 0.85rem; line-height: 1.6;">Oromia Journal of Agricultural Sciences — advancing agricultural research for food security and sustainable development.</p>
                </div>
                <div class="col-md-2 col-6 mb-3 mb-md-0">
                    <h5>Journal</h5>
                    <ul class="footer-links-minimal">
                        <li><a href="<?= base_url('journal/archive') ?>">Archive</a></li>
                        <li><a href="<?= base_url('journal/search') ?>">Search</a></li>
                        <li><a href="<?= base_url('journal/current-issue') ?>">Current Issue</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-6 mb-3 mb-md-0">
                    <h5>Authors</h5>
                    <ul class="footer-links-minimal">
                        <li><a href="<?= base_url('author/manuscript/submit') ?>">Submit</a></li>
                        <li><a href="<?= base_url('journal/author-guidelines') ?>">Guidelines</a></li>
                        <li><a href="<?= base_url('journal/ethics') ?>">Publication Ethics</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Connect</h5>
                    <ul class="footer-links-minimal">
                        <li><a href="<?= base_url('journal/contact') ?>">Contact</a></li>
                        <li><a href="#">editor@ojas.edu.et</a></li>
                        <li><i class="fa fa-map-marker"></i> Oromia, Ethiopia</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom-minimal">
                <p>© <?= date('Y') ?> Oromia Journal of Agricultural Sciences. Open Access · CC BY 4.0</p>
            </div>
        </div>
    </footer>
</div>