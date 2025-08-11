@extends('admin.layouts.datatable')
@section('datatable-title')
    Categories Management
@endsection
@section('datatable-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1><i class="fas fa-tags"></i> Categories Management</h1>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus-circle"></i> Add New Category
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="icon fas fa-check"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Categories List</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm">
                                        <button type="button" class="btn btn-danger mr-2" id="bulk-delete-btn" disabled>
                                            <i class="fas fa-trash-alt"></i> Delete Selected
                                        </button>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-default" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <form id="bulk-action-form" action="{{ route('admin.category.deleteSelected') }}" method="POST">
                                    @csrf
                                    <div class="table-responsive">
                                        <table id="SearchTable" class="table table-bordered table-striped table-hover">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th width="5%">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="select-all">
                                                            <label for="select-all" class="custom-control-label"></label>
                                                        </div>
                                                    </th>
                                                    <th width="5%">#</th>
                                                    <th>Category Name</th>
                                                    <th width="15%">Image</th>
                                                    <th width="10%">Status</th>
                                                    <th width="15%">Author</th>
                                                    <th width="15%">Date</th>
                                                    <th width="15%">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input select-checkbox" type="checkbox" name="selected_categories[]" value="{{ $category->id }}" id="cat-{{ $category->id }}">
                                                                <label for="cat-{{ $category->id }}" class="custom-control-label"></label>
                                                            </div>
                                                        </td>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <strong>{{ $category->title }}</strong>
                                                            @if($category->parent)
                                                                <br><small class="text-muted">Parent: {{ $category->parent->title }}</small>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <img class="img-fluid img-thumbnail" src="{{ asset('uploads/categories/' . $category->category_image) }}" style="max-height: 60px;" alt="{{ $category->title }}">
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($category->status == "disable")
                                                                <span class="badge badge-danger">Disabled</span>
                                                            @else
                                                                <span class="badge badge-success">Enabled</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <small>
                                                                <strong>Created by:</strong> {{ $category->user->name ?? "System" }}<br>
                                                                <strong>Updated by:</strong> {{ $category->updatedby->name ?? "N/A" }}
                                                            </small>
                                                        </td>
                                                        <td>
                                                            <small>
                                                                <strong>Created:</strong> {{ $category->created_at->format('d M Y') }}<br>
                                                                <strong>Updated:</strong> {{ $category->updated_at->format('d M Y') }}
                                                            </small>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-info" title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="{{ route('admin.category.delete', $category->id) }}"
                                                                   onclick="return confirm('Are you sure you want to delete this category?')"
                                                                   class="btn btn-sm btn-danger" title="Delete">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                    <span class="sr-only">Toggle Dropdown</span>
                                                                </button>
                                                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                                                    <a class="dropdown-item" href="#"><i class="fas fa-eye mr-2"></i>View</a>
                                                                    <a class="dropdown-item" href="#"><i class="fas fa-copy mr-2"></i>Duplicate</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="#"><i class="fas fa-ban mr-2"></i>Disable</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>

                            <div class="card-footer clearfix">
                                <div class="float-left">
                                    <button type="button" class="btn btn-default" id="refresh-table">
                                        <i class="fas fa-sync-alt"></i> Refresh
                                    </button>
                                </div>
                                {{-- <div class="float-right">
                                    {{ $categories->links() }}
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#categories-table').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [
                    { "orderable": false, "targets": [0, 3, 7] }
                ],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search categories...",
                    "emptyTable": "No categories found",
                    "zeroRecords": "No matching categories found"
                }
            });

            // Select all checkboxes
            $('#select-all').change(function() {
                $('.select-checkbox').prop('checked', $(this).prop('checked'));
                toggleBulkDeleteButton();
            });

            // Toggle bulk delete button based on selected checkboxes
            $('.select-checkbox').change(function() {
                if ($('.select-checkbox:checked').length === 0) {
                    $('#select-all').prop('checked', false);
                } else if ($('.select-checkbox:checked').length === $('.select-checkbox').length) {
                    $('#select-all').prop('checked', true);
                }
                toggleBulkDeleteButton();
            });

            function toggleBulkDeleteButton() {
                const checkedCount = $('.select-checkbox:checked').length;
                $('#bulk-delete-btn').prop('disabled', checkedCount === 0);
                $('#bulk-delete-btn').html(
                    `<i class="fas fa-trash-alt"></i> Delete Selected (${checkedCount})`
                );
            }

            // Bulk delete action
            $('#bulk-delete-btn').click(function() {
                const checkedCount = $('.select-checkbox:checked').length;
                if (checkedCount > 0) {
                    if (confirm(`Are you sure you want to delete ${checkedCount} selected category(ies)?`)) {
                        $('#bulk-action-form').submit();
                    }
                }
            });

            // Refresh table
            $('#refresh-table').click(function() {
                window.location.reload();
            });

            // Status toggle switch
            $('.status-toggle').change(function() {
                const categoryId = $(this).data('id');
                const status = $(this).prop('checked') ? 'enable' : 'disable';

                $.ajax({
                    url: `/admin/category/${categoryId}/status`,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function(xhr) {
                        toastr.error('Error updating status');
                        window.location.reload();
                    }
                });
            });
        });
    </script>

    @if(session('success'))
        <script>
            toastr.success("{{ session('success') }}", 'Success', {
                timeOut: 3000,
                progressBar: true,
                closeButton: true
            });
        </script>
    @endif
@endpush

@push('styles')
    <style>
        .card-header {
            border-bottom: 1px solid rgba(0,0,0,.125);
            background-color: #f8f9fa;
        }
        .table th {
            border-top: none;
        }
        .img-thumbnail {
            padding: 0.25rem;
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            max-width: 100%;
            height: auto;
        }
        .badge {
            font-size: 0.85em;
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
        .btn-group-sm > .btn, .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.76563rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        .dropdown-menu {
            min-width: 10rem;
            padding: 0.5rem 0;
            font-size: 0.875rem;
        }
        .dataTables_filter input {
            border-radius: 0.25rem;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
        }
    </style>
@endpush
