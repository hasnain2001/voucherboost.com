@extends('employee.layouts.datatable')
@section('datatable-title')
    Blogs
@endsection
@section('datatable-content')
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
</style>

    <div class=" bg-white">
        <div class="content-wrapper">
            <section class="content">
                <div class=" bg-light justify-content">
                    @section('main-content')
                        <div class="">
                            @if (session('success'))
                                <div class="alert alert-custom alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                           <section class="content-header">
                                <div class="">
                                    <div class="row mb-2">
                                        <div class="col-sm-6">
                                            <h1>Blog</h1>
                                        </div>
                                        <div class="col-sm-6 d-flex justify-content-end">
                                            <a href="{{ route('employee.blog.create') }}" class="btn btn-primary">Add New</a>
                                        </div>
                                    </div>
                                </div>
                            </section>

    <div class="table-responsive">
        <form id="bulkDeleteForm" action="{{ route('employee.blog.bulkDelete') }}" method="POST">
            @csrf
            @method('DELETE')
            <table id="SearchTable" class="table table-bordered table-hover table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select-all-header">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">store</th>
                        <th scope="col">lang</th>
                        <th scope="col">Blog Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_blogs[]" value="{{ $blog->id }}" class="selectCheckbox">
                            </td>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td><small>{{ $blog->title }}</small></td>
                            <td><small>{{ $blog->category->title ?: "Null" }}</small></td>
                            <td><small>{{ $blog->store->name ?? "Null" }}</small></td>
                            <td><small>{{ $blog->language->name ?? "Null" }}</small></td>
                            <td>
                                @if ($blog->image)
                                    <img src="{{ asset($blog->image) }}" alt="Category Image" class="img-thumbnail" style="max-width: 80px;">
                                @else
                                    <span class="badge badge-secondary">No Image</span>
                                @endif
                            </td>
                            <td>
                <a href="{{ route('employee.blog.edit', $blog->id) }}" class="btn btn-sm btn-primary">Edit</a>

                <a href="{{ route('employee.blog.delete', $blog->id) }}" onclick="return confirm('Are you sure you want to delete this blog entry?')" class=" btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="thead-dark">
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select-all-footer">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">store</th>
                        <th scope="col">lang</th>
                        <th scope="col">Blog Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </tfoot>
            </table>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the selected blogs?')">Delete Selected</button>
        </form>
    </div>






                        </div>
                    @show
                </div>
            </section>
        </div>
    </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllHeader = document.getElementById('select-all-header');
        const selectAllFooter = document.getElementById('select-all-footer');
        const checkboxes = document.querySelectorAll('.selectCheckbox');

        function toggleCheckboxes(selectAll) {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        }

        selectAllHeader.addEventListener('change', function() {
            toggleCheckboxes(selectAllHeader);
            selectAllFooter.checked = selectAllHeader.checked;
        });

        selectAllFooter.addEventListener('change', function() {
            toggleCheckboxes(selectAllFooter);
            selectAllHeader.checked = selectAllFooter.checked;
        });

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    if (document.querySelectorAll('.selectCheckbox:checked').length === checkboxes.length) {
                        selectAllHeader.checked = true;
                        selectAllFooter.checked = true;
                    }
                } else {
                    selectAllHeader.checked = false;
                    selectAllFooter.checked = false;
                }
            });
        });
    });
</script>


@endsection
