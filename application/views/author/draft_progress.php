<?php
$manuscriptId = (int)$manuscript->manuscriptId;
$currentDraftStep = isset($currentDraftStep) ? (int)$currentDraftStep : 1;
$draftStepStatus = isset($draftStepStatus) && is_array($draftStepStatus) ? $draftStepStatus : [];

$steps = [
    1 => [
        'label' => 'Step 1: Details',
        'complete' => !empty($draftStepStatus['detailsComplete']),
        'url' => base_url('author/manuscript/draft/' . $manuscriptId . '/details'),
        'width' => '33%',
        'radius' => '15px 0 0 15px'
    ],
    2 => [
        'label' => 'Step 2: Authors',
        'complete' => !empty($draftStepStatus['authorsComplete']),
        'url' => base_url('author/manuscript/draft/' . $manuscriptId . '/authors'),
        'width' => '33%',
        'radius' => '0'
    ],
    3 => [
        'label' => 'Step 3: Files',
        'complete' => !empty($draftStepStatus['filesUploaded']),
        'url' => base_url('author/manuscript/draft/' . $manuscriptId . '/files'),
        'width' => '34%',
        'radius' => '0 15px 15px 0'
    ]
];
?>
<div class="row">
    <div class="col-md-12">
        <div class="box" style="border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.05); padding:20px;">
            <div class="progress draft-progress" style="height:30px; border-radius:15px;">
                <?php foreach ($steps as $stepNumber => $step):
                    $isCurrent = $currentDraftStep === $stepNumber;
                    $isEnabled = $isCurrent || $step['complete'];
                    $background = $isCurrent ? '#2c5f2d' : ($step['complete'] ? '#28a745' : '#6c757d');
                    $label = (!$isCurrent && $step['complete'] ? '✓ ' : '') . $step['label'];
                    $style = 'width:' . $step['width'] . '; background:' . $background . '; border-radius:' . $step['radius'] . '; line-height:30px; font-weight:600; color:#fff; text-align:center;';
                ?>
                    <?php if ($isEnabled): ?>
                        <a href="<?= $step['url'] ?>" class="progress-bar progress-bar-success" role="progressbar" style="<?= $style ?> text-decoration:none; cursor:pointer;" title="Open <?= html_escape($step['label']) ?>"><?= html_escape($label) ?></a>
                    <?php else: ?>
                        <div class="progress-bar progress-bar-info" role="progressbar" style="<?= $style ?> cursor:not-allowed; opacity:.85;" title="Complete this step before opening <?= html_escape($step['label']) ?>"><?= html_escape($label) ?></div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
