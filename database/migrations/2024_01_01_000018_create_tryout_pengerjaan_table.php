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
        Schema::create('tryout_pengerjaan', function (Blueprint $table) {
            $table->bigIncrements('tryout_pengerjaan_id');
            $table->string('tryout_materi_id');
            $table->integer('tryout_soal_id');
            $table->integer('user_id');
            $table->string('tryout_jawaban');
            $table->decimal('point', 8, 2)->default(0);
            $table->enum('status', ['Benar', 'Salah'])->default('Salah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_pengerjaan');
    }
};
