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
        Schema::create('tryout_jawaban', function (Blueprint $table) {
            $table->bigIncrements('tryout_jawaban_id');
            $table->string('tryout_materi_id');
            $table->integer('tryout_soal_id');
            $table->string('tryout_jawaban_prefix');
            $table->string('tryout_jawaban_urutan');
            $table->string('tryout_jawaban_isi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_jawaban');
    }
};
