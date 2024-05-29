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
        Schema::create('tryout_nilai', function (Blueprint $table) {
            $table->id('tryout_nilai_id');
            $table->integer('tryout_id');
            $table->string('tryout_materi_id');
            $table->integer('user_id');
            $table->double('nilai');
            $table->string('jumlah_salah');
            $table->string('jumlah_benar');
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
        Schema::dropIfExists('tryout_nilais');
    }
};
