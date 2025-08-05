@extends('admin.datatable')
@section('datatable-title')
    Coupons
@endsection
@section('datatable-content')
<style>
    .custom-badge {
        padding: 0.20em 0.2em;
        font-size: 0.875rem;
        white-space: nowrap;
    }
    .loading-spinner {
        display: none;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }
    .select2-container--default .select2-selection--single {
        height: 46px;
        padding-top: 8px;
    }
    .store-filter-container {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .filter-title {
        font-weight: 600;
        color: #495057;
    }
    .active-filter-badge {
        background: #e9ecef;
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
    }
    .active-filter-badge .close {
        margin-left: 8px;
        cursor: pointer;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Coupons</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissable">
                    <i class="fa fa-ban"></i>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>{{ session('success') }}</b>
                </div>
            @endif

            <div class="store-filter-container">
                <div class="filter-header">
                    <span class="filter-title">Filter Coupons</span>
                    <div id="active-filter-display" style="display: none;">
                        <span class="active-filter-badge">
                            <span id="active-filter-text"></span>
                            <span class="close" id="clear-active-filter">&times;</span>
                        </span>
                    </div>
                </div>

                <div class="form-group position-relative">
                    <select class="form-control select2" name="store" id="store-filter">
                        <option value="">All Stores</option>
                        @foreach($couponstore as $store)
                            <option value="{{ $store->store_id ?? $store->store }}"
                                {{ $selectedCoupon == ($store->store_id ?? $store->store) ? 'selected' : '' }}>
                                @if ($store->stores)
                                    {{ $store->stores->name }} (ID: {{ $store->store_id }})
                                @else
                                    {{ $store->store }} @if($store->store_id)(ID: {{ $store->store_id }})@endif
                                @endif
                            </option>
                        @endforeach
                    </select>
                    <div class="loading-spinner" id="filter-spinner">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Coupon List</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text" id="coupon-count">
                                        {{ $coupons->count() }} coupons
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="bulk-delete-form" action="{{ route('admin.coupon.deleteSelected') }}" method="POST">
                                @csrf
                                <div class="table-responsive">
                                    <table id="SearchTable" class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="40px"><input type="checkbox" id="select-all"></th>
                                                <th>id</th>
                                                <th width="60px">#</th>

                                                <th>Coupon Name</th>
                                                <th>Store</th>
                                                <th width="100px">Type</th>
                                                <th width="100px">Status</th>
                                                <th width="150px">Created By</th>
                                                <th width="150px">Created At</th>
                                                <th width="150px">Updated At</th>
                                                <th width="120px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="coupons-table-body">
                                            @include('admin.coupons.partials.table', ['coupons' => $coupons])
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete Selected
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize Select2 with search and clear options
    $('.select2').select2({
        placeholder: "Search for a store...",
        allowClear: true,
        width: '100%',
        dropdownParent: $('.store-filter-container')
    });

    // Store filter functionality
    $('#store-filter').change(function() {
        const storeValue = $(this).val();
        const selectedText = $(this).find('option:selected').text();
        const url = "{{ route('admin.coupon') }}";

        // Update active filter display
        if (storeValue) {
            $('#active-filter-display').show();
            $('#active-filter-text').text(`Filtered by: ${selectedText.split(' (ID:')[0]}`);
        } else {
            $('#active-filter-display').hide();
        }

        // Show loading state
        $('#filter-spinner').show();
        $('#coupons-table-body').html(`
            <tr>
                <td colspan="10" class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-2 mb-0">Loading coupons...</p>
                </td>
            </tr>
        `);

        // Make AJAX request
        $.ajax({
            url: url,
            type: 'GET',
            data: { store: storeValue },
            dataType: 'json',
            success: function(response) {
                $('#coupons-table-body').html(response.html);
                $('#coupon-count').text(`${response.count} coupons`);
            },
            error: function(xhr) {
                console.error('Error:', xhr.statusText);
                $('#coupons-table-body').html(`
                    <tr>
                        <td colspan="10" class="text-center text-danger py-4">
                            <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                            <p class="mb-0">Error loading coupons. Please try again.</p>
                        </td>
                    </tr>
                `);
            },
            complete: function() {
                $('#filter-spinner').hide();
            }
        });
    });

    // Clear active filter
    $('#clear-active-filter').click(function() {
        $('#store-filter').val(null).trigger('change');
    });

    // Initialize with any existing filter
    @if($selectedCoupon)
        $('#active-filter-display').show();
        $('#active-filter-text').text(`Filtered by: {{ $selectedCoupon }}`);
    @endif
});
</script>
@endpush
