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
        Schema::create('tryout_materi', function (Blueprint $table) {
            $table->string('tryout_materi_id')->primary();
            $table->integer('tryout_id');
            $table->integer('materi_id');
            $table->integer('pengajar_id');
            $table->text('tryout_materi_deskripsi')->nullable();
            $table->string('jenis_soal', 55)->nullable();
            $table->integer('jumlah_soal')->nullable();
            $table->date('periode_mulai')->nullable();
            $table->date('periode_selesai')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->integer('durasi')->nullable();
            $table->integer('safe_mode')->default(1);
            $table->string('master_soal')->nullable();
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_materi');
    }
};
