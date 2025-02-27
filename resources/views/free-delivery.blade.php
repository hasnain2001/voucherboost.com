@extends('welcome')
@section('title', 'Coupon Codes')
@section('description', 'Find the latest coupon codes and deals for your favorite stores.')
@section('keywords', 'coupon codes, discount codes, promo codes, deals, offers')
@section('main-content')

<style>
    .coupon-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }
    .stores-section {
        flex: 1;
        max-width: 300px;
    }
    .stores-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    .coupons-section {
        flex: 3;
    }
    .store-card, .coupon-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        background: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .store-card img {
        max-width: 100px;
        margin: auto;
    }
    .coupon-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .coupon-card img {
        width: 80px;
        height: auto;
    }
    .coupon-details {
        flex-grow: 1;
        padding: 10px;
    }
    .coupon-actions {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

</style>

<main class="container-fluid">
    <div class="text-center text-dark bg-primary py-4">
        <h1>Free Delivery Offers</h1>
        <hr>
    </div>

    <div class="coupon-container">
        <div class="stores-section">
            <h4 class="text-center">Popular Stores</h4>
            <div class="stores-grid">
                @foreach ($populorstores as $store)
                    <div class="store-card">
                        <a href="{{ route('store_details', ['slug' => Str::slug($store->slug)]) }}" class=" text-decoration-none text-dark">
                            <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="{{ $store->name }}">
                            <p class="mt-2">{{ $store->name }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="coupons-section">
            <h4 class="text-center">Coupons</h4>
            @foreach ($coupons as $coupon)
                @php $store = App\Models\Stores::where('slug', $coupon->store)->first(); @endphp
                <div class="coupon-card mb-3">
                    <div class="text-center">
                        <a href="{{ route('store_details', ['slug' => Str::slug($coupon->store)]) }}" >
                        @if ($store && $store->store_image)
                            <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="{{ $store->name }}">
                        @endif
                        </a>
                    </div>
                    <div class="coupon-details">
                        <h5>{{ $coupon->name }}</h5>
                        <p>{{ $coupon->description }}</p>
                        <p class="text-muted">Ends: {{ $coupon->ending_date ? \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') : 'No Expiry' }}</p>
                        <p class="text-success">✔ Verified</p>
                        <p class="text-muted">👥 {{ $coupon->clicks }} People Used</p>
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
                        <a href="{{ route('store_details', ['slug' => Str::slug($coupon->store)]) }}" class="get">See All Offers</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{ $coupons->links('vendor.pagination.custom') }}
</main>
@endsection
