<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$map = [
    1=>2, 2=>2, 
    3=>3, 4=>3, 
    5=>11, 6=>11, 
    7=>7, 
    9=>17, 
    10=>18, 11=>18, 
    12=>19, 13=>19, 14=>19, 15=>19, 16=>19, 17=>19
];

foreach($map as $tid=>$rid) {
    \App\Models\TransaksiKartuKendali::where('id', $tid)->update(['rka_id'=>$rid]);
}
echo "Done\n";
