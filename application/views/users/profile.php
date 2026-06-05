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

<div class="content-wrapper" style="background: linear-gradient(135deg, #f5f7fa 0%, #e9edf2 100%);">
    <style>
        /* Modern CSS Variables */
        :root {
            --primary: #2c5f2d;
            --primary-dark: #1e3a1f;
            --primary-light: #4a7c4b;
            --primary-soft: #e8f0e8;
            --secondary: #8b5cf6;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            --dark: #1f2937;
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;
            --radius-2xl: 24px;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Header Styles */
        .profile-header {
            background: linear-gradient(135deg, #1a3a1b 0%, #2c5f2d 50%, #3d7a3e 100%);
            border-radius: 0 0 30px 30px;
            padding: 40px 30px 30px;
            margin-bottom: 40px;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
        }

        .profile-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }

        .profile-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-header h1 i {
            font-size: 32px;
            opacity: 0.9;
        }

        .profile-header h1 small {
            font-size: 14px;
            font-weight: 400;
            opacity: 0.8;
            margin-left: 8px;
        }

        .profile-stats {
            display: flex;
            gap: 30px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .stat-item {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            padding: 12px 24px;
            text-align: center;
            min-width: 120px;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 800;
            color: white;
        }

        .stat-label {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.7);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 4px;
        }

        /* Main Container */
        .profile-main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 30px 40px;
        }

        /* Profile Card */
        .profile-card {
            background: white;
            border-radius: var(--radius-2xl);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            transition: var(--transition);
            height: 100%;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .card-cover {
            height: 100px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            position: relative;
        }

        .avatar-container {
            position: relative;
            margin-top: -50px;
            padding: 0 20px;
            text-align: center;
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: var(--shadow-lg);
            background: white;
        }

        .avatar-edit {
            position: absolute;
            bottom: 5px;
            right: calc(50% - 60px);
            background: var(--primary);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            border: 2px solid white;
            transition: var(--transition);
        }

        .avatar-edit:hover {
            background: var(--primary-dark);
            transform: scale(1.1);
        }

        .profile-name-card {
            text-align: center;
            padding: 15px 20px 10px;
        }

        .profile-name-card h3 {
            font-size: 22px;
            font-weight: 700;
            color: var(--gray-800);
            margin: 0 0 5px;
        }

        .profile-badge {
            display: inline-block;
            background: var(--primary-soft);
            color: var(--primary);
            padding: 5px 15px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
        }

        .info-grid {
            padding: 20px;
            border-top: 1px solid var(--gray-200);
        }

        .info-row {
            display: flex;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid var(--gray-100);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 36px;
            height: 36px;
            background: var(--primary-soft);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            margin-right: 12px;
        }

        .info-content {
            flex: 1;
        }

        .info-label {
            font-size: 11px;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 14px;
            font-weight: 500;
            color: var(--gray-800);
            word-break: break-word;
        }

        /* Tabs Container */
        .tabs-wrapper {
            background: white;
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            height: 100%;
        }

        .tab-buttons {
            display: flex;
            background: var(--gray-50);
            border-bottom: 1px solid var(--gray-200);
            padding: 0 24px;
        }

        .tab-btn {
            padding: 18px 28px;
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-600);
            background: none;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .tab-btn i {
            font-size: 16px;
        }

        .tab-btn:hover {
            color: var(--primary);
        }

        .tab-btn.active {
            color: var(--primary);
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--primary);
        }

        .tab-content {
            padding: 32px;
        }

        .tab-pane {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .tab-pane.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Form Styles */
        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 8px;
        }

        .form-group label i {
            color: var(--primary);
            margin-right: 6px;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid var(--gray-200);
            border-radius: var(--radius-md);
            font-size: 14px;
            transition: var(--transition);
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(44, 95, 45, 0.1);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 18px;
        }

        /* Journal Section */
        .journal-section {
            background: linear-gradient(135deg, var(--gray-50), white);
            border-radius: var(--radius-lg);
            padding: 24px;
            margin-top: 24px;
            border: 1px solid var(--gray-200);
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--primary);
            font-size: 20px;
        }

        /* Button Styles */
        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid var(--gray-200);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-secondary {
            background: var(--gray-100);
            color: var(--gray-700);
            border: 1px solid var(--gray-200);
            padding: 12px 32px;
            border-radius: 40px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-secondary:hover {
            background: var(--gray-200);
            transform: translateY(-2px);
        }

        /* Alert Styles */
        .alert-custom {
            border-radius: var(--radius-lg);
            padding: 16px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            border-left: 4px solid var(--success);
            color: #065f46;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            border-left: 4px solid var(--danger);
            color: #991b1b;
        }

        .alert-warning {
            background: linear-gradient(135deg, #fed7aa, #fdba74);
            border-left: 4px solid var(--warning);
            color: #92400e;
        }

        /* Password Strength */
        .password-strength {
            margin-top: 8px;
            font-size: 12px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
            .btn-group {
                flex-direction: column;
            }
            .btn-primary, .btn-secondary {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .profile-header {
                padding: 30px 20px;
            }
            .profile-header h1 {
                font-size: 22px;
            }
            .profile-main {
                padding: 0 16px 30px;
            }
            .tab-buttons {
                padding: 0 16px;
            }
            .tab-btn {
                padding: 14px 16px;
                font-size: 13px;
            }
            .tab-content {
                padding: 20px;
            }
            .info-grid {
                padding: 16px;
            }
        }
    </style>

    <!-- Header Section -->
    <div class="profile-header">
        <h1>
            <i class="fa fa-user-circle"></i>
            My Profile
            <small>Manage your account information</small>
        </h1>
        <div class="profile-stats">
            <div class="stat-item">
                <div class="stat-number"><?php echo $userId; ?></div>
                <div class="stat-label">User ID</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo ucfirst($role); ?></div>
                <div class="stat-label">Role</div>
            </div>
            <div class="stat-item">
                <div class="stat-number"><?php echo date('Y'); ?></div>
                <div class="stat-label">Member Since</div>
            </div>
        </div>
    </div>

    <div class="profile-main">
        <div class="row">
            <!-- Left Column - Profile Card -->
            <div class="col-md-4">
                <div class="profile-card">
                    <div class="card-cover"></div>
                    <div class="avatar-container">
                        <img id="profilePreviewAvatar" class="avatar" src="<?php echo $profileImagePath; ?>" alt="Profile">
                        <div class="avatar-edit" onclick="document.getElementById('profile_image_hidden').click();">
                            <i class="fa fa-camera"></i>
                        </div>
                        <input type="file" id="profile_image_hidden" name="profile_image" accept="image/jpeg,image/png,image/gif" style="display: none;" onchange="previewProfileImage(this);">
                    </div>
                    <div class="profile-name-card">
                        <h3><?php echo $display_name; ?></h3>
                        <span class="profile-badge">
                            <i class="fa fa-trophy"></i> <?php echo $role; ?>
                        </span>
                    </div>
                    <div class="info-grid">
                        <div class="info-row">
                            <div class="info-icon"><i class="fa fa-envelope"></i></div>
                            <div class="info-content">
                                <div class="info-label">Email Address</div>
                                <div class="info-value"><?php echo $email; ?></div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><i class="fa fa-phone"></i></div>
                            <div class="info-content">
                                <div class="info-label">Mobile Number</div>
                                <div class="info-value"><?php echo $mobile ?: 'Not provided'; ?></div>
                            </div>
                        </div>
                        <?php if(!empty($institution)): ?>
                        <div class="info-row">
                            <div class="info-icon"><i class="fa fa-building"></i></div>
                            <div class="info-content">
                                <div class="info-label">Institution</div>
                                <div class="info-value"><?php echo $institution; ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($country)): ?>
                        <div class="info-row">
                            <div class="info-icon"><i class="fa fa-globe"></i></div>
                            <div class="info-content">
                                <div class="info-label">Location</div>
                                <div class="info-value"><?php echo $city ? $city . ', ' : ''; ?><?php echo $country; ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if(!empty($orcid_id)): ?>
                        <div class="info-row">
                            <div class="info-icon"><i class="fa fa-id-card"></i></div>
                            <div class="info-content">
                                <div class="info-label">ORCID ID</div>
                                <div class="info-value"><?php echo $orcid_id; ?></div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column - Tabs -->
            <div class="col-md-8">
                <div class="tabs-wrapper">
                    <div class="tab-buttons">
                        <button class="tab-btn <?php echo ($active == "details")? "active" : ""; ?>" onclick="switchTab('details')">
                            <i class="fa fa-user"></i> Personal Information
                        </button>
                        <button class="tab-btn <?php echo ($active == "changepass")? "active" : ""; ?>" onclick="switchTab('changepass')">
                            <i class="fa fa-key"></i> Security & Password
                        </button>
                    </div>

                    <div class="tab-content">
                        <!-- Alerts -->
                        <div id="alert-container">
                            <?php
                                $error = $this->session->flashdata('error');
                                if($error) {
                            ?>
                            <div class="alert-custom alert-danger">
                                <i class="fa fa-exclamation-triangle"></i>
                                <span><?php echo $error; ?></span>
                            </div>
                            <?php } ?>
                            
                            <?php  
                                $success = $this->session->flashdata('success');
                                if($success) {
                            ?>
                            <div class="alert-custom alert-success">
                                <i class="fa fa-check-circle"></i>
                                <span><?php echo $success; ?></span>
                            </div>
                            <?php } ?>

                            <?php  
                                $noMatch = $this->session->flashdata('nomatch');
                                if($noMatch) {
                            ?>
                            <div class="alert-custom alert-warning">
                                <i class="fa fa-exclamation-circle"></i>
                                <span><?php echo $noMatch; ?></span>
                            </div>
                            <?php } ?>
                            
                            <?php echo validation_errors('<div class="alert-custom alert-danger"><i class="fa fa-exclamation-triangle"></i> ', '</div>'); ?>
                        </div>

                        <!-- Details Tab -->
                        <div id="details-tab" class="tab-pane <?php echo ($active == "details")? "active" : ""; ?>">
                            <form action="<?php echo base_url(); ?>profileUpdate" method="post" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $userId; ?>" name="userId" />

                                <div class="form-row">
                                    <div class="form-group">
                                        <label><i class="fa fa-id-badge"></i> Title</label>
                                        <input type="text" class="form-control" name="title" value="<?php echo set_value('title', $title); ?>" placeholder="Dr./Prof./Mr./Ms.">
                                    </div>
                                    <div class="form-group">
                                        <label>First Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="first_name" value="<?php echo set_value('first_name', $first_name); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name" value="<?php echo set_value('middle_name', $middle_name); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="last_name" value="<?php echo set_value('last_name', $last_name); ?>" required>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group">
                                        <label><i class="fa fa-phone"></i> Mobile Number <span class="required">*</span></label>
                                        <input type="text" class="form-control" name="mobile" value="<?php echo set_value('mobile', $mobile); ?>" required maxlength="10">
                                    </div>
                                    <div class="form-group">
                                        <label><i class="fa fa-envelope"></i> Email <span class="required">*</span></label>
                                        <input type="email" class="form-control" name="email" value="<?php echo set_value('email', $email); ?>" required>
                                    </div>
                                </div>

                                <!-- Journal Profile Section -->
                                <div class="journal-section">
                                    <div class="section-title">
                                        <i class="fa fa-university"></i>
                                        Journal Profile
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Institution <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="institution" value="<?php echo set_value('institution', $institution); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Department <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="department" value="<?php echo set_value('department', $department); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Country <span class="required">*</span></label>
                                            <select class="form-control" name="country" required>
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
                                        <div class="form-group">
                                            <label>City <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="city" value="<?php echo set_value('city', $city); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>ORCID ID</label>
                                            <input type="text" class="form-control" name="orcid_id" value="<?php echo set_value('orcid_id', $orcid_id); ?>" placeholder="0000-0002-1825-0097">
                                            <small style="color: var(--gray-500);">Format: 0000-0002-1825-0097</small>
                                        </div>
                                        <div class="form-group">
                                            <label>Areas of Expertise <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="expertise_area" value="<?php echo set_value('expertise_area', $expertise_area); ?>" required placeholder="e.g., Agronomy, Soil Science">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Biography</label>
                                        <textarea class="form-control" name="bio" rows="4" placeholder="Tell us about your professional background..."><?php echo set_value('bio', $bio); ?></textarea>
                                    </div>
                                </div>

                                <div class="btn-group">
                                    <button type="submit" class="btn-primary">
                                        <i class="fa fa-save"></i> Save Changes
                                    </button>
                                    <button type="reset" class="btn-secondary">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Change Password Tab -->
                        <div id="changepass-tab" class="tab-pane <?php echo ($active == "changepass")? "active" : ""; ?>">
                            <form role="form" action="<?php echo base_url(); ?>changePassword" method="post">
                                <div class="form-group">
                                    <label><i class="fa fa-lock"></i> Current Password <span class="required">*</span></label>
                                    <input type="password" class="form-control" name="oldPassword" placeholder="Enter your current password" required>
                                    <?php echo form_error('oldPassword', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div style="height: 1px; background: var(--gray-200); margin: 20px 0;"></div>

                                <div class="form-group">
                                    <label><i class="fa fa-key"></i> New Password <span class="required">*</span></label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password" required>
                                    <div id="passwordStrength" class="password-strength"></div>
                                    <?php echo form_error('newPassword', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="form-group">
                                    <label><i class="fa fa-check-circle"></i> Confirm New Password <span class="required">*</span></label>
                                    <input type="password" class="form-control" id="confirmPassword" name="cNewPassword" placeholder="Confirm your new password" required>
                                    <?php echo form_error('cNewPassword', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <div class="btn-group">
                                    <button type="submit" class="btn-primary">
                                        <i class="fa fa-key"></i> Update Password
                                    </button>
                                    <button type="reset" class="btn-secondary">
                                        <i class="fa fa-undo"></i> Reset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Tab switching
function switchTab(tabName) {
    // Update buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.closest('.tab-btn').classList.add('active');
    
    // Update panes
    document.getElementById('details-tab').classList.remove('active');
    document.getElementById('changepass-tab').classList.remove('active');
    
    if(tabName === 'details') {
        document.getElementById('details-tab').classList.add('active');
    } else {
        document.getElementById('changepass-tab').classList.add('active');
    }
}

// Profile image preview
function previewProfileImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePreviewAvatar').src = e.target.result;
            
            // Also update any other preview elements
            var formPreview = document.getElementById('profilePreviewForm');
            if(formPreview) formPreview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
        
        // Auto-submit the form to upload the image
        var form = input.closest('form');
        if(form) {
            var formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData
            }).then(response => response.json())
              .then(data => {
                  if(data.success) {
                      showAlert('success', 'Profile image updated successfully!');
                  }
              });
        }
    }
}

// Password strength indicator
document.addEventListener('DOMContentLoaded', function() {
    var passwordInput = document.getElementById('newPassword');
    if(passwordInput) {
        passwordInput.addEventListener('keyup', function() {
            var password = this.value;
            var strength = 0;
            
            if(password.length >= 8) strength++;
            if(password.match(/[a-z]+/)) strength++;
            if(password.match(/[A-Z]+/)) strength++;
            if(password.match(/[0-9]+/)) strength++;
            if(password.match(/[$@#&!]+/)) strength++;
            
            var colors = ['#ef4444', '#f59e0b', '#f59e0b', '#3b82f6', '#10b981'];
            var messages = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
            
            var indicator = document.getElementById('passwordStrength');
            if(strength > 0) {
                indicator.innerHTML = '<span style="color: ' + colors[strength-1] + ';"><i class="fa fa-info-circle"></i> Password Strength: ' + messages[strength-1] + '</span>';
            } else {
                indicator.innerHTML = '';
            }
        });
    }

    // Confirm password match
    var confirmInput = document.getElementById('confirmPassword');
    if(confirmInput) {
        confirmInput.addEventListener('keyup', function() {
            var pass1 = document.getElementById('newPassword').value;
            var pass2 = this.value;
            
            if(pass2.length > 0) {
                if(pass1 === pass2) {
                    this.style.borderColor = '#10b981';
                } else {
                    this.style.borderColor = '#ef4444';
                }
            } else {
                this.style.borderColor = '#d1d5db';
            }
        });
    }
});

// Show alert function
function showAlert(type, message) {
    var alertContainer = document.getElementById('alert-container');
    var alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    var icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle';
    
    var alertDiv = document.createElement('div');
    alertDiv.className = 'alert-custom ' + alertClass;
    alertDiv.innerHTML = '<i class="fa ' + icon + '"></i><span>' + message + '</span>';
    
    alertContainer.insertBefore(alertDiv, alertContainer.firstChild);
    
    setTimeout(function() {
        alertDiv.style.opacity = '0';
        setTimeout(function() {
            alertDiv.remove();
        }, 300);
    }, 5000);
}
</script>

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>