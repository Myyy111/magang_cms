<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    DB::beginTransaction();

    $indonesianTranslations = [
        // Sidebar / Dashboard Group
        'dashboard' => 'Dashboard',
        'quote' => 'Penawaran|Penawaran',
        'invoice' => 'Faktur|Faktur',
        'blog' => 'Berita|Berita',
        'blog_list' => 'Daftar Berita',
        'blog_category' => 'Kategori Berita',
        'portfolio' => 'Portofolio|Portofolio',
        'portfolio_list' => 'Daftar Portofolio',
        'portfolio_category' => 'Kategori Portofolio',
        'service' => 'Layanan|Layanan',
        'pricing' => 'Harga|Harga',
        'team' => 'Tim Kami',
        'member' => 'Anggota|Anggota',
        'designation' => 'Jabatan',
        'faq' => 'Tanya Jawab|Tanya Jawab',
        'faq_list' => 'Daftar Tanya Jawab',
        'faq_category' => 'Kategori Tanya Jawab',
        'slider' => 'Slider|Slider',
        'partner' => 'Mitra|Mitra',
        'testimonial' => 'Testimoni|Testimoni',
        'work_process' => 'Proses Kerja|Proses Kerja',
        'feature' => 'Mengapa Memilih Kami',
        'counter' => 'Penghitung|Penghitung',
        'email' => 'Email',
        'subscriber' => 'Pelanggan|Pelanggan',
        'about' => 'Tentang Kami',
        'page' => 'Halaman|Halaman',
        'page_setup' => 'Pengaturan Halaman',
        'footer_page' => 'Halaman Footer',
        'section' => 'Bagian|Bagian',
        'template' => 'Template Email',
        'live_chat' => 'Obrolan Langsung',
        'language' => 'Bahasa|Bahasa',
        'translation' => 'Terjemahan|Terjemahan',
        'setting' => 'Pengaturan|Pengaturan',
        'general_setting' => 'Pengaturan Umum',
        'product' => 'Produk|Produk',
        'order' => 'Pesanan|Pesanan',
        'work_area' => 'Wilayah Kerja',
    ];

    foreach ($indonesianTranslations as $key => $value) {
        DB::table('ltm_translations')->where('locale', 'id')
            ->where('group', 'dashboard')
            ->where('key', $key)
            ->update(['value' => $value, 'updated_at' => now()]);
    }

    DB::commit();
    echo "BERHASIL! Seluruh menu admin telah diterjemahkan ke Bahasa Indonesia.\n";
} catch (\Exception $e) {
    if (DB::transactionLevel() > 0) DB::rollBack();
    echo "ERROR: " . $e->getMessage() . "\n";
}
