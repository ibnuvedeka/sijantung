<x-app-layout>
    <x-slot name="header">Tambah User Baru</x-slot>

    <div style="max-width:600px;">
        <div style="padding:20px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07);">

            @if ($errors->any())
                <div style="margin-bottom:16px; padding:10px 14px; border-radius:8px; background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.2); color:#f87171; font-size:0.8125rem;">
                    <ul style="list-style:none; margin:0; padding:0; display:flex; flex-direction:column; gap:4px;">
                        @foreach ($errors->all() as $error)<li>• {{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <div style="display:flex; flex-direction:column; gap:14px;">

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div>
                            <label style="display:block; font-size:0.75rem; font-weight:600; color:#94a3b8; margin-bottom:6px;">Nama Lengkap <span style="color:#f87171;">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Ahmad Fauzi"
                                style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none;"
                                onfocus="this.style.borderColor='rgba(234,179,8,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                        </div>
                        <div>
                            <label style="display:block; font-size:0.75rem; font-weight:600; color:#94a3b8; margin-bottom:6px;">Username <span style="color:#f87171;">*</span></label>
                            <input type="text" name="username" value="{{ old('username') }}" required placeholder="ahmadfauzi"
                                style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none;"
                                onfocus="this.style.borderColor='rgba(234,179,8,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                        </div>
                    </div>

                    <div>
                        <label style="display:block; font-size:0.75rem; font-weight:600; color:#94a3b8; margin-bottom:6px;">Email <span style="color:#f87171;">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@example.com"
                            style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none;"
                            onfocus="this.style.borderColor='rgba(234,179,8,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                    </div>

                    <div>
                        <label style="display:block; font-size:0.75rem; font-weight:600; color:#94a3b8; margin-bottom:6px;">Role <span style="color:#f87171;">*</span></label>
                        <select name="role" required
                            style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none; cursor:pointer;">
                            <option value="" disabled {{ old('role') == '' ? 'selected' : '' }}>-- Pilih Role --</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User - Pengguna Standar</option>
                            <option value="developer" {{ old('role') == 'developer' ? 'selected' : '' }}>Developer - Akses Penuh</option>
                        </select>
                    </div>

                    <div style="padding:14px; border-radius:8px; background:rgba(234,179,8,0.04); border:1px solid rgba(234,179,8,0.12);">
                        <p style="font-size:0.75rem; font-weight:600; color:#b45309; margin:0 0 10px;">Password</p>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                            <div>
                                <label style="display:block; font-size:0.75rem; color:#94a3b8; margin-bottom:6px;">Password <span style="color:#f87171;">*</span></label>
                                <input type="password" name="password" required placeholder="••••••••"
                                    style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none;"
                                    onfocus="this.style.borderColor='rgba(234,179,8,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                            </div>
                            <div>
                                <label style="display:block; font-size:0.75rem; color:#94a3b8; margin-bottom:6px;">Konfirmasi <span style="color:#f87171;">*</span></label>
                                <input type="password" name="password_confirmation" required placeholder="••••••••"
                                    style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none;"
                                    onfocus="this.style.borderColor='rgba(234,179,8,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                            </div>
                        </div>
                    </div>

                    <div style="padding-top:12px; border-top:1px solid rgba(255,255,255,0.06); display:flex; justify-content:flex-end; gap:8px;">
                        <a href="{{ route('users.index') }}" wire:navigate style="padding:7px 16px; border-radius:6px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); color:#94a3b8; font-size:0.8125rem; font-weight:500; text-decoration:none;">
                            Batal
                        </a>
                        <button type="submit" style="padding:7px 16px; border-radius:6px; background:rgba(234,179,8,0.15); border:1px solid rgba(234,179,8,0.3); color:#facc15; font-size:0.8125rem; font-weight:600; cursor:pointer;">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
