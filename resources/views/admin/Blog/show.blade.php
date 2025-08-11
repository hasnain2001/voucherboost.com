@extends('admin.layouts.datatable')
@section('datatable-title')
    Blogs Management
@endsection
@section('datatable-content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-custom alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Blog Management</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active">Blogs</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Blog List</h3>
                        <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="bulkDeleteForm" action="{{ route('admin.blog.bulkDelete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="table-responsive">
                            <table id="SearchTable" class="table table-bordered table-hover table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="5%">
                                            <input type="checkbox" id="select-all-header">
                                        </th>
                                        <th width="5%">#</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th width="10%">Image</th>
                                        <th width="5%">lang</th>
                                        <th width="15%">Author/Updater</th>
                                        <th width="15%">Dates</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogs as $blog)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="selected_blogs[]" value="{{ $blog->id }}" class="selectCheckbox">
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ Str::limit($blog->title, 50) }}</td>
                                            <td>{{ $blog->category->title ?? "N/A" }}</td>
                                            <td>
                                                @if ($blog->image)
                                                    <img src="{{ asset($blog->image) }}" alt="Blog Image" class="img-thumbnail">
                                                @else
                                                    <span class="badge badge-secondary">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{$blog->language->name}}</td>
                                            <td>
                                                <small>Created by: {{ $blog->user->name ?? "System" }}</small>
                                                <small>Updated by: {{ $blog->updatedby->name ?? "N/A" }}</small>
                                            </td>
                                        <td>
                                        <small class="text-muted">
                                            Created: {{ $blog->created_at ? $blog->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') : 'N/A' }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            Updated: {{ $blog->updated_at ? $blog->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') : 'N/A' }}
                                        </small>

                                    </td>

                                            <td class="action-btns">
                                                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-sm btn-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('admin.blog.delete', $blog->id) }}"
                                                   onclick="return confirm('Are you sure you want to delete this blog?')"
                                                   class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to delete selected blogs?')">
                            <i class="fas fa-trash-alt"></i> Delete Selected
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
@push('styles')
<style>
    .alert-custom {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        font-weight: bold;
        border-radius: 0.25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .alert-custom .close {
        color: #155724;
    }
    .img-thumbnail {
        max-width: 80px;
        transition: transform 0.3s ease;
    }
    .img-thumbnail:hover {
        transform: scale(1.5);
    }
    .badge-secondary {
        background-color: #6c757d;
    }
    .action-btns .btn {
        margin-right: 5px;
    }
    .text-muted {
        display: block;
        line-height: 1.4;
    }
    .table-responsive {
        overflow-x: auto;
    }
    #SearchTable {
        width: 100% !important;
    }
</style>
@endpush
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all checkboxes functionality
        const selectAllHeader = document.getElementById('select-all-header');
        const checkboxes = document.querySelectorAll('.selectCheckbox');

        selectAllHeader.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAllHeader.checked;
            });
        });

        // Initialize DataTable
        $('#SearchTable').DataTable({
            responsive: true,
            dom: '<"top"lf>rt<"bottom"ip><"clear">',
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search blogs...",
            },
            columnDefs: [
                { orderable: false, targets: [0, 4, 7] }, // Disable sorting for checkbox, image, and action columns
                { searchable: false, targets: [0, 4, 7] } // Disable searching for checkbox, image, and action columns
            ]
        });

        // Tooltip initialization
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush
