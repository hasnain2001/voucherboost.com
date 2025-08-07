     @extends('layouts.welcome')
    @section('title')
    {{ $store->title }}
    @endsection
    @section('description')
    {{ $store->meta_description }}
    @endsection
    @section('keywords')
    {{ $store->meta_keyword }}
    @endsection
    @push('styles')
     <link rel="stylesheet" href="{{ asset('cssfiles/store-detail.css') }}">
    @endpush
    @section('main-content')
    <main class="main container-fluid text-capitalize">
    @php
    $codeCount = 0;
    $dealCount = 0;
    foreach ($coupons as $coupon) {
    if ($coupon->code) {
    $codeCount++;
    } else {
    $dealCount++;
    }
    }
    $totalCount = $codeCount + $dealCount;
    @endphp

    <section aria-label="breadcrumb" class=" ">
        <ol class="breadcrumb d-flex flex-wrap">
            <li class="breadcrumb-item">
                <a href="{{{ url(app()->getLocale() . '/') }}}" class="text-purple text-decoration-none">@lang('nav.home')</a>
            </li>
            <li class="breadcrumb-item">
            @if($store->categories && $store->categories->title)
                <a class="text-decoration-none text-purple" href="{{ route('related_category', ['slug' => Str::slug($store->categories->title)]) }}">
                    {{ $store->categories->title }}
                </a>
            @elseif(!empty($store->category))
                <a href="{{ route('related_category', ['slug' => Str::slug($store->category)]) }}" class="text-decoration-none text-purple">
                    {{ $store->category }}
                </a>
            @else
                <span>No Category</span>
            @endif

            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('stores',['lang' => app()->getLocale()]) }}" class="text-purple text-decoration-none">@lang('nav.stores')</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $store->slug }}
            </li>
        </ol>
    </section>
    <div class="py-2">
    <div class="text-center mb-4">
    <h1 class="display-7 fw-bold text-dark">{{ $store->name }} </h1>

    <p class="text-muted">@lang('message.Save more with the best deals and discounts!')</p>
    </div>
    <div class="row">
    <div class="col-lg-9">
    <div class="row g-4">
        @if($coupons->isEmpty())
        <div class="col-12 text-center mt-5">
            <div class="alert alert-warning shadow-lg p-4 rounded-lg">
                <h4 class="fw-bold text-dark mb-3">@lang('message.Oops! No Coupons Available')</h4>
                <p class="text-muted">@lang('message.Dont worry, you can still explore amazing deals from our partnered brands.')</p>
                <a href="{{ route('stores') }}" class=" text-nowrap btn-purple mt-3 px-4 py-2 fw-semibold">
                   @lang('message.Explore Brands')<i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

    @else
    @foreach ($coupons as $coupon)
        <div class="col-md-4">
            <div class="card-coupon h-100 shadow-lg p-4 rounded-lg d-flex flex-column">
                <div class="d-flex flex-column flex-md-column">
                    <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="coupon-image" alt="{{ $store->name }}">
                    <div class="d-flex flex-column flex-md-column justify-content-between w-100">
                        @if ($coupon->authentication && $coupon->authentication !== 'No Auth')
                        <span class="authentication">{{ $coupon->authentication }}</span>
                        @else
                    @endif

                        <hr>
                        <!-- Set a fixed height for the text container to prevent pushing buttons down -->
                        <div class="text-container flex-grow-1">
                            <span class="coupon-name">{{ $coupon->name }}</span>
                            <hr>
                            {{-- <p class="coupon-description">{{ $coupon->description }}</p>
                            <hr> --}}
                        </div>
                        <span class="ending-date" style="color: {{ strtotime($coupon->ending_date) < strtotime(now()) ? '#951d1d' :'#909090' }};">
                            Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') }}
                        </span>
                        <hr>
                        <span class="used" id="usedCount{{ $coupon->id }}">Used By: {{ $coupon->clicks }}</span>
                    </div>
                </div>
                <!-- Coupon Code Section - Buttons stay in one line -->
                <div class="mt-auto d-flex justify-content-center align-items-center gap-2 w-100">
                    @if ($coupon->code)

                        <a href="{{ $store->destination_url }}" target="_blank" class="reveal-code" id="getCode{{ $coupon->id }}" onclick="handleRevealCode({{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('uploads/stores/' . $store->store_image) }}', '{{ $coupon->destination_url }}', '{{ $coupon->store }}')">
                            <span class="coupon-text">@lang('welcome.Activate Coupon')</span>
                            <span class="coupon-code" id="couponCode{{ $coupon->id }}" style="display: none;">{{ $coupon->code }}</span>
                        </a>

                    @else
                        <a href="{{ $store->destination_url }}" target="_blank" class="get" onclick="updateClickCount('{{ $coupon->id }}')">
                        @lang('welcome.View Deal')
                        </a>
                    @endif
                </div>
            </div>

        </div>
    @endforeach
    @endif
    <div class="container p-4">

        @if ($store->content)
        <div class="content mt-4">{!! $store->content !!}</div>
    @else
            @foreach ($relatedblogs as $blog )
            <h3 class="blog-title  mb-4">{{ $blog->title }}</h3>
            <img class="img-fluid" src="{{ asset($blog->image) }}" alt="Blog Image" height="250" width="300">
                    <p class="card-text">{!! $blog->content !!}</p>

        @endforeach
    @endif
    </div>
    </div>
    </div>
    <div class="col-lg-3">
    <div class=" card-coupon p-4  shadow-lg rounded-lg bg-light">
    <div class="">
    <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="store-image shadow"  alt="{{ $store->name }}">
    <h4 class="store-name fw-bold text-dark">{{ $store->name }}</h4>
    <p class="text-warning fs-5">⭐⭐⭐⭐☆</p>
    </div>
        <a href="{{$store->destination_url}}" target="blank" class="btn-purple mb-3"> @lang('message.Visit Store') </a>
        <p class="text-muted">{{ $store->description }}</p>
        <hr>
        <h3 class="h-3">@lang('nav.about') {{ $store->name }}</h3>
        <div class="card shadow-sm p-2  bg-white rounded">
            <div class="card-body">
                <p class="card-text">{{ $store->about }} </p>
            </div>
        </div>
          <hr>
    <div class="store-info-card card shadow-sm p- mb-2 bg-white rounded">
    <h4 class=" filter-h mb-4">@lang('message.Filter By Voucher Codes')</h4>
    <div class="btn-group" role="group" aria-label="Sort Coupons">
    <a href="{{ url()->current() }}" class=" btn-purple">@lang('message.All')</a>
    <a href="{{ url()->current() }}?sort=codes" class=" btn-purple">@lang('message.Codes')</a>
    <a href="{{ url()->current() }}?sort=deals" class=" btn-purple">@lang('message.Deals')</a>
    </div>
    </div>
    <hr>
    <!-- Store Summary -->
    <div class="p-3 border rounded bg-white shadow-sm">
    <h5 class="fw-bold mb-3">@lang('message.Store Summary')</h5>
    <p class="mb-2">
    <i class="fas fa-tag me-2 text-dark"></i>@lang('message.Total') @lang('message.Codes')
    <span class="badge bg-dark">{{ $codeCount }}</span>
    </p>
    <p class="mb-2">
    <i class="fas fa-shopping-cart me-2 text-dark"></i>@lang('message.Total') @lang('message.Deals')
    <span class="badge bg-dark">{{ $dealCount }}</span>
    </p>
    <p class="mb-0">
    <i class="fas fa-list me-2 text-dark"></i>@lang('message.Total')
    <span class="badge bg-dark">{{ $totalCount }}</span>
    </p>
    </div>
    <hr>

    <h6 class="fw-bold mt-3 text-dark">@lang('message.Related Stores')</h6>
    <ul class=" d-flex flex-column gap-2">
    @foreach ($relatedStores as $relatedStore)
    <li><a href="{{ route('store.detail', ['slug' => Str::slug($relatedStore->slug)]) }}" class="text-decoration-none text-dark fw-bold">{{ $relatedStore->name }}</a></li>
    @endforeach
    </ul>
    </div>
    </div>
    </div>
    </div>
    </main>

    @endsection
