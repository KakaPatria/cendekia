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
        Schema::create('tryout', function (Blueprint $table) {
            $table->id('tryout_id');
            $table->string('tryout_judul');
            $table->text('tryout_deskripsi');
            $table->string('tryout_jenjang');
            $table->string('tryout_kelas');
            $table->string('tryout_register_due');
            $table->string('tryout_banner');
            $table->enum('tryout_status',['Aktif','Tidak Aktif'])->default('Aktif');
            $table->enum('tryout_jenis',['Gratis','Berbayar'])->default('Gratis');
            $table->bigInteger('tryout_nominal');
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
        Schema::dropIfExists('tryouts');
    }
};
