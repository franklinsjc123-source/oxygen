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
        if (!Schema::hasTable('rm_ratings')) {
            Schema::create('rm_ratings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('staff_id');
                $table->unsignedBigInteger('vendor_id');
                $table->unsignedTinyInteger('rating')->default(5);
                $table->text('review')->nullable();
                $table->timestamps();

                $table->unique(['staff_id', 'vendor_id'], 'unique_staff_vendor');
                $table->index('staff_id');
                $table->index('vendor_id');
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
        Schema::dropIfExists('rm_ratings');
    }
};

