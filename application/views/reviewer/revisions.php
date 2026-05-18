<div class="content-wrapper">
    <section class="content-header">
        <h1>Revision Required Manuscripts <small>Waiting for author revised submission</small></h1>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body table-responsive">
                <table class="table table-bordered table-hover">
                    <thead><tr><th>Manuscript #</th><th>Title</th><th>Round</th><th>Reviewer Due Date</th><th>Countdown</th><th>Revise Status</th></tr></thead>
                    <tbody>
                        <?php if (!empty($assignments)): foreach ($assignments as $item): ?>
                            <?php
                                $daysLeft = null;
                                if (!empty($item->reviewDueDate)) {
                                    $daysLeft = (int)floor((strtotime($item->reviewDueDate) - strtotime(date('Y-m-d'))) / 86400);
                                }
                            ?>
                            <tr>
                                <td><?= html_escape($item->manuscriptNumber) ?></td>
                                <td><?= html_escape($item->title) ?></td>
                                <td><?= !empty($item->roundNumber) ? 'Round ' . (int)$item->roundNumber : '-' ?></td>
                                <td><?= !empty($item->reviewDueDate) ? date('d M Y', strtotime($item->reviewDueDate)) : '-' ?></td>
                                <td>
                                    <?php if ($daysLeft === null): ?>-
                                    <?php elseif ($daysLeft >= 0): ?><span class="label label-info"><?= $daysLeft ?> day(s) left</span>
                                    <?php else: ?><span class="label label-danger">Overdue by <?= abs($daysLeft) ?> day(s)</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="label label-warning">Pending author revision</span></td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr><td colspan="6" class="text-center text-muted">No revision required manuscripts pending from authors.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
