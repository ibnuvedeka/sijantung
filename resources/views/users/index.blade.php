<x-app-layout>
    <x-slot name="header">Manajemen User</x-slot>

    @if(session('success'))
        <div style="margin-bottom:14px; padding:10px 14px; border-radius:8px; background:rgba(16,185,129,0.08); border:1px solid rgba(16,185,129,0.2); color:#34d399; font-size:0.8125rem;">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="margin-bottom:14px; padding:10px 14px; border-radius:8px; background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.2); color:#f87171; font-size:0.8125rem;">
            {{ session('error') }}
        </div>
    @endif

    {{-- Toolbar --}}
    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; margin-bottom:16px;">
        <a href="{{ route('users.create') }}" wire:navigate style="display:inline-flex; align-items:center; gap:6px; padding:7px 14px; border-radius:6px; background:rgba(234,179,8,0.1); border:1px solid rgba(234,179,8,0.2); color:#facc15; font-size:0.8125rem; font-weight:600; text-decoration:none;">
            <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah User
        </a>
    </div>

    {{-- Table --}}
    <div style="border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07); overflow:hidden;">
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; min-width:560px;">
                <thead>
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.07);">
                        <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">#</th>
                        <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">Pengguna</th>
                        <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">Username</th>
                        <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">Role</th>
                        <th style="padding:10px 14px; text-align:center; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; white-space:nowrap;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                    <tr style="border-bottom:1px solid rgba(255,255,255,0.04); transition:background 0.1s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                        <td style="padding:10px 14px; font-size:0.8125rem; color:#475569;">{{ $users->firstItem() + $key }}</td>
                        <td style="padding:10px 14px;">
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div style="width:32px; height:32px; border-radius:50%; background:rgba(234,179,8,0.15); border:1px solid rgba(234,179,8,0.2); display:flex; align-items:center; justify-content:center; font-size:0.75rem; font-weight:700; color:#facc15; flex-shrink:0;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p style="font-size:0.8125rem; font-weight:600; color:#e2e8f0; margin:0;">{{ $user->name }}</p>
                                    <p style="font-size:0.6875rem; color:#475569; margin:0;">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td style="padding:10px 14px; font-size:0.8125rem; color:#64748b; font-family:monospace;">{{ \Str::limit($user->username, 15) }}</td>
                        <td style="padding:10px 14px;">
                            @if($user->role === 'developer')
                                <span style="font-size:0.6875rem; font-weight:600; padding:2px 8px; border-radius:4px; background:rgba(168,85,247,0.1); color:#c084fc;">Developer</span>
                            @else
                                <span style="font-size:0.6875rem; font-weight:600; padding:2px 8px; border-radius:4px; background:rgba(16,185,129,0.1); color:#34d399;">User</span>
                            @endif
                        </td>
                        <td style="padding:10px 14px; text-align:center; white-space:nowrap;">
                            <div style="display:inline-flex; align-items:center; gap:10px;">
                                <a href="{{ route('users.edit', $user->id) }}" wire:navigate title="Edit" style="color:#94a3b8; transition:color 0.15s;" onmouseover="this.style.color='#e2e8f0'" onmouseout="this.style.color='#94a3b8'">
                                    <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Hapus" style="background:none; border:none; cursor:pointer; color:#64748b; padding:0; transition:color 0.15s;" onmouseover="this.style.color='#f87171'" onmouseout="this.style.color='#64748b'">
                                        <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if($users->hasPages())
        <div style="margin-top:14px;">
            {{ $users->links() }}
        </div>
    @endif

</x-app-layout>
