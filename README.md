# Sistem Manajemen Printer

Sistem ini dirancang untuk mengelola informasi tentang printer yang diservis, termasuk data pelanggan, status printer, dan tanggal servis. Aplikasi ini memungkinkan Anda untuk menambahkan, melihat, dan memperbarui data printer dengan mudah.

## Fitur
- Menambahkan data printer
- Melihat data printer yang sudah diservis
- Mengupdate status printer
- Ekspor data ke Excel

## Persyaratan Sistem
- PHP 7.x atau yang lebih baru
- MySQL Database
- Web server (misalnya Apache atau Nginx)

## Instalasi

### 1. Clone Repository
Clone repository ini ke dalam server lokal Anda atau direktori proyek.

```bash
git clone https://github.com/fiqihbadrian/sistemmanajemenprinter.git
```

### 2. Buat Database
Buat database baru di MySQL dengan nama `inventory_db` dan jalankan skrip SQL berikut untuk membuat tabel `printers`:

```sql
CREATE TABLE `printers` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `model` VARCHAR(255) NOT NULL,
  `status` ENUM('Servis', 'Selesai') NOT NULL,
  `service_date` DATE NOT NULL,
  `customer` VARCHAR(255) NOT NULL,
  `customer_number` VARCHAR(50) NOT NULL
);
```

### 3. Konfigurasi Koneksi Database
Edit file `config.php` untuk mengonfigurasi kredensial koneksi ke database MySQL Anda.

```php
// Konfigurasi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'inventory_db');
```

### 4. Menjalankan Aplikasi
Setelah mengonfigurasi database, Anda bisa membuka aplikasi di browser dengan mengarahkan URL ke direktori aplikasi Anda.

### 5. Menggunakan Aplikasi
- **Menambahkan Printer**: Gunakan form yang tersedia untuk menambahkan data printer ke database.
- **Melihat Data Printer**: Lihat semua printer yang ada di database.
- **Update Status Printer**: Update status printer yang sedang diservis.
- **Ekspor Data**: Mengekspor database ke Excel

## Contributing

Jika Anda ingin berkontribusi pada proyek ini, Anda dapat mengikuti langkah-langkah berikut:
1. Fork repositori ini.
2. Buat cabang baru (branch) untuk fitur atau perbaikan yang Anda buat.
3. Lakukan perubahan dan kirimkan pull request.

## Lisensi
