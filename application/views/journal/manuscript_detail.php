<div class="container" style="margin-top:30px; margin-bottom:40px;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" style="border-top:4px solid #1f5a3e; box-shadow:0 8px 20px rgba(0,0,0,.05);">
                <div class="panel-body" style="padding:30px;">
                    <p>
                        <a href="<?= base_url('journal') ?>" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back to Home</a>
                    </p>

                    <h2 style="margin-top:10px; color:#123524;"><?= html_escape($article->title); ?></h2>

                    <p class="text-muted" style="margin-top:10px;">
                        <strong>Manuscript #:</strong> <?= html_escape($article->manuscriptNumber); ?> |
                        <strong>Type:</strong> <?= html_escape(get_article_type_name($article->articleType)); ?>
                    </p>

                    <p class="text-muted">
                        <strong>Issue:</strong>
                        <?php if (!empty($article->volume) && !empty($article->issueNumber)): ?>
                            Volume <?= (int)$article->volume; ?>, Issue <?= (int)$article->issueNumber; ?>
                            <?php if (!empty($article->issue_year)): ?>(<?= (int)$article->issue_year; ?>)<?php endif; ?>
                        <?php else: ?>
                            Not assigned
                        <?php endif; ?>
                        | <strong>Published:</strong> <?= !empty($article->publishedDate) ? date('Y-m-d', strtotime($article->publishedDate)) : '-' ?>
                    </p>

                    <?php if (!empty($article->doi)): ?>
                        <p><strong>DOI:</strong> <?= html_escape($article->doi); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($article->authors)): ?>
                        <h4 style="margin-top:25px; color:#1f5a3e;">Authors</h4>
                        <ul>
                            <?php foreach($article->authors as $author): ?>
                                <li>
                                    <?= html_escape($author->name); ?>
                                    <?php if ((int)$author->isCorresponding === 1): ?>
                                        <span class="label label-success">Corresponding</span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <h4 style="margin-top:25px; color:#1f5a3e;">Abstract</h4>
                    <p style="line-height:1.8; text-align:justify;">
                        <?= nl2br(html_escape($article->abstract)); ?>
                    </p>

                    <?php if (!empty($article->keywords)): ?>
                        <h4 style="margin-top:25px; color:#1f5a3e;">Keywords</h4>
                        <p><?= html_escape($article->keywords); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
