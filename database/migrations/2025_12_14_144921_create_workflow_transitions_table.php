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
        Schema::create('workflow_transitions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->unsignedBigInteger('data_magang_id');
            $table->foreign('data_magang_id')->references('id')->on('data_magang')->onDelete('cascade');
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->unsignedBigInteger('triggered_by')->nullable();
            $table->foreign('triggered_by')->references('id')->on('users')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable(); // For storing additional context
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_transitions');
    }
};
