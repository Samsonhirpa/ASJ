<div class="content-wrapper">
  <section class="content-header">
    <h1>Send Proof to Author</h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('editor/production-stage') ?>"><i class="fa fa-arrow-left"></i> Production Stage</a></li>
      <li class="active"><?= html_escape($manuscript->manuscriptNumber) ?></li>
    </ol>
  </section>

  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?= html_escape($manuscript->manuscriptNumber) ?> - <?= html_escape($manuscript->title) ?></h3>
      </div>
      <div class="box-body">
        <div class="callout callout-info">
          <p>Complete metadata verification, local copyediting, and typesetting on your computer. Then upload the final proof manuscript and send it to the author for comment or approval.</p>
        </div>

        <?php if (!empty($manuscript->author_proof_comment)): ?>
          <div class="box box-warning">
            <div class="box-header with-border"><h3 class="box-title">Author Proof Response</h3></div>
            <div class="box-body">
              <p><strong>Decision:</strong> <?= html_escape(ucfirst((string)$manuscript->author_proof_decision)) ?></p>
              <p><strong>Comment:</strong><br><?= nl2br(html_escape($manuscript->author_proof_comment)) ?></p>
              <?php if (!empty($manuscript->author_proof_file_path)): ?>
                <p><strong>Uploaded comments file:</strong> <a href="<?= base_url($manuscript->author_proof_file_path) ?>" target="_blank"><?= html_escape($manuscript->author_proof_file_name ?: 'Download file') ?></a></p>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" action="<?= base_url('editor/production-stage/save/' . (int)$manuscript->manuscriptId) ?>">
          <input type="hidden" name="step" value="send_proof">
          <h4>Metadata Verification</h4>
          <div class="form-group">
            <label>Final Title</label>
            <input class="form-control" name="final_title" value="<?= html_escape($manuscript->final_title ?: $manuscript->title) ?>" required>
          </div>
          <div class="form-group">
            <label>Abstract</label>
            <textarea class="form-control" name="final_abstract" rows="6" required><?= html_escape($manuscript->final_abstract ?: $manuscript->abstract) ?></textarea>
          </div>
          <div class="form-group">
            <label>Key Words</label>
            <input class="form-control" name="final_keywords" value="<?= html_escape($manuscript->final_keywords ?: $manuscript->keywords) ?>" required>
          </div>
          <div class="form-group">
            <label>Message to Author</label>
            <textarea class="form-control" name="proof_message" rows="4" required><?= html_escape($manuscript->proof_message ?? '') ?></textarea>
          </div>
          <div class="form-group">
            <label>Final Manuscript Proof</label>
            <?php if (!empty($manuscript->proof_file_path)): ?>
              <p class="help-block">Current proof: <a href="<?= base_url($manuscript->proof_file_path) ?>" target="_blank"><?= html_escape($manuscript->proof_file_name ?: 'Download proof') ?></a></p>
            <?php endif; ?>
            <input type="file" name="final_manuscript" class="form-control" required>
          </div>
          <button class="btn btn-success" type="submit"><i class="fa fa-send"></i> Send Proof to Author</button>
          <a class="btn btn-default" href="<?= base_url('editor/production-stage') ?>">Cancel</a>
        </form>
      </div>
    </div>
  </section>
</div>
