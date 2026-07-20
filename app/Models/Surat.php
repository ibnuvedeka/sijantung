<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    // Tambahkan baris ini agar aplikasi SIJANTUNG diizinkan mengisi kolom-kolom ini
    protected $fillable = [
        'nomor_surat',
        'perihal',
        'tanggal_surat',
        'pengirim',
        'status',
        'file_pdf',
    ];
}