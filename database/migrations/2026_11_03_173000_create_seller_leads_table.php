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
        if (!Schema::hasTable('seller_leads')) {
            Schema::create('seller_leads', function (Blueprint $table) {
                $table->id();
                $table->string('shop_name');
                $table->string('owner_name');
                $table->string('mobile_number', 20);
                $table->string('email')->nullable();
                $table->string('city', 100)->nullable();
                $table->string('business_category', 100)->nullable();
                $table->string('gstin', 50)->nullable();
                $table->string('uin', 50)->nullable();
                $table->text('address')->nullable();
                $table->text('message')->nullable();
                $table->string('status', 50)->default('Pending');
                $table->text('admin_notes')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_leads');
    }
};

