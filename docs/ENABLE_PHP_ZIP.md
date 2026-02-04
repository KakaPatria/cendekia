# Cara Mengaktifkan Extension PHP Zip

## Error yang Muncul:
```
Class "ZipArchive" not found
```

Error ini terjadi karena extension `zip` pada PHP belum diaktifkan. Extension ini diperlukan untuk membuat dan membaca file Excel (.xlsx).

---

## Solusi untuk XAMPP/WAMP (Windows)

### 1. Cari File php.ini

**Untuk XAMPP:**
- Buka folder instalasi XAMPP (biasanya `C:\xampp`)
- Cari file `php\php.ini`

**Untuk WAMP:**
- Buka folder instalasi WAMP
- Cari file `bin\php\php[versi]\php.ini`

### 2. Edit File php.ini

1. Buka file `php.ini` dengan text editor (Notepad, VS Code, dll)
2. Cari baris yang berisi: 
   ```ini
   ;extension=zip
   ```
3. Hapus tanda `;` (semicolon) di depannya sehingga menjadi:
   ```ini
   extension=zip
   ```
4. Simpan file

### 3. Restart Web Server

**XAMPP:**
- Buka XAMPP Control Panel
- Stop Apache
- Start Apache lagi

**WAMP:**
- Klik icon WAMP di system tray
- Pilih "Restart All Services"

### 4. Verifikasi Extension Sudah Aktif

Jalankan perintah di terminal:

```bash
php -m | findstr zip
```

Atau buat file PHP dengan isi:
```php
<?php
phpinfo();
```

Cari bagian "zip" di output, jika ada maka extension sudah aktif.

---

## Solusi untuk Laragon (Windows)

### 1. Melalui Menu Laragon

1. Klik kanan icon Laragon di system tray
2. Pilih `PHP` → `php.ini`
3. Cari baris: `;extension=zip`
4. Hapus tanda `;` sehingga menjadi: `extension=zip`
5. Simpan file
6. Klik kanan icon Laragon → `PHP` → `Reload PHP`

---

## Solusi untuk Linux/Ubuntu

### 1. Install Extension Zip

```bash
sudo apt-get update
sudo apt-get install php-zip
```

### 2. Restart Web Server

**Apache:**
```bash
sudo service apache2 restart
```

**Nginx:**
```bash
sudo service nginx restart
sudo service php8.1-fpm restart
```
*(Sesuaikan versi PHP Anda)*

---

## Solusi untuk macOS

### 1. Install via Homebrew (jika menggunakan Homebrew PHP)

```bash
brew install php
```

Extension zip biasanya sudah termasuk dalam instalasi PHP via Homebrew.

### 2. Jika Menggunakan MAMP

1. Buka `/Applications/MAMP/bin/php/php[versi]/conf/php.ini`
2. Cari `;extension=zip`
3. Hapus tanda `;`
4. Restart MAMP

---

## Troubleshooting

### Extension Sudah Aktif Tapi Masih Error

**Cek apakah extension benar-benar ter-load:**
```bash
php -m | grep zip
```

**Cek path php.ini yang digunakan:**
```bash
php --ini
```

Pastikan Anda mengedit file php.ini yang benar (bukan php.ini-development atau php.ini-production).

### Multiple PHP Installations

Jika Anda memiliki beberapa versi PHP terinstall:

1. Cek versi PHP yang digunakan:
   ```bash
   php -v
   ```

2. Pastikan edit php.ini sesuai versi yang digunakan

3. Restart web server yang menggunakan PHP versi tersebut

### Masih Error Setelah Restart

1. **Clear cache browser** (Ctrl + Shift + Delete)
2. **Restart komputer** (untuk memastikan semua service ter-reload)
3. **Cek file composer.json** pastikan ada:
   ```json
   "require": {
       "phpoffice/phpspreadsheet": "^3.3"
   }
   ```
4. **Install ulang dependencies:**
   ```bash
   composer install
   ```

---

## Verifikasi Final

Setelah mengaktifkan extension zip, coba akses fitur import Excel:

1. Buka browser
2. Login ke panel admin
3. Buka User Management → Tab Siswa
4. Klik "Import Excel"
5. Klik "Download Template Excel"
6. File Excel seharusnya ter-download dengan benar

Jika file ter-download dengan baik, berarti extension zip sudah aktif dan berfungsi! ✅

---

## Catatan Penting

- **Extension zip** diperlukan untuk membuat file .xlsx (Excel format baru)
- Tanpa extension ini, PhpSpreadsheet tidak bisa membuat file Excel
- Extension ini sudah built-in di PHP 7.4+, tapi perlu diaktifkan manual
- Jangan lupa **restart web server** setelah mengubah php.ini

---

**Dibuat untuk:** Cendekia LMS  
**Versi:** 1.0  
**Tanggal:** 4 Februari 2026
