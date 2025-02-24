@extends('welcome')
@section('title')
    Stores
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
                <a href="/" class="text-decoration-none text-primary" style="font-weight: 500;">Home</a>
            </li>
<li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">Search</li>
        </ol>
    </nav>
    <!-- Display Stores -->
    <h3 class="pointer">Search Results</h3>
    <div class="main_content">
        <div class="container">
            <div class="row mt-3">
                @if ($stores->isEmpty())
                    <div class="col-12">
                        <h1>No stores found.</h1>
                    </div>
                @else
                    @foreach ($stores as $store)
                        <div class="col-6 col-lg-3 mb-4 d-flex">
                            <div class="card shadow flex-fill">
            {{-- @php
            $language = $store->language ? $store->language->code : 'en'; // Default to 'en' if language is null
            $storeSlug = Str::slug($store->slug);

            // Conditionally generate the URL based on the language
            $storeurl = $store->slug
            ? ($language === 'en'
            ? route('store_details', ['slug' => $storeSlug])  // English route without 'lang'
            : route('store_details.withLang', ['lang' => $language, 'slug' => $storeSlug]))  // Other languages
            : '#';
            @endphp --}}
                @php
                $storeurl = $store->slug
                  ? route('store_details', ['slug' => Str::slug($store->slug)])
                  : '#';
                @endphp
                                <a href="{{$storeurl }}" class="text-decoration-none text-dark text-center">
                                    <div class="card-body d-flex flex-column">
                                        @if ($store->store_image)
                                            <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="card-img-top" alt="">
                                        @else
                                            <img src="{{ asset('front/assets/images/no-image-found.jpg') }}" class="card-img-top" alt="">
                                        @endif
                                        <h5 class="card-title mt-3 mx-2">{{ $store->name ?? 'Title not found' }}</h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

        <div class="row mt-3 justify-content-end">
            <div class="col-12">
                {{ $stores->links('vendor.pagination.custom') }}
            </div>
        </div>

</div>

@endsection
