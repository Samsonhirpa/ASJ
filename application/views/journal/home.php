<section class="content" style="padding:30px 15px 10px; max-width: 1200px; margin: 0 auto;">
    <div style="background:#ffffff; border:1px solid #dfe4ea; border-radius:10px; padding:30px; margin-bottom:25px;">
        <h1 style="margin:0 0 8px; font-size:32px; color:#1f2937;">OJAS</h1>
        <p style="margin:0; color:#4b5563; font-size:16px;">International Journal Platform for high-quality, peer-reviewed research.</p>
    </div>

    <div style="background:#ffffff; border:1px solid #dfe4ea; border-radius:10px; padding:20px; margin-bottom:20px;">
        <h3 style="margin-top:0; color:#1f2937;">Search Journals & Articles</h3>
        <form id="dynamicSearchForm" class="row" onsubmit="return false;">
            <div class="col-md-4 form-group">
                <label>Search</label>
                <input id="searchInput" type="text" class="form-control" placeholder="Title, author, abstract, keywords">
            </div>
            <div class="col-md-2 form-group">
                <label>Thematic Area</label>
                <select id="thematicFilter" class="form-control">
                    <option value="">All</option>
                    <option value="research">Research Articles</option>
                    <option value="review">Review Articles</option>
                    <option value="short_communication">Short Communications</option>
                    <option value="case_study">Case Studies</option>
                    <option value="technical_note">Technical Notes</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <label>Field</label>
                <select id="fieldFilter" class="form-control">
                    <option value="all">All Fields</option>
                    <option value="title">Title</option>
                    <option value="author">Authors</option>
                    <option value="abstract">Abstract</option>
                </select>
            </div>
            <div class="col-md-2 form-group">
                <label>Journal Type</label>
                <select id="journalTypeFilter" class="form-control">
                    <option value="">All</option>
                    <option value="research">Research</option>
                    <option value="review">Review</option>
                    <option value="short_communication">Short Communication</option>
                    <option value="case_study">Case Study</option>
                    <option value="technical_note">Technical Note</option>
                </select>
            </div>
            <div class="col-md-2 form-group" style="padding-top:24px;">
                <a href="<?= base_url('journal/search'); ?>" class="btn btn-default btn-block">Advanced Search</a>
            </div>
        </form>
    </div>

    <div id="resultsMeta" style="color:#6b7280; margin-bottom:10px;"></div>
    <div id="resultsContainer"></div>
</section>

<script>
(function() {
    var searchInput = document.getElementById('searchInput');
    var thematicFilter = document.getElementById('thematicFilter');
    var fieldFilter = document.getElementById('fieldFilter');
    var journalTypeFilter = document.getElementById('journalTypeFilter');
    var resultsMeta = document.getElementById('resultsMeta');
    var resultsContainer = document.getElementById('resultsContainer');
    var timer = null;

    function escapeHtml(s) {
        if (!s) return '';
        return s.replace(/[&<>"']/g, function(m) {
            return ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[m];
        });
    }

    function runSearch() {
        var params = new URLSearchParams();
        params.append('q', searchInput.value.trim());
        params.append('type', thematicFilter.value || journalTypeFilter.value);
        params.append('field', fieldFilter.value);

        fetch('<?= base_url('journal/search_api'); ?>?' + params.toString())
            .then(function(res) { return res.json(); })
            .then(function(data) {
                resultsMeta.textContent = data.count + ' result(s) found';
                if (!data.results.length) {
                    resultsContainer.innerHTML = '<div class="alert alert-info">No articles found with selected filters.</div>';
                    return;
                }

                var html = data.results.map(function(item) {
                    var abs = item.abstract_text || '';
                    if (abs.length > 260) abs = abs.substring(0, 260) + '...';
                    return '<div class="article-card">' +
                        '<h4 style="margin-top:0; color:#1f2937;">' + escapeHtml(item.title) + '</h4>' +
                        '<p class="text-muted">' + escapeHtml(item.author_names || 'N/A') +
                        ' | Vol ' + item.volume + ', Issue ' + item.issueNumber + ' (' + item.year + ')</p>' +
                        '<p>' + escapeHtml(abs) + '</p>' +
                        '<a href="<?= base_url('journal/article/'); ?>' + item.articleId + '" class="btn btn-outline-ojas">View Details</a>' +
                    '</div>';
                }).join('');
                resultsContainer.innerHTML = html;
            })
            .catch(function() {
                resultsContainer.innerHTML = '<div class="alert alert-danger">Unable to load search results right now.</div>';
            });
    }

    [searchInput, thematicFilter, fieldFilter, journalTypeFilter].forEach(function(el) {
        el.addEventListener('input', function() {
            clearTimeout(timer);
            timer = setTimeout(runSearch, 250);
        });
        el.addEventListener('change', runSearch);
    });

    runSearch();
})();
</script>
