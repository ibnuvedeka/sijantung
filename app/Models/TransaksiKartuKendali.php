<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiKartuKendali extends Model
{
    protected $fillable = ['rka_id', 'tanggal', 'kode', 'uraian', 'jumlah', 'sisa_akhir'];
}
