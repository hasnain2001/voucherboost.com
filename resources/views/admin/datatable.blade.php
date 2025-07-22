<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminlte.io/themes/v3/pages/tables/data.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Feb 2024 08:08:58 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('datatable-title') | DataTables</title>

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

    @yield('styles')

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link active " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-primary"></i></a>
        </li>
    </ul>


    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
        @if (Auth::check())
            <a class="nav-link navbar-username dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle text-success"></i>
            <span class="text-dark font-weight-bold">{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Profile</span>
            <div class="dropdown-divider"></div>
            <a href="{{route('profile.edit')}}" class="dropdown-item">
                <i class="fas fa-user mr-2 text-primary"></i> My Profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-2 text-danger"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </div>
        @else
            <a class="nav-link" href="{{ route('login') }}">
            <i class="far fa-user-circle"></i>
            Guest
            </a>
        @endif
        </li>
    </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('admin.dashboard') }}" class="brand-link bg-gradient-primary">
            <img src="{{ asset('images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">VoucherBoost</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link active bg-gradient-info">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Coupons Section -->
                    <li class="nav-item">
                        <a href="#" class="nav-link bg-gradient-dark">
                            <i class="nav-icon fas fa-ticket-alt"></i>
                            <p>
                                Coupons
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.coupon') }}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>All Coupons</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.coupon.create') }}" class="nav-link">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Stores Section -->
                    <li class="nav-item">
                        <a href="#" class="nav-link bg-gradient-dark">
                            <i class="nav-icon fas fa-store-alt"></i>
                            <p>
                                Stores
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.stores') }}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>All Stores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.store.create') }}" class="nav-link">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Language Section -->
                    <li class="nav-item">
                        <a href="#" class="nav-link bg-gradient-dark">
                            <i class="nav-icon fas fa-language"></i>
                            <p>
                                Languages
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.lang') }}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>All Languages</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.lang.create') }}" class="nav-link">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Blog Section -->
                    <li class="nav-item">
                        <a href="#" class="nav-link bg-gradient-dark">
                            <i class="nav-icon fas fa-blog"></i>
                            <p>
                                Blog
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.blog.show') }}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>All Posts</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.blog.create') }}" class="nav-link">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Network Section -->
                    <li class="nav-item">
                        <a href="#" class="nav-link bg-gradient-dark">
                            <i class="nav-icon fas fa-network-wired"></i>
                            <p>
                                Network
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.network') }}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>All Networks</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.network.create') }}" class="nav-link">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Categories Section -->
                    <li class="nav-item">
                        <a href="#" class="nav-link bg-gradient-dark">
                            <i class="nav-icon fas fa-list"></i>
                            <p>
                                Categories
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.category') }}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>All Categories</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.category.create') }}" class="nav-link">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- User Section -->
                    <li class="nav-item">
                        <a href="#" class="nav-link bg-gradient-dark">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.user.index') }}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.user.create') }}" class="nav-link">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Slider Section -->
                    <li class="nav-item">
                        <a href="#" class="nav-link bg-gradient-dark">
                            <i class="nav-icon fas fa-sliders-h"></i>
                            <p>
                                Sliders
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.slider') }}" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>All Sliders</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.slider.create') }}" class="nav-link">
                                    <i class="fas fa-plus-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Deleted Data Section -->
                    <li class="nav-item">
                        <a href="#" class="nav-link bg-gradient-danger">
                            <i class="nav-icon fas fa-trash-restore"></i>
                            <p>
                                Recycle Bin
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.delete_store') }}" class="nav-link">
                                    <i class="fas fa-store nav-icon"></i>
                                    <p>Deleted Stores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.delete_coupon') }}" class="nav-link">
                                    <i class="fas fa-ticket-alt nav-icon"></i>
                                    <p>Deleted Coupons</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.delete_blog') }}" class="nav-link">
                                    <i class="fas fa-blog nav-icon"></i>
                                    <p>Deleted Blogs</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>



<script>
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
@yield('scripts')
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
    </script>
</body>

<!-- Mirrored from adminlte.io/themes/v3/pages/tables/data.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Feb 2024 08:09:01 GMT -->

</html>

