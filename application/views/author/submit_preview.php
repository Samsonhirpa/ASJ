<div class="content-wrapper" style="background:#f4f6f9;">
<section class="content-header"><h1>Submission Preview</h1></section>
<section class="content">
<div class="box"><div class="box-body">
<h3><?= html_escape($this->session->userdata('submission_title')) ?></h3>
<p><strong>Abstract:</strong> <?= nl2br(html_escape($this->session->userdata('submission_abstract'))) ?></p>
<p><strong>Keywords:</strong> <?= html_escape($this->session->userdata('submission_keywords')) ?></p>
<p><strong>Article Type:</strong> <?= html_escape($this->session->userdata('submission_articleType')) ?></p>
<p><strong>Thematic Area:</strong> <?= html_escape($this->session->userdata('submission_thematicArea')) ?></p>
<h4>Authors</h4>
<ol>
<?php foreach(($authors ?: []) as $author): ?>
<li>
<?= html_escape(isset($author['name']) ? $author['name'] : ((isset($author['firstName']) ? $author['firstName'] : '') . ' ' . (isset($author['lastName']) ? $author['lastName'] : ''))) ?>
- <?= html_escape(isset($author['email']) ? $author['email'] : '') ?>
- <?= html_escape(isset($author['institution']) ? $author['institution'] : '') ?>
<?= !empty($author['isCorresponding']) ? '<span class="label label-success">Corresponding</span>' : '' ?>
</li>
<?php endforeach; ?>
</ol>
<a href="<?= base_url('author/manuscript/step3') ?>" class="btn btn-primary">Back to Upload</a>
</div></div>
</section></div>
