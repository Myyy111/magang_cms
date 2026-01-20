<?php
include 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$count = \App\Models\Article::count();
$activeCount = \App\Models\Article::where('status', '1')->count();

echo "Total Articles: " . $count . "\n";
echo "Active Articles: " . $activeCount . "\n";
