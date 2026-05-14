<div class="content-wrapper">
    <section class="content-header">
        <h1>First Editorial Decisions</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Manuscripts after Associate Editor decision</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Manuscript</th>
                                    <th>Associate Editor Decision</th>
                                    <th>Responsible Person / Next Step</th>
                                    <th>Countdown</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $decisionLabels = [
                                'accept_present' => 'Accept in Present Form',
                                'reject' => 'Reject',
                                'minor_revision' => 'Accept after Minor Revision',
                                'major_revision' => 'Reconsider after Major Revision',
                                'reject_resubmit' => 'Reject and Encourage Resubmission'
                            ];
                            $nextSteps = [
                                'accept_present' => 'Ready to be published',
                                'reject' => 'Fully rejected',
                                'minor_revision' => 'Author/CA: submit revised manuscript and response to reviewers',
                                'major_revision' => 'Author/CA: submit revised manuscript and response to reviewers',
                                'reject_resubmit' => 'Author/CA: prepare a new resubmission when extensive new experiments are completed'
                            ];
                            ?>
                            <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                                <?php
                                $decision = !empty($m->firstEditorialDecision) ? $m->firstEditorialDecision : '';
                                $decisionLabel = isset($decisionLabels[$decision]) ? $decisionLabels[$decision] : $decision;
                                $nextStep = isset($nextSteps[$decision]) ? $nextSteps[$decision] : '-';
                                $countdownText = '-';
                                $countdownClass = 'label-default';

                                if (!empty($m->revisionDueDtm)) {
                                    $remainingSeconds = strtotime($m->revisionDueDtm) - time();
                                    $days = (int)ceil(abs($remainingSeconds) / 86400);
                                    if ($remainingSeconds >= 0) {
                                        $countdownText = $days . ' day' . ($days === 1 ? '' : 's') . ' remaining';
                                        $countdownClass = $days <= 2 ? 'label-warning' : 'label-info';
                                    } else {
                                        $countdownText = $days . ' day' . ($days === 1 ? '' : 's') . ' overdue';
                                        $countdownClass = 'label-danger';
                                    }
                                }
                                ?>
                                <tr>
                                    <td>
                                        <strong><?= html_escape($m->manuscriptNumber) ?></strong><br>
                                        <span class="small text-muted"><?= html_escape($m->title) ?></span><br>
                                        <span class="small">AE: <?= html_escape(!empty($m->associateEditorName) ? $m->associateEditorName : '-') ?></span>
                                    </td>
                                    <td>
                                        <strong><?= html_escape($decisionLabel) ?></strong><br>
                                        <span class="small text-muted">
                                            <?= !empty($m->firstEditorialDecisionDtm) ? html_escape(date('d M Y H:i', strtotime($m->firstEditorialDecisionDtm))) : '-' ?>
                                        </span>
                                    </td>
                                    <td><?= html_escape($nextStep) ?></td>
                                    <td>
                                        <span class="label <?= $countdownClass ?>"><?= html_escape($countdownText) ?></span>
                                        <?php if (!empty($m->revisionDueDtm)): ?>
                                            <br><span class="small text-muted">Due <?= html_escape(date('d M Y H:i', strtotime($m->revisionDueDtm))) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= html_escape(ucwords(str_replace('_', ' ', $m->status))) ?></td>
                                    <td>
                                        <a class="btn btn-xs btn-info" href="<?= base_url('editor/assignments/view/' . (int)$m->manuscriptId) ?>">
                                            View Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="6">No first editorial decisions have been submitted yet.</td></tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
