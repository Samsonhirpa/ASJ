<div class="content-wrapper">
    <section class="content-header"><h1>All Manuscripts</h1></section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead><tr><th>Manuscript</th><th>Author</th><th>Status</th><th>Plagiarism</th><th>Reviews</th><th></th></tr></thead>
                    <tbody>
                    <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                        <tr>
                            <td><strong><?= html_escape($m->manuscriptNumber) ?></strong><br><?= html_escape($m->title) ?></td>
                            <td><?= html_escape($m->authorName) ?></td>
                            <td><?= html_escape($m->status) ?></td>
                            <td><?= $m->plagiarismScore !== null ? number_format($m->plagiarismScore, 2).'%' : '-' ?></td>
                            <td><?= (int)$m->completedReviews ?>/<?= (int)$m->reviewerCount ?></td>
                            <td><a href="<?= base_url('editor/manuscript/'.$m->manuscriptId) ?>" class="btn btn-xs btn-primary">Workflow</a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center">No manuscripts available.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
