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
        Schema::create('coupans', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('title');
            $table->string('coupon_code');
            $table->string('discount_type');
            $table->string('discount_amount');
            $table->string('discount_percentage');
            $table->string('minimum_requirment_type');
            $table->string('minimum_requirment_amount');
            $table->string('minimum_requirment_quantity');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('created_by');
            $table->string('status');
            $table->string('flag');
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
        Schema::dropIfExists('coupans');
    }
};
