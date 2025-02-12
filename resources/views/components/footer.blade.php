<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>About Us</h5>
                <p>We are a company dedicated to providing the best coupons and deals for our customers.</p>
            </div>
            <div class="col-md-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a  class="{{request()->is('/') ? 'active' : '' }}text-white" href="/">Home</a></li>
                    <li><a href="#" class="text-white">About</a></li>
                    <li><a href="#" class="text-white">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contact Us</h5>
                <p>Email: info@couponwebsite.com</p>
                <p>Phone: +123 456 7890</p>
            </div>
        </div>
        <div class="text-center mt-3">
            <p>&copy; 2025 Coupon Website. All rights reserved.</p>
        </div>
    </div>
</footer>