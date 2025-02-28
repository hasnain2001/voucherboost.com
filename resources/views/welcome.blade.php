<?php
header("X-Robots-Tag:index, follow");
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
<link rel="canonical" href="{{ url()->current() }}">
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="author" content="Ozair Bin mazhar">
    <meta name="robots" content="index, follow">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<!-- Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/icons/bootstrap-icons.min.css') }}">
<link rel="stylesheet" href="{{asset('cssfiles/store-detail.css')}}">
<link rel="stylesheet" href="{{asset('cssfiles/footer.css')}}">
<link rel="stylesheet" href="{{ asset('cssfiles/nabar.css') }}">
<link rel="stylesheet" href="{{ asset('cssfiles/style.css') }}">


    </head>
    <body >
        <x-navbar/>
        {{-- @component('components.navbar')

        @endcomponent --}}

<main class=" text-capitalize">
        @yield('main-content')
    </main>

        <x-footer/>

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
        <!-- JavaScript -->
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
        </script>
<script>
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
  </script>
        <script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
          </body>
</html>
