<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('images/company/' . $company->company_logo) }}" 
                alt="{{ $company->company_name ?? '' }}" class="img-fluid">
             <h1 class="sitename">{{ $company->company_name ?? '' }}</h1>
        </a>
        <nav id="navmenu" class="navmenu">
        <ul>
            <li>
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
            </li>
            <li class="d-none">
                <a href="{{ route('menu') }}" class="{{ request()->routeIs('menu') ? 'active' : '' }}">Menu</a>
            </li>
            <li>
                <a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">Gallery</a>
            </li>
            <li>
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
            </li>
            <li>
                <a href="{{ route('book-now') }}" class="{{ request()->routeIs('book-now') ? 'active' : '' }}">Book Now</a>
            </li>
            <li>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact Us</a>
            </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <a class="cta-btn" href="{{ route('book-now') }}">Book Now</a>
    </div>
</header>