@extends('admin.datatable')
@section('datatable-title') Stores Management @endsection
@push('styles')
<style>
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,.125);
    }
    .bg-lightblue {
        background-color: #e3f2fd;
    }
    .table th {
        white-space: nowrap;
    }
    .badge {
        font-weight: 500;
    }
    .img-thumbnail {
        padding: 0.15rem;
    }
    .btn-group .btn {
        margin-right: 2px;
    }
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    .breadcrumb {
        padding: 0.75rem 1rem;
    }
    /* width */
    ::-webkit-scrollbar {
        width: 10px;
    }
    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }
    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
@endpush

@section('datatable-content')
<div class="content-wrapper">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb bg-white shadow-sm">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none"><i class="fas fa-home mr-1"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-store mr-1"></i> Stores</li>
        </ol>
    </nav>

    <!-- Header Section -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-store mr-2"></i>Stores Management</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.store.create') }}" class="btn btn-dark btn-sm">
                            <i class="fas fa-plus-circle mr-1"></i> Add New Store
                        </a>
                        <a href="{{ route('admin.coupon.create') }}" class="btn btn-warning btn-sm ml-2">
                            <i class="fas fa-tag mr-1"></i> Add New Coupon
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Success Alert -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle mr-2"></i>
                <strong>Success!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif

            <!-- Stores Table -->
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list mr-1"></i> Stores List</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form id="bulk-delete-form" action="{{ route('admin.store.deleteSelected') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table id="SearchTable" class="table table-bordered table-hover table-striped">
                                <thead class="bg-lightblue">
                                    <tr>
                                        <th width="40px" class="text-center">
                                            <input type="checkbox" id="select-all" class="align-middle">
                                        </th>
                                        <th width="50px" class="text-center">#</th>
                                        <th>Store Name</th>
                                        <th width="80px">Image</th>
                                        <th>Network</th>
                                        <th>Category</th>
                                        <th>lang</th>
                                        <th width="80px">Status</th>
                                        <th>Created By/updated by</th>
                                        <th width="140px">Created At</th>
                                        <th width="140px">Updated At</th>
                                        <th width="220px" class="text-center">Actions</th>
                                        <th width="120px" class="text-center">Coupons</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stores as $store)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" name="selected_stores[]" value="{{ $store->id }}" class="align-middle store-checkbox">
                                        </td>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold"><small>{{ $store->name }}</small></td>
                                        <td class="text-center">
                                           <img src="{{ asset('uploads/stores/' . $store->store_image) }}"
                                                 class="rounded me-2"
                                                 alt="{{ $store->name }}"
                                                 width="40"
                                                 onerror="this.onerror=null;this.src='{{ asset('assets/images/no-image-found.png') }}'"
                                                 loading="lazy">
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $store->network ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary">
                                                @if ($store->categories)
                                                    {{ $store->categories->title ?? 'N/A' }}

                                                @else
                                                {{ $store->category ?? 'N/A' }}

                                                @endif
                                            </span>
                                        </td>
                                        <td>{{ $store->language->code ?? null }}</td>
                                        <td class="text-center">
                                            @if ($store->status == "disable")
                                                <span class="badge badge-danger"><i class="fas fa-times-circle mr-1"></i> Disabled</span>
                                            @else
                                                <span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i> Active</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small class="badge badge-light">{{ $store->user->name ?? 'System' }}</small>
                                             <small class="badge badge-light">{{ $store->updatedby->name ?? 'System' }}</small>
                                        </td>
                                        <td>
                                            <small class="text-muted" data-toggle="tooltip"
                                                   title="{{ $store->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                                                {{ $store->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                                            </small>
                                        </td>
                                        <td>
                                            <small class="text-muted" data-toggle="tooltip"
                                                   title="{{ $store->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                                                {{ $store->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.store.edit', $store->id) }}"
                                                   class="btn btn-sm btn-info"
                                                   data-toggle="tooltip"
                                                   title="Edit Store">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.store.delete', $store->id) }}"
                                                   onclick="return confirm('Are you sure you want to delete this store?')"
                                                   class="btn btn-sm btn-danger"
                                                   data-toggle="tooltip"
                                                   title="Delete Store">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                <a href="{{ route('store.detail', ['slug' => Str::slug($store->slug)]) }}"
                                                   class="btn btn-sm btn-dark"
                                                   target="_blank"
                                                   data-toggle="tooltip"
                                                   title="View on Website">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.store_details', ['slug' => Str::slug($store->slug)]) }}"
                                               class="btn btn-sm btn-success"
                                               data-toggle="tooltip"
                                               title="Manage Coupons">
                                                <i class="fas fa-tags"></i> Coupons
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-danger btn-sm" id="delete-button">
                                <i class="fas fa-trash mr-1"></i> Delete Selected
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();


    // Select All functionality
    document.getElementById('select-all').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_stores[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });

    // Delete button confirmation
    document.getElementById('delete-button').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_stores[]"]:checked');

        if (checkboxes.length === 0) {
            alert('Please select a store before deleting.');
            event.preventDefault(); // Prevent form submission
        } else {
            if (!confirm('Are you sure you want to delete the selected stores and their coupons?')) {
                event.preventDefault(); // Prevent form submission if user cancels
            }
        }
    });
});
</script>
@endpush
