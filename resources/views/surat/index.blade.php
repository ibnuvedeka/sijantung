<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 leading-tight tracking-wide">
            {{ __('Data Tata Naskah Dinas - SIJANTUNG') }}
        </h2>
    </x-slot>

    <div class="py-12 relative min-h-screen">
        <!-- Background Animated Blobs -->
        <div class="absolute inset-0 z-0 pointer-events-none flex items-center justify-center overflow-hidden">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob"></div>
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-blue-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob animation-delay-2000"></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            @if(session('success'))
                <div class="mb-4 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 shadow-sm backdrop-blur-md" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                
                <a href="{{ route('surat.create') }}" class="relative inline-flex items-center justify-center px-6 py-2.5 overflow-hidden font-semibold text-white transition-all duration-300 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)] transform hover:-translate-y-0.5 w-full md:w-auto">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span class="relative z-10">Tambah Surat Baru</span>
                </a>

                <form action="{{ route('surat.index') }}" method="GET" class="w-full md:w-1/3">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400 group-focus-within:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor, perihal, atau pengirim..." 
                            class="block w-full p-3 pl-12 text-sm text-slate-200 border border-slate-700/50 rounded-full bg-slate-900/50 focus:ring-indigo-500 focus:border-indigo-500 placeholder-slate-400 backdrop-blur-xl transition-all shadow-lg hover:border-slate-600">
                    </div>
                </form>

            </div>

            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl blur-lg opacity-20 transition duration-700 group-hover:opacity-30"></div>
                <div class="relative bg-slate-900/80 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-3xl">
                    <div class="p-6 text-gray-100 overflow-x-auto">
                        
                        <table class="w-full text-left border-collapse min-w-max">
                            <thead>
                                <tr class="bg-slate-800/50 uppercase text-xs font-bold text-slate-300 border-b border-slate-700/50">
                                    <th class="p-4 rounded-tl-xl">No</th>
                                    <th class="p-4">Nomor Surat</th>
                                    <th class="p-4">Perihal</th>
                                    <th class="p-4">Tanggal</th>
                                    <th class="p-4">Pengirim</th>
                                    <th class="p-4">Status</th>
                                    <th class="p-4 text-center rounded-tr-xl">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700/30">
                                @forelse($surats as $index => $item)
                                <tr class="hover:bg-slate-800/40 transition-colors">
                                    <td class="p-4 text-slate-400">{{ $index + 1 }}</td>
                                    <td class="p-4 font-medium text-slate-200">{{ $item->nomor_surat }}</td>
                                    <td class="p-4 text-slate-300">{{ $item->perihal }}</td>
                                    <td class="p-4 text-slate-400">{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d/m/Y') }}</td>
                                    <td class="p-4 text-slate-300">{{ $item->pengirim }}</td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full border {{ $item->status == 'Masuk' ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400' : 'bg-blue-500/10 border-blue-500/20 text-blue-400' }} shadow-sm">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <div class="flex justify-center space-x-3">
                                            @if($item->file_pdf)
                                                <a href="{{ asset($item->file_pdf) }}" target="_blank" title="Lihat PDF" class="text-emerald-500 hover:text-emerald-400 transition-colors transform hover:scale-110">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                </a>
                                            @endif
                                            <a href="{{ route('surat.edit', $item->id) }}" title="Edit Surat" class="text-indigo-400 hover:text-indigo-300 transition-colors transform hover:scale-110">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <form action="{{ route('surat.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" title="Hapus Surat" class="text-rose-500 hover:text-rose-400 transition-colors transform hover:scale-110">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="p-10 text-center text-slate-500 italic">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 mb-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                            Belum ada data surat yang tersimpan.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ensure blob animation works if not globally defined -->
    <style>
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
    </style>
</x-app-layout>