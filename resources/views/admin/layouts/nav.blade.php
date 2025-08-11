<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars" style="font-size: 1.2rem;"></i>
      </a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('admin.dashboard') }}" class="nav-link font-weight-bold">Dashboard</a>
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
              <small class="d-block">Admin</small>
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
