<div class="content-wrapper">
  <section class="content-header"><h1>Production Stage</h1></section>
  <section class="content">
    <?php if (empty($manuscripts)): ?>
      <div class="alert alert-info">No manuscripts in production queue.</div>
    <?php endif; ?>

    <?php foreach ($manuscripts as $m): ?>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= html_escape($m->manuscriptNumber) ?> - <?= html_escape($m->title) ?></h3>
          <p class="text-muted">Status: <strong><?= html_escape($m->production_status ?: 'in_production') ?></strong></p>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
              <h4>Copyediting</h4>
              <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                <input type="hidden" name="step" value="copyediting">
                <textarea name="copyediting_notes" class="form-control" rows="3" placeholder="Copyediting notes"><?= html_escape($m->copyediting_notes ?? '') ?></textarea><br>
                <label><input type="checkbox" name="grammar_checked" value="1" <?= !empty($m->grammar_checked) ? 'checked' : '' ?>> Grammar checked</label><br>
                <label><input type="checkbox" name="references_checked" value="1" <?= !empty($m->references_checked) ? 'checked' : '' ?>> References checked</label><br><br>
                <button class="btn btn-default" name="action" value="save">Save</button>
                <button class="btn btn-primary" name="action" value="send_typesetting">Send to Typesetting</button>
              </form>
            </div>
            <div class="col-md-6">
              <h4>Typesetting</h4>
              <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                <input type="hidden" name="step" value="typesetting">
                <input class="form-control" name="page_numbers" placeholder="Page numbers" value="<?= html_escape($m->page_numbers ?? '') ?>"><br>
                <textarea name="layout_notes" class="form-control" rows="3" placeholder="Layout notes"><?= html_escape($m->layout_notes ?? '') ?></textarea><br>
                <button class="btn btn-default" name="action" value="save">Save Proof</button>
                <button class="btn btn-warning" name="action" value="send_proof">Send Proof to Author</button>
              </form>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <h4>Proof Processing</h4>
              <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                <input type="hidden" name="step" value="proof">
                <button class="btn btn-success" name="action" value="finalize">Finalize Proof</button>
              </form>
            </div>
            <div class="col-md-6">
              <h4>Metadata Verification</h4>
              <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                <input type="hidden" name="step" value="metadata">
                <input class="form-control" name="final_title" placeholder="Final title" value="<?= html_escape($m->final_title ?? '') ?>"><br>
                <textarea class="form-control" name="final_abstract" placeholder="Abstract"><?= html_escape($m->final_abstract ?? '') ?></textarea><br>
                <input class="form-control" name="final_keywords" placeholder="Keywords" value="<?= html_escape($m->final_keywords ?? '') ?>"><br>
                <input class="form-control" name="final_authors" placeholder="Author names" value="<?= html_escape($m->final_authors ?? '') ?>"><br>
                <input class="form-control" name="final_orcid_ids" placeholder="ORCID IDs" value="<?= html_escape($m->final_orcid_ids ?? '') ?>"><br>
                <input class="form-control" name="corresponding_email" placeholder="Corresponding author email" value="<?= html_escape($m->corresponding_email ?? '') ?>"><br>
                <button class="btn btn-default" name="action" value="save">Save Metadata</button>
                <button class="btn btn-info" name="action" value="prepare_doi">Prepare DOI</button>
              </form>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-6">
              <h4>DOI Preparation</h4>
              <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                <input type="hidden" name="step" value="doi">
                <input class="form-control" name="doi_prefix" placeholder="DOI prefix" value="<?= html_escape($m->doi_prefix ?? '') ?>"><br>
                <input class="form-control" name="doi_suffix" placeholder="DOI suffix" value="<?= html_escape($m->doi_suffix ?? '') ?>"><br>
                <input class="form-control" name="full_doi" readonly value="<?= html_escape($m->full_doi ?? '') ?>"><br>
                <button class="btn btn-default" name="action" value="save_doi">Save DOI</button>
              </form>
            </div>
            <div class="col-md-6">
              <h4>Publication</h4>
              <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                <input type="hidden" name="step" value="publish">
                <input class="form-control" name="volume" placeholder="Volume" value="<?= html_escape($m->pub_volume ?? '') ?>"><br>
                <input class="form-control" name="issue" placeholder="Issue" value="<?= html_escape($m->pub_issue ?? '') ?>"><br>
                <input class="form-control" type="date" name="publication_date" value="<?= html_escape($m->publication_date ?? '') ?>"><br>
                <button class="btn btn-primary" name="action" value="publish">Publish Final Article</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </section>
</div>
