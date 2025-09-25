<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateUsersRolesIdColumn extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Check if the foreign key exists before trying to drop it.
        // This prevents the error if the key is already gone.
        $sm = Schema::getConnection()->getDoctrineSchemaManager();
        $allForeignKeys = $sm->listTableForeignKeys('users');
        $hasForeignKey = false;
        foreach ($allForeignKeys as $key) {
            if ($key->getLocalColumns()[0] == 'roles_id') {
                $hasForeignKey = true;
                break;
            }
        }

        if ($hasForeignKey) {
            $table->dropForeign(['roles_id']);
        }
    });

    // Ubah kolom roles_id jadi NOT NULL DEFAULT 1
    DB::statement('ALTER TABLE `users` MODIFY `roles_id` BIGINT UNSIGNED NOT NULL DEFAULT 1');

    // Tambah ulang foreign key (kalau perlu)
    Schema::table('users', function (Blueprint $table) {
        $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['roles_id']);
            $table->unsignedBigInteger('roles_id')->nullable()->default(null)->change();
        });
    }
}