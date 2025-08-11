@extends('layouts.welcome')
@section('title', 'Coupon Codes')
@section('description', 'Find the latest coupon codes and deals for your favorite stores.')
@section('keywords', 'coupon codes, discount codes, promo codes, deals, offers')
@push('styles')
<style>
    /* General Styling */
    .store-card, .coupon-card {
        border: none;
        border-radius: 12px;
        padding: 15px;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }
    .store-card:hover, .coupon-card:hover {
        transform: scale(1.02);
    }
    .store-card img {
        max-width: 100px;
        margin: auto;
    }
    .coupon-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        padding: 15px;
        border-left: 5px solid #ff6f61;
    }
    .coupon-card img {
        width: 80px;
        height: auto;
        border-radius: 8px;
    }
    .coupon-details {
        flex-grow: 1;
        padding: 10px;
    }
    .coupon-details span {
        font-size: 18px;
        margin: 0;
    }
    .coupon-details p {
        font-size: 16px;
        margin: 0;
    }
    .coupon-actions {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }
    /* .coupon-actions a {
        text-decoration: none;
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.3s ease-in-out;
    } */


    /* Responsive Styles */
    @media (max-width: 768px) {
        .stores-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .coupon-card {
            flex-direction: row;
            align-items: center;
            padding: 12px;
        }
        .coupon-card img {
            width: 60px;
        }
        .coupon-details spa {
            font-size: 14px;
        }
        .coupon-details p {
            font-size: 12px;
        }
        .coupon-actions {
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
    }
</style>
@endpush
@section('main-content')
<main class=" container-fluid">
    <div class="text-center  bg-purple py-4">
        <h1>@lang('nav.20% OFFERS')</h1>
        <hr>
    </div>

    <div class="row mt-4">
        <!-- Left Side: Stores -->
        <div class="col-md-3">
            <h4 class="text-center">@lang('nav.Popular Stores')</h4>
            <div class="stores-grid row row-cols-2 g-3">
            @foreach ($populorstores as $store)
            <div class="store-card text-center p-3 col">
            <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}" class="text-decoration-none text-dark">
                <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="{{ $store->name }}">
                <p class="mt-2">{{ $store->name }}</p>
            </a>
            </div>
            @endforeach
            </div>
        </div>

        <!-- Right Side: Coupons -->
        <div class="col-md-9">
            <h4 class="text-center">@lang('nav.Coupons')</h4>
            @foreach ($coupons as $coupon)
                @php $store = App\Models\Stores::where('slug', $coupon->store)->first(); @endphp
                <div class="coupon-card mb-3">
                    <div class="text-center">
                        <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store)]) }}">
                        @if ($store && $store->store_image)
                            <img src="{{ asset('uploads/stores/' . $store->store_image) }}" alt="{{ $store->name }}">
                        @endif
                        </a>
                    </div>
                    <div class="coupon-details">
                        <span>{{ $coupon->name }}</span>
                        <p class="description">{{ $coupon->description }}</p>
                        <p class="text-muted">Ends: {{ $coupon->ending_date ? \Carbon\Carbon::parse($coupon->ending_date)->format('d-m-Y') : 'No Expiry' }}</p>
                        <p class="text-success">✔ Verified</p>
                        <p class="text-muted">👥 {{ $coupon->clicks }} @lang('welcome.used')</p>
                    </div>
                    <div class="coupon-actions">
                        @if ($coupon->code)
                        <a href="{{ $coupon->destination_url }}" target="_blank" class="reveal-code" id="getCode{{ $coupon->id }}" onclick="handleRevealCode({{ $coupon->id }}, '{{ $coupon->code }}', '{{ $coupon->name }}', '{{ asset('uploads/stores/' . $store->store_image) }}', '{{ $coupon->destination_url }}', '{{ $coupon->store }}')">
                        <span class="coupon-text">@lang('welcome.Activate Coupon')</span>
                        <span class="coupon-code" id="couponCode{{ $coupon->id }}" style="display: none;">{{ $coupon->code }}</span>
                        </a>
                        @else
                        <a href="{{ $coupon->destination_url }}" target="_blank" class="get" onclick="updateClickCount('{{ $coupon->id }}')">
                   @lang('welcome.View Deal')
                        </a>
                        @endif
                        <a href="{{ route('store.detail', ['slug' => Str::slug($coupon->store)]) }}" class="get">See All Offers</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $coupons->links('vendor.pagination.custom') }}
    </div>
</main>


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

