@extends('layouts.welcome')
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
        <a href="/" class="text-decoration-none text-primary" style="font-weight: 500;">@lang('nav.home')</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">@lang('nav.privacy_policy')</li>
        </ol>
    </nav>
    <div class="container bg-light py-5">
        <div class="text-center">
            <h1 class="mt-3 mb-4">@lang('privacy.heading')</h1>
        </div>

        <div class="row">
        <div class="col-md-8 mx-auto mb-4">
            <p>@lang('privacy.intro')</p>
            <p class="text-center fw-bold">@lang('privacy.last_updated')</p>
        </div>
        </div>

        <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>@lang('privacy.key_points.heading')</h2>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-user-circle text-primary fs-4"></i> @lang('privacy.key_points.info_collected.label')
                </span>
                <span class="badge bg-primary rounded-pill">@lang('privacy.key_points.info_collected.badge')</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-shield-alt text-primary fs-4"></i> @lang('privacy.key_points.sensitive_info.label')
                </span>
                <span class="badge bg-primary rounded-pill">@lang('privacy.key_points.sensitive_info.badge')</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-link text-primary fs-4"></i> @lang('privacy.key_points.third_party.label')
                </span>
                <span class="badge bg-primary rounded-pill">@lang('privacy.key_points.third_party.badge')</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-cog text-primary fs-4"></i> @lang('privacy.key_points.processing.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.processing.details')</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-user-friends text-primary fs-4"></i> @lang('privacy.key_points.sharing.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.sharing.details')</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-shield-alt text-primary fs-4"></i> @lang('privacy.key_points.security.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.security.details')</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-balance-scale text-primary fs-4"></i> @lang('privacy.key_points.rights.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.rights.details')</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-sign-out-alt text-primary fs-4"></i> @lang('privacy.key_points.opt_out.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.opt_out.details')</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-user-edit text-primary fs-4"></i> @lang('privacy.key_points.account.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.account.details')</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-cookie-bite text-primary fs-4"></i> @lang('privacy.key_points.cookies.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.cookies.details')</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-ban text-primary fs-4"></i> @lang('privacy.key_points.dnt.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.dnt.details')</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-map-marker-alt text-primary fs-4"></i> @lang('privacy.key_points.california.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.california.details')</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-sync-alt text-primary fs-4"></i> @lang('privacy.key_points.updates.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.updates.details')</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-envelope text-primary fs-4"></i> @lang('privacy.key_points.contact.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.contact.details', ['email' => 'info@voucherboost.com'])</p>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <span class="me-3">
                    <i class="fas fa-file-alt text-primary fs-4"></i> @lang('privacy.key_points.request.label')
                </span>
                <p class="ms-auto mb-0">@lang('privacy.key_points.request.details')</p>
                </li>
            </ul>
        </div>
        </div>
    </div>
</div>
@endsection
