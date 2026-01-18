<?php
include 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$categories = \App\Models\ArticleCategory::all();
foreach ($categories as $cat) {
    echo "ID: " . $cat->id . " - Title: " . $cat->title . "\n";
}
if ($categories->isEmpty()) {
    echo "No categories found.\n";
}
