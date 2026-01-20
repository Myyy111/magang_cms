-- File: update_live_content.sql
SET FOREIGN_KEY_CHECKS = 0;

-- Update Settings
UPDATE settings SET 
    contact_address = 'Jalan Letjen Suprapto Kav. 20 Nomor 14, Cempaka Putih, RT 010 RW 007, Kelurahan Cempaka Putih Timur, Kecamatan Cempaka Putih, Kode Pos 10510',
    phone_one = '+62 81188022717',
    email_one = 'business@cmsdutasolusi.co.id',
    footer_text = '<p>Get in your inbox the latest News and Offers from</p>';

-- (The rest of file stays same, but I need to wrap it effectively or just prepend/append. Replace file content is handy)
-- ... [I need to include the whole file context or just first few lines and last lines but replace_file allows me to replace chunks. I'll replace the top and bottom.]

-- [Actually better to specific chunk]

-- Update Sliders
TRUNCATE TABLE sliders;
INSERT INTO sliders (title, slug, description, status, created_at, updated_at) VALUES
('Payment System', 'payment-system', '<p>PT CMS Duta Solusi menyediakan sistem pembayaran digital yang aman, fleksibel, dan dapat diintegrasikan dengan berbagai platform.</p>', 1, NOW(), NOW()),
('Tiket Perjalanan', 'tiket-perjalanan', '<p>Layanan ini membantu pengelolaan tiket perjalanan dinas baik domestik maupun internasional.</p>', 1, NOW(), NOW()),
('Event Management', 'event-management', '<p>PT CMS Duta Solusi menawarkan layanan manajemen acara secara profesional untuk kebutuhan internal maupun eksternal perusahaan.</p>', 1, NOW(), NOW()),
('Pengadaan Seminar Kit', 'pengadaan-seminar-kit', '<p>PT CMS Duta Solusi menyediakan layanan pengadaan seminar kit atau paket perlengkapan kegiatan.</p>', 1, NOW(), NOW()),
('Sertifikasi & Pelatihan', 'sertifikasi-pelatihan', '<p>PT CMS Duta Solusi menyediakan program pelatihan dan sertifikasi yang dirancang untuk meningkatkan kompetensi SDM.</p>', 1, NOW(), NOW());

-- Update Services
TRUNCATE TABLE services;
INSERT INTO services (title, slug, description, status, created_at, updated_at) VALUES
('Payment System', 'payment-system', '<p>Sistem pembayaran digital yang aman dan terintegrasi.</p>', 1, NOW(), NOW()),
('Sistem Rekonsiliasi', 'sistem-rekonsiliasi', '<p>Solusi rekonsiliasi data transaksi keuangan yang akurat.</p>', 1, NOW(), NOW()),
('WhatsApp Blast Payment', 'whatsapp-blast-payment', '<p>Notifikasi pembayaran dan promosi melalui WhatsApp Official.</p>', 1, NOW(), NOW()),
('Digital SCF / SIF', 'digital-scf-sif', '<p>Solusi Supply Chain Financing berbasis digital.</p>', 1, NOW(), NOW()),
('Credit Scoring Based on Data Kesehatan', 'credit-scoring-based-on-data-kesehatan', '<p>Analisis kredit inovatif menggunakan data kesehatan.</p>', 1, NOW(), NOW()),
('SIMRS', 'simrs', '<p>Sistem Informasi Manajemen Rumah Sakit yang komprehensif.</p>', 1, NOW(), NOW()),
('Sertifikasi Kompetensi dan Pelatihan', 'sertifikasi-kompetensi-dan-pelatihan', '<p>Pelatihan dan sertifikasi profesi terpercaya.</p>', 1, NOW(), NOW()),
('Learning Management System (LMS)', 'learning-management-system-lms', '<p>Platform pembelajaran digital untuk korporasi dan edukasi.</p>', 1, NOW(), NOW()),
('Event Management', 'event-management', '<p>Pengelolaan event profesional dari perencanaan hingga eksekusi.</p>', 1, NOW(), NOW()),
('Pengadaan Seminar Kit', 'pengadaan-seminar-kit', '<p>Penyediaan paket seminar kit berkualitas.</p>', 1, NOW(), NOW()),
('Tiket Perjalanan', 'tiket-perjalanan', '<p>Layanan pemesanan tiket perjalanan dinas korporat.</p>', 1, NOW(), NOW()),
('Collection System', 'collection-system', '<p>Sistem penagihan dan manajemen piutang yang efisien.</p>', 1, NOW(), NOW());

-- Update Portfolios
TRUNCATE TABLE portfolios;
INSERT INTO portfolios (title, slug, description, status, created_at, updated_at) VALUES
('Rekonsiliasi Data Pembayaran', 'rekonsiliasi-data-pembayaran-integrasi-dan-validasi-data-antar-sistem', '<p>Integrasi dan Validasi Data Antar Sistem</p>', 1, NOW(), NOW()),
('Penyelenggaraan Seminar Kit', 'penyelenggaraan-seminar-kit', '<p>Pengadaan seminar kit untuk berbagai event nasional.</p>', 1, NOW(), NOW()),
('Penyelenggaraan Event – PERNAS', 'penyelenggaraan-event-pertemuan-nasional-pernas', '<p>Pertemuan Nasional</p>', 1, NOW(), NOW()),
('Layanan Pemesanan Tiket Perjalanan', 'layanan-pemesanan-tiket-perjalanan-pt-cms-duta-solusi', '<p>Manajemen perjalanan dinas PT CMS Duta Solusi.</p>', 1, NOW(), NOW()),
('Aplikasi KOLBU', 'aplikasi-kolbu-solusi-pengumpulan-iuran-pbpu-menunggak', '<p>Solusi Pengumpulan Iuran PBPU Menunggak.</p>', 1, NOW(), NOW()),
('Sertifikasi Kompetensi', 'sertifikasi-kompetensi', '<p>Program sertifikasi untuk profesional.</p>', 1, NOW(), NOW());

-- Create Designation if not exists
INSERT IGNORE INTO designations (id, title, slug, status, created_at, updated_at) VALUES (1, 'Team Member', 'team-member', 1, NOW(), NOW());

-- Update Teams (Members)
TRUNCATE TABLE members;
INSERT INTO members (title, slug, designation_id, status, created_at, updated_at) VALUES
('Mahat Kusumadi', 'mahat-kusumadi', 1, 1, NOW(), NOW()),
('Agung Dermawan', 'agung-dermawan', 1, 1, NOW(), NOW()),
('Namunsen', 'namunsen', 1, 1, NOW(), NOW()),
('Subangkit', 'subangkit', 1, 1, NOW(), NOW()),
('Lili', 'lili', 1, 1, NOW(), NOW()),
('Ferry', 'ferry', 1, 1, NOW(), NOW()),
('Maria', 'maria', 1, 1, NOW(), NOW());
SET FOREIGN_KEY_CHECKS = 1;
