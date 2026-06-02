<?php
$filesByType = ['main' => [], 'figure' => [], 'supplementary' => []];
foreach ((array)$files as $file) {
    $type = isset($filesByType[$file->fileType]) ? $file->fileType : 'supplementary';
    $filesByType[$type][] = $file;
}
?>
<div class="content-wrapper" style="background: #f4f6f9;">
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;"><i class="fa fa-upload" style="color: #2c5f2d; margin-right: 10px;"></i>Submit Manuscript <small style="color:#777;">Step 3 of 3: Upload Files for <?= html_escape($manuscript->manuscriptNumber) ?></small></h1>
        </div>
    </section>
    <section class="content">
        <?php $this->load->view('author/draft_progress'); ?>
        <?php if($this->session->flashdata('success')): ?><div class="alert alert-success" style="border-radius:10px;"><i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div><?php endif; ?>
        <?php if($this->session->flashdata('error')): ?><div class="alert alert-danger" style="border-radius:10px;"><i class="fa fa-exclamation-triangle"></i> <?= $this->session->flashdata('error') ?></div><?php endif; ?>
        <form action="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/files/update') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="box" style="border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.05); overflow:hidden;">
                        <div class="box-header" style="background:#f8fafc; padding:20px; border-bottom:1px solid #e9ecef;"><h3 class="box-title" style="font-weight:600;"><i class="fa fa-cloud-upload" style="color:#2c5f2d;"></i> Upload Files</h3></div>
                        <div class="box-body" style="padding:25px;">
                            <?php
                            $sections = [
                                ['key' => 'main', 'label' => 'Main Manuscript File', 'field' => 'main_file', 'multiple' => false, 'help' => 'Required before submitting. PDF, DOC, or DOCX up to 50MB.'],
                                ['key' => 'figure', 'label' => 'Figures / Tables', 'field' => 'figures_files[]', 'multiple' => true, 'help' => 'Optional images, PDFs, DOC, DOCX, or ZIP files.'],
                                ['key' => 'supplementary', 'label' => 'Supplementary Files', 'field' => 'supplementary_files[]', 'multiple' => true, 'help' => 'Optional supporting material.']
                            ];
                            foreach ($sections as $section): ?>
                            <div class="upload-section" style="border:1px solid #e9ecef; border-radius:12px; padding:18px; margin-bottom:18px; background:#fff;">
                                <h4 style="margin-top:0; color:#2c5f2d;"><i class="fa fa-folder-open"></i> <?= $section['label'] ?></h4>
                                <?php if(!empty($filesByType[$section['key']])): ?>
                                    <div style="margin-bottom:12px;">
                                        <?php foreach($filesByType[$section['key']] as $file): ?>
                                        <div class="file-list-item">
                                            <div><i class="fa fa-file-o" style="color:#2c5f2d;"></i> <a href="<?= base_url($file->filePath) ?>" target="_blank"><?= html_escape($file->fileName) ?></a> <span class="file-size">(<?= round($file->fileSize / 1024, 2) ?> KB)</span></div>
                                            <a href="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/files/delete/' . (int)$file->fileId) ?>" class="btn btn-xs btn-danger" onclick="return confirm('Delete this draft file?');"><i class="fa fa-trash"></i> Delete</a>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-muted">No <?= strtolower($section['label']) ?> uploaded yet.</p>
                                <?php endif; ?>
                                <label>Add <?= $section['label'] ?></label>
                                <input type="file" name="<?= $section['field'] ?>" class="form-control" <?= $section['multiple'] ? 'multiple' : '' ?> style="border-radius:8px;">
                                <p class="help-block"><i class="fa fa-info-circle"></i> <?= $section['help'] ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="box-footer" style="background:#f8fafc; padding:20px;">
                            <a href="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/authors') ?>" class="btn btn-default" style="border-radius:8px;"><i class="fa fa-arrow-left"></i> Previous</a>
                            <button type="submit" class="btn btn-success" style="border-radius:8px;"><i class="fa fa-save"></i> Save Uploaded Files</button>
                            <a href="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/delete') ?>" class="btn btn-danger pull-right" style="border-radius:8px; margin-left:8px;" onclick="return confirm('Delete this draft permanently?');"><i class="fa fa-trash"></i> Delete Draft</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box" style="border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.05);">
                        <div class="box-header" style="background:#2c5f2d; color:white; padding:20px; border-radius:15px 15px 0 0;"><h3 class="box-title"><i class="fa fa-check-circle"></i> Final Draft Actions</h3></div>
                        <div class="box-body" style="padding:20px;">
                            <p class="text-muted">Save any file changes first. When your main manuscript file is uploaded, submit the draft for editorial processing.</p>
                            <button type="submit" class="btn btn-default btn-block" style="border-radius:8px; padding:12px; margin-bottom:10px;"><i class="fa fa-save"></i> Save Files</button>
                            <a href="<?= base_url('author/manuscript/submit-draft/' . (int)$manuscript->manuscriptId) ?>" class="btn btn-success btn-block" style="border-radius:8px; padding:12px;" onclick="return confirm('Submit this draft manuscript now?');"><i class="fa fa-paper-plane"></i> Submit Draft Now</a>
                            <a href="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/delete') ?>" class="btn btn-danger btn-block" style="border-radius:8px; padding:12px; margin-top:10px;" onclick="return confirm('Delete this draft permanently?');"><i class="fa fa-trash"></i> Delete Draft</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
<style>
.file-list-item{padding:10px 12px;margin-bottom:8px;background:#f8f9fa;border-radius:8px;border-left:3px solid #2c5f2d;display:flex;align-items:center;justify-content:space-between;gap:10px}.file-list-item .file-size{color:#6c757d;font-size:.85em;margin-left:6px}
</style>
