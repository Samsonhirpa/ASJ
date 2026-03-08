<section class="content-header" style="margin-bottom: 20px;">
    <h2><i class="fa fa-users"></i> Editorial Board</h2>
    <p class="text-muted">Meet the editorial team guiding the quality and direction of OJAS.</p>
</section>

<section class="content">
    <div class="row">
        <?php if (!empty($board_members)): ?>
            <?php foreach ($board_members as $member): ?>
                <div class="col-md-4">
                    <div class="article-card">
                        <h4 style="margin-top:0;"><?= html_escape($member->name); ?></h4>
                        <p><strong>Email:</strong> <?= !empty($member->email) ? '<a href="mailto:' . html_escape($member->email) . '">' . html_escape($member->email) . '</a>' : 'N/A'; ?></p>
                        <p><strong>Role:</strong> <?= !empty($member->roleName) ? html_escape($member->roleName) : 'Editorial Member'; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-md-12">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> Editorial board information will be published soon.
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
