<div class="content-wrapper" style="background: #f4f6f9;">
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                <i class="fa fa-upload" style="color: #2c5f2d; margin-right: 10px;"></i>
                Submit Manuscript
                <small style="color: #777;">Step 1 of 3: Basic Information for <?= html_escape($manuscript->manuscriptNumber) ?></small>
            </h1>
        </div>
    </section>

    <section class="content">
        <?php $this->load->view('author/draft_progress'); ?>

        <?php if($this->session->flashdata('error')): ?><div class="alert alert-danger" style="border-radius:10px;"><i class="fa fa-exclamation-triangle"></i> <?= $this->session->flashdata('error') ?></div><?php endif; ?>
        <?php if($this->session->flashdata('success')): ?><div class="alert alert-success" style="border-radius:10px;"><i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div><?php endif; ?>

        <div class="row">
            <div class="col-md-8">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;">
                    <div class="box-header" style="background: #f8fafc; padding: 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;"><i class="fa fa-info-circle" style="color: #2c5f2d;"></i> Manuscript Details</h3>
                    </div>
                    <form action="<?= base_url('author/manuscript/draft/' . (int)$manuscript->manuscriptId . '/details/update') ?>" method="post" id="step1Form">
                        <div class="box-body" style="padding: 25px;">
                            <div class="form-group">
                                <label for="articleType" style="font-weight: 600;">Article Type <span style="color: #dc3545;">*</span></label>
                                <select class="form-control" id="articleType" name="articleType" required style="border-radius: 8px;">
                                    <option value="">-- Select Article Type --</option>
                                    <?php foreach($articleTypes as $key => $value): ?><option value="<?= $key ?>" <?= set_value('articleType', $manuscript->articleType) == $key ? 'selected' : '' ?>><?= $value ?></option><?php endforeach; ?>
                                </select>
                                <?= form_error('articleType', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="thematicArea" style="font-weight: 600;">Thematic Area (Section) <span style="color: #dc3545;">*</span></label>
                                <select class="form-control" id="thematicArea" name="thematicArea" required style="border-radius: 8px;">
                                    <option value="">-- Select Thematic Area / Section --</option>
                                    <?php foreach($thematicAreas as $key => $value): ?><option value="<?= $key ?>" <?= set_value('thematicArea', $manuscript->thematicArea) == $key ? 'selected' : '' ?>><?= $value ?></option><?php endforeach; ?>
                                </select>
                                <?= form_error('thematicArea', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="title" style="font-weight: 600;">Manuscript Title <span style="color: #dc3545;">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= html_escape(set_value('title', $manuscript->title)) ?>" maxlength="500" required placeholder="Enter the full title of your manuscript" style="border-radius: 8px;">
                                <?= form_error('title', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="abstract" style="font-weight: 600;">Abstract <span style="color: #dc3545;">*</span></label>
                                <textarea class="form-control" id="abstract" name="abstract" rows="8" required style="border-radius: 8px; resize: vertical;" placeholder="Enter manuscript abstract"><?= html_escape(set_value('abstract', $manuscript->abstract)) ?></textarea>
                                <?= form_error('abstract', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="keywords" style="font-weight: 600;">Keywords <span style="color: #dc3545;">*</span></label>
                                <input type="text" class="form-control" id="keywords" name="keywords" value="<?= html_escape(set_value('keywords', $manuscript->keywords)) ?>" required placeholder="e.g., crop science, irrigation" style="border-radius: 8px;">
                                <?= form_error('keywords', '<div class="text-danger">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="coverLetter" style="font-weight: 600;">Cover Letter</label>
                                <textarea class="form-control" id="coverLetter" name="coverLetter" rows="5" style="border-radius: 8px; resize: vertical;" placeholder="Optional cover letter"><?= html_escape(set_value('coverLetter', $manuscript->coverLetter)) ?></textarea>
                            </div>
                        </div>
                        <div class="box-footer" style="background: #f8fafc; padding: 20px;">
                            <button type="submit" class="btn btn-success pull-right" style="border-radius: 8px; padding: 10px 30px;">Next: Authors <i class="fa fa-arrow-right"></i></button>
                            <a href="<?= base_url('author/manuscript') ?>" class="btn btn-default" style="border-radius: 8px; padding: 10px 20px;"><i class="fa fa-list"></i> My Submissions</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header" style="background: #2c5f2d; color: white; padding: 20px; border-radius: 15px 15px 0 0;"><h3 class="box-title"><i class="fa fa-lightbulb-o"></i> Draft Editing</h3></div>
                    <div class="box-body" style="padding: 20px;"><p class="text-muted">Your previously entered draft details are loaded here. Click Next to save changes and continue to co-authors.</p></div>
                </div>
            </div>
        </div>
    </section>
</div>
