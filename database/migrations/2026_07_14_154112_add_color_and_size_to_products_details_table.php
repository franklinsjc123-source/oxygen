<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products_details', function (Blueprint $table) {
            if (!Schema::hasColumn('products_details', 'color')) {
                $table->string('color')->nullable()->after('product_detail_image');
            }
            if (!Schema::hasColumn('products_details', 'size')) {
                $table->string('size')->nullable()->after('color');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_details', function (Blueprint $table) {
            if (Schema::hasColumn('products_details', 'color')) {
                $table->dropColumn('color');
            }
            if (Schema::hasColumn('products_details', 'size')) {
                $table->dropColumn('size');
            }
        });
    }
};
