<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

    {{-- Vite Resource --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- Title --}}
    <title>{{ $title ? $title . ' - Amaliah Astra Awards' : 'Amaliah Astra Awards' }}</title>

    {{-- Custom CSS --}}
    <style>
        body {
            background-color: #f8fafc;
            font-family: "Inter", sans-serif;
        }

        .navbar-toggler {
            font-size: 1.125rem;
        }

        .navbar-toggler:focus,
        .navbar-toggler:active,
        .navbar-toggler-icon:focus {
            outline: none;
            box-shadow: none;
        }

        .form-label {
            color: #333333;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #004ea2;
            outline: #004ea2 solid 1px;
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

        .form-check-input:focus {
            box-shadow: none;
        }

        .form-check-input:checked {
            border-color: #004ea2;
            background-color: #004ea2;
        }

        .btn-close:focus {
            box-shadow: none;
        }
    </style>

    @stack('styles')
</head>

<body>
    {{-- Navbar --}}
    <x-user-navbar></x-user-navbar>

    {{-- Header --}}
    <x-user-header name="{{ $name }}"></x-user-header>

    {{-- Main Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Custom Javascript --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @stack('scripts')
</body>

</html>
