<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            DB::statement("ALTER TABLE `vendor_details` MODIFY `gst_number` VARCHAR(50) NULL");
        } catch (\Throwable $e) {
            if (Schema::hasTable('vendor_details')) {
                Schema::table('vendor_details', function (Blueprint $table) {
                    if (Schema::hasColumn('vendor_details', 'gst_number')) {
                        $table->string('gst_number', 50)->nullable()->change();
                    } else {
                        $table->string('gst_number', 50)->nullable();
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

