<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('laporan_kegiatan', function (Blueprint $table) {
            // Drop old status_verifikasi column if exists
            if (Schema::hasColumn('laporan_kegiatan', 'status_verifikasi')) {
                $table->dropColumn('status_verifikasi');
            }
        });

        Schema::table('laporan_kegiatan', function (Blueprint $table) {
            // Add new status_verifikasi with updated enum values
            $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])->default('pending')->after('deskripsi');

            if (!Schema::hasColumn('laporan_kegiatan', 'verified_by')) {
                $table->foreignId('verified_by')->nullable()->after('status_verifikasi')->constrained('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('laporan_kegiatan', 'verified_at')) {
                $table->timestamp('verified_at')->nullable()->after('verified_by');
            }
            // catatan_verifikasi already exists, skip
            // waktu_verifikasi already exists, we'll keep it
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_kegiatan', function (Blueprint $table) {
            if (Schema::hasColumn('laporan_kegiatan', 'verified_by')) {
                $table->dropForeign(['verified_by']);
                $table->dropColumn('verified_by');
            }
            if (Schema::hasColumn('laporan_kegiatan', 'verified_at')) {
                $table->dropColumn('verified_at');
            }
            if (Schema::hasColumn('laporan_kegiatan', 'status_verifikasi')) {
                $table->dropColumn('status_verifikasi');
            }
        });

        // Restore old enum
        Schema::table('laporan_kegiatan', function (Blueprint $table) {
            $table->enum('status_verifikasi', ['menunggu', 'disetujui', 'revisi'])->default('menunggu')->after('deskripsi');
        });
    }
};
