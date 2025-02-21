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
      <div class="row mt-3">
        <h1 class="text-center display-4">Popular Stores</h1>
        <p class="h5 m-0">Total stores: <span class="fw-bold">{{ $stores->total() }}</span></p>
        <!-- Responsive grid -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-4">
          @foreach ($stores as $store)
            <div class="col">
              <div class="card shadow-sm  overflow-hidden">
                @php
                $storeurl = $store->slug
                  ? route('store_details', ['slug' => Str::slug($store->slug)])
                  : '#';
                @endphp
                <a href="{{ $storeurl }}">
                  @if ($store->store_image)
                    <img src="{{ asset('uploads/stores/' . $store->store_image) }}" class="card-img-top" alt="{{ $store->name }} Image">
                  @else
                    @if ($store->previous_image)
                      <img src="{{ asset('uploads/stores/' . $store->previous_image) }}" class="card-img-top" alt="{{ $store->name }} Image">
                    @else
                      <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="height: 150px;">
                        <i class="fas fa-store fa-3x"></i> <p class="ms-2">No image available</p>
                      </div>
                    @endif
                  @endif
                </a>
                <div class="card-body d-flex flex-column justify-content-between">
                    <a href="{{ $storeurl }}" class="text-dark text-decoration-none stretched-link">
                      <span class="card-title">{{ $store->slug ?: $store->name }}</span>
                    </a>
                  </div>


              </div>
            </div>
          @endforeach
        </div>
        <div class="container bg-light mt-3">
          <div class="row mt-3 justify-content-end">
            <div class="col-12">
              {{ $stores->links('vendor.pagination.custom') }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
