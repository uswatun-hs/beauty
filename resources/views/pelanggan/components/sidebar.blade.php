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

                <li class="nav-item">
                    <a href="{{ route('pelanggan.dashboard') }}"
                        class="nav-link {{ request()->routeIs('pelanggan.dashboard.*') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pelanggan.layanan.index') }}"
                        class="nav-link {{ request()->routeIs('pelanggan.layanan.*') ? 'active' : '' }}">
                        <i class="bi bi-brush me-2"></i>
                        <p>Layanan</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('pelanggan.keranjang.index') }}"
                        class="nav-link {{ request()->routeIs('pelanggan.keranjang.*') ? 'active' : '' }}">
                        <i class="bi bi-cart me-2"></i>
                        <p>Keranjang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pelanggan.order.index') }}"
                        class="nav-link {{ request()->routeIs('pelanggan.order.*') ? 'active' : '' }}">
                        <i class="bi bi-bag-check me-2"></i>
                        <p>Riwayat Pesanan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href=""{{ route('pelanggan.ulasan.index') }}""
                        class="nav-link {{ request()->routeIs('pelanggan.ulasan.*') ? 'active' : '' }}">
                        <i class="bi bi-star-fill me-2"></i>
                        <p>Rating & Ulasan</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
