<div class="content-wrapper" style="background: #f4f6f9;">
    
    <!-- Content Header -->
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                <i class="fa fa-users" style="color: #2c5f2d; margin-right: 10px;"></i>
                Submit Manuscript
                <small style="color: #777;">Step 2 of 3: Add Authors</small>
            </h1>
        </div>
    </section>

    <section class="content">
        <!-- Progress Steps -->
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); padding: 20px;">
                    <div class="progress" style="height: 30px; border-radius: 15px;">
                        <div class="progress-bar progress-bar-success" role="progressbar" style="width: 33%; background: #28a745; border-radius: 15px 0 0 15px; line-height: 30px; font-weight: 600;">
                            ✓ Step 1: Details
                        </div>
                        <div class="progress-bar progress-bar-success" role="progressbar" style="width: 33%; background: #2c5f2d; line-height: 30px; font-weight: 600;">
                            Step 2: Authors
                        </div>
                        <div class="progress-bar progress-bar-info" role="progressbar" style="width: 34%; background: #6c757d; border-radius: 0 15px 15px 0; line-height: 30px; font-weight: 600;">
                            Step 3: Files
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display Flash Messages -->
        <?php if($this->session->flashdata('error')): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissable" style="border-radius: 10px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-exclamation-triangle"></i> <?= $this->session->flashdata('error') ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if($this->session->flashdata('success')): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissable" style="border-radius: 10px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-check-circle"></i> <?= $this->session->flashdata('success') ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="row">
            <!-- Main Form -->
            <div class="col-md-8">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;">
                    <div class="box-header" style="background: #f8fafc; padding: 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;"><i class="fa fa-user-plus" style="color: #2c5f2d;"></i> Author Information</h3>
                    </div>
                    
                    <form action="<?= base_url('author/manuscript/submitStep2') ?>" method="post" id="step2Form">
                        <div class="box-body" style="padding: 25px;">
                            
                            <!-- Author List -->
                            <div id="authorsContainer">
                                <!-- Main Author (Always Present) -->
                                <div class="author-item main-author" style="background: #f8fafc; padding: 20px; border-radius: 10px; margin-bottom: 20px; border-left: 4px solid #2c5f2d;">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 style="margin-top: 0; margin-bottom: 15px;">
                                                <i class="fa fa-user-circle" style="color: #2c5f2d;"></i> 
                                                Author 1 <small>(Corresponding Author)</small>
                                            </h4>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <span class="label label-success" style="padding: 5px 10px; font-size: 0.9em;">
                                                <i class="fa fa-check"></i> Corresponding
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name[]" value="<?= $this->session->userdata('name') ?>" readonly
                                                       style="background: #e9ecef; border-radius: 8px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last_name[]" value="" placeholder="Enter last name"
                                                       style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email[]" value="<?= $this->session->userdata('email') ?>" readonly
                                                       style="background: #e9ecef; border-radius: 8px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Institution <span style="color: #6c757d;">(Optional)</span></label>
                                                <input type="text" class="form-control" name="institution[]" placeholder="e.g., IQQO, Addis Ababa University"
                                                       style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ORCID <span style="color: #6c757d;">(Optional)</span></label>
                                                <input type="text" class="form-control" name="orcid[]" placeholder="0000-0002-1825-0097"
                                                       style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px;">
                                                <small class="text-muted">Format: 0000-0002-1825-0097</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country <span style="color: #6c757d;">(Optional)</span></label>
                                                <select class="form-control" name="country[]" style="border-radius: 8px; padding: 10px;">
                                                    <option value="">Select Country</option>
                                                    <option value="Ethiopia">🇪🇹 Ethiopia</option>
                                                    <option value="Kenya">🇰🇪 Kenya</option>
                                                    <option value="Uganda">🇺🇬 Uganda</option>
                                                    <option value="Tanzania">🇹🇿 Tanzania</option>
                                                    <option value="Rwanda">🇷🇼 Rwanda</option>
                                                    <option value="South Africa">🇿🇦 South Africa</option>
                                                    <option value="Nigeria">🇳🇬 Nigeria</option>
                                                    <option value="Other">🌍 Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="user_id[]" value="<?= $this->session->userdata('userId') ?>">
                                    <input type="hidden" name="is_corresponding[]" value="1">
                                </div>
                            </div>

                            <!-- Add More Authors Button -->
                            <div style="margin: 20px 0; text-align: center;">
                                <button type="button" class="btn" id="addAuthorBtn" style="background: #6c757d; color: white; border-radius: 25px; padding: 10px 25px; border: none;"
                                        onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">
                                    <i class="fa fa-plus-circle"></i> Add Co-author
                                </button>
                            </div>

                            <!-- Co-author template (hidden) -->
                            <div id="authorTemplate" style="display: none;">
                                <div class="author-item coauthor-item" style="background: #f8fafc; padding: 20px; border-radius: 10px; margin-bottom: 20px; position: relative; border-left: 4px solid #17a2b8;">
                                    <button type="button" class="btn btn-xs btn-danger remove-author" style="position: absolute; top: 10px; right: 10px; border-radius: 50%; width: 30px; height: 30px; border: none;">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <h4 style="margin-top: 0; margin-bottom: 15px;">
                                        <i class="fa fa-user-plus" style="color: #17a2b8;"></i> 
                                        Co-author
                                    </h4>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="first_name[]" placeholder="Enter first name"
                                                       style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="last_name[]" placeholder="Enter last name"
                                                       style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email[]" placeholder="email@example.com"
                                                       style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Institution <span style="color: #6c757d;">(Optional)</span></label>
                                                <input type="text" class="form-control" name="institution[]" placeholder="Institution/Organization"
                                                       style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ORCID <span style="color: #6c757d;">(Optional)</span></label>
                                                <input type="text" class="form-control" name="orcid[]" placeholder="0000-0002-1825-0097"
                                                       style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country <span style="color: #6c757d;">(Optional)</span></label>
                                                <select class="form-control" name="country[]" style="border-radius: 8px; padding: 10px;">
                                                    <option value="">Select Country</option>
                                                    <option value="Ethiopia">🇪🇹 Ethiopia</option>
                                                    <option value="Kenya">🇰🇪 Kenya</option>
                                                    <option value="Uganda">🇺🇬 Uganda</option>
                                                    <option value="Tanzania">🇹🇿 Tanzania</option>
                                                    <option value="Rwanda">🇷🇼 Rwanda</option>
                                                    <option value="South Africa">🇿🇦 South Africa</option>
                                                    <option value="Nigeria">🇳🇬 Nigeria</option>
                                                    <option value="Other">🌍 Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="user_id[]" value="new">
                                    <input type="hidden" name="is_corresponding[]" value="0">
                                    
                                    <div style="margin-top: 15px; padding-top: 15px; border-top: 1px dashed #ced4da;">
                                        <div class="radio">
                                            <label style="font-weight: 500;">
                                                <input type="radio" name="corresponding" value="" class="corresponding-radio"> 
                                                <i class="fa fa-envelope" style="color: #2c5f2d;"></i> Make this the corresponding author
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer" style="background: #f8fafc; padding: 20px; border-top: 1px solid #e9ecef;">
                            <a href="<?= base_url('author/manuscript/submit') ?>" class="btn" style="background: #6c757d; color: white; padding: 12px 30px; border-radius: 8px; border: none; text-decoration: none; display: inline-block;"
                               onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">
                                <i class="fa fa-arrow-left"></i> Previous
                            </a>
                            <button type="submit" class="btn" id="submitBtn" style="background: #2c5f2d; color: white; padding: 12px 30px; border-radius: 8px; border: none; margin-left: 10px;"
                                    onmouseover="this.style.background='#1e4b1f'" onmouseout="this.style.background='#2c5f2d'">
                                <i class="fa fa-arrow-right"></i> Next: Upload Files
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Sidebar -->
            <div class="col-md-4">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;"><i class="fa fa-info-circle" style="color: #2c5f2d;"></i> Author Guidelines</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <ul style="padding-left: 20px; color: #6c757d;">
                            <li style="margin-bottom: 10px;">The submitting author is automatically the corresponding author</li>
                            <li style="margin-bottom: 10px;">All co-authors will be notified after submission</li>
                            <li style="margin-bottom: 10px;">Provide valid email addresses for all authors</li>
                            <li>ORCID IDs help identify researchers uniquely</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Simple JavaScript for Dynamic Author Management -->
<script>
$(document).ready(function() {
    var authorCount = 1;
    
    // Add author
    $('#addAuthorBtn').click(function() {
        authorCount++;
        var template = $('#authorTemplate').html();
        var newAuthor = $(template);
        
        // Update radio value
        newAuthor.find('.corresponding-radio').val('new_' + authorCount);
        
        // Add to container
        $('#authorsContainer').append(newAuthor);
    });
    
    // Remove author
    $(document).on('click', '.remove-author', function() {
        if(confirm('Are you sure you want to remove this author?')) {
            $(this).closest('.author-item').remove();
            authorCount--;
        }
    });
    
    // Handle corresponding author change
    $(document).on('change', '.corresponding-radio', function() {
        // Uncheck all other radios
        $('.corresponding-radio').not(this).prop('checked', false);
        
        // Update hidden fields
        $('input[name="is_corresponding[]"]').val('0');
        $(this).closest('.author-item').find('input[name="is_corresponding[]"]').val('1');
        
        // Update visual indicator
        $('.author-item .label-success').remove();
        var labelHtml = '<span class="label label-success" style="padding: 5px 10px; font-size: 0.9em; margin-left: 10px;"><i class="fa fa-check"></i> Corresponding</span>';
        $(this).closest('.author-item').find('h4').append(labelHtml);
    });
    
    // Simple form submission - NO VALIDATION
    $('#step2Form').on('submit', function() {
        $('#submitBtn').html('<i class="fa fa-spinner fa-spin"></i> Processing...').prop('disabled', true);
        return true; // Always submit
    });
});
</script>