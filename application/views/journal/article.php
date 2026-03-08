<section class="content-header" style="margin-bottom: 20px;">
    <h2><i class="fa fa-file-text-o"></i> <?= html_escape($article->title); ?></h2>
    <p class="text-muted">Volume <?= (int) $article->volume; ?>, Issue <?= (int) $article->issueNumber; ?> (<?= html_escape($article->issue_year); ?>)</p>
</section>

<section class="content">
    <div class="article-card">
        <?php if (!empty($article->authors)): ?>
            <p><strong>Authors:</strong>
                <?php
                $authorNames = array();
                foreach ($article->authors as $author) {
                    $authorNames[] = html_escape($author->name);
                }
                echo implode(', ', $authorNames);
                ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($article->doi)): ?>
            <p><strong>DOI:</strong> <?= html_escape($article->doi); ?></p>
        <?php endif; ?>

        <h4>Abstract</h4>
        <p><?= nl2br(html_escape($article->abstract)); ?></p>

        <?php if (!empty($article->keywords)): ?>
            <h4>Keywords</h4>
            <p><?= html_escape($article->keywords); ?></p>
        <?php endif; ?>

        <a href="<?= base_url('journal/issue/' . $article->issueId); ?>" class="btn btn-outline-ojas"><i class="fa fa-arrow-left"></i> Back to Issue</a>
    </div>
</section>
