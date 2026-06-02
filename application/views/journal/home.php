<!-- 
    Homepage for Oromia Journal of Agricultural Sciences (OJAS)
    Uses data from Journal controller: 
    $stats, $featured_articles, $current_issue, $call_for_papers, $latest_issue, $recent_articles
-->

<!-- Hero Section (only on homepage) -->
<div class="hero-section" style="background: linear-gradient(135deg, #eef2f3 0%, #d9e2e8 100%); padding: 4rem 2rem; border-radius: 0 0 40px 40px; margin-bottom: 2rem;">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h1 style="font-size: 3.2rem; font-weight: 800; background: linear-gradient(120deg, #0f3b2c, #2c7a4d); -webkit-background-clip: text; background-clip: text; color: transparent;">
                    Advancing agricultural & life sciences research
                </h1>
                <p class="lead mt-3 text-secondary">
                    OJAS publishes high‑impact, peer‑reviewed research to bridge science and sustainable development.
                </p>
                <div class="d-flex gap-3 mt-4">
                    <a href="<?= base_url('journal/current-issue') ?>" class="btn btn-submit px-4 py-2">Explore Articles <i class="fas fa-arrow-right ms-2"></i></a>
                    <a href="<?= base_url('journal/author-guidelines') ?>" class="btn btn-outline-secondary px-4 py-2">Author Guidelines</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="stat-card" style="background: white; border-radius: 28px; padding: 1.5rem 0.8rem; text-align: center; box-shadow: 0 12px 24px -12px rgba(0,0,0,0.1); height: 100%;">
                            <div class="stat-number" style="font-size: 2.6rem; font-weight: 800; color: #0f3b2c;"><?= $stats['submissions'] ?? 0 ?></div>
                            <div class="small text-muted">Submissions (<?= date('Y') ?>)</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card" style="background: white; border-radius: 28px; padding: 1.5rem 0.8rem; text-align: center; box-shadow: 0 12px 24px -12px rgba(0,0,0,0.1); height: 100%;">
                            <div class="stat-number" style="font-size: 2.6rem; font-weight: 800; color: #0f3b2c;"><?= $stats['published'] ?? 0 ?></div>
                            <div class="small text-muted">Published Articles</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card" style="background: white; border-radius: 28px; padding: 1.5rem 0.8rem; text-align: center; box-shadow: 0 12px 24px -12px rgba(0,0,0,0.1); height: 100%;">
                            <div class="stat-number" style="font-size: 2.6rem; font-weight: 800; color: #0f3b2c;"><?= $stats['reviewers'] ?? 0 ?></div>
                            <div class="small text-muted">Active Reviewers</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card" style="background: white; border-radius: 28px; padding: 1.5rem 0.8rem; text-align: center; box-shadow: 0 12px 24px -12px rgba(0,0,0,0.1); height: 100%;">
                            <div class="stat-number" style="font-size: 2.6rem; font-weight: 800; color: #0f3b2c;"><?= $stats['acceptance'] ?? 0 ?>%</div>
                            <div class="small text-muted">Acceptance Rate</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Card -->
<div class="container mb-5">
    <div class="search-card" style="background: white; border-radius: 32px; box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08); padding: 1.8rem;">
        <h3 class="fw-semibold mb-3"><i class="fas fa-search me-2 text-success"></i> Search journals & articles</h3>
        <form id="dynamicSearchForm" onsubmit="return false;">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Keyword / Title / Author</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="e.g., Agricultural inputs, Oromo economy ...">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Article Type</label>
                    <select id="thematicFilter" class="form-select">
                        <option value="">All Types</option>
                        <option value="research">Research Article</option>
                        <option value="review">Review Article</option>
                        <option value="short_communication">Short Communication</option>
                        <option value="case_study">Case Study</option>
                        <option value="technical_note">Technical Note</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Search Field</label>
                    <select id="fieldFilter" class="form-select">
                        <option value="all">All Fields</option>
                        <option value="title">Title</option>
                        <option value="author">Author</option>
                        <option value="abstract">Abstract</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-submit w-100" onclick="performSearch()"><i class="fas fa-sliders-h me-1"></i> Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Latest / Featured Articles Section -->
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <h2 class="section-title" style="font-weight: 700; font-size: 2rem; margin-bottom: 1.8rem; position: relative; display: inline-block;">
            📖 Latest & Featured Articles
        </h2>
        <div id="resultsMeta" class="text-muted fw-semibold"></div>
    </div>
    <div id="resultsContainer" class="row g-4 mt-1"></div>
</div>

<!-- Current Issue Highlight -->
<div class="container my-5">
    <div class="issue-card" style="background: linear-gradient(115deg, #0f3b2c, #1b5e3f); border-radius: 32px; padding: 2rem; color: white;">
        <div class="row align-items-center">
            <div class="col-md-7">
                <span class="badge bg-light text-dark mb-2"><i class="fas fa-calendar-alt me-1"></i> Latest Issue</span>
                <h2 class="fw-bold text-white"><?= $current_issue['title'] ?? 'Volume 10, Issue 1 (June 2026)' ?></h2>
                <p class="text-white-50"><?= $current_issue['description'] ?? 'Exploring breakthrough innovations in agroecology, climate resilience, and precision farming.' ?></p>
                <a href="<?= base_url('journal/current-issue') ?>" class="btn btn-light mt-2 rounded-pill px-4">Browse full issue <i class="fas fa-chevron-right ms-2"></i></a>
            </div>
            <div class="col-md-5 text-center">
                <i class="fas fa-book-open" style="font-size: 6rem; opacity: 0.3; color: white;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Call for Papers -->
<div class="container my-5">
    <div class="row g-4 align-items-center bg-white p-4 p-lg-5 rounded-4 shadow-sm">
        <div class="col-md-8">
            <h3 class="fw-bold"><?= $call_for_papers['title'] ?? 'Call for Papers – Special Issue: “Digital Agriculture & AI”' ?></h3>
            <p class="text-secondary mt-2">
                <?= $call_for_papers['description'] ?? 'Submission deadline: October 30, 2026. Guest editors invite original research, reviews, and case studies on AI-driven farm management, remote sensing, and smart irrigation.' ?>
            </p>
            <div class="mt-3">
                <span class="badge" style="background: #e9ecef; color: #2c3e50; border-radius: 40px; padding: 0.3rem 0.9rem;">
                    <i class="far fa-clock me-1"></i> <?= $call_for_papers['deadline_text'] ?? '5 months left' ?>
                </span>
            </div>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="<?= $call_for_papers['link'] ?? '#' ?>" class="btn btn-submit px-4">Submit now <i class="fas fa-external-link-alt ms-2"></i></a>
        </div>
    </div>
</div>

<style>
    .article-card {
        background: white;
        border-radius: 24px;
        padding: 1.6rem;
        box-shadow: 0 5px 12px rgba(0,0,0,0.03);
        border: 1px solid #eef2f6;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: 0.25s;
    }
    .article-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 30px -15px rgba(0,0,0,0.1);
        border-color: #cbd5e1;
    }
    .btn-outline-ojas {
        border: 1px solid #0f3b2c;
        background: transparent;
        color: #0f3b2c;
        border-radius: 50px;
        padding: 0.4rem 1.2rem;
        font-weight: 500;
        transition: 0.2s;
        margin-top: auto;
        align-self: flex-start;
        text-decoration: none;
    }
    .btn-outline-ojas:hover {
        background: #0f3b2c;
        color: white;
    }
    .badge-theme {
        background: #e9ecef;
        color: #2c3e50;
        border-radius: 40px;
        padding: 0.3rem 0.9rem;
        font-size: 0.75rem;
        font-weight: 500;
    }
    .section-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: #0f3b2c;
        border-radius: 4px;
    }
</style>

<script>
// Initial articles from PHP (featured articles)
const initialArticles = <?= json_encode($featured_articles ?? []) ?>;

function escapeHtml(str) {
    if(!str) return '';
    return str.replace(/[&<>]/g, function(m) {
        if(m === '&') return '&amp;';
        if(m === '<') return '&lt;';
        if(m === '>') return '&gt;';
        return m;
    });
}

function renderArticles(articles) {
    const container = document.getElementById('resultsContainer');
    const meta = document.getElementById('resultsMeta');
    if(!articles.length) {
        container.innerHTML = '<div class="col-12"><div class="alert alert-info text-center p-5">No articles found with selected filters.</div></div>';
        meta.innerText = '0 results';
        return;
    }
    meta.innerText = articles.length + ' result(s) found';
    let html = '';
    articles.forEach(art => {
        let abs = (art.abstract_text || '').substring(0, 220);
        if(abs.length >= 220) abs += '...';
        html += `
            <div class="col-md-6 col-lg-4">
                <div class="article-card">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="badge-theme">${escapeHtml(art.articleType || 'Research')}</span>
                        <small class="text-muted"><i class="far fa-file-alt"></i> ${escapeHtml(art.manuscriptNumber || '')}</small>
                    </div>
                    <h5 class="fw-bold" style="color:#1f2937;">${escapeHtml(art.title)}</h5>
                    <p class="text-secondary small"><i class="fas fa-user-edit me-1"></i> ${escapeHtml(art.author_names)}</p>
                    <p class="small">${escapeHtml(abs)}</p>
                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <span class="text-muted small"><i class="fas fa-calendar-week"></i> Vol ${art.volume}, Iss ${art.issueNumber} (${art.year})</span>
                        <a href="<?= base_url('journal/article/') ?>${art.articleId}" class="btn-outline-ojas text-decoration-none">Read more →</a>
                    </div>
                </div>
            </div>
        `;
    });
    container.innerHTML = html;
}

function performSearch() {
    const q = document.getElementById('searchInput').value.trim();
    const type = document.getElementById('thematicFilter').value;
    const field = document.getElementById('fieldFilter').value;
    fetch(`<?= base_url('journal/search_api') ?>?q=${encodeURIComponent(q)}&type=${encodeURIComponent(type)}&field=${encodeURIComponent(field)}`)
        .then(res => res.json())
        .then(data => {
            renderArticles(data.results);
        })
        .catch(() => {
            renderArticles([]);
        });
}

// Event listeners
document.getElementById('searchInput')?.addEventListener('input', () => setTimeout(performSearch, 300));
document.getElementById('thematicFilter')?.addEventListener('change', performSearch);
document.getElementById('fieldFilter')?.addEventListener('change', performSearch);

// Initial render
renderArticles(initialArticles);
</script>