<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from adminlte.io/themes/v3/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Feb 2024 08:07:49 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') | VoucherBoost  </title>
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">







    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="../../../code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min2167.css?v=3.2.0') }}">

    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
      <style>
            .sidebar-dark-primary {
                background-color: #45046a !important;

        }

        .navbar-username {
    font-size: 2.40rem; /* Adjust the size as needed */
}


    </style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-primary"></i></a>
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
          <a href="{{ route('profile.edit') }}" class="dropdown-item">
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
          <a  href="{{ route('admin.dashboard') }}" class="brand-link">
                <img src="{{ asset('images/logo.png') }}" alt="dashboard"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">VoucherBoost</span>
            </a>
           <div class="sidebar">
  <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'admin.dashboard') active @endif" href="{{ route('admin.dashboard') }}" >
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-ticket-alt"></i>
                                <p>
                                    Coupons
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">


                                <li class="nav-item">
                                    <a href="{{ route('admin.coupon') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Coupons</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.coupon.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Coupons</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-store-alt"></i>
                                <p>
                                    Stores
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('admin.stores') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Stores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.store.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Stores</p>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-language"></i>
                                <p>
                                    lang
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('admin.lang') }}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="text-white">lang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.lang.create') }}" class="nav-link ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p class="text-white">Add New lang</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-blog"></i>
                                <p>
                                    Blog
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">


                            <li class="nav-item">
                            <a href="{{ route('admin.blog.show') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Blog</p>
                            </a>
                            </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.blog.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Blog</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-network-wired"></i>
                                <p>
                                    Network
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                            <li class="nav-item">
                                    <a href="{{ route('admin.network') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Network</p>
                                    </a>
                                    </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.network.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Network</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Categories
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.category') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.category.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add New Categories</p>
                                    </a>
                                </li>


                            </ul>
                        </li>

                      <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-alt"></i>
                            <p>
                                User
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">


                            <li class="nav-item">
                                <a href="{{ route('admin.user.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.user.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New user</p>
                                </a>
                            </li>


                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-sliders-h"></i>
                            <p>
                                Slider
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.slider') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Slider</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.slider.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New slider</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-store-alt"></i>
                                <p>
                                    Deleted Stores
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                   <li class="nav-item">
                                    <a href="{{ route('admin.delete_store') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delete Store</p>
                                    </a>
                                    <a href="{{ route('admin.delete_coupon') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delete Coupon</p>
                                    </a>
                                    <a href="{{ route('admin.delete_blog') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delete blog</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </li>
                    </ul>
 </nav>

            </div>

        </aside>
        {{-- Main Content Here --}}
            @yield('main-content')
        {{-- Main Content Here --}}


        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io/">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>
    <!-- Add this before the closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
{{-- <script>
    // Initialize Flatpickr
    flatpickr("#ending_date", {
        dateFormat: "Y-m-d", // Custom format
        altInput: true, // Show a user-friendly display
        altFormat: "F j, Y", // Example: January 1, 2025
        minDate: "today", // Prevent selecting past dates
        allowInput: true // Allow manual entry
    });
</script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
    <script src="{{ asset('js/cke-ditor.js') }}">

    </script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote(
             {height:400,
            }
        ); // Replace '#summernote' with the ID of your textarea
    });
</script>
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>


    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>

    <script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <script src="{{ asset('admin/dist/js/adminlte2167.js?v=3.2.0') }}"></script>

    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>

    <script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>
</body>


</html>
