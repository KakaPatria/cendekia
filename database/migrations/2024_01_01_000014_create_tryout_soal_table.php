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
        Schema::create('tryout_soal', function (Blueprint $table) {
            $table->bigIncrements('tryout_soal_id');
            $table->string('tryout_materi_id');
            $table->integer('tryout_nomor');
            $table->integer('point')->default(1);
            $table->longText('tryout_soal')->nullable();
            $table->string('tryout_soal_type', 10)->nullable();
            $table->string('tryout_kunci_jawaban')->nullable();
            $table->string('tryout_penyelesaian')->nullable();
            $table->string('notes', 55)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_soal');
    }
};
