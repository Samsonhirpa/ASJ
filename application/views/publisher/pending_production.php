<div class="content-wrapper">
  <section class="content-header"><h1>Pending Production</h1></section>
  <section class="content">
    <div class="box box-primary">
      <div class="box-body table-responsive">
        <table class="table table-bordered">
          <thead><tr><th>ID</th><th>Manuscript</th><th>Title</th><th>Status</th><th>Action</th></tr></thead>
          <tbody>
          <?php if (empty($manuscripts)): ?>
            <tr><td colspan="5" class="text-center text-muted">No pending production manuscripts.</td></tr>
          <?php else: foreach(($manuscripts ?? []) as $m): ?>
            <tr>
              <td><?= (int)$m->manuscriptId ?></td>
              <td><?= html_escape($m->manuscriptNumber) ?></td>
              <td><?= html_escape($m->title) ?></td>
              <td><?= html_escape($m->production_status ?: 'in_production') ?></td>
              <td><a class="btn btn-xs btn-primary" href="<?= base_url('publisher/production-process/' . (int)$m->manuscriptId) ?>">Start</a></td>
            </tr>
          <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
