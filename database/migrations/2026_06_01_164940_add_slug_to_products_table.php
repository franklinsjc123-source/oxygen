<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('product_name');
        });

        // Generate slugs for all existing products
        $products = \DB::table('products')->get();
        foreach ($products as $product) {
            $slug = Str::slug($product->product_name);

            // Ensure uniqueness by appending ID if duplicate
            $existing = \DB::table('products')->where('slug', $slug)->where('id', '!=', $product->id)->exists();
            if ($existing) {
                $slug = $slug . '-' . $product->id;
            }

            \DB::table('products')->where('id', $product->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
