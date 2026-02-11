<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\User;

foreach (User::all() as $user) {
    echo "Email: " . $user->email . " | Role: " . $user->role . PHP_EOL;
}
