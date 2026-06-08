<div class="content-wrapper">
  <section class="content-header">
    <h1>Author Proofing</h1>
    <ol class="breadcrumb"><li><a href="<?= base_url('author/proofing-pending') ?>">Proofing Pending</a></li><li class="active"><?= html_escape($manuscript->manuscriptNumber) ?></li></ol>
  </section>
  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border"><h3 class="box-title"><?= html_escape($manuscript->manuscriptNumber) ?> - <?= html_escape($manuscript->title) ?></h3></div>
      <div class="box-body">
        <div class="form-group">
          <label>Publisher Message</label>
          <div class="well"><?= nl2br(html_escape($manuscript->proof_message ?: 'No message provided.')) ?></div>
        </div>
        <div class="form-group">
          <label>Proof Document</label>
          <?php if (!empty($manuscript->proof_file_path)): ?>
            <p><a class="btn btn-default" href="<?= base_url($manuscript->proof_file_path) ?>" target="_blank"><i class="fa fa-download"></i> <?= html_escape($manuscript->proof_file_name ?: 'Download proof document') ?></a></p>
          <?php else: ?>
            <p class="text-muted">No proof document is available.</p>
          <?php endif; ?>
        </div>

        <form method="post" enctype="multipart/form-data" action="<?= base_url('author/proofing/respond/' . (int)$manuscript->manuscriptId) ?>">
          <div class="form-group">
            <label>Comment</label>
            <textarea class="form-control" name="author_proof_comment" rows="5" placeholder="Write approval note, requested updates, or rejection reason."><?= html_escape($manuscript->author_proof_comment ?? '') ?></textarea>
          </div>
          <div class="form-group">
            <label>Upload Comments (optional)</label>
            <?php if (!empty($manuscript->author_proof_file_path)): ?>
              <p class="help-block">Current uploaded comments: <a href="<?= base_url($manuscript->author_proof_file_path) ?>" target="_blank"><?= html_escape($manuscript->author_proof_file_name ?: 'Download file') ?></a></p>
            <?php endif; ?>
            <input type="file" name="proof_comments_file" class="form-control">
          </div>
          <button class="btn btn-success" name="action" value="accept" type="submit"><i class="fa fa-check"></i> Accept</button>
          <button class="btn btn-warning" name="action" value="update" type="submit"><i class="fa fa-comment"></i> Update</button>
          <button class="btn btn-danger" name="action" value="reject" type="submit"><i class="fa fa-times"></i> Reject</button>
          <a class="btn btn-default" href="<?= base_url('author/proofing-pending') ?>">Back</a>
        </form>
      </div>
    </div>
  </section>
</div>
