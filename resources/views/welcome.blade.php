<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'SI-JANTUNG') }}</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .glass-nav { background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .glass-card { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); }
        
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
<body class="antialiased bg-slate-50 dark:bg-[#0B1120] text-slate-900 dark:text-white overflow-hidden selection:bg-indigo-500/30">

    <!-- Background Animated Blobs -->
    <div class="fixed inset-0 z-0 pointer-events-none flex items-center justify-center overflow-hidden">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-600/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[100px] opacity-70 animate-blob"></div>
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-blue-600/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[100px] opacity-70 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 left-1/3 w-96 h-96 bg-emerald-600/20 rounded-full mix-blend-multiply dark:mix-blend-lighten filter blur-[100px] opacity-70 animate-blob animation-delay-4000"></div>
    </div>

    <!-- Header -->
    <header class="fixed top-0 left-0 w-full z-50 glass-nav transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3 group cursor-pointer">
                <div class="relative flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 shadow-lg group-hover:shadow-indigo-500/50 transition-all duration-300 transform group-hover:scale-105">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-6 w-auto object-contain z-10 brightness-0 invert">
                    <div class="absolute inset-0 rounded-full bg-white opacity-20 blur-sm"></div>
                </div>
                <span class="font-bold text-xl tracking-tight text-slate-800 dark:text-white group-hover:text-transparent group-hover:bg-clip-text group-hover:bg-gradient-to-r group-hover:from-indigo-400 group-hover:to-purple-400 transition-all duration-300">SI-JANTUNG</span>
            </div>

            @if (Route::has('login'))
                <nav class="flex gap-4 items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="relative inline-flex h-10 items-center justify-center px-6 py-2 overflow-hidden font-medium text-white transition-all duration-300 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)] transform hover:-translate-y-0.5">
                            <span class="relative z-10">Dashboard Utama</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-all duration-300 bg-white/5 border border-slate-200 dark:border-white/10 rounded-full hover:bg-white/10 hover:border-white/20 backdrop-blur-md">
                            Sign In
                        </a>
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <!-- Scroll Container -->
    <div class="h-screen w-full overflow-y-auto overflow-x-hidden snap-y snap-mandatory no-scrollbar relative z-10 scroll-smooth pt-20">
        
        <!-- Hero Section -->
        <section class="h-[calc(100vh-5rem)] w-full snap-center flex flex-col items-center justify-center px-4 relative">
            <div class="text-center w-full max-w-5xl mx-auto flex flex-col items-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800/50 text-indigo-600 dark:text-indigo-400 text-sm font-semibold tracking-wide mb-8 shadow-sm backdrop-blur-sm animate-fade-in-up">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    Sistem Otomatisasi Terpadu v2.0
                </div>

                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 leading-tight">
                    <span class="text-slate-900 dark:text-white">SI-JANTUNG</span><br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 animate-gradient-x">
                        Santai Haja Asal Gawian Tuntung
                    </span>
                </h1>
                
                <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto mb-12 leading-relaxed">
                    Platform cerdas untuk mengelola Surat Undangan, Surat Keluar, SPJ, dan Kwitansi Belanja Bappelitbang Kabupaten Tapin secara otomatis, cepat, dan efisien.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="group relative inline-flex h-14 items-center justify-center px-8 py-3 overflow-hidden font-semibold text-white transition-all duration-300 rounded-full bg-slate-900 dark:bg-white dark:text-slate-900 hover:scale-105 shadow-xl hover:shadow-2xl">
                            <span class="mr-2">Mulai Bekerja</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7-7m7 7H3"></path></svg>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="group relative inline-flex h-14 items-center justify-center px-8 py-3 overflow-hidden font-semibold text-white transition-all duration-300 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_30px_rgba(79,70,229,0.5)] transform hover:-translate-y-1">
                            <span class="mr-2">Masuk ke Sistem</span>
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7-7m7 7H3"></path></svg>
                        </a>
                    @endauth
                </div>
            </div>
            
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex flex-col items-center text-slate-400 dark:text-slate-500 opacity-50 hover:opacity-100 transition-opacity duration-300">
                <span class="text-xs font-semibold uppercase tracking-widest mb-2">Jelajahi Fitur</span>
                <div class="w-6 h-10 border-2 border-slate-400 dark:border-slate-500 rounded-full flex justify-center p-1">
                    <div class="w-1.5 h-3 bg-slate-400 dark:bg-slate-500 rounded-full animate-bounce"></div>
                </div>
            </div>
        </section>

        <!-- Feature 1: Kartu Kendali (SPJ) -->
        <section class="h-screen w-full snap-center flex items-center justify-center px-6">
            <div class="max-w-7xl w-full mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1 relative group perspective-1000">
                    <div class="absolute -inset-2 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-[2.5rem] blur-2xl opacity-20 group-hover:opacity-40 transition duration-700"></div>
                    <div class="glass-card rounded-3xl p-2 transform transition-all duration-500 group-hover:rotate-y-2 group-hover:rotate-x-2">
                        <div class="bg-slate-900/90 rounded-2xl p-6 border border-slate-700/50 shadow-inner overflow-hidden relative">
                            <!-- Mockup Header -->
                            <div class="flex items-center justify-between mb-6 border-b border-slate-700/50 pb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-500/20 flex items-center justify-center border border-blue-500/30">
                                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-slate-200">Kartu Kendali SPJ</div>
                                        <div class="text-xs text-slate-500">Realisasi Anggaran 2026</div>
                                    </div>
                                </div>
                                <div class="px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-medium">Active</div>
                            </div>
                            <!-- Mockup Body -->
                            <div class="space-y-4">
                                <div class="w-full h-24 rounded-xl bg-gradient-to-r from-blue-900/40 to-cyan-900/40 border border-blue-500/20 flex flex-col justify-center px-6 relative overflow-hidden">
                                    <div class="absolute right-0 top-0 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>
                                    <div class="text-xs text-blue-300/70 mb-1">Total Pagu Dana</div>
                                    <div class="text-2xl font-bold text-white tracking-wide">Rp 1.500.000.000</div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="h-20 rounded-xl bg-slate-800/80 border border-slate-700/50 p-4">
                                        <div class="h-2 w-1/2 bg-slate-600 rounded-full mb-3"></div>
                                        <div class="h-4 w-3/4 bg-slate-500 rounded-full mb-2"></div>
                                    </div>
                                    <div class="h-20 rounded-xl bg-slate-800/80 border border-slate-700/50 p-4">
                                        <div class="h-2 w-1/2 bg-slate-600 rounded-full mb-3"></div>
                                        <div class="h-4 w-3/4 bg-slate-500 rounded-full mb-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm font-bold tracking-wide border border-blue-200 dark:border-blue-800/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        Fitur Utama
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white leading-tight">Pantau SPJ <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-cyan-400">Lebih Akurat</span></h2>
                    <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed">
                        Kelola Surat Pertanggungjawaban secara digital. Pantau grafik realisasi anggaran secara real-time untuk memastikan setiap dana teralokasi dan tercatat dengan sempurna.
                    </p>
                    <ul class="space-y-3 mt-6">
                        <li class="flex items-center gap-3 text-slate-700 dark:text-slate-300 font-medium">
                            <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center"><svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                            Tracking Dana Real-Time
                        </li>
                        <li class="flex items-center gap-3 text-slate-700 dark:text-slate-300 font-medium">
                            <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center"><svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                            Laporan Terstruktur
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Feature 2: Potong RKPD -->
        <section class="h-screen w-full snap-center flex items-center justify-center px-6">
            <div class="max-w-7xl w-full mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 text-sm font-bold tracking-wide border border-purple-200 dark:border-purple-800/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Perencanaan Strategis
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white leading-tight">Efisiensi <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-500 to-pink-500">Potong RKPD</span></h2>
                    <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed">
                        Lakukan penyesuaian dan pemotongan Rencana Kerja Pemerintah Daerah (RKPD) langsung dari sistem. Kalkulasi instan tanpa harus membuka lembaran Excel terpisah.
                    </p>
                </div>
                <div class="relative group perspective-1000">
                    <div class="absolute -inset-2 bg-gradient-to-r from-purple-600 to-pink-500 rounded-[2.5rem] blur-2xl opacity-20 group-hover:opacity-40 transition duration-700"></div>
                    <div class="glass-card rounded-3xl p-2 transform transition-all duration-500 group-hover:-rotate-y-2 group-hover:rotate-x-2">
                        <div class="bg-slate-900/90 rounded-2xl p-6 border border-slate-700/50 shadow-inner overflow-hidden">
                            <div class="flex gap-4 h-64">
                                <!-- Sidebar Mockup -->
                                <div class="w-1/3 bg-slate-800/50 rounded-xl border border-slate-700/50 p-3 space-y-3">
                                    <div class="h-3 w-full bg-slate-700 rounded-full"></div>
                                    <div class="h-3 w-4/5 bg-slate-700 rounded-full"></div>
                                    <div class="h-3 w-3/4 bg-slate-700 rounded-full"></div>
                                    <div class="h-3 w-full bg-slate-700 rounded-full mt-6"></div>
                                </div>
                                <!-- Content Mockup -->
                                <div class="w-2/3 flex flex-col gap-3">
                                    <div class="h-16 w-full bg-gradient-to-r from-purple-900/30 to-pink-900/30 rounded-xl border border-purple-500/20 flex items-center justify-between px-4">
                                        <div class="w-20 h-3 bg-purple-400/50 rounded-full"></div>
                                        <div class="w-10 h-6 bg-purple-500/30 rounded-md"></div>
                                    </div>
                                    <div class="h-16 w-full bg-gradient-to-r from-purple-900/30 to-pink-900/30 rounded-xl border border-purple-500/20 flex items-center justify-between px-4">
                                        <div class="w-24 h-3 bg-purple-400/50 rounded-full"></div>
                                        <div class="w-10 h-6 bg-purple-500/30 rounded-md"></div>
                                    </div>
                                    <div class="flex-1 bg-slate-800/80 rounded-xl border border-slate-700/50 p-4">
                                        <div class="w-full h-full border-2 border-dashed border-slate-600/50 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Feature 3: Template Surat & Footer -->
        <section class="h-screen w-full snap-center flex flex-col justify-center px-6 relative">
            <div class="max-w-7xl w-full mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center flex-1">
                <div class="order-2 lg:order-1 relative group perspective-1000">
                    <div class="absolute -inset-2 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-[2.5rem] blur-2xl opacity-20 group-hover:opacity-40 transition duration-700"></div>
                    <div class="glass-card rounded-3xl p-2 transform transition-all duration-500 group-hover:translate-y-[-5px]">
                        <div class="bg-slate-900/90 rounded-2xl p-6 border border-slate-700/50 shadow-inner overflow-hidden relative h-72">
                            <!-- Template Header Mockup -->
                            <div class="absolute top-0 left-0 w-full h-14 border-b border-slate-700/50 bg-slate-800/50 flex items-center gap-3 px-4">
                                <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                                <div class="ml-4 h-6 flex-1 bg-slate-900 rounded-md border border-slate-700/50 flex items-center px-3">
                                    <div class="w-1/2 h-2 bg-slate-600 rounded-full"></div>
                                </div>
                            </div>
                            <!-- Document Mockup -->
                            <div class="mt-14 w-3/4 mx-auto bg-slate-100 dark:bg-[#EAEAEA] h-full rounded-t-lg shadow-lg p-6 space-y-4">
                                <div class="h-2 w-1/3 bg-slate-400 mx-auto rounded"></div>
                                <div class="h-px w-full bg-slate-800 my-4"></div>
                                <div class="h-2 w-full bg-slate-300 rounded"></div>
                                <div class="h-2 w-full bg-slate-300 rounded"></div>
                                <div class="h-2 w-4/5 bg-slate-300 rounded"></div>
                                <div class="mt-6 flex justify-end">
                                    <div class="w-20 h-16 border-2 border-slate-400 border-dashed rounded-md flex items-center justify-center text-[10px] text-slate-500 font-bold">QR Code</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="order-1 lg:order-2 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-sm font-bold tracking-wide border border-emerald-200 dark:border-emerald-800/50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                        Sistem Otomatisasi
                    </div>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 dark:text-white leading-tight">Hasilkan Surat <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-teal-400">Dalam Sekejap</span></h2>
                    <p class="text-xl text-slate-600 dark:text-slate-400 leading-relaxed">
                        Lupakan cara manual menyusun dokumen. Manfaatkan *Template Surat* yang sudah disediakan untuk menghasilkan Surat Undangan, Surat Keluar, dan Kwitansi berstandar siap cetak.
                    </p>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-emerald-500 hover:text-emerald-400 font-bold transition-colors">
                        Coba Sekarang <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7-7m7 7H3"></path></svg>
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <footer class="w-full pb-8 pt-4 text-center">
                <div class="max-w-4xl mx-auto border-t border-slate-200 dark:border-slate-800 pt-8 flex flex-col items-center gap-2">
                    <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                        &copy; {{ date('Y') }} Ibnu Litbang Bappelitbang Tapin
                    </p>
                    <p class="text-xs text-slate-400 dark:text-slate-500 flex items-center gap-2">
                        <span>SI-JANTUNG v{{ Illuminate\Foundation\Application::VERSION }}</span>
                        <span class="w-1 h-1 rounded-full bg-slate-600"></span>
                        <span>Laravel v{{ Illuminate\Foundation\Application::VERSION }}</span>
                    </p>
                </div>
            </footer>
        </section>
        
    </div>

</body>
</html>