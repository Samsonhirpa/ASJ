<div class="content-wrapper" style="background: #f4f6f9;">
    
    <!-- Content Header -->
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                <i class="fa fa-file-text" style="color: #2c5f2d; margin-right: 10px;"></i>
                Submit Manuscript
                <small style="color: #777;">Step 3 of 3: Upload Files</small>
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
                        <div class="progress-bar progress-bar-success" role="progressbar" style="width: 33%; background: #28a745; line-height: 30px; font-weight: 600;">
                            ✓ Step 2: Authors
                        </div>
                        <div class="progress-bar progress-bar-success" role="progressbar" style="width: 34%; background: #2c5f2d; border-radius: 0 15px 15px 0; line-height: 30px; font-weight: 600;">
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

        <div class="row">
            <!-- Main Form -->
            <div class="col-md-8">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;">
                    <div class="box-header" style="background: #f8fafc; padding: 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;"><i class="fa fa-upload" style="color: #2c5f2d;"></i> File Upload</h3>
                    </div>
                    
                    <form action="<?= base_url('author/manuscript/finalSubmit') ?>" method="post" id="step3Form" enctype="multipart/form-data">
                        <div class="box-body" style="padding: 25px;">
                            
                            <!-- Main Manuscript File (Required) - 100MB max -->
                            <div class="form-group" style="background: #f8fafc; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                                <label style="font-weight: 600; font-size: 1.1em;">
                                    <i class="fa fa-file-pdf-o" style="color: #dc3545;"></i> 
                                    Main Manuscript File <span style="color: #dc3545;">*</span>
                                </label>
                                <p class="text-muted" style="margin-bottom: 15px;">Upload your manuscript in PDF, DOC, or DOCX format (max 100MB)</p>
                                
                                <!-- Hidden file input -->
                                <input type="file" id="main_file" name="main_file" accept=".pdf,.doc,.docx" style="display: none;" required>
                                
                                <!-- Custom upload area -->
                                <div class="upload-area" id="mainUploadArea" style="border: 2px dashed #2c5f2d; border-radius: 10px; padding: 30px; text-align: center; background: white; cursor: pointer; transition: all 0.3s;">
                                    <i class="fa fa-cloud-upload" style="font-size: 3em; color: #2c5f2d;"></i>
                                    <h4 style="margin: 15px 0 5px;">Click to Upload Main Manuscript</h4>
                                    <p style="color: #6c757d;">Supported formats: PDF, DOC, DOCX (Max 100MB)</p>
                                    <button type="button" class="btn btn-sm" id="mainBrowseBtn" style="background: #2c5f2d; color: white; border-radius: 20px; padding: 8px 25px; margin-top: 10px; border: none; cursor: pointer;">
                                        <i class="fa fa-folder-open"></i> Browse Files
                                    </button>
                                </div>
                                
                                <!-- File info display -->
                                <div id="mainFileInfo" style="margin-top: 10px; display: none;">
                                    <div class="alert alert-success" style="border-radius: 8px;">
                                        <i class="fa fa-check-circle"></i> Selected file: <span id="mainFileName"></span>
                                        <button type="button" class="btn btn-xs btn-danger pull-right" id="removeMainFile" style="margin-left: 10px;">Remove</button>
                                    </div>
                                </div>
                                <div id="mainFileError" style="margin-top: 10px; display: none;"></div>
                            </div>

                            <!-- Figures/Tables (Optional) - 100MB max each -->
                            <div class="form-group" style="background: #f8fafc; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                                <label style="font-weight: 600; font-size: 1.1em;">
                                    <i class="fa fa-image" style="color: #17a2b8;"></i> 
                                    Figures & Tables (Optional)
                                </label>
                                <p class="text-muted" style="margin-bottom: 15px;">Upload figures, tables, or images separately (max 100MB each)</p>
                                
                                <!-- Hidden file input -->
                                <input type="file" id="figures_files" name="figures_files[]" multiple accept=".jpg,.jpeg,.png,.gif,.tiff,.pdf" style="display: none;">
                                
                                <!-- Custom upload area -->
                                <div class="upload-area" id="figuresUploadArea" style="border: 2px dashed #17a2b8; border-radius: 10px; padding: 30px; text-align: center; background: white; cursor: pointer; transition: all 0.3s;">
                                    <i class="fa fa-image" style="font-size: 2.5em; color: #17a2b8;"></i>
                                    <h4 style="margin: 10px 0;">Click to Select Figures/Tables</h4>
                                    <p style="color: #6c757d;">You can select multiple files (Max 100MB each)</p>
                                    <button type="button" class="btn btn-sm" id="figuresBrowseBtn" style="background: #17a2b8; color: white; border-radius: 20px; padding: 8px 25px; margin-top: 10px; border: none; cursor: pointer;">
                                        <i class="fa fa-folder-open"></i> Browse Files
                                    </button>
                                </div>
                                
                                <!-- File list display -->
                                <div id="figuresFileList" style="margin-top: 10px;"></div>
                                <div id="figuresFileError" style="margin-top: 10px; display: none;"></div>
                            </div>

                            <!-- Supplementary Materials (Optional) - 100MB max each -->
                            <div class="form-group" style="background: #f8fafc; padding: 20px; border-radius: 10px;">
                                <label style="font-weight: 600; font-size: 1.1em;">
                                    <i class="fa fa-archive" style="color: #ffc107;"></i> 
                                    Supplementary Materials (Optional)
                                </label>
                                <p class="text-muted" style="margin-bottom: 15px;">Upload datasets, videos, or other supplementary files (max 100MB each)</p>
                                
                                <!-- Hidden file input -->
                                <input type="file" id="supplementary_files" name="supplementary_files[]" multiple style="display: none;">
                                
                                <!-- Custom upload area -->
                                <div class="upload-area" id="suppUploadArea" style="border: 2px dashed #ffc107; border-radius: 10px; padding: 30px; text-align: center; background: white; cursor: pointer; transition: all 0.3s;">
                                    <i class="fa fa-file-archive-o" style="font-size: 2.5em; color: #ffc107;"></i>
                                    <h4 style="margin: 10px 0;">Click to Select Supplementary Files</h4>
                                    <p style="color: #6c757d;">You can select multiple files (Max 100MB each)</p>
                                    <button type="button" class="btn btn-sm" id="suppBrowseBtn" style="background: #ffc107; color: #333; border-radius: 20px; padding: 8px 25px; margin-top: 10px; border: none; cursor: pointer;">
                                        <i class="fa fa-folder-open"></i> Browse Files
                                    </button>
                                </div>
                                
                                <!-- File list display -->
                                <div id="suppFileList" style="margin-top: 10px;"></div>
                                <div id="suppFileError" style="margin-top: 10px; display: none;"></div>
                            </div>

                            <!-- Declaration -->
                            <div style="margin-top: 30px; padding: 20px; background: #fff3cd; border-radius: 10px;">
                                <div class="checkbox">
                                    <label style="font-weight: 500;">
                                        <input type="checkbox" name="declaration" required> 
                                        I confirm that this manuscript is original, has not been published elsewhere, and all authors have approved the submission.
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer" style="background: #f8fafc; padding: 20px; border-top: 1px solid #e9ecef;">
                            <a href="<?= base_url('author/manuscript/step2') ?>" class="btn" style="background: #6c757d; color: white; padding: 12px 30px; border-radius: 8px; border: none; text-decoration: none; display: inline-block; cursor: pointer;"
                               onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">
                                <i class="fa fa-arrow-left"></i> Previous
                            </a>
                            <button type="submit" class="btn" id="submitBtn" style="background: #2c5f2d; color: white; padding: 12px 40px; border-radius: 8px; border: none; margin-left: 10px; cursor: pointer;"
                                    onmouseover="this.style.background='#1e4b1f'" onmouseout="this.style.background='#2c5f2d'">
                                <i class="fa fa-check"></i> Submit Manuscript
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Sidebar -->
            <div class="col-md-4">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;"><i class="fa fa-info-circle" style="color: #2c5f2d;"></i> File Guidelines</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <h4 style="font-size: 1em; font-weight: 600;">Main Manuscript</h4>
                        <ul style="color: #6c757d; padding-left: 20px;">
                            <li>PDF, DOC, or DOCX format</li>
                            <li><strong>Max size: 100MB</strong></li>
                            <li>Include title, abstract, keywords</li>
                        </ul>
                        
                        <h4 style="font-size: 1em; font-weight: 600; margin-top: 15px;">Figures/Tables</h4>
                        <ul style="color: #6c757d; padding-left: 20px;">
                            <li>JPG, PNG, GIF, TIFF, PDF</li>
                            <li><strong>Max size: 100MB each</strong></li>
                            <li>Minimum 300 DPI resolution</li>
                        </ul>
                        
                        <h4 style="font-size: 1em; font-weight: 600; margin-top: 15px;">Supplementary</h4>
                        <ul style="color: #6c757d; padding-left: 20px;">
                            <li>Any format</li>
                            <li><strong>Max size: 100MB each</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.upload-area:hover {
    background: #f8f9fa !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.upload-area {
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-list-item {
    padding: 8px 12px;
    margin-bottom: 5px;
    background: #f8f9fa;
    border-radius: 5px;
    border-left: 3px solid #2c5f2d;
    animation: slideIn 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.file-list-item .file-actions {
    display: flex;
    gap: 5px;
}

.file-list-item .file-size {
    color: #6c757d;
    font-size: 0.85em;
    margin-left: 10px;
}
</style>

<script>
$(document).ready(function() {
    // ========== MAIN FILE UPLOAD ==========
    // Click handlers for main file
    $('#mainUploadArea, #mainBrowseBtn').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#main_file').click();
    });
    
    // Main file change event
    $('#main_file').on('change', function() {
        var file = this.files[0];
        if(file) {
            // Check file size (100MB = 104857600 bytes)
            if(file.size > 104857600) {
                $('#mainFileError').html('<div class="alert alert-danger">File too large! Maximum size is 100MB.</div>').show();
                $('#mainFileInfo').hide();
                $(this).val(''); // Clear the file input
                return;
            }
            
            var fileName = file.name;
            var fileSize = (file.size / 1048576).toFixed(2); // Size in MB
            $('#mainFileName').html(fileName + ' <span class="text-muted">(' + fileSize + ' MB)</span>');
            $('#mainFileInfo').show();
            $('#mainFileError').hide();
            $('#mainUploadArea').css('border-color', '#28a745');
        } else {
            $('#mainFileInfo').hide();
            $('#mainUploadArea').css('border-color', '#2c5f2d');
        }
    });
    
    // Remove main file
    $('#removeMainFile').on('click', function() {
        $('#main_file').val('');
        $('#mainFileInfo').hide();
        $('#mainUploadArea').css('border-color', '#2c5f2d');
    });
    
    // ========== FIGURES UPLOAD ==========
    // Click handlers for figures
    $('#figuresUploadArea, #figuresBrowseBtn').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#figures_files').click();
    });
    
    // Figures file change event
    $('#figures_files').on('change', function() {
        var files = this.files;
        var list = '';
        var hasError = false;
        var errorMsg = '';
        
        for(var i = 0; i < files.length; i++) {
            // Check file size (100MB = 104857600 bytes)
            if(files[i].size > 104857600) {
                hasError = true;
                errorMsg = 'Some files exceed 100MB limit. Please select smaller files.';
                continue;
            }
            
            var fileSize = (files[i].size / 1048576).toFixed(2);
            list += '<div class="file-list-item">' +
                    '<span><i class="fa fa-image" style="color: #17a2b8;"></i> ' + files[i].name + 
                    ' <span class="file-size">(' + fileSize + ' MB)</span></span>' +
                    '<button type="button" class="btn btn-xs btn-danger remove-figure" data-index="' + i + '">' +
                    '<i class="fa fa-times"></i></button>' +
                    '</div>';
        }
        
        if(hasError) {
            $('#figuresFileError').html('<div class="alert alert-warning">' + errorMsg + '</div>').show();
        } else {
            $('#figuresFileError').hide();
        }
        
        if(list) {
            $('#figuresFileList').html(list);
            $('#figuresUploadArea').css('border-color', '#28a745');
        } else {
            $('#figuresFileList').empty();
            $('#figuresUploadArea').css('border-color', '#17a2b8');
        }
    });
    
    // Remove individual figure
    $(document).on('click', '.remove-figure', function() {
        // This is more complex with multiple files
        // For simplicity, we'll clear all for now
        $('#figures_files').val('');
        $('#figuresFileList').empty();
        $('#figuresUploadArea').css('border-color', '#17a2b8');
    });
    
    // ========== SUPPLEMENTARY UPLOAD ==========
    // Click handlers for supplementary
    $('#suppUploadArea, #suppBrowseBtn').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('#supplementary_files').click();
    });
    
    // Supplementary file change event
    $('#supplementary_files').on('change', function() {
        var files = this.files;
        var list = '';
        var hasError = false;
        var errorMsg = '';
        
        for(var i = 0; i < files.length; i++) {
            // Check file size (100MB = 104857600 bytes)
            if(files[i].size > 104857600) {
                hasError = true;
                errorMsg = 'Some files exceed 100MB limit. Please select smaller files.';
                continue;
            }
            
            var fileSize = (files[i].size / 1048576).toFixed(2);
            list += '<div class="file-list-item">' +
                    '<span><i class="fa fa-file" style="color: #ffc107;"></i> ' + files[i].name + 
                    ' <span class="file-size">(' + fileSize + ' MB)</span></span>' +
                    '<button type="button" class="btn btn-xs btn-danger remove-supp" data-index="' + i + '">' +
                    '<i class="fa fa-times"></i></button>' +
                    '</div>';
        }
        
        if(hasError) {
            $('#suppFileError').html('<div class="alert alert-warning">' + errorMsg + '</div>').show();
        } else {
            $('#suppFileError').hide();
        }
        
        if(list) {
            $('#suppFileList').html(list);
            $('#suppUploadArea').css('border-color', '#28a745');
        } else {
            $('#suppFileList').empty();
            $('#suppUploadArea').css('border-color', '#ffc107');
        }
    });
    
    // Remove individual supplementary file
    $(document).on('click', '.remove-supp', function() {
        $('#supplementary_files').val('');
        $('#suppFileList').empty();
        $('#suppUploadArea').css('border-color', '#ffc107');
    });
    
    // ========== FORM SUBMISSION ==========
    $('#step3Form').on('submit', function(e) {
        // Check if main file is selected
        if($('#main_file').val() === '') {
            e.preventDefault();
            alert('Please select the main manuscript file');
            return false;
        }
        
        // Check declaration
        if(!$('input[name="declaration"]').is(':checked')) {
            e.preventDefault();
            alert('Please confirm the declaration');
            return false;
        }
        
        $('#submitBtn').html('<i class="fa fa-spinner fa-spin"></i> Submitting...').prop('disabled', true);
        return true;
    });
    
    console.log('Step 3 initialized - Browse buttons should work now');
});
</script>