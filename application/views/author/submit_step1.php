<div class="content-wrapper" style="background: #f4f6f9;">
    
    <!-- Content Header -->
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                <i class="fa fa-upload" style="color: #2c5f2d; margin-right: 10px;"></i>
                Submit Manuscript
                <small style="color: #777;">Step 1 of 3: Basic Information</small>
            </h1>
        </div>
    </section>

    <section class="content">
        <!-- Progress Steps -->
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); padding: 20px;">
                    <div class="progress" style="height: 30px; border-radius: 15px;">
                        <div class="progress-bar progress-bar-success" role="progressbar" style="width: 33%; background: #2c5f2d; border-radius: 15px; line-height: 30px; font-weight: 600;">
                            Step 1: Details
                        </div>
                        <div class="progress-bar progress-bar-info" role="progressbar" style="width: 33%; background: #6c757d; line-height: 30px; font-weight: 600;">
                            Step 2: Authors
                        </div>
                        <div class="progress-bar progress-bar-info" role="progressbar" style="width: 34%; background: #6c757d; border-radius: 15px; line-height: 30px; font-weight: 600;">
                            Step 3: Files
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Main Form -->
            <div class="col-md-8">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;">
                    <div class="box-header" style="background: #f8fafc; padding: 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;"><i class="fa fa-info-circle" style="color: #2c5f2d;"></i> Manuscript Details</h3>
                    </div>
                    
                    <form action="<?= base_url('author/manuscript/submitStep1') ?>" method="post" id="step1Form">
                        <div class="box-body" style="padding: 25px;">
                            <!-- Article Type -->
                            <div class="form-group">
                                <label for="articleType" style="font-weight: 600;">Article Type <span style="color: #dc3545;">*</span></label>
                                <select class="form-control" id="articleType" name="articleType" required style="border-radius: 8px; padding: 10px;">
                                    <option value="">-- Select Article Type --</option>
                                    <?php foreach($articleTypes as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= set_value('articleType') == $key ? 'selected' : '' ?>><?= $value ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('articleType', '<div class="text-danger">', '</div>') ?>
                                <small class="text-muted"><i class="fa fa-info-circle"></i> Select the type of article you are submitting</small>
                            </div>

                            <!-- Title -->
                            <div class="form-group">
                                <label for="title" style="font-weight: 600;">Manuscript Title <span style="color: #dc3545;">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="<?= set_value('title') ?>" required
                                       placeholder="Enter the full title of your manuscript"
                                       style="border-radius: 8px; padding: 10px;">
                                <?= form_error('title', '<div class="text-danger">', '</div>') ?>
                                <small class="text-muted"><i class="fa fa-info-circle"></i> Maximum 500 characters</small>
                            </div>

                            <!-- Abstract -->
                            <div class="form-group">
                                <label for="abstract" style="font-weight: 600;">Abstract <span style="color: #dc3545;">*</span></label>
                                <textarea class="form-control" id="abstract" name="abstract" rows="8" 
                                          placeholder="Enter your abstract here..." required
                                          style="border-radius: 8px; padding: 10px; resize: vertical;"><?= set_value('abstract') ?></textarea>
                                <?= form_error('abstract', '<div class="text-danger">', '</div>') ?>
                                <small class="text-muted"><i class="fa fa-info-circle"></i> Minimum 150 words, maximum 350 words</small>
                                <div id="wordCount" style="margin-top: 5px; font-size: 0.9em;">
                                    <span id="wordCountValue">0</span> words
                                </div>
                            </div>

                            <!-- Keywords -->
                            <div class="form-group">
                                <label for="keywords" style="font-weight: 600;">Keywords <span style="color: #dc3545;">*</span></label>
                                <input type="text" class="form-control" id="keywords" name="keywords" 
                                       value="<?= set_value('keywords') ?>" required
                                       placeholder="e.g., Agriculture, Soil Science, Crop Production"
                                       style="border-radius: 8px; padding: 10px;">
                                <?= form_error('keywords', '<div class="text-danger">', '</div>') ?>
                                <small class="text-muted"><i class="fa fa-info-circle"></i> Separate keywords with commas (5-8 keywords recommended)</small>
                            </div>

                            <!-- Cover Letter -->
                            <div class="form-group">
                                <label for="coverLetter" style="font-weight: 600;">Cover Letter</label>
                                <textarea class="form-control" id="coverLetter" name="coverLetter" rows="5" 
                                          placeholder="Enter a cover letter to the editor (optional)"
                                          style="border-radius: 8px; padding: 10px; resize: vertical;"><?= set_value('coverLetter') ?></textarea>
                                <small class="text-muted"><i class="fa fa-info-circle"></i> Explain why your manuscript is suitable for this journal</small>
                            </div>
                        </div>

                        <div class="box-footer" style="background: #f8fafc; padding: 20px; border-top: 1px solid #e9ecef;">
                            <button type="submit" class="btn" style="background: #2c5f2d; color: white; padding: 12px 30px; border-radius: 8px; font-weight: 600;">
                                <i class="fa fa-arrow-right"></i> Next Step: Add Authors
                            </button>
                            <a href="<?= base_url('author/manuscript') ?>" class="btn" style="background: #6c757d; color: white; padding: 12px 30px; border-radius: 8px; margin-left: 10px;">
                                <i class="fa fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Guidelines Sidebar -->
            <div class="col-md-4">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;"><i class="fa fa-info-circle" style="color: #2c5f2d;"></i> Submission Guidelines</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <div style="margin-bottom: 20px;">
                            <h4 style="font-size: 1.1em; font-weight: 600; margin-bottom: 10px;">Article Types & Word Limits</h4>
                            <ul style="padding-left: 20px; color: #6c757d;">
                                <li><strong>Research Articles:</strong> Up to 6,000 words</li>
                                <li><strong>Review Articles:</strong> Up to 8,000 words</li>
                                <li><strong>Short Communications:</strong> Up to 2,500 words</li>
                                <li><strong>Case Studies:</strong> Up to 3,500 words</li>
                                <li><strong>Technical Notes:</strong> Up to 4,000 words</li>
                            </ul>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <h4 style="font-size: 1.1em; font-weight: 600; margin-bottom: 10px;">Abstract Requirements</h4>
                            <p style="color: #6c757d;">Should include: Objective, Methods, Results, Conclusion. Structured format preferred.</p>
                        </div>

                        <div>
                            <h4 style="font-size: 1.1em; font-weight: 600; margin-bottom: 10px;">Important Notes</h4>
                            <ul style="padding-left: 20px; color: #6c757d;">
                                <li>All fields marked with <span style="color: #dc3545;">*</span> are required</li>
                                <li>You can save as draft and complete later</li>
                                <li>Manuscripts are checked for plagiarism</li>
                                <li>Double-blind peer review process</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
// Word counter for abstract
document.getElementById('abstract').addEventListener('keyup', function() {
    var words = this.value.match(/\S+/g);
    var count = words ? words.length : 0;
    document.getElementById('wordCountValue').textContent = count;
    
    if(count < 150) {
        document.getElementById('wordCount').style.color = '#dc3545';
    } else if(count > 350) {
        document.getElementById('wordCount').style.color = '#ffc107';
    } else {
        document.getElementById('wordCount').style.color = '#28a745';
    }
});
</script>