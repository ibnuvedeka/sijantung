<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rka extends Model
{
    protected $fillable = ['kode', 'nama', 'program', 'kegiatan', 'sub_kegiatan', 'pagu', 'sisa'];
}
