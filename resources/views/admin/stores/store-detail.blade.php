@extends('admin.datatable')
@section('datatable-title')
    Coupons Management
@endsection
@section('datatable-content')
<main class="container-fluid px-0">

    <!-- Breadcrumb Navigation -->
    <div class="content-wrapper">
        <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.stores') }}"><i class="fas fa-store"></i> Stores</a></li>
                <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-tag"></i> Coupons</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $store->name }}</li>
            </ol>
        </nav>

        <!-- Header Section -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-3 align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('uploads/stores/' . $store->store_image) }}"
                                 class="rounded-circle me-3 border shadow-sm"
                                 alt="{{ $store->name }}"
                                 width="60"
                                 height="60"
                                 style="object-fit: contain;"
                                 onerror="this.onerror=null;this.src='{{ asset('images/no-image-found.png') }}'"
                                 loading="lazy">
                            <div>
                                <h1 class="m-0 text-dark"><i class="fas fa-tag mr-2"></i>Coupons Management</h1>
                                <p class="mb-0">
                                    <span class="badge bg-primary">
                                        <i class="fas fa-store"></i> Store: {{ $store->name }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary btn-lg shadow-sm">
                                <i class="fas fa-plus-circle mr-2"></i>Add New Coupon
                            </a>
                            <button type="submit" form="bulk-delete-form" class="btn btn-danger btn-lg shadow-sm" onclick="return confirm('Are you sure you want to delete the selected coupons?')">
                                <i class="fas fa-trash-alt mr-2"></i>Delete Selected
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content Section -->
        <section class="content">
            <div class="container-fluid">
                <!-- Success Message Alert -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle fa-2x mr-3"></i>
                        <div>
                            <h5 class="alert-heading mb-1">Success!</h5>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white border-bottom">
                                <h3 class="card-title mb-0">
                                    <i class="fas fa-list-ol mr-2"></i>Coupons List
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body p-0">
                                <form id="bulk-delete-form" action="{{ route('admin.coupon.deleteSelected') }}" method="POST">
                                    @csrf
                                    <div class="table-responsive">
                                        <table id="coupons-table" class="table table-hover table-striped mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th width="40px" class="text-center">
                                                        <input type="checkbox" id="select-all" class="align-middle">
                                                    </th>
                                                    <th width="60px" class="text-center">#ID</th>
                                                    <th width="40px" class="text-center"><i class="fas fa-sort"></i></th>
                                                    <th>Coupon Details</th>
                                                    <th width="120px" class="text-center">Type</th>
                                                    <th width="120px" class="text-center">Auth</th>
                                                    <th width="100px" class="text-center">Status</th>
                                                    <th width="180px">Last Updated</th>
                                                    <th width="150px" class="text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablecontents">
                                                @foreach ($coupons as $coupon)
                                                <tr class="row1 align-middle" data-id="{{ $coupon->id }}">
                                                    <td class="text-center">
                                                        <input type="checkbox" name="selected_coupons[]" value="{{ $coupon->id }}" class="align-middle">
                                                    </td>
                                                    <td class="text-center text-muted">{{ $coupon->order }}</td>
                                                    <td class="text-center"><i class="fas fa-sort text-muted"></i></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="mr-3">
                                                                <span class="badge bg-light text-dark border">{{ $loop->iteration }}</span>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-1">{{ $coupon->name }}</h6>
                                                                <small class="text-muted">
                                                                    <i class="fas fa-store mr-1"></i>{{ $coupon->stores->name ?? 'No Store' }}
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($coupon->code)
                                                        <span class="badge bg-info">Code</span>
                                                        @else
                                                        <span class="badge bg-warning text-dark">Deal</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge bg-secondary">{{ $coupon->authentication }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($coupon->status == "disable")
                                                        <span class="badge bg-light text-danger border">
                                                            <i class="fas fa-times-circle mr-1"></i>Disabled
                                                        </span>
                                                        @else
                                                        <span class="badge bg-light text-success border">
                                                            <i class="fas fa-check-circle mr-1"></i>Active
                                                        </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <small class="text-muted">
                                                                <i class="far fa-clock mr-1"></i>
                                                                {{ $coupon->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                                                            </small>
                                                            <small class="text-muted">
                                                                <i class="fas fa-user-edit mr-1"></i>
                                                                {{ $coupon->updated_by->name ?? 'System' }}
                                                            </small>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                                               class="btn btn-outline-primary rounded-left"
                                                               data-toggle="tooltip"
                                                               title="Edit Coupon">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{ route('admin.coupon.delete', $coupon->id) }}"
                                                               onclick="return confirm('Are you sure you want to delete this coupon?')"
                                                               class="btn btn-outline-danger rounded-right"
                                                               data-toggle="tooltip"
                                                               title="Delete Coupon">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>

                            <div class="card-footer bg-white">
                                {{-- <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-muted">
                                        Showing <strong>{{ $coupons->firstItem() }}</strong> to <strong>{{ $coupons->lastItem() }}</strong> of <strong>{{ $coupons->total() }}</strong> coupons
                                    </div>
                                    @if($coupons->hasPages())
                                    <div class="pagination-wrapper">
                                        {{ $coupons->links() }}
                                    </div>
                                    @endif
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>



@endsection
@push('styles')
<style>
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,.05);
    }
    .table thead th {
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    .table tbody tr {
        transition: all 0.2s ease;
    }
    .table tbody tr:hover {
        background-color: rgba(0,0,0,.02);
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
    }
    .btn-group-sm > .btn, .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    .dataTables_filter input {
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
    }
    .pagination-wrapper .pagination {
        justify-content: flex-end;
        margin: 0;
    }
</style>
@endpush
