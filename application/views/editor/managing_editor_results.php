<div class="content-wrapper me-results-page">
<section class="content-header">
    <h1><i class="fa fa-list-alt"></i> Managing Editor Results</h1>
</section>

<section class="content">
    <style>
        .me-results-page .summary-box {
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(44, 62, 80, 0.08);
            border: 1px solid #eef1f5;
        }
        .me-results-page .summary-box .box-body {
            padding: 18px;
        }
        .me-results-page .filter-form {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        .me-results-page .filter-form .form-control {
            min-width: 180px;
            border-radius: 8px;
        }
        .me-results-page .result-table-box {
            border-radius: 12px;
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border-top: 3px solid #337ab7;
        }
        .me-results-page table thead {
            background: linear-gradient(90deg, #2c3e50, #1f6ca6);
            color: #fff;
        }
        .me-results-page table tbody tr:hover {
            background: #f8fbff;
        }
        .me-results-page .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .me-results-page .action-buttons form {
            margin: 0;
        }
        .me-results-page .action-buttons .btn {
            border-radius: 20px;
            padding: 5px 12px;
        }
        @media (max-width: 767px) {
            .me-results-page .content-header h1 {
                font-size: 22px;
            }
            .me-results-page .filter-form {
                flex-direction: column;
                align-items: stretch;
            }
            .me-results-page .filter-form .btn,
            .me-results-page .filter-form .form-control {
                width: 100%;
            }
            .me-results-page .table {
                min-width: 980px;
            }
            .me-results-page .action-buttons {
                min-width: 230px;
            }
        }
    </style>

    <div class="box box-default summary-box">
        <div class="box-body">
            <form method="get" class="filter-form" action="<?= base_url('editor/me-results') ?>">
                <label class="text-muted" style="margin:0;"><strong>Filter by ME Result</strong></label>
                <select name="status" class="form-control">
                    <?php foreach (['all' => 'All', 'passed' => 'Approved', 'failed' => 'Rejected'] as $k => $v): ?>
                        <option value="<?= $k ?>" <?= $status === $k ? 'selected' : '' ?>><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="btn btn-primary"><i class="fa fa-filter"></i> Apply Filter</button>
            </form>
        </div>
    </div>

    <div class="box box-primary result-table-box">
        <div class="box-body table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>ME Total</th>
                    <th>Managing Editor</th>
                    <th>ME Result</th>
                    <th>Assign Status</th>
                    <th>AE Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                    <tr>
                        <td><?= html_escape($m->manuscriptNumber) ?></td>
                        <td><?= html_escape($m->title) ?></td>
                        <td><strong><?= (int)$m->totalScore ?>/100</strong></td>
                        <td><?= html_escape($m->managingEditorName ?: '-') ?></td>
                        <td><span class="label label-<?= $m->meResultStatus === 'passed' ? 'success' : 'danger' ?>"><?= html_escape($m->meResultStatus === 'passed' ? 'approved' : 'rejected') ?></span></td>
                        <?php $isAssigned = !empty($m->assignedAssociateEditorName); ?>
                        <td>
                            <?php if ($isAssigned): ?>
                                <span class="label label-success">Assigned: <?= html_escape($m->assignedAssociateEditorName) ?></span>
                            <?php else: ?>
                                <span class="label label-default">Not assigned</span>
                            <?php endif; ?>
                        </td>
                        <td><span class="label label-<?= ($m->aeAssignmentResponse ?? 'pending') === 'accepted' ? 'success' : (($m->aeAssignmentResponse ?? 'pending') === 'declined' ? 'danger' : 'warning') ?>"><?= html_escape(ucfirst($m->aeAssignmentResponse ?? 'pending')) ?></span></td>
                        <td>
                            <?php $isRejected = isset($m->eicMeDecision) && $m->eicMeDecision === 'rejected'; ?>
                            <?php $isApproved = isset($m->eicMeDecision) && $m->eicMeDecision === 'approved'; ?>
                            <div class="action-buttons">
                                <form method="post" action="<?= base_url('editor/me-results/decision/' . $m->manuscriptId) ?>">
                                    <button name="decision" value="approved" class="btn btn-xs btn-success" <?= $isRejected ? 'disabled' : '' ?>>Approve</button>
                                    <button name="decision" value="rejected" class="btn btn-xs btn-danger" <?= $isApproved ? 'disabled' : '' ?>>Reject</button>
                                </form>
                                <?php if ($isApproved): ?>
                                    <a class="btn btn-xs btn-primary" href="<?= base_url('editor/me-results/assign/' . $m->manuscriptId) ?>">Assign</a>
                                <?php endif; ?>
                                <a class="btn btn-xs btn-info" href="<?= base_url('editor/me-results/view/' . $m->manuscriptId) ?>">View</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="8" class="text-center text-muted">No records found.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
</div>
