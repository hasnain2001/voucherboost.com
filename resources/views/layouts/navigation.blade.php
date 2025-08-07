<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
        <!-- Logo with smooth hover effect -->
        <a class="navbar-brand" href="{{ route('index',['lang' => app()->getLocale()]) }}">
            <x-application-logo style="height: 2.25rem; width: auto; color: #1a202c; transition: transform 0.3s ease;" class="hover:scale-105" />
        </a>

        <!-- Mobile Toggle with animation -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Left Side Links -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    @if (Auth::user()->role === 'admin')
                        <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'active bg-primary-100 text-primary' : 'text-gray-700 hover:bg-gray-50' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>{{ __('Dashboard') }}
                        </a>
                    @elseif (Auth::user()->role === 'employee')
                        <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('employee.dashboard') ? 'active bg-primary-100 text-primary' : 'text-gray-700 hover:bg-gray-50' }}"
                        href="{{ route('employee.dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>{{ __('Dashboard') }}
                        </a>
                    @else
                        <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('dashboard') ? 'active bg-primary-100 text-primary' : 'text-gray-700 hover:bg-gray-50' }}"
                        href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2 me-2"></i>{{ __('Dashboard') }}
                        </a>
                    @endif
                </li>
            </ul>

            <!-- Right Side Dropdown with enhanced styling -->
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="me-2 d-none d-lg-inline">
                            <div class="text-end">
                                <div class="font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-muted">{{ Auth::user()->role }}</div>
                            </div>
                        </div>
                        <div class="avatar avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2"></i>{{ __('Profile') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>{{ __('Log Out') }}
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .avatar {
        width: 32px;
        height: 32px;
        font-weight: 600;
    }
    .navbar {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }
    .dropdown-menu {
        border-radius: 0.5rem;
    }
    .nav-link.active {
        font-weight: 500;
    }
</style>
