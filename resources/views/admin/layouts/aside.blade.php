

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
