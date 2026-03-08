</div> <!-- Close container -->

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>About OJAS</h5>
                <p>The Oromia Journal of Agricultural Sciences (OJAS) is a peer-reviewed, open-access journal published by IQQO, dedicated to advancing agricultural sciences in Ethiopia and beyond.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="<?= base_url('journal/about') ?>">About the Journal</a></li>
                    <li><a href="<?= base_url('journal/editorial-board') ?>">Editorial Board</a></li>
                    <li><a href="<?= base_url('journal/author-guidelines') ?>">Author Guidelines</a></li>
                    <li><a href="<?= base_url('journal/reviewer-guidelines') ?>">Reviewer Guidelines</a></li>
                    <li><a href="<?= base_url('journal/contact') ?>">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact Info</h5>
                <p><i class="fa fa-map-marker"></i> IQQO, Finfinne, Ethiopia</p>
                <p><i class="fa fa-envelope"></i> ojas@iqqo.gov.et</p>
                <p><i class="fa fa-globe"></i> www.iqqo.gov.et/ojas</p>
                
                <div class="social-links">
                    <a href="#" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <hr style="border-color: rgba(255,255,255,0.1);">
        <div class="row">
            <div class="col-md-6">
                <p>&copy; <?= date('Y') ?> IQQO. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-right">
                <p>Powered by OJAS Journal Management System</p>
            </div>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

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