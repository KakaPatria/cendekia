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
        Schema::create('tryout_nilai', function (Blueprint $table) {
            $table->bigIncrements('tryout_nilai_id');
            $table->integer('tryout_id');
            $table->string('tryout_materi_id');
            $table->integer('user_id');
            $table->double('nilai')->nullable();
            $table->integer('total_point')->default(0);
            $table->integer('soal_dijekerjakan')->nullable();
            $table->integer('soal_total')->nullable();
            $table->string('jumlah_salah')->nullable();
            $table->string('jumlah_benar')->nullable();
            $table->integer('last_soal_id')->nullable();
            $table->string('status', 55)->default('Proses');
            $table->dateTime('mulai_pengerjaan')->nullable();
            $table->dateTime('stop_pengerjaan')->nullable();
            $table->dateTime('lanjutkan_pengerjaan')->nullable();
            $table->dateTime('selesai_pengerjaan')->nullable();
            $table->integer('durasi_berjalan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_nilai');
    }
};
