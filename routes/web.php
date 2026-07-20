<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\KartuKendaliController;
use App\Http\Controllers\RkpdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeveloperController;
use Illuminate\Support\Facades\File; // Wajib ditambahkan untuk memindai folder

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rute untuk fitur CRUD Surat
    Route::resource('surat', SuratController::class);
    
    // Rute untuk Template Surat Undangan
    Route::get('/template-surat/undangan', function () {
        return view('template_surat.undangan');
    })->name('template.undangan');
        
    // Rute untuk Template Surat Keluar Biasa
    Route::get('/template-surat/keluar-biasa', function () {
        return view('template_surat.keluar_biasa');
    })->name('template.keluar_biasa');
        
    // Rute untuk Template Keuangan (Landing Page)
    Route::get('/template-keuangan', function () {
        return view('template_keuangan.index');
    })->name('template_keuangan.index');
        
    // Rute untuk Template SPJ Makan Minum
    Route::get('/template-surat/spj', function () {
        return view('template_surat.spj');
    })->name('template.spj');
        
    // Rute untuk Template SPJ Narasumber
    Route::get('/template-surat/spj-narasumber', function () {
        return view('template_surat.spj_narasumber');
    })->name('template.spj_narasumber');
        
    // Rute untuk Template SPJ Moderator
    Route::get('/template-surat/spj-moderator', function () {
        return view('template_surat.spj_moderator');
    })->name('template.spj_moderator');
        
    // Rute untuk Template SPJ HKI
    Route::get('/template-surat/spj-hki', function () {
        return view('template_surat.spj_hki');
    })->name('template.spj_hki');
        
    // Rute Kartu Kendali
    Route::get('/kartu-kendali', [KartuKendaliController::class, 'index'])->name('kartukendali.index');
    Route::post('/kartu-kendali', [KartuKendaliController::class, 'store'])->name('kartukendali.store')->middleware('role:developer');
    Route::put('/kartu-kendali/{id}', [KartuKendaliController::class, 'update'])->name('kartukendali.update')->middleware('role:developer');
    Route::delete('/kartu-kendali/{id}', [KartuKendaliController::class, 'destroy'])->name('kartukendali.destroy')->middleware('role:developer');
    
    // Rute Manajemen User
    Route::resource('users', UserController::class)->middleware('role:developer');
    
    // Rute Developer
    Route::middleware('role:developer')->group(function () {
        Route::post('/developer/clear-cache', [DeveloperController::class, 'clearCache'])->name('developer.clear-cache');
        Route::post('/developer/generate-dummy', [DeveloperController::class, 'generateDummyData'])->name('developer.generate-dummy');
        Route::post('/developer/impersonate/{id}', [DeveloperController::class, 'impersonate'])->name('developer.impersonate');
    });
    
    // ====================================================================
    // RUTE RKPD: FITUR SMART PREVIEW & PEMOTONG PDF
    // ====================================================================
    Route::get('/rkpd/preview', function () {
        // Arahkan ke folder utama
        $path = public_path('Dokumen RKPD'); 
        
        // Array penampung file yang dikelompokkan
        $pdfFiles = [];
        
        // Scan semua sub-folder di dalam "Dokumen RKPD"
        if(File::exists($path)) {
            $directories = File::directories($path);
            
            foreach($directories as $dir) {
                $folderName = basename($dir); // Mendapatkan nama folder (Contoh: "RKPD 2024")
                $filesInDir = File::files($dir); // Mendapatkan isi file PDF-nya
                
                foreach($filesInDir as $file) {
                    if($file->getExtension() === 'pdf') {
                        // Simpan path lengkap untuk value dropdown
                        $pdfFiles[$folderName][] = [
                            'path' => $folderName . '/' . $file->getFilename(),
                            // Teks yang akan tampil di layar (garis bawah diubah jadi spasi agar rapi)
                            'nama_tampil' => str_replace('_', ' ', $file->getFilenameWithoutExtension()) 
                        ];
                    }
                }
            }
        }

        return view('rkpd.preview', compact('pdfFiles'));
    })->name('rkpd.preview');
    
    Route::post('/rkpd/potong', [RkpdController::class, 'potongPdf'])->name('rkpd.potong');
});

require __DIR__.'/auth.php';