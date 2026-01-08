<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\ProfilPeserta;
use App\Models\DataMagang;
use App\Models\LaporanKegiatan;
use App\Models\LogBimbingan;
use App\Models\PenilaianAkhir;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MagangDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data sekolah dan siswa
        $sekolahData = [
            // Kabupaten Kudus
            [
                'sekolah' => 'SMK Negeri 1 Kudus',
                'jurusan' => 'RPL',
                'siswa' => [
                    ['nama' => 'Andi Prasetyo', 'email' => 'andi.prasetyo@student.smkn1kudus.sch.id', 'no_hp' => '081234567801'],
                    ['nama' => 'Dewi Kusumawati', 'email' => 'dewi.kusumawati@student.smkn1kudus.sch.id', 'no_hp' => '081234567802'],
                    ['nama' => 'Reza Maulana', 'email' => 'reza.maulana@student.smkn1kudus.sch.id', 'no_hp' => '081234567803'],
                ]
            ],
            [
                'sekolah' => 'SMK NU Ma\'arif Kudus',
                'jurusan' => 'TKJ',
                'siswa' => [
                    ['nama' => 'Fitri Handayani', 'email' => 'fitri.handayani@student.smknumaarif.sch.id', 'no_hp' => '081234567804'],
                    ['nama' => 'Hendra Gunawan', 'email' => 'hendra.gunawan@student.smknumaarif.sch.id', 'no_hp' => '081234567805'],
                ]
            ],
            [
                'sekolah' => 'SMK Wisudha Karya',
                'jurusan' => 'TKJ',
                'siswa' => [
                    ['nama' => 'Indah Permata Sari', 'email' => 'indah.permata@student.smkwisudha.sch.id', 'no_hp' => '081234567806'],
                    ['nama' => 'Joko Susilo', 'email' => 'joko.susilo@student.smkwisudha.sch.id', 'no_hp' => '081234567807'],
                    ['nama' => 'Kartika Putri', 'email' => 'kartika.putri@student.smkwisudha.sch.id', 'no_hp' => '081234567808'],
                ]
            ],
            // Kabupaten Pati
            [
                'sekolah' => 'SMK Negeri 2 Pati',
                'jurusan' => 'TKJ',
                'siswa' => [
                    ['nama' => 'Lutfi Hakim', 'email' => 'lutfi.hakim@student.smkn2pati.sch.id', 'no_hp' => '081234567809'],
                    ['nama' => 'Maya Safitri', 'email' => 'maya.safitri@student.smkn2pati.sch.id', 'no_hp' => '081234567810'],
                ]
            ],
            [
                'sekolah' => 'SMK Kesuma Margoyoso',
                'jurusan' => 'TKJ',
                'siswa' => [
                    ['nama' => 'Nur Hidayat', 'email' => 'nur.hidayat@student.smkkesuma.sch.id', 'no_hp' => '081234567811'],
                    ['nama' => 'Olivia Anggraini', 'email' => 'olivia.anggraini@student.smkkesuma.sch.id', 'no_hp' => '081234567812'],
                    ['nama' => 'Putra Ramadhan', 'email' => 'putra.ramadhan@student.smkkesuma.sch.id', 'no_hp' => '081234567813'],
                ]
            ],
            [
                'sekolah' => 'SMK Cordova Margoyoso',
                'jurusan' => 'TKJ',
                'siswa' => [
                    ['nama' => 'Qori Amalia', 'email' => 'qori.amalia@student.smkcordova.sch.id', 'no_hp' => '081234567814'],
                    ['nama' => 'Rizal Fauzi', 'email' => 'rizal.fauzi@student.smkcordova.sch.id', 'no_hp' => '081234567815'],
                ]
            ],
            [
                'sekolah' => 'SMK ABDI NEGARA Pati',
                'jurusan' => 'TKJ',
                'siswa' => [
                    ['nama' => 'Sinta Dewi', 'email' => 'sinta.dewi@student.smkabdinegara.sch.id', 'no_hp' => '081234567816'],
                    ['nama' => 'Taufik Hidayat', 'email' => 'taufik.hidayat@student.smkabdinegara.sch.id', 'no_hp' => '081234567817'],
                    ['nama' => 'Ulfa Rahmawati', 'email' => 'ulfa.rahmawati@student.smkabdinegara.sch.id', 'no_hp' => '081234567818'],
                ]
            ],
            // Kabupaten Jepara
            [
                'sekolah' => 'SMK Negeri 1 Jepara',
                'jurusan' => 'TKJ',
                'siswa' => [
                    ['nama' => 'Vina Agustina', 'email' => 'vina.agustina@student.smkn1jepara.sch.id', 'no_hp' => '081234567819'],
                    ['nama' => 'Wahyu Setiawan', 'email' => 'wahyu.setiawan@student.smkn1jepara.sch.id', 'no_hp' => '081234567820'],
                ]
            ],
            [
                'sekolah' => 'SMK Walisongo Pecangaan',
                'jurusan' => 'TKJ',
                'siswa' => [
                    ['nama' => 'Xena Pratiwi', 'email' => 'xena.pratiwi@student.smkwalisongo.sch.id', 'no_hp' => '081234567821'],
                    ['nama' => 'Yudi Pratama', 'email' => 'yudi.pratama@student.smkwalisongo.sch.id', 'no_hp' => '081234567822'],
                    ['nama' => 'Zahra Amelia', 'email' => 'zahra.amelia@student.smkwalisongo.sch.id', 'no_hp' => '081234567823'],
                ]
            ],
        ];

        // Ambil data pembimbing
        $pembimbingList = User::where('role', 'pembimbing')->get();
        $pembimbingIndex = 0;

        // Path surat
        $suratPaths = [
            'permohonan' => 'sample/sample_permohonan.pdf',
            'balasan' => 'sample/sample_balasan.pdf',
            'lampiran' => 'sample/sample_lampiran.pdf',
        ];

        // Periode magang options (bulan Agustus - Desember 2025)
        $periodeMagang = [
            ['mulai' => '2025-08-01', 'selesai' => '2025-09-30', 'bulan' => 'Agustus-September'], // 2 bulan
            ['mulai' => '2025-08-15', 'selesai' => '2025-10-15', 'bulan' => 'Agustus-Oktober'], // 2 bulan
            ['mulai' => '2025-09-01', 'selesai' => '2025-11-30', 'bulan' => 'September-November'], // 3 bulan
            ['mulai' => '2025-09-15', 'selesai' => '2025-10-15', 'bulan' => 'September-Oktober'], // 1 bulan
            ['mulai' => '2025-10-01', 'selesai' => '2025-12-31', 'bulan' => 'Oktober-Desember'], // 3 bulan
            ['mulai' => '2025-10-15', 'selesai' => '2025-11-15', 'bulan' => 'Oktober-November'], // 1 bulan
            ['mulai' => '2025-11-01', 'selesai' => '2025-12-31', 'bulan' => 'November-Desember'], // 2 bulan
        ];

        $studentCounter = 1;

        foreach ($sekolahData as $sekolah) {
            foreach ($sekolah['siswa'] as $siswaData) {
                // 1. Create User Account
                $user = User::create([
                    'name' => $siswaData['nama'],
                    'email' => $siswaData['email'],
                    'password' => Hash::make('password'),
                    'role' => 'magang',
                    'email_verified_at' => now(),
                ]);

                // 2. Create Profil Peserta
                $nim = sprintf('2025%03d', $studentCounter);
                $profil = ProfilPeserta::create([
                    'user_id' => $user->id,
                    'nama_peserta' => $siswaData['nama'],
                    'nim' => $nim,
                    'universitas' => $sekolah['sekolah'],
                    'jurusan' => $sekolah['jurusan'],
                    'no_telepon' => $siswaData['no_hp'],
                    'alamat' => 'Kabupaten ' . $this->getKabupaten($sekolah['sekolah']) . ', Jawa Tengah',
                ]);

                // 3. Assign Pembimbing (rotasi)
                $pembimbing = $pembimbingList[$pembimbingIndex % $pembimbingList->count()];
                $pembimbingIndex++;

                // 4. Pilih periode magang random
                $periode = $periodeMagang[array_rand($periodeMagang)];
                $tanggalMulai = Carbon::parse($periode['mulai']);
                $tanggalSelesai = Carbon::parse($periode['selesai']);

                // 5. Create Data Magang (sudah approved dan selesai)
                $dataMagang = DataMagang::create([
                    'profil_peserta_id' => $profil->id,
                    'pembimbing_id' => $pembimbing->id,
                    'path_surat_permohonan' => $suratPaths['permohonan'],
                    'path_surat_balasan' => $suratPaths['balasan'],
                    'tanggal_mulai' => $tanggalMulai,
                    'tanggal_selesai' => $tanggalSelesai,
                    'status' => 'diterima',
                    'workflow_status' => 'evaluated', // Sudah selesai dan dinilai
                    'tanggal_persetujuan' => $tanggalMulai->copy()->subDays(7), // Approved 7 hari sebelum mulai
                ]);

                // 6. Create Laporan Kegiatan (laporan harian)
                $this->createLaporanKegiatan($dataMagang, $tanggalMulai, $tanggalSelesai, $suratPaths['lampiran']);

                // 7. Create Log Bimbingan (mingguan)
                $this->createLogBimbingan($dataMagang, $tanggalMulai, $tanggalSelesai);

                // 8. Create Penilaian Akhir
                $this->createPenilaianAkhir($dataMagang, $pembimbing->id, $tanggalSelesai);

                $studentCounter++;
            }
        }

        $this->command->info('✅ Berhasil membuat ' . ($studentCounter - 1) . ' data magang dengan laporan lengkap dan penilaian!');
    }

    private function getKabupaten($namaSekolah)
    {
        if (Str::contains($namaSekolah, 'Kudus')) return 'Kudus';
        if (Str::contains($namaSekolah, ['Pati', 'Margoyoso'])) return 'Pati';
        if (Str::contains($namaSekolah, ['Jepara', 'Pecangaan'])) return 'Jepara';
        return 'Kudus';
    }

    private function createLaporanKegiatan($dataMagang, $tanggalMulai, $tanggalSelesai, $pathLampiran)
    {
        $kegiatan = [
            'Instalasi dan konfigurasi perangkat jaringan Telkom Akses',
            'Monitoring kinerja server dan troubleshooting koneksi',
            'Maintenance router dan switch di lokasi pelanggan',
            'Dokumentasi topologi jaringan area Kudus',
            'Assisting teknisi dalam pemasangan Indihome',
            'Input data pelanggan baru ke sistem billing',
            'Pengujian kecepatan dan kualitas jaringan fiber optik',
            'Koordinasi dengan tim NOC untuk penanganan gangguan',
            'Pembuatan laporan gangguan dan solusi yang diterapkan',
            'Pembelajaran sistem OSS Telkom untuk ticketing',
            'Backup konfigurasi perangkat networking',
            'Survey lokasi untuk instalasi fiber optik baru',
            'Pengecekan dan pembersihan core switch',
            'Training penggunaan aplikasi MyIndihome untuk customer',
            'Update firmware perangkat ONU pelanggan',
        ];

        $current = $tanggalMulai->copy();
        $laporanCount = 0;

        while ($current->lte($tanggalSelesai)) {
            // Skip weekend
            if ($current->isWeekday()) {
                $statusVerifikasi = ['verified', 'verified', 'verified', 'rejected'][$laporanCount % 4]; // 75% verified

                $laporan = LaporanKegiatan::create([
                    'data_magang_id' => $dataMagang->id,
                    'tanggal_laporan' => $current->format('Y-m-d'),
                    'deskripsi' => $kegiatan[array_rand($kegiatan)] . '. Kegiatan dilakukan bersama tim teknis Telkom Akses Kudus dengan bimbingan pembimbing lapangan.',
                    'path_lampiran' => $pathLampiran,
                    'status_verifikasi' => $statusVerifikasi,
                    'verified_by' => $dataMagang->pembimbing_id,
                    'verified_at' => $current->copy()->setTime(17, 0),
                    'catatan_verifikasi' => $statusVerifikasi === 'verified'
                ]);

                $laporanCount++;
            }

            $current->addDay();
        }

        $this->command->info("  - Created {$laporanCount} laporan kegiatan untuk {$dataMagang->profilPeserta->nama_peserta}");
    }

    private function createLogBimbingan($dataMagang, $tanggalMulai, $tanggalSelesai)
    {
        $topikBimbingan = [
            'Review progress minggu ini dan kendala yang dihadapi',
            'Diskusi tentang pemahaman konsep jaringan fiber optik',
            'Evaluasi soft skill komunikasi dengan pelanggan',
            'Pembahasan teknis troubleshooting perangkat',
            'Pengarahan untuk project akhir magang',
            'Coaching untuk meningkatkan ketelitian dalam dokumentasi',
            'Review laporan kegiatan dan feedback improvement',
            'Mentoring untuk persiapan penilaian akhir',
        ];

        $current = $tanggalMulai->copy();
        $mingguKe = 0;
        $logCount = 0;

        while ($current->lte($tanggalSelesai)) {
            // Bimbingan setiap hari Jumat
            if ($current->dayOfWeek === Carbon::FRIDAY) {
                LogBimbingan::create([
                    'data_magang_id' => $dataMagang->id,
                    'waktu_bimbingan' => $current->format('Y-m-d') . ' 14:00:00',
                    'catatan_peserta' => 'Minggu ke-' . ($mingguKe + 1) . ': ' . $topikBimbingan[$mingguKe % count($topikBimbingan)] . '. Menanyakan beberapa hal terkait penanganan masalah yang ditemui di lapangan.',
                    'catatan_pembimbing' => 'Peserta menunjukkan progress yang baik. ' . ['Perlu peningkatan dalam hal ketelitian.', 'Sudah cukup mandiri dalam menyelesaikan tugas.', 'Komunikasi dengan tim sudah baik.', 'Tetap pertahankan semangat belajar.'][rand(0, 3)],
                    'path_dokumentasi' => null,
                ]);

                $mingguKe++;
                $logCount++;
            }

            $current->addDay();
        }

        $this->command->info("  - Created {$logCount} log bimbingan untuk {$dataMagang->profilPeserta->nama_peserta}");
    }

    private function createPenilaianAkhir($dataMagang, $penilaiId, $tanggalSelesai)
    {
        // Generate nilai dengan rata-rata antara 70-95 (B sampai A)
        $targetRataRata = rand(70, 95);

        // Komponen penilaian (9 komponen)
        $komponenNilai = [];
        for ($i = 0; $i < 9; $i++) {
            // Variasi nilai sekitar target (±5)
            $nilai = $targetRataRata + rand(-5, 5);
            $nilai = max(60, min(100, $nilai)); // Batasi 60-100
            $komponenNilai[] = $nilai;
        }

        $jumlahNilai = array_sum($komponenNilai);
        $rataRata = $jumlahNilai / 9;

        // Konversi nilai
        $konversi = PenilaianAkhir::konversiNilai($rataRata);

        PenilaianAkhir::create([
            'data_magang_id' => $dataMagang->id,
            'nilai_keputusan_pemberi' => $komponenNilai[0],
            'nilai_disiplin' => $komponenNilai[1],
            'nilai_prioritas' => $komponenNilai[2],
            'nilai_tepat_waktu' => $komponenNilai[3],
            'nilai_bekerja_sama' => $komponenNilai[4],
            'nilai_bekerja_mandiri' => $komponenNilai[5],
            'nilai_ketelitian' => $komponenNilai[6],
            'nilai_belajar_menyerap' => $komponenNilai[7],
            'nilai_analisa_merancang' => $komponenNilai[8],
            'jumlah_nilai' => $jumlahNilai,
            'rata_rata' => round($rataRata, 2),
            'nilai_huruf' => $konversi['huruf'],
            'bobot' => $konversi['bobot'],
            'keterangan' => $konversi['keterangan'],
            'penilai_id' => $penilaiId,
            'tanggal_penilaian' => $tanggalSelesai->copy()->addDays(3),
            'umpan_balik' => $this->generateUmpanBalik($konversi['huruf']),
            'path_surat_nilai' => null, // Akan di-generate nanti
        ]);

        $this->command->info("  - Created penilaian akhir: {$konversi['huruf']} ({$rataRata}) untuk {$dataMagang->profilPeserta->nama_peserta}");
    }

    private function generateUmpanBalik($nilaiHuruf)
    {
        $feedback = [
            'A' => 'Sangat memuaskan! Peserta menunjukkan dedikasi tinggi, keterampilan teknis yang sangat baik, dan kemampuan beradaptasi yang luar biasa. Terus pertahankan etos kerja yang positif ini.',
            'AB' => 'Performa sangat baik! Peserta menguasai tugas dengan baik, proaktif dalam belajar, dan mampu bekerja sama dengan tim. Ada ruang untuk peningkatan dalam hal ketelitian detail.',
            'B' => 'Kinerja baik. Peserta menunjukkan pemahaman yang solid terhadap tugas-tugasnya dan mampu menyelesaikan pekerjaan dengan cukup mandiri. Tingkatkan inisiatif dalam mengambil tanggung jawab lebih.',
            'BC' => 'Cukup baik. Peserta menunjukkan usaha yang konsisten meskipun masih memerlukan bimbingan dalam beberapa aspek. Fokus pada peningkatan keterampilan teknis dan manajemen waktu.',
        ];

        return $feedback[$nilaiHuruf] ?? 'Peserta menunjukkan kemampuan yang cukup dalam menjalankan tugas magang. Perlu lebih fokus dan konsisten dalam meningkatkan keterampilan.';
    }
}
