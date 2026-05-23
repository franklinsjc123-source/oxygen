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
        if (!Schema::hasColumn('sub_category_mapping', 'vendor_id')) {
            Schema::table('sub_category_mapping', function (Blueprint $table) {
                $table->unsignedBigInteger('vendor_id')->nullable()->after('sub_category_id');
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
        if (Schema::hasColumn('sub_category_mapping', 'vendor_id')) {
            Schema::table('sub_category_mapping', function (Blueprint $table) {
                $table->dropColumn('vendor_id');
            });
        }
    }
};
