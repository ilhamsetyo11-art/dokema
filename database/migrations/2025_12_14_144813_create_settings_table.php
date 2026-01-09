<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->string('key')->unique();
            $table->text('value');
            $table->string('type')->default('string'); // string, int, bool, json
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default settings using the model to trigger ID generation
        \App\Models\Setting::create([
            'key' => 'magang_quota',
            'value' => '20',
            'type' => 'int',
            'description' => 'Maksimal kuota penerimaan magang',
        ]);

        \App\Models\Setting::create([
            'key' => 'auto_assign_supervisor',
            'value' => '1',
            'type' => 'bool',
            'description' => 'Otomatis assign pembimbing saat approval',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
