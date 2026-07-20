<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIJANTUNG') }}</title>
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex h-screen bg-gray-100 dark:bg-gray-900 overflow-hidden">
            
            <div class="w-64 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 hidden md:flex flex-col shadow-lg z-10">
                <div class="h-16 flex items-center px-6 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/Logo.png') }}" class="h-8 w-auto object-contain" alt="Logo SIJANTUNG">
                        <span class="font-bold text-lg text-gray-800 dark:text-white tracking-wide">SIJANTUNG</span>
                    </a>
                </div>

                <div class="p-4 flex-1 overflow-y-auto space-y-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <a href="{{ route('surat.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('surat.*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span class="font-medium">Data Surat</span>
                    </a>

                    <a href="{{ route('kartukendali.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('kartukendali.*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        <span class="font-medium">Kartu Kendali (SPJ)</span>
                    </a>

                    <a href="{{ route('rkpd.preview') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('rkpd.*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"></path></svg>
                        <span class="font-medium">Potong RKPD</span>
                    </a>

                    <a href="{{ route('template_keuangan.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('template_keuangan.*', 'template.spj*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-medium">Template Keuangan</span>
                    </a>

                    @if(auth()->user() && auth()->user()->role === 'developer')
                    <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('users.*') ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span class="font-medium">Manajemen User</span>
                    </a>
                    @endif

                    <div class="pt-6 mt-4 border-t border-gray-200">
                        <span class="px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Template Surat</span>
                        <div class="mt-3 space-y-1">
                            <a href="{{ route('template.undangan') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('template.undangan') ? 'bg-purple-50 text-purple-700 font-semibold' : 'text-gray-500 hover:bg-gray-50' }}">
                                <span class="w-2 h-2 rounded-full bg-purple-400 mr-3"></span>
                                Surat Undangan
                            </a>

                            <a href="{{ route('template.keluar_biasa') }}" class="flex items-center px-4 py-2 text-sm rounded-lg {{ request()->routeIs('template.keluar_biasa') ? 'bg-purple-50 text-purple-700 font-semibold' : 'text-gray-500 hover:bg-gray-50' }}">
                                <span class="w-2 h-2 rounded-full bg-purple-400 mr-3"></span>
                                Surat Keluar Biasa
                            </a>

                        </div>
                    </div>


                </div>
            </div>

            <div class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50 dark:bg-gray-900">
                <div class="shadow-sm">
                    @include('layouts.navigation')
                </div>

                @isset($header)
                    <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <main class="flex-1 overflow-y-auto p-4 md:p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>