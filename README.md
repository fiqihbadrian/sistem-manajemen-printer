
# Sistem Manajemen Printer (Open Source)

Sistem Manajemen Printer berbasis PHP untuk mengelola data printer yang diservis. Fitur termasuk tambah, edit, hapus, dan tampilan daftar printer, serta ekspor data ke Excel. Menggunakan MySQL untuk penyimpanan dan Tailwind CSS untuk desain responsif.


## Fitur

- Menambah data printer
- Mengedit data printer
- Menghapus data printer
- Menampilkan daftar printer yang tersimpan
- Menyimpan data dalam database MySQL
- Menyediakan fitur ekspor data ke format Excel

## Prasyarat

Sebelum menjalankan aplikasi ini, pastikan Anda memiliki:

- PHP versi 7.4 atau lebih tinggi
- MySQL atau MariaDB
- Server web (misalnya Apache atau Nginx)
- Akses untuk membuat database dan tabel di MySQL

## Instalasi

1. **Clone Repository**

   Jika Anda menggunakan Git, clone repository ini:

   ```bash
   git clone https://github.com/fiqihbadrian/sistemmanajemenprinter.git
   cd sistem-manajemen-printer
   ```

2. **Konfigurasi Database**

   Pastikan Anda telah membuat database MySQL sesuai dengan konfigurasi di file `config.php`. Berikut adalah langkah-langkah untuk membuat database:

   - Masuk ke MySQL:

     ```bash
     mysql -u root -p
     ```

   - Buat database dan tabel yang diperlukan:

     ```sql
     CREATE DATABASE inventory_db;
     USE inventory_db;

     CREATE TABLE printers (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(255) NOT NULL,
         model VARCHAR(255) NOT NULL,
         status ENUM('Servis', 'Selesai') NOT NULL,
         service_date DATE NOT NULL,
         customer VARCHAR(255) NOT NULL,
         customer_number VARCHAR(15) NOT NULL
     );
     ```

3. **Konfigurasi File `config.php`**

   Pada file `config.php`, masukkan kredensial database Anda dengan aman seperti berikut:

   ```php
   <?php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');  // Ganti dengan username database Anda
   define('DB_PASS', '');      // Ganti dengan password database Anda
   define('DB_NAME', 'inventory_db');
   ?>
   ```

4. **Amankan File Konfigurasi**

   Pastikan file `config.php` memiliki izin akses yang terbatas agar tidak bisa diakses publik. Jalankan perintah berikut untuk mengamankan file konfigurasi:

   ```bash
   chmod 600 config.php
   ```

5. **Jalankan Aplikasi**

   Letakkan aplikasi pada direktori root server web Anda, misalnya pada `htdocs` di XAMPP, atau pada folder yang sesuai dengan server web yang Anda gunakan. Akses aplikasi melalui browser:

   ```
   http://localhost/sistemmanajemenprinter/index.php
   ```

## Penggunaan

Setelah aplikasi dijalankan, Anda dapat:

- Menambahkan data printer melalui form yang disediakan.
- Mengedit data printer dengan memilih tombol "Edit" di daftar printer.
- Menghapus data printer dengan memilih tombol "Hapus" di daftar printer.
- Mengekspor data printer ke dalam format Excel.

## Pengembangan

Jika Anda ingin berkontribusi atau melakukan perubahan pada proyek ini, silakan lakukan fork dan kirim pull request.

## preview

<img width="960" alt="Screenshot 2024-12-20 160802" src="https://github.com/user-attachments/assets/5f42e914-b101-4600-9efe-a515289dd9f2" />
