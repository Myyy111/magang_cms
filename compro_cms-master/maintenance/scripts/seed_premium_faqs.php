<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Faq;
use App\Models\FaqCategory;

// Clear existing FAQs to avoid mess
Faq::truncate();

$faqs = [
    // IT Solution (ID 9)
    [
        'category_id' => 9,
        'title' => 'Apa saja layanan IT Managed Services yang ditawarkan oleh CMS?',
        'description' => '<p>CMS menyediakan layanan pengelolaan infrastruktur IT secara menyeluruh, mencakup pemeliharaan server, pengelolaan jaringan, keamanan siber, hingga dukungan teknis 24/7 untuk memastikan operasional bisnis Anda berjalan tanpa gangguan.</p>',
    ],
    [
        'category_id' => 9,
        'title' => 'Bagaimana CMS menjamin keamanan data dalam solusi cloud?',
        'description' => '<p>Kami menggunakan enkripsi tingkat tinggi, kontrol akses berlapis, dan pemantauan real-time untuk melindungi data Anda. Seluruh solusi cloud kami juga mematuhi standar keamanan internasional untuk menjamin privasi dan integritas data klien.</p>',
    ],
    
    // Man Power Provider (ID 10)
    [
        'category_id' => 10,
        'title' => 'Bagaimana proses seleksi tenaga kerja di CMS?',
        'description' => '<p>Proses seleksi kami sangat ketat, melibatkan psikotes, uji kompetensi teknis, hingga wawancara mendalam. Kami memastikan setiap tenaga kerja yang kami salurkan memiliki kualifikasi dan budaya kerja yang selaras dengan kebutuhan klien.</p>',
    ],
    [
        'category_id' => 10,
        'title' => 'Apakah CMS menyediakan tenaga kerja untuk level manajerial?',
        'description' => '<p>Ya, CMS melayani kebutuhan tenaga kerja mulai dari level entry, staf ahli, hingga posisi manajerial dan eksekutif (headhunting) untuk berbagai sektor industri.</p>',
    ],

    // Sertifikasi & Pelatihan (ID 11)
    [
        'category_id' => 11,
        'title' => 'Sertifikasi apa saja yang tersedia melalui program CMS?',
        'description' => '<p>Kami menyediakan berbagai program sertifikasi profesional di bidang IT (seperti Cisco, Microsoft, AWS), manajemen proyek, hingga pelatihan keselamatan kerja (K3) yang diakui secara nasional maupun internasional.</p>',
    ],
    [
        'category_id' => 11,
        'title' => 'Apakah pelatihan bisa dilakukan secara In-House di kantor kami?',
        'description' => '<p>Tentu. Kami menawarkan program Corporate Training yang fleksibel, di mana instruktur kami dapat datang langsung ke lokasi perusahaan Anda dengan kurikulum yang disesuaikan dengan kebutuhan spesifik tim Anda.</p>',
    ],
];

foreach ($faqs as $faqData) {
    Faq::create([
        'category_id' => $faqData['category_id'],
        'title' => $faqData['title'],
        'slug' => str_slug($faqData['title']),
        'description' => $faqData['description'],
        'status' => '1',
    ]);
}

echo "Database FAQ berhasil diperbarui dengan data premium!\n";
