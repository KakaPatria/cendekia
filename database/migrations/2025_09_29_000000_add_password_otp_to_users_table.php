<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'password_otp')) {
                $table->string('password_otp')->nullable()->after('remember_token');
            }
            if (!Schema::hasColumn('users', 'password_otp_expires_at')) {
                $table->timestamp('password_otp_expires_at')->nullable()->after('password_otp');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'password_otp')) {
                $table->dropColumn('password_otp');
            }
            if (Schema::hasColumn('users', 'password_otp_expires_at')) {
                $table->dropColumn('password_otp_expires_at');
            }
        });
    }
};
