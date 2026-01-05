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
        Schema::table('penilaian_akhir', function (Blueprint $table) {
            // Drop old nilai column
            $table->dropColumn('nilai');

            // Add 9 komponen penilaian (nilai 0-100)
            $table->decimal('nilai_keputusan_pemberi', 5, 2)->default(0)->after('data_magang_id');
            $table->decimal('nilai_disiplin', 5, 2)->default(0)->after('nilai_keputusan_pemberi');
            $table->decimal('nilai_prioritas', 5, 2)->default(0)->after('nilai_disiplin');
            $table->decimal('nilai_tepat_waktu', 5, 2)->default(0)->after('nilai_prioritas');
            $table->decimal('nilai_bekerja_sama', 5, 2)->default(0)->after('nilai_tepat_waktu');
            $table->decimal('nilai_bekerja_mandiri', 5, 2)->default(0)->after('nilai_bekerja_sama');
            $table->decimal('nilai_ketelitian', 5, 2)->default(0)->after('nilai_bekerja_mandiri');
            $table->decimal('nilai_belajar_menyerap', 5, 2)->default(0)->after('nilai_ketelitian');
            $table->decimal('nilai_analisa_merancang', 5, 2)->default(0)->after('nilai_belajar_menyerap');

            // Calculated fields
            $table->decimal('jumlah_nilai', 6, 2)->default(0)->after('nilai_analisa_merancang');
            $table->decimal('rata_rata', 5, 2)->default(0)->after('jumlah_nilai');
            $table->char('nilai_huruf', 2)->nullable()->after('rata_rata'); // A, AB, B, BC, C, CD, D, E
            $table->decimal('bobot', 3, 2)->default(0)->after('nilai_huruf'); // 4.0, 3.5, 3.0, etc
            $table->string('keterangan', 50)->nullable()->after('bobot'); // Memuaskan, Sangat Baik, etc

            // Metadata penilaian
            $table->foreignId('penilai_id')->nullable()->after('keterangan')->constrained('users')->onDelete('set null');
            $table->date('tanggal_penilaian')->nullable()->after('penilai_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penilaian_akhir', function (Blueprint $table) {
            $table->dropForeign(['penilai_id']);
            $table->dropColumn([
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
            ]);

            $table->decimal('nilai', 5, 2)->after('data_magang_id');
        });
    }
};
