@extends('welcome')
@section('title')
    Stores
@endsection
@section('description')
    Find the latest coupon codes and deals for your favorite stores. Save money on your online shopping with our exclusive discount codes.
@endsection
@section('keywords')
    coupon codes, discount codes, promo codes, deals, offers, vouchers, discounts, savings, online shopping
@endsection

@section('main-content')
      <!-- Custom CSS for better responsiveness -->
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
        </style>
<div class="main_content">
    <div class="container bg-light">
        <div class="row mt-3 justify-content-center">
          <div class="col-12">
            <!-- Pagination with responsive behavior -->
            <ul class="pagination pagination-responsive justify-content-center flex-wrap">
              @foreach(range('A', 'Z') as $letter)
              <li class="page-item {{ request()->get('letter') == $letter ? 'active' : '' }}">
                <a class="page-link" href="{{ route('stores', ['letter' => $letter]) }}" style="color: purple; font-weight: bold;">
                  {{ $letter }}
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>



    <div class="container">
        @if ($stores->isEmpty())
            <div class="alert alert-info text-dark" role="alert">
                No stores found.
            </div>
        @else
            <div class="row">
                @foreach ($stores as $store)
                    @php
                        $storeUrl = $store->slug
                            ? route('store_details', ['slug' => Str::slug($store->slug)])
                            : '#';
                    @endphp
                    <div class="col-md-3 col-sm-6 col-6 mb-4">
                        <div class="card h-100 text-center">
                            <a href="{{ $storeUrl }}" class="text-decoration-none store-card">
                                <img src="{{ $store->store_image ? asset('uploads/stores/' . $store->store_image) : asset('front/assets/images/no-image-found.jpg') }}"
                                     alt="{{ $store->name ?: 'Store Image' }}" class="card-img-top stores">
                                <div class="card-body">
                                    <span class="card-title text-dark">{{ $store->name ?: "Title not found" }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{ $stores->links('vendor.pagination.custom') }}

</main>
@endsection
