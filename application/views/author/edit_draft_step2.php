<?php
function split_author_name_for_draft($name) {
    $parts = preg_split('/\s+/', trim((string)$name));
    $title = in_array($parts[0] ?? '', ['Mr','Mrs','Ms','Miss','Dr','Prof']) ? array_shift($parts) : '';
    $first = array_shift($parts) ?: '';
    $last = count($parts) ? array_pop($parts) : '';
    return ['title' => $title, 'first' => $first, 'middle' => implode(' ', $parts), 'last' => $last];
}
$titles = ['Mr','Mrs','Ms','Miss','Dr','Prof'];
?>
<div class="content-wrapper" style="background: #f4f6f9;">
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;"><i class="fa fa-users" style="color: #2c5f2d; margin-right: 10px;"></i>Edit Draft Authors <small>#<?= html_escape($manuscript->manuscriptNumber) ?></small></h1>
        </div>
    </section>
    <section class="content">
        <?php if($this->session->flashdata('error')): ?><div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div><?php endif; ?>
        <form action="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/authors/update') ?>" method="post" id="authorsForm">
            <div class="box" style="border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.05);">
                <div class="box-header" style="background:#f8fafc; padding:20px;"><h3 class="box-title"><i class="fa fa-users"></i> Step 2: Authors and Co-authors</h3></div>
                <div class="box-body" id="authorsContainer" style="padding:25px;">
                    <?php foreach($authors as $index => $author): $name = split_author_name_for_draft($author->name); ?>
                    <div class="author-item" style="background:#f8fafc; padding:20px; border-radius:10px; margin-bottom:20px; position:relative; border-left:4px solid <?= $index === 0 ? '#2c5f2d' : '#17a2b8' ?>;">
                        <?php if($index > 0): ?><button type="button" class="btn btn-xs btn-danger remove-author" style="position:absolute; top:10px; right:10px;"><i class="fa fa-times"></i></button><?php endif; ?>
                        <h4><?= $index === 0 ? 'Primary Author' : 'Co-author' ?></h4>
                        <div class="row">
                            <div class="col-md-2"><label>Title</label><select class="form-control" name="title[]"><?php foreach($titles as $title): ?><option value="<?= $title ?>" <?= $name['title'] == $title ? 'selected' : '' ?>><?= $title ?></option><?php endforeach; ?></select></div>
                            <div class="col-md-3"><label>First Name</label><input class="form-control" name="first_name[]" value="<?= html_escape($name['first']) ?>" required></div>
                            <div class="col-md-3"><label>Middle Name</label><input class="form-control" name="middle_name[]" value="<?= html_escape($name['middle']) ?>"></div>
                            <div class="col-md-4"><label>Last Name</label><input class="form-control" name="last_name[]" value="<?= html_escape($name['last']) ?>"></div>
                            <div class="col-md-4"><label>Email</label><input type="email" class="form-control" name="email[]" value="<?= html_escape($author->email) ?>" required></div>
                            <div class="col-md-4"><label>Institution</label><input class="form-control" name="institution[]" value="<?= html_escape($author->institution) ?>"></div>
                            <div class="col-md-4"><label>Country</label><input class="form-control" name="country[]" value="<?= html_escape($author->country) ?>"></div>
                            <div class="col-md-4"><label>ORCID</label><input class="form-control" name="orcid[]" value="<?= html_escape($author->orcid) ?>"></div>
                            <div class="col-md-4"><label>Corresponding Author</label><div class="radio"><label><input type="radio" name="corresponding" value="<?= $index ?>" <?= $author->isCorresponding ? 'checked' : '' ?>> Mark as corresponding</label></div></div>
                        </div>
                        <input type="hidden" name="user_id[]" value="<?= !empty($author->userId) ? (int)$author->userId : 'new' ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="box-footer" style="background:#f8fafc; padding:20px;">
                    <button type="button" class="btn btn-default" id="addAuthorBtn"><i class="fa fa-plus-circle"></i> Add Co-author</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Authors</button>
                    <a href="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/details') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Previous</a>
                    <a href="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/files') ?>" class="btn btn-info pull-right">Next: Files <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </form>
    </section>
</div>
<script>
(function() {
    var container = document.getElementById('authorsContainer');
    document.getElementById('addAuthorBtn').addEventListener('click', function() {
        var index = container.querySelectorAll('.author-item').length;
        var html = '<div class="author-item" style="background:#f8fafc; padding:20px; border-radius:10px; margin-bottom:20px; position:relative; border-left:4px solid #17a2b8;">' +
            '<button type="button" class="btn btn-xs btn-danger remove-author" style="position:absolute; top:10px; right:10px;"><i class="fa fa-times"></i></button><h4>Co-author</h4>' +
            '<div class="row"><div class="col-md-2"><label>Title</label><select class="form-control" name="title[]"><option>Mr</option><option>Mrs</option><option>Ms</option><option>Miss</option><option>Dr</option><option>Prof</option></select></div>' +
            '<div class="col-md-3"><label>First Name</label><input class="form-control" name="first_name[]" required></div><div class="col-md-3"><label>Middle Name</label><input class="form-control" name="middle_name[]"></div><div class="col-md-4"><label>Last Name</label><input class="form-control" name="last_name[]"></div>' +
            '<div class="col-md-4"><label>Email</label><input type="email" class="form-control" name="email[]" required></div><div class="col-md-4"><label>Institution</label><input class="form-control" name="institution[]"></div><div class="col-md-4"><label>Country</label><input class="form-control" name="country[]"></div><div class="col-md-4"><label>ORCID</label><input class="form-control" name="orcid[]"></div><div class="col-md-4"><label>Corresponding Author</label><div class="radio"><label><input type="radio" name="corresponding" value="' + index + '"> Mark as corresponding</label></div></div></div><input type="hidden" name="user_id[]" value="new"></div>';
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
