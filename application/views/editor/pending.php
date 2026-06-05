<div class="content-wrapper editor-pending-page">
    <section class="content-header pending-hero">
        <div>
            <p class="eyebrow">Editorial Queue</p>
            <h1><i class="fa fa-inbox"></i> Pending Manuscripts</h1>
            <p class="subtitle">Newest submissions are shown first so the latest work stays at the top of the screening list.</p>
        </div>
        <span class="queue-count"><?= !empty($manuscripts) ? count($manuscripts) : 0 ?> Pending</span>
    </section>

    <section class="content">
        <style>
            .editor-pending-page .pending-hero {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 18px;
                margin-bottom: 12px;
                padding: 22px 26px;
                background: linear-gradient(135deg, #203a63 0%, #2f80ed 58%, #56ccf2 100%);
                color: #fff;
                border-radius: 18px;
                box-shadow: 0 16px 36px rgba(32, 58, 99, 0.24);
            }
            .editor-pending-page .content-header h1 {
                margin: 3px 0 5px;
                font-weight: 700;
                letter-spacing: -0.3px;
            }
            .editor-pending-page .eyebrow {
                margin: 0;
                text-transform: uppercase;
                letter-spacing: 1.5px;
                font-size: 12px;
                font-weight: 700;
                opacity: 0.85;
            }
            .editor-pending-page .subtitle {
                margin: 0;
                max-width: 720px;
                opacity: 0.9;
            }
            .editor-pending-page .queue-count {
                flex: 0 0 auto;
                padding: 10px 16px;
                border-radius: 999px;
                background: rgba(255, 255, 255, 0.18);
                border: 1px solid rgba(255, 255, 255, 0.28);
                font-weight: 700;
                box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.18);
            }
            .editor-pending-page .pending-table-box {
                border: 0;
                border-radius: 18px;
                overflow: hidden;
                box-shadow: 0 14px 34px rgba(44, 62, 80, 0.12);
            }
            .editor-pending-page .box-body {
                padding: 0;
            }
            .editor-pending-page table {
                margin-bottom: 0;
                table-layout: fixed;
            }
            .editor-pending-page thead {
                background: #152238;
                color: #fff;
            }
            .editor-pending-page th,
            .editor-pending-page td {
                vertical-align: middle !important;
                padding: 14px 16px !important;
            }
            .editor-pending-page th.col-number { width: 16%; }
            .editor-pending-page th.col-title { width: 44%; }
            .editor-pending-page th.col-status { width: 15%; }
            .editor-pending-page th.col-submitted { width: 15%; }
            .editor-pending-page th.col-action { width: 140px; text-align: center; }
            .editor-pending-page td.col-action { text-align: center; }
            .editor-pending-page .manuscript-title {
                display: block;
                color: #26384d;
                font-weight: 700;
                line-height: 1.35;
                white-space: normal;
            }
            .editor-pending-page .status-pill {
                display: inline-block;
                padding: 6px 12px;
                border-radius: 999px;
                background: #fff6df;
                color: #9a6700;
                font-weight: 700;
                text-transform: capitalize;
            }
            .editor-pending-page .submitted-date {
                color: #66788a;
                font-weight: 600;
                white-space: nowrap;
            }
            .editor-pending-page tbody tr:hover {
                background: #f7fbff;
            }
            .editor-pending-page .screen-btn {
                min-width: 96px;
                border-radius: 999px;
                box-shadow: 0 6px 14px rgba(47, 128, 237, 0.22);
            }
            .editor-pending-page .empty-state {
                padding: 30px !important;
                color: #7f8c8d;
            }
            @media (max-width: 767px) {
                .editor-pending-page .pending-hero {
                    flex-direction: column;
                    align-items: flex-start;
                    margin: 0 0 12px;
                    border-radius: 12px;
                }
                .editor-pending-page table { min-width: 860px; }
            }
        </style>

        <div class="box box-warning pending-table-box">
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-number">Manuscript #</th>
                            <th class="col-title">Title</th>
                            <th class="col-status">Status</th>
                            <th class="col-submitted">Submitted</th>
                            <th class="col-action">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($manuscripts)): foreach ($manuscripts as $m): ?>
                        <tr>
                            <td><strong><?= html_escape($m->manuscriptNumber) ?></strong></td>
                            <td><span class="manuscript-title"><?= html_escape($m->title) ?></span></td>
                            <td><span class="status-pill"><?= html_escape(str_replace('_', ' ', $m->status)) ?></span></td>
                            <td><span class="submitted-date"><?= date('d M Y', strtotime($m->createdDtm)) ?></span></td>
                            <td class="col-action"><a class="btn btn-sm btn-primary screen-btn" href="<?= base_url('editor/pending/screen/'.$m->manuscriptId) ?>"><i class="fa fa-search"></i> Screen</a></td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="5" class="text-center empty-state"><i class="fa fa-check-circle"></i> No pending manuscripts.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
