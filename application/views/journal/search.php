<section class="content-header" style="margin-bottom: 20px;">
    <h2><i class="fa fa-search"></i> Search Articles</h2>
</section>

<section class="content">
    <div class="article-card">
        <form method="get" action="<?= base_url('journal/search'); ?>" class="row">
            <div class="col-md-5 form-group">
                <label>Keyword</label>
                <input type="text" name="q" class="form-control" value="<?= html_escape($keyword); ?>" placeholder="title, author, abstract, keyword">
            </div>
            <div class="col-md-3 form-group">
                <label>Year</label>
                <select name="year" class="form-control">
                    <option value="">All years</option>
                    <?php foreach ($years as $year): ?>
                        <option value="<?= html_escape($year->year); ?>" <?= $this->input->get('year') == $year->year ? 'selected' : ''; ?>><?= html_escape($year->year); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label>Article Type</label>
                <select name="type" class="form-control">
                    <option value="">All types</option>
                    <?php foreach ($article_types as $key => $label): ?>
                        <option value="<?= html_escape($key); ?>" <?= $this->input->get('type') == $key ? 'selected' : ''; ?>><?= html_escape($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-1 form-group" style="padding-top:25px;">
                <button type="submit" class="btn btn-ojas btn-block"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>

    <?php if (!empty($results)): ?>
        <?php foreach ($results as $result): ?>
            <div class="article-card">
                <h4 style="margin-top:0;"><?= html_escape($result->title); ?></h4>
                <p class="text-muted"><?= html_escape($result->author_names); ?> | Volume <?= (int) $result->volume; ?>, Issue <?= (int) $result->issueNumber; ?> (<?= html_escape($result->year); ?>)</p>
                <p><?= strlen(strip_tags($result->abstract)) > 260 ? html_escape(substr(strip_tags($result->abstract), 0, 260)) . '...' : html_escape(strip_tags($result->abstract)); ?></p>
                <a href="<?= base_url('journal/article/' . $result->articleId); ?>" class="btn btn-outline-ojas">View Details</a>
            </div>
        <?php endforeach; ?>
    <?php elseif (!empty($keyword)): ?>
        <div class="alert alert-warning">No articles found for "<?= html_escape($keyword); ?>".</div>
    <?php endif; ?>
</section>
