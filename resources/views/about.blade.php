@extends('layouts.welcome')
@section('title')
About Us - Best Deals and Discounts |VoucherBoost

@endsection
@section('description')
VoucherBoost is a leading coupon website that offers exclusive deals and discounts on your favorite brands. Save money on your online shopping with our free coupon codes.
@endsection
@section('keywords')
coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping
@endsection
@section('main-content')

  <style>
  body{
      background-color:white;
  }

main{
     font-family: Nunito,Normal;
}

 .footer{
              background-color:red;
        }
        .custom-thumbnail {
    border: 8px solid #bebebe; /* Increase the border size and change color if needed */
    border-radius: 5px; /* Optional: keeps the thumbnail's rounded corners */
}

        .breadcrumb {
            background-color: #f8f9fa;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
            color: #0d6efd;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
            color: #6c757d;
            padding: 0 0.5rem;
        }

        .breadcrumb-item.active {
            font-weight: bold;
        }
        .btn-purple {
            background-color: #6f42c1;
            color: white;
            border: none;
        }     .btn-purple:hover {
            background-color: #5a3ac5;
        }
         .fas{
            color: #6f42c1;

        }
    </style>

   <main class=" text-capitalize">
        <section class="hero bg-light py-5">
          <div class="container">
            <div class="row d-flex align-items-center">
              <div class="col-md-6">
                <h1>Unlock Savings & Shopping Sprees at voucherboost</h1>
                <p class="lead">Find amazing deals, discounts & tips to stretch your budget further. We're your ultimate shopping sidekick!</p>
                <a href="{{route('stores')}}" class="btn btn-purple">Explore Deals Now</a>
              </div>
              <div class="col-md-6">
                <img src="{{ asset('images/about.jpg') }}" alt="voucherboost Welcome Image" class="img-fluid rounded-3">
              </div>
            </div>
          </div>
        </section>

        <section class="about py-5">
          <div class="container">
            <h2>Welcome to voucherboost: Your Shopping Guru</h2>
            <p>Tired of paying full price? We hear you! voucherboost is your trusted companion in the world of discounts, deals, promo codes, bundle offers, and invaluable money-saving tips. We're more than just a website; we empower you to be a smart and informed shopper, making your shopping sprees more fulfilling and budget-friendly.</p>
          </div>
        </section>

        <section class="vision py-5 bg-light">
          <div class="container">
            <div class="row d-flex align-items-center">
              <div class="col-md-6">
                <h2>Our Vision: Empowering Smarter Shopping</h2>
                <p>voucherboost was born out of the desire to create a haven for frugal-minded individuals. We envision a world where everyone can shop confidently and save money on the things they love. We provide the tools and resources you need to make informed decisions and feel empowered on your shopping journey.</p>
              </div>
              <div class="col-md-6">
                <img src="{{asset('images/vision.png')}}" alt="voucherboost Vision Image" class="img-fluid rounded-3">
              </div>
            </div>
          </div>
        </section>

        <section class="offer py-5">
          <div class="container">
            <h2>Unleash Your Savings Potential with voucherboost</h2>
            <div class="row">
              <div class="col-md-4">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <i class="fas fa-tags display-4 "></i>
                    <h5 class="card-title">Discount Codes</h5>
                    <p class="card-text">We curate and provide a wide range of discount codes from your favorite brands and retailers.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <i class="fas fa-percent display-4 "></i>
                    <h5 class="card-title">Deals and Promotions</h5>
                    <p class="card-text">Discover the latest and hottest deals on voucherboost. Save big on everything you need and love.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <i class="fas fa-shopping-cart display-4 "></i>
                    <h5 class="card-title">Bundle Offers</h5>
                    <p class="card-text">Save even more by exploring our bundle offers. Find fantastic deals on complementary products.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-md-4">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <i class="fas fa-balance-scale display-4 "></i>
                    <h5 class="card-title">Product Comparisons</h5>
                    <p class="card-text">Making informed decisions is crucial when shopping. We offer detailed product comparisons to help you choose the best option that fits your needs and budget.</p>
                  </div>
                </div>
              </div>
              <!-- Add more offer cards here -->
            </div>
            <section class="why-choose-section bg-light py-5">
              <div class="container">
                <h2>Why Make voucherboost Your Shopping Ally?</h2>
                <div class="row">
                  <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="fas fa-check-circle  fs-4 me-3"></i>
                        <span>Trustworthy Information</span>
                        <span class="badge bg-primary rounded-pill">Reliable Deals!</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="fas fa-tag  fs-4 me-3"></i>
                        <span>Diverse Range of Deals</span>
                        <span class="badge bg-primary rounded-pill">Something for Everyone!</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="fas fa-users fs-4 me-3"></i>
                        <span>Community and Support</span>
                        <span class="badge bg-primary rounded-pill">Shop Savvy, Together!</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <img src="{{ asset('images/why chose.jpg') }}" alt="Why Choose voucherboost Image" class="img-fluid rounded-3">
                  </div>
                </div>
              </div>
            </section>

          </div>
        </section>
      </main>



@endsection
