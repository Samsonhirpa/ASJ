    </div> <!-- Close main content container -->
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>About OJAS</h5>
                    <p>The Oromia Journal of Agricultural Sciences (OJAS) is a peer-reviewed, open-access journal published by IQQO, dedicated to advancing agricultural sciences in Ethiopia and beyond.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo base_url('journal/about'); ?>">About the Journal</a></li>
                        <li><a href="<?php echo base_url('journal/editorial_board'); ?>">Editorial Board</a></li>
                        <li><a href="<?php echo base_url('journal/author_guidelines'); ?>">Author Guidelines</a></li>
                        <li><a href="<?php echo base_url('journal/reviewer_guidelines'); ?>">Reviewer Guidelines</a></li>
                        <li><a href="<?php echo base_url('journal/contact'); ?>">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5>Contact Info</h5>
                    <p><i class="fas fa-map-marker-alt me-2"></i> IQQO, Finfinne, Ethiopia</p>
                    <p><i class="fas fa-envelope me-2"></i> ojas@iqqo.gov.et</p>
                    <p><i class="fas fa-globe me-2"></i> www.iqqo.gov.et/ojas</p>
                    
                    <div class="mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-linkedin fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-researchgate fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <hr class="mt-3" style="background-color: rgba(255,255,255,0.1);">
            <div class="row mt-3">
                <div class="col-md-6">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> IQQO. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Powered by OJAS Journal Management System</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    </script>
</body>
</html>