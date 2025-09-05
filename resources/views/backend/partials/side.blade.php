<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">

        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ url('assets/frontend/media/images/logo.png') }}" alt="Vesper Look">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">
                <img style="width: 50px; height: auto;" src="{{ url('assets/backend/assets/img/vesper_look.jpg') }}"
                    alt="Vesper Look">
            </a>
        </div>

        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>

            {{-- Banner Side Menu --}}
            <li class="menu-header">Banner</li>
            <li class="dropdown {{ Route::is('banner.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-image"></i><span>Banner</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('banner.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('banner.index') }}">All Banner</a>
                    </li>
                    <li class="{{ Route::is('banner.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('banner.create') }}">Create Banner</a>
                    </li>
                </ul>
            </li>

            {{-- Category Side Menu --}}
            <li class="menu-header">Category </li>
            <li class="dropdown {{ Route::is('category.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-list"></i><span>Category </span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('category.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('category.index') }}">All Category </a>
                    </li>
                    <li class="{{ Route::is('category.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('category.create') }}">Create Category </a>
                    </li>
                </ul>
            </li>

            {{-- SubCategory Side Menu --}}
            <li class="menu-header">Sub Category </li>
            <li class="dropdown {{ Route::is('sub-category.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-list"></i><span>Sub Category
                    </span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('sub-category.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('sub-category.index') }}">All Sub Category </a>
                    </li>
                    <li class="{{ Route::is('sub-category.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('sub-category.create') }}">Create Sub Category </a>
                    </li>
                </ul>
            </li>

            {{-- Product Side Menu --}}
            <li class="menu-header">Products </li>
            <li class="dropdown {{ Route::is('products.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fab fa-product-hunt"></i><span>Product
                    </span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('products.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('products.index') }}">All Product </a>
                    </li>
                    <li class="{{ Route::is('products.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('products.create') }}">Create Product </a>
                    </li>
                </ul>
            </li>

            {{-- User Menu --}}
            <li class="menu-header">Users </li>
            <li class="dropdown {{ Route::is('users.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i><span>User </span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('users.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.index') }}">All User </a>
                    </li>
                    <li class="{{ Route::is('users.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('users.create') }}">Create User </a>
                    </li>
                </ul>
            </li>

            {{-- Coupons Discount --}}
            <li class="menu-header">Discount Coupons </li>
            <li class="dropdown {{ Route::is('coupon.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ticket-alt"></i><span>Coupons
                    </span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::is('coupon.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('coupon.index') }}">All Coupons</a>
                    </li>
                    <li class="{{ Route::is('coupon.create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('coupon.create') }}">Create Coupon </a>
                    </li>
                </ul>
            </li>

            {{-- Orders --}}
            <li class="menu-header">Orders</li>
            <li class="dropdown {{ Route::is('orders.index') ? 'active' : '' }}">
                <a href="{{ route('orders.index') }}" class="nav-link">
                    <i class="fas fa-credit-card"></i><span>All Order</span>
                </a>
            </li>

            {{-- For settings --}}
            <li class="menu-header">Settings </li>
            <li class="dropdown {{ Route::is('admin.setting.*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-wrench"></i><span>Setting </span></a>
                <ul class="dropdown-menu">
                    {{-- General Settings --}}
                    <li class="{{ Route::is('admin.setting.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.setting.index') }}">Settings</a>
                    </li>
                    {{-- About shop --}}
                    <li class="{{ Route::is('admin.setting.about.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.setting.about.index') }}">About Shop </a>
                    </li>
                    {{-- Return Policy --}}
                    <li class="{{ Route::is('admin.setting.order.return.policy') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.setting.order.return.policy') }}">Return Policy</a>
                    </li>
                    {{-- Privacy Policy --}}
                    <li class="{{ Route::is('admin.setting.return.porlicy') ? 'active' : '' }}">
                        <a href="{{ route('admin.setting.privacy.policy') }}" class="nav-link">Privacy Policy</a>
                    </li>

                </ul>
            </li>


        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://vesperlook.com" target="_blank" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Vesper Look
            </a>
        </div>
    </aside>
</div>
