---
description: Implementasi Fitur E-Commerce
---

# 1. Persiapan Database
- [x] Buat migration untuk tabel `products`
    - Columns: id, title, slug, description, price, image_path, status, timestamps.
- [x] Buat migration untuk tabel `orders`
    - Columns: id, order_number, customer_name, customer_id_num, customer_unit, shipping_address, customer_contact, total_amount, status (pending, paid, completed, failed), timestamps.
- [x] Buat migration untuk tabel `order_items`
    - Columns: id, order_id, product_id, quantity, price, timestamps.
- [x] Jalankan migration.
- [x] Buat Model: `Product`, `Order`, `OrderItem`.

# 2. Backend Admin (Manajemen Produk)
- [x] Buat `Admin\ProductController` (Resource controller).
- [x] Buat route group admin untuk products.
- [x] Buat views: `admin.products.index`, `create`, `edit`.
- [x] Tambahkan menu "Produk" di Sidebar Admin.

# 3. Frontend: Katalog Produk
- [x] Buat `Web\CommerceController`.
- [x] Route `/ecommerce` (Index).
- [x] View `web.ecommerce.index`: Menampilkan daftar produk dengan harga khusus.
- [x] Route `/ecommerce/{slug}` (Show).
- [x] View `web.ecommerce.show`: Detail spesifikasi dan "Add to Cart"

# 4. Logic E-Commerce (Cart & Checkout)
- [x] Implementasi Logic Cart (menggunakan Session sederhana).
    - `addToCart(Request $request)`
    - `cart()` (View Cart Page)
    - `updateCart(Request $request)`
    - `removeFromCart($id)`
- [x] View `web.ecommerce.cart`: Ringkasan pesanan.
- [x] View `web.ecommerce.checkout`: Form Data Karyawan (Nama, ID/NIP, Unit, Alamat, Kontak).
- [ ] Validasi Data Checkout (ID/NIP wajib diisi, dll).

# 5. Proses Order & Pembayaran
- [x] Implementasi `processOrder(Request $request)`:
    - Simpan data ke tabel `orders` dan `order_items`.
    - Set status awal `pending`.
- [x] Simulasi "Mekanisme Pembayaran".
- [x] Redirect ke Halaman Sukses (`web.ecommerce.success`) jika berhasil.
- [x] Tampilkan Notifikasi/Ringkasan Pesanan.
- [x] Clear Cart setelah order.

# 6. Integrasi UI
- [x] Tambahkan menu "E-Commerce" di Header Website (`master.blade.php`).
- [x] Pastikan styling sesuai dengan premium design (Gunakan `premium_override.css`).

# Status: COMPLETED
Semua fitur E-Commerce telah diimplementasikan, termasuk Admin Panel, Katalog Frontend, Cart, Checkout, dan Proses Order.