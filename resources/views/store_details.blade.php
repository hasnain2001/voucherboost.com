    @extends('welcome')
    @section('title')
    {{ $store->title }}
    @endsection
    @section('description')
    {{ $store->meta_description }}
    @endsection
    @section('keywords')
    {{ $store->meta_keyword }}
    @endsection
    <style>
    .main{
    animation: fadeIn 0.8s ease;
    }
    .authentication {
    background-color:transparent; /* Softer red for a modern look */
    color: #000000; /* Bold red for text */
    padding: 0.5em 1em; /* Increased padding for better spacing */
    border-radius: 0.5em; /* Larger border radius for smoother edges */
    text-align: center; /* Center the text */
    font-weight: bold; /* Make the text stand out */
    font-size: 1.1rem; /* Slightly larger text size for emphasis */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow for a lifted effect */
    border: 3px solid purple; /* Add a border matching the text color */
    transition: transform 0.2s, box-shadow 0.2s; /* Add hover animation */
    }

    .authentication:hover {
    /* transform: scale(1.05); Slight zoom on hover */
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15); /* Enhanced shadow on hover */
    /* cursor: pointer; Pointer cursor to indicate interactivity */
    }
    .store-name{
    font-size: 1rem;
    font-weight: bold;
    }
    .filter-h{
    font-size: 1rem;
    font-weight: bold;
    }
    .coupon-image {
    width: 100%;
    height: 150px;
    object-fit: contain;
    border-radius: 0.15em;
    transition: transform 0.2s, box-shadow 0.2s;
    }
    .coupon-image:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);

    }
    .card-coupon{
    border: 2px dotted #6f42c1;
    box-shadow: 0 4px 8px rgba(111, 66, 193, 0.2);
    }

    .coupon-name {
    font-size: 1.2rem;
    color: rgb(0, 0, 0);
    }

    .ending-date {
    font-size: 0.875rem;
    color: #212121;
    }
    /* Responsive styles */
    @media (max-width: 768px) {

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
    }

    .text-purple {
    color: #6f42c1;
    }

    .alert-purple {
    background-color: #f3e6ff;
    border-color: #d6b3ff;
    border-radius: 10px;
    }

    .bt-purple {
    background-color: #6f42c1;
    border: none;
    color: #fff;
    border-radius: 25px;
    transition: all 0.3s ease-in-out;
    }

    .bt-purple:hover {
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
    @keyframes fadeIn {
    from {
    opacity: 0;
    transform: scale(0.9);
    }
    to {
    opacity: 1;
    transform: scale(1);
    }
    }

    @keyframes slideInCorner {
    from {
    transform: translate(50%, -50%) rotate(45deg);
    opacity: 0;
    }
    to {
    transform: translate(0, 0) rotate(45deg);
    opacity: 1;
    }
    }

    @keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
    }
    40% {
    transform: translateY(-8px);
    }
    60% {
    transform: translateY(-4px);
    }
    }

    .reveal-code {
    position: relative;
    display: inline-block;
    padding: 12px 24px;
    font-size: 16px;
    color: white;
    background: linear-gradient(135deg, #6a1b9a, #9c27b0); /* Gradient purple */
    text-decoration: none;
    border-radius: 8px; /* Rounded corners */
    overflow: hidden;
    border: 1px solid #6a1b9a;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    transition: background 0.3s ease, color 0.3s ease, transform 0.2s ease;
    animation: fadeIn 0.8s ease; /* Button fades in on load */
    }

    .reveal-code:hover {
    background: #fff; /* White background */
    color: #6a1b9a; /* Purple text */
    transform: scale(1.1); /* Slight zoom effect */
    animation: bounce 0.5s; /* Bounce effect on hover */
    }

    .reveal-code::after {
    content: " ";
    position: absolute;
    top: 0;
    right: 0;
    border-style: solid;
    border-width: 0 35px 35px 0;
    border-color: transparent rgba(74, 20, 140, 0.8) transparent transparent; /* Transparent corner */
    transform: rotate(45deg);
    opacity: 0; /* Hidden initially */
    animation: slideInCorner 0.5s ease forwards; /* Corner animation */
    transition: transform 0.3s ease, border-color 0.3s ease;
    }

    .reveal-code:hover::after {
    transform: rotate(0deg);
    opacity: 1; /* Reveal corner */
    border-color: transparent #6a1b9a transparent transparent; /* Highlighted corner */
    }

    .coupon-text {
    display: inline-block;
    font-weight: 500; /* Slightly bold */
    letter-spacing: 0.5px; /* Improved spacing */
    animation: fadeIn 0.8s ease; /* Text fades in on load */
    }

    .coupon-code {
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 18px;
    font-weight: bold;
    color: #333; /* Dark gray */
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); /* Subtle text shadow */
    }

    .get {
    width: 120px;
    background: linear-gradient(to right, #7a1bb4, #ab47bc); /* Enhanced contrast */
    color: #ffffff; /* High contrast for better readability */
    text-align: center;
    padding: 5px 15px;
    border-radius: 25px;
    text-decoration: none;
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.3), -3px -3px 10px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
    margin-right: 10px; /* Add margin between buttons */
    display: inline-block;
    font-size: 16px;
    }

    .get:hover {
    background: linear-gradient(to right, #8e24aa, #d500f9); /* Brighter hover gradient */
    color: #ffffff; /* Ensure text remains readable */
    transform: scale(1.05);
    box-shadow: 0 0 15px rgba(142, 36, 170, 0.7), 0 0 30px rgba(213, 0, 249, 0.5); /* Purple-themed glow */
    animation: fadein 0.5s; /* Bounce effect on hover */
    }
    @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .btn-purple {
            color: #6f42c1;
            border: 2px solid #6f42c1;
            background-color: transparent;
            padding: 10px 15px;
            margin: 5px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            /* animation: fadeIn 0.8s ease; */
            outline: none;
        }

        .btn-purple:hover {
            color: #fff;
            background-color: #6f42c1;
            text-decoration: none;
            border-color: #6f42c1;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            /* animation: bounce 0.5s; */
        }

 </style>
    @section('main-content')
    <main class="main container-fluid text-capitalize">
    @php
    $codeCount = 0;
    $dealCount = 0;
    foreach ($coupons as $coupon) {
    if ($coupon->code) {
    $codeCount++;
    } else {
    $dealCount++;
    }
    }
    $totalCount = $codeCount + $dealCount;
    @endphp

    <section aria-label="breadcrumb" class=" "  >
    <ol class="breadcrumb">
    <li class="breadcrumb-item">
    <a href="{{{ url(app()->getLocale() . '/') }}}" class="text-purple text-decoration-none">Home</a>
    </li>
    <li class="breadcrumb-item   ">
    @if($store->category)
    <a class="text-decoration-none text-purple" href="{{ route('related_category', ['slug' => Str::slug($store->category)]) }}">{{ $store->category }}</a>
    @else <span>No Category</span>
    @endif
    </li>
    <li class="breadcrumb-item">
    <a href="{{ route('stores' ) }}" class="text-purple text-decoration-none ">Stores</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
    {{ $store->slug }}
    </li>
    </ol>
    </section>

    <div class="py-2">
    <div class="text-center mb-4">
    <h1 class="display-7 fw-bold text-dark">{{ $store->name }} </h1>
    {{-- <span>{{$store->language->code}}</span> --}}
    <p class="text-muted">Save more with the best deals and discounts!</p>
    </div>
    <div class="row">
    <div class="col-lg-9">
    <div class="row g-4">
        @if($coupons->isEmpty())
        <div class="col-12 text-center mt-5">
            <div class="alert alert-warning shadow-lg p-4 rounded-lg">
                <h4 class="fw-bold text-dark mb-3">Oops! No Coupons Available</h4>
                <p class="text-muted">Don't worry, you can still explore amazing deals from our partnered brands.</p>
                <a href="{{ route('stores') }}" class="btn btn-primary mt-3 px-4 py-2 fw-semibold">
                    Explore Brands <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

    @else
    @foreach ($coupons as $coupon)

<div class="col-md-4">
    <div class="card-coupon h-100 shadow-lg p-4 rounded-lg d-flex flex-column">
        <div class="d-flex flex-column flex-md-column">
            <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="card-img-top coupon-image shadow mb-3 rounded" alt="{{ $store->name }}">
            <div class="d-flex flex-column flex-md-column justify-content-between w-100">
                <span class="authentication">{{ $coupon->authentication }}</span>
                <hr>
                <!-- Set a fixed height for the text container to prevent pushing buttons down -->
                <div class="text-container flex-grow-1">
                    <span class="coupon-name">{{ $coupon->name }}</span>
                    <hr>
                    <p class="coupon-description">{{ $coupon->description }}</p>
                    <hr>
                </div>
                <span class="ending-date" style="color: {{ strtotime($coupon->ending_date) < strtotime(now()) ? '#951d1d' :'#909090' }};">
                    Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') }}
                </span>
                <hr>
                <span class="used" id="usedCount{{ $coupon->id }}">Used By: {{ $coupon->clicks }}</span>
            </div>
        </div>
        <!-- Coupon Code Section - Buttons stay in one line -->
        <div class="mt-auto d-flex justify-content-center align-items-center gap-2 w-100">
            @if ($coupon->code)
                <a href="{{ $coupon->destination_url }}" target="_blank" class="reveal-code" id="getCode{{ $coupon->id }}" onclick="handleRevealCode('{{ $coupon->id }}', '{{ $coupon->code }}')">
                    <span class="coupon-text">Activate Coupon</span>
                    <span class="coupon-code" id="couponCode{{ $coupon->id }}" style="display: none;">{{ $coupon->code }}</span>
                </a>
            @else
                <a href="{{ $coupon->destination_url }}" target="_blank" class="get" onclick="updateClickCount('{{ $coupon->id }}')">
                    View Deal
                </a>
            @endif
        </div>
    </div>
</div>
    <!-- Coupon Code Modal -->
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow">
    <!-- Modal Header -->
    <div class="modal-header position-relative bg-light border-0">
    <span class="badge bg-danger text-uppercase position-absolute top-0 start-50 translate-middle mt-2 px-4 py-1">
    Limited Time Offer
    </span>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <!-- Modal Body -->
    <div class="modal-body text-center py-5">
    <!-- Logo -->
    <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="Brand Logo" class="mb-4 rounded-circle shadow-sm" style="width: 100px; height: 100px; object-fit: cover;">
    <!-- Title -->
    <h5 class="fw-bold text-purple">{{ $coupon->name }}</h5>
    <!-- Coupon Code Section -->
    <div class="d-flex flex-column align-items-center mt-4 mb-4">
    <!-- Coupon Code -->
    <div class="alert alert-purple d-inline-block px-4 py-3 text-center shadow-sm">
    <strong>Coupon Code:</strong>
    <strong id="couponCode" class="fs-4 text-dark">XXXX-XXXX</strong>
    <!-- Copy Button -->
    <button class="btn btn-success mt-3 px-4 py-2 fw-semibold shadow-sm" onclick="copyToClipboard()">
    Copy Code
    </button>
    </div>

    <!-- Copy Confirmation Message -->
    <p id="copyMessage" class="text-success fw-bold mt-2" style="display: none;">
    Coupon code copied successfully! 🎉
    </p>
    </div>
    <!-- Description -->
    <p class="text-muted mb-2">
    Copy and paste this code at <a href="{{ $coupon->destination_url }}" class="text-decoration-none fw-semibold text-purple">
    {{ $coupon->store }}
    </a>
    </p>
    </div>
    <!-- Modal Footer -->
    <div class=" bg-purple text-white text-center ">
    <p class="">CRAZIEST DEALS OF THE SEASON</p>
    </div>
    </div>
    </div>
    </div>
    @endforeach
    @endif
    </div>
    </div>
    <div class="col-lg-3">
    <div class=" card-coupon p-4  shadow-lg rounded-lg bg-light">
    <div class="">
    <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="img-fluid mb-3 shadow rounded-circle" alt="{{ $store->name }}">
    <h4 class="store-name fw-bold text-dark">{{ $store->name }}</h4>
    <p class="text-warning fs-5">⭐⭐⭐⭐☆</p>
    </div>
    <p class="text-muted">{{ $store->description }}</p>

    <div class="store-info-card card shadow-sm p- mb-2 bg-white rounded">
    <h4 class=" filter-h mb-4">Filter By Voucher Codes</h4>
    <div class="btn-group" role="group" aria-label="Sort Coupons">
    <a href="{{ url()->current() }}" class=" btn-purple">All</a>
    <a href="{{ url()->current() }}?sort=codes" class=" btn-purple">Codes</a>
    <a href="{{ url()->current() }}?sort=deals" class=" btn-purple">Deals</a>
    </div>
    </div>
    <hr>
    <!-- Store Summary -->
    <div class="p-3 border rounded bg-white shadow-sm">
    <h5 class="fw-bold mb-3">Summary</h5>
    <p class="mb-2">
    <i class="fas fa-tag me-2 text-dark"></i>Total Codes:
    <span class="badge bg-dark">{{ $codeCount }}</span>
    </p>
    <p class="mb-2">
    <i class="fas fa-shopping-cart me-2 text-dark"></i>Total Deals:
    <span class="badge bg-dark">{{ $dealCount }}</span>
    </p>
    <p class="mb-0">
    <i class="fas fa-list me-2 text-dark"></i>Total:
    <span class="badge bg-dark">{{ $totalCount }}</span>
    </p>
    </div>
    <hr>

    <h6 class="fw-bold mt-3 text-dark">Related Brands</h6>
    <ul class=" d-flex flex-column gap-2">
    @foreach ($relatedStores as $relatedStore)
    <li><a href="{{ route('store_details', ['slug' => Str::slug($relatedStore->slug)]) }}" class="text-decoration-none text-dark fw-bold">{{ $relatedStore->name }}</a></li>
    @endforeach
    </ul>
    </div>
    </div>
    </div>
    </div>
    </main>

    @endsection
