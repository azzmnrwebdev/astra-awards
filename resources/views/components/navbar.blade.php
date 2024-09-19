<nav class="navbar navbar-expand-lg bg-white sticky-top" style="border-bottom: 2px solid rgb(0 0 0 / 0.05)">
    <div class="container">
        <a class="navbar-brand" href="{{ route('information') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="150">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                @if (auth()->check() && auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('information') ? 'active' : '' }}"
                        href="{{ route('information') }}">Informasi</a>
                </li>

                @if ((auth()->check() && auth()->user()->hasRole('admin')) || auth()->user()->hasRole('user'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('form.*') ? 'active' : '' }}"
                            href="{{ route('form.index') }}">Formulir</a>
                    </li>
                @endif

                @if (auth()->check() && auth()->user()->hasRole('jury') || auth()->user()->hasRole('user'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('presentation') ? 'active' : '' }}"
                            href="{{ route('presentation') }}">Presentasi</a>
                    </li>
                @endif
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button type="submit" class="border-0 bg-transparent text-dark dropdown-item">
                                    Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
