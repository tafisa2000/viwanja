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
        Schema::create('plots', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->double('size')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0=available, 1=due, 2=payed');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();

            // Adding the foreign key constraint
            // Adding the foreign key constraints
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plots', function (Blueprint $table) {
            $table->dropForeign(['project_id']);
            $table->dropForeign(['category_id']);
        });
        Schema::dropIfExists('plots');
    }
};
