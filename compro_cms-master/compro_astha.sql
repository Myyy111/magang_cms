-- MySQL dump 10.13  Distrib 8.4.4, for macos15.2 (arm64)
--
-- Host: localhost    Database: compro_astha
-- ------------------------------------------------------
-- Server version	8.4.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `abouts`
--

DROP TABLE IF EXISTS `abouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `abouts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mission_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `vision_title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vision_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `abouts_title_unique` (`title`),
  UNIQUE KEY `abouts_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abouts`
--

LOCK TABLES `abouts` WRITE;
/*!40000 ALTER TABLE `abouts` DISABLE KEYS */;
INSERT INTO `abouts` VALUES (3,'Tentang Kami','tentang-kami','<p>Asthabagja Sinergi Nusantara adalah perusahaan multibidang yang berfokus pada penyediaan layanan profesional dan terintegrasi dalam sektor konstruksi, interior, pengembangan teknologi informasi (IT Developer), serta distribusi alat kesehatan. Didirikan dengan semangat kolaborasi dan inovasi, kami hadir untuk memberikan solusi menyeluruh bagi berbagai kebutuhan pembangunan dan transformasi bisnis di Indonesia.<p>Kami percaya bahwa keberhasilan sebuah proyek tidak hanya diukur dari hasil akhir, tetapi juga dari proses, integritas, dan keberlanjutan nilai yang dihasilkan. Oleh karena itu, setiap layanan kami dikembangkan dengan pendekatan yang berorientasi pada hasil, efisien, dan berbasis teknologi.</p></p>\n','about.png',NULL,'Misi Kami','<ol><li>Memberikan layanan konstruksi dan interior yang presisi, tepat waktu, dan berstandar tinggi.</li><li>Mengembangkan solusi teknologi digital yang efisien, aman, dan sesuai kebutuhan industri.</li><li>Menyediakan produk alat kesehatan berkualitas tinggi dengan layanan purna jual yang dapat diandalkan.</li><li>Membangun ekosistem kerja sama yang sinergis dengan mitra, klien, dan stakeholder.</li><li>Mendorong pertumbuhan bisnis berkelanjutan yang berdampak positif secara sosial dan ekonomi.</li></ol>','Visi Kami','Menjadi perusahaan nasional terpercaya yang menyediakan solusi terintegrasi lintas sektor dengan standar kualitas tinggi, inovasi berkelanjutan, dan kemitraan jangka panjang.',1,'2021-11-07 14:26:20','2025-06-24 17:24:04');
/*!40000 ALTER TABLE `abouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article_categories`
--

DROP TABLE IF EXISTS `article_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `article_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_categories_title_unique` (`title`),
  UNIQUE KEY `article_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article_categories`
--

LOCK TABLES `article_categories` WRITE;
/*!40000 ALTER TABLE `article_categories` DISABLE KEYS */;
INSERT INTO `article_categories` VALUES (5,'Konstruksi & Infrastruktur','konstruksi-infrastruktur',NULL,1,'2025-06-24 16:25:03','2025-06-24 16:25:03'),(6,'Desain & Interior','desain-interior',NULL,1,'2025-06-24 16:25:35','2025-06-24 16:25:39'),(7,'Teknologi & IT Solutions','teknologi-it-solutions',NULL,1,'2025-06-24 16:25:48','2025-06-24 16:25:48'),(8,'Alat Kesehatan & MedTech','alat-kesehatan-medtech',NULL,1,'2025-06-24 16:25:59','2025-06-24 16:25:59'),(9,'Proyek & Studi Kasus','proyek-studi-kasus',NULL,1,'2025-06-24 16:26:06','2025-06-24 16:26:06'),(10,'Wawasan Bisnis & Inovasi','wawasan-bisnis-inovasi',NULL,1,'2025-06-24 16:26:13','2025-06-24 16:26:13'),(11,'Berita Perusahaan & Event','berita-perusahaan-event',NULL,1,'2025-06-24 16:26:23','2025-06-24 16:26:23');
/*!40000 ALTER TABLE `article_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `articles_title_unique` (`title`),
  UNIQUE KEY `articles_slug_unique` (`slug`),
  KEY `articles_category_id_foreign` (`category_id`),
  CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `article_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_title_unique` (`title`),
  UNIQUE KEY `clients_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `counters`
--

DROP TABLE IF EXISTS `counters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `counters` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `counters_title_unique` (`title`),
  UNIQUE KEY `counters_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `counters`
--

LOCK TABLES `counters` WRITE;
/*!40000 ALTER TABLE `counters` DISABLE KEYS */;
INSERT INTO `counters` VALUES (5,'Proyek Terselesaikan','proyek-terselesaikan',NULL,NULL,0,1,'2025-06-24 16:43:18','2025-06-24 16:43:32'),(6,'Klien Korporat','klien-korporat',NULL,NULL,0,1,'2025-06-24 16:43:27','2025-06-24 16:43:27'),(7,'Tahun Pengalaman','tahun-pengalaman',NULL,NULL,1,1,'2025-06-24 16:43:41','2025-06-24 16:43:41'),(8,'Mitra Strategis','mitra-strategis',NULL,NULL,0,1,'2025-06-24 16:43:51','2025-06-24 16:43:51');
/*!40000 ALTER TABLE `counters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `designations`
--

DROP TABLE IF EXISTS `designations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `designations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `designations_title_unique` (`title`),
  UNIQUE KEY `designations_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `designations`
--

LOCK TABLES `designations` WRITE;
/*!40000 ALTER TABLE `designations` DISABLE KEYS */;
INSERT INTO `designations` VALUES (4,'Direktur Utama','direktur-utama',NULL,NULL,1,'2025-06-24 16:27:46','2025-06-24 16:27:46');
/*!40000 ALTER TABLE `designations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_templates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_templates_title_unique` (`title`),
  UNIQUE KEY `email_templates_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (17,'Penawaran Diajukan','quote-placed','[company]Alamat: [address], [city].<br>Halo, [name]. Kami hanya ingin memberitahukan bahwa layanan [services] yang Anda pesan sedang dalam proses. Kami akan memberikan pembaruan kepada Anda setiap kali ada tindakan yang kami ambil.<br>Salam hormat,[company]',NULL,1,NULL,'2025-06-24 17:14:03'),(18,'Estimasi Penawaran Telah Dibuat','quote-estimated','[company]Alamat: [address], [city].<br>Halo [name],Kami ingin menginformasikan bahwa layanan [services] yang Anda pesan saat ini sedang dalam proses. Kami akan memberikan pembaruan setiap kali ada perkembangan lebih lanjut.<br>Hormat kami,[company]<br><br>',NULL,1,NULL,'2025-06-24 17:14:39'),(19,'Permintaan Penawaran Anda Disetujui','quote-approved','[company]Alamat: [address], [city].<br>Halo [name],Kami ingin menginformasikan bahwa layanan [services] yang Anda pesan saat ini sedang diproses. Kami akan memberikan pembaruan kepada Anda setiap kali ada tindakan yang kami lakukan.<br>Salam hormat,[company]',NULL,1,NULL,'2025-06-24 17:15:10'),(20,'Permintaan Penawaran Anda Ditolak','quote-rejected','[company]Alamat: [address], [city].<br>Halo [name],Kami ingin menginformasikan bahwa layanan [services] yang Anda pesan saat ini sedang dalam proses. Kami akan memberikan pembaruan setiap kali ada tindakan atau perkembangan lebih lanjut.<br>Salam hormat,[company]',NULL,1,NULL,'2025-06-24 17:15:39'),(21,'Anda Menerima Faktur Pembayaran','invoice-send','company]Alamat: [address], [city].<br>Halo [name],Kami ingin memberi tahu bahwa layanan [services] yang Anda pesan saat ini sedang dalam proses. Kami akan memberikan pembaruan setiap kali ada tindakan yang kami ambil.<br>Salam hormat,[company]',NULL,1,NULL,'2025-06-24 17:16:07'),(22,'Pembayaran Anda Telah Berhasil Diterima','invoice-paid','[company]Alamat: [address], [city].<br>Halo [name],Kami ingin memberi tahu bahwa layanan [services] yang Anda pesan saat ini sedang dalam proses pengerjaan. Kami akan memberikan pembaruan setiap kali ada tindakan atau perkembangan lebih lanjut.<br>Salam hormat,[company]',NULL,1,NULL,'2025-06-24 17:16:34'),(23,'Anda Telah Membatalkan Permintaan Pembayaran','invoice-cancelled','[company]Alamat: [address], [city].<br>Halo [name],Kami ingin menginformasikan bahwa layanan [services] yang Anda pesan saat ini sedang dalam proses. Kami akan memberikan pembaruan setiap kali ada tindakan atau perkembangan lebih lanjut.<br>Hormat kami,[company]',NULL,1,NULL,'2025-06-24 17:17:11'),(24,'Email ini menginformasikan bahwa langganan Anda telah aktif.','subscription','<p>Kami ingin menginformasikan bahwa langganan Anda di platform kami telah berhasil. Kami akan memberikan pembaruan kepada Anda setiap kali ada tindakan atau informasi terbaru.</p><p><br></p><p>Salam hormat,<br>[company]</p>',NULL,1,NULL,'2025-06-24 17:17:48');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq_categories`
--

DROP TABLE IF EXISTS `faq_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faq_categories_title_unique` (`title`),
  UNIQUE KEY `faq_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_categories`
--

LOCK TABLES `faq_categories` WRITE;
/*!40000 ALTER TABLE `faq_categories` DISABLE KEYS */;
INSERT INTO `faq_categories` VALUES (4,'Konstruksi','konstruksi',NULL,1,'2025-06-24 16:58:00','2025-06-24 16:58:00'),(5,'Interior','interior',NULL,1,'2025-06-24 16:58:05','2025-06-24 16:58:05'),(6,'IT Developer','it-developer',NULL,1,'2025-06-24 16:58:12','2025-06-24 16:58:12'),(7,'Alat Kesehatan','alat-kesehatan',NULL,1,'2025-06-24 16:58:18','2025-06-24 16:58:18'),(8,'Umum','umum',NULL,1,'2025-06-24 16:58:24','2025-06-24 16:58:24');
/*!40000 ALTER TABLE `faq_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int unsigned NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `faqs_title_unique` (`title`),
  UNIQUE KEY `faqs_slug_unique` (`slug`),
  KEY `faqs_category_id_foreign` (`category_id`),
  CONSTRAINT `faqs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `faq_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (9,4,'Apa saja jenis proyek konstruksi yang ditangani Asthabagja?','apa-saja-jenis-proyek-konstruksi-yang-ditangani-asthabagja','<p>Kami menangani pembangunan gedung perkantoran, fasilitas publik, infrastruktur, dan renovasi bangunan baik skala kecil maupun besar.</p>\n',1,'2025-06-24 16:59:01','2025-06-24 16:59:01'),(10,4,'Apakah Asthabagja menyediakan layanan desain arsitektur?','apakah-asthabagja-menyediakan-layanan-desain-arsitektur','<p>Ya, kami menyediakan layanan lengkap termasuk desain arsitektur, struktur, MEP, hingga pengurusan izin.</p>\n',1,'2025-06-24 16:59:13','2025-06-24 16:59:13'),(11,4,'Berapa lama durasi rata-rata proyek konstruksi?','berapa-lama-durasi-rata-rata-proyek-konstruksi','<p>Tergantung pada skala proyek. Rata-rata proyek skala menengah memakan waktu antara 3?6 bulan.<p><br></p><p><br></p></p>\n',1,'2025-06-24 16:59:24','2025-06-24 16:59:24'),(12,5,'Apakah saya bisa melakukan konsultasi desain terlebih dahulu?','apakah-saya-bisa-melakukan-konsultasi-desain-terlebih-dahulu','<p>Tentu. Kami menyediakan sesi konsultasi awal gratis untuk memahami kebutuhan dan preferensi desain Anda.</p>\n',1,'2025-06-24 16:59:41','2025-06-24 16:59:41'),(13,5,'Apakah termasuk pembuatan furniture custom?','apakah-termasuk-pembuatan-furniture-custom','<p>Ya, kami menyediakan layanan fit-out lengkap termasuk desain dan produksi custom furniture.</p>\n',1,'2025-06-24 16:59:53','2025-06-24 16:59:53'),(14,5,'Apakah proyek interior bisa dilakukan di luar kota Bandung?','apakah-proyek-interior-bisa-dilakukan-di-luar-kota-bandung','<p>Bisa. Kami melayani proyek interior di berbagai wilayah Indonesia, sesuai kesepakatan kerja sama.</p>\n',1,'2025-06-24 17:00:04','2025-06-24 17:00:04'),(15,6,'Layanan IT apa saja yang tersedia?','layanan-it-apa-saja-yang-tersedia','<p>Kami menyediakan pengembangan aplikasi mobile, website, ERP, SIMRS, HRIS, dan sistem digital lainnya.</p>\n',1,'2025-06-24 17:00:16','2025-06-24 17:00:16'),(16,6,'Apakah sistem dapat disesuaikan dengan kebutuhan pengguna?','apakah-sistem-dapat-disesuaikan-dengan-kebutuhan-pengguna','<p>Ya, seluruh sistem yang kami kembangkan bersifat modular dan dapat disesuaikan dengan proses bisnis klien.</p>\n',1,'2025-06-24 17:00:32','2025-06-24 17:00:32'),(17,6,'Apakah tersedia layanan maintenance?','apakah-tersedia-layanan-maintenance','<p>Tersedia. Kami menyediakan kontrak layanan purna jual dan pemeliharaan sistem berkala.</p>\n',1,'2025-06-24 17:00:45','2025-06-24 17:00:45'),(18,7,'Apakah produk alat kesehatan bersertifikasi resmi?','apakah-produk-alat-kesehatan-bersertifikasi-resmi','<p>Semua produk yang kami distribusikan telah memiliki izin edar dari Kemenkes RI dan/atau bersertifikat internasional.</p>\n',1,'2025-06-24 17:00:58','2025-06-24 17:00:58'),(19,7,'Apakah ada layanan instalasi dan pelatihan?','apakah-ada-layanan-instalasi-dan-pelatihan','<p>Ya, tim teknis kami akan melakukan instalasi serta pelatihan penggunaan alat untuk tenaga medis.</p>\n',1,'2025-06-24 17:01:07','2025-06-24 17:01:07'),(20,7,'Bagaimana cara klaim garansi?','bagaimana-cara-klaim-garansi','<p>Klaim dapat diajukan melalui tim customer service kami dengan melampirkan dokumen pembelian dan kronologi masalah.</p>\n',1,'2025-06-24 17:01:17','2025-06-24 17:01:17'),(21,8,'Bagaimana cara menjalin kerja sama proyek?','bagaimana-cara-menjalin-kerja-sama-proyek','<p>Anda dapat menghubungi kami melalui email atau formulir kontak. Tim kami akan merespons untuk diskusi lebih lanjut.</p>\n',1,'2025-06-24 17:01:29','2025-06-24 17:01:29'),(22,8,'Apakah menerima proyek pemerintah dan swasta?','apakah-menerima-proyek-pemerintah-dan-swasta','<p>Ya, kami melayani kedua segmen dan telah berpengalaman dalam pengadaan proyek pemerintah, BUMN, dan perusahaan swasta nasional.</p>\n',1,'2025-06-24 17:01:40','2025-06-24 17:01:40'),(23,8,'Apakah bisa menjadi mitra/vendor?','apakah-bisa-menjadi-mitravendor','<p>Kami terbuka untuk kerja sama dengan mitra baru. Silakan kirimkan profil perusahaan ke email resmi kami.</p>\n',1,'2025-06-24 17:01:50','2025-06-24 17:01:50');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `get_quotes`
--

DROP TABLE IF EXISTS `get_quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `get_quotes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefer_contact` int DEFAULT NULL,
  `quantity` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `file_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `pre_delivery_time` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `where_find` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `invoice_time` date DEFAULT NULL,
  `mail_status` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `get_quotes`
--

LOCK TABLES `get_quotes` WRITE;
/*!40000 ALTER TABLE `get_quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `get_quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quote_id` bigint unsigned DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(8,2) DEFAULT NULL,
  `invoice_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `service_charge` decimal(8,2) DEFAULT NULL,
  `tax` decimal(8,2) DEFAULT NULL,
  `shipping` decimal(8,2) DEFAULT NULL,
  `invoice_date` datetime NOT NULL,
  `due_date` datetime DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `terms_conditions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `attach` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `invoice_type` int DEFAULT NULL,
  `estimate_flag` tinyint(1) NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_quote_id_foreign` (`quote_id`),
  CONSTRAINT `invoices_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `get_quotes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `direction` tinyint(1) NOT NULL DEFAULT '1',
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (2,'English','en',NULL,1,0,1,'2021-11-07 14:26:20','2025-06-24 17:09:50'),(3,'Bahasa','id',NULL,1,1,1,'2025-06-24 16:46:26','2025-06-24 17:09:50');
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `live_chats`
--

DROP TABLE IF EXISTS `live_chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `live_chats` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `whatsapp_no` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `whatsapp_greeting` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `whatsapp_color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_position` tinyint(1) NOT NULL DEFAULT '1',
  `whatsapp_status` tinyint(1) NOT NULL DEFAULT '1',
  `facebook_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_greeting_in` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook_greeting_out` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `facebook_color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_position` tinyint(1) NOT NULL DEFAULT '1',
  `facebook_status` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `live_chats`
--

LOCK TABLES `live_chats` WRITE;
/*!40000 ALTER TABLE `live_chats` DISABLE KEYS */;
INSERT INTO `live_chats` VALUES (3,'+628111353979','Hubungi kami lewat WhatsApp!','Halo, ada yang bisa kami bantu?','#ff9c00',1,1,'0000000','Halo, ada yang bisa kami bantu?','Halo, ada yang bisa kami bantu?','#ff9c00',1,1,1,'2021-11-07 14:26:20','2025-06-24 17:18:43');
/*!40000 ALTER TABLE `live_chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ltm_translations`
--

DROP TABLE IF EXISTS `ltm_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ltm_translations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` int NOT NULL DEFAULT '0',
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `group` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=444 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ltm_translations`
--

LOCK TABLES `ltm_translations` WRITE;
/*!40000 ALTER TABLE `ltm_translations` DISABLE KEYS */;
INSERT INTO `ltm_translations` VALUES (1,0,'en','auth','login_title','Login Into Admin Panel.','2022-08-21 11:13:08','2025-06-24 17:05:53'),(2,0,'en','auth','register_title','Create Your Account.','2022-08-21 11:13:08','2025-06-24 17:05:53'),(3,0,'en','auth','verify_title','Please Check Your Email to Verify Yourself.','2022-08-21 11:13:08','2025-06-24 17:05:53'),(4,0,'en','auth','email_title','Enter Your Account Email Address.','2022-08-21 11:13:08','2025-06-24 17:05:53'),(5,0,'en','auth','reset_title','Enter Your New Password.','2022-08-21 11:13:08','2025-06-24 17:05:53'),(6,0,'en','auth','login','Login','2022-08-21 11:13:08','2025-06-24 17:05:53'),(7,0,'en','auth','register','Register','2022-08-21 11:13:08','2025-06-24 17:05:53'),(8,0,'en','auth','verify','Verify','2022-08-21 11:13:08','2025-06-24 17:05:53'),(9,0,'en','auth','reset','Reset Password','2022-08-21 11:13:08','2025-06-24 17:05:53'),(10,0,'en','auth','name','Name','2022-08-21 11:13:08','2025-06-24 17:05:53'),(11,0,'en','auth','email','E-Mail Address','2022-08-21 11:13:08','2025-06-24 17:05:53'),(12,0,'en','auth','password','Password','2022-08-21 11:13:08','2025-06-24 17:05:53'),(13,0,'en','auth','confirm_password','Confirm Password','2022-08-21 11:13:08','2025-06-24 17:05:53'),(14,0,'en','auth','remember','Remember Me','2022-08-21 11:13:08','2025-06-24 17:05:53'),(15,0,'en','auth','forgot_password','Forgot Your Password?','2022-08-21 11:13:08','2025-06-24 17:05:53'),(16,0,'en','auth','dont_have_account','Don\'t Have An Account?','2022-08-21 11:13:08','2025-06-24 17:05:53'),(17,0,'en','auth','verify_your_email','Verify Your Email Address','2022-08-21 11:13:08','2025-06-24 17:05:53'),(18,0,'en','auth','verify_email_sent','A fresh verification link has been sent to your email address.','2022-08-21 11:13:08','2025-06-24 17:05:53'),(19,0,'en','auth','check_your_email','Before proceeding, please check your email for a verification link.','2022-08-21 11:13:08','2025-06-24 17:05:53'),(20,0,'en','auth','not_receive_email','If you did not receive the email','2022-08-21 11:13:08','2025-06-24 17:05:53'),(21,0,'en','auth','send_another_request','click here to request another','2022-08-21 11:13:08','2025-06-24 17:05:53'),(22,0,'en','auth','send_reset_link','Send Password Reset Link','2022-08-21 11:13:08','2025-06-24 17:05:53'),(23,0,'en','auth','failed','These credentials do not match our records.','2022-08-21 11:13:08','2025-06-24 17:05:53'),(24,0,'en','auth','throttle','Too many login attempts. Please try again in :seconds seconds.','2022-08-21 11:13:08','2025-06-24 17:05:53'),(25,0,'en','common','read_more','Read More','2022-08-21 11:13:08','2025-06-24 17:05:53'),(26,0,'en','common','view_more','View More','2022-08-21 11:13:08','2025-06-24 17:05:53'),(27,0,'en','common','get_start','Get Start','2022-08-21 11:13:08','2025-06-24 17:05:53'),(28,0,'en','common','contact_us','Contact Us','2022-08-21 11:13:08','2025-06-24 17:05:53'),(29,0,'en','common','go_home','Go Home','2022-08-21 11:13:08','2025-06-24 17:05:53'),(30,0,'en','common','category','Category','2022-08-21 11:13:08','2025-06-24 17:05:53'),(31,0,'en','common','categories','Categories','2022-08-21 11:13:08','2025-06-24 17:05:53'),(32,0,'en','common','all','All','2022-08-21 11:13:08','2025-06-24 17:05:53'),(33,0,'en','common','currency','$','2022-08-21 11:13:08','2025-06-24 17:05:53'),(34,0,'en','common','footer_links','Useful Links','2022-08-21 11:13:08','2025-06-24 17:05:53'),(35,0,'en','common','recent_posts','Recent Posts','2022-08-21 11:13:08','2025-06-24 17:05:53'),(36,0,'en','contact','email','Email','2022-08-21 11:13:08','2025-06-24 17:05:53'),(37,0,'en','contact','phone','Call Us','2022-08-21 11:13:08','2025-06-24 17:05:53'),(38,0,'en','contact','office_time','Office Time','2022-08-21 11:13:08','2025-06-24 17:05:53'),(39,0,'en','contact','address','Address','2022-08-21 11:13:08','2025-06-24 17:05:53'),(40,0,'en','contact','your_name','Your Name *','2022-08-21 11:13:08','2025-06-24 17:05:53'),(41,0,'en','contact','phone_no','Phone No','2022-08-21 11:13:08','2025-06-24 17:05:53'),(42,0,'en','contact','email_address','Email Address *','2022-08-21 11:13:08','2025-06-24 17:05:53'),(43,0,'en','contact','subject','Subject *','2022-08-21 11:13:08','2025-06-24 17:05:53'),(44,0,'en','contact','your_massage','Your Massage *','2022-08-21 11:13:08','2025-06-24 17:05:53'),(45,0,'en','contact','send','Send','2022-08-21 11:13:08','2025-06-24 17:05:53'),(46,0,'en','dashboard','welcome','Welcome !','2022-08-21 11:13:08','2025-06-24 17:05:53'),(47,0,'en','dashboard','hello','Hello','2022-08-21 11:13:08','2025-06-24 17:05:53'),(48,0,'en','dashboard','home','Home','2022-08-21 11:13:08','2025-06-24 17:05:53'),(49,0,'en','dashboard','admin','Admin','2022-08-21 11:13:08','2025-06-24 17:05:53'),(50,0,'en','dashboard','navigation','Navigation','2022-08-21 11:13:08','2025-06-24 17:05:53'),(51,0,'en','dashboard','logout','Logout','2022-08-21 11:13:08','2025-06-24 17:05:53'),(52,0,'en','dashboard','list','List','2022-08-21 11:13:08','2025-06-24 17:05:53'),(53,0,'en','dashboard','select','Select','2022-08-21 11:13:08','2025-06-24 17:05:53'),(54,0,'en','dashboard','please_provide','Please Provide','2022-08-21 11:13:08','2025-06-24 17:05:53'),(55,0,'en','dashboard','setup','Setup','2022-08-21 11:13:08','2025-06-24 17:05:53'),(56,0,'en','dashboard','save','Save','2022-08-21 11:13:08','2025-06-24 17:05:53'),(57,0,'en','dashboard','send','Send','2022-08-21 11:13:08','2025-06-24 17:05:53'),(58,0,'en','dashboard','update','Update','2022-08-21 11:13:08','2025-06-24 17:05:53'),(59,0,'en','dashboard','change','Change','2022-08-21 11:13:08','2025-06-24 17:05:53'),(60,0,'en','dashboard','confirm','Confirm','2022-08-21 11:13:08','2025-06-24 17:05:53'),(61,0,'en','dashboard','close','Close','2022-08-21 11:13:08','2025-06-24 17:05:53'),(62,0,'en','dashboard','cancel','Cancel','2022-08-21 11:13:08','2025-06-24 17:05:53'),(63,0,'en','dashboard','create','Create','2022-08-21 11:13:08','2025-06-24 17:05:53'),(64,0,'en','dashboard','add_new','Add New','2022-08-21 11:13:08','2025-06-24 17:05:53'),(65,0,'en','dashboard','delete','Delete','2022-08-21 11:13:08','2025-06-24 17:05:53'),(66,0,'en','dashboard','remove','Remove','2022-08-21 11:13:08','2025-06-24 17:05:53'),(67,0,'en','dashboard','refresh','Refresh','2022-08-21 11:13:08','2025-06-24 17:05:53'),(68,0,'en','dashboard','back','Back','2022-08-21 11:13:08','2025-06-24 17:05:53'),(69,0,'en','dashboard','approve','Approve','2022-08-21 11:13:08','2025-06-24 17:05:53'),(70,0,'en','dashboard','estimate','Estimate','2022-08-21 11:13:08','2025-06-24 17:05:53'),(71,0,'en','dashboard','reject','Reject','2022-08-21 11:13:08','2025-06-24 17:05:53'),(72,0,'en','dashboard','download','Download','2022-08-21 11:13:08','2025-06-24 17:05:53'),(73,0,'en','dashboard','print','Print','2022-08-21 11:13:08','2025-06-24 17:05:53'),(74,0,'en','dashboard','attach','Attach','2022-08-21 11:13:08','2025-06-24 17:05:53'),(75,0,'en','dashboard','quote','Quote|Quotes','2022-08-21 11:13:08','2025-06-24 17:05:53'),(76,0,'en','dashboard','create_invoice','Create Invoice','2022-08-21 11:13:08','2025-06-24 17:05:53'),(77,0,'en','dashboard','add','Add','2022-08-21 11:13:08','2025-06-24 17:05:53'),(78,0,'en','dashboard','edit','Edit','2022-08-21 11:13:08','2025-06-24 17:05:53'),(79,0,'en','dashboard','view','View','2022-08-21 11:13:08','2025-06-24 17:05:53'),(80,0,'en','dashboard','are_you_sure','Are You Sure?','2022-08-21 11:13:08','2025-06-24 17:05:53'),(81,0,'en','dashboard','delete_warning','You will not be able to recover this!','2022-08-21 11:13:08','2025-06-24 17:05:53'),(82,0,'en','dashboard','success','Success','2022-08-21 11:13:08','2025-06-24 17:05:53'),(83,0,'en','dashboard','error','Error','2022-08-21 11:13:08','2025-06-24 17:05:53'),(84,0,'en','dashboard','created_successfully','Created Successfully!','2022-08-21 11:13:08','2025-06-24 17:05:53'),(85,0,'en','dashboard','updated_successfully','Updated Successfully!','2022-08-21 11:13:08','2025-06-24 17:05:53'),(86,0,'en','dashboard','deleted_successfully','Deleted Successfully!','2022-08-21 11:13:08','2025-06-24 17:05:53'),(87,0,'en','dashboard','sent_successfully','Sent Successfully!','2022-08-21 11:13:08','2025-06-24 17:05:53'),(88,0,'en','dashboard','task_updated','Task Updated','2022-08-21 11:13:08','2025-06-24 17:05:53'),(89,0,'en','dashboard','password_invalid','Current password is invalid!','2022-08-21 11:13:08','2025-06-24 17:05:53'),(90,0,'en','dashboard','email_invalid','You are entered same email address!','2022-08-21 11:13:08','2025-06-24 17:05:53'),(91,0,'en','dashboard','dashboard','Dashboard','2022-08-21 11:13:08','2025-06-24 17:05:53'),(92,0,'en','dashboard','invoice','Invoice','2022-08-21 11:13:08','2025-06-24 17:05:53'),(93,0,'en','dashboard','blog','Blog|Blogs','2022-08-21 11:13:08','2025-06-24 17:05:53'),(94,0,'en','dashboard','blog_list','Blog List|Blog List','2022-08-21 11:13:08','2025-06-24 17:05:53'),(95,0,'en','dashboard','blog_category','Blog Category|Blog Categories','2022-08-21 11:13:08','2025-06-24 17:05:53'),(96,0,'en','dashboard','portfolio','Portfolio|Portfolios','2022-08-21 11:13:08','2025-06-24 17:05:53'),(97,0,'en','dashboard','portfolio_list','Portfolio List|Portfolio List','2022-08-21 11:13:08','2025-06-24 17:05:53'),(98,0,'en','dashboard','portfolio_category','Portfolio Category|Portfolio Categories','2022-08-21 11:13:08','2025-06-24 17:05:53'),(99,0,'en','dashboard','service','Service|Services','2022-08-21 11:13:08','2025-06-24 17:05:53'),(100,0,'en','dashboard','pricing','Pricing|Pricings','2022-08-21 11:13:08','2025-06-24 17:05:53'),(101,0,'en','dashboard','team','Our Team','2022-08-21 11:13:08','2025-06-24 17:05:53'),(102,0,'en','dashboard','member','Member|Member List','2022-08-21 11:13:08','2025-06-24 17:05:53'),(103,0,'en','dashboard','designation','Designation','2022-08-21 11:13:08','2025-06-24 17:05:53'),(104,0,'en','dashboard','faq','FAQ|FAQs','2022-08-21 11:13:08','2025-06-24 17:05:53'),(105,0,'en','dashboard','faq_list','FAQ List|FAQ List','2022-08-21 11:13:08','2025-06-24 17:05:53'),(106,0,'en','dashboard','faq_category','FAQ Category|FAQ Categories','2022-08-21 11:13:08','2025-06-24 17:05:53'),(107,0,'en','dashboard','slider','Slider|Sliders','2022-08-21 11:13:08','2025-06-24 17:05:53'),(108,0,'en','dashboard','partner','Partner|Partners','2022-08-21 11:13:08','2025-06-24 17:05:53'),(109,0,'en','dashboard','testimonial','Testimonial|Testimonials','2022-08-21 11:13:08','2025-06-24 17:05:53'),(110,0,'en','dashboard','work_process','Work Process|Work Processes','2022-08-21 11:13:08','2025-06-24 17:05:53'),(111,0,'en','dashboard','feature','Why Choose Us|Why Choose Us','2022-08-21 11:13:08','2025-06-24 17:05:53'),(112,0,'en','dashboard','counter','Counter|Counters','2022-08-21 11:13:08','2025-06-24 17:05:53'),(113,0,'en','dashboard','email','Email','2022-08-21 11:13:08','2025-06-24 17:05:53'),(114,0,'en','dashboard','subscriber','Subscriber|Subscribers','2022-08-21 11:13:08','2025-06-24 17:05:53'),(115,0,'en','dashboard','about','About Us','2022-08-21 11:13:08','2025-06-24 17:05:53'),(116,0,'en','dashboard','page','Page|Pages','2022-08-21 11:13:08','2025-06-24 17:05:53'),(117,0,'en','dashboard','page_setup','Page Setup|Pages Setup','2022-08-21 11:13:08','2025-06-24 17:05:53'),(118,0,'en','dashboard','footer_page','Footer Page|Footer Pages','2022-08-21 11:13:08','2025-06-24 17:05:53'),(119,0,'en','dashboard','section','Section|Sections','2022-08-21 11:13:08','2025-06-24 17:05:53'),(120,0,'en','dashboard','template','Email Template','2022-08-21 11:13:08','2025-06-24 17:05:53'),(121,0,'en','dashboard','live_chat','LiveChat|LiveChats','2022-08-21 11:13:08','2025-06-24 17:05:53'),(122,0,'en','dashboard','language','Language|Languages','2022-08-21 11:13:08','2025-06-24 17:05:53'),(123,0,'en','dashboard','translation','Translation|Translations','2022-08-21 11:13:08','2025-06-24 17:05:53'),(124,0,'en','dashboard','setting','Setting|Settings','2022-08-21 11:13:08','2025-06-24 17:05:53'),(125,0,'en','dashboard','general_setting','General Setting|General Settings','2022-08-21 11:13:08','2025-06-24 17:05:53'),(126,0,'en','dashboard','no','No','2022-08-21 11:13:08','2025-06-24 17:05:53'),(127,0,'en','dashboard','sl','SL','2022-08-21 11:13:08','2025-06-24 17:05:53'),(128,0,'en','dashboard','title','Title','2022-08-21 11:13:08','2025-06-24 17:05:53'),(129,0,'en','dashboard','category','Category','2022-08-21 11:13:08','2025-06-24 17:05:53'),(130,0,'en','dashboard','short_desc','Short Details','2022-08-21 11:13:08','2025-06-24 17:05:53'),(131,0,'en','dashboard','description','Description','2022-08-21 11:13:08','2025-06-24 17:05:53'),(132,0,'en','dashboard','thumbnail','Thumbnail','2022-08-21 11:13:08','2025-06-24 17:05:53'),(133,0,'en','dashboard','youtube_video','Youtube Video','2022-08-21 11:13:08','2025-06-24 17:05:53'),(134,0,'en','dashboard','youtube_video_id','Youtube Video ID','2022-08-21 11:13:08','2025-06-24 17:05:53'),(135,0,'en','dashboard','icon','Icon','2022-08-21 11:13:08','2025-06-24 17:05:53'),(136,0,'en','dashboard','value','Value','2022-08-21 11:13:08','2025-06-24 17:05:53'),(137,0,'en','dashboard','status','Status','2022-08-21 11:13:08','2025-06-24 17:05:53'),(138,0,'en','dashboard','action','Action','2022-08-21 11:13:08','2025-06-24 17:05:53'),(139,0,'en','dashboard','logo','Logo','2022-08-21 11:13:08','2025-06-24 17:05:53'),(140,0,'en','dashboard','photo','Photo','2022-08-21 11:13:08','2025-06-24 17:05:53'),(141,0,'en','dashboard','name','Name','2022-08-21 11:13:08','2025-06-24 17:05:53'),(142,0,'en','dashboard','phone','Phone','2022-08-21 11:13:08','2025-06-24 17:05:53'),(143,0,'en','dashboard','subject','Subject','2022-08-21 11:13:08','2025-06-24 17:05:53'),(144,0,'en','dashboard','message','Message','2022-08-21 11:13:08','2025-06-24 17:05:53'),(145,0,'en','dashboard','department','Department','2022-08-21 11:13:08','2025-06-24 17:05:53'),(146,0,'en','dashboard','organization','Organization','2022-08-21 11:13:08','2025-06-24 17:05:53'),(147,0,'en','dashboard','price','Price','2022-08-21 11:13:08','2025-06-24 17:05:53'),(148,0,'en','dashboard','old_price','Old Price','2022-08-21 11:13:08','2025-06-24 17:05:53'),(149,0,'en','dashboard','duration','Duration','2022-08-21 11:13:08','2025-06-24 17:05:53'),(150,0,'en','dashboard','features','Features','2022-08-21 11:13:08','2025-06-24 17:05:53'),(151,0,'en','dashboard','feature_name','Feature Name','2022-08-21 11:13:08','2025-06-24 17:05:53'),(152,0,'en','dashboard','add_feature','Add Feature','2022-08-21 11:13:08','2025-06-24 17:05:53'),(153,0,'en','dashboard','web_link','Web Link','2022-08-21 11:13:08','2025-06-24 17:05:53'),(154,0,'en','dashboard','whatsapp','WhatsApp No','2022-08-21 11:13:08','2025-06-24 17:05:53'),(155,0,'en','dashboard','shortcode','Shortcode','2022-08-21 11:13:08','2025-06-24 17:05:53'),(156,0,'en','dashboard','locale','Locale','2022-08-21 11:13:08','2025-06-24 17:05:53'),(157,0,'en','dashboard','date','Date','2022-08-21 11:13:08','2025-06-24 17:05:53'),(158,0,'en','dashboard','mission_title','Mission Title','2022-08-21 11:13:08','2025-06-24 17:05:53'),(159,0,'en','dashboard','mission_description','Mission Description','2022-08-21 11:13:08','2025-06-24 17:05:53'),(160,0,'en','dashboard','vision_title','Vision Title','2022-08-21 11:13:08','2025-06-24 17:05:53'),(161,0,'en','dashboard','vision_description','Vision Description','2022-08-21 11:13:08','2025-06-24 17:05:53'),(162,0,'en','dashboard','quote_no','Quote No.','2022-08-21 11:13:08','2025-06-24 17:05:53'),(163,0,'en','dashboard','quote_placed','Quote Placed','2022-08-21 11:13:08','2025-06-24 17:05:53'),(164,0,'en','dashboard','invoice_no','Invoice No','2022-08-21 11:13:08','2025-06-24 17:05:53'),(165,0,'en','dashboard','invoice_date','Invoice Date','2022-08-21 11:13:08','2025-06-24 17:05:53'),(166,0,'en','dashboard','invoice_type','Invoice Type','2022-08-21 11:13:08','2025-06-24 17:05:53'),(167,0,'en','dashboard','total_blogs','Total Blogs','2022-08-21 11:13:08','2025-06-24 17:05:53'),(168,0,'en','dashboard','total_portfolios','Total Portfolios','2022-08-21 11:13:08','2025-06-24 17:05:53'),(169,0,'en','dashboard','total_services','Total Services','2022-08-21 11:13:08','2025-06-24 17:05:53'),(170,0,'en','dashboard','total_faqs','Total FAQs','2022-08-21 11:13:08','2025-06-24 17:05:53'),(171,0,'en','dashboard','total_members','Total Members','2022-08-21 11:13:08','2025-06-24 17:05:53'),(172,0,'en','dashboard','total_partners','Total Partners','2022-08-21 11:13:08','2025-06-24 17:05:53'),(173,0,'en','dashboard','total_emails','Total Emails','2022-08-21 11:13:08','2025-06-24 17:05:53'),(174,0,'en','dashboard','total_subscribers','Total Subscribers','2022-08-21 11:13:08','2025-06-24 17:05:53'),(175,0,'en','dashboard','site_info','Site Info','2022-08-21 11:13:08','2025-06-24 17:05:53'),(176,0,'en','dashboard','contact_info','Contact Info','2022-08-21 11:13:08','2025-06-24 17:05:53'),(177,0,'en','dashboard','social_info','Social Info','2022-08-21 11:13:08','2025-06-24 17:05:53'),(178,0,'en','dashboard','customization','Customization','2022-08-21 11:13:08','2025-06-24 17:05:53'),(179,0,'en','dashboard','account','Account','2022-08-21 11:13:08','2025-06-24 17:05:53'),(180,0,'en','dashboard','admin_mail_address','Change Mail Address','2022-08-21 11:13:08','2025-06-24 17:05:53'),(181,0,'en','dashboard','admin_change_password','Change Password','2022-08-21 11:13:08','2025-06-24 17:05:53'),(182,0,'en','dashboard','site_title','Site Title','2022-08-21 11:13:08','2025-06-24 17:05:53'),(183,0,'en','dashboard','meta_title','Meta Title','2022-08-21 11:13:08','2025-06-24 17:05:53'),(184,0,'en','dashboard','meta_description','Meta Description','2022-08-21 11:13:08','2025-06-24 17:05:53'),(185,0,'en','dashboard','meta_desc_length','Max length 160 characters','2022-08-21 11:13:08','2025-06-24 17:05:53'),(186,0,'en','dashboard','meta_keywords','Meta Keywords','2022-08-21 11:13:08','2025-06-24 17:05:53'),(187,0,'en','dashboard','keywords_separate','Separate Every Keyword by Using (,) Symbol','2022-08-21 11:13:08','2025-06-24 17:05:53'),(188,0,'en','dashboard','site_logo','Site Logo','2022-08-21 11:13:08','2025-06-24 17:05:53'),(189,0,'en','dashboard','site_favicon','Site Favicon','2022-08-21 11:13:08','2025-06-24 17:05:53'),(190,0,'en','dashboard','footer_text','Footer Text','2022-08-21 11:13:08','2025-06-24 17:05:53'),(191,0,'en','dashboard','phone_no_1','Phone No 1','2022-08-21 11:13:08','2025-06-24 17:05:53'),(192,0,'en','dashboard','phone_no_2','Phone No 2','2022-08-21 11:13:08','2025-06-24 17:05:53'),(193,0,'en','dashboard','email_address_1','Email Address 1','2022-08-21 11:13:08','2025-06-24 17:05:53'),(194,0,'en','dashboard','email_address_2','Email Address 2','2022-08-21 11:13:08','2025-06-24 17:05:53'),(195,0,'en','dashboard','contact_address','Contact Address','2022-08-21 11:13:08','2025-06-24 17:05:53'),(196,0,'en','dashboard','contact_mail','Contact Mail','2022-08-21 11:13:08','2025-06-24 17:05:53'),(197,0,'en','dashboard','office_hours','Office Hours','2022-08-21 11:13:08','2025-06-24 17:05:53'),(198,0,'en','dashboard','open_close_times','Open-Close Times','2022-08-21 11:13:08','2025-06-24 17:05:53'),(199,0,'en','dashboard','google_map','Google Map','2022-08-21 11:13:08','2025-06-24 17:05:53'),(200,0,'en','dashboard','embed_code','Embed Code','2022-08-21 11:13:08','2025-06-24 17:05:53'),(201,0,'en','dashboard','custom_css','Custom CSS','2022-08-21 11:13:08','2025-06-24 17:05:53'),(202,0,'en','dashboard','mail_address','Mail Address','2022-08-21 11:13:08','2025-06-24 17:05:53'),(203,0,'en','dashboard','old_password','Old Password','2022-08-21 11:13:08','2025-06-24 17:05:53'),(204,0,'en','dashboard','new_password','New Password','2022-08-21 11:13:08','2025-06-24 17:05:53'),(205,0,'en','dashboard','confirm_password','Confirm Password','2022-08-21 11:13:08','2025-06-24 17:05:53'),(206,0,'en','dashboard','website','Website URL','2022-08-21 11:13:08','2025-06-24 17:05:53'),(207,0,'en','dashboard','facebook','Facebook URL','2022-08-21 11:13:08','2025-06-24 17:05:53'),(208,0,'en','dashboard','twitter','Twitter URL','2022-08-21 11:13:08','2025-06-24 17:05:53'),(209,0,'en','dashboard','linkedin','Linkedin URL','2022-08-21 11:13:08','2025-06-24 17:05:53'),(210,0,'en','dashboard','instagram','Instagram URL','2022-08-21 11:13:08','2025-06-24 17:05:53'),(211,0,'en','dashboard','pinterest','Pinterest URL','2022-08-21 11:13:08','2025-06-24 17:05:53'),(212,0,'en','dashboard','youtube','Youtube URL','2022-08-21 11:13:08','2025-06-24 17:05:53'),(213,0,'en','dashboard','skype','Skype ID','2022-08-21 11:13:08','2025-06-24 17:05:53'),(214,0,'en','dashboard','inc_country_code','inc. country code','2022-08-21 11:13:08','2025-06-24 17:05:53'),(215,0,'en','dashboard','whatsapp_live_chat','WhatsApp Live Chat','2022-08-21 11:13:08','2025-06-24 17:05:53'),(216,0,'en','dashboard','whatsapp_header_title','Header Title','2022-08-21 11:13:08','2025-06-24 17:05:53'),(217,0,'en','dashboard','whatsapp_greeting_message','Greeting Message','2022-08-21 11:13:08','2025-06-24 17:05:53'),(218,0,'en','dashboard','messenger_live_chat','Messenger Live Chat','2022-08-21 11:13:08','2025-06-24 17:05:53'),(219,0,'en','dashboard','facebook_page_id','Facebook Page ID','2022-08-21 11:13:08','2025-06-24 17:05:53'),(220,0,'en','dashboard','facebook_login_greeting','Login Greeting','2022-08-21 11:13:08','2025-06-24 17:05:53'),(221,0,'en','dashboard','facebook_logout_greeting','Logout Greeting','2022-08-21 11:13:08','2025-06-24 17:05:53'),(222,0,'en','dashboard','select_status','Select Status','2022-08-21 11:13:08','2025-06-24 17:05:53'),(223,0,'en','dashboard','active','Active','2022-08-21 11:13:08','2025-06-24 17:05:53'),(224,0,'en','dashboard','inactive','Inactive','2022-08-21 11:13:08','2025-06-24 17:05:53'),(225,0,'en','dashboard','display','Display','2022-08-21 11:13:08','2025-06-24 17:05:53'),(226,0,'en','dashboard','pending','Pending','2022-08-21 11:13:08','2025-06-24 17:05:53'),(227,0,'en','dashboard','paid','Paid','2022-08-21 11:13:08','2025-06-24 17:05:53'),(228,0,'en','dashboard','canceled','Canceled','2022-08-21 11:13:08','2025-06-24 17:05:53'),(229,0,'en','dashboard','estimated','Estimated','2022-08-21 11:13:08','2025-06-24 17:05:53'),(230,0,'en','dashboard','approved','Approved','2022-08-21 11:13:09','2025-06-24 17:05:53'),(231,0,'en','dashboard','rejected','Rejected','2022-08-21 11:13:09','2025-06-24 17:05:53'),(232,0,'en','dashboard','default','Default','2022-08-21 11:13:09','2025-06-24 17:05:53'),(233,0,'en','dashboard','make_default','Make Default','2022-08-21 11:13:09','2025-06-24 17:05:53'),(234,0,'en','dashboard','image_size','Best Resolution Height- :height PX, Width- :width PX','2022-08-21 11:13:09','2025-06-24 17:05:53'),(235,0,'en','dashboard','prefer_cells','Prefer to use :cells cells','2022-08-21 11:13:09','2025-06-24 17:05:53'),(236,0,'en','dashboard','sidebar','Action','2022-08-21 11:13:09','2025-06-24 17:05:53'),(237,0,'en','dashboard','advance','Advance','2022-08-21 11:13:09','2025-06-24 17:05:53'),(238,0,'en','dashboard','interval','Interval','2022-08-21 11:13:09','2025-06-24 17:05:53'),(239,0,'en','dashboard','milestone','Milestone','2022-08-21 11:13:09','2025-06-24 17:05:53'),(240,0,'en','dashboard','final','Final','2022-08-21 11:13:09','2025-06-24 17:05:53'),(241,0,'en','dashboard','full','Full','2022-08-21 11:13:09','2025-06-24 17:05:53'),(242,0,'en','dashboard','due_date','Due Date','2022-08-21 11:13:09','2025-06-24 17:05:53'),(243,0,'en','dashboard','invoice_status','Invoice Status','2022-08-21 11:13:09','2025-06-24 17:05:53'),(244,0,'en','dashboard','billing_address','Billing Address','2022-08-21 11:13:09','2025-06-24 17:05:53'),(245,0,'en','dashboard','company','Company','2022-08-21 11:13:09','2025-06-24 17:05:53'),(246,0,'en','dashboard','address','Address','2022-08-21 11:13:09','2025-06-24 17:05:53'),(247,0,'en','dashboard','city','City','2022-08-21 11:13:09','2025-06-24 17:05:53'),(248,0,'en','dashboard','quote_files','Customer Files','2022-08-21 11:13:09','2025-06-24 17:05:53'),(249,0,'en','dashboard','reference','Reference','2022-08-21 11:13:09','2025-06-24 17:05:53'),(250,0,'en','dashboard','services','Services','2022-08-21 11:13:09','2025-06-24 17:05:53'),(251,0,'en','dashboard','note','Note','2022-08-21 11:13:09','2025-06-24 17:05:53'),(252,0,'en','dashboard','service_bill','Service Bill','2022-08-21 11:13:09','2025-06-24 17:05:53'),(253,0,'en','dashboard','tax_charge','Tax Charge','2022-08-21 11:13:09','2025-06-24 17:05:53'),(254,0,'en','dashboard','shipping_charge','Shipping Charge','2022-08-21 11:13:09','2025-06-24 17:05:53'),(255,0,'en','dashboard','total','Total','2022-08-21 11:13:09','2025-06-24 17:05:53'),(256,0,'en','dashboard','discount','Discount','2022-08-21 11:13:09','2025-06-24 17:05:53'),(257,0,'en','dashboard','payable','Payable','2022-08-21 11:13:09','2025-06-24 17:05:53'),(258,0,'en','dashboard','total_amount','Total Amount','2022-08-21 11:13:09','2025-06-24 17:05:53'),(259,0,'en','dashboard','discount_amount','Discount Amount','2022-08-21 11:13:09','2025-06-24 17:05:53'),(260,0,'en','dashboard','invoice_amount','Invoice Amount','2022-08-21 11:13:09','2025-06-24 17:05:53'),(261,0,'en','dashboard','send_mail','Send Mail','2022-08-21 11:13:09','2025-06-24 17:05:53'),(262,0,'en','dashboard','prefer_contact','Prefer contact?','2022-08-21 11:13:09','2025-06-24 17:05:53'),(263,0,'en','dashboard','no_value','No value','2022-08-21 11:13:09','2025-06-24 17:05:53'),(264,0,'en','dashboard','template-quote-placed','Quote Placed','2022-08-21 11:13:09','2025-06-24 17:05:53'),(265,0,'en','dashboard','template-quote-estimated','Quote Estimated','2022-08-21 11:13:09','2025-06-24 17:05:53'),(266,0,'en','dashboard','template-quote-approved','Quote Approved','2022-08-21 11:13:09','2025-06-24 17:05:53'),(267,0,'en','dashboard','template-quote-rejected','Quote Rejected','2022-08-21 11:13:09','2025-06-24 17:05:53'),(268,0,'en','dashboard','template-invoice-send','Invoice Send','2022-08-21 11:13:09','2025-06-24 17:05:53'),(269,0,'en','dashboard','template-invoice-paid','Invoice Paid','2022-08-21 11:13:09','2025-06-24 17:05:53'),(270,0,'en','dashboard','template-invoice-cancelled','Invoice Cancelled','2022-08-21 11:13:09','2025-06-24 17:05:53'),(271,0,'en','dashboard','template-subscription','Subscription','2022-08-21 11:13:09','2025-06-24 17:05:53'),(272,0,'en','email','pay_btn','Pay By Paypal','2022-08-21 11:13:09','2025-06-24 17:05:53'),(273,0,'en','email','attach_btn','Download Attachments','2022-08-21 11:13:09','2025-06-24 17:05:53'),(274,0,'en','email','hello','Hello','2022-08-21 11:13:09','2025-06-24 17:05:53'),(275,0,'en','email','name','Name','2022-08-21 11:13:09','2025-06-24 17:05:53'),(276,0,'en','email','email','Email','2022-08-21 11:13:09','2025-06-24 17:05:53'),(277,0,'en','email','phone','Phone','2022-08-21 11:13:09','2025-06-24 17:05:53'),(278,0,'en','email','company','Company','2022-08-21 11:13:09','2025-06-24 17:05:53'),(279,0,'en','email','address','Address','2022-08-21 11:13:09','2025-06-24 17:05:53'),(280,0,'en','email','city','City','2022-08-21 11:13:09','2025-06-24 17:05:53'),(281,0,'en','email','reference','Reference','2022-08-21 11:13:09','2025-06-24 17:05:53'),(282,0,'en','email','bill','Total Bill','2022-08-21 11:13:09','2025-06-24 17:05:53'),(283,0,'en','email','service_charge','Service Bill','2022-08-21 11:13:09','2025-06-24 17:05:53'),(284,0,'en','email','tax','Tax Charge','2022-08-21 11:13:09','2025-06-24 17:05:53'),(285,0,'en','email','shipping','Shipping Charge','2022-08-21 11:13:09','2025-06-24 17:05:53'),(286,0,'en','email','total_amount','Total Amount','2022-08-21 11:13:09','2025-06-24 17:05:53'),(287,0,'en','email','discount_amount','Discount Amount','2022-08-21 11:13:09','2025-06-24 17:05:53'),(288,0,'en','email','payable_amount','Payable Amount','2022-08-21 11:13:09','2025-06-24 17:05:53'),(289,0,'en','email','quote_id','Quote ID','2022-08-21 11:13:09','2025-06-24 17:05:53'),(290,0,'en','email','invoice_id','Invoice ID','2022-08-21 11:13:09','2025-06-24 17:05:53'),(291,0,'en','email','service_bill','Service Bill','2022-08-21 11:13:09','2025-06-24 17:05:53'),(292,0,'en','email','invoice','Invoice','2022-08-21 11:13:09','2025-06-24 17:05:53'),(293,0,'en','email','invoice_date','Invoice Date','2022-08-21 11:13:09','2025-06-24 17:05:53'),(294,0,'en','email','due_date','Due Date','2022-08-21 11:13:09','2025-06-24 17:05:53'),(295,0,'en','email','quote','Quote','2022-08-21 11:13:09','2025-06-24 17:05:53'),(296,0,'en','email','services','Services','2022-08-21 11:13:09','2025-06-24 17:05:53'),(297,0,'en','email','invoice_type','Invoice Type','2022-08-21 11:13:09','2025-06-24 17:05:53'),(298,0,'en','email','estimate','Estimate','2022-08-21 11:13:09','2025-06-24 17:05:53'),(299,0,'en','email','advance','Advance','2022-08-21 11:13:09','2025-06-24 17:05:53'),(300,0,'en','email','interval','Interval','2022-08-21 11:13:09','2025-06-24 17:05:53'),(301,0,'en','email','milestone','Milestone','2022-08-21 11:13:09','2025-06-24 17:05:53'),(302,0,'en','email','final','Final','2022-08-21 11:13:09','2025-06-24 17:05:53'),(303,0,'en','email','full','Full','2022-08-21 11:13:09','2025-06-24 17:05:53'),(304,0,'en','email','thanks','Thanks','2022-08-21 11:13:09','2025-06-24 17:05:53'),(305,0,'en','email','send_successfully','Mail Send Successfully!','2022-08-21 11:13:09','2025-06-24 17:05:53'),(306,0,'en','email','receiver_not_found','Receiver Not Configured!','2022-08-21 11:13:09','2025-06-24 17:05:53'),(307,0,'en','email','quote_submitted','Quote Request Submitted','2022-08-21 11:13:09','2025-06-24 17:05:53'),(308,0,'en','email','new_quote_request','You Have New Quote Request!','2022-08-21 11:13:09','2025-06-24 17:05:53'),(309,0,'en','email','payment_cancelled','Your payment request has cancelled!','2022-08-21 11:13:09','2025-06-24 17:05:53'),(310,0,'en','email','got_new_payment','You got a new payment!','2022-08-21 11:13:09','2025-06-24 17:05:53'),(311,0,'en','email','something_is_wrong','Something is wrong.','2022-08-21 11:13:09','2025-06-24 17:05:53'),(312,0,'en','email','payment_successfull','You have successfully make the payment.','2022-08-21 11:13:09','2025-06-24 17:05:53'),(313,0,'en','email','login_dashboard_to_check','Please login your application dashboard to see the more details. Thank you.','2022-08-21 11:13:09','2025-06-24 17:05:53'),(314,0,'en','form','your_name','Your Name *','2022-08-21 11:13:09','2025-06-24 17:05:53'),(315,0,'en','form','phone_no','Phone No *','2022-08-21 11:13:09','2025-06-24 17:05:53'),(316,0,'en','form','email_address','Email Address *','2022-08-21 11:13:09','2025-06-24 17:05:53'),(317,0,'en','form','address','Address *','2022-08-21 11:13:09','2025-06-24 17:05:53'),(318,0,'en','form','city','City *','2022-08-21 11:13:09','2025-06-24 17:05:53'),(319,0,'en','form','company','Company (Optional)','2022-08-21 11:13:09','2025-06-24 17:05:53'),(320,0,'en','form','prefer_contact','What do you prefer for contact? *','2022-08-21 11:13:09','2025-06-24 17:05:53'),(321,0,'en','form','phone','Phone','2022-08-21 11:13:09','2025-06-24 17:05:53'),(322,0,'en','form','email','Email','2022-08-21 11:13:09','2025-06-24 17:05:53'),(323,0,'en','form','services','Services (You can choose multiple)','2022-08-21 11:13:09','2025-06-24 17:05:53'),(324,0,'en','form','your_massage','Write Your Quotation Detail Here... *','2022-08-21 11:13:09','2025-06-24 17:05:53'),(325,0,'en','form','upload_file','Upload File (Optional)','2022-08-21 11:13:09','2025-06-24 17:05:53'),(326,0,'en','form','submit','Submit Now','2022-08-21 11:13:09','2025-06-24 17:05:53'),(327,0,'en','navbar','home','Home','2022-08-21 11:13:09','2025-06-24 17:05:53'),(328,0,'en','navbar','about','About Us','2022-08-21 11:13:09','2025-06-24 17:05:53'),(329,0,'en','navbar','services','Services','2022-08-21 11:13:09','2025-06-24 17:05:53'),(330,0,'en','navbar','service-detail','Service Detail','2022-08-21 11:13:09','2025-06-24 17:05:53'),(331,0,'en','navbar','portfolios','Portfolios','2022-08-21 11:13:09','2025-06-24 17:05:53'),(332,0,'en','navbar','portfolio-detail','Portfolio Detail','2022-08-21 11:13:09','2025-06-24 17:05:53'),(333,0,'en','navbar','pricing','Pricing','2022-08-21 11:13:09','2025-06-24 17:05:53'),(334,0,'en','navbar','blog','Blog','2022-08-21 11:13:09','2025-06-24 17:05:53'),(335,0,'en','navbar','blog-detail','Blog Detail','2022-08-21 11:13:09','2025-06-24 17:05:53'),(336,0,'en','navbar','faqs','FAQs','2022-08-21 11:13:09','2025-06-24 17:05:53'),(337,0,'en','navbar','contact','Contact Us','2022-08-21 11:13:09','2025-06-24 17:05:53'),(338,0,'en','navbar','get_quote','Get A Quote','2022-08-21 11:13:09','2025-06-24 17:05:53'),(339,0,'en','navbar','error','Error 404','2022-08-21 11:13:09','2025-06-24 17:05:53'),(340,0,'en','navbar','payment_feedback','Payment Feedback','2022-08-21 11:13:09','2025-06-24 17:05:53'),(341,0,'en','pagination','previous','&laquo; Previous','2022-08-21 11:13:09','2025-06-24 17:05:53'),(342,0,'en','pagination','next','Next &raquo;','2022-08-21 11:13:09','2025-06-24 17:05:53'),(343,0,'en','passwords','password','Passwords must be at least eight characters and match the confirmation.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(344,0,'en','passwords','reset','Your password has been reset!','2022-08-21 11:13:09','2025-06-24 17:05:54'),(345,0,'en','passwords','sent','We have e-mailed your password reset link!','2022-08-21 11:13:09','2025-06-24 17:05:54'),(346,0,'en','passwords','token','This password reset token is invalid.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(347,0,'en','passwords','user','We can\'t find a user with that e-mail address.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(348,0,'en','search','search_field','Search.....','2022-08-21 11:13:09','2025-06-24 17:05:54'),(349,0,'en','search','no_result','No Result Found!','2022-08-21 11:13:09','2025-06-24 17:05:54'),(350,0,'en','validation','accepted','The :attribute must be accepted.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(351,0,'en','validation','active_url','The :attribute is not a valid URL.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(352,0,'en','validation','after','The :attribute must be a date after :date.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(353,0,'en','validation','after_or_equal','The :attribute must be a date after or equal to :date.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(354,0,'en','validation','alpha','The :attribute may only contain letters.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(355,0,'en','validation','alpha_dash','The :attribute may only contain letters, numbers, dashes and underscores.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(356,0,'en','validation','alpha_num','The :attribute may only contain letters and numbers.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(357,0,'en','validation','array','The :attribute must be an array.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(358,0,'en','validation','before','The :attribute must be a date before :date.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(359,0,'en','validation','before_or_equal','The :attribute must be a date before or equal to :date.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(360,0,'en','validation','between.numeric','The :attribute must be between :min and :max.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(361,0,'en','validation','between.file','The :attribute must be between :min and :max kilobytes.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(362,0,'en','validation','between.string','The :attribute must be between :min and :max characters.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(363,0,'en','validation','between.array','The :attribute must have between :min and :max items.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(364,0,'en','validation','boolean','The :attribute field must be true or false.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(365,0,'en','validation','confirmed','The :attribute confirmation does not match.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(366,0,'en','validation','date','The :attribute is not a valid date.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(367,0,'en','validation','date_equals','The :attribute must be a date equal to :date.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(368,0,'en','validation','date_format','The :attribute does not match the format :format.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(369,0,'en','validation','different','The :attribute and :other must be different.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(370,0,'en','validation','digits','The :attribute must be :digits digits.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(371,0,'en','validation','digits_between','The :attribute must be between :min and :max digits.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(372,0,'en','validation','dimensions','The :attribute has invalid image dimensions.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(373,0,'en','validation','distinct','The :attribute field has a duplicate value.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(374,0,'en','validation','email','The :attribute must be a valid email address.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(375,0,'en','validation','ends_with','The :attribute must end with one of the following: :values','2022-08-21 11:13:09','2025-06-24 17:05:54'),(376,0,'en','validation','exists','The selected :attribute is invalid.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(377,0,'en','validation','file','The :attribute must be a file.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(378,0,'en','validation','filled','The :attribute field must have a value.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(379,0,'en','validation','gt.numeric','The :attribute must be greater than :value.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(380,0,'en','validation','gt.file','The :attribute must be greater than :value kilobytes.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(381,0,'en','validation','gt.string','The :attribute must be greater than :value characters.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(382,0,'en','validation','gt.array','The :attribute must have more than :value items.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(383,0,'en','validation','gte.numeric','The :attribute must be greater than or equal :value.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(384,0,'en','validation','gte.file','The :attribute must be greater than or equal :value kilobytes.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(385,0,'en','validation','gte.string','The :attribute must be greater than or equal :value characters.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(386,0,'en','validation','gte.array','The :attribute must have :value items or more.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(387,0,'en','validation','image','The :attribute must be an image.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(388,0,'en','validation','in','The selected :attribute is invalid.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(389,0,'en','validation','in_array','The :attribute field does not exist in :other.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(390,0,'en','validation','integer','The :attribute must be an integer.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(391,0,'en','validation','ip','The :attribute must be a valid IP address.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(392,0,'en','validation','ipv4','The :attribute must be a valid IPv4 address.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(393,0,'en','validation','ipv6','The :attribute must be a valid IPv6 address.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(394,0,'en','validation','json','The :attribute must be a valid JSON string.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(395,0,'en','validation','lt.numeric','The :attribute must be less than :value.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(396,0,'en','validation','lt.file','The :attribute must be less than :value kilobytes.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(397,0,'en','validation','lt.string','The :attribute must be less than :value characters.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(398,0,'en','validation','lt.array','The :attribute must have less than :value items.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(399,0,'en','validation','lte.numeric','The :attribute must be less than or equal :value.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(400,0,'en','validation','lte.file','The :attribute must be less than or equal :value kilobytes.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(401,0,'en','validation','lte.string','The :attribute must be less than or equal :value characters.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(402,0,'en','validation','lte.array','The :attribute must not have more than :value items.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(403,0,'en','validation','max.numeric','The :attribute may not be greater than :max.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(404,0,'en','validation','max.file','The :attribute may not be greater than :max kilobytes.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(405,0,'en','validation','max.string','The :attribute may not be greater than :max characters.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(406,0,'en','validation','max.array','The :attribute may not have more than :max items.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(407,0,'en','validation','mimes','The :attribute must be a file of type: :values.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(408,0,'en','validation','mimetypes','The :attribute must be a file of type: :values.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(409,0,'en','validation','min.numeric','The :attribute must be at least :min.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(410,0,'en','validation','min.file','The :attribute must be at least :min kilobytes.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(411,0,'en','validation','min.string','The :attribute must be at least :min characters.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(412,0,'en','validation','min.array','The :attribute must have at least :min items.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(413,0,'en','validation','not_in','The selected :attribute is invalid.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(414,0,'en','validation','not_regex','The :attribute format is invalid.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(415,0,'en','validation','numeric','The :attribute must be a number.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(416,0,'en','validation','present','The :attribute field must be present.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(417,0,'en','validation','regex','The :attribute format is invalid.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(418,0,'en','validation','required','The :attribute field is required.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(419,0,'en','validation','required_if','The :attribute field is required when :other is :value.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(420,0,'en','validation','required_unless','The :attribute field is required unless :other is in :values.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(421,0,'en','validation','required_with','The :attribute field is required when :values is present.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(422,0,'en','validation','required_with_all','The :attribute field is required when :values are present.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(423,0,'en','validation','required_without','The :attribute field is required when :values is not present.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(424,0,'en','validation','required_without_all','The :attribute field is required when none of :values are present.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(425,0,'en','validation','same','The :attribute and :other must match.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(426,0,'en','validation','size.numeric','The :attribute must be :size.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(427,0,'en','validation','size.file','The :attribute must be :size kilobytes.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(428,0,'en','validation','size.string','The :attribute must be :size characters.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(429,0,'en','validation','size.array','The :attribute must contain :size items.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(430,0,'en','validation','starts_with','The :attribute must start with one of the following: :values','2022-08-21 11:13:09','2025-06-24 17:05:54'),(431,0,'en','validation','string','The :attribute must be a string.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(432,0,'en','validation','timezone','The :attribute must be a valid zone.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(433,0,'en','validation','unique','The :attribute has already been taken.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(434,0,'en','validation','uploaded','The :attribute failed to upload.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(435,0,'en','validation','url','The :attribute format is invalid.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(436,0,'en','validation','uuid','The :attribute must be a valid UUID.','2022-08-21 11:13:09','2025-06-24 17:05:54'),(437,0,'en','validation','custom.attribute-name.rule-name','custom-message','2022-08-21 11:13:09','2025-06-24 17:05:54'),(438,0,'id','dashboard','about','Tentang Kami','2025-06-24 16:47:35','2025-06-24 17:05:53'),(439,0,'id','dashboard','account','Akun','2025-06-24 16:47:40','2025-06-24 17:05:53'),(440,0,'id','dashboard','action','Aksi','2025-06-24 16:47:46','2025-06-24 17:05:53'),(441,0,'id','dashboard','active','Aktif','2025-06-24 16:47:49','2025-06-24 17:05:53'),(442,0,'id','dashboard','add','Tambah','2025-06-24 16:47:52','2025-06-24 17:05:53'),(443,0,'id','dashboard','add_feature','Tambah Fitur','2025-06-24 16:48:03','2025-06-24 17:05:53');
/*!40000 ALTER TABLE `ltm_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `designation_id` int unsigned NOT NULL,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_title_unique` (`title`),
  UNIQUE KEY `members_slug_unique` (`slug`),
  KEY `members_designation_id_foreign` (`designation_id`),
  CONSTRAINT `members_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (7,4,'Faza','faza',NULL,'dummy-profile-pic_1750807734.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,'2025-06-24 16:28:54','2025-06-24 16:28:54');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_06_21_034842_create_article_categories_table',1),(4,'2019_06_21_174850_create_articles_table',1),(5,'2019_06_23_085924_create_faq_categories_table',1),(6,'2019_06_23_090734_create_faqs_table',1),(7,'2019_06_23_125726_create_settings_table',1),(8,'2020_10_19_181445_create_portfolio_categories_table',1),(9,'2020_10_20_054101_create_portfolios_table',1),(10,'2020_10_20_064637_create_portfolio_category_table',1),(11,'2020_10_20_065345_create_designations_table',1),(12,'2020_10_20_160810_create_members_table',1),(13,'2020_10_20_190635_create_clients_table',1),(14,'2020_10_21_065124_create_testimonials_table',1),(15,'2020_10_21_073444_create_sliders_table',1),(16,'2020_10_21_081243_create_services_table',1),(17,'2020_10_21_160828_create_work_processes_table',1),(18,'2020_10_22_155439_create_why_choose_us_table',1),(19,'2020_10_22_163117_create_counters_table',1),(20,'2020_10_22_171933_create_contacts_table',1),(21,'2020_10_22_175247_create_subscribers_table',1),(22,'2020_10_22_182912_create_socials_table',1),(23,'2020_10_23_132746_create_pages_table',1),(24,'2020_10_23_140659_create_pricings_table',1),(25,'2020_10_23_172412_create_sections_table',1),(26,'2020_10_27_181842_create_abouts_table',1),(27,'2020_11_10_174625_create_live_chats_table',2),(28,'2020_11_14_081146_create_email_templates_table',3),(29,'2020_11_12_171920_create_get_quotes_table',4),(30,'2020_11_12_181128_create_serviceables_table',4),(31,'2020_11_14_183701_create_invoices_table',5),(32,'2019_03_21_160417_create_languages_table',6),(33,'2021_10_20_191833_create_page_setups_table',6),(34,'2014_04_02_193005_create_translations_table',7),(35,'2019_12_14_000001_create_personal_access_tokens_table',7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_setups`
--

DROP TABLE IF EXISTS `page_setups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page_setups` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_setups_title_unique` (`title`),
  UNIQUE KEY `page_setups_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_setups`
--

LOCK TABLES `page_setups` WRITE;
/*!40000 ALTER TABLE `page_setups` DISABLE KEYS */;
INSERT INTO `page_setups` VALUES (10,'Beranda','home','Beranda',NULL,NULL,1,NULL,'2025-06-24 17:10:21'),(11,'Tentang Kami','about-us','Tentang Kami',NULL,NULL,1,NULL,'2025-06-24 17:10:29'),(12,'Layanan','services','Layanan',NULL,NULL,1,NULL,'2025-06-24 17:10:38'),(13,'Portfolio','portfolio','Portfolio',NULL,NULL,1,NULL,NULL),(14,'Pricing','pricing','Pricing',NULL,NULL,0,NULL,'2025-06-24 16:57:21'),(15,'Blog','blog','Blog',NULL,NULL,1,NULL,NULL),(16,'FAQs','faqs','FAQs',NULL,NULL,1,NULL,NULL),(17,'Kontak Kami','contact-us','Kontak Kami',NULL,NULL,1,NULL,'2025-06-24 17:10:52'),(18,'Ajukan Penawaran','get-quote','Ajukan Penawaran',NULL,NULL,1,NULL,'2025-06-24 17:12:32');
/*!40000 ALTER TABLE `page_setups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_title_unique` (`title`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Kebijakan Privasi','kebijakan-privasi','<p>? Kebijakan Privasi (Privacy Policy)<p>Terakhir diperbarui: Juni 2025</p><p><br></p><p>Asthabagja Sinergi Nusantara menghormati dan melindungi privasi setiap individu yang mengakses layanan kami, baik melalui situs web, sistem aplikasi, maupun media komunikasi lainnya. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi pribadi Anda.</p><p><br></p><p>? 1. Informasi yang Kami Kumpulkan</p><p>Kami dapat mengumpulkan informasi pribadi secara langsung maupun tidak langsung melalui:</p><p>Formulir kontak atau pendaftaran di situs kami</p><p>Akses ke sistem IT atau layanan digital kami</p><p>Korespondensi email atau komunikasi lainnya</p><p>Cookies dan data penggunaan website</p><p>Informasi tersebut dapat mencakup:</p><p>Nama, alamat email, nomor telepon</p><p>Informasi perusahaan/instansi</p><p>Data lokasi dan perangkat</p><p>Aktivitas penggunaan layanan kami</p><p><br></p><p>? 2. Penggunaan Informasi</p><p>Informasi pribadi Anda digunakan untuk:</p><p>Memberikan layanan yang diminta</p><p>Komunikasi terkait proyek, penawaran, atau dukungan teknis</p><p>Peningkatan pengalaman pengguna dan fitur layanan</p><p>Tujuan hukum dan kepatuhan regulasi</p><p>Pemasaran terbatas yang relevan (dengan persetujuan)</p><p><br></p><p>? 3. Perlindungan Data</p><p>Kami menerapkan tindakan pengamanan teknis dan organisasi guna melindungi informasi Anda dari akses tidak sah, kebocoran data, atau penyalahgunaan. Termasuk namun tidak terbatas pada:</p><p><br></p><p>Enkripsi data</p><p>Akses terbatas berbasis peran</p><p><span style=\"font-size: 0.875rem;\">Backup dan audit berkala</span></p><p><br></p><p>? 4. Penyimpanan Data</p><p>Data pribadi Anda akan disimpan selama diperlukan untuk tujuan yang disebutkan atau sesuai peraturan yang berlaku. Setelah itu, data akan dihapus atau dianonimkan secara aman.</p><p><br></p><p>? 5. Hak Anda Sebagai Pengguna</p><p>Anda berhak untuk:</p><p>Meminta akses, pembaruan, atau penghapusan data pribadi Anda</p><p>Menolak penggunaan data untuk tujuan pemasaran</p><p>Mengajukan keberatan atas pemrosesan data</p><p>Permintaan dapat dikirimkan ke:</p><p>? Email: privacy@asthabagja.com</p><p><br></p><p>? 6. Pembagian Data kepada Pihak Ketiga</p><p>Kami tidak menjual atau menyewakan data pribadi Anda kepada pihak ketiga. Namun, dalam beberapa kasus, kami dapat membagikan data kepada mitra layanan yang membantu pengoperasian sistem, dengan perjanjian kerahasiaan yang ketat.</p><p><br></p><p>? 7. Perubahan Kebijakan</p><p>Kebijakan ini dapat diperbarui sewaktu-waktu. Perubahan akan diinformasikan melalui situs web resmi kami. Kami menganjurkan Anda untuk membaca kebijakan ini secara berkala.</p><p></p></p>\n','noimage.jpg',1,'2020-10-30 12:47:49','2025-06-24 17:24:26'),(2,'Syarat & Ketentuan','syarat-ketentuan','<p>? Syarat dan Ketentuan (Terms &amp; Conditions)<p>Terakhir diperbarui: Juni 2025</p><p><br></p><p>Selamat datang di situs dan/atau sistem milik PT Asthabagja Sinergi Nusantara. Dengan mengakses atau menggunakan layanan kami, Anda menyetujui untuk terikat oleh syarat dan ketentuan berikut. Jika Anda tidak menyetujui sebagian atau seluruh ketentuan ini, mohon untuk tidak menggunakan layanan kami.</p><p><br></p><p>? 1. Definisi</p><p>?Perusahaan? merujuk pada PT Asthabagja Sinergi Nusantara.</p><p><br></p><p>?Pengguna? merujuk pada individu atau entitas yang mengakses atau menggunakan layanan kami.</p><p><br></p><p>?Layanan? mencakup semua layanan fisik dan digital yang disediakan perusahaan, termasuk namun tidak terbatas pada situs web, sistem informasi, dan proyek kerja sama.</p><p><br></p><p>? 2. Penggunaan Layanan</p><p>Pengguna setuju untuk menggunakan layanan hanya untuk tujuan yang sah dan tidak melanggar hukum, etika, atau hak pihak lain.</p><p><br></p><p>Pengguna dilarang melakukan aktivitas yang dapat merusak, mengganggu, atau membahayakan sistem perusahaan.</p><p><br></p><p>Untuk mengakses layanan tertentu, pengguna dapat diminta memberikan data pribadi sesuai Kebijakan Privasi.</p><p><br></p><p>? 3. Hak Kekayaan Intelektual</p><p>Seluruh konten, logo, desain, kode sistem, dan materi lain yang ditampilkan adalah milik sah PT Asthabagja Sinergi Nusantara dan dilindungi oleh hukum hak cipta dan merek dagang.</p><p><br></p><p>Pengguna tidak diperkenankan menyalin, menggandakan, atau menyebarluaskan konten tanpa izin tertulis dari perusahaan.</p><p><br></p><p>? 4. Pembatasan Tanggung Jawab</p><p>Perusahaan tidak bertanggung jawab atas kerugian langsung maupun tidak langsung yang timbul akibat penggunaan layanan, keterlambatan, atau gangguan sistem.</p><p><br></p><p>Layanan disediakan ?sebagaimana adanya? tanpa jaminan tertentu, kecuali dinyatakan secara tertulis dalam perjanjian kerja sama.</p><p><br></p><p>? 5. Perubahan Layanan &amp; Ketentuan</p><p>Perusahaan berhak untuk mengubah, memperbarui, atau menghentikan layanan kapan saja tanpa pemberitahuan sebelumnya.</p><p><br></p><p>Perubahan terhadap syarat &amp; ketentuan ini akan diberlakukan sejak ditayangkan di situs resmi perusahaan.</p><p><br></p><p>? 6. Hukum yang Berlaku</p><p>Syarat dan ketentuan ini tunduk pada hukum yang berlaku di Republik Indonesia.</p><p><br></p><p>Apabila terjadi sengketa, maka akan diselesaikan secara musyawarah atau melalui jalur hukum di wilayah hukum kantor pusat perusahaan.</p><p><br></p><p>? 7. Kontak Resmi</p><p>Untuk pertanyaan atau keperluan hukum terkait syarat dan ketentuan ini, silakan hubungi:</p><p><br></p><p>PT Asthabagja Sinergi Nusantara</p><p>Jl. Sukajadi No. 123, Bandung, Jawa Barat</p><p>? info@asna.co.id</p><p>? (+62) 22-1234-5678</p><p></p></p>\n','noimage.jpg',1,'2020-10-30 12:48:49','2025-06-24 17:24:40'),(3,'Penafian','penafian','<p>?? Disclaimer (Penafian)<p>Terakhir diperbarui: Juni 2025</p><p><br></p><p>Informasi yang disediakan oleh PT Asthabagja Sinergi Nusantara pada situs web ini dan/atau platform digital lainnya bertujuan untuk memberikan informasi umum mengenai layanan kami di bidang konstruksi, interior, pengembangan IT, dan distribusi alat kesehatan.</p><p><br></p><p>? 1. Ketepatan Informasi</p><p>Kami berusaha sebaik mungkin untuk memastikan bahwa seluruh informasi yang disampaikan akurat dan terkini. Namun, tidak ada jaminan dalam bentuk apa pun mengenai keakuratan, kelengkapan, atau relevansi informasi yang disediakan. Setiap keputusan atau tindakan berdasarkan informasi dari situs ini sepenuhnya menjadi tanggung jawab pengguna.</p><p><br></p><p>? 2. Informasi Tidak Mengikat Secara Hukum</p><p>Semua konten di situs ini, termasuk teks, gambar, harga, studi kasus, maupun spesifikasi teknis, tidak dapat dianggap sebagai perjanjian resmi, penawaran kontrak, atau jaminan hukum, kecuali diatur dalam perjanjian tertulis yang ditandatangani oleh kedua belah pihak.</p><p><br></p><p>? 3. Tautan ke Situs Eksternal</p><p>Situs kami dapat menyertakan tautan ke situs pihak ketiga yang berada di luar kendali kami. Kami tidak bertanggung jawab atas isi, keamanan, atau kebijakan privasi situs-situs tersebut.</p><p><br></p><p>? 4. Risiko Penggunaan</p><p>Penggunaan situs dan layanan kami dilakukan atas risiko pengguna sendiri. Kami tidak bertanggung jawab atas kehilangan data, gangguan sistem, atau kerugian akibat penggunaan informasi yang kami tampilkan.</p><p><br></p><p>? 5. Perubahan Tanpa Pemberitahuan</p><p>Konten di situs ini dapat diperbarui, diubah, atau dihapus sewaktu-waktu tanpa pemberitahuan terlebih dahulu, termasuk penyesuaian terhadap layanan, fitur, atau kebijakan.</p><p><br></p><p>? 6. Hak Kekayaan Intelektual</p><p>Seluruh konten, logo, dan materi visual di situs ini dilindungi oleh undang-undang hak cipta dan milik PT Asthabagja Sinergi Nusantara. Penggunaan tanpa izin tertulis akan dianggap sebagai pelanggaran hukum.</p><p><br></p><p>? 7. Hubungi Kami</p><p>Untuk klarifikasi lebih lanjut atau pertanyaan mengenai informasi di situs kami, silakan hubungi:</p><p><br></p><p>PT Asthabagja Sinergi Nusantara</p><p>Jl. Sukajadi No. 123, Bandung, Jawa Barat</p><p>? info@asna.co.id</p><p>? (+62) 22-1234-5678</p><p></p></p>\n','noimage.jpg',1,'2020-10-30 12:49:28','2025-06-24 17:24:57');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_categories`
--

DROP TABLE IF EXISTS `portfolio_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolio_categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolio_categories_title_unique` (`title`),
  UNIQUE KEY `portfolio_categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_categories`
--

LOCK TABLES `portfolio_categories` WRITE;
/*!40000 ALTER TABLE `portfolio_categories` DISABLE KEYS */;
INSERT INTO `portfolio_categories` VALUES (1,'Development','development',NULL,1,'2020-10-30 11:23:29','2020-10-30 11:23:29'),(2,'Consulting','consulting',NULL,1,'2020-10-30 11:23:42','2020-10-30 11:23:42'),(3,'Finance','finance',NULL,1,'2020-10-30 11:24:00','2020-10-30 11:24:00'),(4,'Branding','branding',NULL,1,'2020-10-30 11:24:15','2020-10-30 11:24:15'),(5,'Konstruksi','konstruksi',NULL,1,'2025-06-24 16:20:37','2025-06-24 16:20:37'),(6,'Interior','interior',NULL,1,'2025-06-24 16:20:48','2025-06-24 16:20:48'),(7,'Sistem Informasi','sistem-informasi',NULL,1,'2025-06-24 16:21:07','2025-06-24 16:21:07'),(8,'IT Developer','it-developer',NULL,1,'2025-06-24 16:22:13','2025-06-24 16:22:13'),(9,'Distribusi Alat Kesehatan','distribusi-alat-kesehatan',NULL,1,'2025-06-24 16:22:41','2025-06-24 16:22:41');
/*!40000 ALTER TABLE `portfolio_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_category`
--

DROP TABLE IF EXISTS `portfolio_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolio_category` (
  `portfolio_id` int unsigned NOT NULL,
  `portfolio_category_id` int unsigned NOT NULL,
  KEY `portfolio_category_portfolio_id_foreign` (`portfolio_id`),
  KEY `portfolio_category_portfolio_category_id_foreign` (`portfolio_category_id`),
  CONSTRAINT `portfolio_category_portfolio_category_id_foreign` FOREIGN KEY (`portfolio_category_id`) REFERENCES `portfolio_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `portfolio_category_portfolio_id_foreign` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_category`
--

LOCK TABLES `portfolio_category` WRITE;
/*!40000 ALTER TABLE `portfolio_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `portfolio_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolios`
--

DROP TABLE IF EXISTS `portfolios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `portfolios` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `portfolios_title_unique` (`title`),
  UNIQUE KEY `portfolios_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolios`
--

LOCK TABLES `portfolios` WRITE;
/*!40000 ALTER TABLE `portfolios` DISABLE KEYS */;
/*!40000 ALTER TABLE `portfolios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricings`
--

DROP TABLE IF EXISTS `pricings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pricings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_price` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pricings_title_unique` (`title`),
  UNIQUE KEY `pricings_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricings`
--

LOCK TABLES `pricings` WRITE;
/*!40000 ALTER TABLE `pricings` DISABLE KEYS */;
INSERT INTO `pricings` VALUES (1,'Basic','basic','12',NULL,'Year','[\"Demo file\",\"Update\",\"File compressed\",\"Commercial use\",\"Support\",\"2 database\",\"Documetation\"]',1,'2020-10-30 11:48:52','2020-10-30 11:48:52'),(2,'Regular','regular','29',NULL,'Year','[\"Demo file\",\"Update\",\"File compressed\",\"Commercial use\",\"Support\",\"5 database\",\"Documetation\"]',1,'2020-10-30 11:50:12','2020-10-30 11:50:12'),(3,'Extended','extended','59',NULL,'Year','[\"Demo file\",\"Update\",\"File compressed\",\"Commercial use\",\"Support\",\"8 database\",\"Documetation\"]',1,'2020-10-30 11:51:24','2020-10-30 11:51:24');
/*!40000 ALTER TABLE `pricings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sections_title_unique` (`title`),
  UNIQUE KEY `sections_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (31,'Blog Terbaru','blog','<p>Temukan artikel, berita, dan insight terbaru dari kami. Dapatkan informasi menarik seputar industri dan layanan yang kami tawarkan.</p>',NULL,1,NULL,'2025-06-24 17:20:28'),(32,'Portofolio Kami','portfolio','<p>Lihat hasil karya dan proyek terbaik yang telah kami selesaikan. Portofolio ini mencerminkan komitmen kami terhadap kualitas dan kepuasan klien.</p>',NULL,1,NULL,'2025-06-24 17:20:44'),(33,'Layanan Kami','services','<p>Jelajahi berbagai layanan yang kami tawarkan untuk mendukung kebutuhan Anda. Kami berkomitmen memberikan solusi terbaik dengan profesionalisme dan kualitas unggulan.</p>',NULL,1,NULL,'2025-06-24 17:21:04'),(34,'Harga Kami','pricing','<p>Temukan paket harga terbaik yang sesuai dengan kebutuhan Anda. Kami menyediakan solusi fleksibel dengan biaya yang transparan dan kompetitif.</p><p><br></p><p><br></p>',NULL,1,NULL,'2025-06-24 17:21:21'),(35,'Kenali Tim Kami','team','<p>Kami adalah tim profesional yang berdedikasi untuk memberikan layanan terbaik. Kenali orang-orang di balik kesuksesan proyek dan kepuasan pelanggan kami.</p>',NULL,1,NULL,'2025-06-24 17:21:37'),(36,'Pertanyaan & Jawaban','faqs','<p>Temukan jawaban atas pertanyaan umum seputar layanan dan produk kami. Jika Anda tidak menemukan yang Anda cari, jangan ragu untuk menghubungi kami.</p>',NULL,1,NULL,'2025-06-24 17:21:55'),(37,'Mitra Kami','clients','<p>Kami bangga bekerja sama dengan berbagai mitra strategis yang mendukung kesuksesan dan pertumbuhan bisnis kami. Bersama mereka, kami memberikan nilai lebih bagi pelanggan.</p>',NULL,1,NULL,'2025-06-24 17:22:11'),(38,'Ulasan Klien Kami','testimonials','<p>Lihat apa yang dikatakan klien kami tentang layanan dan pengalaman mereka bersama kami. Kepuasan pelanggan adalah prioritas utama kami.</p>',NULL,1,NULL,'2025-06-24 17:22:27'),(39,'Bagaimana Kami Menyukseskan Pekerjaan','process','<p>Kami mengikuti pendekatan strategis dan kolaboratif dalam setiap proyek. Dengan tim yang profesional, proses yang terstruktur, dan komitmen pada kualitas, kami memastikan setiap pekerjaan mencapai hasil terbaik.</p>',NULL,1,NULL,'2025-06-24 17:22:45'),(40,'Mengapa Memilih Kami','why-us','Kami menawarkan layanan terbaik dengan komitmen tinggi terhadap kualitas, ketepatan waktu, dan kepuasan pelanggan. Keahlian kami terbukti melalui pengalaman dan hasil nyata.',NULL,1,NULL,'2025-06-24 17:23:04'),(41,'Newsletter - Get Updates & Latest News','subscribe','<p>Get in your inbox the latest News and Offers from<br></p>',NULL,1,NULL,'2021-11-08 12:38:47'),(42,'Get in Touch','contact',NULL,NULL,1,NULL,'2021-11-08 12:39:04'),(43,'Let\'s Talk About Your Idea','mail',NULL,NULL,1,NULL,'2021-11-08 12:39:20'),(44,'Get A Quote','get-quote','<p>Get a quote in just 30 minutes<br></p>',NULL,1,NULL,'2021-11-08 12:39:55'),(45,'Page Not Found','error','The page you are Looking for was Moved, Removed, Renamed or Might Never Existed',NULL,1,NULL,NULL),(46,'Payment Feedback','payment','',NULL,1,NULL,NULL);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serviceables`
--

DROP TABLE IF EXISTS `serviceables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `serviceables` (
  `service_id` bigint unsigned NOT NULL,
  `serviceable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `serviceable_id` bigint unsigned NOT NULL,
  UNIQUE KEY `serviceables_service_id_serviceable_id_serviceable_type_unique` (`service_id`,`serviceable_id`,`serviceable_type`),
  KEY `serviceables_serviceable_type_serviceable_id_index` (`serviceable_type`,`serviceable_id`),
  CONSTRAINT `serviceables_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serviceables`
--

LOCK TABLES `serviceables` WRITE;
/*!40000 ALTER TABLE `serviceables` DISABLE KEYS */;
/*!40000 ALTER TABLE `serviceables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_title_unique` (`title`),
  UNIQUE KEY `services_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (7,'Layanan Konstruksi','layanan-konstruksi','<ul><li>Pembangunan Gedung Komersial dan Perkantoran</li><li>Pembangunan Fasilitas Umum &amp; Infrastruktur</li><li>Renovasi dan Rehabilitasi Bangunan</li><li>Manajemen Konstruksi dan Supervisi Proyek</li><li>Pengurusan Izin &amp; Konsultasi Teknis</li></ul>','<p>Pembangunan Gedung Komersial dan Perkantoran<p>Pembangunan Fasilitas Umum &amp; Infrastruktur</p><p>Renovasi dan Rehabilitasi Bangunan</p><p>Manajemen Konstruksi dan Supervisi Proyek</p><p>Pengurusan Izin &amp; Konsultasi Teknis</p></p>\n','konsultan-konstruksi_1750807875.webp',NULL,1,'2025-06-24 16:31:15','2025-06-24 16:31:15'),(8,'Layanan Interior','layanan-interior','<ul><li>Jasa Desain Interior 2D &amp; 3D</li><li>Fit-Out dan Penataan Ruang Komersial</li><li>Pembuatan &amp; Instalasi Custom Furniture</li><li>Konsultasi Konsep Desain (Kantor, Retail, Hunian)</li><li>Renovasi Interior &amp; Re-layout Ruang</li></ul>','<ul><li>Jasa Desain Interior 2D &amp; 3D</li><li>Fit-Out dan Penataan Ruang Komersial</li><li>Pembuatan &amp; Instalasi Custom Furniture</li><li>Konsultasi Konsep Desain (Kantor, Retail, Hunian)</li><li>Renovasi Interior &amp; Re-layout Ruang</li></ul>\n','Jasa-Interior-Kantor-Industrial-Bekasi-Jasa-Interior-Kantor-Industrial-Jakarta-Selatan-3_1750807932.jpg',NULL,1,'2025-06-24 16:32:12','2025-06-24 16:32:12'),(9,'Layanan IT Developer','layanan-it-developer','<ul><li>Pengembangan Aplikasi Mobile (Android/iOS)</li><li>Sistem Informasi Rumah Sakit (SIMRS)</li><li>Sistem ERP, CRM, dan HRIS</li><li>Pengembangan Website &amp; Portal Korporat</li><li>Integrasi API dan Otomasi Bisnis</li><li>Cloud Deployment &amp; Maintenance System</li></ul>','<ul><li>Pengembangan Aplikasi Mobile (Android/iOS)</li><li>Sistem Informasi Rumah Sakit (SIMRS)</li><li>Sistem ERP, CRM, dan HRIS</li><li>Pengembangan Website &amp; Portal Korporat</li><li>Integrasi API dan Otomasi Bisnis</li><li>Cloud Deployment &amp; Maintenance System</li></ul>\n','ico-web-developer_1750808009.png',NULL,1,'2025-06-24 16:33:29','2025-06-24 16:33:29'),(10,'Layanan Distribusi Alat Kesehatan','layanan-distribusi-alat-kesehatan','<ul><li>Pengadaan Alat Medis Diagnostik (USG, EKG, dll)</li><li>Supply Alat ICU, Ruang Operasi, dan Rawat Inap</li><li>Instalasi &amp; Kalibrasi Peralatan Medis</li><li>Pelatihan Penggunaan Alat (Training Teknis)</li><li>Layanan Purna Jual dan Maintenance Berkala</li></ul>','<ul><li>Pengadaan Alat Medis Diagnostik (USG, EKG, dll)</li><li>Supply Alat ICU, Ruang Operasi, dan Rawat Inap</li><li>Instalasi &amp; Kalibrasi Peralatan Medis</li><li>Pelatihan Penggunaan Alat (Training Teknis)</li><li>Layanan Purna Jual dan Maintenance Berkala</li></ul>\n','cover-mjb-2-1024x576_1750808061.png',NULL,1,'2025-06-24 16:34:21','2025-06-24 16:34:21'),(11,'Layanan Pendukung Lainnya','layanan-pendukung-lainnya','<ul><li>Konsultasi Proyek Multi-divisi (Integrated Services)</li><li>Penyusunan Proposal Teknis dan Tender Pemerintah</li><li>Sertifikasi Produk dan Registrasi Alat Kesehatan</li><li>Pengelolaan Dokumen &amp; Legalitas Proyek</li></ul>','<ul><li>Konsultasi Proyek Multi-divisi (Integrated Services)</li><li>Penyusunan Proposal Teknis dan Tender Pemerintah</li><li>Sertifikasi Produk dan Registrasi Alat Kesehatan</li><li>Pengelolaan Dokumen &amp; Legalitas Proyek</li></ul>\n','images_Safety-Officer.jpg_1750808173.webp',NULL,1,'2025-06-24 16:36:13','2025-06-24 16:36:13');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `keywords` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `logo_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_one` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_two` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_one` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_two` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `contact_mail` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_hours` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `google_map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `google_analytics` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `footer_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `custom_css` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (3,'Asthabagja Sinergi Nusantara','Asthabagja Sinergi Nusantara — Solusi profesional terintegrasi di bidang konstruksi, interior, IT developer, dan distribusi alat kesehatan terpercaya.','Asthabagja, konstruksi profesional, interior design, IT developer Indonesia, distribusi alat kesehatan, solusi terintegrasi, perusahaan konstruksi, software developer, sistem informasi rumah sakit, supplier alat medis, perusahaan teknologi, layanan interior kantor, pengadaan alat kesehatan, jasa konstruksi terpercaya, perusahaan multibidang Indonesia','logo_1636317292.png','favicon_1636317292.png','+628111353979','+628112199402','business@asthabagja.com',NULL,'Jl. Sukajadi No. 123, Pasteur, Bandung 40162','business@asthabagja.com','Senin to Jum\'at 8:00am - 5:00pm','<iframe width=\"600\" height=\"450\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"https://maps.google.com/maps?width=600&amp;height=450&amp;hl=en&amp;q=Jl.%20Sukajadi%20No.%20123,%20Pasteur,%20Bandung%2040162+(Asthabagja%20Sinergi%20Nusantara)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed\"><a href=\"https://www.mapsdirections.info/calcular-la-población-en-un-mapa\">Calcular Población en el Mapa</a></iframe>',NULL,'&copy; 2025 <strong>Asthabagja Sinergi Nusantara</strong>. All rights reserved.</p>',' /** theme customize css **/ ',1,'2021-11-07 14:26:20','2025-06-22 01:51:50');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sliders` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sliders_title_unique` (`title`),
  UNIQUE KEY `sliders_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliders`
--

LOCK TABLES `sliders` WRITE;
/*!40000 ALTER TABLE `sliders` DISABLE KEYS */;
INSERT INTO `sliders` VALUES (3,'Konstruksi','konstruksi','<p>Pembangunan gedung komersial, renovasi, infrastruktur, dan manajemen proyek konstruksi secara profesional.</p>','pjct5_1750808335.png','https://asthabagja.com',1,'2020-10-30 11:12:39','2025-06-24 16:38:55');
/*!40000 ALTER TABLE `sliders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socials`
--

DROP TABLE IF EXISTS `socials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `socials` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `facebook` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pinterest` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skype` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socials`
--

LOCK TABLES `socials` WRITE;
/*!40000 ALTER TABLE `socials` DISABLE KEYS */;
INSERT INTO `socials` VALUES (3,'https://www.facebook.com/Asthabagja/','https://twitter.com/asthabagja','https://www.linkedin.com/company/asthabagja/',NULL,NULL,NULL,'asthabagja','+628111353979',1,'2021-11-07 14:26:20','2025-06-22 01:52:31');
/*!40000 ALTER TABLE `socials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscribers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscribers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organization` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_path` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `testimonials_title_unique` (`title`),
  UNIQUE KEY `testimonials_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Super Admin','business@asthabagja.com',NULL,'$2y$10$i91qeN0EOuQeJzV/SskEqeP73qcSuNES14OyEF79WofsGBIFsYuUW','yvnjyADxmZLO9X0Svd32qQfbgNCQedINJfHJZMZ2AzYpJTcChoLuSTRKW9WU','2021-11-07 14:26:20','2025-06-22 01:52:43');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `why_choose_us`
--

DROP TABLE IF EXISTS `why_choose_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `why_choose_us` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `why_choose_us_title_unique` (`title`),
  UNIQUE KEY `why_choose_us_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `why_choose_us`
--

LOCK TABLES `why_choose_us` WRITE;
/*!40000 ALTER TABLE `why_choose_us` DISABLE KEYS */;
INSERT INTO `why_choose_us` VALUES (7,'Layanan Terpadu Multibidang','layanan-terpadu-multibidang','<p>Satu perusahaan untuk berbagai solusi: mulai dari pembangunan fisik, tata ruang interior, pengembangan sistem digital, hingga penyediaan alat kesehatan—semua kami tangani secara profesional dan menyeluruh.</p>',NULL,1,'2025-06-24 16:41:00','2025-06-24 16:41:00'),(8,'Tim Ahli dan Berpengalaman','tim-ahli-dan-berpengalaman','<p>Didukung oleh tim profesional lintas disiplin, kami memastikan setiap proyek dijalankan dengan presisi teknis, kreativitas desain, dan efisiensi operasional terbaik.</p>',NULL,1,'2025-06-24 16:41:10','2025-06-24 16:41:10'),(9,'Komitmen pada Kualitas & Standar','komitmen-pada-kualitas-standar','<p>Kami berpegang pada prinsip mutu, keselamatan kerja, dan kepatuhan regulasi. Baik proyek konstruksi maupun distribusi medis kami jalankan sesuai standar nasional dan internasional.</p>',NULL,1,'2025-06-24 16:41:20','2025-06-24 16:41:20'),(10,'Inovasi Teknologi Berbasis Solusi','inovasi-teknologi-berbasis-solusi','<p>Dalam dunia yang terus berubah, kami menggunakan pendekatan berbasis data dan teknologi untuk membantu klien menghemat waktu, biaya, dan sumber daya secara berkelanjutan.</p>',NULL,1,'2025-06-24 16:41:29','2025-06-24 16:41:29'),(11,'Layanan Purna Jual & Support','layanan-purna-jual-support','<p>Kami tidak hanya menyelesaikan proyek, tetapi juga memberikan dukungan teknis, pelatihan pengguna, dan perawatan sistem secara berkala untuk memastikan keberlangsungan operasional.</p>',NULL,1,'2025-06-24 16:41:39','2025-06-24 16:41:39'),(12,'Jangkauan Luas & Fleksibilitas Proyek','jangkauan-luas-fleksibilitas-proyek','<p>Kami melayani berbagai sektor—publik maupun swasta, dari proyek skala lokal hingga nasional—dengan fleksibilitas pendekatan sesuai kebutuhan klien.</p>',NULL,1,'2025-06-24 16:41:52','2025-06-24 16:41:52'),(13,'Integritas & Transparansi','integritas-transparansi','<p>Kami menjunjung tinggi etika kerja, transparansi anggaran, dan komunikasi terbuka dalam setiap tahap proyek. Kepercayaan klien adalah modal utama kami.</p>',NULL,1,'2025-06-24 16:42:04','2025-06-24 16:42:04');
/*!40000 ALTER TABLE `why_choose_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_processes`
--

DROP TABLE IF EXISTS `work_processes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_processes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `work_processes_title_unique` (`title`),
  UNIQUE KEY `work_processes_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_processes`
--

LOCK TABLES `work_processes` WRITE;
/*!40000 ALTER TABLE `work_processes` DISABLE KEYS */;
INSERT INTO `work_processes` VALUES (5,'Analisis Kebutuhan yang Mendalam','analisis-kebutuhan-yang-mendalam','<p>Kami memulai setiap proyek dengan pemahaman mendalam terhadap kebutuhan klien. Lewat observasi langsung, diskusi intensif, dan studi kelayakan, kami merancang solusi yang benar-benar relevan dan tepat sasaran.</p>',NULL,1,'2025-06-24 16:55:05','2025-06-24 16:55:05'),(6,'Perencanaan Strategis dan Terstruktur','perencanaan-strategis-dan-terstruktur','<p>Kami menyusun perencanaan terperinci, mulai dari timeline, resource, anggaran, hingga manajemen risiko. Setiap proyek memiliki milestone yang terukur dan transparan, dengan tools modern untuk memantau progresnya.</p>',NULL,1,'2025-06-24 16:55:19','2025-06-24 16:55:19'),(7,'Tim Multidisiplin yang Profesional','tim-multidisiplin-yang-profesional','<p>Proyek dijalankan oleh tim lintas bidang — arsitek, insinyur, desainer, developer, dan tenaga teknis — yang telah berpengalaman dalam menyelesaikan berbagai jenis tantangan dengan akurasi dan kreativitas tinggi.</p>',NULL,1,'2025-06-24 16:55:31','2025-06-24 16:55:31'),(8,'Kolaborasi Aktif dengan Klien','kolaborasi-aktif-dengan-klien','<p>Kami percaya bahwa keberhasilan proyek berasal dari kolaborasi erat. Klien dilibatkan secara aktif dalam proses revisi, validasi keputusan, dan penyesuaian yang diperlukan selama pelaksanaan.</p>',NULL,1,'2025-06-24 16:55:42','2025-06-24 16:55:42'),(9,'Penggunaan Teknologi dan Sistem Terkini','penggunaan-teknologi-dan-sistem-terkini','<p>Kami mengintegrasikan software manajemen proyek, sistem informasi, automasi, dan solusi digital lainnya untuk efisiensi dan transparansi. Ini memastikan pekerjaan berjalan lebih cepat, aman, dan minim error.</p>',NULL,1,'2025-06-24 16:55:52','2025-06-24 16:55:52'),(10,'Kualitas Eksekusi dan Pengawasan Ketat','kualitas-eksekusi-dan-pengawasan-ketat','<p>Kami mengedepankan pengawasan mutu (quality control) di setiap tahap pekerjaan. Proyek tidak hanya selesai, tetapi juga sesuai standar teknis, estetika, dan keamanan.</p>',NULL,1,'2025-06-24 16:56:03','2025-06-24 16:56:03'),(11,'Evaluasi & Perbaikan Berkelanjutan','evaluasi-perbaikan-berkelanjutan','<p>Setiap proyek ditutup dengan evaluasi menyeluruh. Masukan klien kami jadikan referensi untuk peningkatan kualitas di proyek-proyek berikutnya, membentuk siklus perbaikan berkelanjutan.</p>',NULL,1,'2025-06-24 16:56:12','2025-06-24 16:56:12');
/*!40000 ALTER TABLE `work_processes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-02 17:39:17
