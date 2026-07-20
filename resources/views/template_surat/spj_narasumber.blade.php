<x-app-layout>
    <style>
        @media print {
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
                display: block !important;
            }
            .no-print { display: none !important; }
            
            @page { size: A4; margin: 0mm; } 
            
            body { 
                margin: 0; 
                -webkit-print-color-adjust: exact !important; 
                print-color-adjust: exact !important; 
            }
            
            .a4-container {
                box-shadow: none !important;
                margin: 0 !important;
                width: 210mm !important;
                min-height: auto !important; 
                height: auto !important;
                padding: 15mm !important;
            }
            .page-break {
                page-break-before: always;
            }
        }

        .a4-container {
            width: 210mm;
            min-height: 297mm;
            background: white;
            padding: 15mm;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            margin: 0 auto;
            color: black;
            font-family: 'Arial', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }
    </style>

    <x-slot name="header">
        <div class="flex justify-between items-center no-print">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('TEMPLATE KUITANSI SPJ') }}
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
        
        <!-- PANEL KIRI (PENGATURAN) -->
        <div class="w-full lg:w-1/3 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 overflow-y-auto no-print border border-gray-200 dark:border-gray-700" style="max-height: 85vh;">
            <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-4 border-b pb-2">Pengaturan Data SPJ</h3>
            
            <div class="space-y-4">
                
                <h4 class="font-semibold text-sm text-gray-800 dark:text-gray-200 uppercase mt-4">Penerima & Rekening</h4>
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Penerima</label>
                    <input type="text" id="in_nama_penerima" onkeyup="updatePreview()" value="MEIDY HARRIS PRAYOGA" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">NIP Penerima</label>
                    <input type="text" id="in_nip_penerima" onkeyup="updatePreview()" value="198405222008031001" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Pangkat / Golongan</label>
                    <input type="text" id="in_gol_penerima" onkeyup="updatePreview()" value="Pembina Tingkat I IV/b" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nama Bank</label>
                    <input type="text" id="in_bank_penerima" onkeyup="updatePreview()" value="Bank Kalsel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nomor Rekening</label>
                    <input type="text" id="in_rek_penerima" onkeyup="updatePreview()" value="0060328002692" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                </div>

                <hr class="border-gray-200">
                <h4 class="font-semibold text-sm text-gray-800 dark:text-gray-200 uppercase mt-2">Detail Perjalanan</h4>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Keperluan</label>
                    <textarea id="in_keperluan" onkeyup="updatePreview()" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">Pembayaran Belanja Perjalanan Dinas Luar Daerah tujuan Kota Banjarbaru selama 1 (satu) hari pada tanggal 08 Juli 2026 s/d 08 Juli 2026 dengan rincian terlampir</textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nomor Surat Tugas</label>
                        <input type="text" id="in_no_st" onkeyup="updatePreview()" value="800.1.11.1/ 140 /ST/ 2026" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Tanggal ST</label>
                        <input type="text" id="in_tgl_st" onkeyup="updatePreview()" value="06 Juli 2026" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Nomor SPD</label>
                        <input type="text" id="in_no_spd" onkeyup="updatePreview()" value="000.1.2.3/ 176 /SPD/ 2026" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Tanggal SPD</label>
                        <input type="text" id="in_tgl_spd" onkeyup="updatePreview()" value="06 Juli 2026" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Tanggal Cetak Kuitansi</label>
                    <input type="date" id="in_tgl_kuitansi" onchange="updatePreview()" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                </div>

                <hr class="border-gray-200">
                <h4 class="font-semibold text-sm text-gray-800 dark:text-gray-200 uppercase mt-2">Rincian Biaya</h4>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Vol Uang Harian</label>
                        <input type="number" id="in_vol_uh" onkeyup="updatePreview()" onchange="updatePreview()" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Harga Uang Harian</label>
                        <input type="number" id="in_hrg_uh" onkeyup="updatePreview()" onchange="updatePreview()" value="380000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Vol Representasi</label>
                        <input type="number" id="in_vol_rep" onkeyup="updatePreview()" onchange="updatePreview()" value="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">Harga Representasi</label>
                        <input type="number" id="in_hrg_rep" onkeyup="updatePreview()" onchange="updatePreview()" value="150000" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-sm">
                    </div>
                </div>

            </div>
        </div>

        <!-- PANEL KANAN (A4 PREVIEW) -->
        <div class="w-full lg:w-2/3 overflow-x-auto flex flex-col items-center gap-8 pb-10 print:block print:gap-0 print:pb-0" id="print-area">
            
            <!-- HALAMAN 1 -->
            <div class="a4-container relative text-[12pt]">
                <!-- KOP Surat -->
                <div class="flex items-center justify-between border-b-[3px] border-black pb-2 mb-1">
                    <img src="{{ asset('images/logotapin.png') }}" alt="Logo" class="w-20 h-auto">
                    <div class="text-center flex-1">
                        <h1 class="text-xl font-bold tracking-wide">PEMERINTAH KABUPATEN TAPIN</h1>
                        <h2 class="text-2xl font-bold uppercase">BADAN PERENCANAAN PEMBANGUNAN, PENELITIAN DAN PENGEMBANGAN</h2>
                        <p class="text-[10pt]">Jalan Datu Nuraya RT. 1 Kel. Rangda Malingkung, Kawasan Rantau Baru 71114</p>
                    </div>
                    <div class="w-20"></div>
                </div>
                <div class="border-b-[1.5px] border-black mb-6"></div>

                <!-- Detail Program -->
                <table class="w-full text-[11pt] mb-6 leading-tight">
                    <tr>
                        <td class="w-32 align-top">Program</td>
                        <td class="w-4 align-top">:</td>
                        <td>5.01.01 PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA</td>
                    </tr>
                    <tr>
                        <td class="align-top">Kegiatan</td>
                        <td class="align-top">:</td>
                        <td>5.01.01.2.06 Administrasi Umum Perangkat Daerah</td>
                    </tr>
                    <tr>
                        <td class="align-top">Sub Kegiatan</td>
                        <td class="align-top">:</td>
                        <td>5.01.01.2.06.0009 Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD</td>
                    </tr>
                    <tr>
                        <td class="align-top">Rek. Belanja</td>
                        <td class="align-top">:</td>
                        <td>Belanja Perjalanan Dinas Biasa</td>
                    </tr>
                    <tr>
                        <td class="align-top">Kode Rekening</td>
                        <td class="align-top">:</td>
                        <td>5.1.02.04.01.0001</td>
                    </tr>
                    <tr>
                        <td class="align-top">No. BKU</td>
                        <td class="align-top">:</td>
                        <td><span class="w-24 inline-block border-b border-black"></span> / BK / 06.0009 /BAPPELITBANG/2026</td>
                    </tr>
                </table>

                <!-- Judul KUITANSI -->
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold inline-block border-b-2 border-black tracking-widest">KUITANSI</h3>
                </div>

                <!-- Detail Pembayaran -->
                <table class="w-full text-[11pt] mb-8 leading-relaxed">
                    <tr>
                        <td class="w-40 align-top">Sudah terima dari</td>
                        <td class="w-4 align-top">:</td>
                        <td>Bendahara Pengeluaran Bappelitbang Kabupaten Tapin</td>
                    </tr>
                    <tr>
                        <td class="align-top">Uang sejumlah</td>
                        <td class="align-top">:</td>
                        <td class="font-bold italic" id="out_uang_terbilang">Lima Ratus Tiga Puluh Ribu Rupiah</td>
                    </tr>
                    <tr>
                        <td class="align-top">Untuk keperluan</td>
                        <td class="align-top">:</td>
                        <td class="text-justify" id="out_keperluan"></td>
                    </tr>
                    <tr><td colspan="3" class="h-4"></td></tr>
                    <tr>
                        <td class="align-top">Nama Rekening</td>
                        <td class="align-top">:</td>
                        <td id="out_nama_rek">MEIDY HARRIS PRAYOGA</td>
                    </tr>
                    <tr>
                        <td class="align-top">Nomor Rekening</td>
                        <td class="align-top">:</td>
                        <td id="out_nomor_rek">0060328002692</td>
                    </tr>
                    <tr>
                        <td class="align-top">Nama Bank</td>
                        <td class="align-top">:</td>
                        <td id="out_nama_bank">Bank Kalsel</td>
                    </tr>
                </table>

                <!-- Terbilang Kotak -->
                <div class="flex justify-between items-end mb-10">
                    <div class="border-[2px] border-black bg-gray-200/50 p-3 flex items-center min-w-[250px]">
                        <span class="italic font-bold text-lg mr-4">Terbilang</span>
                        <span class="font-bold text-lg italic">: Rp.</span>
                        <span class="font-bold text-lg ml-6" id="out_uang_angka">530.000</span>
                    </div>
                    
                    <!-- Box Telah Diperiksa -->
                    <div class="border border-black p-3 w-64 text-sm text-center">
                        <p class="mb-4">Telah diperiksa oleh PPK-SKPD</p>
                        <p class="text-left mb-6">Tanggal :.................................</p>
                        <p>Paraf :</p>
                    </div>
                </div>

                <!-- TTD Bawah -->
                <div class="border border-black w-full text-center text-[10.5pt]">
                    <div class="flex">
                        <div class="w-1/2 p-4 border-r border-black flex flex-col justify-between" style="min-height: 180px;">
                            <div>
                                <p>Mengetahui</p>
                                <p>Pejabat Pelaksana Teknis Kegiatan,</p>
                            </div>
                            <div class="mt-16">
                                <p class="font-bold underline decoration-1 underline-offset-2">SITI NUR AZIZAH, S.Kom.</p>
                                <p>NIP 198501122009042004</p>
                            </div>
                        </div>
                        <div class="w-1/2 p-4 flex flex-col justify-between" style="min-height: 180px;">
                            <div>
                                <p>Rantau, <span class="out_tgl_kuitansi">09 Juli 2026</span></p>
                                <p>Yang Menerima :</p>
                            </div>
                            <div class="mt-16">
                                <p class="font-bold underline decoration-1 underline-offset-2 out_nama_ttd">Dr. H. MEIDY HARRIS PRAYOGA, S.E.,M.E., CGRE.</p>
                                <p>NIP <span class="out_nip_ttd">198405222008031001</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex border-t border-black">
                        <div class="w-1/2 p-4 border-r border-black flex flex-col justify-between" style="min-height: 180px;">
                            <div>
                                <p>Mengetahui / Menyetujui :</p>
                                <p>Pengguna Anggaran,</p>
                            </div>
                            <div class="mt-16">
                                <p class="font-bold underline decoration-1 underline-offset-2">Dr. H. MEIDY HARRIS PRAYOGA, S.E.,M.E., CGRE.</p>
                                <p>Pembina Tingkat I IV/b</p>
                                <p>NIP 198405222008031001</p>
                            </div>
                        </div>
                        <div class="w-1/2 p-4 flex flex-col justify-between" style="min-height: 180px;">
                            <div>
                                <p>Lunas Dibayar Tanggal :............................ 2026</p>
                                <p>Bendahara Pengeluaran</p>
                                <p>BAPPELITBANG KAB. TAPIN,</p>
                            </div>
                            <div class="mt-16">
                                <p class="font-bold underline decoration-1 underline-offset-2">MUHAMMAD SYAHDANI, S.Ak.</p>
                                <p>NIP 197509012009011006</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- HALAMAN 2 -->
            <div class="a4-container relative mt-10 print:mt-0 page-break text-[11pt]">
                
                <div class="text-center font-bold underline underline-offset-2 mb-8 mt-10">
                    RINCIAN BIAYA PERJALANAN DINAS
                </div>

                <table class="w-full mb-6">
                    <tr>
                        <td class="w-56">Surat Tugas Nomor</td>
                        <td class="w-4">:</td>
                        <td id="out_no_st">800.1.11.1/ 140 /ST/ 2026</td>
                        <td class="w-20">, tanggal</td>
                        <td id="out_tgl_st">06 Juli 2026</td>
                    </tr>
                    <tr>
                        <td>Surat Perjalanan Dinas Nomor</td>
                        <td>:</td>
                        <td id="out_no_spd">000.1.2.3/ 176 /SPD/ 2026</td>
                        <td>, tanggal</td>
                        <td id="out_tgl_spd">06 Juli 2026</td>
                    </tr>
                </table>

                <table class="w-full border-collapse border border-black mb-6 text-center text-sm">
                    <thead>
                        <tr>
                            <th class="border border-black p-2 w-10" rowspan="2">No</th>
                            <th class="border border-black p-2" rowspan="2">Uraian Komponen Biaya Perjalanan Dinas</th>
                            <th class="border border-black p-2" colspan="2">Rincian Biaya</th>
                            <th class="border border-black p-2 w-32" rowspan="2">Jumlah (Rp.)</th>
                            <th class="border border-black p-2 w-16" rowspan="2">Ket</th>
                        </tr>
                        <tr>
                            <th class="border border-black p-2 w-24">Volume</th>
                            <th class="border border-black p-2 w-32">Harga (Rp.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-black p-2">1</td>
                            <td class="border border-black p-2 text-left">Uang Harian</td>
                            <td class="border border-black p-2" id="out_vol_uh">1</td>
                            <td class="border border-black p-2 text-right" id="out_hrg_uh">Rp. 380.000</td>
                            <td class="border border-black p-2 text-right" id="out_jml_uh">Rp. 380.000</td>
                            <td class="border border-black p-2"></td>
                        </tr>
                        <tr>
                            <td class="border border-black p-2">2</td>
                            <td class="border border-black p-2 text-left">Uang Refresentasi</td>
                            <td class="border border-black p-2" id="out_vol_rep">1</td>
                            <td class="border border-black p-2 text-right" id="out_hrg_rep">Rp. 150.000</td>
                            <td class="border border-black p-2 text-right" id="out_jml_rep">Rp. 150.000</td>
                            <td class="border border-black p-2"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="border border-black p-2 text-left font-semibold">Total Biaya Perjalanan Dinas</td>
                            <td class="border border-black p-2 text-right font-semibold" id="out_total_biaya">Rp. 530.000</td>
                            <td class="border border-black p-2"></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="border border-black p-2 text-left italic">Terbilang : <span id="out_uang_terbilang_2">Lima Ratus Tiga Puluh Ribu Rupiah</span></td>
                        </tr>
                    </tbody>
                </table>

                <div class="flex justify-end mb-12">
                    <div class="w-80 text-center">
                        <p class="text-left">Dikeluarkan di : Rantau</p>
                        <p class="text-left mb-4">Tanggal : <span class="out_tgl_kuitansi">09 Juli 2026</span></p>
                        <p class="mb-20">Pelaksana SPD</p>
                        <p class="font-bold underline underline-offset-2 out_nama_ttd">Dr. H. MEIDY HARRIS PRAYOGA, S.E.,M.E., CGRE.</p>
                        <p class="out_gol_ttd">Pembina Tingkat I IV/b</p>
                        <p>NIP <span class="out_nip_ttd">198405222008031001</span></p>
                    </div>
                </div>

                <div class="text-center font-bold underline underline-offset-2 mb-4">
                    TANDA TERIMA BIAYA PERJALANAN DINAS
                </div>

                <table class="w-full border-collapse border border-black text-center text-[10pt]">
                    <thead>
                        <tr>
                            <th class="border border-black p-2 w-10">No</th>
                            <th class="border border-black p-2">Nama Nip</th>
                            <th class="border border-black p-2">Pangkat / Gol</th>
                            <th class="border border-black p-2">Jumlah Uang<br>yang Diterima</th>
                            <th class="border border-black p-2">Nomor Rekening<br>Penerima</th>
                            <th class="border border-black p-2 w-32">Tanda Tangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border border-black p-3">1.</td>
                            <td class="border border-black p-3 text-left leading-relaxed">
                                <span class="out_nama_ttd font-semibold">Dr. H. MEIDY HARRIS PRAYOGA, S.E.,M.E., CGRE.</span><br>
                                NIP. <span class="out_nip_ttd">198405222008031001</span>
                            </td>
                            <td class="border border-black p-3">
                                <span class="out_gol_ttd_2 whitespace-pre-line">Pembina
Tingkat I / IV/b</span>
                            </td>
                            <td class="border border-black p-3" id="out_uang_tanda_terima">Rp. 530.000</td>
                            <td class="border border-black p-3" id="out_rek_tanda_terima">0060328002692</td>
                            <td class="border border-black p-3"></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

<script>
    // Fungsi konversi angka ke terbilang (Bahasa Indonesia)
    function terbilang(angka) {
        var bilangan = [
            "", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"
        ];
        var text = "";

        if (angka < 12) {
            text = " " + bilangan[angka];
        } else if (angka < 20) {
            text = terbilang(angka - 10) + " Belas";
        } else if (angka < 100) {
            text = terbilang(Math.floor(angka / 10)) + " Puluh" + terbilang(angka % 10);
        } else if (angka < 200) {
            text = " Seratus" + terbilang(angka - 100);
        } else if (angka < 1000) {
            text = terbilang(Math.floor(angka / 100)) + " Ratus" + terbilang(angka % 100);
        } else if (angka < 2000) {
            text = " Seribu" + terbilang(angka - 1000);
        } else if (angka < 1000000) {
            text = terbilang(Math.floor(angka / 1000)) + " Ribu" + terbilang(angka % 1000);
        } else if (angka < 1000000000) {
            text = terbilang(Math.floor(angka / 1000000)) + " Juta" + terbilang(angka % 1000000);
        } else if (angka < 1000000000000) {
            text = terbilang(Math.floor(angka / 1000000000)) + " Milyar" + terbilang(angka % 1000000000);
        } else if (angka < 1000000000000000) {
            text = terbilang(Math.floor(angka / 1000000000000)) + " Trilyun" + terbilang(angka % 1000000000000);
        }
        return text;
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { minimumFractionDigits: 0 }).format(angka);
    }

    function formatTanggal(dateStr) {
        if(!dateStr) return '..........................';
        const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const d = new Date(dateStr);
        return `${d.getDate()} ${bulan[d.getMonth()]} ${d.getFullYear()}`;
    }

    function updatePreview() {
        // Ambil nilai dari input form
        const nama = document.getElementById('in_nama_penerima').value;
        const nip = document.getElementById('in_nip_penerima').value;
        const gol = document.getElementById('in_gol_penerima').value;
        const bank = document.getElementById('in_bank_penerima').value;
        const rek = document.getElementById('in_rek_penerima').value;
        const keperluan = document.getElementById('in_keperluan').value;
        
        const no_st = document.getElementById('in_no_st').value;
        const tgl_st = document.getElementById('in_tgl_st').value;
        const no_spd = document.getElementById('in_no_spd').value;
        const tgl_spd = document.getElementById('in_tgl_spd').value;
        const tgl_kuitansi = document.getElementById('in_tgl_kuitansi').value;

        // Ambil nilai nominal
        const vol_uh = parseInt(document.getElementById('in_vol_uh').value) || 0;
        const hrg_uh = parseInt(document.getElementById('in_hrg_uh').value) || 0;
        const vol_rep = parseInt(document.getElementById('in_vol_rep').value) || 0;
        const hrg_rep = parseInt(document.getElementById('in_hrg_rep').value) || 0;

        const jml_uh = vol_uh * hrg_uh;
        const jml_rep = vol_rep * hrg_rep;
        const total = jml_uh + jml_rep;
        const teksTerbilang = (total > 0 ? terbilang(total).trim() + " Rupiah" : "-");

        // Update Kuitansi (Hal 1)
        document.getElementById('out_nama_rek').innerText = nama;
        document.getElementById('out_nomor_rek').innerText = rek;
        document.getElementById('out_nama_bank').innerText = bank;
        document.getElementById('out_keperluan').innerText = keperluan;
        document.getElementById('out_uang_angka').innerText = formatRupiah(total);
        document.getElementById('out_uang_terbilang').innerText = teksTerbilang;
        
        // Update Multiple class elements (Tanda tangan, NIP, Golongan, Tanggal)
        document.querySelectorAll('.out_nama_ttd').forEach(el => el.innerText = nama);
        document.querySelectorAll('.out_nip_ttd').forEach(el => el.innerText = nip);
        document.querySelectorAll('.out_gol_ttd').forEach(el => el.innerText = gol);
        document.querySelectorAll('.out_gol_ttd_2').forEach(el => el.innerHTML = gol.replace(' ', '<br>'));
        document.querySelectorAll('.out_tgl_kuitansi').forEach(el => el.innerText = formatTanggal(tgl_kuitansi));

        // Update Rincian Biaya (Hal 2)
        document.getElementById('out_no_st').innerText = no_st;
        document.getElementById('out_tgl_st').innerText = tgl_st;
        document.getElementById('out_no_spd').innerText = no_spd;
        document.getElementById('out_tgl_spd').innerText = tgl_spd;

        document.getElementById('out_vol_uh').innerText = vol_uh;
        document.getElementById('out_hrg_uh').innerText = 'Rp. ' + formatRupiah(hrg_uh);
        document.getElementById('out_jml_uh').innerText = 'Rp. ' + formatRupiah(jml_uh);
        
        document.getElementById('out_vol_rep').innerText = vol_rep;
        document.getElementById('out_hrg_rep').innerText = 'Rp. ' + formatRupiah(hrg_rep);
        document.getElementById('out_jml_rep').innerText = 'Rp. ' + formatRupiah(jml_rep);
        
        document.getElementById('out_total_biaya').innerText = 'Rp. ' + formatRupiah(total);
        document.getElementById('out_uang_terbilang_2').innerText = teksTerbilang;
        
        document.getElementById('out_uang_tanda_terima').innerText = 'Rp. ' + formatRupiah(total);
        document.getElementById('out_rek_tanda_terima').innerText = rek;
    }

    // Jalankan preview pertama kali halaman dimuat
    window.onload = function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('in_tgl_kuitansi').value = today;
        updatePreview();
    };

    // FUNGSI AJAX SIMPAN KE DATABASE LALU CETAK
    async function simpanDanCetak() {
        const nomorSurat = document.getElementById('in_no_spd') ? document.getElementById('in_no_spd').value : '';
        const keperluan = document.getElementById('in_keperluan') ? document.getElementById('in_keperluan').value : '';
        const perihal = "Kwitansi SPJ: " + keperluan.substring(0, 50) + "...";
        const tanggalSurat = document.getElementById('in_tgl_kuitansi') ? document.getElementById('in_tgl_kuitansi').value : '';
        const pengirim = 'Bendahara Pengeluaran';
        
        if(!nomorSurat || !tanggalSurat) {
            alert('Mohon isi Nomor SPD dan Tanggal Kuitansi sebelum mencetak!');
            return; 
        }

        const btnCetak = document.getElementById('btn-cetak');
        const teksAsli = btnCetak.innerHTML;
        btnCetak.innerHTML = 'Menyimpan ke Database...';
        btnCetak.disabled = true;

        document.title = "Kwitansi SPJ (Makan dan Minum)";

        const resetScroll = () => {
            const printArea = document.getElementById('print-area');
            if (printArea) {
                printArea.scrollLeft = 0; 
            }
            window.scrollTo(0, 0); 
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
                resetScroll();
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
</script>
</x-app-layout>
