<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SI-JANTUNG') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-login { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); border: 1px solid rgba(255, 255, 255, 0.5); }
        .dark .glass-login { background: rgba(30, 41, 59, 0.7); border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        
        .glass-yellow { background: rgba(243, 204, 46, 0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border-left: 1px solid rgba(255, 255, 255, 0.3); }
        .dark .glass-yellow { background: rgba(234, 179, 8, 0.8); border-left: 1px solid rgba(255, 255, 255, 0.1); }
        
        .glass-card-inner { background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.6); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05); }
        .dark .glass-card-inner { background: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.2); }
        
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

    <!-- Background Animated Blobs (Matching Welcome Page) -->
    <div class="fixed inset-0 z-0 pointer-events-none flex items-center justify-center overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-yellow-400/30 dark:bg-yellow-400/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[100px] opacity-70 animate-blob"></div>
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-green-500/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[100px] opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-yellow-300/30 dark:bg-yellow-300/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[100px] opacity-70 animate-blob animation-delay-4000"></div>
        
        <!-- Subtle pattern overlay -->
        <div class="absolute inset-0 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] dark:bg-[radial-gradient(#1e293b_1px,transparent_1px)] [background-size:20px_20px] opacity-40 mix-blend-multiply dark:mix-blend-screen"></div>
    </div>

    <!-- Card Container -->
    <div class="max-w-5xl w-full glass-login rounded-[2rem] shadow-2xl overflow-hidden flex flex-col md:flex-row relative z-10 transition-all duration-300 hover:shadow-yellow-500/20">
        
        <!-- Left Side: Login Form -->
        <div class="w-full md:w-5/12 p-8 md:p-12 flex flex-col justify-center relative bg-transparent">
            
            <a href="/" class="group inline-flex items-center gap-2 text-sm font-semibold text-slate-500 dark:text-slate-400 hover:text-green-600 dark:hover:text-green-400 transition-colors mb-8 w-max">
                <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800/50 group-hover:bg-green-100 dark:group-hover:bg-green-900/30 flex items-center justify-center transition-colors">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </div>
                Kembali
            </a>

            <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-400 mb-2 text-center md:text-left">Selamat Datang!</h2>
            <p class="text-slate-500 dark:text-slate-400 mb-8 text-sm text-center md:text-left font-medium">Silahkan masuk dengan akun SI-JANTUNG anda.</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Username -->
                <div class="relative group">
                    <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                           class="w-full bg-white/60 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl py-3.5 px-4 text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent focus:bg-white dark:focus:bg-slate-800 placeholder-slate-400 dark:placeholder-slate-500 text-sm transition-all shadow-sm group-hover:border-yellow-300 dark:group-hover:border-yellow-500/50" 
                           placeholder="Username">
                    <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none">
                        <!-- User icon -->
                        <svg class="h-5 w-5 text-slate-400 dark:text-slate-500 group-hover:text-yellow-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('username')" class="mt-2" />

                <!-- Password -->
                <div class="relative group">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="w-full bg-white/60 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 rounded-xl py-3.5 px-4 text-slate-700 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent focus:bg-white dark:focus:bg-slate-800 placeholder-slate-400 dark:placeholder-slate-500 text-sm transition-all shadow-sm group-hover:border-yellow-300 dark:group-hover:border-yellow-500/50" 
                           placeholder="Password">
                    <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center cursor-pointer">
                        <!-- Eye icon -->
                        <svg class="h-5 w-5 text-slate-400 dark:text-slate-500 hover:text-slate-600 dark:hover:text-slate-300 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" class="group w-full bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-300 hover:to-yellow-400 text-gray-900 font-bold py-3.5 px-4 rounded-xl transition duration-300 shadow-[0_0_15px_rgba(250,204,21,0.3)] hover:shadow-[0_0_25px_rgba(250,204,21,0.5)] text-sm flex justify-center items-center gap-2 transform hover:-translate-y-0.5">
                        Login Sekarang
                        <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7-7m7 7H3"></path></svg>
                    </button>
                </div>

                <!-- Forgot Password -->
                <div class="text-center mt-4 pb-2">
                    <button type="button" onclick="document.getElementById('forgotPasswordModal').classList.remove('hidden')" class="text-xs text-slate-500 dark:text-slate-400 hover:text-yellow-600 dark:hover:text-yellow-400 font-medium transition-colors">
                        Kamu lupa password?
                    </button>
                </div>
            </form>

            <!-- Bottom Logos -->
            <div class="mt-8 pt-6 border-t border-slate-200/60 dark:border-slate-700/60 flex justify-center items-center relative">
                <!-- Premium Glow Effect Behind Logo -->
                <div class="absolute w-24 h-24 bg-yellow-400/30 dark:bg-yellow-400/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-xl animate-pulse"></div>
                <div class="absolute w-24 h-24 bg-blue-500/30 dark:bg-blue-500/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-xl animate-pulse animation-delay-2000 translate-x-6"></div>
                
                <div class="h-24 flex items-center justify-center p-1 overflow-hidden hover:scale-105 transition-transform relative z-10">
                    <img src="{{ asset('images/logo-sijantung.png') }}" onerror="this.src='{{ asset('images/logo.png') }}'" alt="Logo SI-JANTUNG" class="h-full w-auto object-contain drop-shadow-[0_0_15px_rgba(255,255,255,0.8)] dark:drop-shadow-[0_0_15px_rgba(255,255,255,0.2)]">
                </div>
            </div>
        </div>

        <!-- Right Side: Info Panel (Glassmorphic) -->
        <div class="w-full md:w-7/12 glass-yellow p-8 md:p-10 flex flex-col justify-between relative overflow-hidden hidden md:flex">

            <!-- Illustration Area -->
            <div class="flex-grow flex items-center justify-center z-10 relative mt-4 mb-8">
                <!-- Abstract blobs behind illustration -->
                <svg class="absolute w-80 h-80 text-yellow-500/20 mix-blend-multiply dark:mix-blend-lighten animate-pulse" style="animation-duration: 4s;" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                  <path fill="currentColor" d="M45.7,-76.4C58.3,-69.3,66.9,-54.6,73.4,-40.3C79.8,-25.9,84.1,-12.9,82.8,-0.7C81.4,11.5,74.4,22.9,67.1,33.8C59.9,44.7,52.3,55.1,41.7,62.8C31.1,70.5,15.6,75.4,0.3,74.9C-15,74.4,-30,68.4,-43.3,60C-56.5,51.6,-68,40.7,-74.6,27.1C-81.1,13.5,-82.7,-2.8,-78.5,-17.1C-74.4,-31.4,-64.5,-43.8,-52.3,-51.5C-40.1,-59.2,-20,-62.3,-2.3,-58.5C15.4,-54.7,30.8,-43.9,45.7,-76.4Z" transform="translate(100 100) scale(1.1)" />
                </svg>
                
                <!-- Computer desk generic representation (Modernized) -->
                <div class="relative w-72 h-56 transform hover:scale-105 transition-transform duration-500">
                    <!-- Monitor -->
                    <div class="absolute top-6 left-12 w-36 h-24 bg-white/90 border-[3px] border-slate-800 rounded-lg z-20 shadow-xl flex items-center justify-center overflow-hidden">
                        <div class="w-full h-full bg-gradient-to-br from-green-50 to-yellow-50 p-2 flex flex-col gap-2">
                            <div class="h-2 w-1/2 bg-slate-300 rounded-full"></div>
                            <div class="h-2 w-3/4 bg-slate-200 rounded-full"></div>
                            <div class="flex-1 mt-1 bg-white rounded border border-slate-200 flex items-center justify-center">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Stand -->
                    <div class="absolute top-30 left-[6.5rem] w-6 h-8 bg-slate-800 z-10 rounded-t-sm"></div>
                    <!-- Base -->
                    <div class="absolute top-[146px] left-[5rem] w-16 h-2 bg-slate-800 rounded-full z-10 shadow-lg"></div>
                    <!-- Desk -->
                    <div class="absolute top-40 left-0 w-72 h-3 bg-white/80 border-y border-white/50 z-10 rounded-full shadow-lg backdrop-blur-sm"></div>
                    <!-- Person -->
                    <div class="absolute top-10 right-10 z-30 drop-shadow-xl">
                        <!-- Head -->
                        <div class="w-10 h-11 bg-orange-200 rounded-full border-2 border-slate-800 ml-4 mb-[-6px] relative z-40">
                            <!-- Hair -->
                            <div class="absolute top-[-2px] left-[-2px] w-11 h-6 bg-slate-800 rounded-t-full"></div>
                        </div>
                        <!-- Body -->
                        <div class="w-16 h-20 bg-green-600 rounded-t-2xl border-2 border-slate-800 relative z-30">
                            <!-- Arm -->
                            <div class="absolute top-4 left-[-12px] w-7 h-14 bg-green-600 border-2 border-slate-800 rounded-full transform -rotate-[25deg] origin-top"></div>
                        </div>
                        <!-- Legs -->
                        <div class="w-20 h-20 bg-slate-800 border-2 border-slate-800 border-l-0 absolute top-18 right-[-12px] z-20 rounded-r-xl"></div>
                        <div class="w-6 h-24 bg-slate-800 border-2 border-slate-800 border-t-0 absolute top-24 right-[5px] z-20 rounded-b-xl"></div>
                    </div>
                    <!-- Chair -->
                    <div class="absolute top-28 right-4 w-20 h-5 bg-white border-2 border-slate-800 rounded-full z-10 shadow-sm"></div>
                    <div class="absolute top-32 right-12 w-4 h-20 bg-slate-800 z-10 rounded-b-md"></div>
                </div>
            </div>

            <!-- Update History Card (Glassmorphic) -->
            <div onclick="document.getElementById('updateHistoryModal').classList.remove('hidden')" class="glass-card-inner rounded-2xl p-6 z-20 relative mx-2 mt-auto transform hover:-translate-y-1 transition-transform duration-300 cursor-pointer group">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-extrabold text-slate-800 dark:text-slate-900 flex items-center text-sm tracking-wide group-hover:text-green-700 transition-colors">
                        <span class="mr-2 text-xl">✨</span> Riwayat Pembaruan
                    </h3>
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-bold bg-green-600 text-white px-2 py-0.5 rounded-full uppercase tracking-wider shadow-sm">
                            Terbaru
                        </span>
                        <svg class="w-4 h-4 text-slate-500 group-hover:text-green-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
                
                <div class="border-l-2 border-green-600 pl-4 space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-800 dark:text-slate-900 text-sm">v2.0 (Dark Mode & UI)</span>
                        <span class="text-[10px] text-slate-700 font-semibold bg-white/60 px-2 py-0.5 rounded-md">Visual Update</span>
                    </div>
                    <ul class="text-xs text-slate-800 dark:text-slate-900 space-y-1.5 list-disc pl-4 font-medium leading-relaxed">
                        <li>Implementasi mode gelap (Dark Mode) selaras dengan Halaman Utama.</li>
                        <li>Pembaruan Tema Warna Kuning & Hijau yang modern.</li>
                        <li>Penyesuaian efek Glassmorphism untuk mode terang dan gelap.</li>
                        <li>Optimasi elemen form: penggantian ikon dan placeholder.</li>
                    </ul>
                </div>
            </div>
            
            <!-- Decorative Plant / Leaves -->
            <div class="absolute bottom-1/3 left-6 text-white/50 z-0 transform -rotate-12 scale-125 mix-blend-overlay">
                <svg width="80" height="100" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17,8C8,10 5.9,16.17 3.82,21.34L5.71,22L6.66,19.7C7.14,19.87 7.64,20 8,20C19,20 22,3 22,3C21,5 14,5.25 9,6.25C4,7.25 7,11.5 7,11.5C7,11.5 9,4 17,8Z" />
                </svg>
            </div>
        </div>
    </div>
    <!-- Forgot Password Modal -->
    <div id="forgotPasswordModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/40 dark:bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="document.getElementById('forgotPasswordModal').classList.add('hidden')"></div>
        
        <!-- Modal Card -->
        <div class="relative bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-3xl shadow-2xl w-full max-w-sm overflow-hidden transform transition-all z-10 animate-fade-in-up">
            <div class="p-8 text-center relative">
                <!-- Close cross -->
                <button type="button" class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors" onclick="document.getElementById('forgotPasswordModal').classList.add('hidden')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                <div class="w-16 h-16 mx-auto bg-yellow-100 dark:bg-yellow-900/30 rounded-2xl flex items-center justify-center mb-5 rotate-3 transform shadow-sm">
                    <svg class="w-8 h-8 text-yellow-500 dark:text-yellow-400 -rotate-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </div>
                <h3 class="text-xl font-extrabold text-slate-800 dark:text-white mb-2">Lupa Password?</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium leading-relaxed">
                    Silahkan hubungi admin <span class="font-bold text-green-600 dark:text-green-400">ADMIN IBNU</span> untuk mengatur ulang kata sandi Anda.
                </p>
                <div class="mt-8">
                    <button type="button" onclick="document.getElementById('forgotPasswordModal').classList.add('hidden')" class="w-full bg-slate-100 dark:bg-slate-700/50 hover:bg-slate-200 dark:hover:bg-slate-700 text-slate-800 dark:text-white font-bold py-3.5 px-4 rounded-xl transition duration-300 text-sm">
                        Mengerti, Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update History Modal -->
    <div id="updateHistoryModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 transition-all duration-300">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="document.getElementById('updateHistoryModal').classList.add('hidden')"></div>
        
        <!-- Modal Container -->
        <div class="relative bg-white dark:bg-slate-800 rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-hidden flex flex-col z-10 animate-fade-in-up">
            
            <!-- Header (Yellow) -->
            <div class="bg-[#FCD34D] px-6 py-5 flex items-center justify-between shrink-0 relative overflow-hidden">
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-yellow-600/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900 leading-tight">Riwayat Pembaruan</h2>
                        <p class="text-sm text-yellow-900/70 font-semibold">SI-JANTUNG (Santai Haja Asal Gawian Tuntung)</p>
                    </div>
                </div>
                <!-- Close Button -->
                <button type="button" class="relative z-10 p-2 text-yellow-900 hover:bg-yellow-500/30 rounded-full transition-colors" onclick="document.getElementById('updateHistoryModal').classList.add('hidden')">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Body (Scrollable Timeline) -->
            <div class="flex-1 overflow-y-auto p-6 sm:p-8 relative">
                <!-- Timeline Line -->
                <div class="absolute left-[39px] sm:left-[47px] top-8 bottom-8 w-px bg-slate-200 dark:bg-slate-700"></div>

                <div class="space-y-10">
                    <!-- Item: v2.0 -->
                    <div class="relative pl-12 sm:pl-16">
                        <!-- Dot -->
                        <div class="absolute left-0 top-1 w-5 h-5 rounded-full bg-green-500 border-4 border-green-100 dark:border-slate-800 shadow-sm z-10"></div>
                        
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-3 gap-2">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-lg font-bold text-slate-900 dark:text-white">v2.0</span>
                                <span class="text-[10px] font-bold text-green-700 bg-green-100 border border-green-200 px-2 py-0.5 rounded-full">● Terbaru</span>
                                <span class="text-[10px] font-bold text-green-700 bg-green-50 border border-green-100 px-2 py-0.5 rounded-full">Visual Update</span>
                            </div>
                            <span class="text-xs font-semibold text-slate-400">Juli 2026</span>
                        </div>
                        
                        <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-300">
                            <li class="flex items-start gap-2"><svg class="w-4 h-4 text-yellow-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Implementasi mode gelap (Dark Mode) selaras dengan Halaman Utama.</li>
                            <li class="flex items-start gap-2"><svg class="w-4 h-4 text-yellow-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Pembaruan Tema Warna Kuning & Hijau yang modern.</li>
                            <li class="flex items-start gap-2"><svg class="w-4 h-4 text-yellow-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Penyesuaian efek Glassmorphism untuk mode terang dan gelap.</li>
                            <li class="flex items-start gap-2"><svg class="w-4 h-4 text-yellow-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Optimasi elemen form: penggantian ikon dan placeholder.</li>
                        </ul>
                    </div>


                </div>
            </div>

            <!-- Footer -->
            <div class="border-t border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/80 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4 shrink-0">
                <span class="text-xs font-medium text-slate-500">Dikembangkan oleh ADMIN IBNU DEVELOPER</span>
                <button type="button" class="w-full sm:w-auto bg-[#FCD34D] hover:bg-yellow-400 text-yellow-900 font-bold py-2 px-6 rounded-lg transition-colors text-sm" onclick="document.getElementById('updateHistoryModal').classList.add('hidden')">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    
</body>
</html>