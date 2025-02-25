@extends('welcome')
@section('title')
    Coupon Codes
@endsection
@section('description')
    Find the latest coupon codes and deals for your favorite stores. Save money on your online shopping with our exclusive discount codes.
@endsection
@section('keywords')
    coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping
@endsection
@section('main-content')

<style>
    .coupon-authentication {
        font-size: 2.15rem;
        font-weight: 600;
    }

    .coupon-name {
        font-size: 1.5rem;
        color: rgb(0, 0, 0);
    }

    .ending-date {
        font-size: 0.875rem;
    }
    /* Responsive styles */
    @media (max-width: 768px) {
        .coupon-authentication {
            font-size: 20px;
        }
        .coupon-name {
            font-size: 1rem;
        }
        .ending-date {
            font-size: 0.75rem;
        }
        .card {
            flex-direction: column;
        }
        .col-md-2 img {
            width: 80px;
            height: auto;
        }
        .col-md-3 {
            text-align: center;
            margin-top: 10px;
        }
        .code, .deal {
            display: block;
            width: 100%;
            text-align: center;
            padding: 12px;
            font-size: 14px;
        }
    }
    .bg-purple {
        background-color: #6f42c1;
    }
    .coupon-description {
        font-size: 1.25rem;
    }
    .search-container {
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .search-input {
        width: 80%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1.25rem;
    }
    .search-button {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1.25rem;
        background-color: #007bff;
        color: white;
    }
    .search-button:hover {
        background-color: #0056b3;
    }
    .heading {
        font-size: 2.5rem;
        font-weight: 600;
    }
    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
    }
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .card:hover {
        box-shadow: 0 0 10px rgba(0, 0  , 0, 0.1);
    }
    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
    }
</style>

<main class="container-fluid text-capitalize">

    <div class="text-center text-dark bg-primary py-4">
        <h1>20 off offers</h1>
        <hr>
    </div>



    <div class="row">
        <div class="col-md-3">
            <h4 class="text-center">Popular Stores</h4>
            @foreach ($populorstores as $store )
            @php
            $storeurl = $store->slug
              ? route('store_details', ['slug' => Str::slug($store->slug)])
              : '#';
            @endphp
            <div class="card mb-3">
                <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="card-img-top" alt="{{ $store->name }} Image">
                <div class="card-body text-center">
                    <a href="{{ $storeurl }}" class="text-dark text-decoration-none stretched-link">
                        <span class="card-title">{{ $store->slug ?: $store->name }}</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-9">
            <h4 class="text-center">Coupons</h4>
            @foreach ($coupons as $coupon)
            @php
            $store = App\Models\Stores::where('slug', $coupon->store)->first();
            @endphp

            <div class="card p-3 mb-3 shadow-sm">
                <div class="row g-3 align-items-center flex-md-row flex-column">
                    <div class="col-md-2 col-4 text-center">
                        @if ($store && $store->store_image)
                        <a href="{{ route('store_details', ['slug' => Str::slug($coupon->store)]) }}">
                            <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class=" img-fluid rounded" alt="{{ $store->name }} Logo" style="object-fit: fill">
                        </a>
                        @else
                        <span class="text-muted">{{$coupon->store}} no store found </span>
                        @endif
                    </div>

                    <div class="col-md-7 col-8">

                        <span class="coupon-name">{{ $coupon->name }}</span>
                        <p class="coupon-description">{{ $coupon->description }}</p>
                        <span class="coupon-authentication">{{ $coupon->authentication }}</span>
                        <a href="{{ route('store_details', ['slug' => Str::slug($coupon->store)]) }}" class="text-decoration-none">See All Offers</a>
                        <p class="ending-date text-muted">Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') }}</p>
                        <p class="text-success">Used: {{ $coupon->clicks }}</p>
                    </div>

                    <div class="col-md-3 text-center">
                        @if ($coupon->code)
                            <a href="{{ $coupon->destination_url }}" target="_blank" class=" reveal-code w-100" id="getCode{{ $coupon->id }}"
                                onclick="handleRevealCode('{{ $coupon->id }}', '{{ $coupon->code }}')">Reveal Code</a>
                        @else
                           <a href="{{ $coupon->destination_url }}" target="_blank" class=" get w-100" onclick="updateClickCount('{{ $coupon->id }}')">View Deal</a>
                        @endif
                        <br>
                        <br>
                        <a href="{{ route('store_details', ['slug' => Str::slug($coupon->store)]) }}" class="btn btn-dark w-100 text-decoration-none">See All Offers</a>

                        <!-- Coupon Code Modal -->
                        <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4 shadow">
                                    <!-- Modal Header -->
                                    <div class="modal-header position-relative bg-light border-0">
                                        <span class="badge bg-danger text-uppercase position-absolute top-0 start-50 translate-middle mt-2 px-4 py-1">
                                            Limited Time Offer
                                        </span>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <!-- Modal Body -->
                                    <div class="modal-body text-center py-5">
                                        <!-- Logo -->
                                        @if ($store && $store->store_image)
                                        <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="Brand Logo" class="mb-4 rounded-circle shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
                                        @else
                                        <span class="text-muted">No Logo</span>
                                        @endif
                                        <!-- Title -->
                                        <h5 class="fw-bold text-purple">{{ $coupon->name }}</h5>
                                        <!-- Coupon Code Section -->
                                        <div class="d-flex flex-column align-items-center mt-4 mb-4">
                                            <!-- Coupon Code -->
                                            <div class="alert alert-purple d-inline-block px-4 py-3 text-center shadow-sm">
                                                <strong>Coupon Code:</strong>
                                                <strong id="couponCode" class="fs-4 text-dark">XXXX-XXXX</strong>
                                                <!-- Copy Button -->
                                                <button class="btn btn-purple mt-3 px-4 py-2 fw-semibold shadow-sm" onclick="copyToClipboard()">
                                                    Copy Code
                                                </button>
                                            </div>

                                            <!-- Copy Confirmation Message -->
                                            <p id="copyMessage" class="text-success fw-bold mt-2" style="display: none;">
                                                Coupon code copied successfully! 🎉
                                            </p>
                                        </div>
                                        <!-- Description -->
                                        <p class="text-muted mb-2">
                                            Copy and paste this code at <a href="{{ $coupon->destination_url }}" class="text-decoration-none fw-semibold text-purple">
                                                {{ $coupon->store }}
                                            </a>
                                        </p>
                                    </div>
                                    <!-- Modal Footer -->
                                    <div class=" bg-purple text-white ">
                                        <p class="">CRAZIEST DEALS OF THE SEASON</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{ $coupons->links('vendor.pagination.custom') }}
</main>

@endsection
