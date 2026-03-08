<div class="content-wrapper" style="background: #f4f6f9; padding: 40px 0;">
    <div class="container">
        
        <!-- Page Header -->
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 style="color: #2c5f2d; font-size: 3em; font-weight: 700; margin-bottom: 20px;">Contact Us</h1>
                <p class="lead" style="color: #6c757d; max-width: 800px; margin: 0 auto 40px;">
                    Get in touch with the OJAS editorial office for any questions or support.
                </p>
            </div>
        </div>

        <div class="row">
            <!-- Contact Form -->
            <div class="col-md-7">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); padding: 30px; background: white;">
                    <h2 style="color: #2c5f2d; margin-top: 0;">Send us a Message</h2>
                    
                    <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
                    <?php endif; ?>
                    
                    <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                    <?php endif; ?>
                    
                    <form action="<?= base_url('journal/contact') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Your Name *</label>
                                    <input type="text" class="form-control" name="name" required 
                                           style="border-radius: 8px; padding: 10px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Your Email *</label>
                                    <input type="email" class="form-control" name="email" required 
                                           style="border-radius: 8px; padding: 10px;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control" name="subject" 
                                   style="border-radius: 8px; padding: 10px;">
                        </div>
                        
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea class="form-control" name="message" rows="6" required 
                                      style="border-radius: 8px; padding: 10px;"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-ojas" style="background: #2c5f2d; color: white; padding: 12px 30px; border-radius: 8px;">
                            <i class="fa fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-md-5">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); padding: 30px; background: white; margin-bottom: 20px;">
                    <h2 style="color: #2c5f2d; margin-top: 0;">Editorial Office</h2>
                    
                    <div style="margin-bottom: 25px;">
                        <h4 style="color: #2c5f2d;"><i class="fa fa-map-marker"></i> Address</h4>
                        <p style="color: #495057; line-height: 1.8;">
                            Oromia Journal of Agricultural Sciences (OJAS)<br>
                            IQQO Headquarters<br>
                            Finfinne, Ethiopia<br>
                            P.O. Box: XXXX
                        </p>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <h4 style="color: #2c5f2d;"><i class="fa fa-envelope"></i> Email</h4>
                        <p style="color: #495057;">
                            <strong>Editorial Office:</strong> ojas@iqqo.gov.et<br>
                            <strong>Help Desk:</strong> helpdesk@iqqo.gov.et<br>
                            <strong>Ethics & Compliance:</strong> compliance@iqqo.gov.et
                        </p>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <h4 style="color: #2c5f2d;"><i class="fa fa-phone"></i> Phone</h4>
                        <p style="color: #495057;">
                            <strong>Office:</strong> +251-XXX-XXXXXX<br>
                            <strong>Support:</strong> +251-XXX-XXXXXX
                        </p>
                    </div>
                    
                    <div>
                        <h4 style="color: #2c5f2d;"><i class="fa fa-clock-o"></i> Working Hours</h4>
                        <p style="color: #495057;">
                            Monday - Friday: 8:30 AM - 5:30 PM<br>
                            Saturday: 9:00 AM - 1:00 PM<br>
                            Sunday: Closed
                        </p>
                    </div>
                </div>

                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); padding: 25px; background: white; text-align: center;">
                    <h3 style="color: #2c5f2d;">Follow Us</h3>
                    <div style="margin-top: 15px;">
                        <a href="#" class="btn btn-social-icon btn-facebook" style="margin: 0 5px; background: #3b5998; color: white; border-radius: 50%; width: 40px; height: 40px; padding: 8px;">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-social-icon btn-twitter" style="margin: 0 5px; background: #55acee; color: white; border-radius: 50%; width: 40px; height: 40px; padding: 8px;">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-social-icon btn-linkedin" style="margin: 0 5px; background: #0077b5; color: white; border-radius: 50%; width: 40px; height: 40px; padding: 8px;">
                            <i class="fa fa-linkedin"></i>
                        </a>
                        <a href="#" class="btn btn-social-icon btn-google" style="margin: 0 5px; background: #dd4b39; color: white; border-radius: 50%; width: 40px; height: 40px; padding: 8px;">
                            <i class="fa fa-google"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>