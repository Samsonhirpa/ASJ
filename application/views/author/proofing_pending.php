<div class="content-wrapper">
  <section class="content-header"><h1>Proofing Pending</h1></section>
  <section class="content">
    <div class="box box-primary">
      <div class="box-header with-border"><h3 class="box-title">Proof Documents Sent by Publisher</h3></div>
      <div class="box-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Manuscript No.</th>
              <th>Title</th>
              <th>Thematic Area</th>
              <th>Proofing Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($manuscripts ?? [])): ?>
              <tr><td colspan="5" class="text-center text-muted">No proofing documents are pending.</td></tr>
            <?php else: foreach ($manuscripts as $m): ?>
              <?php
                $decision = (string)($m->author_proof_decision ?? 'pending');
                if ($decision === 'accepted') { $label = 'Accepted'; $class = 'label label-success'; }
                elseif ($decision === 'rejected') { $label = 'Rejected'; $class = 'label label-danger'; }
                else { $label = 'Pending'; $class = 'label label-warning'; }
              ?>
              <tr>
                <td><?= html_escape($m->manuscriptNumber) ?></td>
                <td><?= html_escape($m->title) ?></td>
                <td><?= html_escape($m->thematicArea ?? '-') ?></td>
                <td><span class="<?= $class ?>"><?= $label ?></span></td>
                <td><a class="btn btn-xs btn-primary" href="<?= base_url('author/proofing/view/' . (int)$m->manuscriptId) ?>">View</a></td>
              </tr>
            <?php endforeach; endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
