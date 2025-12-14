<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianAkhir extends Model
{
    use HasFactory;

    protected $table = 'penilaian_akhir';

    protected $fillable = [
        'data_magang_id',
        'nilai_kehadiran',
        'nilai_kedisiplinan',
        'nilai_keterampilan',
        'nilai_sikap',
        'nilai_rata_rata',
        'umpan_balik',
        'path_surat_nilai',
        'tanggal_penilaian',
    ];

    protected $casts = [
        'tanggal_penilaian' => 'datetime',
    ];

    public function dataMagang()
    {
        return $this->belongsTo(DataMagang::class);
    }
}
