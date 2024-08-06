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
            // Add the role_id column with a foreign key constraint
            $table->unsignedBigInteger('role_id')->after('id')->nullable(); // Adjust the position as needed
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null'); // Adjust the delete behavior as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key constraint and the role_id column
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
