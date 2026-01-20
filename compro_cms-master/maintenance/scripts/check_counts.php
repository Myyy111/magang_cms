<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Sliders: " . App\Models\Slider::where('status', '1')->count() . "\n";
echo "Members: " . App\Models\Member::where('status', '1')->count() . "\n";
