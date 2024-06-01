<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tryout_jawaban', function (Blueprint $table) {
            $table->id('tryout_jawaban_id');
            $table->string('tryout_materi_id');
            $table->integer('tryout_soal_id');
            $table->string('tryout_jawaban_prefix');
            $table->string('tryout_jawaban_urutan');
            $table->string('tryout_jawaban_isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tryout_jawabans');
    }
};
