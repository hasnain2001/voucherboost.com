<nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <a class="navbar-brand {{ request()->is('/') ? 'active' : '' }}" href="/">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is(app()->getLocale().'/stores') ? 'active' : '' }}" 
              href="{{ route('stores', ['lang' => app()->getLocale()]) }}" 
              aria-current="page" wire:navigate>
              Stores
           </a>
          </li>
<li class="mega-dropdown d-none d-sm-block">
<a href="#" class=" dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
<div class="dropdown-menu mega-menu" aria-labelledby="navbarDropdown">
<div class="row">
@foreach ($categories as $category)
<div class="col-md-4">
<a href="{{ route('related_category', ['slug' => Str::slug($category->slug)]) }}" class=" text-dark">{{ $category->title }}</a>
</div>
@endforeach
</div>
</div>
</li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('/coupon') ? 'active' : '' }}" href="{{ route('coupon') }}"  >Coupons</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('/blog') ? 'active' : '' }}" href="{{ route('blog') }}"  >Blog</a>
          </li>
        
        </ul>
<form id="searchForm" action="{{ route('search') }}" method="GET" class="d-flex" role="search">
<input type="search" class="form-control me-2"  name="query" id="searchInput" placeholder="Search Here" aria-label="Search" value="{{ old('query', request()->input('query')) }}">
<button type="submit"><i class="fas fa-search"></i></button>
</form>
      </div>
    </div>
  </nav>

  {{-- <header>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand text-primary fw-bold" href="#">
      
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    @auth
                        @if(Auth::user()->role === 'employee')
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-primary rounded-pill px-3" href="{{ route('employee.dashboard') }}">
                                    Employee Dashboard
                                </a>
                            </li>
                        @elseif(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-danger rounded-pill px-3" href="{{ route('admin.dashboard') }}">
                                    Admin Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-secondary rounded-pill px-3" href="{{ route('dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-success rounded-pill px-3" href="{{ route('login') }}">
                                Log in
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item ">
                                <a class="nav-link btn btn-outline-success rounded-pill px-3" href="{{ route('register') }}">
                                    Register
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header> --}}