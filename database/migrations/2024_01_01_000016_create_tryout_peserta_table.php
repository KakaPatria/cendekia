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
        Schema::create('tryout_peserta', function (Blueprint $table) {
            $table->bigIncrements('tryout_peserta_id');
            $table->integer('user_id');
            $table->integer('tryout_id');
            $table->string('tryout_peserta_name');
            $table->string('tryout_peserta_telpon');
            $table->string('tryout_peserta_email');
            $table->string('tryout_peserta_alamat');
            $table->integer('tryout_peserta_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tryout_peserta');
    }
};
