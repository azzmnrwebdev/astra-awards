<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Vite Resource --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Title --}}
    <title>{{ $title }} - Awards Amaliah</title>

    {{-- Custom CSS --}}
    <style>
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background-color: #f1f5f9;
            font-family: "Nunito Sans", sans-serif;
        }

        a {
            cursor: pointer;
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        /* Layout skeleton */
        .wrapper {
            align-items: stretch;
            display: flex;
            width: 100%;
        }

        #sidebar {
            position: fixed;
            height: 100vh;
            max-width: 280px;
            min-width: 280px;
            transition: all 0.35s ease-in-out;
            background: #1c2434;
            z-index: 1050;
        }

        /* Sidebar collapse */
        #sidebar.collapsed {
            margin-left: -280px;
        }

        .main {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            transition: all 0.35s ease-in-out;
        }

        .sidebar-logo {
            padding: 1rem 1.5rem;
        }

        .sidebar-logo a {
            color: #ffffff;
            font-weight: 600;
            font-size: 1.5rem;
            text-decoration: none;
        }

        .sidebar-logo i:hover {
            cursor: pointer;
        }

        .sidebar-nav {
            padding: 0;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 0;
        }

        .sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar-item {
            margin-left: 1.625rem;
            margin-right: 1.625rem;
        }

        a.sidebar-link {
            padding-top: 0.625rem;
            padding-bottom: 0.625rem;
            padding-left: 1rem;
            color: #dee4ee;
            position: relative;
            display: block;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        a.sidebar-link:hover,
        a.sidebar-link:focus,
        a.sidebar-link.active {
            background-color: #333a48;
        }

        .sidebar-link[data-bs-toggle="collapse"]::after {
            border: solid;
            border-width: 0 0.075rem 0.075rem 0;
            content: "";
            display: inline-block;
            padding: 2px;
            position: absolute;
            right: 1.5rem;
            top: 1.2rem;
            transform: rotate(-135deg);
            transition: all 0.2s ease-out;
        }

        .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
            transform: rotate(45deg);
            transition: all 0.2s ease-out;
        }

        /* Navbar */
        .dropdown-menu[data-bs-popper] {
            top: 100%;
        }

        .dropdown-menu {
            background-color: #1c2434;
            transition: all 0.35s ease-in-out;
        }

        .dropdown-menu li a {
            color: #dee4ee;
        }

        .dropdown-menu li a:hover {
            color: #fff;
            background-color: transparent;
        }

        .dropdown-divider {
            background-color: #dee4ee;
        }

        /* Main Content */
        .content {
            flex: 1;
            max-width: 100vw;
            width: 100vw;
        }

        .btn-close:focus {
            box-shadow: none;
        }

        .form-label {
            color: #333333;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #343a40;
            outline: #343a40 solid 1px;
        }

        .form-control:focus,
        .form-control.is-invalid:focus,
        .form-select:focus,
        .form-select.is-invalid:focus {
            box-shadow: none;
        }

        .form-control.is-invalid:focus,
        .form-select.is-invalid:focus {
            border-color: #dc3545;
            outline: #dc3545 solid 1px;
        }

        /* Pagination */
        div p.small,
        div ul.pagination {
            margin-bottom: 0;
        }

        div ul.pagination li.page-item a:focus {
            box-shadow: none !important;
        }

        /* Responsive */
        @media (min-width: 992px) {
            .content {
                width: auto;
            }

            .main {
                margin-left: 280px;
            }

            #sidebar.collapsed~.main {
                margin-left: 0;
            }
        }

        @media (max-width: 991.9px) {
            #sidebar {
                position: fixed;
                left: -280px;
                top: 0;
                height: 100%;
                z-index: 9999;
            }

            #sidebar.open {
                left: 0;
            }

            .main {
                margin-left: 0;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="wrapper">
        {{-- Sidebar --}}
        <x-admin-sidebar></x-admin-sidebar>

        {{-- Main --}}
        <div class="main">
            {{-- Navbar --}}
            <x-admin-navbar></x-admin-navbar>

            {{-- Main Content --}}
            <main class="content px-lg-2 mt-4 mb-5">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    {{-- Custom Javascript --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        const sidebar = document.getElementById("sidebar");
        const navbarToggle = document.getElementById("navbarToggle");
        const sidebarToggle = document.getElementById("sidebarToggle");

        const toggleSidebar = () => {
            const isMobile = window.innerWidth <= 991;
            sidebar.classList.toggle(isMobile ? "open" : "collapsed");
        };

        const closeSidebar = () => {
            const isMobile = window.innerWidth <= 991;
            if (isMobile) sidebar.classList.remove("open");
        };

        const handleClickOutside = (event) => {
            if (
                !sidebar.contains(event.target) &&
                !navbarToggle.contains(event.target) &&
                !sidebarToggle.contains(event.target)
            ) {
                closeSidebar();
            }
        };

        navbarToggle.addEventListener("click", toggleSidebar);
        sidebarToggle.addEventListener("click", toggleSidebar);
        document.addEventListener("click", handleClickOutside);
    </script>

    @stack('scripts')
</body>

</html>
