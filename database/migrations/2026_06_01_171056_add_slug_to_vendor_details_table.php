<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        Schema::table('vendor_details', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('shop_name');
        });

        // Generate slugs for existing vendors based on shop_name
        $vendors = \DB::table('vendor_details')->get();
        foreach ($vendors as $vendor) {
            $shopName = $vendor->shop_name ?: 'shop';
            $slug = Str::slug($shopName);
            $existing = \DB::table('vendor_details')->where('slug', $slug)->where('id', '!=', $vendor->id)->exists();
            $counter = 1;
            while ($existing) {
                $slug = Str::slug($shopName) . '-' . $counter;
                $existing = \DB::table('vendor_details')->where('slug', $slug)->where('id', '!=', $vendor->id)->exists();
                $counter++;
            }
            \DB::table('vendor_details')->where('id', $vendor->id)->update(['slug' => $slug]);
        }
    }

    public function down()
    {
        Schema::table('vendor_details', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
