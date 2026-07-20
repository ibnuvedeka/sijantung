<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Rka;
use App\Models\TransaksiKartuKendali;

$map = [
    2 => 2,
    3 => 3,
    7 => 7,
    11 => 12,
    17 => 13,
    18 => 14,
    19 => 15,
];

// First, restore rka_id in transactions
$transaksis = TransaksiKartuKendali::all();
foreach($transaksis as $t) {
    if (isset($map[$t->rka_id])) {
        $t->rka_id = $map[$t->rka_id];
        $t->save();
        echo "Updated Transaksi {$t->id}: new rka_id = {$t->rka_id}\n";
    }
}

// Second, recalculate 'sisa' for all RKAs
$rkas = Rka::all();
foreach($rkas as $r) {
    $total_terserap = TransaksiKartuKendali::where('rka_id', $r->id)->sum('jumlah');
    $r->sisa = $r->pagu - $total_terserap;
    $r->save();
    echo "Updated Rka {$r->id}: sisa = {$r->sisa}\n";
}

// Third, recalculate 'sisa_akhir' running balance in transactions (optional but good for consistency)
foreach($rkas as $r) {
    $rka_transaksis = TransaksiKartuKendali::where('rka_id', $r->id)->orderBy('tanggal', 'asc')->orderBy('id', 'asc')->get();
    $running_balance = $r->pagu;
    foreach($rka_transaksis as $t) {
        $running_balance -= $t->jumlah;
        $t->sisa_akhir = $running_balance;
        $t->save();
    }
}

echo "Done.\n";
