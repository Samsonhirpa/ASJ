<div class="content-wrapper me-results-page">
<section class="content-header me-results-hero">
    <div>
        <p class="eyebrow">Screening Outcomes</p>
        <h1><i class="fa fa-list-alt"></i> Managing Editor Results</h1>
        <p class="subtitle">Review the latest managing editor screening results first and move approved papers to associate editor assignment.</p>
    </div>
    <span class="results-count"><?= !empty($manuscripts) ? count($manuscripts) : 0 ?> Results</span>
</section>

<section class="content">
    <style>
        .me-results-page .me-results-hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            margin-bottom: 12px;
            padding: 22px 26px;
            background: linear-gradient(135deg, #2b5876 0%, #4e4376 100%);
            color: #fff;
            border-radius: 18px;
            box-shadow: 0 16px 36px rgba(43, 88, 118, 0.24);
        }
        .me-results-page .content-header h1 {
            margin: 3px 0 5px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }
        .me-results-page .eyebrow {
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 12px;
            font-weight: 700;
            opacity: 0.85;
        }
        .me-results-page .subtitle {
            margin: 0;
            max-width: 760px;
            opacity: 0.9;
        }
        .me-results-page .results-count {
            flex: 0 0 auto;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.28);
            font-weight: 700;
        }
        .me-results-page .summary-box {
            border: 0;
            border-radius: 16px;
            box-shadow: 0 10px 26px rgba(44, 62, 80, 0.09);
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
            border-radius: 999px;
            border-color: #dce5ef;
            box-shadow: none;
        }
        .me-results-page .filter-form .btn {
            border-radius: 999px;
            padding-left: 16px;
            padding-right: 16px;
        }
        .me-results-page .result-table-box {
            border: 0;
            border-radius: 18px;
            box-shadow: 0 14px 34px rgba(44, 62, 80, 0.12);
            overflow: hidden;
        }
        .me-results-page .result-table-box .box-body {
            padding: 0;
        }
        .me-results-page table {
            margin-bottom: 0;
            table-layout: fixed;
        }
        .me-results-page table thead {
            background: #152238;
            color: #fff;
        }
        .me-results-page th,
        .me-results-page td {
            vertical-align: middle !important;
            padding: 14px 15px !important;
        }
        .me-results-page th.col-number { width: 14%; }
        .me-results-page th.col-title { width: 29%; }
        .me-results-page th.col-editor { width: 14%; }
        .me-results-page th.col-result { width: 11%; }
        .me-results-page th.col-assign { width: 16%; }
        .me-results-page th.col-ae { width: 10%; }
        .me-results-page th.col-actions { width: 230px; text-align: center; }
        .me-results-page td.col-actions { text-align: center; }
        .me-results-page .manuscript-title {
            display: block;
            color: #26384d;
            font-weight: 700;
            line-height: 1.35;
            white-space: normal;
        }
        .me-results-page .label {
            display: inline-block;
            border-radius: 999px;
            padding: 6px 10px;
            line-height: 1.1;
            white-space: normal;
        }
        .me-results-page table tbody tr:hover {
            background: #f7fbff;
        }
        .me-results-page .action-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 6px;
            min-width: 210px;
        }
        .me-results-page .action-buttons form {
            display: inline-flex;
            gap: 6px;
            margin: 0;
        }
        .me-results-page .action-buttons .btn {
            min-width: 58px;
            border-radius: 999px;
            padding: 5px 11px;
        }
        @media (max-width: 767px) {
            .me-results-page .me-results-hero {
                flex-direction: column;
                align-items: flex-start;
                margin: 0 0 12px;
                border-radius: 12px;
            }
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
                min-width: 1060px;
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
                    <th class="col-number">Manuscript #</th>
                    <th class="col-title">Title</th>
                    <th class="col-editor">Managing Editor</th>
                    <th class="col-result">ME Result</th>
                    <th class="col-assign">Assign Status</th>
                    <th class="col-ae">AE Status</th>
                    <th class="col-actions">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                    <tr>
                        <td><strong><?= html_escape($m->manuscriptNumber) ?></strong></td>
                        <td><span class="manuscript-title"><?= html_escape($m->title) ?></span></td>
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
                        <td class="col-actions">
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
                    <tr><td colspan="7" class="text-center text-muted" style="padding:30px !important;"><i class="fa fa-info-circle"></i> No records found.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
</div>
