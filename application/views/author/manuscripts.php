<div class="content-wrapper" style="background: #f4f6f9;">
    
    <!-- Content Header -->
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                <i class="fa fa-file-text" style="color: #2c5f2d; margin-right: 10px;"></i>
                My Submissions
                <small style="color: #777;">Track your manuscripts</small>
            </h1>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;">All Submissions</h3>
                        <div class="box-tools pull-right">
                            <a href="<?= base_url('author/manuscript/submit') ?>" class="btn btn-sm" style="background: #2c5f2d; color: white; border-radius: 20px; padding: 5px 15px;">
                                <i class="fa fa-plus"></i> New Submission
                            </a>
                        </div>
                    </div>
                    
                    <div class="box-body" style="padding: 20px;">
                        <table class="table table-hover" id="manuscriptsTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Manuscript #</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Submitted</th>
                                    <th>Reviews</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($manuscripts)): ?>
                                    <?php foreach($manuscripts as $m): ?>
                                    <tr>
                                        <td><?= $m->manuscriptId ?></td>
                                        <td><strong><?= $m->manuscriptNumber ?></strong></td>
                                        <td><?= substr($m->title, 0, 60) ?>...</td>
                                        <td><?= ucfirst(str_replace('_', ' ', $m->articleType)) ?></td>
                                        <td>
                                            <?php
                                            $statusColors = [
                                                'draft' => 'default',
                                                'submitted' => 'info',
                                                'under_review' => 'warning',
                                                'revision_required' => 'primary',
                                                'accepted' => 'success',
                                                'rejected' => 'danger',
                                                'published' => 'success'
                                            ];
                                            $color = $statusColors[$m->status] ?? 'default';
                                            ?>
                                            <span class="label label-<?= $color ?>" style="font-size: 0.9em; padding: 5px 10px;">
                                                <?= ucfirst(str_replace('_', ' ', $m->status)) ?>
                                            </span>
                                        </td>
                                        <td><?= date('d M Y', strtotime($m->createdDtm)) ?></td>
                                        <td>
                                            <?= $m->reviewsCompleted ?? 0 ?>/<?= $m->reviewerCount ?? 0 ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('author/manuscript/view/'.$m->manuscriptId) ?>" class="btn btn-xs btn-info">
                                                <i class="fa fa-eye"></i> View
                                            </a>
                                            <?php if($m->status == 'revision_required'): ?>
                                            <a href="<?= base_url('author/manuscript/edit/'.$m->manuscriptId) ?>" class="btn btn-xs btn-warning">
                                                <i class="fa fa-edit"></i> Revise
                                            </a>
                                            <?php endif; ?>
                                            <?php if($m->status == 'draft' || $m->status == 'submitted'): ?>
                                            <a href="#" class="btn btn-xs btn-danger" onclick="return confirmWithdraw(<?= $m->manuscriptId ?>)">
                                                <i class="fa fa-ban"></i> Withdraw
                                            </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="8" class="text-center" style="padding: 50px;">
                                            <i class="fa fa-file-text" style="font-size: 3em; color: #ccc;"></i>
                                            <h4>No submissions yet</h4>
                                            <p>Start by submitting your first manuscript</p>
                                            <a href="<?= base_url('author/manuscript/submit') ?>" class="btn btn-success">
                                                <i class="fa fa-upload"></i> New Submission
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function confirmWithdraw(id) {
    if(confirm('Are you sure you want to withdraw this manuscript? This action cannot be undone.')) {
        window.location.href = '<?= base_url('author/manuscript/withdraw/') ?>' + id;
    }
    return false;
}
</script>