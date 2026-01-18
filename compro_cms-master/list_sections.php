<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sections = App\Models\Section::all();
foreach($sections as $s) {
    echo "Slug: [" . $s->slug . "] | Status: " . $s->status . "\n";
}
