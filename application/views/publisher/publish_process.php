<div class="content-wrapper">
    <section class="content-header">
        <h1>Publishing Process</h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Finalize Publishing: <?= html_escape($manuscript->manuscriptNumber) ?> - <?= html_escape($manuscript->title) ?></h3>
            </div>
            <div class="box-body">
                <div class="alert alert-info">
                    <strong>OJAS publication is free.</strong> Select the public issue and DOI details, then publish after the author-approved proof is ready.
                </div>

                <?php if (!empty($manuscript->proof_file_path)): ?>
                    <p>
                        <strong>Author-approved proof:</strong>
                        <a href="<?= base_url($manuscript->proof_file_path) ?>" target="_blank" rel="noopener">
                            <?= html_escape($manuscript->proof_file_name ?: 'View proof file') ?>
                        </a>
                    </p>
                <?php endif; ?>

                <form method="post" action="<?= base_url('publisher/publish/submit/' . (int)$manuscript->manuscriptId) ?>">
                    <h4>DOI Assignment</h4>
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label>DOI Prefix</label><input class="form-control" name="doi_prefix" value="<?= html_escape((string)$manuscript->doi_prefix) ?>" required></div></div>
                        <div class="col-md-6"><div class="form-group"><label>DOI Suffix</label><input class="form-control" name="doi_suffix" value="<?= html_escape((string)$manuscript->doi_suffix) ?>" required></div></div>
                    </div>
                    <div class="form-group">
                        <label>Select Issue</label>
                        <select class="form-control" name="issueId" required>
                            <option value="">Select Issue</option>
                            <?php foreach(($issues??[]) as $issue): ?>
                                <?php $selected = !empty($manuscript->pub_issue_id) && (int)$manuscript->pub_issue_id === (int)$issue->issueId; ?>
                                <option value="<?= (int)$issue->issueId ?>" <?= $selected ? 'selected' : '' ?>>Vol <?= (int)$issue->volume ?>, Issue <?= (int)$issue->issueNumber ?><?= !empty($issue->title) ? ' - ' . html_escape($issue->title) : '' ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button class="btn btn-primary" type="submit">Submit Publishing Process</button>
                </form>
                <hr>
                <form method="post" action="<?= base_url('publisher/publish/do-publish/' . (int)$manuscript->manuscriptId) ?>">
                    <?php $canPublish = ($manuscript->production_status === 'doi_prepared' || $manuscript->production_status === 'proof_approved') && $manuscript->author_proof_decision === 'accepted'; ?>
                    <button class="btn btn-success" type="submit" <?= $canPublish ? '' : 'disabled' ?>>Publish</button>
                    <p class="help-block">Publish is enabled after the author accepts the publisher proof. No payment action is required.</p>
                </form>
            </div>
        </div>
    </section>
</div>
