<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SI-JANTUNG') }}</title>
    <meta name="description" content="SI-JANTUNG — Platform cerdas untuk mengelola Surat Undangan, Surat Keluar, SPJ, dan Kwitansi Belanja Bappelitbang Kabupaten Tapin secara otomatis, cepat, dan efisien.">
    <link rel="icon" href="{{ asset('images/favicon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/js/welcome.js'])

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: #0B1120;
            color: #F1F5F9;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        ::selection {
            background: rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body>

    <div id="welcome-app"></div>

    <script>
        window.__APP_DATA__ = {
            isAuth: @json(auth()->check()),
            hasLogin: @json(Route::has('login')),
            loginUrl: @json(Route::has('login') ? route('login') : '#'),
            dashboardUrl: @json(url('/dashboard')),
            logoUrl: @json(asset('images/logo.png')),
            appVersion: @json(Illuminate\Foundation\Application::VERSION),
        };
    </script>

</body>
</html>