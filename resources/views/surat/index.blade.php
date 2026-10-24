<x-app-layout>
    <x-slot name="header">Data Surat</x-slot>

    {{-- Session Flash --}}
    @if(session('success'))
        <div style="margin-bottom:16px; padding:10px 14px; border-radius:8px; background:rgba(16,185,129,0.08); border:1px solid rgba(16,185,129,0.2); color:#34d399; font-size:0.8125rem;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Toolbar --}}
    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; margin-bottom:16px;">
        <a href="{{ route('surat.create') }}" wire:navigate style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:6px; background:rgba(234,179,8,0.1); border:1px solid rgba(234,179,8,0.2); color:#facc15; font-size:0.8125rem; font-weight:600; text-decoration:none;">
            <svg style="width:14px; height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Surat
        </a>
        <form action="{{ route('surat.index') }}" method="GET" style="display:flex; align-items:center; gap:6px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari surat..."
                style="padding:6px 12px; border-radius:6px; background:#111827; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; width:200px; outline:none;">
            <button type="submit" style="padding:6px 12px; border-radius:6px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); color:#94a3b8; font-size:0.8125rem; cursor:pointer;">Cari</button>
        </form>
    </div>

    {{-- Table --}}
    <div style="border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07); overflow:hidden;">
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; min-width:640px;">
                <thead>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07);">
                        <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">#</th>
                        <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">Nomor Surat</th>
                        <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">Perihal</th>
                        <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">Tanggal</th>
                        <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">Pengirim</th>
                        <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">Status</th>
                        <th style="padding:10px 14px; text-align:center; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($surats as $index => $item)
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.04); transition:background 0.1s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                        <td style="padding:10px 14px; font-size:0.8125rem; color:#475569;">{{ $index + 1 }}</td>
                        <td style="padding:10px 14px; font-size:0.8125rem; color:#e2e8f0; font-weight:500; white-space:nowrap;">{{ $item->nomor_surat }}</td>
                        <td style="padding:10px 14px; font-size:0.8125rem; color:#94a3b8; max-width:240px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $item->perihal }}</td>
                        <td style="padding:10px 14px; font-size:0.8125rem; color:#64748b; white-space:nowrap;">{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('d/m/Y') }}</td>
                        <td style="padding:10px 14px; font-size:0.8125rem; color:#94a3b8; white-space:nowrap;">{{ $item->pengirim }}</td>
                        <td style="padding:10px 14px;">
                            <span style="font-size:0.6875rem; font-weight:600; padding:2px 8px; border-radius:4px; {{ $item->status == 'Masuk' ? 'background:rgba(16,185,129,0.1); color:#34d399;' : 'background:rgba(59,130,246,0.1); color:#60a5fa;' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td style="padding:10px 14px; text-align:center; white-space:nowrap;">
                            <div style="display:inline-flex; align-items:center; gap:10px;">
                                @if($item->file_pdf)
                                <a href="{{ asset($item->file_pdf) }}" target="_blank" title="Lihat PDF" style="color:#34d399; transition:opacity 0.15s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'">
                                    <svg style="width:15px; height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </a>
                                @endif
                                <a href="{{ route('surat.edit', $item->id) }}" wire:navigate title="Edit" style="color:#94a3b8; transition:color 0.15s;" onmouseover="this.style.color='#e2e8f0'" onmouseout="this.style.color='#94a3b8'">
                                    <svg style="width:15px; height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('surat.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Hapus" style="background:none; border:none; cursor:pointer; color:#64748b; transition:color 0.15s; padding:0;" onmouseover="this.style.color='#f87171'" onmouseout="this.style.color='#64748b'">
                                        <svg style="width:15px; height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding:40px; text-align:center; color:#475569; font-size:0.8125rem;">
                            Belum ada data surat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>