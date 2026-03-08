<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OJAS | Author Registration</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
            min-height: 100vh;
            padding: 20px 0;
        }
        .register-container {
            max-width: 680px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .register-card {
            background: #fff;
            border-radius: 24px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.05);
        }
        .logo-area { text-align: center; margin-bottom: 25px; }
        .logo-area img { width: 100px; margin-bottom: 10px; }
        .logo-area h2 { color: #2c5f2d; font-size: 24px; font-weight: 700; margin: 0; }
        .logo-area p { color: #6b7280; margin: 5px 0 0; }
        .section-title { font-size: 16px; font-weight: 600; color: #2c5f2d; margin: 18px 0 12px; }
        .form-group label { font-size: 13px; color: #374151; font-weight: 500; }
        .form-control {
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            height: 42px;
        }
        textarea.form-control { height: auto; }
        .form-control:focus {
            border-color: #2c5f2d;
            box-shadow: 0 0 0 3px rgba(44,95,45,0.08);
        }
        .btn-register {
            width: 100%;
            border: none;
            background: #2c5f2d;
            color: #fff;
            border-radius: 12px;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 10px;
        }
        .btn-register:hover { background: #1e4b1f; }
        .links { text-align: center; margin-top: 18px; }
        .links a { margin: 0 10px; color: #6b7280; text-decoration: none; }
        .links a:hover { color: #2c5f2d; }
        .alert { border-radius: 10px; }
    </style>
</head>
<body>
<div class="register-container">
    <div class="register-card">
        <div class="logo-area">
            <img src="<?php echo base_url(); ?>assets/images/logo200.jpg" alt="IQQO Logo">
            <h2>Author Registration</h2>
            <p>Create your OJAS author account to submit manuscripts.</p>
        </div>

        <?php $this->load->helper('form'); ?>

        <?php if($this->session->flashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-circle"></i> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>

        <?php echo validation_errors('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ', '</div>'); ?>

        <form action="<?php echo base_url(); ?>registerAuthor" method="post">
            <div class="section-title">Basic Information</div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>" required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="mobile">Phone Number</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo set_value('mobile'); ?>">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="orcid_id">ORCID ID</label>
                    <input type="text" class="form-control" id="orcid_id" name="orcid_id" value="<?php echo set_value('orcid_id'); ?>">
                </div>
            </div>

            <div class="section-title">Institution Details</div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="institution">Institution</label>
                    <input type="text" class="form-control" id="institution" name="institution" value="<?php echo set_value('institution'); ?>">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="department">Department</label>
                    <input type="text" class="form-control" id="department" name="department" value="<?php echo set_value('department'); ?>">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="<?php echo set_value('country'); ?>">
                </div>
                <div class="col-sm-6 form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo set_value('city'); ?>">
                </div>
            </div>

            <div class="section-title">Security</div>
            <div class="row">
                <div class="col-sm-6 form-group">
                    <label for="password">Password *</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="col-sm-6 form-group">
                    <label for="confirm_password">Confirm Password *</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                </div>
            </div>

            <button type="submit" class="btn-register"><i class="fa fa-user-plus"></i> Create Author Account</button>
        </form>

        <div class="links">
            <a href="<?php echo base_url(); ?>journal"><i class="fa fa-home"></i> Home</a>
            <a href="<?php echo base_url(); ?>login"><i class="fa fa-sign-in"></i> Login</a>
        </div>
    </div>
</div>
</body>
</html>
