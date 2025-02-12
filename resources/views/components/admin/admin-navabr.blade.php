    <!-- ========== Topbar Start ========== -->
    <div class="navbar-custom">
        <div class="topbar">
            <div class="topbar-menu d-flex align-items-center gap-1">

                <!-- Topbar Brand Logo -->
                <div class="logo-box">
                    <!-- Brand Logo Light -->
                    <a href="{{route('admin.dashboard')}}" class="logo-light">
                        <img src="{{asset('assets/images/logo-light.png')}}" alt="logo" class="logo-lg">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo" class="logo-sm">
                    </a>

                    <!-- Brand Logo Dark -->
                    <a href="{{route('admin.dashboard')}}" class="logo-dark">
                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="dark logo" class="logo-lg">
                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo" class="logo-sm">
                    </a>
                </div>

                <!-- Sidebar Menu Toggle Button -->
                <a href="{{route('admin.dashboard')}}" class="logo-dark">
                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="small logo" class="logo-sm" height="40">
                </a>

                <!-- Dropdown Menu -->
                <div class="dropdown d-none d-xl-block">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        Create New
                        <i class="mdi mdi-chevron-down ms-1"></i>
                    </a>
                    <div class="dropdown-menu">
                        <!-- Add New Coupons -->
                        <a href="{{route('admin.coupon.create')}}" class="dropdown-item">
                            <i class="fas fa-tags me-1"></i>
                            <span>Add New Coupons</span>
                        </a>
                
                        <!-- Add New Stores -->
                        <a href="{{route('admin.store.create')}}" class="dropdown-item">
                            <i class="fas fa-store me-1"></i>
                            <span>Add New Stores</span>
                        </a>
                
                        <!-- Add New Network -->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fas fa-network-wired me-1"></i>
                            <span>Add New Network</span>
                        </a>
                
                        <div class="dropdown-divider"></div>
                
                        <!-- Add New Categories -->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fas fa-th-large me-1"></i>
                            <span>Add New Categories</span>
                        </a>
                
                        <!-- Add New Blog -->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class="fas fa-file-alt me-1"></i>
                            <span>Add New Blog</span>
                        </a>
                                <!-- Add New language -->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <i class=" fas fa-globe-europe me-1"></i>
                            <span>Add New language</span>
                        </a>
                    </div>
                </div>
                

                <!-- Mega Menu Dropdown -->
                <div class="dropdown dropdown-mega d-none d-xl-block">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        Mega Menu
                        <i class="mdi mdi-chevron-down  ms-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-megamenu">
                        <div class="row">
                            <div class="col-sm-8">

                                <div class="row">
                              
                                    <div class="col-md-12">
                                        <h5 class="text-dark mt-0">Pages</h5>
                                        <ul class="list-unstyled megamenu-list">
                                            <li>
                                                <a href="{{route('admin.coupon')}}">Coupons</a>
                                            </li>
                                            <li>
                                                <a href="{{route('admin.stores')}}"> Stores</a>
                                            </li>
                                           
                                         
                                        
                                      
                                            <li>
                                                <a href="javascript:void(0);">Categories</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Users</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Network</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Blogs</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);">Languages</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                       
                        </div>
                    </div>
                </div>
            </div>

            <ul class="topbar-menu d-flex align-items-center">
                <!-- Topbar Search Form -->
                {{-- <li class="app-search dropdown me-3 d-none d-lg-block">
                    <form>
                        <input type="search" class="form-control rounded-pill" placeholder="Search..." id="top-search">
                        <span class="fe-search search-icon font-22"></span>
                    </form>
                    <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h5 class="text-overflow mb-2">Found 22 results</h5>
                        </div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-home me-1"></i>
                            <span>Analytics Report</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-aperture me-1"></i>
                            <span>How can I help you?</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings me-1"></i>
                            <span>User profile settings</span>
                        </a>

                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow mb-2 text-uppercase">Users</h6>
                        </div>

                        <div class="notification-list">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="d-flex align-items-start">
                                    <img class="d-flex me-2 rounded-circle" src="assets/images/users/user-2.jpg" alt="Generic placeholder image" height="32">
                                    <div class="w-100">
                                        <h5 class="m-0 font-14">Erwin E. Brown</h5>
                                        <span class="font-12 mb-0">UI Designer</span>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="d-flex align-items-start">
                                    <img class="d-flex me-2 rounded-circle" src="assets/images/users/user-5.jpg" alt="Generic placeholder image" height="32">
                                    <div class="w-100">
                                        <h5 class="m-0 font-14">Jacob Deo</h5>
                                        <span class="font-12 mb-0">Developer</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </li> --}}

                <!-- Fullscreen Button -->
                <li class="d-none d-md-inline-block">
                    <a class="nav-link waves-effect waves-light" href="" data-toggle="fullscreen">
                        <i class="fe-maximize font-22"></i>
                    </a>
                </li>

                <!-- Search Dropdown (for Mobile/Tablet) -->
                <li class="dropdown d-lg-none">
                    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ri-search-line font-22"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                        <form class="p-3">
                            <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                        </form>
                    </div>
                </li>

                <!-- App Dropdown -->
                {{-- <li class="dropdown d-none d-md-inline-block">
                    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-grid font-22"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                        <div class="p-2">
                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/slack.png" alt="slack">
                                        <span>Slack</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/github.png" alt="Github">
                                        <span>GitHub</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/dribbble.png" alt="dribbble">
                                        <span>Dribbble</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/bitbucket.png" alt="bitbucket">
                                        <span>Bitbucket</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/dropbox.png" alt="dropbox">
                                        <span>Dropbox</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#">
                                        <img src="assets/images/brands/g-suite.png" alt="G Suite">
                                        <span>G Suite</span>
                                    </a>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div>
                </li> --}}

                {{-- <!-- Language flag dropdown  -->
                <li class="dropdown d-none d-md-inline-block">
                    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{asset('assets/images/flags/us.jpg')}}" alt="user-image" class="me-0 me-sm-1" height="18">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="{{asset('assets/images/flags/germany.jpg')}}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                        </a>

                    </div>
                </li> --}}

         

                <!-- Light/Darj Mode Toggle Button -->
                <li class="d-none d-sm-inline-block">
                    <div class="nav-link waves-effect waves-light" id="light-dark-mode">
                        <i class="ri-moon-line font-22"></i>
                    </div>
                </li>

                <!-- User Dropdown -->
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="user-image" class="rounded-circle">
                        <span class="ms-1 d-none d-md-inline-block">
                            Geneva <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>My Account</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>Settings</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-lock"></i>
                            <span>Lock Screen</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>

                <!-- Right Bar offcanvas button (Theme Customization Panel) -->
                <li>
                    <a class="nav-link waves-effect waves-light" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
                        <i class="fe-settings font-22"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ========== Topbar End ========== -->