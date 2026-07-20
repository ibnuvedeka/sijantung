<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Sistem Kartu Kendali (Prototype)') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Premium Navigation Tabs -->
        <div class="flex space-x-2 mb-6 bg-white/60 dark:bg-gray-800/60 backdrop-blur-lg p-2 rounded-2xl shadow-sm border border-white/40 dark:border-gray-700/50 relative z-10">
            <button onclick="showSection('dashboard')" id="tab-dashboard" class="nav-link w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5">
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </div>
            </button>
            @if(auth()->check() && auth()->user()->role === 'developer')
            <button onclick="showSection('transaksi')" id="tab-transaksi" class="nav-link w-full sm:w-auto px-6 py-3 hover:bg-white dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 font-medium rounded-xl transition-all duration-300">
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Input Transaksi
                </div>
            </button>
            @endif
            <button onclick="showSection('laporan')" id="tab-laporan" class="nav-link w-full sm:w-auto px-6 py-3 hover:bg-white dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 font-medium rounded-xl transition-all duration-300">
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Cetak Laporan
                </div>
            </button>
        </div>

        <div class="bg-white/80 dark:bg-gray-800/90 backdrop-blur-xl p-8 shadow-2xl shadow-indigo-100/20 dark:shadow-none rounded-3xl border border-white/50 dark:border-gray-700 min-h-[500px] relative overflow-hidden">
            <!-- Decorative background blob -->
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 rounded-full bg-gradient-to-br from-blue-100/40 to-purple-100/40 dark:from-blue-900/20 dark:to-purple-900/20 blur-3xl pointer-events-none"></div>
            
            <div id="dashboard" class="content-section block relative z-10 animate-fade-in-up">
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h3 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">Ringkasan Pagu RKA</h3>
                        <p class="text-gray-500 dark:text-gray-400 mt-2">Pantau realisasi anggaran secara real-time.</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-6 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-2xl border border-blue-100/50 dark:border-blue-800/50 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="p-3 bg-blue-500 text-white rounded-xl shadow-lg shadow-blue-500/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="block text-sm font-semibold text-blue-900/70 dark:text-blue-300 uppercase tracking-wider">Total Pagu</span>
                        </div>
                        <span id="dash-pagu" class="text-3xl font-black text-blue-700 dark:text-blue-400 truncate block">Rp 0</span>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/30 dark:to-orange-900/30 rounded-2xl border border-amber-100/50 dark:border-amber-800/50 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="p-3 bg-amber-500 text-white rounded-xl shadow-lg shadow-amber-500/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </div>
                            <span class="block text-sm font-semibold text-amber-900/70 dark:text-amber-300 uppercase tracking-wider">Terserap</span>
                        </div>
                        <span id="dash-realisasi" class="text-3xl font-black text-amber-600 dark:text-amber-400 truncate block">Rp 0</span>
                    </div>
                    <div class="p-6 bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/30 dark:to-teal-900/30 rounded-2xl border border-emerald-100/50 dark:border-emerald-800/50 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="p-3 bg-emerald-500 text-white rounded-xl shadow-lg shadow-emerald-500/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="block text-sm font-semibold text-emerald-900/70 dark:text-emerald-300 uppercase tracking-wider">Sisa Saldo</span>
                        </div>
                        <span id="dash-sisa" class="text-3xl font-black text-emerald-600 dark:text-emerald-400 truncate block">Rp 0</span>
                    </div>
                </div>
                
                <div class="mt-10">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                        <h4 class="font-bold text-xl text-gray-800 dark:text-white flex items-center gap-2 w-full md:w-auto">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Rincian RKA yang Terserap
                        </h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3 mb-4">
                        <select id="dashboard-kegiatan" onchange="updateSubKegiatanDropdown('dashboard'); renderDashboard()" class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white shadow-sm transition-all">
                            <option value="">-- Filter Kegiatan --</option>
                        </select>
                        <select id="dashboard-sub-kegiatan" onchange="updateRekeningDropdown('dashboard'); renderDashboard()" class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white shadow-sm transition-all">
                            <option value="">-- Filter Sub Kegiatan --</option>
                        </select>
                        <select id="dashboard-rekening" onchange="renderDashboard()" class="w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white shadow-sm transition-all">
                            <option value="">-- Filter Rekening --</option>
                        </select>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" id="search-rka" onkeyup="renderDashboard()" placeholder="Cari teks bebas..." 
                                class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500 transition-all shadow-sm">
                        </div>
                    </div>
                    <div class="overflow-x-auto rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm bg-white dark:bg-gray-800">
                        <table class="min-w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700/50">
                                <tr>
                                    <th class="py-4 px-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kegiatan & Sub</th>
                                    <th class="py-4 px-5 text-left text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Rekening</th>
                                    <th class="py-4 px-5 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pagu</th>
                                    <th class="py-4 px-5 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Terserap</th>
                                    <th class="py-4 px-5 text-right text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Sisa Saldo</th>
                                </tr>
                            </thead>
                            <tbody id="dash-rincian" class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                                <!-- Data rincian dimuat js -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if(auth()->check() && auth()->user()->role === 'developer')
            <div id="transaksi" class="content-section d-none relative z-10 animate-fade-in-up">
                <div class="mb-8">
                    <h3 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">Input Realisasi Anggaran</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Catat pengeluaran belanja berdasarkan rekening.</p>
                </div>
                
                <form id="form-transaksi" class="max-w-2xl bg-white/50 dark:bg-gray-800/50 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Kegiatan</label>
                            <select id="transaksi-kegiatan" onchange="updateSubKegiatanDropdown('transaksi')" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50/50 dark:bg-gray-900/50 dark:border-gray-600 text-gray-900 dark:text-white transition-all shadow-sm py-2.5"></select>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Sub Kegiatan</label>
                            <select id="transaksi-sub-kegiatan" onchange="updateRekeningDropdown('transaksi')" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50/50 dark:bg-gray-900/50 dark:border-gray-600 text-gray-900 dark:text-white transition-all shadow-sm py-2.5"></select>
                        </div>
                        <div class="col-span-1 md:col-span-2 relative">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Rekening RKA</label>
                            <select id="transaksi-rekening" onchange="updateInfoSaldo()" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50/50 dark:bg-gray-900/50 dark:border-gray-600 text-gray-900 dark:text-white transition-all shadow-sm py-2.5"></select>
                            <div id="info-saldo" class="absolute right-0 top-0 text-xs px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-bold transform -translate-y-2 translate-x-2 hidden"></div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                            <input type="date" id="transaksi-tanggal" required class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50/50 dark:bg-gray-900/50 dark:border-gray-600 dark:text-white transition-all shadow-sm py-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Jumlah (Rp)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-500 font-semibold">Rp</span>
                                </div>
                                <input type="number" id="transaksi-jumlah" required class="w-full pl-12 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50/50 dark:bg-gray-900/50 dark:border-gray-600 dark:text-white transition-all shadow-sm py-2.5" placeholder="0">
                            </div>
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Uraian Belanja</label>
                            <textarea id="transaksi-uraian" required rows="3" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50/50 dark:bg-gray-900/50 dark:border-gray-600 dark:text-white transition-all shadow-sm py-2.5 resize-none" placeholder="Masukkan uraian belanja..."></textarea>
                        </div>
                    </div>
                    
                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
            @endif

            <div id="laporan" class="content-section d-none relative z-10 animate-fade-in-up">
                <div class="mb-8 no-print">
                    <h3 class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-indigo-600 dark:from-blue-400 dark:to-indigo-400">Laporan Kartu Kendali</h3>
                    <p class="text-gray-500 dark:text-gray-400 mt-2">Filter dan cetak laporan realisasi anggaran ke PDF.</p>
                </div>
                
                <div class="bg-gray-50/80 dark:bg-gray-900/50 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 mb-8 no-print flex flex-col md:flex-row gap-4 items-end shadow-sm">
                    <div class="w-full md:w-1/3">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Kegiatan</label>
                        <select id="laporan-kegiatan" onchange="updateSubKegiatanDropdown('laporan')" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white dark:bg-gray-800 dark:border-gray-600 py-2 text-sm text-gray-900 dark:text-white"></select>
                    </div>
                    <div class="w-full md:w-1/3">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Sub Kegiatan</label>
                        <select id="laporan-sub-kegiatan" onchange="updateRekeningDropdown('laporan')" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white dark:bg-gray-800 dark:border-gray-600 py-2 text-sm text-gray-900 dark:text-white"></select>
                    </div>
                    <div class="w-full md:w-1/3">
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Rekening</label>
                        <select id="laporan-rekening" class="w-full rounded-lg border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 bg-white dark:bg-gray-800 dark:border-gray-600 py-2 text-sm text-gray-900 dark:text-white"></select>
                    </div>
                    
                    <div class="flex gap-2 w-full md:w-auto">
                        <button onclick="renderLaporan()" class="bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 hover:text-indigo-600 font-bold px-4 py-2 rounded-lg shadow-sm transition-colors text-sm whitespace-nowrap">
                            Tampilkan
                        </button>
                        <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-2 rounded-lg shadow-lg shadow-indigo-500/20 transition-all flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            PDF
                        </button>
                    </div>
                </div>
                
                <!-- Print Area for Report -->
                <div id="print-area" class="print:block bg-white dark:bg-gray-800 p-8 md:p-10 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 min-h-[400px]">
                    <div class="text-center mb-10 pb-6 border-b-2 border-gray-200 dark:border-gray-700 no-print">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <p class="text-gray-500 italic">Pilih filter dan klik "Tampilkan" untuk melihat preview laporan</p>
                    </div>
                    
                    <div id="laporan-content" class="hidden text-gray-900 dark:text-white print:text-black">
                        <div class="text-center mb-6 print-header hidden print:block">
                            <h2 class="text-xl font-bold uppercase">Laporan Kartu Kendali</h2>
                            <p class="text-sm">Realisasi Anggaran SKPD</p>
                            <div class="border-b-2 border-black w-full mt-4 mb-1"></div>
                            <div class="border-b border-black w-full mb-6"></div>
                        </div>
                        
                        <div id="laporan-header" class="mb-6 text-sm"></div>
                        
                        <table class="w-full text-sm border-collapse border border-gray-800 dark:border-gray-300 mb-6">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700 print:bg-gray-100 print:text-black">
                                    <th class="border border-gray-800 dark:border-gray-300 print:border-black py-2 px-3">No</th>
                                    <th class="border border-gray-800 dark:border-gray-300 print:border-black py-2 px-3">Tanggal</th>
                                    <th class="border border-gray-800 dark:border-gray-300 print:border-black py-2 px-3 text-left">Uraian</th>
                                    <th class="border border-gray-800 dark:border-gray-300 print:border-black py-2 px-3 text-right">Jumlah (Rp)</th>
                                    <th class="border border-gray-800 dark:border-gray-300 print:border-black py-2 px-3 text-right">Sisa Saldo (Rp)</th>
                                </tr>
                            </thead>
                            <tbody id="laporan-body">
                                <!-- Data Laporan -->
                            </tbody>
                        </table>
                        
                        <div class="flex justify-end mt-12 text-sm text-gray-900 dark:text-white print:text-black">
                            <div class="text-center">
                                <p class="mb-16">Dicetak pada: <span id="tgl-cetak"></span></p>
                                <p class="font-bold border-b border-black dark:border-white print:border-black inline-block min-w-[150px] pb-1">Pengguna Anggaran</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Transaksi -->
    <div id="edit-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 backdrop-blur-sm hidden transition-opacity">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 w-full max-w-lg mx-4 animate-fade-in-up">
            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Edit Transaksi</h3>
            <form id="form-edit-transaksi" class="space-y-4">
                <input type="hidden" id="edit-id">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                    <input type="date" id="edit-tanggal" required class="w-full rounded-xl border-gray-200 focus:border-indigo-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white py-2">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Uraian Belanja</label>
                    <textarea id="edit-uraian" required rows="2" class="w-full rounded-xl border-gray-200 focus:border-indigo-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white py-2 resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Jumlah (Rp)</label>
                    <input type="number" id="edit-jumlah" required class="w-full rounded-xl border-gray-200 focus:border-indigo-500 bg-gray-50 dark:bg-gray-900 dark:border-gray-600 dark:text-white py-2">
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="tutupModalEdit()" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition-colors font-medium">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-lg shadow-indigo-500/30 transition-all font-medium">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

<style>
    /* MENGGUNAKAN d-none AGAR SIDEBAR TAILWIND TIDAK HANCUR */
    .d-none { display: none !important; }

    @page {
        size: landscape;
        margin: 15mm;
    }
    
    @media print {
        ::-webkit-scrollbar { display: none !important; }
        * { scrollbar-width: none !important; }

        .no-print { display: none !important; }
        nav, header { display: none !important; }
        
        body, main, .py-8, .max-w-7xl, .bg-white\/80, .dark\:bg-gray-800\/90 { 
            background: transparent !important; 
            padding: 0 !important; 
            margin: 0 !important; 
            box-shadow: none !important;
            border: none !important;
            max-width: 100% !important;
            min-height: 0 !important;
        }

        #print-area { 
            box-shadow: none !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            min-height: 0 !important;
        }

        table { page-break-inside: auto; }
        tr { page-break-inside: avoid; page-break-after: auto; }
        thead { display: table-header-group; }
        tfoot { display: table-footer-group; }
        
        #print-area, #print-area * { color: black !important; border-color: black !important; }
    }
</style>

<script>
    // --- 1. SINKRONISASI LANGSUNG DENGAN DATABASE MYSQL ---
    // Mengubah data dari PHP Eloquent menjadi Array JavaScript secara otomatis
    const dbRKA = @json($rkas);
    const dbTransaksi = @json($transaksis);
    const isDeveloper = @json(auth()->check() && auth()->user()->role === 'developer');

    window.onload = function() {
        renderDropdowns();
        renderDashboard();
    };

    function formatRupiah(n) { return new Intl.NumberFormat('id-ID', {style:'currency', currency:'IDR'}).format(n); }

    // Fungsi pindah antar Tab 
    window.showSection = function(id) {
        document.querySelectorAll('.content-section').forEach(el => el.classList.add('d-none'));
        document.getElementById(id).classList.remove('d-none');
        
        document.querySelectorAll('.nav-link').forEach(el => {
            el.className = "nav-link w-full sm:w-auto px-6 py-3 hover:bg-white dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 font-medium rounded-xl transition-all duration-300";
        });
        
        let activeTab = document.getElementById('tab-' + id);
        if(activeTab) {
            activeTab.className = "nav-link w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-all duration-300 transform hover:-translate-y-0.5";
        }
        
        if(id === 'dashboard') renderDashboard();
    }

    function renderDashboard() {
        let totalPagu = dbRKA.reduce((a, b) => a + Number(b.pagu), 0);
        let totalSisa = dbRKA.reduce((a, b) => a + Number(b.sisa), 0);
        document.getElementById('dash-pagu').innerText = formatRupiah(totalPagu);
        document.getElementById('dash-realisasi').innerText = formatRupiah(totalPagu - totalSisa);
        document.getElementById('dash-sisa').innerText = formatRupiah(totalSisa);

        // Menampilkan rincian RKA yang sudah terserap
        let tbody = document.getElementById('dash-rincian');
        let searchKeyword = (document.getElementById('search-rka')?.value || '').toLowerCase();
        
        let filterKegiatan = document.getElementById('dashboard-kegiatan')?.value || '';
        let filterSubKegiatan = document.getElementById('dashboard-sub-kegiatan')?.value || '';
        let filterRekening = document.getElementById('dashboard-rekening')?.value || '';

        if (tbody) {
            tbody.innerHTML = '';
            let terserapData = dbRKA.filter(x => (Number(x.pagu) - Number(x.sisa)) > 0);
            
            // Filter dropdown
            if (filterKegiatan) {
                terserapData = terserapData.filter(x => x.kegiatan === filterKegiatan);
            }
            if (filterSubKegiatan) {
                terserapData = terserapData.filter(x => x.sub_kegiatan === filterSubKegiatan);
            }
            if (filterRekening) {
                // Rekening filter is ID
                terserapData = terserapData.filter(x => x.id === Number(filterRekening));
            }

            // Filter teks
            if (searchKeyword) {
                terserapData = terserapData.filter(x => 
                    (x.kegiatan || '').toLowerCase().includes(searchKeyword) ||
                    (x.sub_kegiatan || '').toLowerCase().includes(searchKeyword) ||
                    (x.kode || '').toLowerCase().includes(searchKeyword) ||
                    (x.nama || '').toLowerCase().includes(searchKeyword)
                );
            }
            
            if (terserapData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="py-10 text-center text-gray-500 italic">Belum ada realisasi anggaran</td></tr>';
            } else {
                terserapData.forEach(item => {
                    let realisasi = Number(item.pagu) - Number(item.sisa);
                    
                    let transHtml = '';
                    let itemTrans = dbTransaksi.filter(t => t.rka_id === item.id);
                    if(itemTrans.length > 0) {
                        transHtml = '<ul class="mt-2 list-disc pl-4 text-xs text-gray-500 dark:text-gray-400 space-y-1">';
                        itemTrans.forEach(t => {
                            let crudButtons = '';
                            if (isDeveloper) {
                                crudButtons = `
                                <div class="flex gap-2">
                                    <button onclick="bukaModalEdit(${t.id})" class="flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 border border-blue-200 dark:border-blue-800/30 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50 px-2.5 py-1.5 rounded-md transition-all shadow-sm" title="Edit transaksi">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        Edit
                                    </button>
                                    <button onclick="hapusTransaksi(${t.id})" class="flex items-center gap-1.5 text-xs font-semibold text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 border border-red-200 dark:border-red-800/30 dark:bg-red-900/30 dark:text-red-400 dark:hover:bg-red-900/50 px-2.5 py-1.5 rounded-md transition-all shadow-sm" title="Hapus transaksi">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Hapus
                                    </button>
                                </div>`;
                            }
                            transHtml += `<li class="flex justify-between items-center bg-white dark:bg-gray-800 rounded-lg px-3 py-2 mb-2 border border-gray-200 dark:border-gray-700 shadow-sm transition-all hover:shadow-md">
                                <span class="text-sm font-medium text-gray-800 dark:text-gray-200">${t.uraian} <span class="font-bold text-gray-900 dark:text-white">(${formatRupiah(t.jumlah)})</span></span>
                                ${crudButtons}
                            </li>`;
                        });
                        transHtml += '</ul>';
                    }

                    tbody.innerHTML += `
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="py-3 px-5 align-top">
                                <div class="font-semibold text-gray-800 dark:text-gray-200">${item.kegiatan}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">${item.sub_kegiatan}</div>
                            </td>
                            <td class="py-3 px-5 align-top">
                                <div class="text-xs font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded inline-block text-gray-600 dark:text-gray-300 mb-1">${item.kode}</div>
                                <div class="text-sm font-medium text-gray-700 dark:text-gray-300">${item.nama}</div>
                                ${transHtml}
                            </td>
                            <td class="py-3 px-5 text-right font-bold text-gray-700 dark:text-gray-300 align-top">${formatRupiah(item.pagu)}</td>
                            <td class="py-3 px-5 text-right font-semibold text-amber-600 dark:text-amber-400 align-top">${formatRupiah(realisasi)}</td>
                            <td class="py-3 px-5 text-right font-bold text-emerald-600 dark:text-emerald-400 align-top">${formatRupiah(item.sisa)}</td>
                        </tr>
                    `;
                });
            }
        }
    }

    function getUnique(arr) {
        return [...new Set(arr)];
    }

    function renderDropdowns() {
        let kegiatanList = getUnique(dbRKA.map(x => x.kegiatan).filter(Boolean));
        let opts = '<option value="">-- Filter Kegiatan --</option>';
        kegiatanList.forEach(k => opts += `<option value="${k}">${k}</option>`);
        
        ['transaksi', 'laporan'].forEach(type => {
            let el = document.getElementById(`${type}-kegiatan`);
            if(el) {
                el.innerHTML = opts;
                document.getElementById(`${type}-sub-kegiatan`).innerHTML = '<option value="">-- Filter Sub Kegiatan --</option>';
                document.getElementById(`${type}-rekening`).innerHTML = '<option value="">-- Filter Rekening --</option>';
            }
        });

        // KHUSUS DASHBOARD: Hanya tampilkan dropdown yang memiliki data realisasi
        let terserapData = dbRKA.filter(x => (Number(x.pagu) - Number(x.sisa)) > 0);
        let dashKegiatanList = getUnique(terserapData.map(x => x.kegiatan).filter(Boolean));
        let dashOpts = '<option value="">-- Filter Kegiatan --</option>';
        dashKegiatanList.forEach(k => dashOpts += `<option value="${k}">${k}</option>`);
        
        if (document.getElementById('dashboard-kegiatan')) {
            document.getElementById('dashboard-kegiatan').innerHTML = dashOpts;
            document.getElementById('dashboard-sub-kegiatan').innerHTML = '<option value="">-- Filter Sub Kegiatan --</option>';
            document.getElementById('dashboard-rekening').innerHTML = '<option value="">-- Filter Rekening --</option>';
        }
    }

    window.updateSubKegiatanDropdown = function(type) {
        let keg = document.getElementById(`${type}-kegiatan`).value;
        let dataSumber = (type === 'dashboard') ? dbRKA.filter(x => (Number(x.pagu) - Number(x.sisa)) > 0) : dbRKA;
        let subKegList = getUnique(dataSumber.filter(x => x.kegiatan === keg).map(x => x.sub_kegiatan).filter(Boolean));
        
        let opts = '<option value="">-- Filter Sub Kegiatan --</option>';
        subKegList.forEach(sk => opts += `<option value="${sk}">${sk}</option>`);
        
        document.getElementById(`${type}-sub-kegiatan`).innerHTML = opts;
        document.getElementById(`${type}-rekening`).innerHTML = '<option value="">-- Filter Rekening --</option>';
        if (type === 'transaksi') updateInfoSaldo();
    }

    window.updateRekeningDropdown = function(type) {
        let keg = document.getElementById(`${type}-kegiatan`).value;
        let subKeg = document.getElementById(`${type}-sub-kegiatan`).value;
        
        let dataSumber = (type === 'dashboard') ? dbRKA.filter(x => (Number(x.pagu) - Number(x.sisa)) > 0) : dbRKA;
        let rkaList = dataSumber.filter(x => x.kegiatan === keg && x.sub_kegiatan === subKeg);
        let opts = '<option value="">-- Filter Rekening --</option>';
        rkaList.forEach(x => opts += `<option value="${x.id}">${x.kode} - ${x.nama}</option>`);
        
        document.getElementById(`${type}-rekening`).innerHTML = opts;
        if (type === 'transaksi') updateInfoSaldo();
    }

    window.updateInfoSaldo = function() {
        let id_rka = Number(document.getElementById('transaksi-rekening').value);
        let item = dbRKA.find(x => x.id === id_rka);
        let el = document.getElementById('info-saldo');
        if(item) {
            el.innerText = `Sisa: ${formatRupiah(item.sisa)}`;
            el.className = item.sisa > 0 ? "absolute right-0 top-0 text-xs px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold transform -translate-y-2 translate-x-2" : "absolute right-0 top-0 text-xs px-3 py-1 rounded-full bg-red-50 text-red-700 border border-red-200 font-bold transform -translate-y-2 translate-x-2";
        } else { 
            el.classList.add('hidden'); 
        }
    }

// --- PROSES SIMPAN REAL TIME KE MYSQL MENGGUNAKAN AJAX FETCH ---
    document.getElementById('form-transaksi').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // 1. Ambil value ID dari dropdown (diubah menjadi format Number)
        let id_rka = Number(document.getElementById('transaksi-rekening').value); 
        let nom = Number(document.getElementById('transaksi-jumlah').value);
        
        // 2. Cari kecocokan data RKA berdasarkan ID, bukan kode rekening lagi
        let idx = dbRKA.findIndex(x => x.id === id_rka);

        if(!id_rka) { alert("Pilih rekening dulu!"); return; }
        if(nom > dbRKA[idx].sisa) { alert("Saldo tidak mencukupi! Sisa pagu tinggal " + formatRupiah(dbRKA[idx].sisa)); return; }

        // 3. Siapkan bungkusan data untuk dikirim ke Controller Laravel
        const dataKirim = {
            id: id_rka,             // PENTING: Kirim ID spesifik agar tidak salah potong Sub Kegiatan
            kode: dbRKA[idx].kode,  // Tetap kirim kode aslinya untuk dicatat sebagai bukti di tabel transaksi
            tanggal: document.getElementById('transaksi-tanggal').value,
            uraian: document.getElementById('transaksi-uraian').value,
            jumlah: nom
        };

        try {
            const response = await fetch("{{ route('kartukendali.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Token pengaman Laravel
                },
                body: JSON.stringify(dataKirim)
            });

            if(response.ok) {
                alert("Transaksi Berhasil Disimpan ke Database MySQL!");
                window.location.reload(); // Reload halaman agar hitungan data MySQL terupdate di layar
            } else {
                const resData = await response.json();
                alert("Gagal menyimpan: " + (resData.message || "Terjadi kesalahan"));
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan jaringan.");
        }
    });

    window.hapusTransaksi = async function(id) {
        if(!confirm("Yakin ingin menghapus transaksi ini? Saldo RKA akan otomatis dikembalikan.")) return;
        
        try {
            const response = await fetch(`/kartu-kendali/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if(response.ok) {
                alert("Transaksi berhasil dihapus!");
                window.location.reload();
            } else {
                const resData = await response.json();
                alert("Gagal menghapus: " + (resData.message || "Terjadi kesalahan"));
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan jaringan.");
        }
    }

    // FUNGSI MODAL EDIT
    window.bukaModalEdit = function(id) {
        let t = dbTransaksi.find(x => x.id === id);
        if(!t) return;
        
        document.getElementById('edit-id').value = t.id;
        document.getElementById('edit-tanggal').value = t.tanggal;
        document.getElementById('edit-uraian').value = t.uraian;
        document.getElementById('edit-jumlah').value = t.jumlah;
        
        document.getElementById('edit-modal').classList.remove('hidden');
    }

    window.tutupModalEdit = function() {
        document.getElementById('edit-modal').classList.add('hidden');
    }

    document.getElementById('form-edit-transaksi').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        let id = document.getElementById('edit-id').value;
        let dataEdit = {
            tanggal: document.getElementById('edit-tanggal').value,
            uraian: document.getElementById('edit-uraian').value,
            jumlah: Number(document.getElementById('edit-jumlah').value)
        };

        try {
            const response = await fetch(`/kartu-kendali/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(dataEdit)
            });

            if(response.ok) {
                alert("Transaksi berhasil diperbarui!");
                window.location.reload();
            } else {
                const resData = await response.json();
                alert("Gagal mengupdate: " + (resData.message || "Terjadi kesalahan"));
            }
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan jaringan.");
        }
    });

    window.renderLaporan = function() {
        let k = document.getElementById('laporan-rekening').value;
        let rka = dbRKA.find(x => x.id === Number(k));
        if(!rka) { alert("Pilih rekening terlebih dahulu."); return; }

        document.getElementById('laporan-content').classList.remove('hidden');

        // Menampilkan susunan hierarki Program, Kegiatan, Sub Kegiatan dari Database MySQL
        document.getElementById('laporan-header').innerHTML = `
            <table class="w-full text-left mb-4">
                <tr><td width="160" class="align-top font-semibold">Program</td><td class="align-top w-4">:</td><td class="align-top uppercase"><b>${rka.program || '-'}</b></td></tr>
                <tr><td class="align-top font-semibold">Kegiatan</td><td class="align-top">:</td><td class="align-top"><b>${rka.kegiatan || '-'}</b></td></tr>
                <tr><td class="align-top font-semibold">Sub Kegiatan</td><td class="align-top">:</td><td class="align-top"><b>${rka.sub_kegiatan || '-'}</b></td></tr>
                <tr><td class="align-top font-semibold">Keperluan / Rekening</td><td class="align-top">:</td><td class="align-top"><b>${rka.kode} - ${rka.nama}</b></td></tr>
                <tr><td class="align-top font-semibold pt-2">Total Pagu Anggaran</td><td class="align-top pt-2">:</td><td class="align-top pt-2"><b>${formatRupiah(rka.pagu)}</b></td></tr>
            </table>
        `;

        let trans = dbTransaksi.filter(x => x.rka_id === rka.id);
        let tbody = document.getElementById('laporan-body');
        tbody.innerHTML = `
            <tr class="bg-gray-50 dark:bg-gray-800 print:bg-gray-50">
                <td colspan="3" class="border border-gray-800 dark:border-gray-300 print:border-black p-2 text-center font-bold">PAGU AWAL</td>
                <td class="border border-gray-800 dark:border-gray-300 print:border-black p-2 text-center">-</td>
                <td class="border border-gray-800 dark:border-gray-300 print:border-black p-2 text-right font-bold">${formatRupiah(rka.pagu)}</td>
            </tr>
        `;

        trans.forEach((t, i) => {
            tbody.innerHTML += `
                <tr>
                    <td class="border border-gray-800 dark:border-gray-300 print:border-black p-2 text-center">${i+1}</td>
                    <td class="border border-gray-800 dark:border-gray-300 print:border-black p-2">${t.tanggal}</td>
                    <td class="border border-gray-800 dark:border-gray-300 print:border-black p-2">${t.uraian}</td>
                    <td class="border border-gray-800 dark:border-gray-300 print:border-black p-2 text-right">${formatRupiah(t.jumlah)}</td>
                    <td class="border border-gray-800 dark:border-gray-300 print:border-black p-2 text-right font-bold">${formatRupiah(t.sisa_akhir)}</td>
                </tr>
            `;
        });

        const today = new Date();
        document.getElementById('tgl-cetak').innerText = today.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
    }
</script>
</x-app-layout>