<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'teknisi@mail.com')->first();
if (!$user) {
    $user = new User();
    $user->name = 'Teknisi 1';
    $user->email = 'teknisi@mail.com';
    $user->password = Hash::make('password');
    $user->role = 'teknisi';
    $user->save();
    echo "User teknisi@mail.com created successfully." . PHP_EOL;
} else {
    $user->role = 'teknisi';
    $user->save();
    echo "User teknisi@mail.com updated to teknisi role." . PHP_EOL;
}
