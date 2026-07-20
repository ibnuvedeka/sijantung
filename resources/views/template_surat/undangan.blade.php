<x-app-layout>
    <style>
        @media print {
            /* KUNCI ANTI-ROLL GESER: Hilangkan wujud scrollbar saat masuk ke mode PDF */
            ::-webkit-scrollbar {
                display: none !important;
            }
            * {
                scrollbar-width: none !important;
            }

            body * { visibility: hidden; }
            #print-area, #print-area * { visibility: visible; }
            
            #print-area { 
                position: absolute; left: 0; top: 0; width: 100%; margin: 0; padding: 0; box-shadow: none; 
                display: block !important; /* Mematikan error Flexbox Chrome saat print */
            }
            .no-print { display: none !important; }
            
            @page { size: A4; margin: 0mm; } 
            
            body { 
                margin: 0; 
                -webkit-print-color-adjust: exact !important; 
                print-color-adjust: exact !important; 
            }
            
            .a4-paper {
                box-shadow: none !important;
                margin: 0 !important;
                width: 210mm !important;
                /* KUNCI FIX HALAMAN 3: Bebaskan tinggi kertas saat dicetak */
                min-height: auto !important; 
                height: auto !important;
            }
        }
        
        /* Tampilan layar monitor (Tetap menggunakan 297mm agar preview terlihat presisi) */
        .a4-paper {
            width: 210mm;
            min-height: 297mm;
            background: white;
            padding: 7mm; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            margin: 0 auto;
            font-family: 'Arial', Times, serif;
            color: black;
            font-size: 12pt;
            line-height: 1.5;
        }
        
        #box_qr_draggable::-webkit-resizer {
            display: none;
        }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center no-print">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('TEMPLATE SURAT UNDANGAN') }}
            </h2>
            <div class="flex items-center gap-2">
            <button id="btn-cetak" onclick="simpanDanCetak()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded shadow flex items-center text-sm font-bold transition-all">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak / Simpan PDF
            </button>
            </div>
        </div>
    </x-slot>

    <div class="py-6 flex flex-col lg:flex-row gap-6 items-start max-w-full px-4 sm:px-6 lg:px-8">
        
        <div class="w-full lg:w-1/3 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 overflow-y-auto no-print border border-gray-200 dark:border-gray-700" style="max-height: 85vh;">
            <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4 border-b pb-2">Pengaturan Surat</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Penerbit Surat</label>
                    <select id="in_instansi" onchange="updatePreview()" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="setda">Sekretariat Daerah</option>
                        <option value="bappelitbang">Bappelitbang</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nomor Urut Surat</label>
                    <div class="flex items-center mt-1">
                        <span class="text-xs text-gray-500 bg-gray-100 p-2 border border-r-0 rounded-l-md border-gray-300">000.9.2/</span>
                        <input type="text" id="in_nomor" onkeyup="updatePreview()" placeholder="123" class="block w-20 border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm z-10">
                        <input type="text" id="in_suffix" onkeyup="updatePreview()" value="-Litbang/Bappelitbang/2026" class="block w-full border-gray-300 rounded-r-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Tanggal Pembuatan Surat</label>
                    <input type="date" id="in_tgl_surat" onchange="updatePreview()" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Perihal</label>
                    <input type="text" id="in_perihal" onkeyup="updatePreview()" value="Rapat..." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Yth.</label>
                        <textarea id="in_tujuan" onkeyup="updatePreview()" rows="2" class="mt-1 block w-full rounded-md border-gray-300 text-sm">Bapak/Ibu</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Di (Tempat)</label>
                        <input type="text" id="in_tempat_tujuan" onkeyup="updatePreview()" value="Rantau" class="mt-1 block w-full rounded-md border-gray-300 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Isi Paragraf Pembuka</label>
                    <textarea id="in_pembuka" onkeyup="updatePreview()" rows="3" class="mt-1 block w-full rounded-md border-gray-300 text-sm">Sehubungan...</textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Isi Paragraf Penutup</label>
                    <textarea id="in_penutup" onkeyup="updatePreview()" rows="3" class="mt-1 block w-full rounded-md border-gray-300 text-sm">Demikian surat undangan ini kami sampaikan.......</textarea>
                </div>

                <div class="mt-4">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Upload QR Code TTE</label>
                    <input type="file" id="in_qr_code" accept="image/png, image/jpeg" onchange="previewQRCode(event)" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 border border-gray-300 rounded-md">
                </div>

                <hr class="border-gray-300 dark:border-gray-600">
                <h4 class="font-bold text-md text-gray-800 dark:text-gray-200">Jadwal Pelaksanaan</h4>
                
                <div class="grid grid-cols-2 gap-2">
                    <div wire:ignore>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Tanggal Acara</label>
                        <input type="text" id="in_tgl_acara" placeholder="Pilih tanggal..." class="mt-1 block w-full rounded-md border-gray-300 text-sm bg-white">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Waktu</label>
                        <input type="text" id="in_waktu" onkeyup="updatePreview()" value="10.00 s.d 12.00" class="mt-1 block w-full rounded-md border-gray-300 text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Tempat Acara</label>
                    <input type="text" id="in_tempat_acara" onkeyup="updatePreview()" value="Aula Perencanaan Bappelitbang Lt.2" class="mt-1 block w-full rounded-md border-gray-300 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Acara</label>
                    <input type="text" id="in_acara" onkeyup="updatePreview()" value="Rapat Koordinasi" class="mt-1 block w-full rounded-md border-gray-300 text-sm">
                </div>

                <hr class="border-gray-300 dark:border-gray-600">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Gunakan Lampiran?</label>
                    <select id="in_lampiran" onchange="updatePreview()" class="mt-1 block w-full rounded-md border-gray-300 text-sm">
                        <option value="ya">Ya, Gunakan Lampiran</option>
                        <option value="tidak">Tidak, Hapus Lampiran</option>
                    </select>
                </div>

                <div id="box_daftar_undangan" class="border border-gray-200 rounded p-3 bg-gray-50 h-96 overflow-y-auto">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Daftar Undangan:</label>
                    
                    <div class="flex items-start mb-2 border-b border-gray-300 pb-2">
                        <div class="flex items-center h-5">
                            <input type="checkbox" id="chk_all" onchange="toggleSelectAll(this)" class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        </div>
                        <div class="ml-2 text-sm">
                            <label for="chk_all" class="font-bold text-gray-900">Pilih Semua</label>
                        </div>
                    </div>
                    
                    <div id="checkbox_container" class="space-y-1 text-sm"></div>
                </div>

            </div>
        </div>

        <div class="w-full lg:w-2/3 overflow-x-auto flex flex-col items-center gap-8 pb-10 print:block print:gap-0 print:pb-0" id="print-area">
            
            <div class="a4-paper relative">
                
                <div class="flex items-center justify-between pb-2">
                    <div class="w-24 flex-shrink-0 flex items-center justify-center">
                        <img src="{{ asset('images/logotapin.png') }}" class="h-24 w-auto block" alt="Logo Tapin">
                    </div>
                    
                    <div class="text-center flex-1 pl-4 leading-tight w-full">
                        <h1 class="text-[14pt] font-bold uppercase tracking-wider -mt-3">Pemerintah Kabupaten Tapin</h1>
                        <h2 id="out_instansi_nama" class="text-[14pt] font-bold uppercase mt-1 leading-tight m-0">SEKRETARIAT DAERAH</h2>
                        <p id="out_instansi_alamat" class="text-[11pt] mt-0 m-0 tracking-wide w-full" style="text-align: justify; text-align-last: justify;">Jalan Datu Nuraya RT 1 Rangda Malingkung, Kawasan Rantau Baru Rantau, Tapin 71114</p>
                    </div>
                </div>

                <div class="w-full border-t-[1px] border-black mb-[2px]"></div>
                <div class="w-full border-t-[4px] border-black mb-5"></div>

                <div class="text-right mb-6 text-[12pt]">
                    Rantau, <span id="out_tgl_surat">..........................</span>
                </div>

                <div class="mb-6 text-[12pt] w-full">
                    <table class="table-auto w-full">
                        <tr>
                            <td class="w-24 align-top">Nomor</td>
                            <td class="w-4 align-top text-center">:</td>
                            <td class="align-top whitespace-nowrap">000.9.2/<span id="out_nomor">...</span><span id="out_suffix"></span></td>
                        </tr>
                        <tr>
                            <td class="w-24 align-top">Sifat</td>
                            <td class="w-4 align-top text-center">:</td>
                            <td class="align-top">Biasa</td>
                        </tr>
                        <tr id="row_lampiran_header">
                            <td class="w-24 align-top">Lampiran</td>
                            <td class="w-4 align-top text-center">:</td>
                            <td class="align-top">satu lampiran</td>
                        </tr>
                        <tr>
                            <td class="w-24 align-top">Hal</td>
                            <td class="w-4 align-top text-center">:</td>
                            <td class="font-normal align-top text-justify pr-4" id="out_perihal"></td>
                        </tr>
                    </table>

                    <div class="mt-4 mb-6 text-[12pt] ml-12">
                        <p class="leading-snug">
                            Yth. <span id="out_tujuan"></span><br>
                            <span id="out_teks_terlampir" style="display: none;">(Daftar Terlampir)<br></span>
                            di<br>
                            <span class="pl-0" id="out_tempat_tujuan"></span>
                        </p>
                    </div>

                    <div class="text-justify text-[12pt] leading-normal mb-6">
                        <div class="mb-3" style="text-indent: 3rem; text-align: justify;" id="out_pembuka"></div>
                        <table class="table-fixed mb-3" style="margin-left: 3rem; width: calc(100% - 3rem);">
                            <tr><td class="w-32 py-1 align-top">hari, tanggal</td><td class="w-4 align-top">:</td><td class="align-top font-normal" id="out_hari_tanggal">...........................</td></tr>
                            <tr><td class="w-32 py-1 align-top">waktu</td><td class="w-4 align-top">:</td><td class="align-top" id="out_waktu"></td></tr>
                            <tr><td class="w-32 py-1 align-top">tempat</td><td class="w-4 align-top">:</td><td class="align-top font-normal" id="out_tempat_acara"></td></tr>
                            <tr><td class="w-32 py-1 align-top">acara</td><td class="w-4 align-top">:</td><td class="align-top" id="out_acara"></td></tr>
                        </table>
                        <div class="mb-3 text-justify" id="out_penutup"></div>
                    </div>

                    <table class="w-full mt-12" style="page-break-inside: avoid; break-inside: avoid; border-collapse: collapse; border: none;">
                        <tr>
                            <td class="w-1/2 align-bottom text-left pb-4 text-[12pt]">
                                <p class="mb-1">Tembusan:</p>
                                <ol class="list-decimal pl-5 m-0" id="out_tembusan"></ol>
                            </td>
                            <td class="w-1/2 align-bottom text-right">
                                <div class="flex justify-end w-full relative min-h-[150px]">
                                    <div id="box_ttd_text" class="w-80 text-center" style="display: none;"></div>
                                    <div id="box_ttd_tte" class="w-[36rem] -mr-32" style="display: block;">
                                        <img src="{{ asset('images/ttebox_kaban.png') }}" class="w-full h-auto block" alt="TTE Bappelitbang">
                                    </div>
                                    <div id="box_qr_draggable" class="absolute z-50 p-1 cursor-move hidden bg-transparent border border-transparent hover:border-dashed hover:border-gray-500 transition-colors" 
                                         style="width: 112px; height: 112px; resize: both; overflow: hidden; bottom: 0; right: 0;">
                                        <img id="out_img_qr" src="" class="w-full h-full object-contain pointer-events-none" alt="QR Code Upload">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>

            <div id="halaman_lampiran" class="a4-paper relative mt-8 print:mt-0" style="page-break-before: always; break-before: page; margin-top: 0 !important;">
                <div class="w-1/2 ml-auto text-[11pt] mb-8 leading-tight">
                    <table class="w-full">
                        <tr><td class="w-20 align-top">Lampiran I</td><td class="w-4 align-top"></td><td class="align-top" id="out_judul_lampiran">Surat Sekretaris Daerah</td></tr>
                        <tr><td class="align-top">Nomor</td><td class="align-top">:</td><td class="align-top">000.9.2/<span id="out_nomor_lamp">...</span><span id="out_suffix_lamp"></span></td></tr>
                        <tr><td class="align-top">Tanggal</td><td class="align-top">:</td><td class="align-top" id="out_tgl_lamp">...</td></tr>
                    </table>
                </div>

                <h3 class="text-center font-bold text-[12pt] uppercase mb-6 underline">Daftar Undangan</h3>

                <div class="px-10 text-[12pt]">
                    <table class="w-full" id="tabel_undangan_lampiran"></table>
                </div>
            </div>

        </div>
    </div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

<script>
    const daftarUndangan = ["Bupati Tapin", "Wakil Bupati Tapin", "Sekretaris Daerah Kabupaten Tapin", "Asisten Pemerintahan dan Kesejahteraan Rakyat", "Asisten Ekonomi dan Pembangunan", "Asisten Administrasi Umum", "Staf Ahlli Bidang Pemerintahan, Hukum dan Politik", "Staf Ahli Bidang Ekonomi, Keuangan & Pembangunan", "Staf Ahli Bidang Kemasyarakatan & SDM", "Sekretaris DPRD Kabupaten Tapin", "PLT. Inspektorat/Inspektur Kabupaten Tapin", "Kepala Badan Perencanaan Pembangunan, Penelitian, dan Pengembangan Kabupaten Tapin", "Kepala Badan Keuangan Dan Aset Daerah Kabupaten Tapin", "Kepala Badan Pendapatan Daerah Kabupaten Tapin", "Kepala Badan Kepegawaian dan Pengembangan Sumber Daya Manusia Kabupaten Tapin", "Kepala Badan Penanggulangan Bencana Daerah Kabupaten Tapin", "Kepala Badan Kesatuan Bangsa dan Politik Kabupaten Tapin", "Kepala Dinas Ketahanan Pangan Kabupaten Tapin", "Kepala Dinas Perpustakaan dan Kearsipan Kabupaten Tapin", "Kepala Dinas Perhubungan Kabupaten Tapin", "Kepala Satuan Polisi Pamong Praja dan Kebakaran Kabupaten Tapin", "Plt. Kepala Dinas Pengendalian Penduduk dan Keluarga Berencana Kabupaten Tapin", "Kepala Dinas Kesehatan Kabupaten Tapin", "Kepala Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Tapin", "Kepala Dinas Tenaga Kerja Kabupaten Tapin", "Kepala Dinas Pendidikan Kabupaten Tapin", "Kepala Dinas Pemuda dan Olahraga Kabupaten Tapin", "Kepala Dinas Sosial Kabupaten Tapin", "Kepala Dinas Pertanian Kabupaten Tapin", "Kepala Dinas Komunikasi dan Informatika Kabupaten Tapin", "Kepala Dinas Kebudayaan dan Pariwisata Kabupaten Tapin", "Kepala Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Tapin", "Kepala Dinas Perumahan, Kawasan Permukiman dan Pertanahan Kabupaten Tapin", "Kepala Dinas Pemberdayaan Perempuan dan Perlindungan Anak Kabupaten Tapin", "Kepala Dinas Perindustrian Kabupaten Tapin", "Kepala Dinas Lingkungan Hidup Kabupaten Tapin", "Kepala Dinas Perdagangan Kabupaten Tapin", "Kepala Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu Kabupaten Tapin", "Kepala Dinas Kependudukan dan Pencatatan Sipil Kabupaten Tapin", "Kepala Dinas Perikanan Kabupaten Tapin", "Kepala Bagian Tata Pemerintahan Sekretariat Daerah Kabupaten Tapin", "Kepala Bagian Kesejahteraan Rakyat Sekretariat Daerah Kabupaten Tapin", "Kepala Bagian Protokol dan Komunikasi Pimpinan Sekretariat Daerah Kabupaten Tapin", "Kepala Bagian Perekonomi dan Administrasi Pembangunan Sekretariat Daerah Kabupaten Tapin", "Kepala Bagian Perlengkapan dan Rumah Tangga Sekretariat Daerah Kabupaten Tapin", "Kepala Bagian Pengadaan Barang dan Jasa Sekretariat Daerah Kabupaten Tapin", "Kepala Bagian Hukum Sekretariat Daerah Kabupaten Tapin", "Kepala Bagian Umum Sekretariat Daerah Kabupaten Tapin", "Kepala Bagian Organisasi Sekretariat Daerah Kabupaten Tapin", "Camat Tapin Utara Kabupaten Tapin", "Camat Tapin Selatan Kabupaten Tapin", "Camat Tapin Tengah Kabupaten Tapin", "Camat Bakarangan Kabupaten Tapin", "Camat Bungur Kabupaten Tapin", "Plt. Camat Binuang Kabupaten Tapin", "Camat Candi Laras Selatan Kabupaten Tapin", "Camat Piani Kabupaten Tapin", "Camat Salam Babaris Kabupaten Tapin", "Camat Hatungun Kabupaten Tapin", "Camat Lokpaikat Kabupaten Tapin", "Plt. Camat Candi Laras Utara Kabupaten Tapin", "Direktur BLUD Datu Sanggul Kabupaten Tapin", "Kepala UPTD Puskesmas se Kabupaten Tapin Kabupaten Tapin"];

    function formatTanggal(dateStr) {
        if(!dateStr) return '...';
        const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const d = new Date(dateStr);
        return `${d.getDate()} ${bulan[d.getMonth()]} ${d.getFullYear()}`;
    }

    function updatePreview() {
        const instansi = document.getElementById('in_instansi') ? document.getElementById('in_instansi').value : '';
        const nomor = document.getElementById('in_nomor') ? document.getElementById('in_nomor').value : '...';
        const suffix = document.getElementById('in_suffix') ? document.getElementById('in_suffix').value : '';
        const tglSurat = document.getElementById('in_tgl_surat') ? document.getElementById('in_tgl_surat').value : '';
        const perihal = document.getElementById('in_perihal') ? document.getElementById('in_perihal').value : '';
        const tujuan = document.getElementById('in_tujuan') ? document.getElementById('in_tujuan').value : '';
        const tempatTujuan = document.getElementById('in_tempat_tujuan') ? document.getElementById('in_tempat_tujuan').value : '';
        const pembuka = document.getElementById('in_pembuka') ? document.getElementById('in_pembuka').value : '';
        const waktu = document.getElementById('in_waktu') ? document.getElementById('in_waktu').value : '';
        const tempatAcara = document.getElementById('in_tempat_acara') ? document.getElementById('in_tempat_acara').value : '';
        const acara = document.getElementById('in_acara') ? document.getElementById('in_acara').value : '';
        const lampiran = document.getElementById('in_lampiran') ? document.getElementById('in_lampiran').value : '';
        const elPenutup = document.getElementById('in_penutup');
        const penutup = elPenutup ? elPenutup.value : '';

        // Ambil data Flatpickr (DENGAN MEMORI BACKUP ANTI-HILANG)
            const tglInput = document.getElementById('in_tgl_acara');
            let date1 = null;
            let date2 = null;

            // 1. Prioritaskan membaca dari memori global jika ada
            if (window.backupTglAcara && window.backupTglAcara.length > 0) {
                date1 = window.backupTglAcara[0];
                if (window.backupTglAcara.length > 1) date2 = window.backupTglAcara[1];
                
                // JIKA KOTAK INPUT MENDADAK KOSONG SAAT UPLOAD, PULIHKAN PAKSA!
                if (tglInput && tglInput.value === '' && tglInput._flatpickr) {
                    tglInput._flatpickr.setDate(window.backupTglAcara);
                }
            } 
            // 2. Jika belum ada di memori, baca normal dari inputnya
            else if (tglInput) {
                if (tglInput._flatpickr && tglInput._flatpickr.selectedDates.length > 0) {
                    date1 = tglInput._flatpickr.selectedDates[0];
                    if (tglInput._flatpickr.selectedDates.length > 1) date2 = tglInput._flatpickr.selectedDates[1];
                } else if (tglInput.value) {
                    const rawDates = tglInput.value.split(" to ");
                    if (rawDates[0]) date1 = new Date(rawDates[0]);
                    if (rawDates[1]) date2 = new Date(rawDates[1]);
                }
            }

            // Tampilkan tanggal acara ke surat
            const targetElement = document.getElementById('out_hari_tanggal');
            if (targetElement) {
                targetElement.innerText = formatHariTanggalRange(date1, date2);
            }

        if (instansi === 'setda') {
            if(document.getElementById('out_instansi_nama')) {
                document.getElementById('out_instansi_nama').innerHTML = "SEKRETARIAT DAERAH";
                document.getElementById('out_instansi_nama').className = "text-[18pt] font-bold uppercase mt-1 text-black leading-tight m-0";
            }
            if(document.getElementById('out_instansi_alamat')) document.getElementById('out_instansi_alamat').innerText = "Jalan Datu Nuraya RT 1 Rangda Malingkung, Kawasan Rantau Baru Rantau, Tapin 71114";
            if(document.getElementById('out_judul_lampiran')) document.getElementById('out_judul_lampiran').innerText = "Surat Sekretaris Daerah";
            if(document.getElementById('box_ttd_text')) document.getElementById('box_ttd_text').style.display = "block";
            if(document.getElementById('box_ttd_tte')) document.getElementById('box_ttd_tte').style.display = "none";
            if(document.getElementById('out_tembusan')) document.getElementById('out_tembusan').innerHTML = `<li>Bupati Tapin</li><li>Wakil Bupati Tapin.</li>`;
        } else {
            if(document.getElementById('out_instansi_nama')) {
                document.getElementById('out_instansi_nama').innerHTML = `<img src="/images/namakantor.png" class="h-16 w-auto mx-auto" alt="Logo Nama Bappelitbang">`;
                document.getElementById('out_instansi_nama').className = "mt-1 m-0";
            }
            if(document.getElementById('out_instansi_alamat')) document.getElementById('out_instansi_alamat').innerText = "Jalan Datu Nuraya RT 1 Rangda Malingkung, Kawasan Rantau Baru Rantau, Tapin 71114";
            if(document.getElementById('out_judul_lampiran')) document.getElementById('out_judul_lampiran').innerText = "Surat Kepala Bappelitbang";
            if(document.getElementById('box_ttd_text')) document.getElementById('box_ttd_text').style.display = "none";
            if(document.getElementById('box_ttd_tte')) document.getElementById('box_ttd_tte').style.display = "block";
            if(document.getElementById('out_tembusan')) document.getElementById('out_tembusan').innerHTML = `<li>Bupati Tapin</li><li>Wakil Bupati Tapin</li><li>Sekretaris Daerah Kabupaten Tapin.</li>`;
        }

        if(document.getElementById('out_nomor')) document.getElementById('out_nomor').innerText = nomor;
        if(document.getElementById('out_suffix')) document.getElementById('out_suffix').innerText = suffix;
        if(document.getElementById('out_nomor_lamp')) document.getElementById('out_nomor_lamp').innerText = nomor;
        if(document.getElementById('out_suffix_lamp')) document.getElementById('out_suffix_lamp').innerText = suffix;
        if(document.getElementById('out_perihal')) document.getElementById('out_perihal').innerText = perihal;
        if(document.getElementById('out_tujuan')) document.getElementById('out_tujuan').innerHTML = tujuan.replace(/\n/g, '<br>');
        if(document.getElementById('out_tempat_tujuan')) document.getElementById('out_tempat_tujuan').innerText = tempatTujuan;
        
        const outPembuka = document.getElementById('out_pembuka');
        if (outPembuka && pembuka) {
            const barisPembuka = pembuka.split('\n'); 
            let hasilPembuka = '';
            barisPembuka.forEach(baris => {
                if(baris.trim() !== '') hasilPembuka += `<p style="text-indent: 3rem; margin-bottom: 0.25rem;">${baris}</p>`;
            });
            outPembuka.innerHTML = hasilPembuka;
        }
        
        const outPenutup = document.getElementById('out_penutup');
        if (outPenutup && penutup) {
            const barisPenutup = penutup.split('\n');
            let hasilPenutup = '';
            barisPenutup.forEach(baris => {
                if(baris.trim() !== '') hasilPenutup += `<p style="text-indent: 3rem; margin-bottom: 0.25rem;">${baris}</p>`;
            });
            outPenutup.innerHTML = hasilPenutup;
        }

        if(document.getElementById('out_waktu')) document.getElementById('out_waktu').innerText = waktu;
        if(document.getElementById('out_tempat_acara')) document.getElementById('out_tempat_acara').innerText = tempatAcara;
        if(document.getElementById('out_acara')) document.getElementById('out_acara').innerText = acara;
        
        const txtTglSurat = formatTanggal(tglSurat);
        if(document.getElementById('out_tgl_surat')) document.getElementById('out_tgl_surat').innerText = tglSurat ? txtTglSurat : "..........................";
        if(document.getElementById('out_tgl_lamp')) document.getElementById('out_tgl_lamp').innerText = tglSurat ? txtTglSurat : "..........................";

        const halamanLampiran = document.getElementById('halaman_lampiran');
        const rowLampiranHeader = document.getElementById('row_lampiran_header');
        const outTeksTerlampir = document.getElementById('out_teks_terlampir');
        const boxDaftarUndangan = document.getElementById('box_daftar_undangan'); 

        if (lampiran === 'ya') {
            if(halamanLampiran) halamanLampiran.style.display = 'block';
            if(rowLampiranHeader) rowLampiranHeader.style.display = 'table-row';
            if(outTeksTerlampir) outTeksTerlampir.style.display = 'inline';
            if(boxDaftarUndangan) boxDaftarUndangan.style.display = 'block'; 
            renderDaftarUndangan(); 
        } else {
            if(halamanLampiran) halamanLampiran.style.display = 'none';
            if(rowLampiranHeader) rowLampiranHeader.style.display = 'none';
            if(outTeksTerlampir) outTeksTerlampir.style.display = 'none';
            if(boxDaftarUndangan) boxDaftarUndangan.style.display = 'none'; 
        }
    }

    function formatHariTanggalRange(d1, d2) {
        if (!d1 || isNaN(d1)) return "...........................";
        const hariArr = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const bulanArr = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const hari1 = hariArr[d1.getDay()], tgl1 = d1.getDate(), bln1 = bulanArr[d1.getMonth()], thn1 = d1.getFullYear();
        const teksMulai = `${hari1}, ${tgl1} ${bln1} ${thn1}`;

        if (!d2 || isNaN(d2) || d1.getTime() === d2.getTime()) return teksMulai;

        const hari2 = hariArr[d2.getDay()], tgl2 = d2.getDate(), bln2 = bulanArr[d2.getMonth()], thn2 = d2.getFullYear();
        const teksSelesai = `${hari2}, ${tgl2} ${bln2} ${thn2}`;

        if (bln1 === bln2 && thn1 === thn2) return `${hari1} s.d. ${hari2}, ${tgl1} s.d. ${tgl2} ${bln1} ${thn1}`;
        return `${teksMulai} s.d. ${hari2}, ${tgl2} ${bln2} ${thn2}`;
    }

    function toggleSelectAll(source) {
        const isChecked = source.checked;
        daftarUndangan.forEach((nama, index) => {
            const checkbox = document.getElementById(`chk_${index}`);
            if (checkbox) checkbox.checked = isChecked;
        });
        renderDaftarUndangan();
    }

    function initCheckboxes() {
        const container = document.getElementById('checkbox_container');
        if(!container) return;
        daftarUndangan.forEach((nama, index) => {
            const div = document.createElement('div');
            div.className = "flex items-start";
            div.innerHTML = `
                <div class="flex items-center h-5">
                    <input type="checkbox" id="chk_${index}" value="${nama}" onchange="renderDaftarUndangan()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                </div>
                <div class="ml-2 text-sm">
                    <label for="chk_${index}" class="text-gray-700">${nama}</label>
                </div>
            `;
            container.appendChild(div);
        });
    }

    function renderDaftarUndangan() {
        const tabel = document.getElementById('tabel_undangan_lampiran');
        if(!tabel) return;
        tabel.innerHTML = ''; 
        
        let counter = 1;
        let totalChecked = 0; 
        
        daftarUndangan.forEach((nama, index) => {
            const checkbox = document.getElementById(`chk_${index}`);
            if (checkbox && checkbox.checked) {
                const tr = document.createElement('tr');
                tr.style.pageBreakInside = "avoid";
                tr.style.breakInside = "avoid";
                
                tr.innerHTML = `<td class="w-10 py-1 align-top">${counter}.</td><td class="align-top">${nama}</td>`;
                tabel.appendChild(tr);
                counter++;
                totalChecked++; 
            }
        });

        const chkAll = document.getElementById('chk_all');
        if (chkAll) {
            chkAll.checked = (totalChecked === daftarUndangan.length && daftarUndangan.length > 0);
        }

        if (counter === 1) {
            tabel.innerHTML = '<tr><td colspan="2" class="text-center text-gray-400 italic">Silakan centang daftar undangan di panel sebelah kiri...</td></tr>';
        }
    }

    function dragElement(elmnt) {
        if (!elmnt) return;
        let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        elmnt.onmousedown = dragMouseDown;

        function dragMouseDown(e) {
            e = e || window.event;
            let rect = elmnt.getBoundingClientRect();
            if (e.clientX > rect.right - 20 && e.clientY > rect.bottom - 20) return;
            e.preventDefault();
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            document.onmousemove = elementDrag;
        }
        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
            elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
            elmnt.style.right = "auto";
            elmnt.style.bottom = "auto";
        }
        function closeDragElement() {
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }

    window.previewQRCode = function(event) {
        const input = event.target;
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const boxQrDraggable = document.getElementById('box_qr_draggable');
                const imgQr = document.getElementById('out_img_qr');
                if (boxQrDraggable && imgQr) {
                    imgQr.src = e.target.result;
                    boxQrDraggable.classList.remove('hidden');
                    boxQrDraggable.style.display = 'block';
                    boxQrDraggable.style.bottom = '20px';
                    boxQrDraggable.style.right = '150px';
                    
                    // Panggil ini agar preview tanggal dan dokumen tetap sinkron & terkunci
                    updatePreview(); 
                }
            }
            reader.readAsDataURL(file);
        }
    };

    async function simpanDanCetak() {
        const noDepan = document.getElementById('in_nomor') ? document.getElementById('in_nomor').value : '';
        const noSuffix = document.getElementById('in_suffix') ? document.getElementById('in_suffix').value : '';
        const nomorSurat = "000.9.2/" + noDepan + noSuffix; 
        
        const perihal = document.getElementById('in_perihal') ? document.getElementById('in_perihal').value : '';
        const tanggalSurat = document.getElementById('in_tgl_surat') ? document.getElementById('in_tgl_surat').value : '';
        const instansi = document.getElementById('in_instansi') ? document.getElementById('in_instansi').value : '';
        const pengirim = instansi === 'setda' ? 'Sekretariat Daerah' : 'Bappelitbang';
        
        if(!noDepan || !tanggalSurat) {
            alert('Mohon isi Nomor Urut Surat dan Tanggal Pembuatan Surat sebelum mencetak!');
            return; 
        }

        const btnCetak = document.getElementById('btn-cetak');
        const teksAsli = btnCetak.innerHTML;
        btnCetak.innerHTML = 'Menyimpan ke Database...';
        btnCetak.disabled = true;

        document.title = "Surat Undangan - " + (perihal ? perihal : "SIJANTUNG");

        // --- KUNCI ANTI-POTONG TERBARU ---
        // Fungsi untuk menarik layar dan kotak kertas mentok ke kiri sebelum dicetak
        const resetScroll = () => {
            const printArea = document.getElementById('print-area');
            if (printArea) {
                printArea.scrollLeft = 0; // Kunci: Menarik paksa gulungan kotak ke kiri
            }
            window.scrollTo(0, 0); // Menarik layar utama ke atas
        };

        try {
            const response = await fetch("{{ route('surat.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                },
                body: JSON.stringify({
                    nomor_surat: nomorSurat,
                    perihal: perihal,
                    tanggal_surat: tanggalSurat,
                    pengirim: pengirim,
                    status: 'Keluar' 
                })
            });

            if (response.ok) {
                resetScroll(); // Panggil fungsi penarik layar
                window.print();
            } else {
                const errorData = await response.json();
                console.log(errorData);
                alert('Data gagal disimpan ke database. Kemungkinan Nomor Surat sudah ada/duplikat.');
                resetScroll(); 
                window.print(); 
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan saat menyimpan data.');
            resetScroll(); 
            window.print(); 
        } finally {
            btnCetak.innerHTML = teksAsli;
            btnCetak.disabled = false;
        }
    }

    window.onload = function() {
        initCheckboxes();
        updatePreview();
    };

    document.addEventListener("DOMContentLoaded", function() {
        dragElement(document.getElementById("box_qr_draggable"));
        const tombolUpload = document.getElementById('in_qr_code');
        if (tombolUpload) {
            tombolUpload.addEventListener('change', window.previewQRCode);
        }
        
        if(document.getElementById("in_tgl_acara")) {
                flatpickr("#in_tgl_acara", {
                    mode: "range",
                    dateFormat: "Y-m-d",
                    locale: "id", 
                    onChange: function(selectedDates, dateStr, instance) {
                        // KUNCI UTAMA: Simpan kalender ke memori global agar kebal dari reset sistem
                        window.backupTglAcara = selectedDates;
                        updatePreview(); 
                    }
                });
            }
    });
</script>
</x-app-layout>