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
        Schema::create('tryout_open_pendaftaran', function (Blueprint $table) {
            $table->integer('top_id')->autoIncrement();
            $table->integer('tryout_id'); 
            $table->string('top_email');
            $table->string('top_nama_siswa');
            $table->string('top_asal_sekolah');
            $table->string('top_telpon_siswa');
            $table->string('top_nama_orangtua');
            $table->string('top_telpon_orang_tua');
            $table->date('top_tanggal_bayar');
            $table->string('top_jenis_bayar');
            $table->string('top_bukti_bayar');
            $table->string('top_nama_bayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
