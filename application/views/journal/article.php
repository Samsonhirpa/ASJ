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


        <?php if (!empty($article->proof_file_path)): ?>
            <h4>Full Manuscript</h4>
            <p>
                <a href="<?= base_url($article->proof_file_path); ?>" target="_blank" rel="noopener" class="btn btn-success">
                    <i class="fa fa-eye"></i> Read Manuscript
                </a>
                <a href="<?= base_url($article->proof_file_path); ?>" download class="btn btn-outline-ojas">
                    <i class="fa fa-download"></i> Download Manuscript
                </a>
            </p>
            <?php $proofExt = strtolower(pathinfo($article->proof_file_path, PATHINFO_EXTENSION)); ?>
            <?php if ($proofExt === 'pdf'): ?>
                <iframe src="<?= base_url($article->proof_file_path); ?>" style="width:100%; min-height:700px; border:1px solid #ddd; border-radius:8px;" title="Published manuscript PDF"></iframe>
            <?php endif; ?>
        <?php endif; ?>

        <a href="<?= base_url('journal/issue/' . $article->issueId); ?>" class="btn btn-outline-ojas"><i class="fa fa-arrow-left"></i> Back to Issue</a>
    </div>
</section>
