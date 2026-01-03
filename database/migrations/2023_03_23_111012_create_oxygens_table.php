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
        Schema::create('oxygens_promo', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id');
            $table->string('amount');
            $table->string('impressions');
            $table->string('clicks'); 
            $table->string('duration');
            $table->string('status');
            $table->string('image');            
            $table->string('text');
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
        Schema::dropIfExists('oxygens');
    }
};
