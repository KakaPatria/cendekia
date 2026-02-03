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
        Schema::create('kelas_cendekia', function (Blueprint $table) {
            $table->bigIncrements('kelas_cendekia_id');
            $table->string('kelas_cendekia_nama');
            $table->string('jenjang');
            $table->integer('kelas');
            $table->string('kelas_cendekia_keterangan')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_cendekia');
    }
};
