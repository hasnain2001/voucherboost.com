@extends('layouts.welcome')
@section('title','Contact Us - Best Deals and Discounts |VoucherBoost')
@section('description','Contact VoucherBoost for any queries, feedback, or suggestions. We are here to help you with the best deals and discounts on your favorite brands.')
@section('keywords','contact us, feedback, suggestions, queries, best deals, discounts, coupon codes, promo codes, offers, vouchers, savings, online shopping')
@section('main-content')
<section class="contact-us py-5 text-capitalize">
  <div class="container">
    <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none text-primary" style="font-weight: 500;">{{ __('contact.Home') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">{{ __('contact.Contact') }}</li>
        </ol>
    </nav>
    <div class="row">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{asset('images/contact.png')}}" alt="Company Image" class="img-fluid rounded shadow-sm" style="height:400px; width:100%;">
      </div>
      <div class="col-md-6">
        <h1 class="display-6 text-center mb-4">{{ __('contact.h1') }}</h1>
        <form action="{{ route('contact') }}" method="POST" class="row justify-content-center">
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="firstName" class="form-label">{{ __('contact.First Name') }}</label>
              <input type="text" class="form-control" id="firstName" name="firstName" required>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="lastName" class="form-label">{{ __('contact.Last Name') }}</label>
              <input type="text" class="form-control" id="lastName" name="lastName" required>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="email" class="form-label">{{ __('contact.Email Address') }}</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <div class="form-group">
              <label for="website" class="form-label">{{ __('contact.Website Name') }}</label>
              <input type="text" class="form-control" id="website" name="website" required>
            </div>
          </div>
          <div class="col-12 mb-3">
            <div class="form-group">
              <label for="message" class="form-label">{{ __('contact.Write your message') }}</label>
              <textarea class="form-control" id="message" name="message" rows="8" required placeholder="{{ __('contact.Your message here') }}"></textarea>
            </div>
          </div>
          <button type="submit" class="get">{{ __('contact.Submit') }}</button>
        </form>
      </div>
      <div class="col-12 mt-4">
        <h3>{{ __('contact.Our Location') }}</h3>
        <div class="embed-responsive embed-responsive-16by9">
            <!-- Map div -->
        </div>
        <div class="mt-3">
            <p><strong>{{ __('contact.Call Us') }}:</strong> +1 234 567 890</p>
            <p><strong>{{ __('contact.email us') }}:</strong> info@example.com</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
