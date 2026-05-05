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
        Schema::table('specification_group', function (Blueprint $table) {
            $table->text('vendor_ids')->nullable()->after('sub_category_ids');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('specification_group', function (Blueprint $table) {
            $table->dropColumn('vendor_ids');
        });
    }
};
