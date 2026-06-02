<?php
$userId = $userInfo->userId;
$name = $userInfo->name;
$title = isset($userInfo->title) ? $userInfo->title : "";
$first_name = isset($userInfo->first_name) ? $userInfo->first_name : "";
$middle_name = isset($userInfo->middle_name) ? $userInfo->middle_name : "";
$last_name = isset($userInfo->last_name) ? $userInfo->last_name : "";
$display_name = trim(preg_replace('/\s+/', ' ', trim($title).' '.trim($first_name).' '.trim($middle_name).' '.trim($last_name)));
if($first_name === '' && $middle_name === '' && $last_name === '' && !empty($name)) {
    $legacyNameParts = preg_split('/\s+/', trim($name));
    $first_name = isset($legacyNameParts[0]) ? $legacyNameParts[0] : '';
    $last_name = count($legacyNameParts) > 1 ? array_pop($legacyNameParts) : '';
    $middle_name = count($legacyNameParts) > 1 ? implode(' ', array_slice($legacyNameParts, 1)) : '';
    $display_name = trim(preg_replace('/\s+/', ' ', trim($title).' '.trim($first_name).' '.trim($middle_name).' '.trim($last_name)));
}
if($display_name === '') { $display_name = $name; }
$email = $userInfo->email;
$mobile = $userInfo->mobile;
$roleId = $userInfo->roleId;
$role = $userInfo->role;
$institution = isset($userInfo->institution) ? $userInfo->institution : '';
$department = isset($userInfo->department) ? $userInfo->department : '';
$country = isset($userInfo->country) ? $userInfo->country : '';
$city = isset($userInfo->city) ? $userInfo->city : '';
$orcid_id = isset($userInfo->orcid_id) ? $userInfo->orcid_id : '';
$expertise_area = isset($userInfo->expertise_area) ? $userInfo->expertise_area : '';
$bio = isset($userInfo->bio) ? $userInfo->bio : '';
$profile_image = isset($userInfo->profile_image) ? $userInfo->profile_image : '';
$profileImagePath = !empty($profile_image) ? base_url('uploads/profile_images/'.$profile_image) : base_url('assets/dist/img/avatar-default.png');
?>

<div class="content-wrapper" style="background: #f4f6f9;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
        <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
          <i class="fa fa-user-circle" style="color: #2c5f2d; margin-right: 10px;"></i>
          My Profile
          <small style="color: #777;">View or modify information</small>
        </h1>
      </div>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- Left column - Profile Card -->
            <div class="col-md-4">
                <div class="box box-success" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05); border: 1px solid #e9ecef;">
                    <div class="box-body box-profile" style="padding: 10px 7px;">
                        <div style="position: relative; width: 150px; height: 150px; margin: 0 auto 15px;">
                            <img class="profile-user-img img-responsive img-circle" 
                                 src="<?php echo $profileImagePath; ?>" 
                                 alt="User profile picture"
                                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <?php if(!empty($profile_image)): ?>
                            <div style="position: absolute; bottom: 5px; right: 5px; background: #2c5f2d; color: white; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border: 2px solid white;">
                                <i class="fa fa-check"></i>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <h3 class="profile-username text-center" style="font-weight: 600; margin: 10px 15px;"><?= $display_name ?></h3>
                        <p class="text-muted text-center" style="margin-bottom: 20px;"><?= $role ?></p>
                        
                        <ul class="list-group list-group-unbordered" style="border-radius: 10px; overflow: hidden;">
                            <li class="list-group-item" style="border: none; border-bottom: 1px solid #f0f0f0; padding: 7px 10px; display: flex; justify-content: space-between; align-items: center;">
                                <b><i class="fa fa-envelope" style="color: #2c5f2d; width: 25px;"></i> Email</b> 
                                <span style="color: #495057; word-break: break-word; max-width: 180px; text-align: right;"><?= $email ?></span>
                            </li>
                            <li class="list-group-item" style="border: none; border-bottom: 1px solid #f0f0f0; padding: 7px 10px; display: flex; justify-content: space-between; align-items: center;">
                                <b><i class="fa fa-phone" style="color: #2c5f2d; width: 25px;"></i> Mobile</b> 
                                <span><?= $mobile ?></span>
                            </li>
                            <?php if(!empty($institution)): ?>
                            <li class="list-group-item" style="border: none; border-bottom: 1px solid #f0f0f0; padding: 7px 10px; display: flex; justify-content: space-between; align-items: center;">
                                <b><i class="fa fa-building" style="color: #2c5f2d; width: 25px;"></i> Institution</b> 
                                <span><?= $institution ?></span>
                            </li>
                            <?php endif; ?>
                            <?php if(!empty($country)): ?>
                            <li class="list-group-item" style="border: none; padding: 12px 15px; display: flex; justify-content: space-between; align-items: center;">
                                <b><i class="fa fa-globe" style="color: #2c5f2d; width: 25px;"></i> Country</b> 
                                <span><?= $country ?></span>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Middle column - Tabs -->
            <div class="col-md-5">
                <div class="nav-tabs-custom" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05); border: 1px solid #e9ecef; background: white;">
                    <ul class="nav nav-tabs" style="background: #f8fafc; border-bottom: 1px solid #e9ecef;">
                        <li class="<?= ($active == "details")? "active" : "" ?>" style="border-right: 1px solid #e9ecef;">
                            <a href="#details" data-toggle="tab" style="color: <?= ($active == "details")? '#2c5f2d' : '#555'; ?>; font-weight: 600; padding: 15px 20px;">
                                <i class="fa fa-user"></i> Details
                            </a>
                        </li>
                        <li class="<?= ($active == "changepass")? "active" : "" ?>">
                            <a href="#changepass" data-toggle="tab" style="color: <?= ($active == "changepass")? '#2c5f2d' : '#555'; ?>; font-weight: 600; padding: 15px 20px;">
                                <i class="fa fa-key"></i> Change Password
                            </a>
                        </li>                        
                    </ul>
                    
                    <div class="tab-content" style="padding: 25px;">
                        <!-- Details Tab -->
                        <div class="<?= ($active == "details")? "active" : "" ?> tab-pane" id="details">
                            <form action="<?php echo base_url() ?>profileUpdate" method="post" id="editProfile" role="form" enctype="multipart/form-data">
                                <?php $this->load->helper('form'); ?>
                                
                                <!-- Profile Image Upload -->
                                <div style="text-align: center; margin-bottom: 25px;">
                                    <div style="position: relative; display: inline-block;">
                                        <img id="profilePreview" src="<?php echo $profileImagePath; ?>" 
                                             style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 3px solid #2c5f2d; padding: 3px; background: white; cursor: pointer;"
                                             onclick="document.getElementById('profile_image').click();">
                                        <div style="position: absolute; bottom: 0; right: 0; background: #2c5f2d; color: white; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border: 2px solid white; cursor: pointer;"
                                             onclick="document.getElementById('profile_image').click();">
                                            <i class="fa fa-camera"></i>
                                        </div>
                                    </div>
                                    <input type="file" id="profile_image" name="profile_image" accept="image/jpeg,image/png,image/gif" style="display: none;" onchange="previewProfileImage(this);">
                                    <p style="margin-top: 10px; color: #6c757d; font-size: 0.85em;">
                                        <i class="fa fa-info-circle"></i> Click image to change (max 2MB)
                                    </p>
                                </div>
                                
                                <div class="box-body">
                                    <input type="hidden" value="<?php echo $userId; ?>" name="userId" id="userId" />
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="title"><i class="fa fa-id-badge" style="color: #2c5f2d; width: 20px;"></i> Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="title" name="title" value="<?php echo set_value('title', $title); ?>" maxlength="20" required placeholder="Dr." style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px 15px;">
                                                <?php echo form_error('title', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="first_name">First Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo set_value('first_name', $first_name); ?>" maxlength="64" required placeholder="First name" style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px 15px;">
                                                <?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="middle_name">Middle Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?php echo set_value('middle_name', $middle_name); ?>" maxlength="64" required placeholder="Middle name" style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px 15px;">
                                                <?php echo form_error('middle_name', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="last_name">Last Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name', $last_name); ?>" maxlength="64" required placeholder="Last name" style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px 15px;">
                                                <?php echo form_error('last_name', '<div class="text-danger">', '</div>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="mobile"><i class="fa fa-phone" style="color: #2c5f2d; width: 20px;"></i> Mobile Number <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" required
                                               value="<?php echo set_value('mobile', $mobile); ?>" maxlength="10"
                                               style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px 15px;">
                                        <?php echo form_error('mobile', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email"><i class="fa fa-envelope" style="color: #2c5f2d; width: 20px;"></i> Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" required
                                               value="<?php echo set_value('email', $email); ?>"
                                               style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px 15px;">
                                        <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                    
                                    <!-- Journal Profile Fields -->
                                    <div style="background: #f8fafc; border-radius: 12px; padding: 20px; margin: 20px 0;">
                                        <h4 style="margin: 0 0 15px 0; color: #333; font-size: 1.1em; font-weight: 600;">
                                            <i class="fa fa-university" style="color: #2c5f2d;"></i> Journal Profile
                                        </h4>
                                        
                                        <div class="form-group">
                                            <label for="institution">Institution/Organization <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="institution" name="institution" required
                                                   value="<?php echo set_value('institution', $institution); ?>" placeholder="e.g., IQQO"
                                                   style="border-radius: 8px; border: 1px solid #ced4da;">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="department">Department <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="department" name="department" required
                                                   value="<?php echo set_value('department', $department); ?>" placeholder="e.g., Agricultural Research"
                                                   style="border-radius: 8px; border: 1px solid #ced4da;">
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="country">Country <span class="text-danger">*</span></label>
                                                    <select class="form-control" id="country" name="country" required style="border-radius: 8px;">
                                                        <option value="">Select Country</option>
                                                        <option value="Ethiopia" <?php echo ($country == 'Ethiopia') ? 'selected' : ''; ?>>🇪🇹 Ethiopia</option>
                                                        <option value="Kenya" <?php echo ($country == 'Kenya') ? 'selected' : ''; ?>>🇰🇪 Kenya</option>
                                                        <option value="Uganda" <?php echo ($country == 'Uganda') ? 'selected' : ''; ?>>🇺🇬 Uganda</option>
                                                        <option value="Tanzania" <?php echo ($country == 'Tanzania') ? 'selected' : ''; ?>>🇹🇿 Tanzania</option>
                                                        <option value="Rwanda" <?php echo ($country == 'Rwanda') ? 'selected' : ''; ?>>🇷🇼 Rwanda</option>
                                                        <option value="South Africa" <?php echo ($country == 'South Africa') ? 'selected' : ''; ?>>🇿🇦 South Africa</option>
                                                        <option value="Nigeria" <?php echo ($country == 'Nigeria') ? 'selected' : ''; ?>>🇳🇬 Nigeria</option>
                                                        <option value="Other" <?php echo ($country == 'Other') ? 'selected' : ''; ?>>🌍 Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="city">City <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="city" name="city" required
                                                           value="<?php echo set_value('city', $city); ?>" placeholder="e.g., Finfinne"
                                                           style="border-radius: 8px;">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="orcid_id">ORCID ID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="orcid_id" name="orcid_id" required
                                                   value="<?php echo set_value('orcid_id', $orcid_id); ?>" placeholder="0000-0002-1825-0097"
                                                   style="border-radius: 8px;">
                                            <small class="text-muted">Format: 0000-0002-1825-0097</small>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="expertise_area">Areas of Expertise <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="expertise_area" name="expertise_area" required
                                                      rows="3" placeholder="e.g., Agronomy, Soil Science, Plant Breeding"
                                                      style="border-radius: 8px;"><?php echo set_value('expertise_area', $expertise_area); ?></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="bio">Biography / Bio</label>
                                            <textarea class="form-control" id="bio" name="bio" 
                                                      rows="4" placeholder="Short professional background"
                                                      style="border-radius: 8px;"><?php echo set_value('bio', $bio); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="box-footer" style="background: white; border-top: 1px solid #e9ecef; padding: 20px 0 0;">
                                    <button type="submit" class="btn" style="background: #2c5f2d; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 500; margin-right: 10px;">
                                        <i class="fa fa-save"></i> Update Profile
                                    </button>
                                    <button type="reset" class="btn" style="background: #f8f9fa; color: #555; border: 1px solid #ced4da; padding: 10px 25px; border-radius: 8px;">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Change Password Tab - FIXED -->
                        <div class="<?= ($active == "changepass")? "active" : "" ?> tab-pane" id="changepass">
                            <form role="form" action="<?php echo base_url() ?>changePassword" method="post">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputOldPassword"><i class="fa fa-lock" style="color: #2c5f2d;"></i> Old Password</label>
                                        <input type="password" class="form-control" id="inputOldPassword" placeholder="Enter old password" 
                                               name="oldPassword" maxlength="20" required
                                               style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px 15px;">
                                        <?php echo form_error('oldPassword', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                    
                                    <hr style="border-top: 1px dashed #e9ecef;">
                                    
                                    <div class="form-group">
                                        <label for="inputPassword1"><i class="fa fa-key" style="color: #2c5f2d;"></i> New Password</label>
                                        <input type="password" class="form-control" id="inputPassword1" placeholder="Enter new password" 
                                               name="newPassword" maxlength="20" required
                                               style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px 15px;">
                                        <?php echo form_error('newPassword', '<div class="text-danger">', '</div>'); ?>
                                        <div id="passwordStrength" style="margin-top: 5px;"></div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputPassword2"><i class="fa fa-check-circle" style="color: #2c5f2d;"></i> Confirm New Password</label>
                                        <input type="password" class="form-control" id="inputPassword2" placeholder="Confirm new password" 
                                               name="cNewPassword" maxlength="20" required
                                               style="border-radius: 8px; border: 1px solid #ced4da; padding: 10px 15px;">
                                        <?php echo form_error('cNewPassword', '<div class="text-danger">', '</div>'); ?>
                                    </div>
                                </div>
                                
                                <div class="box-footer" style="background: white; border-top: 1px solid #e9ecef; padding: 20px 0 0;">
                                    <button type="submit" class="btn" style="background: #2c5f2d; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 500; margin-right: 10px;">
                                        <i class="fa fa-key"></i> Change Password
                                    </button>
                                    <button type="reset" class="btn" style="background: #f8f9fa; color: #555; border: 1px solid #ced4da; padding: 10px 25px; border-radius: 8px;">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>                        
                    </div>
                </div>
            </div>
            
            <!-- Right column - Messages -->
            <div class="col-md-3">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable" style="border-radius: 10px; border-left: 4px solid #dc3545;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-exclamation-triangle"></i> <?php echo $error; ?>                    
                </div>
                <?php } ?>
                
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable" style="border-radius: 10px; border-left: 4px solid #28a745;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-check-circle"></i> <?php echo $success; ?>
                </div>
                <?php } ?>

                <?php  
                    $noMatch = $this->session->flashdata('nomatch');
                    if($noMatch)
                    {
                ?>
                <div class="alert alert-warning alert-dismissable" style="border-radius: 10px; border-left: 4px solid #ffc107;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-exclamation-circle"></i> <?php echo $noMatch; ?>
                </div>
                <?php } ?>
                
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable" style="border-radius: 10px;">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                
                <!-- Profile Tips Card -->
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); border: 1px solid #e9ecef; margin-top: 20px;">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;"><i class="fa fa-lightbulb-o" style="color: #2c5f2d;"></i> Profile Tips</h3>
                    </div>
                    <div class="box-body" style="padding: 20px;">
                        <ul style="padding-left: 20px; color: #6c757d;">
                            <li style="margin-bottom: 10px;">Add a professional profile picture</li>
                            <li style="margin-bottom: 10px;">Keep your ORCID ID updated for research identification</li>
                            <li style="margin-bottom: 10px;">List your expertise areas for reviewer matching</li>
                            <li style="margin-bottom: 10px;">A complete profile increases visibility in the journal</li>
                            <li>Use a strong password with mix of letters, numbers & symbols</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>

<script>
// Profile image preview
function previewProfileImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// Password strength indicator
document.addEventListener('DOMContentLoaded', function() {
    var passwordInput = document.getElementById('inputPassword1');
    if(passwordInput) {
        passwordInput.addEventListener('keyup', function() {
            var password = this.value;
            var strength = 0;
            
            if(password.length >= 8) strength++;
            if(password.match(/[a-z]+/)) strength++;
            if(password.match(/[A-Z]+/)) strength++;
            if(password.match(/[0-9]+/)) strength++;
            if(password.match(/[$@#&!]+/)) strength++;
            
            var colors = ['#dc3545', '#ffc107', '#ffc107', '#17a2b8', '#28a745'];
            var messages = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
            
            var indicator = document.getElementById('passwordStrength');
            if(strength > 0) {
                indicator.innerHTML = '<span style="color: ' + colors[strength-1] + '; font-size: 0.9em;">' + 
                                      '<i class="fa fa-info-circle"></i> Password Strength: ' + messages[strength-1] + '</span>';
            } else {
                indicator.innerHTML = '';
            }
        });
    }

    // Confirm password match
    var confirmInput = document.getElementById('inputPassword2');
    if(confirmInput) {
        confirmInput.addEventListener('keyup', function() {
            var pass1 = document.getElementById('inputPassword1').value;
            var pass2 = this.value;
            
            if(pass2.length > 0) {
                if(pass1 == pass2) {
                    this.style.borderColor = '#28a745';
                } else {
                    this.style.borderColor = '#dc3545';
                }
            } else {
                this.style.borderColor = '#ced4da';
            }
        });
    }
});
</script>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>