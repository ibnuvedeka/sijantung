<x-app-layout>
    <x-slot name="header">Template Keuangan</x-slot>

    <p style="font-size:0.8125rem; color:#64748b; margin-bottom:16px;">Pilih template SPJ yang ingin digunakan:</p>

    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(220px, 1fr)); gap:12px;">

        {{-- SPJ Makan Minum --}}
        <a href="{{ route('template.spj') }}" style="display:block; padding:16px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07); text-decoration:none; transition:border-color 0.15s, background 0.15s;"
            onmouseover="this.style.borderColor='rgba(59,130,246,0.3)'; this.style.background='#141e2e';" onmouseout="this.style.borderColor='rgba(255,255,255,0.07)'; this.style.background='#111827';">
            <div style="width:36px; height:36px; border-radius:8px; background:rgba(59,130,246,0.1); border:1px solid rgba(59,130,246,0.2); display:flex; align-items:center; justify-content:center; margin-bottom:12px;">
                <svg style="width:18px;height:18px;color:#60a5fa;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p style="font-size:0.8125rem; font-weight:600; color:#e2e8f0; margin:0 0 4px;">SPJ Makan & Minum</p>
            <p style="font-size:0.75rem; color:#475569; margin:0;">Template kwitansi untuk konsumsi.</p>
        </a>

        {{-- SPJ Narasumber --}}
        <a href="{{ route('template.spj_narasumber') }}" style="display:block; padding:16px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07); text-decoration:none; transition:border-color 0.15s, background 0.15s;"
            onmouseover="this.style.borderColor='rgba(168,85,247,0.3)'; this.style.background='#161426';" onmouseout="this.style.borderColor='rgba(255,255,255,0.07)'; this.style.background='#111827';">
            <div style="width:36px; height:36px; border-radius:8px; background:rgba(168,85,247,0.1); border:1px solid rgba(168,85,247,0.2); display:flex; align-items:center; justify-content:center; margin-bottom:12px;">
                <svg style="width:18px;height:18px;color:#c084fc;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <p style="font-size:0.8125rem; font-weight:600; color:#e2e8f0; margin:0 0 4px;">SPJ Narasumber</p>
            <p style="font-size:0.75rem; color:#475569; margin:0;">Honorarium untuk narasumber.</p>
        </a>

        {{-- SPJ Moderator --}}
        <a href="{{ route('template.spj_moderator') }}" style="display:block; padding:16px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07); text-decoration:none; transition:border-color 0.15s, background 0.15s;"
            onmouseover="this.style.borderColor='rgba(16,185,129,0.3)'; this.style.background='#0e1a16';" onmouseout="this.style.borderColor='rgba(255,255,255,0.07)'; this.style.background='#111827';">
            <div style="width:36px; height:36px; border-radius:8px; background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.2); display:flex; align-items:center; justify-content:center; margin-bottom:12px;">
                <svg style="width:18px;height:18px;color:#34d399;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/></svg>
            </div>
            <p style="font-size:0.8125rem; font-weight:600; color:#e2e8f0; margin:0 0 4px;">SPJ Moderator</p>
            <p style="font-size:0.75rem; color:#475569; margin:0;">Honorarium untuk moderator.</p>
        </a>

        {{-- SPJ HKI --}}
        <a href="{{ route('template.spj_hki') }}" style="display:block; padding:16px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07); text-decoration:none; transition:border-color 0.15s, background 0.15s;"
            onmouseover="this.style.borderColor='rgba(234,179,8,0.3)'; this.style.background='#1a1706';" onmouseout="this.style.borderColor='rgba(255,255,255,0.07)'; this.style.background='#111827';">
            <div style="width:36px; height:36px; border-radius:8px; background:rgba(234,179,8,0.1); border:1px solid rgba(234,179,8,0.2); display:flex; align-items:center; justify-content:center; margin-bottom:12px;">
                <svg style="width:18px;height:18px;color:#facc15;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
            </div>
            <p style="font-size:0.8125rem; font-weight:600; color:#e2e8f0; margin:0 0 4px;">SPJ HKI</p>
            <p style="font-size:0.75rem; color:#475569; margin:0;">Template untuk pengurusan HKI.</p>
        </a>

    </div>
</x-app-layout>
