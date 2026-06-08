<div class="content-wrapper">
  <section class="content-header">
    <h1>Production Stage</h1>
    <ol class="breadcrumb"><li class="active">Publisher Production</li></ol>
  </section>

  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Not Published Manuscripts</h3>
      </div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Manuscript No.</th>
              <th>Title</th>
              <th>Thematic Area</th>
              <th>Production Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($manuscripts ?? [])): ?>
              <tr><td colspan="5" class="text-center text-muted">No unpublished manuscripts are currently in production.</td></tr>
            <?php else: foreach ($manuscripts as $m): ?>
              <?php
                $status = (string)($m->production_status ?? '');
                if ($status === 'proof_sent') {
                    $label = 'Proof Sent';
                    $class = 'label label-info';
                } elseif ($status === 'proof_commented') {
                    $label = 'Proof Commented';
                    $class = 'label label-warning';
                } elseif ($status === 'proof_rejected') {
                    $label = 'Rejected';
                    $class = 'label label-danger';
                } else {
                    $label = 'Proof Not Sent';
                    $class = 'label label-default';
                }
              ?>
              <tr>
                <td><?= html_escape($m->manuscriptNumber) ?></td>
                <td><?= html_escape($m->title) ?></td>
                <td><?= html_escape($m->thematicArea ?? '-') ?></td>
                <td><span class="<?= $class ?>"><?= $label ?></span></td>
                <td>
                  <a href="<?= base_url('editor/production-stage/process/' . (int)$m->manuscriptId) ?>" class="btn btn-xs btn-primary">View</a>
                </td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
