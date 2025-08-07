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
@push('styles')
    <style>
            main{
            font-family: Nunito,Normal;
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
@endpush
@section('main-content')
   <main class=" text-capitalize">
        <section class="hero bg-light py-5">
          <div class="container">
            <div class="row d-flex align-items-center">
              <div class="col-md-6">
                <h1>@lang('about.heading-1')</h1>
                <p class="lead">@lang('about.p-1')</p>
                <a href="{{route('stores')}}" class="btn btn-purple">@lang('about.explore-button')</a>
              </div>
              <div class="col-md-6">
                <img src="{{ asset('images/about.jpg') }}" alt="@lang('about.hero-image-alt')" class="img-fluid rounded-3">
              </div>
            </div>
          </div>
        </section>

        <section class="about py-5">
          <div class="container">
            <h2>@lang('about.heading-2')</h2>
            <p>@lang('about.p-2')</p>
          </div>
        </section>

        <section class="vision py-5 bg-light">
          <div class="container">
            <div class="row d-flex align-items-center">
              <div class="col-md-6">
                <h2>@lang('about.vision.heading')</h2>
                <p>@lang('about.vision.content')</p>
              </div>
              <div class="col-md-6">
                <img src="{{asset('images/vision.png')}}" alt="@lang('about.vision.image-alt')" class="img-fluid rounded-3">
              </div>
            </div>
          </div>
        </section>

        <section class="offer py-5">
          <div class="container">
            <h2>@lang('about.offers.heading')</h2>
            <div class="row">
              <div class="col-md-4">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <i class="fas fa-tags display-4 "></i>
                    <h5 class="card-title">@lang('about.offers.discount-codes.title')</h5>
                    <p class="card-text">@lang('about.offers.discount-codes.content')</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <i class="fas fa-percent display-4 "></i>
                    <h5 class="card-title">@lang('about.offers.deals.title')</h5>
                    <p class="card-text">@lang('about.offers.deals.content')</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <i class="fas fa-shopping-cart display-4 "></i>
                    <h5 class="card-title">@lang('about.offers.bundles.title')</h5>
                    <p class="card-text">@lang('about.offers.bundles.content')</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-md-4">
                <div class="card shadow-sm border-0">
                  <div class="card-body">
                    <i class="fas fa-balance-scale display-4 "></i>
                    <h5 class="card-title">@lang('about.offers.comparisons.title')</h5>
                    <p class="card-text">@lang('about.offers.comparisons.content')</p>
                  </div>
                </div>
              </div>
            </div>
            <section class="why-choose-section bg-light py-5">
              <div class="container">
                <h2>@lang('about.why-choose.heading')</h2>
                <div class="row">
                  <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="fas fa-check-circle  fs-4 me-3"></i>
                        <span>@lang('about.why-choose.trust.title')</span>
                        <span class="badge bg-primary rounded-pill">@lang('about.why-choose.trust.badge')</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="fas fa-tag  fs-4 me-3"></i>
                        <span>@lang('about.why-choose.diversity.title')</span>
                        <span class="badge bg-primary rounded-pill">@lang('about.why-choose.diversity.badge')</span>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <i class="fas fa-users fs-4 me-3"></i>
                        <span>@lang('about.why-choose.community.title')</span>
                        <span class="badge bg-primary rounded-pill">@lang('about.why-choose.community.badge')</span>
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-6">
                    <img src="{{ asset('images/why chose.jpg') }}" alt="@lang('about.why-choose.image-alt')" class="img-fluid rounded-3">
                  </div>
                </div>
              </div>
            </section>
          </div>
        </section>
   </main>
@endsection
