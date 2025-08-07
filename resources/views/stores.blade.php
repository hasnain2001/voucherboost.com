@extends('layouts.welcome')
@section('title')
    Stores
@endsection
@section('description')
    Find the latest coupon codes and deals for your favorite stores. Save money on your online shopping with our exclusive discount codes.
@endsection
@section('keywords')
    coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping
@endsection
@push('styles')
        <style>
        /* Ensure pagination wraps on smaller screens */
        .pagination-responsive {
          display: flex;
          flex-wrap: wrap;
          justify-content: center;
        }
        /* Adjust padding and margin for smaller screens */
        .pagination-responsive .page-item {
          margin: 0.2rem;
        }
        /* Reduce font size on smaller screens */
        @media (max-width: 768px) {
          .pagination-responsive .page-link {
            padding: 0.5rem 0.75rem;
            font-size: 0.9rem;
          }
        }
        /* Further reduce font size for very small screens */
        @media (max-width: 576px) {
          .pagination-responsive .page-link {
            padding: 0.3rem 0.5rem;
            font-size: 0.8rem;
          }
        }
        .card-title {
          font-size: 15px;
          color: #333;
          white-space: nowrap; /* Prevents text from wrapping */
          overflow: hidden; /* Hides overflowed text */
          text-overflow: ellipsis; /* Adds an ellipsis (...) for truncated text */
          display: block; /* Ensures the span behaves like a block element */
          max-width: 100%; /* Ensures the title respects the parent container's width */
        }
        /* Adjust font size for smaller screens */
        @media (max-width: 768px) {
          .card-title {
            font-size: 14px;
          }
        }
        @media (max-width: 576px) {
          .card-title {
            font-size: 13px;
          }
        }
        /* Breadcrumb styling */
        .breadcrumb {
          background-color: #f8f9fa;
          padding: 0.75rem 1rem;
          margin-bottom: 1rem;
          border-radius: 0.25rem;
        }
        .breadcrumb-item + .breadcrumb-item::before {
          content: ">";
          color: #6c757d;
        }
        .breadcrumb-item a {
          color: hsl(272, 75%, 47%);
          text-decoration: none;
        }
        .breadcrumb-item a:hover {
          text-decoration: underline;
        }

        /* Circular Image Styling */
        .store-image {
          width: 100px;
          height: 100px;
          object-fit: fill;
          border-radius: 50%;
          margin: 0 auto;
          transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Hover Effect for Circular Image */
        .store-card:hover .store-image {
          transform: scale(1.1);
          box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        /* Card Styling */
        .card {
          border: none;
          transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Hover Effect for Card */
        .store-card:hover .card {
          transform: translateY(-5px);
          box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .page-link {
            color: purple; font-weight: bold;
        }
        .page-item.active .page-link {
          background-color: rgb(175, 16, 154);
          border-color: purple;
          color: rgb(255, 255, 255);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
          .store-image {
            width: 80px;
            height: 80px;
          }
        }

        @media (max-width: 576px) {
          .store-image {
            width: 60px;
            height: 60px;
          }
        }
      </style>
@endpush
@section('main-content')
<div class="main_content">
    <div class="container bg-light">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">@lang('nav.home')</a></li>
            <li class="breadcrumb-item active" aria-current="page">@lang('nav.stores')</li>
          </ol>
        </nav>
        <div class="row mt-3 justify-content-center">
          <div class="col-12">
            <!-- Pagination with responsive behavior -->
            <ul class="pagination pagination-responsive justify-content-center flex-wrap">
        <ul class="pagination">
            @foreach(range('A', 'Z') as $letter)
                <li class="page-item {{ request()->get('letter') == $letter ? 'active' : '' }}">
                    <a class="page-link alphabet-filter"
                    href="#"
                    data-letter="{{ $letter }}"
                    data-url="{{ route('stores', ['lang' => app()->getLocale(), 'letter' => $letter]) }}">
                        {{ $letter }}
                    </a>
                </li>
            @endforeach
        </ul>
          </div>
        </div>
      </div>
    <div class="container">
<div id="stores-container">
    @include('partials.stores_list', ['stores' => $stores])
</div>
    </div>

</main>
@endsection
@push('scripts')

<script>
$(document).ready(function() {
    // Handle alphabet filter clicks
    $('.alphabet-filter').click(function(e) {
        e.preventDefault();

        const letter = $(this).data('letter');
        const url = $(this).data('url');

        // Update active state
        $('.page-item').removeClass('active');
        $(this).closest('.page-item').addClass('active');

        loadStores(url);
    });

    // Handle pagination clicks (using event delegation)
    $(document).on('click', '#pagination-container a.page-link', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        loadStores(url);
    });

    function loadStores(url) {
        // Show loading indicator
        $('#stores-container').html('<div class="text-center py-4">Loading...</div>');

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#stores-container').html(response.html);
                $('#pagination-container').html(response.pagination);

                // Update URL in browser without reload
                history.pushState(null, null, url);
            },
            error: function(xhr) {
                console.error('Error:', xhr.statusText);
                $('#stores-container').html('<div class="alert alert-danger">Error loading stores</div>');
            }
        });
    }
});
</script>
@endpush
