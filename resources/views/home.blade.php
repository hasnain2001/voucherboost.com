    @extends('welcome')
    @section('title')
    voucher Boost - Best Deals and Discounts on voucher Boost
    @endsection
    @section('description')
    Find the best deals, discounts, and coupons on voucher Boost. Save money on your favorite products from top brands.
    @endsection
    @section('keywords')
    deals, discounts, coupons, savings, affiliate marketing, promo codes, cashback, online shopping, special offers, vouchers, best prices, holiday sales, seasonal discounts, gift cards, price comparison, money-saving tips
    @endsection
    <style>

</style>
@section('main-content')
<main class=" text-capitalize">
    <h1>Couponiversal Has Some Special Offers For You</h1>
<div id="storeCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($populorstores->chunk(6) as $index => $chunk)
            <button type="button" data-bs-target="#storeCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($populorstores->chunk(6) as $index => $chunk)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="row">
                    @foreach ($chunk as $store)
                        <div class="col-md-2">
                            <div class="card mb-3 shadow">
                                <a href="{{ route('store_details', ['slug' => Str::slug($store->slug)]) }}">
                                    <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="img-fluid shadow" alt="{{ $store->name }}">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $store->name }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#storeCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#storeCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


</main>

@endsection
