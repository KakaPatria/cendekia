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
        Schema::create('tryout_open_pendaftaran', function (Blueprint $table) {
            $table->increments('top_id');
            $table->integer('tryout_id');
            $table->string('top_email');
            $table->string('top_nama_siswa');
            $table->string('top_asal_sekolah');
            $table->string('top_telpon_siswa');
            $table->string('top_nama_orang_tua');
            $table->string('top_telpon_orang_tua');
            $table->date('top_tanggal_bayar');
            $table->string('top_jenis_bayar');
            $table->string('top_bukti_bayar');
            $table->string('top_nama_bayar');
            $table->enum('top_status', ['Pending', 'Terverifikasi'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_open_pendaftaran');
    }
};
