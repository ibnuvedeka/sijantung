<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SI-JANTUNG') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .dark .glass-card { background: rgba(30, 41, 59, 0.7); border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }
    </style>
</head>
<body class="antialiased bg-slate-50 dark:bg-[#0B1120] text-slate-900 dark:text-white overflow-hidden min-h-screen flex items-center justify-center p-4 selection:bg-yellow-500/30 transition-colors duration-300">

    <!-- Background Animated Blobs -->
    <div class="fixed inset-0 z-0 pointer-events-none flex items-center justify-center overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-yellow-400/30 dark:bg-yellow-400/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[100px] opacity-70 animate-blob"></div>
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-green-500/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[100px] opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-yellow-300/30 dark:bg-yellow-300/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[100px] opacity-70 animate-blob animation-delay-4000"></div>
        
        <!-- Subtle pattern overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] dark:bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:20px_20px] opacity-40 mix-blend-multiply dark:mix-blend-screen"></div>
    </div>

    <div class="relative z-10 w-full flex flex-col items-center">
        <div>
            <a href="/">
                <img src="{{ asset('images/logo-sijantung.png') }}" onerror="this.src='{{ asset('images/logo.png') }}'" alt="Logo SIJANTUNG" class="h-32 w-auto mx-auto object-contain drop-shadow-[0_0_15px_rgba(255,255,255,0.8)] dark:drop-shadow-[0_0_15px_rgba(255,255,255,0.2)]">
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-8 px-8 py-8 glass-card sm:rounded-[2rem] overflow-hidden">
            {{ $slot }}
        </div>
    </div>
</body>
</html>