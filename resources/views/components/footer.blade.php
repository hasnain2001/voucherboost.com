<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>

    <style>
        /* Footer Styling */
        .footer {
            background: linear-gradient(to right, #2a00b7, #b20078);
            color: white;
            padding: 50px 0;
        }
        .footer h2 {
            font-weight: bold;
        }
        .footer-links a {
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 5px;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }
        .footer-img {
            width: 100px;
            border-radius: 10px;
        }
        .footer p {
            font-size: 14px;
            margin-top: 10px;
            opacity: 0.8;
        }
    </style>
</head>
<body>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- Left Side -->
                <div class="col-md-6">
                    <img src="{{asset('images/logo.gif')}}" alt="User" class="footer-img">
                    <h2>Explore Reviews & Blogs</h2>
                    <p>Discover candid, perceptive evaluations and captivating blog posts that ensure you stay
                    abreast of the latest developments across various domains. Let us assist you in navigating
                    through the clutter with our comprehensive reviews on pet food, fashion, health, and fitness,
                    alongside compelling content.</p>
                </div>

                <!-- Right Side -->
                <div class="col-md-6">
                    <h2>More Links</h2>
                    <div class="row footer-links">
                        <div class="col-md-6">
                            <a href="#">Home</a>
                            <a href="{{route('blog')}}">Blogs</a>
                            <a href="{{route('coupons')}}">Promo Codes</a>
                            <a href="{{route('coupons')}}">Privacy Policy</a>
                            <a href="{{route('coupons')}}">Terms & Conditions</a>
                            <a href="{{route('coupons')}}">About Us</a>
                        </div>
                        <div class="col-md-6">
                            
                            <a href="#">Fashion</a>
                            <a href="#">Beauty</a>
                            <a href="#">HomeDecor</a>
                            <a href="#">Petcare</a>
                            <a href="#">Accessories</a>
                            <a href="#">Travelling</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <p>&copy; Copyright blogstrails.com. All symbols and information on this website are our exclusive property.</p>
            </div>
        </div>
    </footer>


</body>
</html>
