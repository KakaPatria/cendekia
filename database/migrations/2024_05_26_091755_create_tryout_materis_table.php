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
        Schema::create('tryout_materi', function (Blueprint $table) {
            $table->string('tryout_materi_id')->primary();
            $table->integer('tryout_id');
            $table->integer('materi_id');
            $table->integer('pengjar_id');
            $table->text('tryout_materi_deskripsi');
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
        Schema::dropIfExists('tryout_materis');
    }
};
