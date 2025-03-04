@extends('welcome')
@section('title')
    privacy
@endsection
@section('description')
    Find the latest coupon codes and deals for your favorite stores. Save money on your online shopping with our exclusive discount codes.
@endsection
@section('keywords')
    coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping
@endsection

@section('main-content')

<div class="container">
<nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
<ol class="breadcrumb mb-0">
<li class="breadcrumb-item">
<a href="/" class="text-decoration-none text-primary" style="font-weight: 500;">@lang('message.home')</a>
</li>
<li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">@lang('Privacy.bread-crumb')</li>
</ol>
</nav>
<div class="container bg-light py-5">
    <div class="text-center">
        {{-- <div class="image-container">
            <img src="images/privacy.jpg" alt="Deals 69 Vision Image" class=" pri img-fluid shadow border-info" />
        </div> --}}


      <h1 class="mt-3 mb-4">Protecting Your Privacy at voucherboost</h1>
    </div>

    <div class="row">
      <div class="col-md-8 mx-auto mb-4">
        <p>
          At voucherboost, your privacy and security are our top priorities. This Privacy Policy explains how we collect, use, and protect your information when you use our services. If you disagree with our policies, please refrain from using Deals69.
        </p>
        <p class="text-center fw-bold">Last Updated: October 2023</p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>Key Points for Your Convenience</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="me-3">
                <i class="fas fa-user-circle text-primary fs-4"></i> Information We Collect
              </span>
              <span class="badge bg-primary rounded-pill">Name, Email, Phone (if provided)</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="me-3">
                <i class="fas fa-shield-alt text-primary fs-4"></i> Sensitive Information
              </span>
              <span class="badge bg-primary rounded-pill">Not Processed</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="me-3">
                <i class="fas fa-link text-primary fs-4"></i> Third-Party Information
              </span>
              <span class="badge bg-primary rounded-pill">Not Received</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="me-3">
                <i class="fas fa-cog text-primary fs-4"></i> How We Process Your Information
              </span>
              <p class="ms-auto mb-0">Manage accounts, security, legal obligations (more details in full policy)</p>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span class="me-3">
                <i class="fas fa-user-friends text-primary fs-4"></i> Sharing Information
              </span>
              <p class="ms-auto mb-0">Specific cases, like business transfers (more details in full policy)</p>
            </li>

                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="me-3">
                    <i class="fas fa-shield-alt text-primary fs-4"></i> Data Security
                  </span>
                  <p class="ms-auto mb-0">We take security seriously, but no system is foolproof. Learn more in our full policy.</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="me-3">
                    <i class="fas fa-balance-scale text-primary fs-4"></i> Privacy Rights
                  </span>
                  <p class="ms-auto mb-0">Your location grants specific privacy rights. See details in the full policy.</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="me-3">
                    <i class="fas fa-sign-out-alt text-primary fs-4"></i> Opting Out
                  </span>
                  <p class="ms-auto mb-0">Withdraw consent or opt out of marketing communications.</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="me-3">
                    <i class="fas fa-user-edit text-primary fs-4"></i> Account Management
                  </span>
                  <p class="ms-auto mb-0">Review, update, or delete your account information.</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="me-3">
                    <i class="fas fa-cookie-bite text-primary fs-4"></i> Cookies
                  </span>
                  <p class="ms-auto mb-0">We use cookies. Manage your preferences here (link to cookie settings).</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="me-3">
                    <i class="fas fa-ban text-primary fs-4"></i> Do-Not-Track
                  </span>
                  <p class="ms-auto mb-0">We don't respond to DNT signals (no standard exists).</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="me-3">
                    <i class="fas fa-map-marker-alt text-primary fs-4"></i> California Residents
                  </span>
                  <p class="ms-auto mb-0">California residents have specific privacy rights. See details in the full policy.</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="me-3">
                    <i class="fas fa-sync-alt text-primary fs-4"></i> Updates
                  </span>
                  <p class="ms-auto mb-0">We may update our policy as required by law.</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="me-3">
                    <i class="fas fa-envelope text-primary fs-4"></i> Contact Us
                  </span>
                  <p class="ms-auto mb-0">Have questions? Contact us at <a href="mailto:admin@voucherboost.com">info@voucherboost.com</a>.</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <span class="me-3">
                    <i class="fas fa-file-alt text-primary fs-4"></i> Data Subject Access Request
                  </span>
                  <p class="ms-auto mb-0">Review, update, or delete your data using our data subject access request form.</p>
                </li>


            </ul>

      </div>
    </div>




  </div>


@endsection
