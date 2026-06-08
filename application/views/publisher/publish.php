<div class="content-wrapper">
  <section class="content-header"><h1>Publish</h1></section>
  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border"><h3 class="box-title">Author-Approved Proofs Ready for Publishing</h3></div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead><tr><th>Manuscript No.</th><th>Title</th><th>Thematic Area</th><th>Proof Status</th><th>Action</th></tr></thead>
          <tbody>
            <?php if (empty($manuscripts ?? [])): ?>
              <tr><td colspan="5" class="text-center text-muted">No author-approved proofs are ready for final publishing.</td></tr>
            <?php else: foreach (($manuscripts ?? []) as $m): ?>
              <tr>
                <td><?= html_escape($m->manuscriptNumber) ?></td>
                <td><?= html_escape($m->title) ?></td>
                <td><?= html_escape($m->thematicArea ?? '-') ?></td>
                <td><span class="label label-success">Accepted</span></td>
                <td><a class="btn btn-xs btn-primary" href="<?= base_url('publisher/publish/process/' . (int)$m->manuscriptId) ?>">Finalize Publish</a></td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
