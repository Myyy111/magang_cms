<?php
include 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Service;

// Update Service images
Service::where('id', 1)->update(['image_path' => 'service_it_solution.png']); // IT Solution / Payment
Service::where('id', 7)->update(['image_path' => 'service_edutech.png']); // Training
Service::where('id', 12)->update(['image_path' => 'service_manpower.png']); // Collection / Manpower

echo "Service images updated in DB.";
