@extends('employee.datatable')
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

</style>
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
                </div>
                <form method="GET" action="{{ route('employee.coupon') }}">
                    <span>Select BY Coupons  Store Name </span>
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="store" id="category-select" onchange="this.form.submit()">
                        <option value="">All Coupon</option> <!-- Option to select all stores -->
                        @foreach($couponstore as $store)
                            <option value="{{ $store->store }}" {{ $selectedCoupon == $store->store ? 'selected' : '' }} class="text-bold">
                                {{ $store->store }}
                            </option>
                        @endforeach
                    </select>
                </form>
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
            <th>Store</th>
            <!--<th>Never Expire</th>-->
            <th>Deal/Code</th>
            <th>Status</th>
            <th>create at</th>
            <th>Last Updated</th> <!-- Add this column header -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="tablecontents">
        @foreach ($coupons as $coupon)
            <tr class="row1" data-id="{{ $coupon->id }}">
                <td><input type="checkbox" name="selected_coupons[]" value="{{ $coupon->id }}"></td>
                <th scope="row">{{ $loop->iteration }}</th>
                <td class="pl-3"><i class="fa fa-sort"></i></td>
                <td>{{ $coupon->name ?:'null' }}</td>
                <td>{{ $coupon->store ?:'null' }}</td>
                <td>
                    @if ($coupon->code)
                        <span class="custom-badge bg-primary text-white">Code</span>
                    @else
                        <span class="custom-badge bg-success text-white">Deal</span>

                    @endif
                </td>
                             <!--<td>-->
                <!--    @if ($coupon->authentication == "never_expire")-->
                <!--        <i class="fa fa-fw fa-check-circle" style="color: blue;"></i>-->
                <!--    @else-->
                <!--        <i class="fa fa-fw fa-times-circle"style="color:red;"></i>-->
                <!--    @endif-->
                <!--</td>-->
                <td>
                   @if ($coupon->status == "disable")
                        <i class="fa fa-fw fa-times-circle" style="color: blue;"></i>
                    @else
                        <i class="fa fa-fw fa-check-circle" style="color: green;"></i>
                    @endif
                </td>
                       <td>
    <p class="badge bg-info text-dark" data-bs-toggle="tooltip" title="{{ $coupon->created_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
        {{ $coupon->created_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
    </p>
</td>
<td>
    <p class="badge bg-warning text-dark" data-bs-toggle="tooltip" title="{{ $coupon->updated_at->setTimezone('Asia/Karachi')->format('l, F j, Y h:i A') }}">
        {{ $coupon->updated_at->setTimezone('Asia/Karachi')->format('M d, Y h:i A') }}
    </p>
</td>

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
            <th>Store</th>
            <th>Deal/Code</th>
            <!--<th>Never Expire</th>-->
            <th>Status</th>
            <th>created at</th>
            <th>Last Updated</th> <!-- Add this column footer -->
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
