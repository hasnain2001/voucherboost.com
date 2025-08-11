@extends('layouts.welcome')
@section('title')
    Coupon Codes - Find the latest coupon codes and deals for your favorite stores
@endsection
@section('description')
    Find the latest coupon codes and deals for your favorite stores. Save money on your online shopping with our exclusive discount codes.
@endsection
@section('keywords')
    coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping
@endsection
@push('styles')
<style>
     .coupon-authentication {
        font-size: 20px;
        font-weight: 400;
    }

    .coupon-name {
        font-size: 25px;
        color: rgb(62, 28, 74);
    }

    .ending-date {
        font-size: 0.875rem;
    }
    /* Responsive styles */
    @media (max-width: 768px) {
        .coupon-authentication {
            font-size: 20px;
        }
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
        color: #fff;
    }

    .text-purple {
        color: #6f42c1;
    }

    .alert-purple {
        background-color: #f3e6ff;
        border-color: #d6b3ff;
        border-radius: 10px;
    }

    .btn-purple {
        background-color: #6f42c1;
        border: none;
        color: #fff;
        border-radius: 25px;
        transition: all 0.3s ease-in-out;
    }

    .btn-purple:hover {
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
/* General container styling */
.search-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-left: 20px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Styling the heading */
.search-container .heading {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    margin: 0;
    white-space: nowrap;
}

/* Search input field styling */
.search-input {
    padding: 10px 15px;
    font-size: 1rem;
    border: 2px solid #ccc;
    border-radius: 5px 0 0 5px;
    outline: none;
    width: 600px;
    transition: border-color 0.3s ease;
    border-color: #007bff;
}

/* Hover effect for the input field */
.search-input:focus,
.search-input:hover {
    border-color: #16181b;
}

/* Search button styling */
.search-button {
    padding: 5px 15px;
    font-size: 1rem;
    border: none;
    border-radius: 0 5px 5px 0;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Hover effect for the button */
.search-button:hover {
    background-color: #121213;
}
</style>
@endpush
@section('main-content')

<main class="container-fluid">

    <div class="text-center text-white bg-purple py-4">
        <h1>@lang('message.Exclusive Coupon Codes')</h1>
        <hr>
    </div>

@foreach ($coupons as $coupon)
    @php
        // Dynamic logic to prefer store_id, fallback to slug
        $store = $coupon->store_id
            ? App\Models\Stores::find($coupon->store_id)
            : App\Models\Stores::where('slug', $coupon->store)->first();

        $storeImage = $store && $store->store_image ? asset('uploads/stores/' . $store->store_image) : null;
        $destinationUrl = $store && $store->destination_url ? $store->destination_url : $coupon->destination_url;
        $storeSlug = $store ? Str::slug($store->slug) : Str::slug($coupon->store);
        $storeName = $store ? $store->name : $coupon->store;
    @endphp

    <div class="card p-3 mb-3 shadow-sm">
        <div class="row g-3 align-items-center flex-md-row flex-column">
            <div class="col-md-2 col-4 text-center">
                @if ($storeImage)
                    <a href="{{ route('store.detail', ['slug' => $storeSlug]) }}">
                        <img src="{{ $storeImage }}" class="img-fluid rounded" alt="{{ $storeName }} Logo">
                    </a>
                @else
                    <span class="text-muted">{{ $storeName }} @lang('message.No stores found. Please check back later.') </span>
                @endif
            </div>

            <div class="col-md-7 col-8">
                @if ($coupon->authentication && $coupon->authentication !== 'No Auth')
                    <h4 class="coupon-authentication">{{ $coupon->authentication }}</h4>
                @else
                    <span class="coupon-authentication"></span>
                @endif

                <span class="coupon-name">{{ $coupon->name }}</span>
                <p class="coupon-description">{{ $coupon->description }}</p>
                <a href="{{ route('store.detail', ['slug' => $storeSlug]) }}" class="text-decoration-none">@lang('message.see all Offers')</a>
                <p class="ending-date text-muted">Ends: {{ \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') }}</p>
                <p class="text-success">Used: {{ $coupon->clicks }}</p>
            </div>

            <div class="col-md-3 text-center">
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
                        <span class="coupon-text">@lang('welcome.Activate Coupon')</span>
                        <span class="coupon-code" id="couponCode{{ $coupon->id }}" style="display: none;">{{ $coupon->code }}</span>
                    </a>
                @else
                    <a href="{{ $destinationUrl }}" target="_blank" class="get" onclick="updateClickCount('{{ $coupon->id }}')">
                       @lang('welcome.View Deal')
                    </a>
                @endif
                <br><br>
                <a href="{{ route('store.detail', ['slug' => $storeSlug]) }}" class="get">@lang('message.see all Offers')</a>
            </div>
        </div>
    </div>
@endforeach


    {{ $coupons->links('vendor.pagination.custom') }}
</main>

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
            <img src="" alt="Brand Logo" id="storeImage" class="mb-4 rounded-circle shadow-sm" style="width: 100px; height: 100px; object-fit: fill;">
            <!-- Title -->
            <h5 class="fw-bold text-purple" id="couponName"></h5>
            <!-- Coupon Code Section -->
            <div class="d-flex flex-column align-items-center mt-4 mb-4">
            <!-- Coupon Code -->
            <div class="alert alert-purple d-inline-block px-4 py-3 text-center shadow-sm">
            <strong>Coupon Code:</strong>
            <strong id="couponCode" class="fs-4 text-dark"></strong>
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
            Copy and paste this code at <a href="" id="couponUrl" class="text-decoration-none fw-semibold text-purple"></a>
            </p>
            </div>
            <!-- Modal Footer -->
            <div class=" bg-purple text-white text-center ">
            <p class="">CRAZIEST DEALS OF THE SEASON</p>
            </div>
            </div>
            </div>
        </div>
    @endsection
    @push('scripts')
    <script>
                    // Handle the "Reveal Code" button click
                function handleRevealCode(couponId, couponCode, couponName, storeImage, destinationUrl, storeName) {
                    // Show the modal with the coupon code
                    document.getElementById('couponCode').textContent = couponCode;
                    document.getElementById('couponName').textContent = couponName;
                    document.getElementById('storeImage').src = storeImage;
                    document.getElementById('couponUrl').href = destinationUrl;
                    document.getElementById('couponUrl').textContent = storeName;

                    // Update the click count via AJAX
                    updateClickCount(couponId);

                    // Show the modal
                    const modal = new bootstrap.Modal(document.getElementById('couponModal'));
                    modal.show();
                }

                // Function to update the click count via AJAX
                function updateClickCount(couponId) {
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '{{ route("update.clicks") }}', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            try {
                                const response = JSON.parse(xhr.responseText);
                                if (response.success) {
                                    // Update the "Used By" count on the page
                                    const usedCountElement = document.getElementById('usedCount' + couponId);
                                    usedCountElement.textContent = `Used By: ${response.clicks}`;
                                }
                            } catch (error) {
                                console.error('Error parsing response:', error);
                            }
                        }
                    };

                    xhr.send('coupon_id=' + couponId);
                }

                // Copy the coupon code to the clipboard and show a success message
                function copyToClipboard() {
                    const code = document.getElementById('couponCode').textContent;
                    navigator.clipboard.writeText(code).then(() => {
                        const copyMessage = document.getElementById('copyMessage');
                        copyMessage.style.display = 'block';
                        setTimeout(() => {
                            copyMessage.style.display = 'none';
                        }, 3000); // Hide the message after 3 seconds
                    });
                }

            $(document).ready(function() {
                $('#searchInput').autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: '{{ route("search") }}',
                            dataType: 'json',
                            data: { query: request.term
                            },
                            success: function(data) {
                                response(data.stores); // Ensure `data.stores` is an array of strings or objects
                            }
                        });
                    },
                    minLength: 1 // Minimum characters to trigger autocomplete
                });
            });

                // Get the button:
            let mybutton = document.getElementById("myBtn");

            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
            }

            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            }
            // Function to toggle mobile nav
            function toggleMobileNav() {
                const mobileNav = document.getElementById('mobileNav');
                mobileNav.classList.toggle('active');
            }

    </script>
    @endpush
