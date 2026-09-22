# Riwayat Perubahan & Pengembangan Web Dadar Beredar Sidoarjo

Dokumen ini mencatat seluruh riwayat pembaruan, penambahan fitur, perbaikan bug, dan pengujian pada sistem web aplikasi **Dadar Beredar Sidoarjo**.

---

## 📅 Tanggal Pembaruan: 22 September 2026

### 1. Smart Bridge Ojol Terintegrasi (ShopeeFood, GrabFood, GoFood)
- **Direct Merchant Linking**: Menghilangkan redirect pencarian umum (`search?keyword=`), kini langsung mengarah ke halaman merchant / toko resmi cabang Dadar Beredar Sidoarjo (Pusat Jl. Pahlawan & Waru Tropodo).
- **Deep Linking Mobile**: Mengimplementasikan URL scheme khusus untuk Android Intent dan iOS Universal Link agar aplikasi ojol langsung membuka restoran tanpa intervensi pengguna.
- **Auto-Redirect & QR Code**: Dilengkapi hitung mundur otomatis dan QR Code dinamis untuk kenyamanan pengguna desktop/laptop yang ingin memesan via ponsel.
- **Pencatatan Log & Statistik**: Database logging untuk melacak setiap klik platform, jenis perangkat (Android, iOS, Desktop), dan outlet tujuan.

### 2. Menu Baru & Paket Kombo Hemat
- **Minuman Segar Baru**:
  - Es Cendol Dawet (Rp 13.636)
  - Es Sweet Greentea (Rp 10.909)
  - Es Coklat (Rp 15.000)
  - Coklat Hangat (Rp 15.000)
  - Es Batu (Rp 2.727)
  - Es Strup Cincau (Rp 10.909)
- **Paket Pengedar (Diskon / Promo Hemat)**:
  - Paketan Pengedar 1 (Rp 33.636, harga coret Rp 37.727)
  - Pengedar 2 (Rp 61.818, harga coret Rp 75.909)
  - Pengedar 3 (Rp 248.182, harga coret Rp 272.271)
- **Asset Gambar Lengkap**: Seluruh foto menu minuman dan paket kombo telah ditambahkan di direktori `public/images/menu/` dan terhubung otomatis.

### 3. Skema Basis Data & Migrasi
- `2026_09_22_000001_add_food_delivery_links_to_outlets_table.php`: Menyimpan URL direct delivery masing-masing outlet.
- `2026_09_22_000002_create_bridge_redirect_logs_table.php`: Menyimpan data analitik pengalihan Smart Bridge.
- `2026_09_22_000003_add_tax_amount_to_orders_table.php`: Menyimpan rincian PPN Restoran 10%.
- `2026_09_22_000004_add_original_price_to_products_table.php`: Menyimpan harga normal / sebelum diskon untuk promo hemat.

### 4. Peningkatan Alur Pemesanan (DAR-DOR Delivery & Takeaway)
- **Perhitungan Pajak Transparan**: Subtotal + PPN Restoran 10% + Biaya Pengiriman dihitung otomatis di drawer keranjang, checkout, dan struk pesanan.
- **Struk Kasir Thermal**: Format struk cetak siap print 80mm yang bersih dan memuat rincian pesanan, level pedas, catatan, serta breakdown pajak.
- **Pencarian Instan API (`/api/search`)**: Mendukung pencarian cepat menu dan outlet, kini dilengkapi deskripsi lengkap dan badge promo hemat.

### 5. Pengujian & Verifikasi (Automated Test Suite)
- Seluruh 15 skenario Feature & Unit Test lulus 100% (108 assertions):
  - `home page loads successfully`
  - `instant search api returns products and outlets`
  - `nearby outlets api calculates distance`
  - `customer can create order and track`
  - `payment webhook updates order status`
  - `new beverages and combo packages exist with accurate pricing`
  - `shopeefood bridge page renders successfully`
  - `grabfood bridge page renders successfully`
  - `gofood bridge page renders successfully`
  - `pesan alias route works`
  - `bridge direct redirect logs and redirects`
  - `waru tropodo outlet exists and bridge works`
  - `bridge urls and deep links are direct to restaurant without search query`
