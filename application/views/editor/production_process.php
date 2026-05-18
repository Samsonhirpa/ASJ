<div class="content-wrapper">
  <section class="content-header">
    <h1>Production Process</h1>
    <ol class="breadcrumb">
      <li><a href="<?= base_url('editor/production-stage') ?>"><i class="fa fa-arrow-left"></i> Production Stage</a></li>
      <li class="active">Manuscript #<?= (int)$manuscript->manuscriptId ?></li>
    </ol>
  </section>

  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title"><?= html_escape($manuscript->manuscriptNumber) ?> - <?= html_escape($manuscript->title) ?></h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <h4>Copyediting</h4>
            <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$manuscript->manuscriptId) ?>">
              <input type="hidden" name="step" value="copyediting">
              <textarea name="copyediting_notes" class="form-control" rows="4" placeholder="Copyediting notes"><?= html_escape($manuscript->copyediting_notes ?? '') ?></textarea><br>
              <label><input type="checkbox" name="grammar_checked" value="1" <?= !empty($manuscript->grammar_checked) ? 'checked' : '' ?>> Grammar checked</label><br>
              <label><input type="checkbox" name="references_checked" value="1" <?= !empty($manuscript->references_checked) ? 'checked' : '' ?>> References checked</label><br><br>
              <button class="btn btn-default btn-sm" name="action" value="save">Save</button>
              <button class="btn btn-primary btn-sm" name="action" value="send_typesetting">Send to Typesetting</button>
            </form>
          </div>

          <div class="col-md-4">
            <h4>Typesetting</h4>
            <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$manuscript->manuscriptId) ?>">
              <input type="hidden" name="step" value="typesetting">
              <input class="form-control" name="page_numbers" placeholder="Page numbers" value="<?= html_escape($manuscript->page_numbers ?? '') ?>"><br>
              <textarea name="layout_notes" class="form-control" rows="4" placeholder="Layout notes"><?= html_escape($manuscript->layout_notes ?? '') ?></textarea><br>
              <button class="btn btn-default btn-sm" name="action" value="save">Save</button>
              <button class="btn btn-warning btn-sm" name="action" value="send_proof">Send Proof</button>
            </form>
          </div>

          <div class="col-md-4">
            <h4>Metadata Verification</h4>
            <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$manuscript->manuscriptId) ?>">
              <input type="hidden" name="step" value="metadata">
              <input class="form-control" name="final_title" placeholder="Final title" value="<?= html_escape($manuscript->final_title ?? '') ?>"><br>
              <textarea class="form-control" name="final_abstract" rows="4" placeholder="Final abstract"><?= html_escape($manuscript->final_abstract ?? '') ?></textarea><br>
              <input class="form-control" name="final_keywords" placeholder="Final keywords" value="<?= html_escape($manuscript->final_keywords ?? '') ?>"><br>
              <input class="form-control" name="final_authors" placeholder="Final authors" value="<?= html_escape($manuscript->final_authors ?? '') ?>"><br>
              <input class="form-control" name="final_orcid_ids" placeholder="ORCID IDs" value="<?= html_escape($manuscript->final_orcid_ids ?? '') ?>"><br>
              <input class="form-control" name="corresponding_email" placeholder="Corresponding author email" value="<?= html_escape($manuscript->corresponding_email ?? '') ?>"><br>
              <button class="btn btn-default btn-sm" name="action" value="save">Save</button>
              <button class="btn btn-info btn-sm" name="action" value="prepare_doi">Complete Verification</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
