<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Vite Resource --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/guest.css'])

    {{-- Title --}}
    <title>{{ $title }} - Awards Amaliah</title>

    {{-- Custom CSS --}}
    <style>
        body {
            width: 100%;
            height: 100%;
            background-color: #f8fafc;
            font-family: "Inter", sans-serif;
        }

        main {
            min-height: 100vh;
            overflow: hidden;
        }
    </style>

    @stack('styles')
</head>

<body>
    <main class="container">
        {{ $slot }}
    </main>

    {{-- Custom Javascript --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    @stack('scripts')
</body>

</html>
