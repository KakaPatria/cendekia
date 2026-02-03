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
        Schema::create('tryout', function (Blueprint $table) {
            $table->bigIncrements('tryout_id');
            $table->string('tryout_judul');
            $table->text('tryout_deskripsi');
            $table->string('tryout_jenjang');
            $table->string('tryout_kelas');
            $table->string('tryout_register_due');
            $table->string('tryout_banner')->nullable();
            $table->enum('tryout_status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->enum('tryout_jenis', ['Gratis', 'Berbayar'])->default('Gratis');
            $table->string('is_open', 50)->default('Umum');
            $table->enum('tampilkan_kunci', ['Ya', 'Tidak'])->default('Tidak');
            $table->bigInteger('tryout_nominal');
            $table->integer('tryout_diskon')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout');
    }
};
