<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    DB::beginTransaction();

    $translations = [
        ['group' => 'dashboard', 'key' => 'product', 'locale' => 'en', 'value' => 'Product|Products'],
        ['group' => 'dashboard', 'key' => 'product', 'locale' => 'id', 'value' => 'Produk|Produk'],
        ['group' => 'dashboard', 'key' => 'order', 'locale' => 'en', 'value' => 'Order|Orders'],
        ['group' => 'dashboard', 'key' => 'order', 'locale' => 'id', 'value' => 'Pesanan|Pesanan'],
        ['group' => 'dashboard', 'key' => 'work_area', 'locale' => 'en', 'value' => 'Work Area'],
        ['group' => 'dashboard', 'key' => 'work_area', 'locale' => 'id', 'value' => 'Wilayah Kerja'],
    ];

    foreach ($translations as $t) {
        DB::table('ltm_translations')->updateOrInsert(
            ['group' => $t['group'], 'key' => $t['key'], 'locale' => $t['locale']],
            ['value' => $t['value'], 'status' => 0, 'updated_at' => now()]
        );
    }

    DB::commit();
    echo "BERHASIL! Data terjemahan diperbarui.\n";
} catch (\Exception $e) {
    if (DB::transactionLevel() > 0) DB::rollBack();
    echo "ERROR: " . $e->getMessage() . "\n";
}
