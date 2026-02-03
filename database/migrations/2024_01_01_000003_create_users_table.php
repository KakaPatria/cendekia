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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('roles_id')->default(1);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('telepon')->nullable();
            $table->string('asal_sekolah')->nullable();
            $table->string('jenjang')->nullable();
            $table->string('kelas')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nama_orang_tua')->nullable();
            $table->string('telp_orang_tua')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('tipe_siswa', ['Cendekia', 'Umum'])->default('Umum');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('password_otp')->nullable();
            $table->timestamp('password_otp_expires_at')->nullable();
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->dateTime('last_login')->nullable();
            $table->timestamps();

            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
