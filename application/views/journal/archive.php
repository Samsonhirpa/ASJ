<section class="content-header" style="margin-bottom: 20px;">
    <h2><i class="fa fa-archive"></i> Journal Archive</h2>
</section>

<section class="content">
    <div class="row">
        <?php if (!empty($issues)): ?>
            <?php foreach ($issues as $issue): ?>
                <div class="col-md-6">
                    <div class="article-card">
                        <h4 style="margin-top:0;">Volume <?= (int) $issue->volume; ?>, Issue <?= (int) $issue->issueNumber; ?> (<?= html_escape($issue->year); ?>)</h4>
                        <p><?= !empty($issue->month) ? html_escape($issue->month) : 'Month unavailable'; ?></p>
                        <p>
                            <span class="label label-<?= $issue->status === 'published' ? 'success' : 'default'; ?>">
                                <?= html_escape(ucfirst($issue->status)); ?>
                            </span>
                        </p>
                        <a href="<?= base_url('journal/issue/' . $issue->issueId); ?>" class="btn btn-outline-ojas">Browse Issue</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-md-12"><div class="alert alert-info">Archive is currently empty.</div></div>
        <?php endif; ?>
    </div>
</section>
