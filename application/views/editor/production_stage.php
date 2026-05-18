<div class="content-wrapper">
  <section class="content-header"><h1>Production Stage</h1></section>
  <section class="content">
    <div class="box">
      <div class="box-header"><h3 class="box-title">Publisher workflow queue (Role ID: 17)</h3></div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead><tr><th>Manuscript #</th><th>Title</th><th>Status</th><th>Tasks</th></tr></thead>
          <tbody>
          <?php if (empty($manuscripts)): ?>
            <tr><td colspan="4" class="text-center">No manuscripts in production queue.</td></tr>
          <?php else: foreach ($manuscripts as $m): ?>
            <tr>
              <td><?= html_escape($m->manuscriptNumber) ?></td>
              <td><?= html_escape($m->title) ?></td>
              <td><span class="label label-primary">In Production</span></td>
              <td>Copyediting, Typesetting, Metadata verification, DOI preparation, Crossref integration preparation</td>
            </tr>
          <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
