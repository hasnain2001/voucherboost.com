@extends('layouts.welcome')
@section('title')
    {!! $category->title !!}
@endsection
@section('description')
    {!! $category->meta_description !!}
@endsection
@section('keywords')
    {!! $category->meta_keyword !!}
@endsection
@section('main-content')


<div class="container mt-4">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb bg-light p-2 rounded">
            <li class="breadcrumb-item">
                <a href="/" class="text-decoration-none text-primary fw-semibold">Home</a>
            </li>
            <li class="breadcrumb-item active fw-bold" aria-current="page">{{ $category->title }}</li>
        </ol>
    </nav>

    <div class="category-header text-center">
        @if ($category->category_image)
            <div class="overlay">
                <h1 class="text-uppercase">{{ $category->title }}</h1>
            </div>
        @else
            <div class="fallback-image d-flex flex-column align-items-center justify-content-center">
                <i class="fas fa-image fa-3x text-muted"></i>
                <p class="text-muted">No image available</p>
            </div>
        @endif
    </div>

    <p class="h5 mt-4">Total Stores: <span class="fw-bold">{{ $stores->count() }}</span></p>

<section>

    <div class="row card-list g-4 mt-3">
        @forelse ($stores as $store)
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                {{-- @php
                    $language = $store->language ? $store->language->code : 'en';
                    $storeSlug = Str::slug($store->slug);
                    $storeurl = $store->slug
                        ? ($language === 'en'
                            ? route('store_details', ['slug' => $storeSlug])
                            : route('store_details.withLang', ['lang' => $language, 'slug' => $storeSlug]))
                        : '#';
                @endphp --}}
                @php
                $storeurl = $store->slug
                  ? route('store.detail', ['slug' => Str::slug($store->slug)])
                  : '#';
                @endphp
                <a href="{{ $storeurl }}" class="text-decoration-none">
                    <div class="card shadow-sm text-center p-2">
                        <img src="{{ $store->store_image ? asset('uploads/stores/' . $store->store_image) : asset('front/assets/images/no-image-found.jpg') }}"
                             loading="lazy"
                             alt="{{ $store->name }}">
                        <h5 class="card-title">{{ $store->name ?: "Title not found" }}</h5>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center" role="alert">
                    No stores found in this category!
                    Explore new
                    <a href="{{ route('stores') }}" class=" get text-decoration-none fw-bold"> stores</a>
                </div>
            </div>
        @endforelse
    </div>
    {{ $stores->links('vendor.pagination.custom') }}
</section>
    <section>
        <div class="row card-list g-4 mt-3">
            <div class="col-md-8">
                <section class="blog">
                  <h1>Shopping Hacks & Savings Tips & Tricks</h1>
                  <div class="row">
                    @foreach ($blogs as $blog)
                    @php
                    $blogurl = $blog->slug
                        ? route('blog-details', ['slug' => Str::slug($blog->slug)])
                        : '#';
                    @endphp
                    <div class="col-md-6 mb-4">
                      <div class="card shadow-sm h-100 d-flex flex-column">
                        <a href="{{ $blogurl }}">
                        <img src="{{ asset($blog->category_image) }}" class="card-img-top" alt="Blog Post Image">
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
        </div>
    </section>

</div>
@endsection
@push('styles')
<style>
    /* Category Header Styling */
    .category-header {
        background-size: contain;
        background-position: center;
        height: 250px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        background-image: url('{{ asset('uploads/categories/' . $category->category_image) }}');
        border-radius: 10px;
        overflow: hidden;
    }

    .category-header .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3));
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .category-header h1 {
        font-size: 2.5rem;
        color: #fff;
        text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
    }

    /* Store Cards Styling */
    .card-list .card {
        border: none;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 10px;
    }

    .card-list .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    .card img {
        width: 100%;
        height: 120px;
        object-fit: contain;
        padding: 10px;
        background: #fff;
        border-radius: 10px;
    }

    .card-title {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        text-align: center;
        margin-top: 10px;
    }
</style>
@endpush
