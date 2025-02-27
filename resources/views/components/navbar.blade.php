<section class=" text-capitalize">
    <!-- Header -->
<div class="header text-capitalize ">
    <!-- Logo -->
    <a class="navbar-brand" href="/">
        <img src="https://dt2sdf0db8zob.cloudfront.net/wp-content/uploads/2019/08/dc-logo.png" alt="">
    </a>

    <!-- Mobile Menu Toggle -->
    <div class="mobile-nav-toggle" onclick="toggleMobileNav()">
        <i class="bi bi-list"></i>
    </div>

    <!-- Search Bar -->
    <div class="search-bar d-flex">
        <form id="searchForm" action="{{ route('search') }}" method="GET" role="search">
            <input type="text" class="form-control" name="query" id="searchInput" placeholder="Search Here" aria-label="Search" value="{{ old('query', request()->input('query')) }}">
            <button class="btn" type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>


    <!-- Right Section -->
    <div class="nav-right d-flex align-items-center header-links">
<a href="{{route('FREE-DELIVERY')}}"><span class="me-3 ">FREE DELIVERY</span></a>
<a href="{{route('20-off-offers')}}"><span class="me-3 ">20% OFFERS</span></a>
    </div>
</div>

<!-- Mobile Nav Menu -->
<div class="mobile-nav" id="mobileNav">
    <a href="#"  onclick="toggleMobileNav()"><i class="bi bi-x"></i> </a>
    <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
    <a  class="@if(Route::currentRouteName() == 'stores') active @endif" href="{{route('stores')}}">Stores</a>
    <a  class="@if(Route::currentRouteName() == 'blog') active @endif" href="{{route('blog')}}">blog</a>
    <a  class="@if(Route::currentRouteName() == 'categories') active @endif" href="{{route('categories')}}">Categories</a>
    <a  class="@if(Route::currentRouteName() == 'about') active @endif" href="{{route('about')}}">About Us</a>
    <a  class="@if(Route::currentRouteName() == 'contact') active @endif" href="{{route('contact')}}">Contact Us</a>
</div>

<!-- Navbar -->
<nav class="navbar text-capitalize">
    <div class="container-fluid">
        <div class="nav-container">
            <!-- Left: Nav Items (Now aligned left) -->
    <div class="nav-links">
    <div class="nav-item"><a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Home</a></div>
    <div class="nav-item"><a class="@if(Route::currentRouteName() == 'stores') active @endif" href="{{route('stores')}}">Stores</a></div>
    <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'categories') active @endif" href="{{route('categories')}}">Categories</a></div>
    <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'blog') active @endif" href="{{route('blog')}}">blog</a></div>
    <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'coupons') active @endif" href="{{route('coupons')}}">coupons </a></div>
    <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'about') active @endif" href="{{route('about')}}">About Us</a></div>
    <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'contact') active @endif" href="{{route('contact')}}">Contact Us</a></div>
    </div>
            <!-- Right: Categories Button -->
            <button class="category-btn"><i class="bi bi-grid"></i> Categories</button>
        </div>
    </div>
</nav>
</section>
<script>
    // Function to toggle mobile nav
    function toggleMobileNav() {
        const mobileNav = document.getElementById('mobileNav');
        mobileNav.classList.toggle('active');
    }
</script>
