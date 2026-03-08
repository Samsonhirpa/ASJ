<div class="content-wrapper">
    <section class="content-header">
        <h1>Completed Reviews <small>Your review history</small></h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead><tr><th>Manuscript #</th><th>Title</th><th>Recommendation</th><th>Score</th><th>Submitted Date</th><th>Attachment</th></tr></thead>
                    <tbody>
                    <?php if (!empty($completedReviews)): foreach ($completedReviews as $item): ?>
                        <tr>
                            <td><?= $item->manuscriptNumber ?></td>
                            <td><?= html_escape(strlen($item->title) > 90 ? substr($item->title,0,90).'...' : $item->title) ?></td>
                            <td><?= ucwords(str_replace('_', ' ', $item->recommendationDecision ?: '-')) ?></td>
                            <td><?= $item->score ?: '-' ?></td>
                            <td><?= $item->reviewSubmittedDate ? date('d M Y H:i', strtotime($item->reviewSubmittedDate)) : '-' ?></td>
                            <td>
                                <?php if (!empty($item->reviewFilePath)): ?>
                                    <a href="<?= base_url($item->reviewFilePath) ?>" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-download"></i> Download</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center text-muted">No completed reviews yet.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
