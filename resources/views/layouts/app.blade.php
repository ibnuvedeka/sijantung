<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIJANTUNG') }}</title>
        <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

        <style>
            *, *::before, *::after { box-sizing: border-box; }
            body { font-family: 'Inter', sans-serif; }

            /* Sidebar */
            .sidebar {
                background: #111827;
                border-right: 1px solid rgba(255, 255, 255, 0.07);
                width: 240px;
                flex-shrink: 0;
            }

            /* Scrollbar */
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

            /* Nav item */
            .nav-item {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 9px 14px;
                border-radius: 8px;
                font-size: 0.8125rem;
                font-weight: 500;
                color: #94a3b8;
                transition: background 0.15s, color 0.15s;
                cursor: pointer;
                text-decoration: none;
            }
            .nav-item:hover {
                background: rgba(255,255,255,0.06);
                color: #e2e8f0;
            }
            .nav-item.active {
                background: rgba(234, 179, 8, 0.12);
                color: #facc15;
                font-weight: 600;
            }
            .nav-item svg {
                width: 16px;
                height: 16px;
                flex-shrink: 0;
                opacity: 0.8;
            }

            /* Nav section label */
            .nav-section {
                padding: 16px 14px 6px;
                font-size: 0.65rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                color: #475569;
            }

            /* Top bar */
            .topbar {
                height: 52px;
                background: #111827;
                border-bottom: 1px solid rgba(255,255,255,0.07);
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 20px;
                flex-shrink: 0;
            }

            /* Mobile sidebar toggle */
            .mobile-sidebar {
                display: none;
                position: fixed;
                inset: 0;
                z-index: 50;
            }
            .mobile-sidebar.open { display: flex; }
            .mobile-overlay {
                position: absolute;
                inset: 0;
                background: rgba(0,0,0,0.6);
            }
            .mobile-sidebar-panel {
                position: relative;
                z-index: 10;
                width: 240px;
                background: #111827;
                border-right: 1px solid rgba(255,255,255,0.07);
                height: 100%;
                overflow-y: auto;
            }

            /* Page transition */
            [wire\:navigate] { transition: opacity 0.12s; }
        </style>
    </head>
    <body class="antialiased bg-[#0d1117] text-white" style="margin:0;">

        <div style="display:flex; height:100vh; overflow:hidden;">

            {{-- Sidebar Desktop --}}
            <div class="sidebar hidden md:flex flex-col no-scrollbar overflow-y-auto">
                {{-- Logo --}}
                <div style="height:52px; display:flex; align-items:center; padding:0 16px; border-bottom:1px solid rgba(255,255,255,0.07); flex-shrink:0;">
                    <a href="{{ route('dashboard') }}" wire:navigate style="display:flex; align-items:center; gap:10px; text-decoration:none;">
                        <div style="width:28px; height:28px; border-radius:6px; background:linear-gradient(135deg,#eab308,#16a34a); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:16px; height:16px; object-fit:contain; filter:brightness(0) invert(1);">
                        </div>
                        <span style="font-weight:700; font-size:0.875rem; color:#f1f5f9; letter-spacing:0.02em;">SI-JANTUNG</span>
                    </a>
                </div>

                {{-- Nav --}}
                <div style="padding:8px; flex:1;">
                    <div class="nav-section">Menu Utama</div>

                    <a href="{{ route('dashboard') }}" wire:navigate class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>

                    <a href="{{ route('surat.index') }}" wire:navigate class="nav-item {{ request()->routeIs('surat.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Data Surat
                    </a>

                    <a href="{{ route('kartukendali.index') }}" wire:navigate class="nav-item {{ request()->routeIs('kartukendali.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        Kartu Kendali (SPJ)
                    </a>

                    <a href="{{ route('rkpd.preview') }}" wire:navigate class="nav-item {{ request()->routeIs('rkpd.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Potong RKPD
                    </a>

                    <a href="{{ route('template_keuangan.index') }}" wire:navigate class="nav-item {{ request()->routeIs('template_keuangan.*', 'template.spj*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Template Keuangan
                    </a>

                    @if(auth()->user() && auth()->user()->role === 'developer')
                    <a href="{{ route('users.index') }}" wire:navigate class="nav-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Manajemen User
                    </a>
                    @endif

                    <div class="nav-section" style="margin-top:8px;">Template Surat</div>

                    <a href="{{ route('template.undangan') }}" wire:navigate class="nav-item {{ request()->routeIs('template.undangan') ? 'active' : '' }}" style="{{ request()->routeIs('template.undangan') ? '' : 'color:#64748b;' }}">
                        <span style="width:5px; height:5px; border-radius:50%; background:currentColor; flex-shrink:0;"></span>
                        Surat Undangan
                    </a>

                    <a href="{{ route('template.keluar_biasa') }}" wire:navigate class="nav-item {{ request()->routeIs('template.keluar_biasa') ? 'active' : '' }}" style="{{ request()->routeIs('template.keluar_biasa') ? '' : 'color:#64748b;' }}">
                        <span style="width:5px; height:5px; border-radius:50%; background:currentColor; flex-shrink:0;"></span>
                        Surat Keluar Biasa
                    </a>
                </div>

                {{-- User info at bottom --}}
                <div style="padding:12px 8px; border-top:1px solid rgba(255,255,255,0.07); flex-shrink:0;">
                    <div style="display:flex; align-items:center; gap:8px; padding:8px 10px; border-radius:8px; background:rgba(255,255,255,0.04);">
                        <div style="width:28px; height:28px; border-radius:50%; background:linear-gradient(135deg,#eab308,#16a34a); display:flex; align-items:center; justify-content:center; font-size:0.75rem; font-weight:700; color:#fff; flex-shrink:0;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div style="overflow:hidden;">
                            <div style="font-size:0.75rem; font-weight:600; color:#e2e8f0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ Auth::user()->name }}</div>
                            <div style="font-size:0.65rem; color:#64748b;">{{ Auth::user()->role ?? 'user' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Main Area --}}
            <div style="flex:1; display:flex; flex-direction:column; overflow:hidden;">

                {{-- Topbar --}}
                <div class="topbar">
                    {{-- Mobile menu button --}}
                    <button id="mobile-menu-btn" class="md:hidden" style="background:none; border:none; color:#94a3b8; cursor:pointer; padding:4px;" onclick="document.getElementById('mobile-sidebar').classList.toggle('open')">
                        <svg style="width:20px; height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div class="hidden md:block" style="font-size:0.8125rem; color:#475569;">
                        {{ config('app.name', 'SIJANTUNG') }}
                    </div>

                    <div style="display:flex; align-items:center; gap:8px;">
                        {{-- Page Title (mobile) --}}
                        @isset($header)
                        <span class="md:hidden" style="font-size:0.8125rem; font-weight:600; color:#e2e8f0;">{{ $header }}</span>
                        @endisset

                        {{-- User dropdown --}}
                        <div x-data="{ open: false }" style="position:relative;">
                            <button @click="open = !open" style="display:flex; align-items:center; gap:6px; padding:5px 10px; border-radius:6px; background:rgba(255,255,255,0.05); border:1px solid rgba(255,255,255,0.08); color:#cbd5e1; font-size:0.75rem; font-weight:500; cursor:pointer; transition:background 0.15s;">
                                <div style="width:22px; height:22px; border-radius:50%; background:linear-gradient(135deg,#eab308,#16a34a); display:flex; align-items:center; justify-content:center; font-size:0.6rem; font-weight:700; color:#fff;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                {{ Auth::user()->name }}
                                <svg style="width:12px; height:12px; transition:transform 0.2s;" :style="open ? 'transform:rotate(180deg)' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                style="position:absolute; right:0; top:calc(100% + 6px); min-width:160px; background:#1e293b; border:1px solid rgba(255,255,255,0.1); border-radius:8px; overflow:hidden; z-index:100; display:none;"
                                x-cloak>
                                <a href="{{ route('profile.edit') }}" wire:navigate style="display:flex; align-items:center; gap:8px; padding:8px 14px; font-size:0.8125rem; color:#cbd5e1; text-decoration:none; transition:background 0.15s;" onmouseover="this.style.background='rgba(255,255,255,0.06)'" onmouseout="this.style.background='transparent'">
                                    <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Profil
                                </a>
                                <div style="height:1px; background:rgba(255,255,255,0.07);"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" style="display:flex; align-items:center; gap:8px; padding:8px 14px; font-size:0.8125rem; color:#f87171; background:none; border:none; cursor:pointer; width:100%; text-align:left; transition:background 0.15s;" onmouseover="this.style.background='rgba(239,68,68,0.08)'" onmouseout="this.style.background='transparent'">
                                        <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Page Header --}}
                @isset($header)
                <div style="padding:12px 20px; border-bottom:1px solid rgba(255,255,255,0.06); background:#111827; flex-shrink:0;" class="hidden md:block">
                    <h1 style="font-size:0.9375rem; font-weight:600; color:#e2e8f0; margin:0;">{{ $header }}</h1>
                </div>
                @endisset

                {{-- Content --}}
                <main class="no-scrollbar" style="flex:1; overflow-y:auto; padding:20px; background:#0d1117;">
                    {{ $slot }}
                </main>
            </div>
        </div>

        {{-- Mobile Sidebar --}}
        <div id="mobile-sidebar" class="mobile-sidebar" onclick="if(event.target===this||event.target.classList.contains('mobile-overlay'))this.classList.remove('open')">
            <div class="mobile-overlay"></div>
            <div class="mobile-sidebar-panel">
                <div style="height:52px; display:flex; align-items:center; justify-content:space-between; padding:0 16px; border-bottom:1px solid rgba(255,255,255,0.07);">
                    <span style="font-weight:700; font-size:0.875rem; color:#f1f5f9;">SI-JANTUNG</span>
                    <button onclick="document.getElementById('mobile-sidebar').classList.remove('open')" style="background:none; border:none; color:#94a3b8; cursor:pointer;">
                        <svg style="width:18px; height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div style="padding:8px;">
                    <a href="{{ route('dashboard') }}" wire:navigate onclick="document.getElementById('mobile-sidebar').classList.remove('open')" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('surat.index') }}" wire:navigate onclick="document.getElementById('mobile-sidebar').classList.remove('open')" class="nav-item {{ request()->routeIs('surat.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Data Surat
                    </a>
                    <a href="{{ route('kartukendali.index') }}" wire:navigate onclick="document.getElementById('mobile-sidebar').classList.remove('open')" class="nav-item {{ request()->routeIs('kartukendali.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        Kartu Kendali (SPJ)
                    </a>
                    <a href="{{ route('rkpd.preview') }}" wire:navigate onclick="document.getElementById('mobile-sidebar').classList.remove('open')" class="nav-item {{ request()->routeIs('rkpd.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Potong RKPD
                    </a>
                    <a href="{{ route('template_keuangan.index') }}" wire:navigate onclick="document.getElementById('mobile-sidebar').classList.remove('open')" class="nav-item {{ request()->routeIs('template_keuangan.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Template Keuangan
                    </a>
                </div>
            </div>
        </div>

        @livewireScripts
    </body>
</html>