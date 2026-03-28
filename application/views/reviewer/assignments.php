<div class="content-wrapper">
    <section class="content-header">
        <h1>Review Assignments <small>Accept or decline invitations and monitor deadlines</small></h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead><tr><th>Manuscript #</th><th>Title</th><th>Due Date</th><th>Invitation</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                        <?php if (!empty($assignments)): foreach ($assignments as $item): ?>
                            <tr>
                                <td><?= $item->manuscriptNumber ?></td>
                                <td><?= html_escape(strlen($item->title) > 80 ? substr($item->title,0,80).'...' : $item->title) ?></td>
                                <td><?= $item->reviewDueDate ? date('d M Y', strtotime($item->reviewDueDate)) : '-' ?></td>
                                <td>
                                    <span class="label label-<?= $item->responseStatus === 'accepted' ? 'success' : ($item->responseStatus === 'declined' ? 'danger' : 'warning') ?>"><?= ucfirst($item->responseStatus) ?></span>
                                    <?php if (!empty($item->responseReason)): ?>
                                        <div class="small text-muted" style="margin-top:4px;">Reason: <?= html_escape($item->responseReason) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><span class="label label-default"><?= ucfirst($item->status) ?></span></td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="<?= base_url('reviewer/assignment/'.$item->assignmentId) ?>"><i class="fa fa-eye"></i> Open</a>
                                    <?php if ($item->responseStatus === 'pending'): ?>
                                        <form method="post" action="<?= base_url('reviewer/assignment/accept/'.$item->assignmentId) ?>" style="display:inline-block;">
                                            <input type="text" name="responseReason" class="form-control input-sm" style="width:160px; display:inline-block;" placeholder="Reason to accept" required>
                                            <button class="btn btn-xs btn-success" type="submit"><i class="fa fa-check"></i> Accept</button>
                                        </form>
                                        <form method="post" action="<?= base_url('reviewer/assignment/decline/'.$item->assignmentId) ?>" style="display:inline-block; margin-top:4px;">
                                            <input type="text" name="responseReason" class="form-control input-sm" style="width:160px; display:inline-block;" placeholder="Reason to reject" required>
                                            <button class="btn btn-xs btn-danger" type="submit"><i class="fa fa-times"></i> Reject</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="6" class="text-center text-muted">No review assignments available.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
