<div class="content-wrapper">
  <section class="content-header"><h1>Production Stage</h1></section>
  <section class="content">
    <?php if (empty($manuscripts)): ?>
      <div class="alert alert-info">No manuscripts in production queue.</div>
    <?php else: ?>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Pending Production Manuscripts</h3>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th><th>Manuscript No.</th><th>Title</th><th>Production Status</th><th>Other Info</th><th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($manuscripts as $m): ?>
                <tr>
                  <td><?= (int)$m->manuscriptId ?></td>
                  <td><?= html_escape($m->manuscriptNumber) ?></td>
                  <td><?= html_escape($m->title) ?></td>
                  <td><span class="label label-info"><?= html_escape($m->production_status ?: 'in_production') ?></span></td>
                  <td><?= html_escape(isset($m->decision) ? ($m->decision ?: '-') : '-') ?></td>
                  <td><button type="button" class="btn btn-xs btn-primary" data-toggle="collapse" data-target="#prod-<?= (int)$m->manuscriptId ?>">Start</button></td>
                </tr>
                <tr>
                  <td colspan="6" style="padding:0;border-top:none;">
                    <div id="prod-<?= (int)$m->manuscriptId ?>" class="collapse" style="padding:15px; background:#f9fbfd;">
                      <div class="row">
                        <div class="col-md-4">
                          <h4>Copyediting</h4>
                          <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                            <input type="hidden" name="step" value="copyediting">
                            <textarea name="copyediting_notes" class="form-control" rows="3" placeholder="Copyediting notes"><?= html_escape($m->copyediting_notes ?? '') ?></textarea><br>
                            <label><input type="checkbox" name="grammar_checked" value="1" <?= !empty($m->grammar_checked) ? 'checked' : '' ?>> Grammar checked</label><br>
                            <label><input type="checkbox" name="references_checked" value="1" <?= !empty($m->references_checked) ? 'checked' : '' ?>> References checked</label><br><br>
                            <button class="btn btn-default btn-sm" name="action" value="save">Save</button>
                            <button class="btn btn-primary btn-sm" name="action" value="send_typesetting">Send to Typesetting</button>
                          </form>
                        </div>
                        <div class="col-md-4">
                          <h4>Typesetting</h4>
                          <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                            <input type="hidden" name="step" value="typesetting">
                            <input class="form-control" name="page_numbers" placeholder="Page numbers" value="<?= html_escape($m->page_numbers ?? '') ?>"><br>
                            <textarea name="layout_notes" class="form-control" rows="3" placeholder="Layout notes"><?= html_escape($m->layout_notes ?? '') ?></textarea><br>
                            <button class="btn btn-default btn-sm" name="action" value="save">Save</button>
                            <button class="btn btn-warning btn-sm" name="action" value="send_proof">Send Proof</button>
                          </form>
                        </div>
                        <div class="col-md-4">
                          <h4>Metadata Verification</h4>
                          <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                            <input type="hidden" name="step" value="metadata">
                            <input class="form-control" name="final_title" placeholder="Final title" value="<?= html_escape($m->final_title ?? '') ?>"><br>
                            <input class="form-control" name="final_keywords" placeholder="Keywords" value="<?= html_escape($m->final_keywords ?? '') ?>"><br>
                            <input class="form-control" name="corresponding_email" placeholder="Corresponding author email" value="<?= html_escape($m->corresponding_email ?? '') ?>"><br>
                            <button class="btn btn-default btn-sm" name="action" value="save">Save</button>
                            <button class="btn btn-info btn-sm" name="action" value="prepare_doi">Complete Verification</button>
                          </form>
                        </div>
                      </div><hr>
                      <div class="row">
                        <div class="col-md-6">
                          <h4>DOI Assignment</h4>
                          <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                            <input type="hidden" name="step" value="doi">
                            <input class="form-control" name="doi_prefix" placeholder="DOI prefix" value="<?= html_escape($m->doi_prefix ?? '') ?>"><br>
                            <input class="form-control" name="doi_suffix" placeholder="DOI suffix" value="<?= html_escape($m->doi_suffix ?? '') ?>"><br>
                            <button class="btn btn-default btn-sm" name="action" value="save_doi">Save DOI</button>
                          </form>
                        </div>
                        <div class="col-md-6">
                          <h4>Final Publishing</h4>
                          <form method="post" action="<?= base_url('editor/production-stage/save/' . (int)$m->manuscriptId) ?>">
                            <input type="hidden" name="step" value="publish">
                            <select class="form-control" name="volume" required>
                              <option value="">Select Volume</option>
                              <?php foreach (($issues ?? []) as $issue): ?>
                                <option value="<?= (int)$issue->volume ?>" <?= ((string)$m->pub_volume === (string)$issue->volume) ? 'selected' : '' ?>>Volume <?= (int)$issue->volume ?></option>
                              <?php endforeach; ?>
                            </select><br>
                            <select class="form-control" name="issue" required>
                              <option value="">Select Issue</option>
                              <?php foreach (($issues ?? []) as $issue): ?>
                                <option value="<?= (int)$issue->issueNumber ?>" <?= ((string)$m->pub_issue === (string)$issue->issueNumber) ? 'selected' : '' ?>>Issue <?= (int)$issue->issueNumber ?> (Vol <?= (int)$issue->volume ?>)</option>
                              <?php endforeach; ?>
                            </select><br>
                            <input class="form-control" type="date" name="publication_date" value="<?= html_escape($m->publication_date ?? '') ?>"><br>
                            <button class="btn btn-success btn-sm" name="action" value="publish">Publish Final Article</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    <?php endif; ?>
  </section>
</div>
