<div class="content-wrapper" style="background: #f4f6f9;">
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;"><i class="fa fa-upload" style="color: #2c5f2d; margin-right: 10px;"></i>Edit Draft Files <small>#<?= html_escape($manuscript->manuscriptNumber) ?></small></h1>
        </div>
    </section>
    <section class="content">
        <?php if($this->session->flashdata('success')): ?><div class="alert alert-success"><?= $this->session->flashdata('success') ?></div><?php endif; ?>
        <?php if($this->session->flashdata('error')): ?><div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div><?php endif; ?>
        <div class="row">
            <div class="col-md-7">
                <div class="box" style="border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header" style="background:#f8fafc; padding:20px;"><h3 class="box-title"><i class="fa fa-upload"></i> Step 3: Upload or Replace Files</h3></div>
                    <form action="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/files/update') ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body" style="padding:25px;">
                            <div class="form-group"><label>Main Manuscript File</label><input type="file" name="main_file" class="form-control"><p class="help-block">Upload a new main file if you want to add a version or replace your draft content.</p></div>
                            <div class="form-group"><label>Figures / Tables</label><input type="file" name="figures_files[]" class="form-control" multiple></div>
                            <div class="form-group"><label>Supplementary Files</label><input type="file" name="supplementary_files[]" class="form-control" multiple></div>
                        </div>
                        <div class="box-footer" style="background:#f8fafc; padding:20px;">
                            <a href="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/authors') ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Previous</a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Uploaded Files</button>
                            <a href="<?= base_url('author/manuscript/view/' . (int)$manuscript->manuscriptId) ?>" class="btn btn-info pull-right">Back to Draft</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box" style="border-radius:15px; box-shadow:0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header" style="background:#f8fafc; padding:20px;"><h3 class="box-title"><i class="fa fa-files-o"></i> Current Draft Files</h3></div>
                    <div class="box-body" style="padding:20px;">
                        <?php if(!empty($files)): ?>
                            <?php foreach($files as $file): ?>
                                <div style="padding:10px; border:1px solid #eee; border-radius:8px; margin-bottom:10px;">
                                    <strong><?= html_escape(ucfirst($file->fileType)) ?>:</strong> <a href="<?= base_url($file->filePath) ?>" target="_blank"><?= html_escape($file->fileName) ?></a>
                                    <span class="text-muted">(<?= round($file->fileSize / 1024, 2) ?> KB)</span>
                                    <a href="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/files/delete/' . (int)$file->fileId) ?>" class="btn btn-xs btn-danger pull-right" onclick="return confirm('Delete this draft file?');"><i class="fa fa-trash"></i> Delete</a>
                                    <div style="clear:both;"></div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">No files uploaded yet. You can save a draft without files, but a main file is required before submission.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
