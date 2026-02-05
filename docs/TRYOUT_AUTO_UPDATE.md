# Auto Update Status Tryout

## Deskripsi
Sistem akan otomatis mengubah status tryout menjadi "Tidak Aktif" ketika tanggal sudah melewati `tryout_register_due`.

## Command Laravel

### File: `app/Console/Commands/UpdateTryoutStatus.php`

Command ini bertugas untuk:
1. Mengambil semua tryout dengan status "Aktif"
2. Mengecek apakah tanggal sekarang sudah melewati `tryout_register_due`
3. Mengupdate status menjadi "Tidak Aktif" jika sudah melewati batas

### Cara Menjalankan Manual

```bash
php artisan tryout:update-status
```

## Penjadwalan Otomatis

Command ini sudah dijadwalkan untuk berjalan otomatis setiap hari jam **00:01** (tengah malam).

### File: `app/Console/Kernel.php`

```php
$schedule->command('tryout:update-status')->dailyAt('00:01');
```

## Setup Cron Job (Production)

Untuk menjalankan scheduler di production server, tambahkan cron job berikut:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

Ganti `/path-to-your-project` dengan path absolut ke folder project Laravel Anda.

### Contoh untuk cPanel:
1. Buka Cron Jobs di cPanel
2. Tambahkan cron job baru:
   - **Minute**: *
   - **Hour**: *
   - **Day**: *
   - **Month**: *
   - **Weekday**: *
   - **Command**: `cd /home/username/public_html && php artisan schedule:run >> /dev/null 2>&1`

## Testing

### 1. Test Manual
```bash
php artisan tryout:update-status
```

### 2. Test Scheduler
```bash
php artisan schedule:list
```

Untuk menjalankan scheduler secara lokal (development):
```bash
php artisan schedule:work
```

## Catatan Penting

- Command akan mengecek format tanggal `tryout_register_due` yang disimpan dalam format `d-M-Y` (contoh: 05-Feb-2026)
- Hanya tryout dengan status "Aktif" yang akan diproses
- Setelah diupdate, tryout tidak akan muncul di halaman library siswa karena filter `tryout_status = 'Aktif'`
- Log eksekusi command dapat dilihat di output terminal saat menjalankan manual

## Troubleshooting

### Command tidak terdaftar
Jalankan:
```bash
php artisan clear-compiled
composer dump-autoload
php artisan config:clear
```

### Scheduler tidak berjalan
Pastikan cron job sudah disetup di server dan Laravel scheduler berjalan dengan:
```bash
php artisan schedule:work
```
