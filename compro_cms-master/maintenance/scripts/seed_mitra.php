<?php
include 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Client;

$mitra = [
    ['title' => 'Mitra 1', 'link' => '#'],
    ['title' => 'Mitra 2', 'link' => '#'],
    ['title' => 'Mitra 3', 'link' => '#'],
    ['title' => 'Mitra 4', 'link' => '#'],
    ['title' => 'Mitra 5', 'link' => '#'],
    ['title' => 'Mitra 6', 'link' => '#'],
];

foreach ($mitra as $m) {
    Client::create([
        'title' => $m['title'],
        'slug' => \Illuminate\Support\Str::slug($m['title']),
        'link' => $m['link'],
        'image_path' => null,
        'status' => '1'
    ]);
}

echo "Created 6 dummy mitra.\n";
