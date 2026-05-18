<div class="content-wrapper">
    <section class="content-header">
        <h1>Revision Required Manuscripts <small>Waiting for author revised submission</small></h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead><tr><th>Manuscript #</th><th>Title</th><th>Round</th><th>Revised Submission(s)</th><th>Author Due Date</th><th>Countdown</th><th>Revise Status</th></tr></thead>
                    <tbody>
                        <?php if (!empty($assignments)): foreach ($assignments as $item): ?>
                            <?php
                                $daysLeft = null;
                                $deadlineDate = !empty($item->revisionDueDtm) ? $item->revisionDueDtm : $item->reviewDueDate;
                                if (!empty($deadlineDate)) {
                                    $daysLeft = (int)floor((strtotime($deadlineDate) - strtotime(date('Y-m-d'))) / 86400);
                                }
                                $revisionCount = isset($item->revisedSubmissionCount) ? (int)$item->revisedSubmissionCount : 0;
                                $dynamicRound = !empty($item->roundNumber) ? (int)$item->roundNumber : ($revisionCount + 1);
                            ?>
                            <tr>
                                <td><?= html_escape($item->manuscriptNumber) ?></td>
                                <td><?= html_escape($item->title) ?></td>
                                <td><?= 'Round ' . $dynamicRound ?></td>
                                <td><span class="label label-default"><?= $revisionCount ?></span></td>
                                <td><?= !empty($deadlineDate) ? date('d M Y', strtotime($deadlineDate)) : '-' ?></td>
                                <td>
                                    <?php if ($daysLeft === null): ?>-
                                    <?php elseif ($daysLeft >= 0): ?><span class="label label-info"><?= $daysLeft ?> day(s) left</span>
                                    <?php else: ?><span class="label label-danger">Overdue by <?= abs($daysLeft) ?> day(s)</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="label label-warning">Pending author revision</span></td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="7" class="text-center text-muted">No revision required manuscripts pending from authors.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
