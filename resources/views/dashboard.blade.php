<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-2">
            <h2 class="font-extrabold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 leading-tight tracking-wide">
                {{ __('Dashboard SI-JANTUNG') }}
            </h2>
            <div class="text-sm text-slate-400 font-medium px-4 py-1.5 bg-slate-800/50 rounded-full border border-slate-700/50 backdrop-blur-md">
                Data real-time bulan ini
            </div>
        </div>
    </x-slot>

    <!-- Alpine Data Container for DEV Tools -->
    <div x-data="{ devModalOpen: false, xrayMode: false }" 
         x-init="$watch('xrayMode', value => {
            if(value) {
                document.body.classList.add('xray-active');
            } else {
                document.body.classList.remove('xray-active');
            }
         })"
         class="py-12 relative min-h-screen">

        <!-- Background Animated Blobs -->
        <div class="absolute inset-0 z-0 pointer-events-none flex items-center justify-center overflow-hidden">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob"></div>
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-blue-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob animation-delay-2000"></div>
        </div>

        <style>
            /* X-Ray Mode Styles */
            body.xray-active * {
                outline: 1px solid rgba(255, 0, 0, 0.5) !important;
                background: rgba(255, 0, 0, 0.05) !important;
            }
            @keyframes blob {
                0% { transform: translate(0px, 0px) scale(1); }
                33% { transform: translate(30px, -50px) scale(1.1); }
                66% { transform: translate(-20px, 20px) scale(0.9); }
                100% { transform: translate(0px, 0px) scale(1); }
            }
            .animate-blob { animation: blob 7s infinite; }
            .animation-delay-2000 { animation-delay: 2s; }
        </style>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 relative z-10 text-slate-200">
            
            <!-- Session Status Messages -->
            @if (session('success'))
                <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 shadow-sm backdrop-blur-md" role="alert">
                    <span class="font-bold">Berhasil!</span> {{ session('success') }}
                </div>
            @endif

            <!-- Alert for Roles -->
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-2xl blur-lg opacity-20 transition duration-700 group-hover:opacity-30"></div>
                <div class="relative bg-slate-900/80 backdrop-blur-xl shadow-2xl sm:rounded-2xl border-l-4 border-blue-500 border-t border-r border-b border-white/10 overflow-hidden">
                    <div class="p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                        <div>
                            @if(auth()->check() && auth()->user()->role === 'developer')
                                <h3 class="font-extrabold text-xl text-blue-400 mb-1">Halo AGUS JAWA!</h3>
                                <p class="text-slate-300">Halaman ini berisi tombol dan pengaturan khusus yang hanya bisa dilihat oleh developer.</p>
                            @else
                                <h3 class="font-extrabold text-xl text-slate-200 mb-1">Selamat Datang, {{ auth()->user()->name ?? 'Pengguna' }}!</h3>
                                <p class="text-slate-300">Ringkasan statistik data aplikasi Anda hari ini.</p>
                            @endif
                        </div>
                        @if(auth()->check() && auth()->user()->role === 'developer')
                            <button @click="devModalOpen = true" class="relative inline-flex items-center justify-center px-6 py-2.5 overflow-hidden font-semibold text-white transition-all duration-300 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-500 hover:to-indigo-500 shadow-[0_0_20px_rgba(59,130,246,0.3)] hover:shadow-[0_0_25px_rgba(59,130,246,0.5)] transform hover:-translate-y-0.5 whitespace-nowrap">
                                Secret DEV Button
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Data Surat -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-2xl blur-lg opacity-20 transition duration-700 group-hover:opacity-40"></div>
                    <div class="relative bg-slate-900/80 backdrop-blur-xl border border-white/10 p-6 rounded-2xl shadow-2xl transition-transform duration-300 hover:-translate-y-1 h-full flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <h4 class="text-slate-400 text-sm font-bold uppercase tracking-wider">Total Surat</h4>
                            <div class="p-2.5 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-xl shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-3xl font-extrabold text-white">1,284</span>
                            <span class="text-emerald-400 text-sm font-semibold ml-3 bg-emerald-500/10 px-2 py-0.5 rounded-md border border-emerald-500/20">+12%</span>
                        </div>
                    </div>
                </div>

                <!-- Pengguna -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl blur-lg opacity-20 transition duration-700 group-hover:opacity-40"></div>
                    <div class="relative bg-slate-900/80 backdrop-blur-xl border border-white/10 p-6 rounded-2xl shadow-2xl transition-transform duration-300 hover:-translate-y-1 h-full flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <h4 class="text-slate-400 text-sm font-bold uppercase tracking-wider">Pengguna Aktif</h4>
                            <div class="p-2.5 bg-purple-500/10 border border-purple-500/20 text-purple-400 rounded-xl shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-3xl font-extrabold text-white">342</span>
                            <span class="text-emerald-400 text-sm font-semibold ml-3 bg-emerald-500/10 px-2 py-0.5 rounded-md border border-emerald-500/20">+5%</span>
                        </div>
                    </div>
                </div>

                <!-- RKPD -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl blur-lg opacity-20 transition duration-700 group-hover:opacity-40"></div>
                    <div class="relative bg-slate-900/80 backdrop-blur-xl border border-white/10 p-6 rounded-2xl shadow-2xl transition-transform duration-300 hover:-translate-y-1 h-full flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <h4 class="text-slate-400 text-sm font-bold uppercase tracking-wider">Potong RKPD</h4>
                            <div class="p-2.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-3xl font-extrabold text-white">85</span>
                            <span class="text-rose-400 text-sm font-semibold ml-3 bg-rose-500/10 px-2 py-0.5 rounded-md border border-rose-500/20">-2%</span>
                        </div>
                    </div>
                </div>

                <!-- Pengunjung -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl blur-lg opacity-20 transition duration-700 group-hover:opacity-40"></div>
                    <div class="relative bg-slate-900/80 backdrop-blur-xl border border-white/10 p-6 rounded-2xl shadow-2xl transition-transform duration-300 hover:-translate-y-1 h-full flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <h4 class="text-slate-400 text-sm font-bold uppercase tracking-wider">Pengunjung</h4>
                            <div class="p-2.5 bg-amber-500/10 border border-amber-500/20 text-amber-400 rounded-xl shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                        </div>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-3xl font-extrabold text-white">4,890</span>
                            <span class="text-emerald-400 text-sm font-semibold ml-3 bg-emerald-500/10 px-2 py-0.5 rounded-md border border-emerald-500/20">+24%</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <!-- Line Chart: Trend Surat & Pengunjung -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-3xl blur-lg opacity-20 transition duration-700 group-hover:opacity-30"></div>
                    <div class="relative bg-slate-900/80 backdrop-blur-xl border border-white/10 p-6 rounded-3xl shadow-2xl h-full">
                        <h3 class="text-lg font-bold text-slate-200 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                            Grafik Trend Aktivitas
                        </h3>
                        <div class="relative h-72 w-full">
                            <canvas id="trendChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Doughnut Chart: Proporsi Data -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-pink-500 rounded-3xl blur-lg opacity-20 transition duration-700 group-hover:opacity-30"></div>
                    <div class="relative bg-slate-900/80 backdrop-blur-xl border border-white/10 p-6 rounded-3xl shadow-2xl h-full">
                        <h3 class="text-lg font-bold text-slate-200 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                            Proporsi Dokumen & RKPD
                        </h3>
                        <div class="relative h-72 w-full flex justify-center">
                            <canvas id="proporsiChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bar Chart: Statistik per Minggu -->
            <div class="relative group mt-6">
                <div class="absolute -inset-1 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-3xl blur-lg opacity-20 transition duration-700 group-hover:opacity-30"></div>
                <div class="relative bg-slate-900/80 backdrop-blur-xl border border-white/10 p-6 rounded-3xl shadow-2xl">
                    <h3 class="text-lg font-bold text-slate-200 mb-6 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Aktivitas Sistem (Mingguan)
                    </h3>
                    <div class="relative h-80 w-full">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

        </div>

        <!-- DEV MODAL PANEL -->
        @if(auth()->check() && auth()->user()->role === 'developer')
        <div x-show="devModalOpen" 
             style="display: none;"
             class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto">
            
            <!-- Backdrop -->
            <div x-show="devModalOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/80 backdrop-blur-md transition-opacity" 
                 @click="devModalOpen = false"></div>

            <!-- Modal Content -->
            <div x-show="devModalOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative bg-slate-900/90 backdrop-blur-xl rounded-2xl shadow-[0_0_50px_rgba(0,0,0,0.5)] border border-slate-700 w-full max-w-xl transform transition-all z-50 overflow-hidden">
                
                <div class="px-5 py-4 border-b border-slate-700/50 flex justify-between items-center bg-slate-800/50">
                    <h3 class="text-lg font-bold text-slate-200 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        Developer Toolbox
                    </h3>
                    <button @click="devModalOpen = false" class="text-slate-400 hover:text-slate-200 focus:outline-none transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="p-5 space-y-5 max-h-[70vh] overflow-y-auto custom-scrollbar">
                    
                    <!-- 1. Server Info -->
                    <div class="bg-slate-800/50 rounded-xl p-4 border border-slate-700/50 font-mono text-xs shadow-inner">
                        <h4 class="font-bold text-slate-300 mb-3 border-b border-slate-700 pb-2 flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                            1. System Environment
                        </h4>
                        <div class="grid grid-cols-2 gap-2 text-slate-400">
                            <div>PHP Version:</div> <div class="text-indigo-400">{{ phpversion() }}</div>
                            <div>Laravel Version:</div> <div class="text-indigo-400">{{ app()->version() }}</div>
                            <div>Environment:</div> <div class="text-indigo-400">{{ app()->environment() }}</div>
                            <div>Server Name:</div> <div class="text-indigo-400">{{ request()->getHost() }}</div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- 2. Clear Cache -->
                        <div class="bg-slate-800/30 border border-slate-700/50 rounded-xl p-4 flex flex-col justify-between">
                            <div>
                                <h4 class="font-bold text-slate-200 mb-1 text-sm">2. Quick Clear Cache</h4>
                                <p class="text-xs text-slate-400 mb-4">Bersihkan semua cache secara instant.</p>
                            </div>
                            <form action="{{ route('developer.clear-cache') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white font-medium py-2 px-3 rounded-lg transition-all shadow-lg flex justify-center items-center gap-2 text-sm border border-red-500/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Clear Cache
                                </button>
                            </form>
                        </div>

                        <!-- 3. Generate Dummy -->
                        <div class="bg-slate-800/30 border border-slate-700/50 rounded-xl p-4 flex flex-col justify-between">
                            <div>
                                <h4 class="font-bold text-slate-200 mb-1 text-sm">3. Generate Users</h4>
                                <p class="text-xs text-slate-400 mb-4">Tambahkan 5 pengguna dummy acak.</p>
                            </div>
                            <form action="{{ route('developer.generate-dummy') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 hover:to-teal-500 text-white font-medium py-2 px-3 rounded-lg transition-all shadow-lg flex justify-center items-center gap-2 text-sm border border-emerald-500/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Generate Factory
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- 4. Impersonate User -->
                    <div class="bg-slate-800/30 border border-slate-700/50 rounded-xl p-4">
                        <h4 class="font-bold text-slate-200 mb-1 text-sm">4. Impersonate User</h4>
                        <p class="text-xs text-slate-400 mb-3">Login diam-diam sebagai pengguna lain tanpa password.</p>
                        
                        <div class="space-y-2 max-h-48 overflow-y-auto pr-2 custom-scrollbar">
                            @php
                                // Ambil 5 user terakhir (kecuali user yg login sekarang)
                                $dummyUsers = \App\Models\User::where('id', '!=', auth()->id())->latest()->limit(5)->get();
                            @endphp
                            
                            @forelse($dummyUsers as $u)
                                <div class="flex items-center justify-between p-3 rounded-xl bg-slate-800/80 border border-slate-700 transition-colors hover:bg-slate-700/80">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-slate-200">{{ $u->name }}</span>
                                        <span class="text-xs text-slate-400">{{ $u->email }} <span class="px-1.5 py-0.5 rounded text-[10px] bg-slate-700 text-slate-300 ml-1">{{ $u->role }}</span></span>
                                    </div>
                                    <form action="{{ route('developer.impersonate', $u->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs bg-indigo-500/20 hover:bg-indigo-500/40 text-indigo-300 border border-indigo-500/30 px-4 py-1.5 rounded-lg transition-colors font-semibold">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="text-sm text-slate-500 text-center py-4 bg-slate-800/50 rounded-xl border border-dashed border-slate-700">Belum ada user lain. Silakan Generate Users terlebih dahulu.</div>
                            @endforelse
                        </div>
                    </div>

                    <!-- 5. X-Ray Mode -->
                    <div class="bg-slate-800/30 border border-slate-700/50 rounded-xl p-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-slate-200 mb-1 text-sm">5. UI X-Ray Mode</h4>
                                <p class="text-xs text-slate-400">Tampilkan outline merah untuk debugging layout CSS.</p>
                            </div>
                            <!-- Toggle switch (Alpine JS) -->
                            <button @click="xrayMode = !xrayMode" 
                                    :class="xrayMode ? 'bg-indigo-600 border-indigo-500' : 'bg-slate-700 border-slate-600'"
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border transition-colors duration-200 ease-in-out focus:outline-none shadow-inner">
                                <span :class="xrayMode ? 'translate-x-5 bg-white' : 'translate-x-0 bg-slate-400'" class="pointer-events-none inline-block h-5 w-5 transform rounded-full shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            
            <style>
                .custom-scrollbar::-webkit-scrollbar {
                    width: 6px;
                }
                .custom-scrollbar::-webkit-scrollbar-track {
                    background: rgba(30, 41, 59, 0.5);
                    border-radius: 4px;
                }
                .custom-scrollbar::-webkit-scrollbar-thumb {
                    background: rgba(71, 85, 105, 0.8);
                    border-radius: 4px;
                }
                .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                    background: rgba(100, 116, 139, 1);
                }
            </style>
        </div>
        @endif

    </div>

    <!-- Script for Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // For glassmorphism dark theme, we use specifically tailored colors
            const textColor = '#e2e8f0'; // slate-200
            const gridColor = 'rgba(255,255,255,0.05)';

            Chart.defaults.color = textColor;
            Chart.defaults.font.family = 'Inter, sans-serif';

            // Custom Tooltip for Glassmorphism
            const glassTooltip = {
                backgroundColor: 'rgba(15, 23, 42, 0.9)',
                titleColor: '#f8fafc',
                bodyColor: '#cbd5e1',
                borderColor: 'rgba(255,255,255,0.1)',
                borderWidth: 1,
                padding: 12,
                boxPadding: 6,
                usePointStyle: true,
            };

            // 1. Trend Line Chart
            const ctxTrend = document.getElementById('trendChart').getContext('2d');
            
            // Create gradients for lines
            const gradientBlue = ctxTrend.createLinearGradient(0, 0, 0, 400);
            gradientBlue.addColorStop(0, 'rgba(99, 102, 241, 0.4)'); // indigo-500
            gradientBlue.addColorStop(1, 'rgba(99, 102, 241, 0.0)');
            
            const gradientPurple = ctxTrend.createLinearGradient(0, 0, 0, 400);
            gradientPurple.addColorStop(0, 'rgba(168, 85, 247, 0.4)'); // purple-500
            gradientPurple.addColorStop(1, 'rgba(168, 85, 247, 0.0)');

            new Chart(ctxTrend, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'],
                    datasets: [
                        {
                            label: 'Surat Keluar',
                            data: [65, 59, 80, 81, 56, 55, 90],
                            borderColor: '#6366f1', // indigo-500
                            backgroundColor: gradientBlue,
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#6366f1',
                            pointBorderColor: '#1e293b',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        },
                        {
                            label: 'Pengunjung',
                            data: [28, 48, 40, 19, 86, 27, 100],
                            borderColor: '#a855f7', // purple-500
                            backgroundColor: gradientPurple,
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#a855f7',
                            pointBorderColor: '#1e293b',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8 } },
                        tooltip: glassTooltip
                    },
                    scales: {
                        y: { grid: { color: gridColor }, border: { display: false } },
                        x: { grid: { display: false }, border: { display: false } }
                    },
                    interaction: { mode: 'index', intersect: false }
                }
            });

            // 2. Proporsi Doughnut Chart
            const ctxProporsi = document.getElementById('proporsiChart').getContext('2d');
            new Chart(ctxProporsi, {
                type: 'doughnut',
                data: {
                    labels: ['Surat Undangan', 'Surat Keluar', 'SPJ', 'RKPD'],
                    datasets: [{
                        data: [300, 50, 100, 80],
                        backgroundColor: [
                            '#6366f1', // indigo-500
                            '#a855f7', // purple-500
                            '#14b8a6', // teal-500
                            '#f59e0b'  // amber-500
                        ],
                        borderWidth: 2,
                        borderColor: '#0f172a', // match card background
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { position: 'right', labels: { usePointStyle: true, padding: 20 } },
                        tooltip: glassTooltip
                    },
                    cutout: '75%',
                    layout: { padding: 10 }
                }
            });

            // 3. Bar Chart Aktivitas Mingguan
            const ctxBar = document.getElementById('barChart').getContext('2d');
            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [
                        {
                            label: 'Aktivitas Pengguna',
                            data: [120, 190, 300, 250, 200, 80, 50],
                            backgroundColor: '#10b981', // emerald-500
                            borderRadius: 6,
                            barPercentage: 0.6
                        },
                        {
                            label: 'Dokumen Dibuat',
                            data: [60, 100, 150, 120, 110, 30, 20],
                            backgroundColor: '#3b82f6', // blue-500
                            borderRadius: 6,
                            barPercentage: 0.6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 8 } },
                        tooltip: glassTooltip
                    },
                    scales: {
                        y: { grid: { color: gridColor }, border: { display: false } },
                        x: { grid: { display: false }, border: { display: false } }
                    }
                }
            });
        });
    </script>
</x-app-layout>
