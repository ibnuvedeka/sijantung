<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 dark:text-gray-100 antialiased bg-gray-50 dark:bg-[#0f172a] overflow-hidden">
        
        <div class="fixed inset-0 z-0 pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-600/20 blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] rounded-full bg-purple-600/20 blur-[120px]"></div>
        </div>

        <div class="relative min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 z-10">
            <div>
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo SIJANTUNG" class="h-60 w-auto mx-auto object-contain">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-8 backdrop-blur-xl bg-white/40 dark:bg-gray-800/40 border border-white/20 dark:border-gray-700/50 shadow-2xl ring-1 ring-black/5 overflow-hidden sm:rounded-3xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>