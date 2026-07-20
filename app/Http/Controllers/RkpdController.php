<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class RkpdController extends Controller
{
    // Fungsi utama untuk memotong PDF
    public function potongPdf(Request $request)
    {
        // Validasi inputan dari user
        $request->validate([
            'nama_file' => 'required|string',
            'halaman'   => 'required|string', 
        ]);

        // ALAMAT FILE RKPD ASLI (Pastikan Anda menaruh file RKPD di folder public/dokumen/)
        $file_path = public_path('Dokumen RKPD/' . $request->nama_file); 

        // Cek apakah file RKPD raksasanya ada
        if (!file_exists($file_path)) {
            return back()->with('error', 'File RKPD tidak ditemukan di server kocak.');
        }

        // Terjemahkan teks "1-3, 5" menjadi array [1, 2, 3, 5]
        $pagesToExtract = $this->parseHalaman($request->halaman);

        // Siapkan FPDI (Buka PDF kosong baru)
        $pdf = new Fpdi();
        
        // Buka PDF RKPD asli dan hitung total halamannya
        $pageCount = $pdf->setSourceFile($file_path);

        // Mulai proses kloning halaman
        foreach ($pagesToExtract as $pageNo) {
            // Pastikan halaman yang diminta tidak melebihi total halaman asli
            if ($pageNo > 0 && $pageNo <= $pageCount) {
                // Impor halaman spesifik
                $templateId = $pdf->importPage($pageNo);
                $size = $pdf->getTemplateSize($templateId);
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                
                // Tempelkan hasil kloning ke halaman kosong tersebut
                $pdf->useTemplate($templateId);

                // =========================================================
// =========================================================
                // SULAP HIGHLIGHT: MENGGAMBAR KOTAK MERAH PADA HASIL EKSPOR
                // =========================================================
                if ($request->filled('hl_halaman') && $request->filled('hl_y') && $pageNo == $request->hl_halaman) {
                    
                    // Ambil koordinat Y (Atas/Bawah) dan X (Kiri/Kanan)
                    $y_mm = ($request->hl_y / 100) * $size['height'];
                    $x_mm = $request->filled('hl_x') ? ($request->hl_x / 100) * $size['width'] : 5;
                    
                    // Ambil dimensi Ketebalan (Height) dan Lebar (Width)
                    $h_mm = $request->filled('hl_h') ? ($request->hl_h / 100) * $size['height'] : 8;
                    $w_mm = $request->filled('hl_w') ? ($request->hl_w / 100) * $size['width'] : ($size['width'] - 10);
                    
                    $pdf->SetDrawColor(255, 0, 0); 
                    $pdf->SetLineWidth(1.5); 
                    
                    // GAMBAR KOTAK BEBAS: Menuruti persis seperti yang diatur pengguna di layar!
                    $pdf->Rect($x_mm, $y_mm, $w_mm, $h_mm, 'D'); 
                }
                // =========================================================
                // =========================================================
            }
        }

        // Simpan file hasil potongan sementara ke folder yang sudah pasti ada
        $nama_file_baru = 'Potongan_RKPD_' . time() . '.pdf';
        $output_path = public_path('Dokumen RKPD/' . $nama_file_baru);
        
        // Parameter 'F' berarti simpan (Force save)
        $pdf->Output($output_path, 'F'); 

        // Perintahkan browser untuk langsung mengunduh dan otomatis menghapus file sementaranya
        return response()->download($output_path)->deleteFileAfterSend(true);
    }

    // =========================================================================
    // FUNGSI PENDUKUNG: Menerjemahkan format "1-3, 5, 8" menjadi angka satuan
    // =========================================================================
    private function parseHalaman($string)
    {
        $pages = [];
        $parts = explode(',', $string); // Pecah berdasarkan koma
        
        foreach ($parts as $part) {
            $part = trim($part); // Bersihkan spasi
            
            if (strpos($part, '-') !== false) {
                // Jika ada tanda strip (misal: 1-3)
                list($start, $end) = explode('-', $part);
                for ($i = (int)$start; $i <= (int)$end; $i++) {
                    $pages[] = $i;
                }
            } else {
                // Jika hanya 1 angka (misal: 5)
                $pages[] = (int)$part;
            }
        }
        
        // Hapus angka duplikat (kalau user iseng ngetik "1-3, 2, 3") dan urutkan
        $pages = array_unique(array_filter($pages));
        sort($pages);
        
        return $pages;
    }
}