# Format Import Siswa dari Excel

## Panduan Penggunaan

### 1. Download Template
- Buka halaman User Management
- Pilih tab "Siswa"
- Klik tombol "Import Excel"
- Klik "Download Template Excel" untuk mendapatkan file template

### 2. Format Kolom Excel

File Excel harus memiliki kolom-kolom berikut (urutan harus sesuai):

| No | Kolom | Wajib | Keterangan | Contoh |
|----|-------|-------|------------|--------|
| A | Email | Ya | Email siswa (harus unique) | siswa1@example.com |
| B | Nama Lengkap | Ya | Nama lengkap siswa | Ahmad Zaki |
| C | Telepon | Ya | Nomor telepon siswa | 081234567890 |
| D | Asal Sekolah | Tidak | Nama sekolah asal | SMA Negeri 1 Jakarta |
| E | Jenjang | Tidak | SD/SMP/SMA | SMA |
| F | Kelas | Tidak | Nomor kelas (1-12) | 10 |
| G | Alamat | Tidak | Alamat lengkap | Jl. Merdeka No. 123 |
| H | Nama Orangtua | Tidak | Nama orangtua/wali | Budi Santoso |
| I | Telepon Orangtua | Tidak | Nomor telepon orangtua | 081234567891 |
| J | Tipe Siswa | Tidak | Cendekia/Umum (default: Umum) | Cendekia |
| K | Password | Tidak | Password akun (default: password123) | password123 |

### 3. Validasi Data

System akan melakukan validasi otomatis:

#### Email:
- Harus format email yang valid
- Tidak boleh sudah terdaftar di database
- Contoh valid: `siswa@example.com`
- Contoh tidak valid: `siswaexample.com`

#### Jenjang:
- Harus salah satu dari: **SD**, **SMP**, atau **SMA**
- **Tidak case-sensitive** (bisa `sd`, `SD`, `Sd`, dll - akan otomatis dikonversi ke uppercase)
- Boleh kosong
- Contoh valid: `SMA`, `sma`, `Sma` (semua akan menjadi `SMA`)

#### Tipe Siswa:
- Harus salah satu dari: **Cendekia** atau **Umum**
- **Tidak case-sensitive** (bisa `cendekia`, `CENDEKIA`, `Cendekia`, dll)
- **Toleran terhadap typo umum** seperti:
  - ✅ `cendikia` → tersimpan sebagai `Cendekia`
  - ✅ `cendekiya` → tersimpan sebagai `Cendekia`
  - ✅ `cendakia` → tersimpan sebagai `Cendekia`
  - ✅ `cendakiya` → tersimpan sebagai `Cendekia`
  - ✅ `cendikiya` → tersimpan sebagai `Cendekia`
  - ✅ Dan varian typo lainnya yang mirip
- Jika kosong atau tidak valid, otomatis diset ke **Umum**
- Contoh valid: `Cendekia`, `cendekia`, `CENDEKIA`, `cendikia`, `Umum`, `umum`, `UMUM`

#### Kelas:
- Harus angka 1-12
- Boleh kosong

### 4. Contoh Data Excel

```
| Email               | Nama Lengkap  | Telepon      | Asal Sekolah         | Jenjang | Kelas | Alamat           | Nama Orangtua | Telepon Orangtua | Tipe Siswa | Password    |
|---------------------|---------------|--------------|----------------------|---------|-------|------------------|---------------|------------------|------------|-------------|
| siswa1@example.com  | Ahmad Zaki    | 081234567890 | SMA Negeri 1 Jakarta | SMA     | 10    | Jl. Merdeka 123  | Budi Santoso  | 081234567891     | Cendekia   | password123 |
| siswa2@example.com  | Siti Rahayu   | 081234567892 | SMP Negeri 2 Jakarta | SMP     | 8     | Jl. Sudirman 456 | Andi Wijaya   | 081234567893     | Umum       | password456 |
```

### 5. Upload dan Import

1. Isi file Excel sesuai format di atas
2. Simpan file dalam format `.xlsx` atau `.xls`
3. Klik tombol "Import Excel" di halaman User Management
4. Pilih file Excel yang sudah diisi
5. Klik tombol "Import"
6. Tunggu proses import selesai
7. System akan menampilkan:
   - Jumlah data yang berhasil diimport
   - Jumlah data yang gagal
   - Detail error (max 10 error pertama)

### 6. Tips & Catatan

✅ **Do's (Yang Harus Dilakukan):**
- Gunakan template yang disediakan
- Pastikan kolom header (baris 1) tidak diubah
- Pastikan email unique/tidak duplikat
- Gunakan format jenjang: SD, SMP, atau SMA (huruf kapital)
- Pastikan nomor telepon valid
- Simpan dalam format .xlsx atau .xls

❌ **Don'ts (Yang Tidak Boleh):**
- Jangan menghapus atau mengubah kolom header
- Jangan menggunakan email yang sudah terdaftar
- Jangan menggunakan format jenjang selain SD/SMP/SMA
- Jangan menggunakan tipe siswa selain Cendekia/Umum
- Jangan mengosongkan kolom Email, Nama, dan Telepon
- Jangan upload file lebih dari 10MB

### 7. Troubleshooting

**Q: Data gagal diimport semua?**
- Pastikan format file adalah .xlsx atau .xls
- Pastikan ukuran file tidak lebih dari 10MB
- Pastikan header kolom sesuai dengan template

**Q: Beberapa data gagal diimport?**
- Cek detail error yang ditampilkan
- Biasanya karena email duplikat atau format tidak sesuai
- Perbaiki data yang error dan import ulang

**Q: Error "Email sudah terdaftar"?**
- Email tersebut sudah ada di database
- Gunakan email lain atau hapus user lama terlebih dahulu

**Q: Error "Format email tidak valid"?**
- Pastikan format email benar (contoh: nama@domain.com)
- Jangan ada spasi atau karakter tidak valid

### 8. Role dan Permission

Setelah berhasil diimport:
- Semua siswa otomatis mendapat role "Siswa"
- Password akan di-hash untuk keamanan
- Siswa dapat langsung login menggunakan email dan password yang diset
- Password default adalah "password123" jika tidak diisi

### 9. Keamanan

- Password akan otomatis di-hash menggunakan bcrypt
- Disarankan siswa mengganti password setelah login pertama
- Email bersifat unique dan case-insensitive
- Data validasi dilakukan per baris untuk mencegah corrupt data

---

**Dibuat untuk:** Cendekia LMS  
**Versi:** 1.0  
**Tanggal:** 4 Februari 2026
