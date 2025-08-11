<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminlte.io/themes/v3/pages/tables/data.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Feb 2024 08:08:58 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('datatable-title') | ADMIN DataTables</title>

   <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="/admin/dist/css/adminlte.min2167.css?v=3.2.0">

      <style>
            .sidebar-dark-primary {
            background-color: #45046a !important;

        }

        .navbar-username {
    font-size: 2rem; /* Adjust the size as needed */
}
    </style>

    @stack('styles')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
  @include('admin.layouts.navbar')
  @include('admin.layouts.aside')



        {{-- Datatable Main Content Here --}}
            @yield('datatable-content')
        {{-- Datatable Main Content Here --}}

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://employeelte.io/">employeeLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>

    @stack('scripts')
    <script src="/admin/plugins/jquery/jquery.min.js"></script>
    <script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/admin/plugins/jszip/jszip.min.js"></script>
    <script src="/admin/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/admin/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <script src="/admin/dist/js/adminlte.min2167.js?v=3.2.0"></script>

    <script src="/admin/dist/js/demo.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script>
            $(function() {
                $("#example1").DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });

                $('#SearchTable').DataTable();

                $( "#tablecontents" ).sortable({
                    items: "tr",
                    cursor: 'move',
                    opacity: 0.6,
                    update: function() {
                        sendOrderToServer();
                    }
                });

                function sendOrderToServer() {
                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');
                //   by this function User can Update hisOrders or Move to top or under
                $('tr.row1').each(function(index,element) {
                    order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                    });
                });
        // the Ajax Post update
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.custom-sortable') }}",
                        data: {
                    order: order,
                    _token: token
                    },
                    success: function(response) {
                        if (response.status == "success") {
                        console.log(response);
                        } else {
                        console.log(response);
                        }
                    }
                });
                }
            });

        // Ensure only one menu stays open at a time
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link:not(.active)');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if (this.parentElement.classList.contains('nav-item') && this.nextElementSibling && this.nextElementSibling.classList.contains('nav-treeview')) {
                        e.preventDefault();

                        // Close all other open menus
                        document.querySelectorAll('.nav-treeview').forEach(menu => {
                            if (menu !== this.nextElementSibling) {
                                menu.style.display = 'none';
                                menu.previousElementSibling.querySelector('.fa-angle-left').classList.remove('fa-angle-down');
                                menu.previousElementSibling.querySelector('.fa-angle-left').classList.add('fa-angle-left');
                            }
                        });

                        // Toggle current menu
                        const icon = this.querySelector('.fa-angle-left');
                        if (this.nextElementSibling.style.display === 'block') {
                            this.nextElementSibling.style.display = 'none';
                            icon.classList.remove('fa-angle-down');
                            icon.classList.add('fa-angle-left');
                        } else {
                            this.nextElementSibling.style.display = 'block';
                            icon.classList.remove('fa-angle-left');
                            icon.classList.add('fa-angle-down');
                        }
                    }
                });
            });
        });
    </script>

</body>

<!-- Mirrored from adminlte.io/themes/v3/pages/tables/data.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Feb 2024 08:09:01 GMT -->

</html>

