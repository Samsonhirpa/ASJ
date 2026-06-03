<?php
if (!function_exists('author_name_parts_for_draft')) {
function author_name_parts_for_draft($author) {
    $title = isset($author->title) && trim((string)$author->title) !== '' ? trim((string)$author->title) : 'Mr';
    $first = isset($author->first_name) ? trim((string)$author->first_name) : '';
    $middle = isset($author->middle_name) ? trim((string)$author->middle_name) : '';
    $last = isset($author->last_name) ? trim((string)$author->last_name) : '';

    if ($first === '' && $middle === '' && $last === '' && isset($author->name)) {
        $parts = preg_split('/\s+/', trim((string)$author->name));
        if (in_array($parts[0] ?? '', ['Mr','Mrs','Ms','Miss','Dr','Prof'], true)) {
            $title = array_shift($parts);
        }
        $first = array_shift($parts) ?: '';
        $last = count($parts) ? array_pop($parts) : '';
        $middle = implode(' ', $parts);
    }

    return ['title' => $title, 'first' => $first, 'middle' => $middle, 'last' => $last];
}
}
$titles = ['Mr','Mrs','Ms','Miss','Dr','Prof'];
?>
<div class="content-wrapper" style="background: #f4f6f9;">
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;"><i class="fa fa-users" style="color: #2c5f2d; margin-right: 10px;"></i>Submit Manuscript <small style="color:#777;">Step 2 of 3: Add Authors for <?= html_escape($manuscript->manuscriptNumber) ?></small></h1>
        </div>
    </section>
    <section class="content">
        <?php $this->load->view('author/draft_progress'); ?>
        <?php if($this->session->flashdata('error')): ?><div class="alert alert-danger" style="border-radius:10px;"><i class="fa fa-exclamation-triangle"></i> <?= $this->session->flashdata('error') ?></div><?php endif; ?>
        <?php if($this->session->flashdata('success')): ?><div class="alert alert-success" style="border-radius:10px;"><i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div><?php endif; ?>
        <div class="row">
            <div class="col-md-8">
                <form action="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/authors/update') ?>" method="post" id="authorsForm">
                    <datalist id="institutionSuggestions"><?php if (!empty($institutionSuggestions)): foreach ($institutionSuggestions as $institution): ?><option value="<?= html_escape($institution) ?>"></option><?php endforeach; endif; ?></datalist>
                    <div class="box" style="border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.05); overflow:hidden;">
                        <div class="box-header" style="background:#f8fafc; padding:20px; border-bottom:1px solid #e9ecef;"><h3 class="box-title" style="font-weight:600;"><i class="fa fa-user-plus" style="color:#2c5f2d;"></i> Author Information</h3></div>
                        <div class="box-body" id="authorsContainer" style="padding:25px;">
                            <?php if(empty($authors)): ?><p class="text-muted">No authors are saved yet. Add at least one author before continuing.</p><?php endif; ?>
                            <?php foreach($authors as $index => $author): $name = author_name_parts_for_draft($author); ?>
                            <div class="author-item" style="background:#f8fafc; padding:20px; border-radius:10px; margin-bottom:20px; position:relative; border-left:4px solid <?= $index === 0 ? '#2c5f2d' : '#17a2b8' ?>;">
                                <?php if($index > 0): ?><button type="button" class="btn btn-xs btn-danger remove-author" style="position:absolute; top:10px; right:10px; border-radius:50%;"><i class="fa fa-times"></i></button><?php endif; ?>
                                <h4 style="margin-top:0;"><i class="fa fa-user-circle" style="color:#2c5f2d;"></i> Author <?= $index + 1 ?> <?php if($author->isCorresponding): ?><small>(Corresponding Author)</small><?php endif; ?></h4>
                                <div class="row">
                                    <div class="col-md-2"><div class="form-group"><label>Title</label><select class="form-control" name="title[]" style="border-radius:8px;"><?php foreach($titles as $title): ?><option value="<?= $title ?>" <?= $name['title'] == $title ? 'selected' : '' ?>><?= $title ?></option><?php endforeach; ?></select></div></div>
                                    <div class="col-md-4"><div class="form-group"><label>First Name <span class="text-danger">*</span></label><input class="form-control" name="first_name[]" value="<?= html_escape($name['first']) ?>" required style="border-radius:8px;"></div></div>
                                    <div class="col-md-3"><div class="form-group"><label>Middle Name</label><input class="form-control" name="middle_name[]" value="<?= html_escape($name['middle']) ?>" style="border-radius:8px;"></div></div>
                                    <div class="col-md-3"><div class="form-group"><label>Last Name</label><input class="form-control" name="last_name[]" value="<?= html_escape($name['last']) ?>" style="border-radius:8px;"></div></div>
                                    <div class="col-md-6"><div class="form-group"><label>Email <span class="text-danger">*</span></label><input type="email" class="form-control" name="email[]" value="<?= html_escape($author->email) ?>" required style="border-radius:8px;"></div></div>
                                    <div class="col-md-6"><div class="form-group"><label>Institution</label><input class="form-control" name="institution[]" list="institutionSuggestions" value="<?= html_escape($author->institution) ?>" style="border-radius:8px;"></div></div>
                                    <div class="col-md-6"><div class="form-group"><label>Country</label><input class="form-control" name="country[]" value="<?= html_escape($author->country) ?>" style="border-radius:8px;"></div></div>
                                    <div class="col-md-6"><div class="form-group"><label>ORCID</label><input class="form-control" name="orcid[]" value="<?= html_escape($author->orcid) ?>" style="border-radius:8px;"></div></div>
                                    <div class="col-md-12"><label><input type="radio" name="corresponding" value="<?= $index ?>" <?= $author->isCorresponding ? 'checked' : '' ?>> Mark as corresponding author</label></div>
                                </div>
                                <input type="hidden" name="user_id[]" value="<?= !empty($author->userId) ? (int)$author->userId : 'new' ?>">
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="box-footer" style="background:#f8fafc; padding:20px;">
                            <button type="button" class="btn btn-default" id="addAuthorBtn" style="border-radius:8px;"><i class="fa fa-plus-circle"></i> Add Co-author</button>
                            <a href="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/details') ?>" class="btn btn-default" style="border-radius:8px;"><i class="fa fa-arrow-left"></i> Previous</a>
                            <button type="submit" class="btn btn-success pull-right" style="border-radius:8px; padding:10px 30px;">Next: Files <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4"><div class="box" style="border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.05);"><div class="box-header" style="background:#2c5f2d; color:white; padding:20px; border-radius:15px 15px 0 0;"><h3 class="box-title"><i class="fa fa-info-circle"></i> Co-author Tips</h3></div><div class="box-body" style="padding:20px;"><p class="text-muted">Add new co-authors or edit the authors already saved in this draft. Click Next to save and continue.</p></div></div></div>
        </div>
    </section>
</div>
<script>
(function() {
    var container = document.getElementById('authorsContainer');
    document.getElementById('addAuthorBtn').addEventListener('click', function() {
        var index = container.querySelectorAll('.author-item').length;
        var html = '<div class="author-item" style="background:#f8fafc; padding:20px; border-radius:10px; margin-bottom:20px; position:relative; border-left:4px solid #17a2b8;">' +
            '<button type="button" class="btn btn-xs btn-danger remove-author" style="position:absolute; top:10px; right:10px; border-radius:50%;"><i class="fa fa-times"></i></button><h4 style="margin-top:0;"><i class="fa fa-user-plus" style="color:#17a2b8;"></i> Co-author</h4>' +
            '<div class="row"><div class="col-md-2"><div class="form-group"><label>Title</label><select class="form-control" name="title[]" style="border-radius:8px;"><option>Mr</option><option>Mrs</option><option>Ms</option><option>Miss</option><option>Dr</option><option>Prof</option></select></div></div>' +
            '<div class="col-md-4"><div class="form-group"><label>First Name <span class="text-danger">*</span></label><input class="form-control" name="first_name[]" required style="border-radius:8px;"></div></div><div class="col-md-3"><div class="form-group"><label>Middle Name</label><input class="form-control" name="middle_name[]" style="border-radius:8px;"></div></div><div class="col-md-3"><div class="form-group"><label>Last Name</label><input class="form-control" name="last_name[]" style="border-radius:8px;"></div></div>' +
            '<div class="col-md-6"><div class="form-group"><label>Email <span class="text-danger">*</span></label><input type="email" class="form-control" name="email[]" required style="border-radius:8px;"></div></div><div class="col-md-6"><div class="form-group"><label>Institution</label><input class="form-control" name="institution[]" list="institutionSuggestions" style="border-radius:8px;"></div></div><div class="col-md-6"><div class="form-group"><label>Country</label><input class="form-control" name="country[]" style="border-radius:8px;"></div></div><div class="col-md-6"><div class="form-group"><label>ORCID</label><input class="form-control" name="orcid[]" style="border-radius:8px;"></div></div><div class="col-md-12"><label><input type="radio" name="corresponding" value="' + index + '"> Mark as corresponding author</label></div></div><input type="hidden" name="user_id[]" value="new"></div>';
        container.insertAdjacentHTML('beforeend', html);
    });
    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-author')) {
            e.target.closest('.author-item').remove();
            container.querySelectorAll('input[name="corresponding"]').forEach(function(input, idx) { input.value = idx; });
        }
    });
})();
</script>
