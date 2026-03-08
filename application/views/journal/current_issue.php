<section class="content-header" style="margin-bottom: 20px;">
    <h2><i class="fa fa-book"></i> Current Issue</h2>
</section>

<section class="content">
    <?php if (!empty($issue)): ?>
        <div class="article-card">
            <h3 style="margin-top:0;">Volume <?= (int) $issue->volume; ?>, Issue <?= (int) $issue->issueNumber; ?> (<?= html_escape($issue->year); ?>)</h3>
            <p><strong>Month:</strong> <?= !empty($issue->month) ? html_escape($issue->month) : 'N/A'; ?></p>
            <p><strong>Status:</strong> <span class="label label-success"><?= html_escape(ucfirst($issue->status)); ?></span></p>
            <?php if (!empty($issue->description)): ?>
                <p><?= nl2br(html_escape($issue->description)); ?></p>
            <?php endif; ?>
            <a href="<?= base_url('journal/issue/' . $issue->issueId); ?>" class="btn btn-ojas">
                <i class="fa fa-file-text"></i> View Full Issue
            </a>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No published issue is currently available.</div>
    <?php endif; ?>
</section>
