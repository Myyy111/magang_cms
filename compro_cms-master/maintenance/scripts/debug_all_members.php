<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$all_members = App\Models\Member::all();
echo "Total Members in DB: " . $all_members->count() . "\n";
foreach($all_members as $m) {
    echo "- " . $m->title . " | Status: " . $m->status . " | Kategori: " . ($m->kategori ?? 'NULL') . "\n";
}
