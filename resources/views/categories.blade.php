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
          <h1 class="text-center display-4 mt-4 mb-5" style="font-weight: 400; color: #333; font-size:40px;">Explore Our Categories</h1>

          <!-- Categories Grid -->
          <div class="row row-cols-2 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach ($categories as $category)
                     <div class="col">
                          <div class="d-flex align-items-center bg-purple text-white rounded-3 p-3 position-relative shadow-sm">
                                <!-- Category Image -->
                                <div class="flex-shrink-0 me-3">
                                     @if ($category->category_image)
                                          <img src="{{ asset('uploads/categories/' . $category->category_image) }}"
                                                 class="rounded-circle border img-fluid"
                                                 alt="{{ $category->title }} Image"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                     @else
                                          <div class="d-flex align-items-center justify-content-center bg-light rounded-circle text-muted"
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-image"></i>
                                          </div>
                                     @endif
                                </div>

                                <!-- Category Title -->
                                <div class="flex-grow-1">
                                     @php
                                          $storeUrl = $category->slug
                                                ? route('related_category', ['slug' => Str::slug($category->slug)])
                                                : '#';
                                     @endphp
                                     <a href="{{ $storeUrl }}" class="text-white text-decoration-none fw-bold">
                                          {{ $category->title }}
                                     </a>
                                </div>
                          </div>
                     </div>
                @endforeach
          </div>
     </div>
</div>
<br>
@endsection
