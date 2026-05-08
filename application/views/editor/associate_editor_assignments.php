<div class="content-wrapper">
    <section class="content-header">
        <h1>Associate Editor Pre-Review Assessment</h1>
    </section>
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Assigned manuscripts</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Manuscript</th>
                        <th>Author / Department</th>
                        <th>Assessment scores (25% each)</th>
                        <th>Recommendation</th>
                        <th>Comments</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (empty($manuscripts)): ?>
                        <tr><td colspan="6" class="text-center">No manuscripts assigned for Associate Editor pre-review.</td></tr>
                    <?php endif; ?>
                    <?php foreach ($manuscripts as $m): ?>
                        <tr>
                            <form method="post" action="<?= base_url('editor/associate-editor/save/'.$m->manuscriptId) ?>">
                                <td>
                                    <strong><?= html_escape($m->manuscriptNumber) ?></strong><br>
                                    <?= html_escape($m->title) ?><br>
                                    <a href="<?= base_url('editor/manuscript/'.$m->manuscriptId) ?>">Open manuscript</a>
                                </td>
                                <td><?= html_escape($m->authorName) ?><br><small><?= html_escape($m->authorDepartment ?: 'No department') ?></small></td>
                                <td style="min-width:240px;">
                                    <label>Scientific relevance (25%)</label>
                                    <input type="number" min="0" max="25" step="0.01" name="scientificRelevanceScore" class="form-control" required>
                                    <label>Novelty & rigor (25%)</label>
                                    <input type="number" min="0" max="25" step="0.01" name="noveltyRigorScore" class="form-control" required>
                                    <label>Ethical compliance (25%)</label>
                                    <input type="number" min="0" max="25" step="0.01" name="ethicalComplianceScore" class="form-control" required>
                                    <label>Plagiarism/iThenticate (25%)</label>
                                    <input type="number" min="0" max="25" step="0.01" name="plagiarismScore" class="form-control" required>
                                </td>
                                <td>
                                    <select name="recommendation" class="form-control" required>
                                        <option value="accept">Accept → reviewer assignment</option>
                                        <option value="revision">Revision → author</option>
                                        <option value="reject">Reject → end</option>
                                    </select>
                                </td>
                                <td><textarea name="comments" class="form-control" rows="8" placeholder="Pre-review assessment comments" required></textarea></td>
                                <td><button class="btn btn-success">Register Assessment</button></td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
