<?php

namespace App\Models;

use App\Traits\GeneratesDateBasedId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianAkhir extends Model
{
    use HasFactory, GeneratesDateBasedId;

    protected $table = 'penilaian_akhir';

    protected $fillable = [
        'data_magang_id',
        'nilai_keputusan_pemberi',
        'nilai_disiplin',
        'nilai_prioritas',
        'nilai_tepat_waktu',
        'nilai_bekerja_sama',
        'nilai_bekerja_mandiri',
        'nilai_ketelitian',
        'nilai_belajar_menyerap',
        'nilai_analisa_merancang',
        'jumlah_nilai',
        'rata_rata',
        'nilai_huruf',
        'bobot',
        'keterangan',
        'penilai_id',
        'tanggal_penilaian',
        'umpan_balik',
        'path_surat_nilai',
    ];

    protected $casts = [
        'tanggal_penilaian' => 'date',
        'nilai_keputusan_pemberi' => 'decimal:2',
        'nilai_disiplin' => 'decimal:2',
        'nilai_prioritas' => 'decimal:2',
        'nilai_tepat_waktu' => 'decimal:2',
        'nilai_bekerja_sama' => 'decimal:2',
        'nilai_bekerja_mandiri' => 'decimal:2',
        'nilai_ketelitian' => 'decimal:2',
        'nilai_belajar_menyerap' => 'decimal:2',
        'nilai_analisa_merancang' => 'decimal:2',
        'jumlah_nilai' => 'decimal:2',
        'rata_rata' => 'decimal:2',
        'bobot' => 'decimal:2',
    ];

    /**
     * Hitung konversi nilai berdasarkan rata-rata
     */
    public static function konversiNilai($rataRata)
    {
        if ($rataRata >= 85) {
            return ['huruf' => 'A', 'bobot' => 4.0, 'keterangan' => 'Memuaskan'];
        } elseif ($rataRata >= 75) {
            return ['huruf' => 'AB', 'bobot' => 3.5, 'keterangan' => 'Sangat Baik'];
        } elseif ($rataRata >= 67) {
            return ['huruf' => 'B', 'bobot' => 3.0, 'keterangan' => 'Baik'];
        } elseif ($rataRata >= 61) {
            return ['huruf' => 'BC', 'bobot' => 2.5, 'keterangan' => 'Cukup Baik'];
        } elseif ($rataRata >= 55) {
            return ['huruf' => 'C', 'bobot' => 2.0, 'keterangan' => 'Sedang'];
        } elseif ($rataRata >= 45) {
            return ['huruf' => 'CD', 'bobot' => 1.5, 'keterangan' => 'Kurang'];
        } elseif ($rataRata >= 35) {
            return ['huruf' => 'D', 'bobot' => 1.0, 'keterangan' => 'Sangat Kurang'];
        } else {
            return ['huruf' => 'E', 'bobot' => 0.0, 'keterangan' => 'Gagal'];
        }
    }

    public function dataMagang()
    {
        return $this->belongsTo(DataMagang::class);
    }

    public function penilai()
    {
        return $this->belongsTo(User::class, 'penilai_id');
    }
}
