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
        Schema::create('ref_materi', function (Blueprint $table) {
            $table->bigIncrements('ref_materi_id');
            $table->string('ref_materi_judul');
            $table->string('ref_materi_jenjang');
            $table->integer('ref_materi_kelas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_materi');
    }
};
