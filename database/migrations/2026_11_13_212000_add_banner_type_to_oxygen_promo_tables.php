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
        Schema::table('vendor_oxygens_promo', function (Blueprint $table) {
            if (!Schema::hasColumn('vendor_oxygens_promo', 'banner_type')) {
                $table->string('banner_type', 50)->default('trymenow_adv')->after('package_id');
            }
        });

        Schema::table('oxygens_promo', function (Blueprint $table) {
            if (!Schema::hasColumn('oxygens_promo', 'banner_type')) {
                $table->string('banner_type', 50)->default('all')->after('duration');
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
        Schema::table('vendor_oxygens_promo', function (Blueprint $table) {
            if (Schema::hasColumn('vendor_oxygens_promo', 'banner_type')) {
                $table->dropColumn('banner_type');
            }
        });

        Schema::table('oxygens_promo', function (Blueprint $table) {
            if (Schema::hasColumn('oxygens_promo', 'banner_type')) {
                $table->dropColumn('banner_type');
            }
        });
    }
};
