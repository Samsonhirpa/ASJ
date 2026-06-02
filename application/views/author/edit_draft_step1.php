<div class="content-wrapper" style="background: #f4f6f9;">
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                <i class="fa fa-edit" style="color: #2c5f2d; margin-right: 10px;"></i>
                Edit Draft Details
                <small style="color: #777;">#<?= html_escape($manuscript->manuscriptNumber) ?></small>
            </h1>
        </div>
    </section>

    <section class="content">
        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;">
            <div class="box-header" style="background: #f8fafc; padding: 20px; border-bottom: 1px solid #e9ecef;">
                <h3 class="box-title"><i class="fa fa-info-circle" style="color: #2c5f2d;"></i> Step 1: Manuscript Details</h3>
            </div>
            <form action="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/details/update') ?>" method="post">
                <div class="box-body" style="padding: 25px;">
                    <div class="form-group">
                        <label>Article Type <span class="text-danger">*</span></label>
                        <select class="form-control" name="articleType" required>
                            <option value="">-- Select Article Type --</option>
                            <?php foreach($articleTypes as $key => $value): ?>
                                <option value="<?= $key ?>" <?= set_value('articleType', $manuscript->articleType) == $key ? 'selected' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('articleType', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label>Thematic Area (Section) <span class="text-danger">*</span></label>
                        <select class="form-control" name="thematicArea" required>
                            <option value="">-- Select Thematic Area / Section --</option>
                            <?php foreach($thematicAreas as $key => $value): ?>
                                <option value="<?= $key ?>" <?= set_value('thematicArea', $manuscript->thematicArea) == $key ? 'selected' : '' ?>><?= $value ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('thematicArea', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label>Manuscript Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" value="<?= html_escape(set_value('title', $manuscript->title)) ?>" maxlength="500" required>
                        <?= form_error('title', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label>Abstract <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="abstract" rows="8" required><?= html_escape(set_value('abstract', $manuscript->abstract)) ?></textarea>
                        <?= form_error('abstract', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label>Keywords <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="keywords" value="<?= html_escape(set_value('keywords', $manuscript->keywords)) ?>" required>
                        <?= form_error('keywords', '<div class="text-danger">', '</div>') ?>
                    </div>

                    <div class="form-group">
                        <label>Cover Letter</label>
                        <textarea class="form-control" name="coverLetter" rows="5"><?= html_escape(set_value('coverLetter', $manuscript->coverLetter)) ?></textarea>
                    </div>
                </div>
                <div class="box-footer" style="background: #f8fafc; padding: 20px;">
                    <a href="<?= base_url('author/manuscript/view/' . (int)$manuscript->manuscriptId) ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back to Draft</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save Details</button>
                    <a href="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/authors') ?>" class="btn btn-info pull-right">Next: Authors <i class="fa fa-arrow-right"></i></a>
                </div>
            </form>
        </div>
    </section>
</div>
