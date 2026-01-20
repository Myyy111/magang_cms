<?php
include 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$sliders = \App\Models\Slider::all();
foreach ($sliders as $slider) {
    echo "ID: " . $slider->id . " | Title: " . $slider->title . " | Image: " . $slider->image_path . "\n";
}
