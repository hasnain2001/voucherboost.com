@extends('layouts.welcome')
@section('title')
    Coupon Codes - Find the latest coupon codes and deals for your favorite stores
@endsection
@section('description')
    Find the latest coupon codes and deals for your favorite stores. Save money on your online shopping with our exclusive discount codes.
@endsection
@section('keywords')
    coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping
@endsection
@push('styles')
<style>
     .coupon-authentication {
        font-size: 20px;
        font-weight: 400;
    }

    .coupon-name {
        font-size: 25px;
        color: rgb(62, 28, 74);
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
        color: #fff;
    }

    .text-purple {
        color: #6f42c1;
    }

    .alert-purple {
        background-color: #f3e6ff;
        border-color: #d6b3ff;
        border-radius: 10px;
    }

    .btn-purple {
        background-color: #6f42c1;
        border: none;
        color: #fff;
        border-radius: 25px;
        transition: all 0.3s ease-in-out;
    }

    .btn-purple:hover {
        background-color: #563d7c;
        transform: scale(1.05);
    }

    .modal-content {
        border-radius: 25px;
        overflow: hidden;
    }

    .modal-header {
        border-top: none;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
    }

    .modal-footer {
        border-top: none;
        border-bottom-left-radius: 25px;
        border-bottom-right-radius: 25px;
    }

    .shadow-sm {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .rounded-circle {
        border: 2px solid #f3e6ff;
    }
/* General container styling */
.search-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-left: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Styling the heading */
.search-container .heading {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    margin: 0;
    white-space: nowrap;
}

/* Search input field styling */
.search-input {
    padding: 10px 15px;
    font-size: 1rem;
    border: 2px solid #ccc;
    border-radius: 5px 0 0 5px;
    outline: none;
    width: 600px;
    transition: border-color 0.3s ease;
    border-color: #007bff;
}

/* Hover effect for the input field */
.search-input:focus,
.search-input:hover {
    border-color: #16181b;
}

/* Search button styling */
.search-button {
    padding: 5px 15px;
    font-size: 1rem;
    border: none;
    border-radius: 0 5px 5px 0;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Hover effect for the button */
.search-button:hover {
    background-color: #121213;
}
</style>
@endpush
@section('main-content')

<main class="container-fluid">

    <div class="text-center text-white bg-purple py-4">
        <h1>@lang('message.Exclusive Coupon Codes')</h1>
        <hr>
    </div>

@foreach ($coupons as $coupon)
    @php
        // Dynamic logic to prefer store_id, fallback to slug
        $store = $coupon->store_id
            ? App\Models\Stores::find($coupon->store_id)
            : App\Models\Stores::where('slug', $coupon->store)->first();

        $storeImage = $store && $store->store_image ? asset('uploads/stores/' . $store->store_image) : null;
        $destinationUrl = $store && $store->destination_url ? $store->destination_url : $coupon->destination_url;
        $storeSlug = $store ? Str::slug($store->slug) : Str::slug($coupon->store);
        $storeName = $store ? $store->name : $coupon->store;
    @endphp

    <div class="card p-3 mb-3 shadow-sm">
        <div class="row g-3 align-items-center flex-md-row flex-column">
            <div class="col-md-2 col-4 text-center">
                @if ($storeImage)
                    <a href="{{ route('store.detail', ['slug' => $storeSlug]) }}">
                        <img src="{{ $storeImage }}" class="img-fluid rounded" alt="{{ $storeName }} Logo">
                    </a>
                @else
                    <span class="text-muted">{{ $storeName }} @lang('message.No stores found. Please check back later.') </span>
                @endif
            </div>

            <div class="col-md-7 col-8">
                @if ($coupon->authentication && $coupon->authentication !== 'No Auth')
                    <h4 class="coupon-authentication">{{ $coupon->authentication }}</h4>
                @else
                    <span class="coupon-authentication"></span>
                @endif

                <span class="coupon-name">{{ $coupon->name }}</span>
                <p class="coupon-description">{{ $coupon->description }}</p>
                <a href="{{ route('store.detail', ['slug' => $storeSlug]) }}" class="text-decoration-none">@lang('message.see all Offers')</a>
                <p class="ending-date text-muted">Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') }}</p>
                <p class="text-success">Used: {{ $coupon->clicks }}</p>
            </div>

            <div class="col-md-3 text-center">
                @if ($coupon->code)
                    <a href="{{ $destinationUrl }}" target="_blank" class="reveal-code"
                        id="getCode{{ $coupon->id }}"
                        onclick="handleRevealCode(
                            {{ $coupon->id }},
                            '{{ $coupon->code }}',
                            '{{ $coupon->name }}',
                            '{{ $storeImage }}',
                            '{{ $destinationUrl }}',
                            '{{ $storeName }}'
                        )">
                        <span class="coupon-text">@lang('welcome.Activate Coupon')</span>
                        <span class="coupon-code" id="couponCode{{ $coupon->id }}" style="display: none;">{{ $coupon->code }}</span>
                    </a>
                @else
                    <a href="{{ $destinationUrl }}" target="_blank" class="get" onclick="updateClickCount('{{ $coupon->id }}')">
                       @lang('welcome.View Deal')
                    </a>
                @endif
                <br><br>
                <a href="{{ route('store.detail', ['slug' => $storeSlug]) }}" class="get">@lang('message.see all Offers')</a>
            </div>
        </div>
    </div>
@endforeach


    {{ $coupons->links('vendor.pagination.custom') }}
</main>

@endsection
