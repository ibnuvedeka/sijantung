<x-app-layout>
    <x-slot name="header">Kartu Kendali</x-slot>

    {{-- Tabs --}}
    <div style="display:flex; gap:4px; margin-bottom:16px; background:#0d1117; padding:4px; border-radius:8px; border:1px solid rgba(255,255,255,0.06); width:fit-content;">
        <button onclick="showSection('dashboard')" id="tab-dashboard" class="kk-tab kk-tab-active">
            Dashboard
        </button>
        @if(auth()->check() && auth()->user()->role === 'developer')
        <button onclick="showSection('transaksi')" id="tab-transaksi" class="kk-tab">
            Input Transaksi
        </button>
        @endif
        <button onclick="showSection('laporan')" id="tab-laporan" class="kk-tab">
            Cetak Laporan
        </button>
    </div>

    {{-- === DASHBOARD SECTION === --}}
    <div id="dashboard" class="kk-section">

        {{-- Stat Cards --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(180px, 1fr)); gap:10px; margin-bottom:16px;">
            <div style="padding:14px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07);">
                <p style="font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; margin:0 0 8px;">Total Pagu</p>
                <p id="dash-pagu" style="font-size:1.125rem; font-weight:700; color:#60a5fa; margin:0;">Rp 0</p>
            </div>
            <div style="padding:14px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07);">
                <p style="font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; margin:0 0 8px;">Terserap</p>
                <p id="dash-realisasi" style="font-size:1.125rem; font-weight:700; color:#facc15; margin:0;">Rp 0</p>
            </div>
            <div style="padding:14px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07);">
                <p style="font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569; margin:0 0 8px;">Sisa Saldo</p>
                <p id="dash-sisa" style="font-size:1.125rem; font-weight:700; color:#34d399; margin:0;">Rp 0</p>
            </div>
        </div>

        {{-- Filters --}}
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(170px, 1fr)); gap:8px; margin-bottom:12px;">
            <select id="dashboard-kegiatan" onchange="updateSubKegiatanDropdown('dashboard'); renderDashboard()" class="kk-select">
                <option value="">-- Filter Kegiatan --</option>
            </select>
            <select id="dashboard-sub-kegiatan" onchange="updateRekeningDropdown('dashboard'); renderDashboard()" class="kk-select">
                <option value="">-- Filter Sub Kegiatan --</option>
            </select>
            <select id="dashboard-rekening" onchange="renderDashboard()" class="kk-select">
                <option value="">-- Filter Rekening --</option>
            </select>
            <input type="text" id="search-rka" onkeyup="renderDashboard()" placeholder="Cari teks bebas..."
                style="padding:7px 12px; border-radius:6px; background:#0d1117; border:1px solid rgba(255,255,255,0.1); color:#e2e8f0; font-size:0.8125rem; outline:none;"
                onfocus="this.style.borderColor='rgba(234,179,8,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
        </div>

        {{-- Rincian Table --}}
        <div style="border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07); overflow:hidden;">
            <div style="overflow-x:auto;">
                <table style="width:100%; border-collapse:collapse; min-width:640px;">
                    <thead>
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.07);">
                            <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569;">Kegiatan & Sub</th>
                            <th style="padding:10px 14px; text-align:left; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569;">Rekening</th>
                            <th style="padding:10px 14px; text-align:right; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569;">Pagu</th>
                            <th style="padding:10px 14px; text-align:right; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569;">Terserap</th>
                            <th style="padding:10px 14px; text-align:right; font-size:0.6875rem; font-weight:600; text-transform:uppercase; letter-spacing:0.08em; color:#475569;">Sisa</th>
                        </tr>
                    </thead>
                    <tbody id="dash-rincian">
                        {{-- Data loaded by JS --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- === INPUT TRANSAKSI SECTION === --}}
    @if(auth()->check() && auth()->user()->role === 'developer')
    <div id="transaksi" class="kk-section kk-hidden">
        <div style="max-width:580px;">
            <div style="padding:20px; border-radius:10px; background:#111827; border:1px solid rgba(255,255,255,0.07);">
                <form id="form-transaksi">
                    <div style="display:flex; flex-direction:column; gap:12px;">
                        <div>
                            <label class="kk-label">Kegiatan</label>
                            <select id="transaksi-kegiatan" onchange="updateSubKegiatanDropdown('transaksi')" class="kk-select" style="width:100%;"></select>
                        </div>
                        <div>
                            <label class="kk-label">Sub Kegiatan</label>
                            <select id="transaksi-sub-kegiatan" onchange="updateRekeningDropdown('transaksi')" class="kk-select" style="width:100%;"></select>
                        </div>
                        <div style="position:relative;">
                            <label class="kk-label">Rekening RKA</label>
                            <select id="transaksi-rekening" onchange="updateInfoSaldo()" class="kk-select" style="width:100%;"></select>
                            <div id="info-saldo" style="display:none; position:absolute; right:0; top:0; font-size:0.6875rem; font-weight:700; padding:2px 8px; border-radius:4px; background:rgba(16,185,129,0.1); color:#34d399; border:1px solid rgba(16,185,129,0.2);"></div>
                        </div>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                            <div>
                                <label class="kk-label">Tanggal</label>
                                <input type="date" id="transaksi-tanggal" required class="kk-input" style="width:100%; color-scheme:dark;">
                            </div>
                            <div>
                                <label class="kk-label">Jumlah (Rp)</label>
                                <input type="number" id="transaksi-jumlah" required class="kk-input" style="width:100%;" placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="kk-label">Uraian Belanja</label>
                            <textarea id="transaksi-uraian" required rows="3" class="kk-input" style="width:100%; resize:vertical;" placeholder="Masukkan uraian belanja..."></textarea>
                        </div>
                        <div style="padding-top:10px; border-top:1px solid rgba(255,255,255,0.06);">
                            <button type="submit" style="padding:8px 18px; border-radius:6px; background:rgba(234,179,8,0.15); border:1px solid rgba(234,179,8,0.3); color:#facc15; font-size:0.8125rem; font-weight:600; cursor:pointer;">
                                Simpan Transaksi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    {{-- === LAPORAN SECTION === --}}
    <div id="laporan" class="kk-section kk-hidden">
        {{-- Filter Laporan --}}
        <div class="no-print" style="display:flex; flex-wrap:wrap; gap:8px; align-items:flex-end; margin-bottom:14px;">
            <div>
                <label class="kk-label">Kegiatan</label>
                <select id="laporan-kegiatan" onchange="updateSubKegiatanDropdown('laporan')" class="kk-select"></select>
            </div>
            <div>
                <label class="kk-label">Sub Kegiatan</label>
                <select id="laporan-sub-kegiatan" onchange="updateRekeningDropdown('laporan')" class="kk-select"></select>
            </div>
            <div>
                <label class="kk-label">Rekening</label>
                <select id="laporan-rekening" class="kk-select"></select>
            </div>
            <div style="display:flex; gap:6px; padding-top:18px;">
                <button onclick="renderLaporan()" style="padding:7px 14px; border-radius:6px; background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.1); color:#94a3b8; font-size:0.8125rem; font-weight:500; cursor:pointer;">
                    Tampilkan
                </button>
                <button onclick="window.print()" style="padding:7px 14px; border-radius:6px; background:rgba(234,179,8,0.15); border:1px solid rgba(234,179,8,0.3); color:#facc15; font-size:0.8125rem; font-weight:600; cursor:pointer;">
                    Cetak PDF
                </button>
            </div>
        </div>

        {{-- Print Area --}}
        <div id="print-area" style="background:#111827; border-radius:10px; border:1px solid rgba(255,255,255,0.07); padding:20px; min-height:300px;">
            <div class="no-print" style="text-align:center; color:#475569; padding:40px 0; font-size:0.8125rem; font-style:italic;">
                Pilih filter dan klik "Tampilkan" untuk preview laporan.
            </div>

            <div id="laporan-content" style="display:none; color:#e2e8f0;">
                <div class="print-header" style="display:none; text-align:center; margin-bottom:16px;">
                    <h2 style="font-size:1rem; font-weight:700; text-transform:uppercase; margin:0;">Laporan Kartu Kendali</h2>
                    <p style="font-size:0.75rem; margin:4px 0 0;">Realisasi Anggaran SKPD</p>
                    <div style="border-bottom:2px solid #000; margin-top:8px 0 2px;"></div>
                    <div style="border-bottom:1px solid #000; margin-bottom:16px;"></div>
                </div>

                <div id="laporan-header" style="margin-bottom:14px; font-size:0.8125rem;"></div>

                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; font-size:0.8125rem;" class="laporan-table">
                        <thead>
                            <tr style="background:rgba(255,255,255,0.05);">
                                <th style="border:1px solid rgba(255,255,255,0.1); padding:8px 10px;">No</th>
                                <th style="border:1px solid rgba(255,255,255,0.1); padding:8px 10px;">Tanggal</th>
                                <th style="border:1px solid rgba(255,255,255,0.1); padding:8px 10px; text-align:left;">Uraian</th>
                                <th style="border:1px solid rgba(255,255,255,0.1); padding:8px 10px; text-align:right;">Jumlah (Rp)</th>
                                <th style="border:1px solid rgba(255,255,255,0.1); padding:8px 10px; text-align:right;">Sisa Saldo (Rp)</th>
                            </tr>
                        </thead>
                        <tbody id="laporan-body"></tbody>
                    </table>
                </div>

                <div style="text-align:right; margin-top:32px; font-size:0.8125rem;">
                    <p style="margin-bottom:40px;">Dicetak pada: <span id="tgl-cetak"></span></p>
                    <p style="font-weight:700; border-bottom:1px solid #94a3b8; display:inline-block; min-width:150px; padding-bottom:4px;">Pengguna Anggaran</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Transaksi --}}
    <div id="edit-modal" style="display:none; position:fixed; inset:0; z-index:50; background:rgba(0,0,0,0.7); align-items:center; justify-content:center;">
        <div style="background:#111827; border:1px solid rgba(255,255,255,0.1); border-radius:10px; padding:20px; width:100%; max-width:440px; margin:0 16px;">
            <h3 style="font-size:0.875rem; font-weight:600; color:#e2e8f0; margin:0 0 16px;">Edit Transaksi</h3>
            <form id="form-edit-transaksi">
                <input type="hidden" id="edit-id">
                <div style="display:flex; flex-direction:column; gap:12px;">
                    <div>
                        <label class="kk-label">Tanggal</label>
                        <input type="date" id="edit-tanggal" required class="kk-input" style="width:100%; color-scheme:dark;">
                    </div>
                    <div>
                        <label class="kk-label">Uraian Belanja</label>
                        <textarea id="edit-uraian" required rows="2" class="kk-input" style="width:100%; resize:none;"></textarea>
                    </div>
                    <div>
                        <label class="kk-label">Jumlah (Rp)</label>
                        <input type="number" id="edit-jumlah" required class="kk-input" style="width:100%;">
                    </div>
                    <div style="display:flex; justify-content:flex-end; gap:8px; padding-top:8px; border-top:1px solid rgba(255,255,255,0.06);">
                        <button type="button" onclick="tutupModalEdit()" style="padding:7px 14px; border-radius:6px; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08); color:#94a3b8; font-size:0.8125rem; cursor:pointer;">Batal</button>
                        <button type="submit" style="padding:7px 14px; border-radius:6px; background:rgba(234,179,8,0.15); border:1px solid rgba(234,179,8,0.3); color:#facc15; font-size:0.8125rem; font-weight:600; cursor:pointer;">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<style>
    .kk-tab {
        padding: 6px 14px;
        border-radius: 6px;
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        border: none;
        background: transparent;
        color: #64748b;
        transition: all 0.15s;
    }
    .kk-tab:hover { color: #94a3b8; background: rgba(255,255,255,0.03); }
    .kk-tab-active { background: rgba(234,179,8,0.12) !important; color: #facc15 !important; border: 1px solid rgba(234,179,8,0.2) !important; }
    .kk-section { display: block; }
    .kk-hidden { display: none !important; }
    .kk-label { display: block; font-size: 0.75rem; font-weight: 600; color: #94a3b8; margin-bottom: 6px; }
    .kk-input {
        padding: 7px 12px;
        border-radius: 6px;
        background: #0d1117;
        border: 1px solid rgba(255,255,255,0.1);
        color: #e2e8f0;
        font-size: 0.8125rem;
        outline: none;
        transition: border-color 0.15s;
    }
    .kk-input:focus { border-color: rgba(234,179,8,0.5); }
    .kk-select {
        padding: 7px 12px;
        border-radius: 6px;
        background: #0d1117;
        border: 1px solid rgba(255,255,255,0.1);
        color: #e2e8f0;
        font-size: 0.8125rem;
        outline: none;
        cursor: pointer;
    }

    /* Print styles */
    @page { size: landscape; margin: 15mm; }
    @media print {
        .no-print { display: none !important; }
        nav, header, aside { display: none !important; }
        body, main { background: white !important; padding: 0 !important; margin: 0 !important; }
        #print-area { box-shadow: none !important; border: none !important; padding: 0 !important; background: white !important; color: black !important; }
        #laporan-content { color: black !important; }
        .print-header { display: block !important; }
        .kk-hidden { display: none !important; }
        table { page-break-inside: auto; }
        tr { page-break-inside: avoid; }
        thead { display: table-header-group; }
        .laporan-table th, .laporan-table td { border: 1px solid black !important; color: black !important; }
        #laporan-body tr td { color: black !important; border: 1px solid black !important; }
    }
</style>

<script>
    const dbRKA = @json($rkas);
    const dbTransaksi = @json($transaksis);
    const isDeveloper = @json(auth()->check() && auth()->user()->role === 'developer');

    window.onload = function() {
        renderDropdowns();
        renderDashboard();
    };

    function formatRupiah(n) { return new Intl.NumberFormat('id-ID', {style:'currency', currency:'IDR'}).format(n); }

    window.showSection = function(id) {
        document.querySelectorAll('.kk-section').forEach(el => el.classList.add('kk-hidden'));
        document.getElementById(id).classList.remove('kk-hidden');

        document.querySelectorAll('.kk-tab').forEach(el => {
            el.classList.remove('kk-tab-active');
        });
        let activeTab = document.getElementById('tab-' + id);
        if(activeTab) activeTab.classList.add('kk-tab-active');

        if(id === 'dashboard') renderDashboard();
    }

    function renderDashboard() {
        let totalPagu = dbRKA.reduce((a, b) => a + Number(b.pagu), 0);
        let totalSisa = dbRKA.reduce((a, b) => a + Number(b.sisa), 0);
        document.getElementById('dash-pagu').innerText = formatRupiah(totalPagu);
        document.getElementById('dash-realisasi').innerText = formatRupiah(totalPagu - totalSisa);
        document.getElementById('dash-sisa').innerText = formatRupiah(totalSisa);

        let tbody = document.getElementById('dash-rincian');
        let searchKeyword = (document.getElementById('search-rka')?.value || '').toLowerCase();
        let filterKegiatan = document.getElementById('dashboard-kegiatan')?.value || '';
        let filterSubKegiatan = document.getElementById('dashboard-sub-kegiatan')?.value || '';
        let filterRekening = document.getElementById('dashboard-rekening')?.value || '';

        if (tbody) {
            tbody.innerHTML = '';
            let terserapData = dbRKA.filter(x => (Number(x.pagu) - Number(x.sisa)) > 0);
            if (filterKegiatan) terserapData = terserapData.filter(x => x.kegiatan === filterKegiatan);
            if (filterSubKegiatan) terserapData = terserapData.filter(x => x.sub_kegiatan === filterSubKegiatan);
            if (filterRekening) terserapData = terserapData.filter(x => x.id === Number(filterRekening));
            if (searchKeyword) {
                terserapData = terserapData.filter(x =>
                    (x.kegiatan || '').toLowerCase().includes(searchKeyword) ||
                    (x.sub_kegiatan || '').toLowerCase().includes(searchKeyword) ||
                    (x.kode || '').toLowerCase().includes(searchKeyword) ||
                    (x.nama || '').toLowerCase().includes(searchKeyword)
                );
            }

            if (terserapData.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" style="padding:40px; text-align:center; color:#475569; font-size:0.8125rem; font-style:italic;">Belum ada realisasi anggaran.</td></tr>';
            } else {
                terserapData.forEach(item => {
                    let realisasi = Number(item.pagu) - Number(item.sisa);
                    let transHtml = '';
                    let itemTrans = dbTransaksi.filter(t => t.rka_id === item.id);
                    if(itemTrans.length > 0) {
                        transHtml = '<ul style="list-style:none; margin:8px 0 0; padding:0; display:flex; flex-direction:column; gap:4px;">';
                        itemTrans.forEach(t => {
                            let crudButtons = '';
                            if (isDeveloper) {
                                crudButtons = `<div style="display:flex; gap:6px; flex-shrink:0;">
                                    <button onclick="bukaModalEdit(${t.id})" style="padding:3px 8px; border-radius:4px; background:rgba(96,165,250,0.1); border:1px solid rgba(96,165,250,0.2); color:#60a5fa; font-size:0.6875rem; cursor:pointer;">Edit</button>
                                    <button onclick="hapusTransaksi(${t.id})" style="padding:3px 8px; border-radius:4px; background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.2); color:#f87171; font-size:0.6875rem; cursor:pointer;">Hapus</button>
                                </div>`;
                            }
                            transHtml += `<li style="display:flex; justify-content:space-between; align-items:center; padding:6px 10px; border-radius:6px; background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.05);">
                                <span style="font-size:0.75rem; color:#94a3b8;">${t.uraian} <strong style="color:#e2e8f0;">(${formatRupiah(t.jumlah)})</strong></span>
                                ${crudButtons}
                            </li>`;
                        });
                        transHtml += '</ul>';
                    }

                    tbody.innerHTML += `
                        <tr style="border-bottom:1px solid rgba(255,255,255,0.04);" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                            <td style="padding:10px 14px; vertical-align:top;">
                                <div style="font-size:0.8125rem; font-weight:500; color:#e2e8f0;">${item.kegiatan}</div>
                                <div style="font-size:0.75rem; color:#475569; margin-top:2px;">${item.sub_kegiatan}</div>
                            </td>
                            <td style="padding:10px 14px; vertical-align:top;">
                                <code style="font-size:0.6875rem; background:rgba(255,255,255,0.05); padding:1px 6px; border-radius:3px; color:#64748b;">${item.kode}</code>
                                <div style="font-size:0.8125rem; color:#94a3b8; margin-top:4px;">${item.nama}</div>
                                ${transHtml}
                            </td>
                            <td style="padding:10px 14px; text-align:right; font-size:0.8125rem; font-weight:600; color:#60a5fa; vertical-align:top; white-space:nowrap;">${formatRupiah(item.pagu)}</td>
                            <td style="padding:10px 14px; text-align:right; font-size:0.8125rem; font-weight:600; color:#facc15; vertical-align:top; white-space:nowrap;">${formatRupiah(realisasi)}</td>
                            <td style="padding:10px 14px; text-align:right; font-size:0.8125rem; font-weight:600; color:#34d399; vertical-align:top; white-space:nowrap;">${formatRupiah(item.sisa)}</td>
                        </tr>
                    `;
                });
            }
        }
    }

    function getUnique(arr) { return [...new Set(arr)]; }

    function renderDropdowns() {
        let kegiatanList = getUnique(dbRKA.map(x => x.kegiatan).filter(Boolean));
        let opts = '<option value="">-- Filter Kegiatan --</option>';
        kegiatanList.forEach(k => opts += `<option value="${k}">${k}</option>`);

        ['transaksi', 'laporan'].forEach(type => {
            let el = document.getElementById(`${type}-kegiatan`);
            if(el) {
                el.innerHTML = opts;
                document.getElementById(`${type}-sub-kegiatan`).innerHTML = '<option value="">-- Filter Sub Kegiatan --</option>';
                document.getElementById(`${type}-rekening`).innerHTML = '<option value="">-- Filter Rekening --</option>';
            }
        });

        let terserapData = dbRKA.filter(x => (Number(x.pagu) - Number(x.sisa)) > 0);
        let dashKegiatanList = getUnique(terserapData.map(x => x.kegiatan).filter(Boolean));
        let dashOpts = '<option value="">-- Filter Kegiatan --</option>';
        dashKegiatanList.forEach(k => dashOpts += `<option value="${k}">${k}</option>`);

        if (document.getElementById('dashboard-kegiatan')) {
            document.getElementById('dashboard-kegiatan').innerHTML = dashOpts;
            document.getElementById('dashboard-sub-kegiatan').innerHTML = '<option value="">-- Filter Sub Kegiatan --</option>';
            document.getElementById('dashboard-rekening').innerHTML = '<option value="">-- Filter Rekening --</option>';
        }
    }

    window.updateSubKegiatanDropdown = function(type) {
        let keg = document.getElementById(`${type}-kegiatan`).value;
        let dataSumber = (type === 'dashboard') ? dbRKA.filter(x => (Number(x.pagu) - Number(x.sisa)) > 0) : dbRKA;
        let subKegList = getUnique(dataSumber.filter(x => x.kegiatan === keg).map(x => x.sub_kegiatan).filter(Boolean));
        let opts = '<option value="">-- Filter Sub Kegiatan --</option>';
        subKegList.forEach(sk => opts += `<option value="${sk}">${sk}</option>`);
        document.getElementById(`${type}-sub-kegiatan`).innerHTML = opts;
        document.getElementById(`${type}-rekening`).innerHTML = '<option value="">-- Filter Rekening --</option>';
        if (type === 'transaksi') updateInfoSaldo();
    }

    window.updateRekeningDropdown = function(type) {
        let keg = document.getElementById(`${type}-kegiatan`).value;
        let subKeg = document.getElementById(`${type}-sub-kegiatan`).value;
        let dataSumber = (type === 'dashboard') ? dbRKA.filter(x => (Number(x.pagu) - Number(x.sisa)) > 0) : dbRKA;
        let rkaList = dataSumber.filter(x => x.kegiatan === keg && x.sub_kegiatan === subKeg);
        let opts = '<option value="">-- Filter Rekening --</option>';
        rkaList.forEach(x => opts += `<option value="${x.id}">${x.kode} - ${x.nama}</option>`);
        document.getElementById(`${type}-rekening`).innerHTML = opts;
        if (type === 'transaksi') updateInfoSaldo();
    }

    window.updateInfoSaldo = function() {
        let id_rka = Number(document.getElementById('transaksi-rekening').value);
        let item = dbRKA.find(x => x.id === id_rka);
        let el = document.getElementById('info-saldo');
        if(item) {
            el.innerText = `Sisa: ${formatRupiah(item.sisa)}`;
            el.style.display = 'block';
            el.style.background = item.sisa > 0 ? 'rgba(16,185,129,0.1)' : 'rgba(239,68,68,0.1)';
            el.style.color = item.sisa > 0 ? '#34d399' : '#f87171';
            el.style.borderColor = item.sisa > 0 ? 'rgba(16,185,129,0.2)' : 'rgba(239,68,68,0.2)';
        } else {
            el.style.display = 'none';
        }
    }

    const formTransaksi = document.getElementById('form-transaksi');
    if(formTransaksi) formTransaksi.addEventListener('submit', async function(e) {
        e.preventDefault();
        let id_rka = Number(document.getElementById('transaksi-rekening').value);
        let nom = Number(document.getElementById('transaksi-jumlah').value);
        let idx = dbRKA.findIndex(x => x.id === id_rka);

        if(!id_rka) { alert("Pilih rekening dulu!"); return; }
        if(nom > dbRKA[idx].sisa) { alert("Saldo tidak mencukupi! Sisa pagu tinggal " + formatRupiah(dbRKA[idx].sisa)); return; }

        const dataKirim = {
            id: id_rka,
            kode: dbRKA[idx].kode,
            tanggal: document.getElementById('transaksi-tanggal').value,
            uraian: document.getElementById('transaksi-uraian').value,
            jumlah: nom
        };

        try {
            const response = await fetch("{{ route('kartukendali.store') }}", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify(dataKirim)
            });
            if(response.ok) { alert("Transaksi berhasil disimpan!"); window.location.reload(); }
            else { const d = await response.json(); alert("Gagal: " + (d.message || "Terjadi kesalahan")); }
        } catch (error) { console.error("Error:", error); alert("Terjadi kesalahan jaringan."); }
    });

    window.hapusTransaksi = async function(id) {
        if(!confirm("Yakin ingin menghapus transaksi ini? Saldo RKA akan otomatis dikembalikan.")) return;
        try {
            const response = await fetch(`/kartu-kendali/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });
            if(response.ok) { alert("Transaksi berhasil dihapus!"); window.location.reload(); }
            else { const d = await response.json(); alert("Gagal: " + (d.message || "Terjadi kesalahan")); }
        } catch (error) { console.error("Error:", error); alert("Terjadi kesalahan jaringan."); }
    }

    window.bukaModalEdit = function(id) {
        let t = dbTransaksi.find(x => x.id === id);
        if(!t) return;
        document.getElementById('edit-id').value = t.id;
        document.getElementById('edit-tanggal').value = t.tanggal;
        document.getElementById('edit-uraian').value = t.uraian;
        document.getElementById('edit-jumlah').value = t.jumlah;
        document.getElementById('edit-modal').style.display = 'flex';
    }

    window.tutupModalEdit = function() {
        document.getElementById('edit-modal').style.display = 'none';
    }

    const formEditTransaksi = document.getElementById('form-edit-transaksi');
    if(formEditTransaksi) formEditTransaksi.addEventListener('submit', async function(e) {
        e.preventDefault();
        let id = document.getElementById('edit-id').value;
        let dataEdit = {
            tanggal: document.getElementById('edit-tanggal').value,
            uraian: document.getElementById('edit-uraian').value,
            jumlah: Number(document.getElementById('edit-jumlah').value)
        };
        try {
            const response = await fetch(`/kartu-kendali/${id}`, {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify(dataEdit)
            });
            if(response.ok) { alert("Transaksi berhasil diperbarui!"); window.location.reload(); }
            else { const d = await response.json(); alert("Gagal update: " + (d.message || "Terjadi kesalahan")); }
        } catch (error) { console.error("Error:", error); alert("Terjadi kesalahan jaringan."); }
    });

    window.renderLaporan = function() {
        let k = document.getElementById('laporan-rekening').value;
        let rka = dbRKA.find(x => x.id === Number(k));
        if(!rka) { alert("Pilih rekening terlebih dahulu."); return; }

        let laporanContent = document.getElementById('laporan-content');
        laporanContent.style.display = 'block';

        document.getElementById('laporan-header').innerHTML = `
            <table style="width:100%; font-size:0.8125rem; margin-bottom:12px;">
                <tr><td style="width:160px; vertical-align:top; font-weight:600;">Program</td><td style="width:16px;">:</td><td><strong>${rka.program || '-'}</strong></td></tr>
                <tr><td style="vertical-align:top; font-weight:600;">Kegiatan</td><td>:</td><td><strong>${rka.kegiatan || '-'}</strong></td></tr>
                <tr><td style="vertical-align:top; font-weight:600;">Sub Kegiatan</td><td>:</td><td><strong>${rka.sub_kegiatan || '-'}</strong></td></tr>
                <tr><td style="vertical-align:top; font-weight:600;">Rekening</td><td>:</td><td><strong>${rka.kode} - ${rka.nama}</strong></td></tr>
                <tr><td style="vertical-align:top; font-weight:600; padding-top:6px;">Total Pagu</td><td style="padding-top:6px;">:</td><td style="padding-top:6px;"><strong>${formatRupiah(rka.pagu)}</strong></td></tr>
            </table>
        `;

        let trans = dbTransaksi.filter(x => x.rka_id === rka.id);
        let tbody = document.getElementById('laporan-body');
        tbody.innerHTML = `
            <tr style="background:rgba(255,255,255,0.05);">
                <td colspan="3" style="border:1px solid rgba(255,255,255,0.1); padding:8px; text-align:center; font-weight:700;">PAGU AWAL</td>
                <td style="border:1px solid rgba(255,255,255,0.1); padding:8px; text-align:center;">-</td>
                <td style="border:1px solid rgba(255,255,255,0.1); padding:8px; text-align:right; font-weight:700;">${formatRupiah(rka.pagu)}</td>
            </tr>
        `;

        trans.forEach((t, i) => {
            tbody.innerHTML += `
                <tr>
                    <td style="border:1px solid rgba(255,255,255,0.1); padding:8px; text-align:center;">${i+1}</td>
                    <td style="border:1px solid rgba(255,255,255,0.1); padding:8px;">${t.tanggal}</td>
                    <td style="border:1px solid rgba(255,255,255,0.1); padding:8px;">${t.uraian}</td>
                    <td style="border:1px solid rgba(255,255,255,0.1); padding:8px; text-align:right;">${formatRupiah(t.jumlah)}</td>
                    <td style="border:1px solid rgba(255,255,255,0.1); padding:8px; text-align:right; font-weight:700;">${formatRupiah(t.sisa_akhir)}</td>
                </tr>
            `;
        });

        const today = new Date();
        document.getElementById('tgl-cetak').innerText = today.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
    }
</script>

</x-app-layout>