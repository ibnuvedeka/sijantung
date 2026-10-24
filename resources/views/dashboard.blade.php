<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    {{-- Session Status --}}
    @if (session('success'))
        <div style="margin-bottom:16px; padding:10px 14px; border-radius:8px; background:rgba(16,185,129,0.08); border:1px solid rgba(16,185,129,0.2); color:#34d399; font-size:0.8125rem;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Welcome Banner --}}
    <div style="padding:16px 20px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07); border-left:3px solid #eab308; margin-bottom:20px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
        <div>
            @if(auth()->check() && auth()->user()->role === 'developer')
                <div style="font-size:0.875rem; font-weight:700; color:#facc15; margin-bottom:2px;">Halo, Developer!</div>
                <div style="font-size:0.75rem; color:#64748b;">Mode developer aktif. Hati-hati dengan tools di bawah.</div>
            @else
                <div style="font-size:0.875rem; font-weight:600; color:#e2e8f0; margin-bottom:2px;">Selamat datang, {{ auth()->user()->name ?? 'Pengguna' }}!</div>
                <div style="font-size:0.75rem; color:#64748b;">Ringkasan data aplikasi hari ini.</div>
            @endif
        </div>
        @if(auth()->check() && auth()->user()->role === 'developer')
            <button onclick="document.getElementById('dev-panel').classList.toggle('hidden')" style="padding:6px 14px; border-radius:6px; background:#eab308; color:#0d1117; font-size:0.75rem; font-weight:700; border:none; cursor:pointer;">
                Dev Tools
            </button>
        @endif
    </div>

    {{-- Stats Grid --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:12px; margin-bottom:20px;">

        {{-- Total Surat --}}
        <div style="padding:16px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07);">
            <div style="font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#64748b; margin-bottom:10px;">Total Surat</div>
            <div style="font-size:1.75rem; font-weight:700; color:#f1f5f9; line-height:1;">{{ number_format($totalSurat) }}</div>
            <div style="margin-top:8px;">
                <span style="font-size:0.6875rem; font-weight:600; padding:2px 8px; border-radius:4px; background:{{ $suratPersen > 0 ? 'rgba(16,185,129,0.1)' : ($suratPersen < 0 ? 'rgba(239,68,68,0.1)' : 'rgba(100,116,139,0.1)') }}; color:{{ $suratPersen > 0 ? '#34d399' : ($suratPersen < 0 ? '#f87171' : '#94a3b8') }};">
                    {{ $suratPersen > 0 ? '+' : '' }}{{ $suratPersen }}% bulan ini
                </span>
            </div>
        </div>

        {{-- Pengguna --}}
        <div style="padding:16px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07);">
            <div style="font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#64748b; margin-bottom:10px;">Pengguna</div>
            <div style="font-size:1.75rem; font-weight:700; color:#f1f5f9; line-height:1;">{{ number_format($totalUsers) }}</div>
            <div style="margin-top:8px;">
                <span style="font-size:0.6875rem; font-weight:600; padding:2px 8px; border-radius:4px; background:{{ $usersPersen > 0 ? 'rgba(16,185,129,0.1)' : ($usersPersen < 0 ? 'rgba(239,68,68,0.1)' : 'rgba(100,116,139,0.1)') }}; color:{{ $usersPersen > 0 ? '#34d399' : ($usersPersen < 0 ? '#f87171' : '#94a3b8') }};">
                    {{ $usersPersen > 0 ? '+' : '' }}{{ $usersPersen }}% bulan ini
                </span>
            </div>
        </div>

        {{-- Dokumen RKPD --}}
        <div style="padding:16px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07);">
            <div style="font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#64748b; margin-bottom:10px;">Dokumen RKPD</div>
            <div style="font-size:1.75rem; font-weight:700; color:#f1f5f9; line-height:1;">{{ number_format($totalRkpd) }}</div>
            <div style="margin-top:8px;">
                <span style="font-size:0.6875rem; color:#64748b;">file PDF tersedia</span>
            </div>
        </div>

        {{-- Transaksi SPJ --}}
        <div style="padding:16px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07);">
            <div style="font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#64748b; margin-bottom:10px;">Transaksi SPJ</div>
            <div style="font-size:1.75rem; font-weight:700; color:#f1f5f9; line-height:1;">{{ number_format($totalTransaksi) }}</div>
            <div style="margin-top:8px;">
                <span style="font-size:0.6875rem; font-weight:600; padding:2px 8px; border-radius:4px; background:{{ $trxPersen > 0 ? 'rgba(16,185,129,0.1)' : ($trxPersen < 0 ? 'rgba(239,68,68,0.1)' : 'rgba(100,116,139,0.1)') }}; color:{{ $trxPersen > 0 ? '#34d399' : ($trxPersen < 0 ? '#f87171' : '#94a3b8') }};">
                    {{ $trxPersen > 0 ? '+' : '' }}{{ $trxPersen }}% bulan ini
                </span>
            </div>
        </div>
    </div>

    {{-- Quick Access --}}
    <div style="padding:16px 20px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07); margin-bottom:20px;">
        <div style="font-size:0.75rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.08em; margin-bottom:14px;">Akses Cepat</div>
        <div style="display:flex; flex-wrap:wrap; gap:8px;">
            <a href="{{ route('surat.create') }}" wire:navigate style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:6px; background:rgba(234,179,8,0.1); border:1px solid rgba(234,179,8,0.2); color:#facc15; font-size:0.8125rem; font-weight:500; text-decoration:none; transition:background 0.15s;">
                <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Surat
            </a>
            <a href="{{ route('kartukendali.index') }}" wire:navigate style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:6px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); color:#94a3b8; font-size:0.8125rem; font-weight:500; text-decoration:none; transition:background 0.15s;">
                <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                Kartu Kendali
            </a>
            <a href="{{ route('rkpd.preview') }}" wire:navigate style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:6px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); color:#94a3b8; font-size:0.8125rem; font-weight:500; text-decoration:none; transition:background 0.15s;">
                <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Potong RKPD
            </a>
            <a href="{{ route('template_keuangan.index') }}" wire:navigate style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:6px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); color:#94a3b8; font-size:0.8125rem; font-weight:500; text-decoration:none; transition:background 0.15s;">
                <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Template Keuangan
            </a>
        </div>
    </div>

    {{-- Developer Panel --}}
    @if(auth()->check() && auth()->user()->role === 'developer')
    <div id="dev-panel" class="hidden" style="padding:16px; border-radius:10px; background:#111827; border:1px solid rgba(234,179,8,0.2);">
        <div style="font-size:0.75rem; font-weight:700; color:#eab308; text-transform:uppercase; letter-spacing:0.08em; margin-bottom:14px;">Developer Tools</div>

        {{-- System Info --}}
        <div style="font-family:monospace; font-size:0.75rem; color:#64748b; background:#0d1117; border-radius:6px; padding:12px; margin-bottom:12px; display:grid; grid-template-columns:auto 1fr; gap:4px 16px;">
            <span>PHP:</span><span style="color:#facc15;">{{ phpversion() }}</span>
            <span>Laravel:</span><span style="color:#facc15;">{{ app()->version() }}</span>
            <span>Env:</span><span style="color:#facc15;">{{ app()->environment() }}</span>
            <span>Host:</span><span style="color:#facc15;">{{ request()->getHost() }}</span>
        </div>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(160px, 1fr)); gap:8px; margin-bottom:12px;">
            <form action="{{ route('developer.clear-cache') }}" method="POST">
                @csrf
                <button type="submit" style="width:100%; padding:8px 14px; border-radius:6px; background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.2); color:#f87171; font-size:0.75rem; font-weight:600; cursor:pointer;">
                    Clear Cache
                </button>
            </form>
            <form action="{{ route('developer.generate-dummy') }}" method="POST">
                @csrf
                <button type="submit" style="width:100%; padding:8px 14px; border-radius:6px; background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.2); color:#34d399; font-size:0.75rem; font-weight:600; cursor:pointer;">
                    Generate Users
                </button>
            </form>
        </div>

        {{-- Impersonate --}}
        <div style="font-size:0.6875rem; font-weight:600; color:#475569; text-transform:uppercase; letter-spacing:0.08em; margin-bottom:8px;">Impersonate User</div>
        @php $dummyUsers = \App\Models\User::where('id', '!=', auth()->id())->latest()->limit(5)->get(); @endphp
        <div style="display:flex; flex-direction:column; gap:6px;">
            @forelse($dummyUsers as $u)
            <div style="display:flex; align-items:center; justify-content:space-between; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.06);">
                <div>
                    <span style="font-size:0.8125rem; font-weight:600; color:#e2e8f0;">{{ $u->name }}</span>
                    <span style="font-size:0.6875rem; color:#64748b; margin-left:6px;">{{ $u->role }}</span>
                </div>
                <form action="{{ route('developer.impersonate', $u->id) }}" method="POST">
                    @csrf
                    <button type="submit" style="padding:4px 12px; border-radius:4px; background:rgba(234,179,8,0.1); border:1px solid rgba(234,179,8,0.2); color:#facc15; font-size:0.6875rem; font-weight:600; cursor:pointer;">
                        Login
                    </button>
                </form>
            </div>
            @empty
            <div style="font-size:0.75rem; color:#475569; padding:10px; text-align:center;">Belum ada user lain.</div>
            @endforelse
        </div>
    </div>
    @endif

</x-app-layout>
