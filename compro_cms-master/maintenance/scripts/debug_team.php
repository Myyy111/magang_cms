<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$section = App\Models\Section::where('slug', 'team')->first();
$members = App\Models\Member::where('status', '1')->get();

echo "Section Team: " . ($section ? "Exists (Status: " . $section->status . ")" : "Not Found") . "\n";
echo "Total Active Members: " . $members->count() . "\n";

foreach($members as $m) {
    echo "- " . $m->title . " (Kategori: " . $m->kategori . ")\n";
}
