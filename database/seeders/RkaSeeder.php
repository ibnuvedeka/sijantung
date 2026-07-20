<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rka;

class RkaSeeder extends Seeder
{
    public function run(): void
    {
        // Kosongkan tabel RKA sebelum diisi ulang agar tidak terjadi duplikasi (bertambah terus)
        Rka::truncate();
        
        // =========================================================================
        // DOKUMEN 1: SUB KEGIATAN PENELITIAN BIDANG ASPEK-ASPEK SOSIAL
        // =========================================================================
        $prog_sosial = "5.05.02 PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH";
        $keg_sosial  = "5.05.02.2.02 Penelitian dan Pengembangan Bidang Sosial dan Kependudukan";
        $sub_sosial  = "5.05.02.2.02.0001 Penelitian dan Pengembangan Bidang Aspek Aspek Sosial";

        Rka::create([
            'kode'         => '5.1.02.01.001.00026',
            'nama'         => 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak',
            'program'      => $prog_sosial,
            'kegiatan'     => $keg_sosial,
            'sub_kegiatan' => $sub_sosial,
            'pagu'         => 26000000,
            'sisa'         => 26000000,
        ]);

        Rka::create([
            'kode'         => '5.1.02.01.001.00052',
            'nama'         => 'Belanja Makanan dan Minuman Rapat',
            'program'      => $prog_sosial,
            'kegiatan'     => $keg_sosial,
            'sub_kegiatan' => $sub_sosial,
            'pagu'         => 18300000,
            'sisa'         => 18300000,
        ]);

        Rka::create([
            'kode'         => '5.1.02.02.001.00003',
            'nama'         => 'Honorarium Narasumber atau Pembahas, Moderator, Pembawa Acara, dan Panitia',
            'program'      => $prog_sosial,
            'kegiatan'     => $keg_sosial,
            'sub_kegiatan' => $sub_sosial,
            'pagu'         => 4000000,
            'sisa'         => 4000000,
        ]);


        // =========================================================================
        // DOKUMEN 2: SUB KEGIATAN SOSIALISASI DAN DISEMINASI HASIL KELITBANGAN
        // =========================================================================
        $prog_sosialisasi = "5.05.02 PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH";
        $keg_sosialisasi  = "5.05.02.2.04 Pengembangan Inovasi dan Teknologi";
        $sub_sosialisasi  = "5.05.02.2.04.0004 Sosialisasi dan Diseminasi Hasil-Hasil Kelitbangan";

        Rka::create([
            'kode'         => '5.1.02.01.001.00026',
            'nama'         => 'Belanja Alat/Bahan untuk Kegiatan Kantor- Bahan Cetak',
            'program'      => $prog_sosialisasi,
            'kegiatan'     => $keg_sosialisasi,
            'sub_kegiatan' => $sub_sosialisasi,
            'pagu'         => 13000000,
            'sisa'         => 13000000,
        ]);

        Rka::create([
            'kode'         => '5.1.02.01.001.00052',
            'nama'         => 'Belanja Makanan dan Minuman Rapat',
            'program'      => $prog_sosialisasi,
            'kegiatan'     => $keg_sosialisasi,
            'sub_kegiatan' => $sub_sosialisasi,
            'pagu'         => 15250000,
            'sisa'         => 15250000,
        ]);


        // =========================================================================
        // DOKUMEN 3: SUB KEGIATAN BIMBINGAN TEKNIS, SUPERVISI, DAN KEMITRAAN
        // =========================================================================
        $prog_bimtek = "5.05.03 PROGRAM RISET DAN INOVASI DAERAH";
        $keg_bimtek  = "5.05.03.2.02 Invensi dan Inovasi";
        $sub_bimtek  = "5.05.03.2.02.0018 Bimbingan teknis dan supervisi, kerja sama, serta kemitraan invensi dan inovasi";

        Rka::create([
            'kode'         => '5.1.02.01.001.00026',
            'nama'         => 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak',
            'program'      => $prog_bimtek,
            'kegiatan'     => $keg_bimtek,
            'sub_kegiatan' => $sub_bimtek,
            'pagu'         => 2000000,
            'sisa'         => 2000000,
        ]);

        Rka::create([
            'kode'         => '5.1.02.01.001.00052',
            'nama'         => 'Belanja Makanan dan Minuman Rapat',
            'program'      => $prog_bimtek,
            'kegiatan'     => $keg_bimtek,
            'sub_kegiatan' => $sub_bimtek,
            'pagu'         => 45750000,
            'sisa'         => 45750000,
        ]);

                Rka::create([
            'kode'         => '5.1.02.02.001.00003',
            'nama'         => 'Honorarium Narasumber atau Pembahas, Moderator, Pembawa Acara, dan Panitia',
            'program'      => $prog_bimtek,
            'kegiatan'     => $keg_bimtek,
            'sub_kegiatan' => $sub_bimtek,
            'pagu'         => 13500000,
            'sisa'         => 13500000,
        ]);


        // =========================================================================
        // DOKUMEN 4: SUB KEGIATAN APRESIASI PRESTASI INOVASI
        // =========================================================================
        $prog_apresiasi = "5.05.03 PROGRAM RISET DAN INOVASI DAERAH";
        $keg_apresiasi  = "5.05.03.2.02 Invensi dan Inovasi";
        $sub_apresiasi  = "5.05.03.2.02.0012 Fasilitasi dan pembinaan untuk apresiasi prestasi Inovasi";

        Rka::create([
            'kode'         => '5.1.02.01.001.00026',
            'nama'         => 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak',
            'program'      => $prog_apresiasi,
            'kegiatan'     => $keg_apresiasi,
            'sub_kegiatan' => $sub_apresiasi,
            'pagu'         => 9625000,
            'sisa'         => 9625000,
        ]);

        Rka::create([
            'kode'         => '5.1.02.01.001.00052',
            'nama'         => 'Belanja Makanan dan Minuman Rapat',
            'program'      => $prog_apresiasi,
            'kegiatan'     => $keg_apresiasi,
            'sub_kegiatan' => $sub_apresiasi,
            'pagu'         => 45750000,
            'sisa'         => 45750000,
        ]);


        // =========================================================================
        // DOKUMEN 5: SUB KEGIATAN PERLINDUNGAN DAN PEMANFAATAN KEKAYAAN INTELEKTUAL
        // =========================================================================
        $prog_ki = "5.05.03 PROGRAM RISET DAN INOVASI DAERAH";
        $keg_ki  = "5.05.03.2.02 Invensi dan Inovasi";
        $sub_ki  = "5.05.03.2.02.0006 Fasilitasi dan pembinaan untuk peningkatan perlindungan dan pemanfaatan kekayaan intelektual";

        Rka::create([
            'kode'         => '5.1.02.01.001.00026',
            'nama'         => 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak',
            'program'      => $prog_ki,
            'kegiatan'     => $keg_ki,
            'sub_kegiatan' => $sub_ki,
            'pagu'         => 5600000,
            'sisa'         => 5600000,
        ]);

        Rka::create([
            'kode'         => '5.1.02.01.001.00052',
            'nama'         => 'Belanja Makanan dan Minuman Rapat',
            'program'      => $prog_ki,
            'kegiatan'     => $keg_ki,
            'sub_kegiatan' => $sub_ki,
            'pagu'         => 18300000,
            'sisa'         => 18300000,
        ]);

        Rka::create([
            'kode'         => '5.1.02.02.001.00067',
            'nama'         => 'Belanja Pembayaran Pajak, Bea, dan Perizinan',
            'program'      => $prog_ki,
            'kegiatan'     => $keg_ki,
            'sub_kegiatan' => $sub_ki,
            'pagu'         => 35000000,
            'sisa'         => 35000000,
        ]);

        Rka::create([
            'kode'         => '5.1.02.02.001.00015',
            'nama'         => 'Belanja Jasa Tenaga Laboratorium',
            'program'      => $prog_ki,
            'kegiatan'     => $keg_ki,
            'sub_kegiatan' => $sub_ki,
            'pagu'         => 17100000,
            'sisa'         => 17100000,
        ]);

        Rka::create([
            'kode'         => '5.1.02.02.001.00003',
            'nama'         => 'Honorarium Narasumber atau Pembahas, Moderator, Pembawa Acara, dan Panitia',
            'program'      => $prog_ki,
            'kegiatan'     => $keg_ki,
            'sub_kegiatan' => $sub_ki,
            'pagu'         => 26000000,
            'sisa'         => 26000000,
        ]);


        // =========================================================================
        // DOKUMEN 6: SUB KEGIATAN PENGEMBANGAN KLASTER INOVASI
        // =========================================================================
        $prog_klaster = "5.05.03 PROGRAM RISET DAN INOVASI DAERAH";
        $keg_klaster  = "5.05.03.2.02 Invensi dan Inovasi";
        $sub_klaster  = "5.05.03.2.02.0003 Fasilitasi dan pembinaan untuk penyelenggaraan pengembangan klaster Inovasi berbasis produk unggulan daerah daerah";

        Rka::create([
            'kode'         => '5.1.02.01.001.00026',
            'nama'         => 'Belanja Alat/Bahan untuk Kegiatan Kantor- Bahan Cetak',
            'program'      => $prog_klaster,
            'kegiatan'     => $keg_klaster,
            'sub_kegiatan' => $sub_klaster,
            'pagu'         => 3225000,
            'sisa'         => 3225000,
        ]);

        Rka::create([
            'kode'         => '5.1.02.01.001.00052',
            'nama'         => 'Belanja Makanan dan Minuman Rapat',
            'program'      => $prog_klaster,
            'kegiatan'     => $keg_klaster,
            'sub_kegiatan' => $sub_klaster,
            'pagu'         => 18300000,
            'sisa'         => 18300000,
        ]);


        // =========================================================================
        // DOKUMEN 7: SUB KEGIATAN PEMERINTAHAN UMUM
        // =========================================================================
        $prog_umum = "5.05.02 PROGRAM PENELITIAN DAN PENGEMBANGAN DAERAH";
        $keg_umum  = "5.05.02.2.01 Penelitian dan Pengembangan Bidang Penyelenggaraan Pemerintahan dan Pengkajian Peraturan";
        $sub_umum  = "5.05.02.2.01.0002 Fasilitasi, Pelaksanaan dan Evaluasi Penelitian dan Pengembangan Bidang Pemerintahan Umum";

        Rka::create([
            'kode'         => '5.1.02.01.001.00026',
            'nama'         => 'Belanja Alat/Bahan untuk Kegiatan Kantor-Bahan Cetak',
            'program'      => $prog_umum,
            'kegiatan'     => $keg_umum,
            'sub_kegiatan' => $sub_umum,
            'pagu'         => 0, // Dalam dokumen, pagu sesudah untuk cetak bernilai 0
            'sisa'         => 0,
        ]);

        Rka::create([
            'kode'         => '5.1.02.01.001.00052',
            'nama'         => 'Belanja Makanan dan Minuman Rapat',
            'program'      => $prog_umum,
            'kegiatan'     => $keg_umum,
            'sub_kegiatan' => $sub_umum,
            'pagu'         => 6100000,
            'sisa'         => 6100000,
        ]);
    }
}