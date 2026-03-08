<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>OJAS | IQQO Journal Login</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- Bootstrap CSS -->
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Font Awesome -->
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f7fb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            max-width: 400px;
            width: 100%;
        }
        
        .login-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        }
        
        .logo-area {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo-area img {
            width: 120px;
            margin-bottom: 15px;
        }
        
        .logo-area h2 {
            color: #2c5f2d;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.5px;
        }
        
        .logo-area p {
            color: #6b7280;
            font-size: 14px;
            margin-top: 5px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.2s;
            background: white;
        }
        
        .form-control:focus {
            border-color: #2c5f2d;
            outline: none;
            box-shadow: 0 0 0 3px rgba(44, 95, 45, 0.1);
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 18px;
        }
        
        .input-icon input {
            padding-left: 45px;
        }
        
        .btn-login {
            width: 100%;
            padding: 14px;
            background: #2c5f2d;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            background: #1e4b1f;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(44, 95, 45, 0.2);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .links {
            text-align: center;
            margin-top: 25px;
        }
        
        .links a {
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.2s;
        }
        
        .links a:hover {
            color: #2c5f2d;
        }
        
        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        
        .alert i {
            font-size: 18px;
        }
        
        .close {
            margin-left: auto;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            color: inherit;
            opacity: 0.7;
        }
        
        .close:hover {
            opacity: 1;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #9ca3af;
            font-size: 13px;
        }
        
        .footer-text strong {
            color: #2c5f2d;
        }
        
        hr {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 25px 0 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            
            <!-- Logo Area -->
            <div class="logo-area">
                <img src="<?php echo base_url(); ?>assets/images/logo200.jpg" alt="IQQO Logo">
                <h2>OJAS</h2>
                <p>Oromia Journal of Agricultural Sciences</p>
            </div>
            
            <!-- Flash Messages -->
            <?php $this->load->helper('form'); ?>
            
            <?php
            $error = $this->session->flashdata('error');
            if($error)
            {
            ?>
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                    <button type="button" class="close" onclick="this.parentElement.style.display='none'">×</button>
                </div>
            <?php } ?>
            
            <?php
            $success = $this->session->flashdata('success');
            if($success)
            {
            ?>
                <div class="alert alert-success">
                    <i class="fa fa-check-circle"></i>
                    <?php echo $success; ?>
                    <button type="button" class="close" onclick="this.parentElement.style.display='none'">×</button>
                </div>
            <?php } ?>
            
            <?php echo validation_errors('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>', '<button type="button" class="close" onclick="this.parentElement.style.display=\'none\'">×</button></div>'); ?>
            
            <!-- Login Form -->
            <form action="<?php echo base_url(); ?>loginMe" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-icon">
                        <i class="fa fa-envelope"></i>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fa fa-lock"></i>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-login">
                    <i class="fa fa-sign-in" style="margin-right: 8px;"></i> Sign In
                </button>
            </form>
            
            <hr>
            
            <div class="links">
                <a href="<?php echo base_url(); ?>journal">
                    <i class="fa fa-home"></i> Home
                </a>
                <a href="<?php echo base_url(); ?>forgotPassword">
                    <i class="fa fa-question-circle"></i> Forgot Password
                </a>
                <a href="<?php echo base_url(); ?>register">
                    <i class="fa fa-user-plus"></i> Register
                </a>
            </div>
            
            <div class="footer-text">
                <strong>IQQO</strong> • Connecting Agriculture and Science for a Sustainable Future
            </div>
            
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
</body>
</html>