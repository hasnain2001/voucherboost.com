@extends('employee.layouts.datatable')
@section('datatable-title')
 employee | Stores Management
@endsection
@section('datatable-content')
<style>
    .store-image {
        width: 50px;
        height: 50px;
        object-fit: fill;
        border-radius: 4px;
        border: 1px solid #dee2e6;
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
        border-radius: 10px;
    }
    .status-active {
        background-color: #28a74520;
        color: #28a745;
    }
    .status-inactive {
        background-color: #dc354520;
        color: #dc3545;
    }
    .action-btn {
        min-width: 70px;
        margin: 2px;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,.02);
    }
    .badge-featured {
        background-color: #ffc10720;
        color: #ffc107;
    }
    .time-tooltip {
        border-bottom: 1px dotted #6c757d;
        cursor: help;
    }
    .bulk-actions {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
</style>

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-store mr-2"></i>Stores</h1>
                </div>
                <div class="col-sm-6">
                    <div class="float-sm-right">
                        <a href="{{ route('employee.store.create') }}" class="btn btn-dark">
                            <i class="fas fa-plus mr-1"></i> Add New Store
                        </a>
                        <a href="{{ route('employee.coupon.create') }}" class="btn btn-warning">
                            <i class="fas fa-tag mr-1"></i> Add New Coupon
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i>
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Stores</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    {{-- <input type="text" class="form-control" placeholder="Search stores...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <form id="bulk-delete-form" action="{{ route('employee.store.deleteSelected') }}" method="POST">
                                @csrf
                                <div class="bulk-actions">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the selected stores and their coupons?')">
                                        <i class="fas fa-trash mr-1"></i> Delete Selected
                                    </button>
                                    <span id="selected-count" class="text-muted">0 stores selected</span>
                                </div>

                                <div class="table-responsive">
                                    <table id="SearchTable" class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="40"><input type="checkbox" id="select-all"></th>
                                                <th width="60">#</th>
                                                <th>Store Name</th>
                                                <th width="80">Image</th>
                                                <th>Network</th>
                                                <th>Category</th>
                                                <th width="100">Status</th>
                                               <th width="180">Actions/ view</th>
                                                <th width="120">Coupons</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stores as $store)
                                                <tr>
                                                    <td><input type="checkbox" name="selected_stores[]" value="{{ $store->id }}" class="store-checkbox"></td>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <strong>{{ $store->name }}</strong>
                                                        @if($store->top_store)
                                                            <span class="badge badge-featured ml-1">Featured</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <img class="store-image" src="{{ $store->store_image ? asset('uploads/stores/' . $store->store_image) : asset('front/assets/images/no-image-found.jpg') }}" alt="{{ $store->name }}" loading="lazy">
                                                    </td>
                                                    <td>{{ $store->network }}</td>
                                                    <td>    <span class="badge badge-secondary">
                                                @if ($store->categories)
                                                    {{ $store->categories->title ?? 'N/A' }}

                                                @else
                                                {{ $store->category ?? 'N/A' }}

                                                @endif
                                            </span></td>
                                                    <td>
                                                        <span class="status-badge {{ $store->status == 'enable' ? 'status-active' : 'status-inactive' }}">
                                                            {{ ucfirst($store->status) }}
                                                        </span>
                                                    </td>
                                                    {{-- <td>
                                                        <span class="time-tooltip" data-toggle="tooltip" title="{{ $store->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                                                            {{ $store->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="time-tooltip" data-toggle="tooltip" title="{{ $store->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                                                            {{ $store->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                                                        </span>
                                                    </td> --}}
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('employee.store.edit', $store->id) }}" class="btn btn-info btn-sm action-btn" title="Edit">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                            <a href="{{ route('employee.store.delete', $store->id) }}" onclick="return confirm('Are you sure you want to delete this store?')" class="btn btn-danger btn-sm action-btn" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a class="btn btn-success text-white btn-sm" href="{{  route('employee.store_details', ['slug' => Str::slug($store->slug)]) }}" target="_blank"  rel="noopener noreferrer">  <i class="fas fa-eye"></i></a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-success btn-sm action-btn" href="{{ route('employee.store_details', ['slug' => Str::slug($store->slug)]) }}" title="Manage Coupons">
                                                            <i class="fas fa-tags"></i> Coupons
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer clearfix">
                            <div class="float-right">
                                {{-- Add pagination links here if needed --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Select all functionality
    document.getElementById('select-all').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('.store-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
        updateSelectedCount();
    });

    // Update selected count
    function updateSelectedCount() {
        const selectedCount = document.querySelectorAll('.store-checkbox:checked').length;
        document.getElementById('selected-count').textContent = `${selectedCount} ${selectedCount === 1 ? 'store' : 'stores'} selected`;
    }

    // Add event listeners to all checkboxes
    document.querySelectorAll('.store-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });

    // Initialize tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endsection
