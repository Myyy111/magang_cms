<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\About;

$about = About::first();
if ($about) {
    $about->update([
        'title' => 'Tentang Kami',
        'description' => '<p>PT CMS Duta Solusi merupakan anak Perusahaan BPJS Kesehatan yang didirikan berdasarkan ketetapan Menteri Hukum Republik Indonesia Nomor AHU-0020776.AH.01.02.Tahun 2025. Kami berfokus pada penyediaan solusi digital dan layanan profesional yang handal.</p><p>Dengan komitmen menjadi mitra strategis yang andal, kami membantu klien mewujudkan efisiensi kerja, kualitas layanan, serta daya saing yang berkelanjutan di era digital.</p>',
        'mission_title' => 'Misi Kami',
        'mission_desc' => '<ul class="list-unstyled mb-0">
            <li class="mb-3 d-flex align-items-start">
                <i class="fas fa-check-circle mt-1 me-3 text-success"></i>
                <span style="color: #000000 !important;">Kolaborasi strategis untuk percepatan bisnis dan transfer knowledge.</span>
            </li>
            <li class="mb-3 d-flex align-items-start">
                <i class="fas fa-check-circle mt-1 me-3 text-success"></i>
                <span style="color: #000000 !important;">Nilai tambah melalui otomasi bisnis dan efisiensi biaya.</span>
            </li>
            <li class="d-flex align-items-start">
                <i class="fas fa-check-circle mt-1 me-3 text-success"></i>
                <span style="color: #000000 !important;">Layanan prima yang berorientasi pada kepuasan pelanggan.</span>
            </li>
        </ul>',
        'vision_title' => 'Visi Kami',
        'vision_desc' => '<p>Menjadi Perusahaan yang inovatif, kolaboratif dan mampu memberikan nilai tambah bagi investor, mitra dan pelanggan.</p>',
    ]);
    echo "Database About berhasil diperbarui agar selaras dengan beranda!\n";
} else {
    echo "Data About tidak ditemukan.\n";
}
