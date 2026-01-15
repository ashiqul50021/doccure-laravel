<!-- Header -->
<header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="navbar-header">
            <a id="mobile_btn" href="javascript:void(0);">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>
            <a href="{{ route('home') }}" class="navbar-brand logo">
                <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Logo">
            </a>
        </div>
        <div class="main-menu-wrapper">
            <div class="menu-header">
                <a href="{{ route('home') }}" class="menu-logo">
                    <img src="{{ asset('assets/img/logo.png') }}" class="img-fluid" alt="Logo">
                </a>
                <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                </a>
            </div>
            <ul class="main-nav">
                @if(isset($mainMenu) && $mainMenu->count() > 0)
                    @foreach($mainMenu as $menu)
                        @if($menu->children->count() > 0)
                            {{-- Menu with submenu --}}
                            <li class="has-submenu">
                                <a href="{{ $menu->getUrl() }}">
                                    @if($menu->icon)<i class="{{ $menu->icon }}"></i> @endif
                                    {{ $menu->title }} <i class="fas fa-chevron-down"></i>
                                </a>
                                <ul class="submenu">
                                    @foreach($menu->children as $child)
                                        <li>
                                            <a href="{{ $child->getUrl() }}" @if($child->open_in_new_tab) target="_blank" @endif>
                                                @if($child->icon)<i class="{{ $child->icon }}"></i> @endif
                                                {{ $child->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            {{-- Single menu item --}}
                            <li class="{{ request()->url() == $menu->getUrl() ? 'active' : '' }}">
                                <a href="{{ $menu->getUrl() }}" @if($menu->open_in_new_tab) target="_blank" @endif>
                                    @if($menu->icon)<i class="{{ $menu->icon }}"></i> @endif
                                    {{ $menu->title }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @else
                    {{-- Default menu if no database menus --}}
                    <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="{{ request()->routeIs('search') ? 'active' : '' }}">
                        <a href="{{ route('search') }}">Doctors</a>
                    </li>
                    <li class="{{ request()->routeIs('products*') ? 'active' : '' }}">
                        <a href="{{ route('products') }}">Products</a>
                    </li>
                @endif
            </ul>
        </div>
        <ul class="nav header-navbar-rht">
            <li class="nav-item">
                <a class="nav-link position-relative" href="{{ route('cart') }}">
                    <i class="fas fa-shopping-cart"></i>
                    @php $cartCount = count(session('cart', [])); @endphp
                    @if($cartCount > 0)
                        <span class="badge bg-danger position-absolute translate-middle" style="top: 10px; left: 75%;">{{ $cartCount }}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-for-doctors" href="{{ route('doctor.register') }}">
                    <i class="fas fa-stethoscope"></i> For Doctors
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-signup" href="{{ route('register') }}"><i class="fas fa-lock"></i> Sign Up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link header-login" href="{{ route('login') }}"><i class="fas fa-user"></i> Login</a>
            </li>
        </ul>
    </nav>
</header>
<!-- /Header -->
