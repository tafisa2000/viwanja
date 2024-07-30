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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->date('date');

            $table->foreignId('invoice_id')->constrained();
            $table->foreignId('project_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('plot_id')->constrained();
            $table->double('size');
            $table->double('price');
            // $table->double('unit_price');
            // $table->double('selling_price');
            $table->tinyInteger('status')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
};
