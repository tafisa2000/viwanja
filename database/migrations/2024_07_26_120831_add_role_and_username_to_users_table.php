<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the existing role column
            // $table->dropColumn('role');
            // Add other columns if they are not already in the table
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique()->nullable();
            }
            if (!Schema::hasColumn('users', 'profile_image')) {
                $table->string('profile_image')->nullable();
            }
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert changes
            $table->string('role')->default('user');
            $table->dropColumn('username');
            $table->dropColumn('profile_image');
        });
    }
};