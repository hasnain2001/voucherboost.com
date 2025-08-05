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
                            ? route('store.detail', ['slug' => Str::slug($store->slug)])
                            : '#';
                    @endphp
                    <div class="col-md-3 col-sm-6 col-6 mb-4">
                        <div class="card h-100 text-center">
                            <a href="{{ $storeUrl }}" class="text-decoration-none store-card">
                                <img src="{{ $store->store_image ? asset('uploads/stores/' . $store->store_image) : asset('front/assets/images/no-image-found.jpg') }}"
                                     alt="{{ $store->name ?: 'Store Image' }}" class="store-image">
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

@if($stores->hasPages())
    <div class="pagination-links">
        {{ $stores->links('vendor.pagination.custom') }}
    </div>
@endif
