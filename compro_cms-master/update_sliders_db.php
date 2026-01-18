<?php
include 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\Slider;
use Illuminate\Support\Str;

// Clear existing sliders
Slider::truncate();

Slider::create([
    'title' => 'Payment System',
    'slug' => Str::slug('Payment System'),
    'description' => 'PT CMS Duta Solusi menyediakan sistem pembayaran digital yang aman, fleksibel, dan dapat diintegrasikan dengan berbagai platform. Layanan ini dirancang untuk memudahkan proses transaksi keuangan, baik untuk kebutuhan internal perusahaan maupun layanan eksternal kepada pengguna. Dengan teknologi yang andal, sistem ini mendukung efisiensi proses pembayaran dan pencatatan transaksi secara real-time.',
    'image_path' => 'slider_it_solutions.png',
    'status' => 1
]);

Slider::create([
    'title' => 'Penyedia Tenaga Kerja Profesional',
    'slug' => Str::slug('Penyedia Tenaga Kerja Profesional'),
    'description' => 'Kami menghadirkan talenta terbaik yang kompeten dan berpengalaman untuk mendukung operasional bisnis Anda secara optimal.',
    'image_path' => 'slider_manpower.png',
    'status' => 1
]);

Slider::create([
    'title' => 'Inovasi Digital & Business Edu Tech',
    'slug' => Str::slug('Inovasi Digital & Business Edu Tech'),
    'description' => 'Transformasi berkelanjutan melalui pelatihan dan solusi teknologi pendidikan yang dirancang khusus untuk era digital.',
    'image_path' => 'slider_digital.png',
    'status' => 1
]);

echo "Sliders updated successfully with the specific Payment System description.";
