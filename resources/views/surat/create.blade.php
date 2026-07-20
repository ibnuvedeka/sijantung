<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 leading-tight tracking-wide">
            {{ __('Tambah Data Surat') }}
        </h2>
    </x-slot>

    <div class="py-12 relative min-h-screen">
        <!-- Background Animated Blobs -->
        <div class="absolute inset-0 z-0 pointer-events-none flex items-center justify-center overflow-hidden">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob"></div>
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-blue-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob animation-delay-2000"></div>
        </div>

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl blur-lg opacity-20 transition duration-700 group-hover:opacity-30"></div>
                <div class="relative bg-slate-900/80 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-3xl p-8">
                    
                    <form action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-5">
                            <label for="nomor_surat" class="block text-sm font-semibold text-slate-300 mb-2">Nomor Surat</label>
                            <input type="text" name="nomor_surat" id="nomor_surat" required
                                class="block w-full rounded-xl border-slate-700/50 bg-slate-800/50 text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder-slate-500 backdrop-blur-md transition-all">
                        </div>

                        <div class="mb-5">
                            <label for="perihal" class="block text-sm font-semibold text-slate-300 mb-2">Perihal / Ringkasan</label>
                            <input type="text" name="perihal" id="perihal" required
                                class="block w-full rounded-xl border-slate-700/50 bg-slate-800/50 text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder-slate-500 backdrop-blur-md transition-all">
                        </div>

                        <div class="mb-5">
                            <label for="tanggal_surat" class="block text-sm font-semibold text-slate-300 mb-2">Tanggal Surat</label>
                            <input type="date" name="tanggal_surat" id="tanggal_surat" required
                                class="block w-full rounded-xl border-slate-700/50 bg-slate-800/50 text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 backdrop-blur-md transition-all [color-scheme:dark]">
                        </div>

                        <div class="mb-5">
                            <label for="pengirim" class="block text-sm font-semibold text-slate-300 mb-2">Pengirim / Asal Surat</label>
                            <input type="text" name="pengirim" id="pengirim" required
                                class="block w-full rounded-xl border-slate-700/50 bg-slate-800/50 text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 placeholder-slate-500 backdrop-blur-md transition-all">
                        </div>

                        <div class="mb-5">
                            <label for="status" class="block text-sm font-semibold text-slate-300 mb-2">Status Surat</label>
                            <select name="status" id="status" required
                                class="block w-full rounded-xl border-slate-700/50 bg-slate-800/50 text-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 backdrop-blur-md transition-all">
                                <option value="" disabled selected class="bg-slate-800 text-slate-400">-- Pilih Status --</option>
                                <option value="Masuk" class="bg-slate-800 text-slate-200">Surat Masuk</option>
                                <option value="Keluar" class="bg-slate-800 text-slate-200">Surat Keluar</option>
                            </select>
                        </div>

                        <div class="mb-8">
                            <label for="file_pdf" class="block text-sm font-semibold text-slate-300 mb-2">File PDF (Opsional)</label>
                            <input type="file" name="file_pdf" id="file_pdf" accept=".pdf"
                                class="block w-full text-sm text-slate-400 file:mr-4 file:py-2.5 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-500/10 file:text-indigo-400 hover:file:bg-indigo-500/20 file:transition-colors file:cursor-pointer border border-slate-700/50 rounded-xl bg-slate-800/50 backdrop-blur-md file:shadow-sm p-1.5">
                            <p class="mt-2 text-xs text-slate-500">Maksimal ukuran file: 10MB.</p>
                        </div>

                        <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-slate-700/50">
                            <a href="{{ route('surat.index') }}" class="px-6 py-2.5 rounded-full border border-slate-600 text-slate-300 hover:bg-slate-800 transition-colors font-medium">
                                Batal
                            </a>
                            <button type="submit" class="relative inline-flex items-center justify-center px-8 py-2.5 overflow-hidden font-semibold text-white transition-all duration-300 rounded-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 shadow-[0_0_20px_rgba(79,70,229,0.3)] hover:shadow-[0_0_25px_rgba(79,70,229,0.5)] transform hover:-translate-y-0.5">
                                Simpan Data
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    
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