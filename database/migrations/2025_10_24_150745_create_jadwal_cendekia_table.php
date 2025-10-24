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
        Schema::create('jadwal_cendekia', function (Blueprint $table) {
            $table->id('jadwal_cendekia_id');
            $table->integer('ref_materi_id');
            $table->integer('guru_id');
            $table->string('jadwal_cendekia_hari');
            $table->time('jadwal_mulai');
            $table->time('jadwal_selesai');
            $table->string('jadwal_cendekia_keterangan')->nullable();
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
        Schema::dropIfExists('jadwal_cendekia');
    }
};
