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
        Schema::table('kelas_cendekia', function (Blueprint $table) {
             $table->string('jenjang')->after('kelas_cendekia_nama');
             $table->integer('kelas')->after('jenjang');
             $table->enum('status',['Aktif','Tidak Aktif'])->after('kelas_cendekia_keterangan')->default('Aktif');
     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas_cendekia', function (Blueprint $table) {
            //
        });
    }
};
