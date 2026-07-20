<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Rka;
use App\Models\TransaksiKartuKendali;

$rkas = Rka::all();
$transaksis = TransaksiKartuKendali::all();

echo "New RKAs:\n";
foreach($rkas as $r) {
    echo "ID: {$r->id} - {$r->kode} - {$r->nama} - {$r->sub_kegiatan}\n";
}

echo "\nOld Transaksis:\n";
foreach($transaksis as $t) {
    echo "ID: {$t->id} - Old Rka ID: {$t->rka_id} - Kode: {$t->kode} - Uraian: {$t->uraian} - Jumlah: {$t->jumlah}\n";
}
