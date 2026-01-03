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
        Schema::create('products_attris', function (Blueprint $table) {
            $table->id();
            $table->integer('products_id');
            $table->string('category_sub_id');
            $table->string('spec_attribute')->nullable();
            $table->string('spec_value')->nullable();
            $table->integer('flag');
            $table->string('status');
            $table->string('created_by');

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
        Schema::dropIfExists('products_attris');
    }
};
