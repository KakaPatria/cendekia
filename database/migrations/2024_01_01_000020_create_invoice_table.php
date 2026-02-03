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
        Schema::create('invoice', function (Blueprint $table) {
            $table->string('inv_id')->primary();
            $table->integer('user_id');
            $table->integer('tryout_id');
            $table->integer('tryout_peserta_id');
            $table->string('keterangan');
            $table->integer('amount');
            $table->integer('discount');
            $table->integer('total');
            $table->integer('status');
            $table->date('due_date');
            $table->dateTime('inv_paid')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('bank')->nullable();
            $table->string('va_number')->nullable();
            $table->string('remark')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('redirect_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
