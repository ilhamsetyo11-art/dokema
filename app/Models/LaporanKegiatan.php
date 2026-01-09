<?php

namespace App\Models;

use App\Traits\GeneratesDateBasedId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKegiatan extends Model
{
    use HasFactory, GeneratesDateBasedId;

    protected $table = 'laporan_kegiatan';

    protected $fillable = [
        'data_magang_id',
        'tanggal_laporan',
        'deskripsi',
        'path_lampiran',
        'status_verifikasi',
        'verified_by',
        'verified_at',
        'catatan_verifikasi',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    /**
     * Issue #7: Auto-generate log bimbingan when laporan created
     */
    protected static function booted()
    {
        static::created(function ($laporan) {
            // Only auto-generate if setting is enabled
            if (Setting::get('auto_generate_log_bimbingan', true)) {
                LogBimbingan::create([
                    'data_magang_id' => $laporan->data_magang_id,
                    'waktu_bimbingan' => $laporan->tanggal_laporan . ' 09:00:00',
                    'catatan_peserta' => 'Log otomatis dari laporan kegiatan: ' . \Illuminate\Support\Str::limit($laporan->deskripsi, 100),
                    'catatan_pembimbing' => null,
                ]);
            }
        });
    }

    public function dataMagang()
    {
        return $this->belongsTo(DataMagang::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
