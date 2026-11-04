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
        if (Schema::hasTable('seller_leads')) {
            Schema::table('seller_leads', function (Blueprint $table) {
                if (!Schema::hasColumn('seller_leads', 'pincode')) {
                    $table->string('pincode', 20)->nullable()->after('city');
                }
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
        if (Schema::hasTable('seller_leads')) {
            Schema::table('seller_leads', function (Blueprint $table) {
                if (Schema::hasColumn('seller_leads', 'pincode')) {
                    $table->dropColumn('pincode');
                }
            });
        }
    }
};

