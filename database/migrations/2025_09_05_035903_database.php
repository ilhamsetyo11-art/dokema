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
        Schema::create('profil_peserta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nim')->unique();
            $table->string('universitas');
            $table->string('jurusan');
            $table->string('no_telepon');
            $table->text('alamat')->nullable();
            $table->timestamps();
        });

        Schema::create('data_magang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profil_peserta_id')->constrained('profil_peserta')->onDelete('cascade');
            $table->foreignId('pembimbing_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('path_surat_permohonan');
            $table->string('path_surat_balasan')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });

        Schema::create('laporan_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_magang_id')->constrained('data_magang')->onDelete('cascade');
            $table->date('tanggal_laporan');
            $table->text('deskripsi');
            $table->string('path_lampiran')->nullable();
            $table->enum('status_verifikasi', ['menunggu', 'disetujui', 'revisi'])->default('menunggu');
            $table->text('catatan_verifikasi')->nullable();
            $table->timestamp('waktu_verifikasi')->nullable();
            $table->timestamps();
        });

        Schema::create('log_bimbingan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_magang_id')->constrained('data_magang')->onDelete('cascade');
            $table->datetime('waktu_bimbingan');
            $table->text('catatan_peserta')->nullable();
            $table->text('catatan_pembimbing')->nullable();
            $table->timestamps();
        });

        Schema::create('penilaian_akhir', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_magang_id')->constrained('data_magang')->onDelete('cascade');
            $table->decimal('nilai', 5, 2);
            $table->text('umpan_balik')->nullable();
            $table->string('path_surat_nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_akhir');
        Schema::dropIfExists('log_bimbingan');
        Schema::dropIfExists('laporan_kegiatan');
        Schema::dropIfExists('data_magang');
        Schema::dropIfExists('profil_peserta');
    }
};
