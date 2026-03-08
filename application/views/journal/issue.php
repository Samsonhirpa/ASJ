<section class="content-header" style="margin-bottom: 20px;">
    <h2>
        <i class="fa fa-newspaper-o"></i>
        Volume <?= (int) $issue->volume; ?>, Issue <?= (int) $issue->issueNumber; ?> (<?= html_escape($issue->year); ?>)
    </h2>
</section>

<section class="content">
    <?php if (!empty($issue->articles)): ?>
        <?php foreach ($issue->articles as $article): ?>
            <div class="article-card">
                <h4 style="margin-top:0;"><?= html_escape($article->title); ?></h4>
                <p><strong>Authors:</strong> <?= html_escape($article->author_names); ?></p>
                <p><strong>Type:</strong> <?= html_escape(ucwords(str_replace('_', ' ', $article->articleType))); ?></p>
                <p><strong>Pages:</strong> <?= (int) $article->pageStart; ?> - <?= (int) $article->pageEnd; ?></p>
                <p><?= strlen(strip_tags($article->abstract)) > 280 ? html_escape(substr(strip_tags($article->abstract), 0, 280)) . '...' : html_escape(strip_tags($article->abstract)); ?></p>
                <a href="<?= base_url('journal/article/' . $article->articleId); ?>" class="btn btn-outline-ojas">Read Article</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">No articles have been added to this issue yet.</div>
    <?php endif; ?>
</section>
