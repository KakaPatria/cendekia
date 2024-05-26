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
        Schema::create('ref_materi', function (Blueprint $table) {
            $table->id('ref_materi_id');
            $table->string('ref_materi_judul'); // Title of the material
            $table->string('ref_materi_jenjang'); // Education level
            $table->integer('ref_materi_kelas'); // Class as an integer
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
        Schema::dropIfExists('ref_materi');
    }
};
