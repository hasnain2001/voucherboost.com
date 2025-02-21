@extends('employee.datatable')
@section('datatable-title')
    Categories
@endsection
@section('datatable-content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1> Categories</h1>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <a href="{{ route('employee.category.create') }}" class="btn btn-primary">Add New</a>

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
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">

                              <form id="bulk-delete-form" action="{{ route('employee.category.deleteSelected') }}" method="POST">
    @csrf
    <div class="table-responsive">
        <table id="SearchTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th scope="col">#</th>
                    <th>Category Name</th>
                    <th>Category Image</th>

                    <th>Status</th>
                    <th>Added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td><input type="checkbox" name="selected_categories[]" value="{{ $category->id }}"></td>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $category->title }}</td>
                        <td><img class=" img-thumbnail" src="{{ asset('uploads/categories/' . $category->category_image) }}" style="width:80px;"></td>
                            {{-- <td>
                                @if ($category->authentication == "No Auth")
                                    <i class="fa fa-fw fa-times-circle"></i>
                                @else
                                    <i class="fa fa-fw fa-check-circle"></i>
                                @endif
                            </td> --}}
                        <td>
                            @if ($category->status == "disable")
                                <i class="fa fa-fw fa-times-circle text-danger"></i>
                            @else
                                <i class="fa fa-fw fa-check-circle text-success"></i>
                            @endif
                        </td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <a href="{{ route('employee.category.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>
                            <a href="{{ route('employee.category.delete', $category->id) }}" onclick="return confirm('Are you sure you want to delete this!')" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th><input type="checkbox" id="select-all-footer"></th>
                    <th scope="col">#</th>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    {{-- <th>Top Category</th> --}}
                    <th>Status</th>
                    <th>Added</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the selected categories?')">Delete Selected</button>
</form>



                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section>

    </div>
@endsection
@section('scripts')
<script>
    // JavaScript to handle the select all functionality
    document.getElementById('select-all').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_categories[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });

    document.getElementById('select-all-footer').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_categories[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });
</script>
    <script>
        $(document).ready(function() {
            // Select All checkboxes
            $('#selectAll').click(function() {
                $('.selectCheckbox').prop('checked', this.checked);
            });

            // Delete Selected
            $('#deleteSelected').click(function() {
                var selectedIds = [];
                $('.selectCheckbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length > 0) {
                    if (confirm('Are you sure you want to delete the selected categories?')) {
                        $.ajax({
                            url: '{{ route("employee.category.deleteSelected") }}',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                ids: selectedIds
                            },
                            success: function(response) {
                                // Handle success response, e.g., show a success message
                                alert('Selected categories deleted successfully.');
                                // Optionally, you can reload the page to reflect the changes
                                location.reload();
                            },
                            error: function(xhr, status, error) {
                                // Handle error response
                                console.error(error);
                                // Optionally, show an error message
                                alert('Error deleting selected categories.');
                            }
                        });
                    }
                } else {
                    alert('Please select at least one category to delete.');
                }
            });
        });
    </script>
@endsection

