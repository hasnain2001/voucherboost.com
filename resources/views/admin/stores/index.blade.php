@extends('admin.datatable')
@section('datatable-title')
    Stores
@endsection
@section('datatable-content')
    <div class="content-wrapper">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dahboard</a></li>
                   <lii class="breadcrumb-item active" aria-current="page">stores</lii>

            </ol>
          </nav>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Stores</h1>
                    </div>

                    <div class="col-sm-6 d-flex justify-content-center">

                        <a href="{{ route('admin.store.create') }}" class="btn btn-dark">Add New Store</a>
                        <a href="{{ route('admin.coupon.create') }}" class="btn btn-warning">Add New Coupon</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                      <form id="bulk-delete-form" action="{{ route('admin.store.deleteSelected') }}" method="POST">
    @csrf
    <div class="table-responsive">
        <table id="SearchTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th scope="col">#</th>
                    <th scope="col">Store Name</th>
                    <th>Store Image</th>
                    <th>Network</th>
                    <th>Featured</th>
                    <th>Status</th>
                    {{-- <th>Lang</th> --}}
                   <th>created at</th>
                    <th> last updated </th>
                    <th>Action</th>
                    <th>EDIT Coupon</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($stores as $store)
                <tr>
                    <td><input type="checkbox" name="selected_stores[]" value="{{ $store->id }}"></td>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $store->name }}</td>
                    <td>
                        <img class="img-thumbnail"
                             src="{{ $store->store_image ? asset('uploads/stores/' . $store->store_image) : asset('front/assets/images/no-image-found.jpg') }}"
                             alt="Card Image"
                             style="max-width: 40px;">
                    </td>
                    <td>{{ $store->network ?? 'null' }}</td>
                    <td>{{ $store->category ?? 'null' }}</td>
                    <td>
                        @if ($store->status == "disable")
                            <i class="fas fa-times-circle text-danger"></i>
                        @else
                            <i class="fas fa-check-circle text-success"></i>
                        @endif
                    </td>
                    {{-- <td>
                        <!-- Safely Access Language Code -->
                        {{ $store->store_language?->code ?? 'No Code' }}
                    </td> --}}
                    <td>
                        <span class="text-dark" data-bs-toggle="tooltip"
                              title="{{ $store->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                            {{ $store->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                        </span>
                    </td>
                    <td>
                        <span class="text-dark" data-bs-toggle="tooltip"
                              title="{{ $store->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                            {{ $store->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.store.edit', $store->id) }}" class="btn btn-info btn-sm">Edit</a>
                        <a href="{{ route('admin.store.delete', $store->id) }}" onclick="return confirm('Are you sure you want to delete this!')" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                    <td>
                        <a class="btn btn-success text-white btn-sm"
                           href="{{ route('admin.store_details', ['slug' => Str::slug($store->slug)]) }}"
                           rel="noopener noreferrer">
                            Edit Coupon
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th><input type="checkbox" id="select-all-footer"></th>
                    <th scope="col">#</th>
                    <th>Store Name</th>
                    <th>Store Image</th>
                    <th>Network</th>
                    <th>Featured</th>
                    <th>Status</th>
                    {{-- <th>Lang</th> --}}
                  <th>created at</th>
                    <th> last updated </th>
                    <th>Action</th>
                    <th>EDIT Coupon</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the selected stores and their coupons?')">Delete Selected</button>
</form>


                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </section>

    </div>


<script>
    // JavaScript to handle the select all functionality
    document.getElementById('select-all').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_stores[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });

    document.getElementById('select-all-footer').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_stores[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });
</script>
@endsection
