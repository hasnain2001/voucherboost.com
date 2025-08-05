    @extends('layouts.welcome')
    @section('title', 'Voucher Boost -  Best Deals and Discounts on voucher Boost')
    @section('description',' Find the best deals, discounts, and coupons on voucher Boost. Save money on your favorite products from top brands.')
    @section('keywords','deals, discounts, coupons, savings, affiliate marketing, promo codes, cashback, online shopping, special offers, vouchers, best prices, holiday sales, seasonal discounts, gift cards, price comparison, money-saving tips')
@section('main-content')
<main class=" text-capitalize ">
    <section class="container mt-4">
        <h1 class="title">VoucherBoost Has Some Special Offers For You</h1>
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @if($sliders->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No sliders available at the moment. Please check back later!
            </div>
                @else
                      @foreach ($sliders as $slider)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <a target="_blank" href="{{ $slider->url }}">
                            @if(!empty($slider->image))
                                <img src="{{ asset('uploads/slider/' . $slider->image) }}" class="slider-image d-block w-100" alt="{{ $slider->title }}" loading="lazy">
                            @endif
                        </a>
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $slider->title }}</h5>
                                <p>{{ $slider->description }}</p>
                                @if ($slider->url)
                                    <a target="_blank" href="{{ $slider->url }}" class="btn bt-purple">View More</a>
                                    @else
                                    <a target="_blank" href="{{ route('store.detail', ['slug' => Str::slug($slider->store->slug)]) }}" class="btn bt-purple">View More</a>
                                @endif
                            </div>
                        </div>
                    @endforeach

                @endif
            </div>
            <button class="custom-carousel-btn custom-prev-btn" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                &#9665;
            </button>
            <button class="custom-carousel-btn custom-next-btn" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                &#9655;
            </button>
        </div>
    </section>
    <hr>
    <section class="store container mt-4">
        <h2>Latest Discount Codes & Promo Codes From Popular Stores</h2>
        <div id="storeCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @if($topstores->isEmpty())
             <div class="alert alert-warning text-center" role="alert">
                No stores available at the moment. Please check back later!
            </div>
                @else
                @foreach ($topstores->chunk(6) as $index => $chunk)
                    <button type="button" data-bs-target="#storeCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($topstores->chunk(6) as $index => $chunk)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            @foreach ($chunk as $store)
                                <div class="col-md-2 col-6">
                                    <div class="card-store">
                                        <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}">
                                            <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="store-image shadow" alt="{{ $store->name }}"
                                                 loading="lazy">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
            </div>
            <button class="custom-carousel-btn custom-prev-btn" type="button" data-bs-target="#storeCarousel" data-bs-slide="prev">
                &#9665;
            </button>
            <button class="custom-carousel-btn custom-next-btn" type="button" data-bs-target="#storeCarousel" data-bs-slide="next">
                &#9655;
            </button>
        </div>
    </section>
    <section class="coupon container mt-5">
        <div class="row coupon-grid g-4">
            @foreach ($topcouponcode as $coupon)
                @php
                    $store = $coupon->store_id
                        ? App\Models\Stores::find($coupon->store_id)
                        : App\Models\Stores::where('slug', $coupon->store)->first();

                    $storeImage = $store && $store->store_image ? asset('uploads/stores/' . $store->store_image) : null;
                    $destinationUrl = $store && $store->destination_url ? $store->destination_url : $coupon->destination_url;
                    $storeSlug = $store ? Str::slug($store->slug) : Str::slug($coupon->store);
                    $storeName = $store ? $store->name : $coupon->store;
                @endphp

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="coupon-card h-100 card rounded shadow-sm">
                        <div class="coupon-header text-center position-relative p-3 bg-light">
                            @if ($storeImage)
                                <a href="{{ route('store.detail', ['slug' => $storeSlug]) }}">
                                    <img src="{{ $storeImage }}" alt="{{ $storeName }} Image" class="coupon-image img-fluid rounded" loading="lazy">
                                </a>
                            @else
                                <div class="no-image-placeholder bg-light text-center py-4">
                                    <p>No image</p>
                                    <span>{{ $storeName }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="coupon-body p-3">
                            <span class="badge bg-success">✔ Verified</span>
                            <span class="d-block text-muted">{{ $storeName }}</span>
                            <h6 class="text-left">{{ $coupon->name }}</h6>
                            <span class="d-block mb-2 {{ \Carbon\Carbon::parse($coupon->ending_date)->isPast() ? 'text-danger' : 'text-muted' }}">
                                <i class="bi bi-calendar-check"></i> {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d M Y') }}
                            </span>
                            <span class="text-dark"><i class="bi bi-person"></i> {{ $coupon->clicks }} People Used</span>

                            <div class="d-grid gap-2 mt-3">
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
                                        <span class="coupon-text">Activate Coupon</span>
                                        <span class="coupon-code" id="couponCode{{ $coupon->id }}" style="display: none;">{{ $coupon->code }}</span>
                                    </a>
                                @else
                                    <a href="{{ $destinationUrl }}" target="_blank" class="get" onclick="updateClickCount('{{ $coupon->id }}')">
                                        View Deal
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class=" category container mt-4">
        <h2 class="mb-3">Popular Categories</h2>

        <div class="d-grid gap-3 grid-template">
            @if ($homecategories->isnotempty())

            @foreach ($homecategories as $category)
                <div class="position-relative category-card">
                    @if ($category->category_image)
                    @php
                    $storeUrl = $category->slug
                        ? route('related_category', ['slug' => Str::slug($category->slug)])
                        : '#';
                @endphp
                    <a href="{{ $storeUrl }}" class="text-decoration-none text-white">
                        <img src="{{ asset('uploads/categories/' . $category->category_image) }}" class=" category-image rounded category-image" alt="{{ $category->title }}
                        " loading="lazy">

                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light text-muted rounded" style="height: 200px;">
                            <i class="fas fa-image fa-3x"></i>
                            <p class="ms-2">No image available</p>
                        </div>
                    @endif

                    <div class="position-absolute top-50 start-50 translate-middle text-white text-center fw-bold category-overlay">
                        {{ $category->title }} <br>
                    </a>

                    </div>
                </div>
            @endforeach

            @else
            <div class="alert alert-warning text-center" role="alert">
                No category available at the moment. Please check back later!
            </div>

            @endif
        </div>
    </section>
    <section class="coupon container mt-5">
        <h3 class="heading text-left mb-4">Featured Offers</h3>

        @if ($Couponsdeals->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No coupons available at the moment. Please check back later!
            </div>
        @else
            <div class="row coupon-grid g-4">
                @foreach ($Couponsdeals as $coupon)
                    @php
                        // Use store_id if available, otherwise fallback to slug
                        $store = $coupon->store_id
                            ? App\Models\Stores::find($coupon->store_id)
                            : App\Models\Stores::where('slug', $coupon->store)->first();

                        $storeImage = $store && $store->store_image ? asset('uploads/stores/' . $store->store_image) : null;
                        $destinationUrl = $store && $store->destination_url ? $store->destination_url : $coupon->destination_url;
                        $storeSlug = $store ? Str::slug($store->slug) : Str::slug($coupon->store);
                        $storeName = $store ? $store->name : $coupon->store;
                    @endphp

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="coupon-card h-100 card rounded shadow-sm">
                            <div class="coupon-header text-center position-relative p-3 bg-light">
                                @if ($storeImage)
                                    <a href="{{ route('store.detail', ['slug' => $storeSlug]) }}">
                                        <img src="{{ $storeImage }}" alt="{{ $storeName }} Image" class="coupon-image img-fluid rounded" loading="lazy">
                                    </a>
                                @else
                                    <div class="no-image-placeholder bg-light text-center py-4">
                                        <p>No image</p>
                                        <span>{{ $storeName }}</span>
                                    </div>
                                @endif
                            </div>

                            <div class="coupon-body p-3">
                                <span class="badge bg-success">✔ Verified</span>
                                <span class="d-block text-muted">{{ $storeName }}</span>
                                <h6 class="text-left">{{ $coupon->name }}</h6>
                                <span class="d-block mb-2 {{ \Carbon\Carbon::parse($coupon->ending_date)->isPast() ? 'text-danger' : 'text-muted' }}">
                                    <i class="bi bi-calendar-check"></i> {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d M Y') }}
                                </span>
                                <span class="text-dark"><i class="bi bi-person"></i> {{ $coupon->clicks }} People Used</span>

                                <div class="d-grid gap-2 mt-3">
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
                                            <span class="coupon-text">Activate Coupon</span>
                                            <span class="coupon-code" id="couponCode{{ $coupon->id }}" style="display: none;">{{ $coupon->code }}</span>
                                        </a>
                                    @else
                                        <a href="{{ $destinationUrl }}" target="_blank" class="get" onclick="updateClickCount('{{ $coupon->id }}')">
                                            View Deal
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

<section class="disclaimer container mt-5">
    <div class="row align-items-center">
        <div class="col-md-4 text-center d-none d-md-flex">
            <img src="{{ asset('images/bg-disclaimer.png') }}" alt="Disclaimer Image" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-8">
            <div class="text-left p-4 bg-light rounded shadow-sm">
                <h4 class="fw-bold text-dark">Disclaimer</h4>
                <p class="mb-0 text-muted">A disclaimer is essential for compliance with our advertising policies (AS) and must adhere to all relevant government regulations. Ensure that any advertising content complies with these regulations. Disclaimers are mandatory for anyone earning money through affiliate links in ads. The primary goal is to inform consumers that the publisher earns a commission from these links. If affiliate links appear on someone else's website or in user comments, a disclaimer must be added whenever a product is promoted and the publisher receives compensation. Both audible and visual disclaimers are required in videos or live streams, as consumers may enter or exit at any time, so a clear visual disclaimer must be provided. These guidelines also apply to mobile sites and apps. Keep in mind that digital marketing and disclaimer requirements will continue to evolve, so stay informed about updates and maintain transparency with consumers at all times.</p>
            </div>
        </div>
        <div class="col-12 text-center d-md-none mt-4">
            <img src="{{ asset('images/bg-disclaimer.png') }}" alt="Disclaimer Image" class="img-fluid rounded shadow-sm">
        </div>
    </div>
</section>
<!-- Blog Section -->
<section class="blog-section py-2 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 mb-3 d-inline-flex align-items-center">
                <i class="fas fa-newspaper me-2"></i>@lang('welcome.sp')
            </span>
            <h2 class="fw-bold mb-3">@lang('welcome.H5')</h2>
            <p class="text-muted mb-0">@lang('welcome.blog-p')</p>
        </div>

        <div class="row g-4">
            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="card blog-card h-100 border-0 shadow-sm overflow-hidden transition-all hover-shadow">
                    <div class="card-img-top position-relative overflow-hidden" style="height: 220px;">
                       <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}">
                            <img src="{{ $blog->image ? asset( $blog->image) : asset('front/assets/images/no-image-found.jpg') }}"
                                 alt="{{ $blog->title }}"
                                 class="img-fluid w-100 h-100 object-cover transition-scale"
                                 loading="lazy"
                                 onerror="this.src='{{ asset('images/no-image-found.png') }}'">

                        <div class="card-img-overlay d-flex align-items-end p-0">
                            <span class="badge bg-primary bg-opacity-90 position-absolute top-0 end-0 m-3">{{ $blog->category->title ?? 'General' }}</span>
                        </div>
                           </a>
                    </div>

                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <small class="text-muted">
                                <i class="far fa-calendar-alt me-2"></i>{{ $blog->created_at->format('M d, Y') }}
                            </small>
                            <small class="text-muted ms-3">
                                <i class="far fa-clock me-2"></i>{{ ceil(str_word_count($blog->description) / 200) }} min read
                            </small>
                        </div>

                        <h5 class="card-title fw-bold mb-3">{{ Str::limit($blog->title, 60) }}</h5>


                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <a href="{{ route('blog.detail', ['slug' => Str::slug($blog->slug)]) }}" class="btn btn-link text-primary p-0 text-decoration-none d-flex align-items-center">
                               @lang('welcome.Read More')<i class="fas fa-arrow-right ms-2"></i>
                            </a>
                            <div class="d-flex">
                                <!-- Add social sharing icons if needed -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('blog', ['lang' => app()->getLocale()]) }}" class="btn btn-dark px-4 py-2 rounded-pill">
                <i class="fas fa-book-open me-2"></i>@lang('welcome.View All Articles')
            </a>
        </div>
    </div>
</section>

</main>
@endsection
@push('styles')
    <style>
            .card-store {
                    background: #fff;
                    border-radius: 10px;
                    padding: 15px;
                    text-align: center;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }
                .store-image {
                    width: 80px;
                    height: 80px;
                    border-radius: 10%;
                    object-fit: fill;
                }
                .card-title {
                    font-size: 16px;
                    font-weight: bold;
                    margin-top: 10px;
                }
                .carousel-indicators button {
                    background-color: #45046a !important;
                    border-radius: 50%;
                    width: 12px;
                    height: 12px;
                    border: none;
                }
            .custom-carousel-btn {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background-color: #45046a;
                color: white;
                border: none;
                font-size: 20px;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                cursor: pointer;
                z-index: 1000;
                transition: background-color 0.3s ease, opacity 0.3s ease;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
            }
            .carousel:hover .custom-carousel-btn {
                opacity: 1;
            }
            .custom-carousel-btn:hover {
                background-color: #5a007a;
            }
            .custom-prev-btn {
                left: 10px;
            }
            .custom-next-btn {
                right: 10px;
            }

            .slider-image {
                height: 300px;
                width: 100%;
                object-fit: fill;
                filter: brightness(0.8);
                padding:10px 40px;
            }
            @media (max-width: 768px) {
                .slider-image {
                    height: 200px;
                    padding: 5px 20px;
                }
            }

            @media (max-width: 576px) {
                .slider-image {
                    height: 150px;
                    padding: 5px 10px;
                }
            }
            .title {
                font-size: 1.5rem;
                font-weight: 400;
                color: #333;
                margin-bottom: 20px;
                text-align: center;
            }


            .grid-template {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                grid-template-rows: auto;
                gap: 10px;
            }

            .category-card {
                position: relative;
                overflow: hidden;
                border-radius: 10px;
            }

            .category-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 10px;
            }

            .category-overlay {
                background: rgba(0, 0, 0, 0.5);
                padding: 10px;
                border-radius: 5px;
                width: 90%;
            }
            .category-image {
                width: 100px;
                height: 100px;
                object-fit: fill;
                border-radius: 10px;
            }

    </style>
@endpush
