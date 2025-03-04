<section class=" text-capitalize">
    <!-- Header -->
<div class="header text-capitalize ">
    <!-- Logo -->
    <a class="navbar-brand" href="/">
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
    <img src="{{asset('images/logo.png')}}" alt="">
    <a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
    <a  class="@if(Route::currentRouteName() == 'stores') active @endif" href="{{route('stores')}}">Stores</a>
    <a  class="@if(Route::currentRouteName() == 'blog') active @endif" href="{{route('blog')}}">blog</a>
    <a  class="@if(Route::currentRouteName() == 'categories') active @endif" href="{{route('categories')}}">Categories</a>
    <a  class="@if(Route::currentRouteName() == 'about') active @endif" href="{{route('about')}}">About Us</a>
    <a  class="@if(Route::currentRouteName() == 'contact') active @endif" href="{{route('contact')}}">Contact Us</a>
        <!-- Search Bar -->
        <div class="search-bar d-flex">
            <form id="searchForm" action="{{ route('search') }}" method="GET" role="search">
                <input type="text" class="form-control" name="query" id="searchInput" placeholder="Search Here" aria-label="Search" value="{{ old('query', request()->input('query')) }}">
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
    <div class="nav-item"><a class="{{ request()->is('/') ? 'active' : '' }}" href="/">Home</a></div>
    <div class="nav-item"><a class="@if(Route::currentRouteName() == 'stores') active @endif" href="{{route('stores')}}">Stores</a></div>
    <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'categories') active @endif" href="{{route('categories')}}">Categories</a></div>
    <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'blog') active @endif" href="{{route('blog')}}">blog</a></div>
    <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'coupons') active @endif" href="{{route('coupons')}}">coupons </a></div>
    <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'about') active @endif" href="{{route('about')}}">About Us</a></div>
    <div class="nav-item"><a  class="@if(Route::currentRouteName() == 'contact') active @endif" href="{{route('contact')}}">Contact Us</a></div>
    </div>

<!-- Right: Categories Button -->
<div class="dropdown  d-none d-md-flex">
    <button class="btn btn-primary category-btn dropdown-toggle d-flex align-items-center gap-2" type="button" id="categoriesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-grid"></i> Categories
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

<!-- Custom Styles -->


    </div>
</nav>
<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
</section>
<script>
    // Get the button:
let mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}
    // Function to toggle mobile nav
    function toggleMobileNav() {
        const mobileNav = document.getElementById('mobileNav');
        mobileNav.classList.toggle('active');
    }
</script>
