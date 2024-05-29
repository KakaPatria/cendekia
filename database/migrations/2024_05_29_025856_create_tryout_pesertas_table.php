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

        Schema::create('tryout_peserta', function (Blueprint $table) {
            $table->id('tryout_peserta_id');
            $table->integer('user_id');
            $table->integer('tryout_id');
            $table->integer('tryout_peserta_status');
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
        Schema::dropIfExists('tryout_peserta');
    }
};
