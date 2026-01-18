<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "FAQ Categories:\n";
foreach(App\Models\FaqCategory::all() as $cat) {
    echo "- IDs: {$cat->id}, Title: {$cat->title}, Status: {$cat->status}, Slug: {$cat->slug}\n";
    $count = App\Models\Faq::where('category_id', $cat->id)->where('status', '1')->count();
    echo "  Total FAQs (active): {$count}\n";
}
