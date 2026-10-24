<x-app-layout>
    <x-slot name="header">Edit Surat</x-slot>

    <div style="max-width:600px;">
        <div style="padding:20px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07);">

            @if ($errors->any())
                <div style="margin-bottom:16px; padding:10px 14px; border-radius:8px; background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.2); color:#f87171; font-size:0.8125rem;">
                    <ul style="list-style:none; margin:0; padding:0; display:flex; flex-direction:column; gap:4px;">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div style="display:flex; flex-direction:column; gap:14px;">
                    <div>
                        <label style="display:block; font-size:0.75rem; font-weight:600; color:#94a3b8; margin-bottom:6px;">Nomor Surat <span style="color:#f87171;">*</span></label>
                        <input type="text" name="nomor_surat" value="{{ old('nomor_surat', $surat->nomor_surat) }}" required
                            style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none; transition:border-color 0.15s;"
                            onfocus="this.style.borderColor='rgba(234,179,8,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                    </div>

                    <div>
                        <label style="display:block; font-size:0.75rem; font-weight:600; color:#94a3b8; margin-bottom:6px;">Perihal <span style="color:#f87171;">*</span></label>
                        <input type="text" name="perihal" value="{{ old('perihal', $surat->perihal) }}" required
                            style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none; transition:border-color 0.15s;"
                            onfocus="this.style.borderColor='rgba(234,179,8,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                    </div>

                    <div>
                        <label style="display:block; font-size:0.75rem; font-weight:600; color:#94a3b8; margin-bottom:6px;">Tanggal Surat <span style="color:#f87171;">*</span></label>
                        <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat', $surat->tanggal_surat) }}" required
                            style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none; transition:border-color 0.15s; color-scheme:dark;"
                            onfocus="this.style.borderColor='rgba(234,179,8,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                    </div>

                    <div>
                        <label style="display:block; font-size:0.75rem; font-weight:600; color:#94a3b8; margin-bottom:6px;">Pengirim <span style="color:#f87171;">*</span></label>
                        <input type="text" name="pengirim" value="{{ old('pengirim', $surat->pengirim) }}" required
                            style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none; transition:border-color 0.15s;"
                            onfocus="this.style.borderColor='rgba(234,179,8,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                    </div>

                    <div>
                        <label style="display:block; font-size:0.75rem; font-weight:600; color:#94a3b8; margin-bottom:6px;">Status <span style="color:#f87171;">*</span></label>
                        <select name="status" required
                            style="width:100%; padding:8px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none; cursor:pointer;">
                            <option value="Masuk" {{ old('status', $surat->status) == 'Masuk' ? 'selected' : '' }}>Surat Masuk</option>
                            <option value="Keluar" {{ old('status', $surat->status) == 'Keluar' ? 'selected' : '' }}>Surat Keluar</option>
                        </select>
                    </div>

                    <div>
                        <label style="display:block; font-size:0.75rem; font-weight:600; color:#94a3b8; margin-bottom:6px;">File PDF <span style="color:#64748b;">(opsional)</span></label>
                        @if($surat->file_pdf)
                            <div style="margin-bottom:6px;">
                                <a href="{{ asset($surat->file_pdf) }}" target="_blank" style="font-size:0.75rem; color:#34d399; text-decoration:none;">
                                    ↗ Lihat PDF saat ini
                                </a>
                            </div>
                        @endif
                        <input type="file" name="file_pdf" accept=".pdf"
                            style="width:100%; padding:6px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#94a3b8; font-size:0.75rem; cursor:pointer;">
                        <p style="margin-top:4px; font-size:0.6875rem; color:#475569;">Pilih file baru untuk mengganti yang lama. Maks 10MB.</p>
                    </div>

                    <div style="padding-top:12px; border-top:1px solid rgba(255,255,255,0.06); display:flex; justify-content:flex-end; gap:8px;">
                        <a href="{{ route('surat.index') }}" wire:navigate style="padding:7px 16px; border-radius:6px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); color:#94a3b8; font-size:0.8125rem; font-weight:500; text-decoration:none;">
                            Batal
                        </a>
                        <button type="submit" style="padding:7px 16px; border-radius:6px; background:rgba(234,179,8,0.15); border:1px solid rgba(234,179,8,0.3); color:#facc15; font-size:0.8125rem; font-weight:600; cursor:pointer;">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>