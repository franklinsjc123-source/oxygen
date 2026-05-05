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
            $table->text('sub_category_ids')->nullable()->after('specification_values');
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
            $table->dropColumn('sub_category_ids');
        });
    }
};
