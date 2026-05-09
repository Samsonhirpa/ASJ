<div class="content-wrapper">
    <section class="content-header"><h1>Screened Manuscripts <small>Completed ME evaluations</small></h1></section>
    <section class="content">
        <div class="box box-success">
            <div class="box-header with-border"><h3 class="box-title"><i class="fa fa-check-square-o"></i> Screened List</h3></div>
            <div class="box-body table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead><tr class="bg-green"><th>#</th><th>Title</th><th>Result</th><th>Score</th><th>Date</th></tr></thead>
                    <tbody>
                    <?php if(!empty($manuscripts)): foreach($manuscripts as $m): ?>
                        <tr><td><?= html_escape($m->manuscriptNumber) ?></td><td><?= html_escape($m->title) ?></td><td><span class="label label-<?= $m->meResultStatus==='passed'?'success':'danger' ?>"><?= ucfirst(html_escape($m->meResultStatus)) ?></span></td><td><strong><?= (int)$m->totalScore ?>/100</strong></td><td><?= !empty($m->screenedDtm)?date('d M Y',strtotime($m->screenedDtm)):'-' ?></td></tr>
                    <?php endforeach; else: ?><tr><td colspan="5" class="text-center text-muted">No screened manuscripts yet.</td></tr><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
