@extends('employee.layouts.datatable')
@section('datatable-title')
 Store-detail
@endsection
@section('datatable-content')


    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupons</h1>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        <a href="{{ route('employee.coupon.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                     <h5 class="text-title"><strong>Store : </strong>{{ $store->name }}</h5>
                     <br>

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
               @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>Please fix the following issues:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">
                       <form id="bulk-delete-form" action="{{ route('employee.coupon.deleteSelected') }}" method="POST">
    @csrf
    <div class="table-responsive">
       <table id="SearchTable" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th><input type="checkbox" id="select-all"></th>
            <th>id</th>
            <th width="30px">#</th>
            <th>Coupon Name</th>

            <th>Deal/Code</th>
            <th>auth</th>
            <th>lang</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="tablecontents">
        @foreach ($coupons as $coupon)
            <tr class="row1" data-id="{{ $coupon->id }}">
                <td><input type="checkbox" name="selected_coupons[]" value="{{ $coupon->id }}"></td>
                <th scope="row">{{ $loop->iteration }}</th>
                <td class="pl-3"><i class="fa fa-sort"></i></td>
                <td>{{ $coupon->name }}</td>

                <td>
                    @if ($coupon->code)
                    <span>Code</span>
                                   @else
                    <span>Deal</span>
                                   @endif
                </td>
                <td class="text-dark">{{ $coupon->authentication ?? "N/a"}}
                        {{-- @if (trim($coupon->authentication) === "featured")
                <i class="fa fa-fw fa-check-circle" style="color: blue;"></i>
            @else
                <i class="fa fa-fw fa-times-circle" style="color: red;"></i>
            @endif --}}

                </td>

                <td>{{ $coupon->language->code ??'No language' }}</td>
                <td>
                   @if ($coupon->status == "disable")
                        <i class="fa fa-fw fa-times-circle" style="color: blue;"></i>
                    @else
                        <i class="fa fa-fw fa-check-circle" style="color: green;"></i>
                    @endif
                </td>
                {{-- <td>
                <span class="badge bg-info text-dark" data-bs-toggle="tooltip" title="{{ $coupon->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                    {{ $coupon->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                </span>
                </td>
                <td>
                    <span class="badge bg-warning text-dark" data-bs-toggle="tooltip" title="{{ $coupon->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
                        {{ $coupon->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
                    </span>
                </td> --}}

                <td>
                    <a href="{{ route('employee.coupon.edit', $coupon->id) }}" class="btn btn-info btn-sm">Edit</a>
                    <a href="{{ route('employee.coupon.delete', $coupon->id) }}" onclick="return confirm('Are you sure you want to delete this!')" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th><input type="checkbox" id="select-all-footer"></th>
            <th>id</th>
            <th width="30px">#</th>
            <th>Coupon Name</th>
            <th>Deal/Code</th>
            <th>auth</th>
             <th>lang</th>
            <th>Status</th>

            <th>Action</th>
        </tr>
    </tfoot>
</table>

    </div>


    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the selected coupons?')">Delete Selected</button>
    </div>


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
        let checkboxes = document.querySelectorAll('input[name="selected_coupons[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });

    document.getElementById('select-all-footer').addEventListener('click', function(event) {
        let checkboxes = document.querySelectorAll('input[name="selected_coupons[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = event.target.checked;
        });
    });
</script>

<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('#SearchTable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

    // Enable row sorting using jQuery UI Sortable
    $("#tablecontents").sortable({
        items: "tr.row1",  // Select only rows with the 'row1' class
        cursor: 'move',
        opacity: 0.6,
        update: function() {
            sendOrderToServer();  // Call the function to send the order to the server
        }
    });

    function sendOrderToServer() {
        var order = [];
        var token = $('meta[name="csrf-token"]').attr('content');

        // Get the order of the rows
        $('tr.row1').each(function(index, element) {
            order.push({
                id: $(this).attr('data-id'),
                position: index + 1
            });
        });

        // Send the new order to the server via Ajax
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('employee.custom-sortable') }}",  // The route to handle sorting
            data: {
                order: order,
                _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                    console.log('Order updated successfully');
                } else {
                    console.log('Error updating order');
                }
            }
        });
    }
});

</script>


@endsection
