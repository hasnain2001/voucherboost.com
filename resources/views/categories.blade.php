@extends('welcome')

@section('title')
    Categories | Explore Top Categories and Save Big!
@endsection

@section('description')
    Find the latest coupon codes and deals for your favorite categories. Save money on your online shopping with our exclusive discount codes.
@endsection

@section('keywords')
    coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping
@endsection

@section('main-content')
<div class="main_content">
    <div class="container">
        <!-- Title -->
        <h1 class="text-center display-4 mt-4 mb-5" style="font-weight: 600; color: #333; font-size: 2.5rem;">
            Explore Our Categories
        </h1>

        <!-- Categories Grid -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($categories as $category)
                <div class="col">
                    <a href="{{ $category->slug ? route('related_category', ['slug' => Str::slug($category->slug)]) : '#' }}"
                       class="category-card text-decoration-none text-dark d-block rounded-3 overflow-hidden shadow-sm hover-scale">
                        <div class="card-body d-flex align-items-center p-4 bg-light">
                            <!-- Category Image -->
                            <div class="flex-shrink-0 me-3">
                                @if ($category->category_image)
                                    <img src="{{ asset('uploads/categories/' . $category->category_image) }}"
                                         class="rounded-circle img-fluid"
                                         alt="{{ $category->title }} Image"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-purple text-white rounded-circle"
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-tag fa-lg"></i>
                                    </div>
                                @endif
                            </div>
                            <!-- Category Title -->
                            <div class="flex-grow-1">
                                <h5 class="fw-bold mb-0">{{ $category->title }}</h5>
                                <small class="text-muted">Explore Deals</small>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<br>
@endsection
