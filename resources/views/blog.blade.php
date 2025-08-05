@extends('layouts.welcome')
@section('title')
    Blog Posts | Shopping Hacks & Savings Tips & Tricks
@endsection
@section('description')
    Find the latest blog posts, shopping hacks, savings tips, and tricks. Stay updated with the latest trends and news in the world of online shopping.
@endsection
@section('keywords')
    blog, blog posts, shopping hacks, savings tips, tricks, trends, news, online shopping
@endsection
@push('styles')
    <style>
        .blog .btn {
            background-color:#701e7d; /* Purple */
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 25px; /* Rounded corners */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            transition: all 0.3s ease-in-out; /* Smooth transition */
            cursor: pointer;
        }

        .blog .btn:hover {
            background-color: #5a189a; /* Darker Purple */
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
            transform: translateY(-2px); /* Slight lift effect */
        }

        .blog .btn:focus {
            outline: none; /* Remove default focus outline */
            box-shadow: 0 0 0 4px rgba(111, 66, 193, 0.5); /* Focus ring with purple tint */
        }

        .blog .btn:active {
            background-color: #4b2a89; /* Even darker purple */
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2); /* Reduced shadow */
            transform: translateY(1px); /* Pressed effect */
        }
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: fill;
        }
    </style>
@endpush
@section('main-content')
<nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
      <ol class="breadcrumb mb-0">

      <li class="breadcrumb-item">
      <a href="{{ url(app()->getLocale() . '/') }}" class="text-decoration-none text-primary" style="font-weight: 500;">@lang('nav.home')</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">Blog</li>
      </ol>
</nav>

<div class="container">
    <div class="row">
   <!-- Blogs Section (Left Side) -->
<div class="col-md-8">
  <section class="blog">
    <h1>Shopping Hacks & Savings Tips & Tricks</h1>
    <div class="row">
      @foreach ($blogs as $blog)
      @php
      $blogurl = $blog->slug
          ? route('blog.detail', ['slug' => Str::slug($blog->slug)])
          : '#';
      @endphp
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm h-100 d-flex flex-column">
          <a href="{{ $blogurl }}">
          <img src="{{ asset($blog->image) }}" class="card-img-top" alt="Blog Post Image">
        </a>
          <div class="card-body d-flex flex-column">
            <div class="blog-text mb-3">
              <h5 class="blog-title">{{ $blog->title }}</h5>
            </div>
            <div class="mt-auto">
              <a href="{{ $blogurl }}" class="btn btn-primary rounded-pill w-100">Read More</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    {{-- {{ $blogs->links('vendor.pagination.custom') }} --}}
  </section>
</div>


      <!-- Stores Section (Right Side) -->
      <div class="col-md-4">
        <aside class="sidebar p-3 bg-light">
          <!-- Sidebar Title -->
          <h2 class="bold text-dark mb-3">Top Stores</h2>
          <!-- Store Listings -->
          <div class="row gx-2 gy-2">
            @foreach ($chunks as $store)
            <div class="col-6 col-md-12 mb-3">
              @php
              $storeurl = $store->slug
                  ? route('store.detail', ['slug' => Str::slug($store->slug)])
                  : '#';
              @endphp
              <a href="{{ $storeurl }}" class="text-dark text-decoration-none d-flex align-items-center">
                <!-- Store Image -->
                <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="{{ $store->name }}" class="me-2 shadow" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                <!-- Store Name -->
                <p class="text-capitalize mb-0">{{ $store->name }}</p>
              </a>
            </div>
            @endforeach
          </div>
        </aside>
      </div>


    </div>
  </div>
</div>
@endsection



