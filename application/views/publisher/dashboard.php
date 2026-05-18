<div class="content-wrapper">
  <section class="content-header"><h1>Publisher Dashboard</h1></section>
  <section class="content">
    <div class="row">
      <div class="col-md-4"><div class="small-box bg-aqua"><div class="inner"><h3><?= count($productionQueue ?? []) ?></h3><p>Pending Production</p></div><a href="<?= base_url('publisher/pending-production') ?>" class="small-box-footer">Open <i class="fa fa-arrow-circle-right"></i></a></div></div>
      <div class="col-md-4"><div class="small-box bg-green"><div class="inner"><h3><?= count($issues ?? []) ?></h3><p>Manage Issues</p></div><a href="<?= base_url('publisher/issues') ?>" class="small-box-footer">Open <i class="fa fa-arrow-circle-right"></i></a></div></div>
      <div class="col-md-4"><div class="small-box bg-yellow"><div class="inner"><h3>Publish</h3><p>Finalize volume / issue publication</p></div><a href="<?= base_url('publisher/publish') ?>" class="small-box-footer">Open <i class="fa fa-arrow-circle-right"></i></a></div></div>
    </div>

    <div class="box box-primary">
      <div class="box-header with-border"><h3 class="box-title">Quick Menus</h3></div>
      <div class="box-body">
        <a class="btn btn-primary" href="<?= base_url('publisher/pending-production') ?>">Pending Production</a>
        <a class="btn btn-info" href="<?= base_url('publisher/issues') ?>">Manage Issue</a>
        <a class="btn btn-success" href="<?= base_url('publisher/publish') ?>">Publish</a>
        <a class="btn btn-warning" href="<?= base_url('publisher/published-content') ?>">Manage Published Content</a>
      </div>
    </div>
  </section>
</div>
