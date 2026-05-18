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
                  <td>
                    <a href="<?= base_url('editor/production-stage/process/' . (int)$m->manuscriptId) ?>" class="btn btn-xs btn-primary">Start</a>
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
