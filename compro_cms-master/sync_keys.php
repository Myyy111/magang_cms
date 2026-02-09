<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    DB::beginTransaction();

    // Get all keys from English
    $enTranslations = DB::table('ltm_translations')->where('locale', 'en')->get();
    
    $count = 0;
    foreach ($enTranslations as $en) {
        // Check if this key exists for ID
        $exists = DB::table('ltm_translations')
            ->where('locale', 'id')
            ->where('group', $en->group)
            ->where('key', $en->key)
            ->exists();
        
        if (!$exists) {
            DB::table('ltm_translations')->insert([
                'status' => 0,
                'locale' => 'id',
                'group' => $en->group,
                'key' => $en->key,
                'value' => $en->value, // Start with English value
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $count++;
        }
    }

    DB::commit();
    echo "BERHASIL! Menambahkan $count kunci terjemahan ke bahasa Indonesia.\n";
} catch (\Exception $e) {
    if (DB::transactionLevel() > 0) DB::rollBack();
    echo "ERROR: " . $e->getMessage() . "\n";
}
