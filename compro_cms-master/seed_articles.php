<?php
include 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Article;
use Illuminate\Support\Str;

$dummies = [
    [
        'title' => 'Strategi Digital Marketing untuk Bisnis di Tahun 2024',
        'description' => 'Pelajari bagaimana mengoptimalkan bisnis Anda dengan tren digital terbaru, mulai dari AI hingga pemasaran media sosial yang inovatif.',
        'image_path' => 'dummy1.jpg'
    ],
    [
        'title' => 'Pentingnya Keamanan Data Bagi Perusahaan Modern',
        'description' => 'Dalam era digital, data adalah aset paling berharga. Lindungi infrastruktur TI Anda dengan sistem keamanan berlapis terbaru.',
        'image_path' => 'dummy2.jpg'
    ],
    [
        'title' => 'Transformasi Digital: Kunci Efisiensi Operasional',
        'description' => 'Bagaimana mengintegrasikan teknologi digital ke dalam setiap proses bisnis untuk meningkatkan produktivitas dan kepuasan pelanggan.',
        'image_path' => 'dummy3.jpg'
    ]
];

foreach ($dummies as $d) {
    Article::create([
        'category_id' => 23,
        'title' => $d['title'],
        'slug' => Str::slug($d['title']),
        'description' => $d['description'],
        'image_path' => null, // No image actual file yet, but will show placeholder
        'status' => '1'
    ]);
}

echo "Created 3 dummy articles.\n";
