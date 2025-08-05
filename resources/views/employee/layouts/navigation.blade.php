

<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars" style="font-size: 1.2rem;"></i>
      </a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('employee.dashboard') }}" class="nav-link font-weight-bold">Dashboard</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">


    <!-- User Dropdown Menu -->
    <li class="nav-item dropdown">
      @if (Auth::check())
        <a class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <div class="user-panel d-flex align-items-center">
            <div class="image mr-2">
              <i class="fas fa-user-circle" style="font-size: 1.8rem;"></i>
            </div>
            <div class="info">
              <span class="d-block font-weight-bold">{{ Auth::user()->name }}</span>
              <small class="d-block">Employee</small>
            </div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-header">
            <div class="d-flex flex-column align-items-center">
              <i class="fas fa-user-circle fa-3x mb-2"></i>
              <h6 class="mb-0">{{ Auth::user()->name }}</h6>
              <small>{{ Auth::user()->email }}</small>
            </div>
          </div>
          <div class="dropdown-divider"></div>
          <a href="{{ route('profile.edit') }}" class="dropdown-item">
            <i class="fas fa-user mr-2"></i> My Profile
          </a>
          <a href="{{ route('profile.edit') }}" class="dropdown-item">
            <i class="fas fa-cog mr-2"></i> Settings
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      @else
        <a class="nav-link" href="{{ route('login') }}">
          <i class="far fa-user-circle mr-1"></i>
          Guest
        </a>
      @endif
    </li>
  </ul>
</nav>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('employee.dashboard') }}" class="brand-link">
    <img src="{{ asset('images/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .9; width: 33px; height: 33px; border: 2px solid rgba(255,255,255,.2);">
    <span class="brand-text font-weight-light">Employee Portal</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-3">
      <ul class="nav nav-pills nav-sidebar flex-column nav-legacy nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Dashboard -->
        <li class="nav-item">
          <a href="{{ route('employee.dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Coupons Section -->
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
              <a href="{{ route('employee.coupon') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View Coupons</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employee.coupon.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New Coupon</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Stores Section -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-store"></i>
            <p>
              Stores
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('employee.stores') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View Stores</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employee.store.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New Store</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Blog Section -->
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
              <a href="{{ route('employee.blog.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View Blogs</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employee.blog.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New Blog</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Network Section -->
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
              <a href="{{ route('employee.network') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View Networks</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employee.network.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New Network</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Categories Section -->
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
              <a href="{{ route('employee.category') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>View Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('employee.category.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add New Category</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Divider -->
        <li class="nav-header mt-3">QUICK LINKS</li>

        <!-- Quick Links -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calendar"></i>
            <p>Calendar</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>Reports</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-question-circle"></i>
            <p>Help</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
