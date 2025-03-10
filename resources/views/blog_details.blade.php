@extends('welcome')
@section('title')
    {{ $blog->title }}
@endsection
@section('description')
    {{ $blog->meta_description }}
@endsection
@section('keywords')
    {{ $blog->meta_keyword }}
@endsection
@section('main-content')
<style>
    .blog-title {
        font-size: 2rem;
        color: #5a5d61;
        font-weight: 500;
        font-family:Arial;
          }

    .content {
    margin: 0;
    padding: 10px;
    width: 100%;
    max-width: 100%;
    overflow-x: auto; /* Ensure horizontal scrolling for wide tables or images */
  }
  .content p {
    font-size: 1.1rem;
    color: #5a5d61;
    font-weight: 400;
    font-family:Arial;
  }

.content img {
    max-width: 100%;
    height: auto; /* Make images responsive */
    display: block;
    margin: 0 auto; /* Optional: Center align images */
}



.blog-section {
            padding: 50px 0;
            background-color: #f8f9fa;
            text-align: center;
        }

        .h-1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .h-1 span {
            color: #73097d;
        }

        .blog-container {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding-bottom: 10px;
            scroll-behavior: smooth;
        }

        .blog-container::-webkit-scrollbar {
            height: 8px;
        }

        .blog-container::-webkit-scrollbar-thumb {
            background-color: #ff6347;
            border-radius: 10px;
        }

        .blog-card {
            min-width: 300px;
            max-width: 300px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
        }

        .blog-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .blog-title {
            font-size: 1.2rem;
            margin-top: 10px;
            color: #333;
        }

        .blog-category {
            display: block;
            font-size: 0.9rem;
            color: #777;
            margin-top: 5px;
        }
</style>

<br>
<nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 0.25rem; padding: 10px;">
    <ol class="breadcrumb mb-0">

            <li class="breadcrumb-item">
<a href="{{ url(app()->getLocale() . '/') }}" class="text-decoration-none text-purple" style="font-weight: 500;">Home</a>
                </li>
<li class="breadcrumb-item">
<a class="text-decoration-none text-purple" href="{{ route('related_category', ['slug' => Str::slug($blog->category)]) }}">
    {{ $blog->category }}
</a>
</li>
                <li class="breadcrumb-item">
                    <a href="{{ url(app()->getLocale() . '/blog') }}" class="text-decoration-none text-purple" style="font-weight: 500;">Blog</a>
                    </li>


<li class="breadcrumb-item active" aria-current="page" style="font-weight: 600; color: #6c757d;">{{ $blog->title }}</li>
    </ol>
</nav>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8 mb-4">
            <div class="blog-post card shadow rounded-lg border border-light">
                <img class="img-fluid" src="{{ asset($blog->category_image) }}" alt="Blog Image" style="width: 100%; height: auto;">
                <div class="card-body">
 <h1 class="blog-title  mb-4">{{ $blog->title }}</h1>
                  <div class="content">
                    <p class="card-text">{!! $blog->content !!}</p>
                </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 order-md-last">
            <aside class="sidebar p-3 bg-light">
                <h2 class="bold text-dark mb-3">Related Store</h2>
                <div class="row gx-2 gy-2">
                    @foreach ($chunks as $store)
                        <div class="col-6 col-md-12 col-sm-6 col-lg-6">
                            @php

                            $storeurl = $store->slug
                            ? route('store_details', ['slug' => Str::slug($store->slug)])
                            : '#';
                            @endphp
                            <a href="{{ $storeurl }}" class="text-dark text-decoration-none d-flex flex-column p-2 align-items-center">
                                <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="{{ $store->name }}" class="mb-2 shadow" style="width: 100px; height: 100px; object-fit: cover;">
                                <p class="text-capitalize">{{ $store->name }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </aside>
        </div>
    </div>
</div>

<section class="blog-section py-5">
    <div class="container">
        <h1 class="h-1 text-center mb-4">
            Upgrade Your Wardrobe <span class="">And Enhance Your</span> Living Spaces.
        </h1>
        <div class="blog-container d-flex overflow-auto pb-3">
            @foreach ($relatedblogs as $blog)
                @php
                    $blogurl = $blog->slug
                        ? route('blog-details', ['slug' => Str::slug($blog->slug)])
                        : '#';
                @endphp
                <div class="blog-card mx-2">
                    <a href="{{ $blogurl }}" class="text-decoration-none text-dark">
                        <img src="{{ asset($blog->category_image) }}" class="blog-image rounded" alt="Blog Image">
                        <span class="blog-title mt-2">{{ $blog->title }}</h5>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
