@extends('layouts.welcome')
@section('title', 'Coupon Codes')
@section('description', 'Find the latest coupon codes and deals for your favorite stores.')
@section('keywords', 'coupon codes, discount codes, promo codes, deals, offers')
@push('styles')
<style>
    /* General Styling */
    .store-card, .coupon-card {
        border: none;
        border-radius: 12px;
        padding: 15px;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }
    .store-card:hover, .coupon-card:hover {
        transform: scale(1.02);
    }
    .store-card img {
        max-width: 100px;
        margin: auto;
    }
    .coupon-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        padding: 15px;
        border-left: 5px solid #ff6f61;
    }
    .coupon-card img {
        width: 80px;
        height: auto;
        border-radius: 8px;
    }
    .coupon-details {
        flex-grow: 1;
        padding: 10px;
    }
    .coupon-details span {
        font-size: 28px;
        margin: 0;
    }
    .coupon-details p {
        font-size: 16px;
        margin: 0;
    }
    .coupon-actions {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }
        .bg-purple {
        background-color: #6f42c1;
        color: #fff;
    }

    /* .coupon-actions a {
        text-decoration: none;
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.3s ease-in-out;
    } */


    /* Responsive Styles */
    @media (max-width: 768px) {
        .stores-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .coupon-card {
            flex-direction: row;
            align-items: center;
            padding: 12px;
        }
        .coupon-card img {
            width: 60px;
        }
        .coupon-details {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
        .coupon-details span {
            font-size: 14px;
        }
        .coupon-details p {
            font-size: 12px;
        }
        .coupon-actions {
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
    }
</style>
@endpush
@section('main-content')
<main class=" container-fluid">
    <div class="text-center text-white bg-purple py-4">
        <h1>@lang('nav.FREE DELIVERY')</h1>
        <hr>
    </div>

    <div class="row mt-4">
        <!-- Left Side: Stores -->
        <div class="col-md-3">
            <h4 class="text-center">@lang('nav.Popular Stores')</h4>
            <div class="stores-grid row row-cols-2 g-3">
            @foreach ($populorstores as $store)
            <div class="store-card text-center p-3 col">
            <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}" class="text-decoration-none text-dark">
                <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="{{ $store->name }}">
                <p class="mt-2">{{ $store->name }}</p>
            </a>
            </div>
            @endforeach
            </div>
        </div>

        <!-- Right Side: Coupons -->
        <div class="col-md-9">
            <h4 class="text-center">@lang('nav.Coupons')</h4>
            @foreach ($coupons as $coupon)
                @php $store = App\Models\Stores::where('slug', $coupon->store)->first(); @endphp
                <div class="coupon-card mb-3">
                    <div class="text-center">
                        <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store)]) }}">
                        @if ($store && $store->store_image)
                            <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="{{ $store->name }}">
                        @endif
                        </a>
                    </div>
                    <div class="coupon-details">
                        <span>{{ $coupon->name }}</span>
                        <p class="description">{{ $coupon->description }}</p>
                        <p class="text-muted">Ends: {{ $coupon->ending_date ? \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') : 'No Expiry' }}</p>
                        <p class="text-success">✔ Verified</p>
                        <p class="text-muted">👥 {{ $coupon->clicks }} @lang('welcome.used')</p>
                    </div>
                    <div class="coupon-actions">
                        @if ($coupon->code)
                        <a href="{{ $coupon->destination_url }}" target="_blank" class="reveal-code" id="getCode{{ $coupon->id }}" onclick="handleRevealCode({{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('uploads/stores/' . $store->store_image) }}', '{{ $coupon->destination_url }}', '{{ $coupon->store }}')">
                        <span class="coupon-text">Activate Coupon</span>
                        <span class="coupon-code" id="couponCode{{ $coupon->id }}" style="display: none;">{{ $coupon->code }}</span>
                        </a>
                        @else
                        <a href="{{ $coupon->destination_url }}" target="_blank" class="get" onclick="updateClickCount('{{ $coupon->id }}')">
                        View Deal
                        </a>
                        @endif
                        <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store)]) }}" class="get">@lang('message.see all Offers')</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $coupons->links('vendor.pagination.custom') }}
    </div>
</main>

@endsection
