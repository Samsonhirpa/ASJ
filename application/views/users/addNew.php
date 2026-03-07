<div class="content-wrapper" style="background: #f4f6f9; min-height: 100vh; padding: 20px;">
    
    <!-- Header -->
    <section class="content-header" style="margin-bottom: 25px;">
        <div class="row">
            <div class="col-md-12">
                <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
                    <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                        <i class="fa fa-users" style="background: #e8f0e8; color: #2c5f2d; padding: 12px; border-radius: 50%; margin-right: 15px;"></i>
                        <span style="font-weight: 600;">User Management</span>
                        <small style="color: #777; font-size: 0.6em; margin-left: 15px;">Add New User</small>
                    </h1>
                    <div style="margin-top: 15px;">
                        <a href="<?php echo base_url('userListing'); ?>" style="background: #f0f0f0; color: #555; padding: 8px 20px; border-radius: 25px; text-decoration: none; font-size: 0.9em; transition: all 0.3s; display: inline-block;" 
                           onmouseover="this.style.background='#e0e0e0'" onmouseout="this.style.background='#f0f0f0'">
                            <i class="fa fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- Main Form Column -->
            <div class="col-md-8">
                <!-- Main Card -->
                <div style="background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e9ecef;">
                    
                    <!-- Card Header -->
                    <div style="background: #f8fafc; padding: 20px 25px; border-bottom: 1px solid #e9ecef;">
                        <h3 style="color: #333; margin: 0; font-size: 1.3em; font-weight: 600;">
                            <i class="fa fa-user-plus" style="color: #2c5f2d; margin-right: 10px;"></i>
                            Enter User Details
                        </h3>
                        <p style="color: #6c757d; margin: 8px 0 0 0; font-size: 0.9em;">
                            <i class="fa fa-info-circle"></i> Fields marked with <span style="color: #dc3545;">*</span> are required
                        </p>
                    </div>
                    
                    <!-- Form Body -->
                    <div style="padding: 30px;">
                        <?php $this->load->helper("form"); ?>
                        <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form" enctype="multipart/form-data">
                            
                            <!-- Basic Information Section -->
                            <div style="margin-bottom: 30px;">
                                <h4 style="color: #333; font-size: 1.1em; font-weight: 600; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #e9ecef;">
                                    <i class="fa fa-user-circle" style="color: #2c5f2d; margin-right: 10px;"></i>
                                    Basic Information
                                </h4>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #495057; font-weight: 500;">
                                                Full Name <span style="color: #dc3545;">*</span>
                                            </label>
                                            <div style="position: relative;">
                                                <i class="fa fa-user" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd;"></i>
                                                <input type="text" class="form-control required" value="<?php echo set_value('fname'); ?>" 
                                                       id="fname" name="fname" maxlength="128" required
                                                       style="padding: 10px 15px 10px 40px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff;"
                                                       onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                       onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'"
                                                       placeholder="John Doe">
                                            </div>
                                            <?php echo form_error('fname', '<div style="color: #dc3545; font-size: 0.85em; margin-top: 5px;">', '</div>'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #495057; font-weight: 500;">
                                                Email Address <span style="color: #dc3545;">*</span>
                                            </label>
                                            <div style="position: relative;">
                                                <i class="fa fa-envelope" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd;"></i>
                                                <input type="email" class="form-control required email" value="<?php echo set_value('email'); ?>" 
                                                       id="email" name="email" maxlength="128" required
                                                       style="padding: 10px 15px 10px 40px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff;"
                                                       onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                       onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'"
                                                       placeholder="john@example.com">
                                            </div>
                                            <?php echo form_error('email', '<div style="color: #dc3545; font-size: 0.85em; margin-top: 5px;">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #495057; font-weight: 500;">
                                                Password <span style="color: #dc3545;">*</span>
                                            </label>
                                            <div style="position: relative;">
                                                <i class="fa fa-lock" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd;"></i>
                                                <input type="password" class="form-control required" id="password" name="password" maxlength="20" required
                                                       style="padding: 10px 15px 10px 40px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff;"
                                                       onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                       onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'"
                                                       placeholder="••••••••">
                                            </div>
                                            <?php echo form_error('password', '<div style="color: #dc3545; font-size: 0.85em; margin-top: 5px;">', '</div>'); ?>
                                            <div id="passwordStrength" style="margin-top: 5px;"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #495057; font-weight: 500;">
                                                Confirm Password <span style="color: #dc3545;">*</span>
                                            </label>
                                            <div style="position: relative;">
                                                <i class="fa fa-check-circle" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd;"></i>
                                                <input type="password" class="form-control required equalTo" id="cpassword" name="cpassword" maxlength="20" required
                                                       style="padding: 10px 15px 10px 40px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff;"
                                                       onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                       onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'"
                                                       placeholder="••••••••">
                                            </div>
                                            <?php echo form_error('cpassword', '<div style="color: #dc3545; font-size: 0.85em; margin-top: 5px;">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #495057; font-weight: 500;">
                                                Mobile Number <span style="color: #dc3545;">*</span>
                                            </label>
                                            <div style="position: relative;">
                                                <i class="fa fa-phone" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd;"></i>
                                                <input type="text" class="form-control required digits" value="<?php echo set_value('mobile'); ?>" 
                                                       id="mobile" name="mobile" maxlength="10" required
                                                       style="padding: 10px 15px 10px 40px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff;"
                                                       onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                       onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'"
                                                       placeholder="912345678">
                                            </div>
                                            <?php echo form_error('mobile', '<div style="color: #dc3545; font-size: 0.85em; margin-top: 5px;">', '</div>'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #495057; font-weight: 500;">
                                                Role <span style="color: #dc3545;">*</span>
                                            </label>
                                            <div style="position: relative;">
                                                <i class="fa fa-tag" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd; z-index: 1;"></i>
                                                <select class="form-control required" id="role" name="role" required
                                                        style="padding: 10px 30px 10px 40px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; appearance: none; background: #fff; cursor: pointer; transition: all 0.2s; color: #495057;"
                                                        onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                        onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'">
                                                    <option value="0" style="color: #495057;">Select Role</option>
                                                    <?php
                                                    if(!empty($roles))
                                                    {
                                                        foreach ($roles as $rl)
                                                        {
                                                            $roleText = $rl->role;
                                                            $roleClass = false;
                                                            if ($rl->status == 2) {
                                                                $roleText = $rl->role . ' (Inactive)';
                                                                $roleClass = true;
                                                            }
                                                            $selected = ($rl->roleId == set_value('role')) ? 'selected' : '';
                                                            ?>
                                                            <option value="<?php echo $rl->roleId ?>" <?php echo $selected; ?> <?php if ($roleClass) { echo "style='color:#ffc107;'"; } ?>>
                                                                <?= $roleText ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <i class="fa fa-chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd; pointer-events: none;"></i>
                                            </div>
                                            <?php echo form_error('role', '<div style="color: #dc3545; font-size: 0.85em; margin-top: 5px;">', '</div>'); ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #495057; font-weight: 500;">
                                                User Type
                                            </label>
                                            <div style="position: relative;">
                                                <i class="fa fa-shield" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd; z-index: 1;"></i>
                                                <select class="form-control" id="isAdmin" name="isAdmin"
                                                        style="padding: 10px 30px 10px 40px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; appearance: none; background: #fff; cursor: pointer; transition: all 0.2s; color: #495057;"
                                                        onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                        onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'">
                                                    <option value="2" <?php echo set_value('isAdmin') == '2' ? 'selected' : ''; ?> style="color: #495057;">Regular User</option>
                                                    <option value="1" <?php echo set_value('isAdmin') == '1' ? 'selected' : ''; ?> style="color: #495057;">System Administrator</option>
                                                </select>
                                                <i class="fa fa-chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd; pointer-events: none;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 20px;">
                                            <label style="display: block; margin-bottom: 8px; color: #495057; font-weight: 500;">
                                                <i class="fa fa-id-card"></i> ORCID ID
                                            </label>
                                            <div style="position: relative;">
                                                <i class="fa fa-qrcode" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd;"></i>
                                                <input type="text" class="form-control" id="orcid_id" name="orcid_id" 
                                                       placeholder="0000-0002-1825-0097" value="<?php echo set_value('orcid_id'); ?>"
                                                       style="padding: 10px 15px 10px 40px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff;"
                                                       onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                       onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'">
                                            </div>
                                            <small style="color: #6c757d; font-size: 0.8em; margin-top: 5px; display: block;">
                                                <i class="fa fa-info-circle"></i> Format: 0000-0002-1825-0097
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Profile Image Upload Section -->
                            <div style="margin-bottom: 30px;">
                                <h4 style="color: #333; font-size: 1.1em; font-weight: 600; margin-bottom: 20px; padding-bottom: 10px; border-bottom: 2px solid #e9ecef;">
                                    <i class="fa fa-camera" style="color: #2c5f2d; margin-right: 10px;"></i>
                                    Profile Picture
                                </h4>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="display: flex; align-items: center; gap: 30px; flex-wrap: wrap;">
                                            <!-- Image Preview -->
                                            <div style="text-align: center;">
                                                <div id="imagePreview" style="width: 150px; height: 150px; border-radius: 50%; background: #f8f9fa; border: 3px dashed #ced4da; display: flex; align-items: center; justify-content: center; overflow: hidden; margin-bottom: 10px; position: relative;">
                                                    <img id="previewImg" src="<?php echo base_url('assets/dist/img/avatar-default.png'); ?>" alt="Profile Preview" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                                                    <div id="uploadOverlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); display: none; align-items: center; justify-content: center; color: white; border-radius: 50%;">
                                                        <i class="fa fa-upload" style="font-size: 2em;"></i>
                                                    </div>
                                                </div>
                                                <small style="color: #6c757d;">Preview</small>
                                            </div>
                                            
                                            <!-- Upload Controls -->
                                            <div style="flex: 1;">
                                                <div style="margin-bottom: 15px;">
                                                    <label for="profile_image" style="display: inline-block; background: #2c5f2d; color: white; padding: 12px 25px; border-radius: 8px; cursor: pointer; transition: all 0.2s; font-weight: 500; border: none;"
                                                           onmouseover="this.style.background='#1e4b1f'; document.getElementById('uploadOverlay').style.display='flex';"
                                                           onmouseout="this.style.background='#2c5f2d'; document.getElementById('uploadOverlay').style.display='none';">
                                                        <i class="fa fa-upload"></i> Choose Profile Picture
                                                    </label>
                                                    <input type="file" id="profile_image" name="profile_image" accept="image/jpeg,image/png,image/gif" style="display: none;" onchange="previewImage(this);">
                                                    <span id="fileName" style="margin-left: 15px; color: #6c757d;">No file chosen</span>
                                                </div>
                                                
                                                <div style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
                                                    <p style="margin: 0 0 8px 0; color: #495057; font-weight: 500;"><i class="fa fa-info-circle" style="color: #2c5f2d;"></i> Image Requirements:</p>
                                                    <ul style="margin: 0; padding-left: 20px; color: #6c757d; font-size: 0.9em;">
                                                        <li>Formats: JPG, JPEG, PNG, GIF</li>
                                                        <li>Max size: 2MB</li>
                                                        <li>Max dimensions: 1024x1024 pixels</li>
                                                        <li>Square image recommended for best results</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Journal Profile Section -->
                            <div style="background: #f8fafc; border-radius: 12px; padding: 25px; margin-bottom: 30px; border: 1px solid #e9ecef;">
                                <h4 style="color: #333; font-size: 1.1em; font-weight: 600; margin-bottom: 20px;">
                                    <i class="fa fa-university" style="color: #2c5f2d; margin-right: 10px;"></i>
                                    Journal Profile Information
                                </h4>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 15px;">
                                            <label style="display: block; margin-bottom: 5px; color: #495057; font-weight: 500; font-size: 0.9em;">
                                                <i class="fa fa-building"></i> Institution/Organization
                                            </label>
                                            <input type="text" class="form-control" id="institution" name="institution" 
                                                   placeholder="e.g., IQQO, Addis Ababa University" value="<?php echo set_value('institution'); ?>"
                                                   style="padding: 10px 15px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff;"
                                                   onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                   onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 15px;">
                                            <label style="display: block; margin-bottom: 5px; color: #495057; font-weight: 500; font-size: 0.9em;">
                                                <i class="fa fa-sitemap"></i> Department
                                            </label>
                                            <input type="text" class="form-control" id="department" name="department" 
                                                   placeholder="e.g., Agricultural Research" value="<?php echo set_value('department'); ?>"
                                                   style="padding: 10px 15px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff;"
                                                   onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                   onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 15px;">
                                            <label style="display: block; margin-bottom: 5px; color: #495057; font-weight: 500; font-size: 0.9em;">
                                                <i class="fa fa-globe"></i> Country
                                            </label>
                                            <div style="position: relative;">
                                                <select class="form-control" id="country" name="country"
                                                        style="padding: 10px 30px 10px 15px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; appearance: none; background: #fff; cursor: pointer; transition: all 0.2s; color: #495057;"
                                                        onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                        onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'">
                                                    <option value="" style="color: #495057;">Select Country</option>
                                                    <option value="Ethiopia" <?php echo set_value('country') == 'Ethiopia' ? 'selected' : ''; ?> style="color: #495057;">🇪🇹 Ethiopia</option>
                                                    <option value="Kenya" <?php echo set_value('country') == 'Kenya' ? 'selected' : ''; ?> style="color: #495057;">🇰🇪 Kenya</option>
                                                    <option value="Uganda" <?php echo set_value('country') == 'Uganda' ? 'selected' : ''; ?> style="color: #495057;">🇺🇬 Uganda</option>
                                                    <option value="Tanzania" <?php echo set_value('country') == 'Tanzania' ? 'selected' : ''; ?> style="color: #495057;">🇹🇿 Tanzania</option>
                                                    <option value="Rwanda" <?php echo set_value('country') == 'Rwanda' ? 'selected' : ''; ?> style="color: #495057;">🇷🇼 Rwanda</option>
                                                    <option value="South Africa" <?php echo set_value('country') == 'South Africa' ? 'selected' : ''; ?> style="color: #495057;">🇿🇦 South Africa</option>
                                                    <option value="Nigeria" <?php echo set_value('country') == 'Nigeria' ? 'selected' : ''; ?> style="color: #495057;">🇳🇬 Nigeria</option>
                                                    <option value="Ghana" <?php echo set_value('country') == 'Ghana' ? 'selected' : ''; ?> style="color: #495057;">🇬🇭 Ghana</option>
                                                    <option value="Egypt" <?php echo set_value('country') == 'Egypt' ? 'selected' : ''; ?> style="color: #495057;">🇪🇬 Egypt</option>
                                                    <option value="Sudan" <?php echo set_value('country') == 'Sudan' ? 'selected' : ''; ?> style="color: #495057;">🇸🇩 Sudan</option>
                                                    <option value="Other" <?php echo set_value('country') == 'Other' ? 'selected' : ''; ?> style="color: #495057;">🌍 Other</option>
                                                </select>
                                                <i class="fa fa-chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #adb5bd; pointer-events: none;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div style="margin-bottom: 15px;">
                                            <label style="display: block; margin-bottom: 5px; color: #495057; font-weight: 500; font-size: 0.9em;">
                                                <i class="fa fa-map-marker"></i> City
                                            </label>
                                            <input type="text" class="form-control" id="city" name="city" 
                                                   placeholder="e.g., Finfinne, Addis Ababa" value="<?php echo set_value('city'); ?>"
                                                   style="padding: 10px 15px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff;"
                                                   onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                   onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin-bottom: 15px;">
                                            <label style="display: block; margin-bottom: 5px; color: #495057; font-weight: 500; font-size: 0.9em;">
                                                <i class="fa fa-flask"></i> Areas of Expertise
                                            </label>
                                            <textarea class="form-control" id="expertise_area" name="expertise_area" 
                                                      rows="3" placeholder="e.g., Agronomy, Soil Science, Plant Breeding, Crop Protection"
                                                      style="padding: 12px 15px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff; resize: vertical;"
                                                      onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                      onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'"><?php echo set_value('expertise_area'); ?></textarea>
                                            <small style="color: #6c757d; font-size: 0.8em; margin-top: 5px; display: block;">
                                                <i class="fa fa-info-circle"></i> Separate multiple areas with commas
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style="margin-bottom: 15px;">
                                            <label style="display: block; margin-bottom: 5px; color: #495057; font-weight: 500; font-size: 0.9em;">
                                                <i class="fa fa-address-card"></i> Biography / Bio
                                            </label>
                                            <textarea class="form-control" id="bio" name="bio" 
                                                      rows="4" placeholder="Short biography / professional background"
                                                      style="padding: 12px 15px; border: 1px solid #ced4da; border-radius: 8px; width: 100%; font-size: 0.95em; transition: all 0.2s; background: #fff; resize: vertical;"
                                                      onfocus="this.style.borderColor='#2c5f2d'; this.style.boxShadow='0 0 0 3px rgba(44,95,45,0.1)'"
                                                      onblur="this.style.borderColor='#ced4da'; this.style.boxShadow='none'"><?php echo set_value('bio'); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Form Actions -->
                            <div style="display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px;">
                                <button type="reset" class="btn" style="padding: 10px 25px; border: 1px solid #ced4da; border-radius: 8px; background: #fff; color: #495057; font-weight: 500; cursor: pointer; transition: all 0.2s;"
                                        onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='#fff'">
                                    <i class="fa fa-undo"></i> Reset
                                </button>
                                <button type="submit" class="btn" style="padding: 10px 30px; border: none; border-radius: 8px; background: #2c5f2d; color: white; font-weight: 500; cursor: pointer; transition: all 0.2s; box-shadow: 0 2px 5px rgba(44,95,45,0.2);"
                                        onmouseover="this.style.background='#1e4b1f'; this.style.boxShadow='0 4px 8px rgba(44,95,45,0.3)'"
                                        onmouseout="this.style.background='#2c5f2d'; this.style.boxShadow='0 2px 5px rgba(44,95,45,0.2)'">
                                    <i class="fa fa-save"></i> Create User
                                </button>
                                <a href="<?php echo base_url('userListing'); ?>" class="btn" style="padding: 10px 25px; border: 1px solid #ced4da; border-radius: 8px; background: #fff; color: #495057; font-weight: 500; text-decoration: none; transition: all 0.2s; display: inline-block;"
                                   onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='#fff'">
                                    <i class="fa fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Alerts & Help -->
            <div class="col-md-4">
                <!-- Alerts Section -->
                <div>
                    <?php
                        $this->load->helper('form');
                        $error = $this->session->flashdata('error');
                        if($error)
                        {
                    ?>
                    <div style="background: #f8d7da; border-left: 4px solid #dc3545; border-radius: 8px; padding: 15px 20px; margin-bottom: 20px; color: #721c24;">
                        <button type="button" style="float: right; background: none; border: none; color: #721c24; cursor: pointer; font-size: 1.2em;" onclick="this.parentElement.style.display='none'">×</button>
                        <i class="fa fa-exclamation-triangle" style="margin-right: 10px;"></i>
                        <?php echo $this->session->flashdata('error'); ?>                    
                    </div>
                    <?php } ?>
                    
                    <?php  
                        $success = $this->session->flashdata('success');
                        if($success)
                        {
                    ?>
                    <div style="background: #d4edda; border-left: 4px solid #28a745; border-radius: 8px; padding: 15px 20px; margin-bottom: 20px; color: #155724;">
                        <button type="button" style="float: right; background: none; border: none; color: #155724; cursor: pointer; font-size: 1.2em;" onclick="this.parentElement.style.display='none'">×</button>
                        <i class="fa fa-check-circle" style="margin-right: 10px;"></i>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } ?>
                    
                    <?php if(validation_errors()): ?>
                    <div style="background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 8px; padding: 15px 20px; margin-bottom: 20px; color: #856404;">
                        <i class="fa fa-exclamation-circle" style="margin-right: 10px;"></i>
                        <?php echo validation_errors(); ?>
                    </div>
                    <?php endif; ?>
                </div>
                
                <!-- Help Card -->
                <div style="background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e9ecef;">
                    <div style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h4 style="color: #333; margin: 0; font-size: 1.1em; font-weight: 600;">
                            <i class="fa fa-info-circle" style="color: #2c5f2d;"></i> Journal Profile Information
                        </h4>
                    </div>
                    <div style="padding: 20px;">
                        <div style="display: flex; gap: 12px; margin-bottom: 15px;">
                            <div style="background: #e8f0e8; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fa fa-id-card" style="color: #2c5f2d;"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0 0 3px 0; color: #333; font-weight: 600; font-size: 0.95em;">ORCID ID</h5>
                                <p style="margin: 0; color: #6c757d; font-size: 0.85em;">Unique researcher identifier. <a href="https://orcid.org" target="_blank" style="color: #2c5f2d; text-decoration: none;">Get yours</a></p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 12px; margin-bottom: 15px;">
                            <div style="background: #e8f0e8; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fa fa-university" style="color: #2c5f2d;"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0 0 3px 0; color: #333; font-weight: 600; font-size: 0.95em;">Institution</h5>
                                <p style="margin: 0; color: #6c757d; font-size: 0.85em;">Your university or research organization</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 12px; margin-bottom: 15px;">
                            <div style="background: #e8f0e8; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fa fa-flask" style="color: #2c5f2d;"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0 0 3px 0; color: #333; font-weight: 600; font-size: 0.95em;">Expertise</h5>
                                <p style="margin: 0; color: #6c757d; font-size: 0.85em;">Your research areas for reviewer matching</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 12px;">
                            <div style="background: #e8f0e8; width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <i class="fa fa-address-card" style="color: #2c5f2d;"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0 0 3px 0; color: #333; font-weight: 600; font-size: 0.95em;">Bio</h5>
                                <p style="margin: 0; color: #6c757d; font-size: 0.85em;">Short professional summary</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>

<!-- Styles -->
<style>
    .form-control:focus {
        outline: none;
    }
    
    select.form-control option {
        padding: 10px;
        color: #495057;
    }
    
    select.form-control option:checked {
        background: #e8f0e8 linear-gradient(0deg, #e8f0e8 0%, #e8f0e8 100%);
        color: #2c5f2d;
    }
    
    select.form-control option:hover {
        background: #f0f0f0;
    }
    
    select.form-control option.text-warning {
        color: #ffc107 !important;
    }
    
    select.form-control option.text-warning:checked {
        background: #fff3cd;
    }
    
    #imagePreview {
        transition: all 0.3s ease;
    }
    
    #imagePreview:hover {
        border-color: #2c5f2d;
        transform: scale(1.02);
    }
</style>

<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function(){
        // Image preview function
        window.previewImage = function(input) {
            var fileName = input.files[0] ? input.files[0].name : 'No file chosen';
            $('#fileName').text(fileName);
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $('#previewImg').attr('src', e.target.result);
                    $('#imagePreview').css('border', '3px solid #2c5f2d');
                }
                
                reader.readAsDataURL(input.files[0]);
                
                // Check file size
                if (input.files[0].size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    $('#profile_image').val('');
                    $('#previewImg').attr('src', '<?php echo base_url('assets/dist/img/avatar-default.png'); ?>');
                    $('#imagePreview').css('border', '3px dashed #ced4da');
                    $('#fileName').text('No file chosen');
                }
            } else {
                $('#previewImg').attr('src', '<?php echo base_url('assets/dist/img/avatar-default.png'); ?>');
                $('#imagePreview').css('border', '3px dashed #ced4da');
            }
        }
        
        // ORCID validation
        $("#orcid_id").on('blur', function(){
            var orcid = $(this).val();
            if(orcid && orcid != ''){
                var orcidPattern = /^\d{4}-\d{4}-\d{4}-\d{3}[0-9X]$/;
                if(!orcidPattern.test(orcid)){
                    $(this).css('borderColor', '#dc3545');
                    if($(this).next('.help-block').length == 0){
                        $(this).after('<span class="help-block" style="color: #dc3545; font-size: 0.8em; margin-top: 5px; display: block;"><i class="fa fa-exclamation-circle"></i> ORCID format should be 0000-0002-1825-0097</span>');
                    }
                } else {
                    $(this).css('borderColor', '#28a745');
                    $(this).next('.help-block').remove();
                }
            }
        });
        
        // Password strength indicator
        $("#password").on('keyup', function(){
            var password = $(this).val();
            var strength = 0;
            
            if(password.length >= 8) strength++;
            if(password.match(/[a-z]+/)) strength++;
            if(password.match(/[A-Z]+/)) strength++;
            if(password.match(/[0-9]+/)) strength++;
            if(password.match(/[$@#&!]+/)) strength++;
            
            var colors = ['#dc3545', '#ffc107', '#ffc107', '#17a2b8', '#28a745'];
            var messages = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
            
            $(this).css('borderColor', colors[strength-1] || '#ced4da');
            
            if($('#passwordStrength').length == 0){
                $(this).after('<div id="passwordStrength" style="margin-top: 5px;"></div>');
            }
            
            if(strength > 0){
                $('#passwordStrength').html('<span style="color: ' + colors[strength-1] + '; font-size: 0.9em;">' + 
                                           '<i class="fa fa-info-circle"></i> Password Strength: ' + messages[strength-1] + '</span>');
            } else {
                $('#passwordStrength').html('');
            }
        });
        
        // Confirm password match
        $("#cpassword").on('keyup', function(){
            var pass1 = $("#password").val();
            var pass2 = $(this).val();
            
            if(pass2.length > 0){
                if(pass1 == pass2){
                    $(this).css('borderColor', '#28a745');
                } else {
                    $(this).css('borderColor', '#dc3545');
                }
            } else {
                $(this).css('borderColor', '#ced4da');
            }
        });
        
        // Hover effect for image preview
        $("#imagePreview").hover(
            function() {
                $(this).css('transform', 'scale(1.02)');
            },
            function() {
                $(this).css('transform', 'scale(1)');
            }
        );
    });
</script>