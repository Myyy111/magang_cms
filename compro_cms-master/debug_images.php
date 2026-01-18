<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$members = App\Models\Member::where('status', '1')->get();

foreach($members as $m) {
    echo "- " . $m->title . " | Kategori: " . $m->kategori . " | Image: " . $m->image_path . "\n";
    $fullPath = public_path('uploads/member/' . $m->image_path);
    echo "  File exists: " . (file_exists($fullPath) ? "YES" : "NO") . " ($fullPath)\n";
}
