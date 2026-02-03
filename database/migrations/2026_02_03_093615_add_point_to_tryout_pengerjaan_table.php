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
        Schema::table('tryout_pengerjaan', function (Blueprint $table) {
            $table->decimal('point', 8, 2)->default(0)->after('tryout_jawaban');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tryout_pengerjaan', function (Blueprint $table) {
            $table->dropColumn('point');
        });
    }
};
