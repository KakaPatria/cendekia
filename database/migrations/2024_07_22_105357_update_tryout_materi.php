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
        Schema::table('tryout_materi', function (Blueprint $table) {
            $table->time('waktu_mulai')->after('periode_selesai')->nullable();
            $table->time('waktu_selesai')->after('waktu_mulai')->nullable();
            $table->integer('durasi')->after('waktu_selesai')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tryout_materi', function (Blueprint $table) {
            //
        });
    }
};
