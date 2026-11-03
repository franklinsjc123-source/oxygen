<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateVendorToSellerInMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update main menu
        DB::table('main_menu')
            ->where('title', 'like', '%Vendor%')
            ->orWhere('id', 12)
            ->update([
                'title' => 'Sellers',
                'updated_at' => now(),
            ]);

        // Update sub menus
        DB::table('sub_menu')
            ->where('title', 'Vendor List')
            ->update([
                'title' => 'Seller List',
                'updated_at' => now(),
            ]);

        DB::table('sub_menu')
            ->where('title', 'Create Vendor')
            ->update([
                'title' => 'Create Seller',
                'updated_at' => now(),
            ]);

        DB::table('sub_menu')
            ->where('title', 'Vendor Product List')
            ->update([
                'title' => 'Seller Product List',
                'updated_at' => now(),
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('main_menu')
            ->where('id', 12)
            ->update([
                'title' => 'Vendors',
                'updated_at' => now(),
            ]);

        DB::table('sub_menu')
            ->where('id', 31)
            ->update([
                'title' => 'Vendor List',
                'updated_at' => now(),
            ]);

        DB::table('sub_menu')
            ->where('id', 32)
            ->update([
                'title' => 'Create Vendor',
                'updated_at' => now(),
            ]);

        DB::table('sub_menu')
            ->where('id', 10)
            ->update([
                'title' => 'Vendor Product List',
                'updated_at' => now(),
            ]);
    }
}

