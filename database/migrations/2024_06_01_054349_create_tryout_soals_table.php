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
        Schema::create('tryout_soal', function (Blueprint $table) {
            $table->id('tryout_soal_id');
            $table->string('tryout_materi_id');
            $table->string('tryout_soal');
            $table->string('tryout_kunci_jawaban');
            $table->string('tryout_penyelesaian');
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
        Schema::dropIfExists('tryout_soals');
    }
};
