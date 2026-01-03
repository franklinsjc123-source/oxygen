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
        Schema::create('paid_advs', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id');
            $table->string('title');
            $table->string('sub_title');
            $table->string('image'); 
            $table->string('link'); 
            $table->string('sort'); 
            $table->string('start_date');
            $table->string('end_date');
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
        Schema::dropIfExists('paid_advs');
    }
};
