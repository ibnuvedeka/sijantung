<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400 leading-tight tracking-wide">
            {{ __('Template Keuangan') }}
        </h2>
    </x-slot>

    <div class="py-12 relative min-h-screen">
        <!-- Background Animated Blobs -->
        <div class="absolute inset-0 z-0 pointer-events-none flex items-center justify-center overflow-hidden">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob"></div>
            <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-blue-600/20 rounded-full mix-blend-screen filter blur-[100px] opacity-70 animate-blob animation-delay-2000"></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10 text-slate-200">
            <div class="relative group mb-6">
                <div class="absolute -inset-1 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl blur-lg opacity-20 transition duration-700 group-hover:opacity-30"></div>
                <div class="relative bg-slate-900/80 backdrop-blur-xl border border-white/10 overflow-hidden shadow-2xl sm:rounded-3xl">
                    <div class="p-8">
                        <p class="mb-6 text-slate-300 font-medium">Silakan pilih salah satu template SPJ berikut untuk memulai:</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- SPJ Makan Minum -->
                            <a href="{{ route('template.spj') }}" class="relative group/card block p-6 bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-lg hover:bg-slate-700/50 hover:border-slate-500/50 transition-all duration-300 transform hover:-translate-y-1">
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-transparent opacity-0 group-hover/card:opacity-100 rounded-2xl transition-opacity duration-300"></div>
                                <div class="relative z-10">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center mr-4 shadow-inner">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <h5 class="text-xl font-bold tracking-tight text-slate-200">SPJ Makan dan Minum</h5>
                                    </div>
                                    <p class="font-normal text-slate-400">Template kwitansi SPJ untuk keperluan konsumsi makan dan minum.</p>
                                </div>
                            </a>

                            <!-- SPJ Narasumber -->
                            <a href="{{ route('template.spj_narasumber') }}" class="relative group/card block p-6 bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-lg hover:bg-slate-700/50 hover:border-slate-500/50 transition-all duration-300 transform hover:-translate-y-1">
                                <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent opacity-0 group-hover/card:opacity-100 rounded-2xl transition-opacity duration-300"></div>
                                <div class="relative z-10">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-400 flex items-center justify-center mr-4 shadow-inner">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        </div>
                                        <h5 class="text-xl font-bold tracking-tight text-slate-200">SPJ Narasumber</h5>
                                    </div>
                                    <p class="font-normal text-slate-400">Template kwitansi SPJ untuk honorarium narasumber.</p>
                                </div>
                            </a>

                            <!-- SPJ Moderator -->
                            <a href="{{ route('template.spj_moderator') }}" class="relative group/card block p-6 bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-lg hover:bg-slate-700/50 hover:border-slate-500/50 transition-all duration-300 transform hover:-translate-y-1">
                                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent opacity-0 group-hover/card:opacity-100 rounded-2xl transition-opacity duration-300"></div>
                                <div class="relative z-10">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center mr-4 shadow-inner">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
                                        </div>
                                        <h5 class="text-xl font-bold tracking-tight text-slate-200">SPJ Moderator</h5>
                                    </div>
                                    <p class="font-normal text-slate-400">Template kwitansi SPJ untuk honorarium moderator.</p>
                                </div>
                            </a>

                            <!-- SPJ HKI -->
                            <a href="{{ route('template.spj_hki') }}" class="relative group/card block p-6 bg-slate-800/50 border border-slate-700/50 rounded-2xl shadow-lg hover:bg-slate-700/50 hover:border-slate-500/50 transition-all duration-300 transform hover:-translate-y-1">
                                <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-transparent opacity-0 group-hover/card:opacity-100 rounded-2xl transition-opacity duration-300"></div>
                                <div class="relative z-10">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-400 flex items-center justify-center mr-4 shadow-inner">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                        </div>
                                        <h5 class="text-xl font-bold tracking-tight text-slate-200">SPJ HKI</h5>
                                    </div>
                                    <p class="font-normal text-slate-400">Template kwitansi SPJ untuk pengurusan HKI.</p>
                                </div>
                            </a>
                        </div>
                        
                    </div>
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
