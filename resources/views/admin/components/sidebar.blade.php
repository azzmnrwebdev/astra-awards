<aside id="sidebar" class="d-flex flex-column gap-4">
    <div class="sidebar-logo d-flex align-items-center justify-content-between">
        <a wire:navigate href="{{ route('information') }}">Amaliah Astra Awards</a>
        <i class="bi bi-caret-left-fill d-lg-none text-white" id="sidebarToggle"></i>
    </div>

    <ul class="sidebar-nav h-100 overflow-y-scroll">
        <li class="sidebar-item">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-fill me-2 fs-5"></i>
                Dashboard
            </a>
        </li>

        @if (auth()->check() && auth()->user()->hasRole('admin'))
            <li class="sidebar-item">
                <a href="{{ route('categoryArea.index') }}"
                    class="sidebar-link {{ request()->routeIs('categoryArea.*') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill me-2 fs-5"></i>
                    Kategori Area
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('categoryMosque.index') }}"
                    class="sidebar-link {{ request()->routeIs('categoryMosque.*') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill me-2 fs-5"></i>
                    Kategori Masjid
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('province.index') }}"
                    class="sidebar-link {{ request()->routeIs('province.*') ? 'active' : '' }}">
                    <i class="bi bi-geo-alt-fill me-2 fs-5"></i>
                    Provinsi
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('city.index') }}"
                    class="sidebar-link {{ request()->routeIs('city.*') ? 'active' : '' }}">
                    <i class="bi bi-geo-alt-fill me-2 fs-5"></i>
                    Kota/Kabupaten
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('company.index') }}"
                    class="sidebar-link {{ request()->routeIs('company.*') ? 'active' : '' }}">
                    <i class="bi bi-building me-2 fs-5"></i>
                    Perusahaan
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('parent_company.index') }}"
                    class="sidebar-link {{ request()->routeIs('parent_company.*') ? 'active' : '' }}">
                    <i class="bi bi-diagram-3-fill me-2 fs-5"></i>
                    Induk Perusahaan
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('business_line.index') }}"
                    class="sidebar-link {{ request()->routeIs('business_line.*') ? 'active' : '' }}">
                    <i class="bi bi-briefcase-fill me-2 fs-5"></i>
                    Lini Bisnis
                </a>
            </li>

            <li class="sidebar-item">
                <a href="{{ route('committee.index') }}"
                    class="sidebar-link {{ request()->routeIs('committee.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill me-2 fs-5"></i>
                    Manajemen Panitia
                </a>
            </li>
        @endif

        <li class="sidebar-item">
            <a href="{{ route('jury.index') }}"
                class="sidebar-link {{ request()->routeIs('jury.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill me-2 fs-5"></i>
                Manajemen Juri
            </a>
        </li>

        @if (auth()->check() && auth()->user()->hasRole('admin'))
            <li class="sidebar-item">
                <a href="{{ route('user.index') }}"
                    class="sidebar-link {{ request()->routeIs('user.*') ? 'active' : '' }} mb-0">
                    <i class="bi bi-people-fill me-2 fs-5"></i>
                    Manajemen DKM
                </a>
            </li>
        @endif
    </ul>
</aside>
