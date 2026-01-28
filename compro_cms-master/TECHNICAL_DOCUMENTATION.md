<!-- 
🛑 INSTRUKSI KUNCI UNTUK AI AGENT (Wajib Dibaca)
Dokumen ini adalah "LIVING DOCUMENT" (Dokumen Hidup).
Setiap kali Anda (AI) melakukan perubahan signifikan pada kode (Refactoring, Fitur Baru, Perubahan Arsitektur), Anda WAJIB:
1. Memeriksa apakah perubahan tersebut membuat dokumentasi ini menjadi usang.
2. Memperbarui bagian yang relevan segera setelah coding selesai.
3. Mencatat perubahan Anda di bagian "Riwayat Pembaruan Otomatis" di paling bawah.
JANGAN PERNAH meninggalkan dokumen ini dalam keadaan tidak akurat.
-->

# 📘 Dokumentasi Teknis Sistem: CMS Duta Solusi

## 1. Ringkasan Proyek
*   **Nama Identitas**: `CMS Duta Solusi` (Pengembangan dari `magang_cms`/`compro_cms`)
*   **Domain Produksi**: `cmsdutasolusi.co.id`
*   **Tipe**: Corporate Web App dengan Integrasi E-Commerce & Modul Interaktif
*   **Framework**: Laravel 9.1 (PHP ^8.1)
*   **Frontend**: Hybrid (Blade Templates + Vue.js v2 untuk komponen interaktif)
*   **Tujuan**: Website profil korporat untuk PT CMS Duta Solusi (Anak usaha BPJS Kesehatan) yang mencakup layanan, portofolio, berita, dan e-commerce.

## 2. Arsitektur Sistem

### Desain Level Tinggi
Sistem menggunakan arsitektur Monolithic MVC yang telah dimodifikasi dengan "Premium Design System":
1.  **View Layer (Hybrid)**:
    *   **Blade**: Menangani 90% rendering halaman (Layouts, Static Pages).
    *   **Vue.js (Widget)**: Digunakan khusus untuk bagian interaktif kompleks seperti **Bagian "Tim Kami"** (`team_section_app.js`).
    *   **Premium CSS**: Menggunakan `premium_override.css` untuk menimpa gaya bawaan template.
2.  **Controller**: Logika bisnis standar Laravel.
3.  **Middleware**: `XSS` protection dan `Auth`.

### Grafik Dependensi & Tech Stack
*   **Backend**: PHP 8.1, Laravel 9.x
*   **Database**: MySQL
*   **Frontend**:
    *   Bootstrap 5 (CDN & Local)
    *   jQuery (Legacy plugins: OwlCarousel, Isotope)
    *   **Vue.js 2**: Runtime-only build untuk komponen `TeamSection`.
*   **Integrasi Pihak Ketiga**:
    *   PayPal (Pembayaran)
    *   Floating WhatsApp (Live Chat)
    *   Google/Facebook Analytics (Script injections)

---

## 3. Struktur Direktori & File Kunci

```text
/
├── app/Http/Controllers/
│   ├── Admin/              # CRUD Backend
│   └── Web/                # Frontend (CommerceController, HomeController, dll)
├── public/
│   ├── iso/                # Aset statis terisolasi
│   ├── js/
│   │   └── team_section_app.js # [KRUSIAL] Build Vue.js untuk section Team
│   └── web/
│       ├── css/
│       │   ├── premium_override.css # [KRUSIAL] Styling utama desain baru
│       │   └── style.css            # Styling legacy
│       └── layouts/master.blade.php # Layout utama dengan Mega Menu hardcoded
├── resources/views/
│   ├── web/
│   │   ├── index.blade.php # Halaman dengan integrasi Vue & Hardcoded Content
│   │   └── layouts/master.blade.php
└── routes/web.php          # Definisi rute E-Commerce & Halaman
```

## 4. Modul Khusus (Custom Builds)

### A. Modul "Tim Kami" (Team Section)
*   **Jenis**: Single Page Component (embedded).
*   **Lokasi View**: `resources/views/web/index.blade.php` (Line ~134).
*   **Logic JS**: `public/js/team_section_app.js`.
*   **Data Source**: inject JSON via window object (`window.TEAM_MEMBERS`) dari Controller.
*   **Fitur**: Modal profil dinamis, Carousel navigasi custom, Filtering kategori (Direksi, Komisaris).

### B. E-Commerce Engine
*   **Controller**: `CommerceController`
*   **Fitur**:
    *   Cart Management (Session based)
    *   Checkout Flow Simple
    *   Integrasi PayPal
    *   Route `/ecommerce` terpisah dari route konten biasa.

### C. Premium Design System
*   **Implementasi**: File `premium_override.css`.
*   **Karakteristik**:
    *   Glassmorphism pada kartu.
    *   Navigasi Mega Menu (Hardcoded di `master.blade.php`).
    *   Animasi Hover "Wow.js".
    *   Warna Korporat: Biru Gelap (#103652), Aksen Kuning/Hijau.

---

## 5. Alur Data & Logika Utama

### Rendering Halaman Beranda (Home)
1.  **Controller**: `HomeController@index`.
2.  **Data Fetch**: Mengambil Slider, Service, Portfolio, Article, dan **Member**.
3.  **Injection**: Data `Member` di-convert ke JSON -> disuntikkan ke script tag di Blade.
4.  **Client-side Hydration**: `team_section_app.js` membaca JSON -> Merender kartu Tim & Modal secara reaktif.

### Navigasi & Mega Menu
*   **Khusus**: Menu navigasi utama di `master.blade.php` **TIDAK sepenuhnya dinamis** dari database. Struktur Mega Menu (Layanan, E-Commerce, Info Terkini) didefinisikan secara hardcoded (statis) dalam file Blade, meskipun link sub-menu-nya mengambil data kategori.
*   **Perhatian**: Perubahan struktur menu harus dilakukan manual di file `master.blade.php`.

---

## 6. Invarian & Catatan Update

### Identitas Hardcoded
Beberapa elemen identitas tertulis statis (Hardcoded) di `index.blade.php` dan `master.blade.php` karena kebutuhan spesifik klien "CMS Duta Solusi":
*   Logo Fallback: `cmsdutasolusi.co.id/...`
*   Teks "Tentang Kami": Tertulis langsung di Blade, bukan dari database `pages`.
*   Visi & Misi: Tertulis langsung di Blade.

### Panduan Modifikasi untuk AI
1.  **Edit Konten Statis**: Cek `resources/views/web/index.blade.php` baris 430-500 untuk mengubah teks About/Visi Misi.
2.  **Edit Logika Tim**: Jangan edit HTML manual untuk kartu tim. Edit logika di Vue app (source mungkin tidak disertakan, hanya build file) ATAU modifikasi `window.TEAM_MEMBERS` injection di Blade.
3.  **Styling**: Selalu gunakan `premium_override.css` untuk perubahan style agar tidak merusak layout legacy.

## 7. Penanganan Error
*   **Image Missing**: Sistem memiliki *fallback* icon/warna jika gambar (slider/produk) gagal dimuat, namun pastikan path `uploads/` sinkron.
*   **Vue Error**: Jika bagian "Tim" hilang, cek console browser untuk error JS atau pastikan `window.TEAM_MEMBERS` ter-populate JSON valid.

---

## Riwayat Pembaruan Otomatis (Changelog)
*AI Agent: Silakan tambahkan baris baru di bawah ini setelah melakukan perubahan.*

| Tanggal | Modul | Deskripsi Singkat Perubahan | Dilakukan Oleh |
| :--- | :--- | :--- | :--- |
| 2026-01-28 | **Docs Initialization** | Pembuatan awal dokumentasi teknis sesuai kondisi "CMS Duta Solusi". | AI Technical Doc Generator |
