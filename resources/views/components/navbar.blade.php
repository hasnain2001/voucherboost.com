<section class=" text-capitalize">
        <!-- Header -->
    <div class="header text-capitalize ">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url(app()->getlocale().'/') }}">
            <img src="{{asset('images/logo.png')}}" alt="">
            {{-- <span class="logo">VoucherBoost</span> --}}
        </a>

        <!-- Mobile Menu Toggle -->
        <div class="mobile-nav-toggle" onclick="toggleMobileNav()">
            <i class="bi bi-list"></i>
        </div>

        <!-- Search Bar -->
        <div class="search-bar d-flex d-none d-md-flex">
            <form id="searchForm" action="{{ route('search') }}" method="GET" role="search">
                <input type="text" class="form-control" name="query" id="searchInput" placeholder="@lang('nav.Search here')" aria-label="Search" value="{{ old('query', request()->input('query')) }}">
                <button class="btn" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
        <!-- Right Section -->
        <div class="nav-right d-flex align-items-center header-links">
            <a href="{{route('FREE-DELIVERY',['lang' => app()->getLocale()])}}"><span class="me-3 ">@lang('nav.FREE DELIVERY')</span></a>
            <a href="{{route('20-off-offers',['lang' => app()->getLocale()])}}"><span class="me-3 ">@lang('nav.20% OFFERS')</span></a>

        <!-- Language Dropdown -->
        <div class=" order-0 order-md-1 d-flex justify-content-center justify-content-md-end text-capitalize">
           <div class="dropdown language-selector ">
            <button class="btn dropdown-toggle d-flex align-items-center text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('uploads/flags/' . $langs->firstWhere('code', app()->getLocale())->flag) }}" width="22" height="15" class="me-2 rounded shadow-sm" style="object-fit:cover;" loading="lazy">
                <span class="fw-semibold text-capitalize">{{ $langs->firstWhere('code', app()->getLocale())->name ?? null }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow">
                    @foreach ($langs as $lang)
                    <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{ url('/' . $lang->code) }}">
                        <img src="{{ asset('uploads/flags/' . $lang->flag) }}" width="22" height="15" class="rounded shadow-sm" loading="lazy" style="object-fit:cover;">
                        <span class="text-dark">{{ $lang->name }}  <small class="text-muted">({{ strtoupper($lang->code) }})</small></span>
                    </a>
                    </li>
                    @endforeach
            </ul>
            </div>
        </div>
        </div>

    </div>

    <!-- Mobile Nav Menu -->
    <div class="mobile-nav" id="mobileNav">
        <a href="#"  onclick="toggleMobileNav()"><i class="bi bi-x"></i> </a>
        <img src="{{asset('images/logo.png')}}" alt="">
        <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url(app()->getlocale().'/') }}">@lang('nav.home')</a>
        <a  class="@if(Route::currentRouteName() == 'stores') active @endif" href="{{route('stores', ['lang' => app()->getLocale()])}}">@lang('nav.stores')</a>
        <a  class="@if(Route::currentRouteName() == 'blog') active @endif" href="{{route('blog', ['lang' => app()->getLocale()])}}">@lang('nav.blogs')</a>
        <a  class="@if(Route::currentRouteName() == 'categories') active @endif" href="{{route('categories')}}">@lang('nav.cateories')</a>
        <a  class="@if(Route::currentRouteName() == 'about') active @endif" href="{{route('about', ['lang' => app()->getLocale()])}}">@lang('nav.about')</a>
        <a  class="@if(Route::currentRouteName() == 'contact') active @endif" href="{{route('contact', ['lang' => app()->getLocale()])}}">@lang('nav.contact')</a>
            <!-- Search Bar -->
            <div class="search-bar d-flex text-dark">
                <form id="searchForm" action="{{ route('search') }}" method="GET" role="search">
                    <input type="text" class="form-control text-dark" name="query" id="searchInput" placeholder="@lang('nav.Search here')" aria-label="Search" value="{{ old('query', request()->input('query')) }}">
                    <button class="btn" type="submit"><i class="bi bi-search"></i></button>
                </form>
            </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar text-capitalize">
        <div class="container-fluid">
            <div class="nav-container">
                <!-- Left: Nav Items (Now aligned left) -->
        <div class="nav-links">
        <div class="nav-item">
            <a class="{{ request()->is(app()->getLocale()) || request()->is(app()->getLocale() . '/') ? 'active' : '' }}"
            href="{{ url(app()->getLocale().'/') }}">
                @lang('nav.home')
            </a>
        </div>

        <div class="nav-item"><a class="@if(Route::currentRouteName() == 'stores') active @endif" href="{{route('stores', ['lang' => app()->getLocale()])}}">@lang('nav.stores')</a></div>
        <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'categories') active @endif" href="{{route('categories')}}">@lang('nav.cateories')</a></div>
        <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'blog') active @endif" href="{{route('blog', ['lang' => app()->getLocale()])}}">@lang('nav.blogs')</a></div>
        <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'coupons') active @endif" href="{{route('coupons', ['lang' => app()->getLocale()])}}">@lang('nav.coupon') </a></div>
        <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'about') active @endif" href="{{route('about', ['lang' => app()->getLocale()])}}">@lang('nav.about')</a></div>
        <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'contact') active @endif" href="{{route('contact', ['lang' => app()->getLocale()])}}">@lang('nav.contact')</a></div>
        </div>

        <!-- Right: Categories Button -->
        <div class="dropdown  d-none d-md-flex">
            <button class=" category-btn dropdown-toggle d-flex align-items-center gap-2" type="button" id="categoriesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-grid"></i> @lang('nav.cateories')
            </button>
            <ul class="dropdown-menu mega-dropdown shadow border-0 p-3 rounded-3" aria-labelledby="categoriesDropdown">
                <div class="container">
                    <div class="row">
                        @foreach ($allcategories as $category)
                            <div class="col-12 col-sm-4 col-md-5">
                                <a class="dropdown-item  rounded d-flex align-items-center "
                                href="{{ route('related_category', ['slug' => Str::slug($category->slug)]) }}">
                                    <i class="bi bi-tag"></i> {{ $category->title }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </ul>
        </div>

    <div class="d-flex gap-2">
            @auth
                <div class="icon-text d-flex gap-1 m-3">
                    <i class="bi bi-speedometer2"></i>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">@lang('nav.Dashboard')</a>
                    @elseif(auth()->user()->role === 'employee')
                        <a href="{{ route('employee.dashboard') }}" class="text-decoration-none">@lang('nav.Dashboard')</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-decoration-none">@lang('nav.Dashboard')</a>
                    @endif
                </div>
            @else
                <div class="icon-text d-flex gap-1 m-3">
                    <i class="bi bi-power"></i>
                    <a href="{{ route('login') }}" class="text-decoration-none">@lang('nav.Login')</a>
                </div>
                <div class="icon-text d-flex gap-1 m-3">
                    <i class="bi bi-person-plus"></i>
                    <a href="{{ route('register') }}" class="text-decoration-none">@lang('nav.register')</a>
                </div>
            @endauth
            </div>
        </div>
    </nav>
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
</section>

