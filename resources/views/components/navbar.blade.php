<header class="header-container p-3">
        <!-- Centered Logo -->
    <div class="logo-container d-flex justify-content-left align-items-left w-100 d-block d-lg-none">
        <a href="/">
            <img src="{{ asset('images/logo.gif') }}" alt="Logo" >
        </a>
    </div>
    <div class="social-icons">

    <a href="https://web.facebook.com/people/Coupons-Arena/61571970471132/" target="_blank"><i class="fab fa-facebook"></i></a>
    <a href="https://www.instagram.com/coupons.arena/#" target="_blank"><i class="fab fa-instagram"></i></a>
    <a href="https://x.com/couponsarena" target="_blank"><i class="fab fa-x-twitter"></i></a>
  </div>
    </div>

    <div class="logo-container d-none d-md-flex justify-content-center align-items-center w-100">
        <a href="/">
            <img src="{{ asset('images/logo.gif') }}" alt="Logo" >
        </a>
    </div>

    {{-- <div class="search-container">
<form id="searchForm" action="{{ route('search') }}" method="GET" class="d-flex" role="search">
<input type="search" class="form-control me-2"  name="query" id="searchInput" placeholder="Search Here" aria-label="Search" value="{{ old('query', request()->input('query')) }}">
<button type="submit"><i class="fas fa-search"></i></button>
</form>
    </div> --}}

    {{-- <div class="language-dropdown">
        <button class="btn btn-outline-light dropdown-toggle"> {{ strtoupper(app()->getLocale()) }} </button>
        <div class="dropdown-menu">
            @foreach ($langs as $lang)
                <a href="{{ url('/' . $lang->code) }}" class="dropdown-item ">
                    {{ strtoupper($lang->code) }}
                </a>
            @endforeach
        </div>
    </div> --}}
    <button class="navbar-toggler" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </button>
</header>

<nav class="navbar-menu" id="navbarMenu">
         <span class="close-menu" onclick="toggleMenu()">&times;</span>
         <ul class="navbar-nav">
        <li><a class="nav-link" href="{{ url(app()->getLocale() . '/') }}"></a></li>
        <li><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#categoryModal">Cateoryg</a></li>
        {{-- <li><a class="nav-link" href="{{ route('contact', ['lang' => app()->getLocale()]) }}">contact</a></li> --}}
        <li><a class="nav-link" href="{{ route('blog', ['lang' => app()->getLocale()]) }}"></a></li>
        {{-- <li><a class="nav-link" href="{{ route('store.show', ['lang' => app()->getLocale()]) }}">Stores</a></li> --}}
        <li><a class="nav-link" href="{{ route('coupons') }}">Coupons</a></li>
    </ul>
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    @foreach ($categories as $category)
              <a href="{{ route('related_category', ['slug' => Str::slug($category->slug)]) }}" class="dropdown-item">{{ $category->title }}</a>
        @endforeach
        </div>
        </div>
        </div>
        </div>

</nav>
<script>
    function toggleMenu() {
        const menu = document.getElementById('navbarMenu');
        const body = document.body;

        // Toggle the 'active' class on the menu
        menu.classList.toggle('active');

        // Check if the menu has the 'active' class
        if (menu.classList.contains('active')) {
            // Disable scrolling by adding a class to the body
            body.classList.add('no-scroll');
        } else {
            // Enable scrolling by removing the class from the body
            body.classList.remove('no-scroll');
        }
    }
</script>
