<div class="content-wrapper">
    <section class="content-header">
        <h1>Managing Editor Results <small>Editor-in-Chief Decision Center</small></h1>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-balance-scale"></i> Evaluation Summary</h3>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                    <tr class="bg-light-blue">
                        <th>#</th><th>Title</th><th>Managing Editor</th><th>Total</th><th>ME Result</th><th>EIC Decision</th><th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($manuscripts)): foreach($manuscripts as $m): ?>
                        <tr>
                            <td><strong><?= html_escape($m->manuscriptNumber) ?></strong></td>
                            <td><?= html_escape($m->title) ?></td>
                            <td><i class="fa fa-user"></i> <?= html_escape($m->managingEditorName ?: 'N/A') ?></td>
                            <td><span class="badge bg-aqua" style="font-size:13px;"><?= (int)$m->totalScore ?>/100</span></td>
                            <td><span class="label label-<?= $m->meResultStatus==='passed'?'success':'danger' ?>"><?= ucfirst(html_escape($m->meResultStatus)) ?></span></td>
                            <td><span class="label label-<?= $m->eicMeDecision==='approved'?'success':($m->eicMeDecision==='rejected'?'danger':'warning') ?>"><?= ucfirst(html_escape($m->eicMeDecision ?: 'pending')) ?></span></td>
                            <td>
                                <a class="btn btn-xs btn-info" href="<?= base_url('editor/me-results/detail/'.$m->manuscriptId) ?>"><i class="fa fa-eye"></i> Details</a>
                                <form method="post" action="<?= base_url('editor/me-results/decision/'.$m->manuscriptId) ?>" style="display:inline-block; margin-left:4px;">
                                    <button name="decision" value="approved" class="btn btn-xs btn-success" <?= $m->eicMeDecision==='approved'?'disabled':'' ?>><i class="fa fa-check"></i> Approve</button>
                                    <button name="decision" value="rejected" class="btn btn-xs btn-danger" <?= $m->eicMeDecision==='approved'?'disabled':'' ?>><i class="fa fa-times"></i> Reject</button>
                                    <input type="text" name="reason" placeholder="Reject reason" class="form-control input-sm" style="width:140px;display:inline-block;" />
                                </form>
                                <?php if($m->eicMeDecision==='approved'): ?>
                                    <a class="btn btn-xs btn-primary" href="<?= base_url('editor/me-results/assign/'.$m->manuscriptId) ?>"><i class="fa fa-share-square"></i> Assign</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center text-muted">No Managing Editor evaluations are available.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
