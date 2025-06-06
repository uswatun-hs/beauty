<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('pelanggan.dashboard') }}" class="brand-link">
            <img src="{{ asset('dist/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <span class="brand-text fw-light">Beauty Online</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item menu-open">
                    <a href="{{ route('pelanggan.dashboard') }}" ...>Dashboard</a>

                    <a href="{{ route('pelanggan.layanan.index') }}"
                        class="nav-link {{ request()->routeIs('pelanggan.layanan.*') ? 'active' : '' }}">
                        Layanan
                    </a>



                   

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-star-fill"></i>
                        <p>Rating & Ulasan</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
