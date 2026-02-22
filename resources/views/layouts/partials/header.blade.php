<!-- Header -->
<header class="header">
    <nav class="navbar navbar-expand-lg header-nav">
        <div class="container">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="{{ route('home') }}" class="navbar-brand logo">
                    <img src="{{ !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.png') }}"
                        class="img-fluid" alt="Logo">
                </a>
            </div>
            <div class="main-menu-wrapper">
                <div class="menu-header">
                    <a href="{{ route('home') }}" class="menu-logo">
                        <img src="{{ !empty($siteSettings['logo']) ? asset($siteSettings['logo']) : asset('assets/img/logo.png') }}"
                            class="img-fluid" alt="Logo">
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
                            <a href="{{ route('products') }}" style="text-transform: capitalize;">Products</a>
                        </li>
                    @endif
                    <!-- Always show Courses menu -->

                </ul>

                <!-- Mobile Menu Buttons -->
                <div class="mobile-menu-buttons">
                    <a class="mobile-btn-for-doctors" href="{{ route('doctor.register') }}">
                        <i class="fas fa-stethoscope"></i> For Doctors
                    </a>
                    <a class="mobile-btn-login" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a class="mobile-btn-signup" href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i> Sign Up
                    </a>
                </div>
            </div>
            <ul class="nav header-navbar-rht">
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ route('cart') }}" id="cart-icon-btn">
                        <i class="fas fa-shopping-cart"></i>
                        @php $cartCount = count(session('cart', [])); @endphp
                        @if($cartCount > 0)
                            <span class="badge bg-danger position-absolute translate-middle"
                                style="top: 10px; left: 75%;">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link btn-for-doctors" href="{{ route('doctor.register') }}">
                            <i class="fas fa-stethoscope"></i> For Doctors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-signup" href="{{ route('register') }}">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link header-login" href="{{ route('login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item dropdown has-arrow logged-item">
                        <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <span class="user-img">
                                <img class="rounded-circle" src="{{ asset('assets/img/doctors/doctor-thumb-02.jpg') }}"
                                    width="31" alt="Darren Elder">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="user-header">
                                <div class="avatar avatar-sm">
                                    <img src="{{ asset('assets/img/doctors/doctor-thumb-02.jpg') }}" alt="User Image"
                                        class="avatar-img rounded-circle">
                                </div>
                                <div class="user-text">
                                    <h6>{{ Auth::user()->name }}</h6>
                                    <p class="text-muted mb-0">Doctor</p>
                                </div>
                            </div>
                            @if(Auth::user()->role === 'doctor' || Auth::user()->is_doctor)
                                <!-- Assuming role check or similar -->
                                <a class="dropdown-item" href="{{ route('doctor.dashboard') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('doctor.profile.settings') }}">Profile Settings</a>
                            @else
                                <a class="dropdown-item" href="{{ route('patient.dashboard') }}">Dashboard</a>
                                <a class="dropdown-item" href="{{ route('profile.settings') }}">Profile Settings</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>
<!-- /Header -->