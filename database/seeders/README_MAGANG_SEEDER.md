# Data Magang Seeder - PT Telkom Akses Kudus

## Overview

Seeder ini membuat data dummy lengkap untuk sistem manajemen magang dengan data yang realistis dari 9 sekolah di area Kudus, Pati, dan Jepara.

## Data Yang Dibuat

### 📊 Statistik

-   **Total Peserta**: 25 siswa magang
-   **Sekolah**: 9 SMK (3 Kudus, 4 Pati, 2 Jepara)
-   **Pembimbing**: 3 orang (dari UserSeeder)
-   **Periode Magang**: Agustus - Desember 2025 (1-3 bulan)
-   **Status**: Semua magang sudah selesai dan dinilai

### 🏫 Daftar Sekolah

**Kabupaten Kudus:**

-   SMK Negeri 1 Kudus (RPL) - 3 siswa
-   SMK NU Ma'arif Kudus (TKJ) - 2 siswa
-   SMK Wisudha Karya (TKJ) - 3 siswa

**Kabupaten Pati:**

-   SMK Negeri 2 Pati (TKJ) - 2 siswa
-   SMK Kesuma Margoyoso (TKJ) - 3 siswa
-   SMK Cordova Margoyoso (TKJ) - 2 siswa
-   SMK ABDI NEGARA Pati (TKJ) - 3 siswa

**Kabupaten Jepara:**

-   SMK Negeri 1 Jepara (TKJ) - 2 siswa
-   SMK Walisongo Pecangaan (TKJ) - 3 siswa

### 📁 Data Yang Di-generate

Untuk setiap peserta magang:

1. **User Account** (role: magang)

    - Email: [nama]@student.[sekolah].sch.id
    - Password: "password"
    - Email verified

2. **Profil Peserta**

    - NIM: 2025001 - 2025025
    - Data lengkap (nama, sekolah, jurusan, no HP, alamat)

3. **Data Magang**

    - Status: `diterima` (approved)
    - Workflow: `evaluated` (sudah selesai & dinilai)
    - Pembimbing: Rotasi antara 3 pembimbing
    - Surat: sample_permohonan.pdf & sample_balasan.pdf
    - Periode: Random 1-3 bulan (Ags-Des 2025)

4. **Laporan Kegiatan** (Harian - Senin-Jumat)

    - Kegiatan teknis Telkom Akses (instalasi, maintenance, troubleshooting, dll)
    - 75% approved, 25% revisi
    - Dengan catatan verifikasi pembimbing
    - Path lampiran: sample_lampiran.pdf

5. **Log Bimbingan** (Mingguan - Setiap Jumat)

    - Catatan peserta & pembimbing
    - Topik: Review progress, troubleshooting, evaluasi, coaching

6. **Penilaian Akhir**
    - 9 komponen nilai (Nilai 60-100)
    - Rata-rata: 70-95 (Grade B - A)
    - Konversi huruf: A/AB/B/BC
    - Feedback lengkap dari pembimbing

## 📝 Komponen Penilaian

1. Nilai Keputusan Pemberi Tugas
2. Nilai Disiplin
3. Nilai Skala Prioritas
4. Nilai Tepat Waktu
5. Nilai Bekerja Sama
6. Nilai Bekerja Mandiri
7. Nilai Ketelitian
8. Nilai Kemampuan Belajar & Menyerap
9. Nilai Analisa & Merancang

**Grade System:**

-   A (85-100): Memuaskan
-   AB (75-84): Sangat Baik
-   B (67-74): Baik
-   BC (61-66): Cukup Baik

## 🎯 Contoh Kegiatan Yang Di-generate

-   Instalasi dan konfigurasi perangkat jaringan
-   Monitoring kinerja server dan troubleshooting
-   Maintenance router dan switch
-   Dokumentasi topologi jaringan
-   Assisting pemasangan Indihome
-   Input data billing pelanggan
-   Pengujian fiber optik
-   Training MyIndihome
-   Survey lokasi instalasi

## 🚀 Cara Menggunakan

### Option 1: Run Seeder Saja

```bash
php artisan db:seed --class=MagangDataSeeder
```

### Option 2: Fresh Migration + All Seeders

```bash
php artisan migrate:fresh --seed
php artisan db:seed --class=MagangDataSeeder
```

### Option 3: Komplet (Recommended)

```bash
# 1. Reset database
php artisan migrate:fresh

# 2. Seed users (HR & Pembimbing)
php artisan db:seed --class=UserSeeder

# 3. Seed data magang lengkap
php artisan db:seed --class=MagangDataSeeder
```

## 📊 Verifikasi Data

Setelah seeding, cek database:

```sql
-- Total peserta
SELECT COUNT(*) as total_peserta FROM profil_peserta;

-- Status magang
SELECT workflow_status, COUNT(*) FROM data_magang GROUP BY workflow_status;

-- Total laporan
SELECT COUNT(*) as total_laporan FROM laporan_kegiatan;

-- Distribusi nilai
SELECT nilai_huruf, COUNT(*) FROM penilaian_akhir GROUP BY nilai_huruf;
```

## 🔐 Login Credentials

### Admin HR:

-   Email: admin@telkomakses.co.id
-   Password: password

### Pembimbing:

-   budi.santoso@telkomakses.co.id (password)
-   sari.wulandari@telkomakses.co.id (password)
-   ahmad.rizki@telkomakses.co.id (password)

### Peserta Magang (Contoh):

-   andi.prasetyo@student.smkn1kudus.sch.id (password)
-   dewi.kusumawati@student.smkn1kudus.sch.id (password)
-   [dst... total 25 siswa]

## ⚠️ Catatan Penting

1. **Pastikan file sample ada** di folder `public/sample/`:

    - sample_permohonan.pdf
    - sample_balasan.pdf
    - sample_lampiran.pdf

2. **UserSeeder harus dijalankan dulu** untuk membuat pembimbing

3. **Setting otomatis**: Auto-generate log bimbingan dinonaktifkan di seeder ini (manual creation)

4. **Periode realistis**: Semua magang sudah selesai di masa lalu (Ags-Des 2025)

5. **Distribusi pembimbing merata**: Sistem rotasi otomatis

## 🐛 Troubleshooting

### Error: Foreign key constraint fails

```bash
# Pastikan urutan seeding benar
php artisan migrate:fresh
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=MagangDataSeeder
```

### Error: File not found (sample PDF)

```bash
# Buat folder dan copy sample files
mkdir public/sample
# Copy PDF files ke folder tersebut
```

### Tidak ada data muncul

```bash
# Check logs
tail storage/logs/laravel.log

# Atau run dengan verbose
php artisan db:seed --class=MagangDataSeeder -vvv
```

## 📈 Output Yang Diharapkan

```
✅ Berhasil membuat 25 data magang dengan laporan lengkap dan penilaian!
  - Created 60 laporan kegiatan untuk Andi Prasetyo
  - Created 8 log bimbingan untuk Andi Prasetyo
  - Created penilaian akhir: AB (78.5) untuk Andi Prasetyo
  ... (repeat untuk 25 siswa)
```

## 🎨 Customization

Edit seeder untuk:

-   Mengubah periode magang
-   Menambah/kurangi siswa per sekolah
-   Adjust range nilai (saat ini 70-95)
-   Modifikasi kegiatan magang
-   Custom feedback penilaian

---

**Author**: Telkom Akses Development Team  
**Last Updated**: January 8, 2026  
**Version**: 1.0.0
