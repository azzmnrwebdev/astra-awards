<nav class="navbar navbar-expand px-lg-2 bg-white shadow-sm" style="padding-top: 14px; padding-bottom: 14px">
    <button id="navbarToggle" class="btn border-0" type="button">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="javascript:void(0);" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>

            <ul class="dropdown-menu dropdown-menu-end border-0 shadow me-2">
                <li>
                    <a class="dropdown-item fw-medium" href="{{ route('dashboard_profile.index') }}">
                        <i class="bi bi-person-fill pe-2"></i>Profil Saya
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="border-0 bg-transparent text-white dropdown-item fw-medium">
                            <i class="bi bi-power pe-2"></i>Keluar Aplikasi
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
