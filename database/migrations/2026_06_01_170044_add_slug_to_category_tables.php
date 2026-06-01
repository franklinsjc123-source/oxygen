<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        Schema::table('category_main', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('category_main_name');
        });

        Schema::table('category', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('category_name');
        });

        Schema::table('category_sub', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('category_sub_name');
        });

        // Generate slugs for category_main
        $mains = \DB::table('category_main')->get();
        foreach ($mains as $main) {
            $slug = Str::slug($main->category_main_name);
            $existing = \DB::table('category_main')->where('slug', $slug)->where('id', '!=', $main->id)->exists();
            if ($existing) $slug = $slug . '-' . $main->id;
            \DB::table('category_main')->where('id', $main->id)->update(['slug' => $slug]);
        }

        // Generate slugs for category
        $cats = \DB::table('category')->get();
        foreach ($cats as $cat) {
            $slug = Str::slug($cat->category_name);
            $existing = \DB::table('category')->where('slug', $slug)->where('id', '!=', $cat->id)->exists();
            if ($existing) $slug = $slug . '-' . $cat->id;
            \DB::table('category')->where('id', $cat->id)->update(['slug' => $slug]);
        }

        // Generate slugs for category_sub
        $subs = \DB::table('category_sub')->get();
        foreach ($subs as $sub) {
            $slug = Str::slug($sub->category_sub_name);
            $existing = \DB::table('category_sub')->where('slug', $slug)->where('id', '!=', $sub->id)->exists();
            if ($existing) $slug = $slug . '-' . $sub->id;
            \DB::table('category_sub')->where('id', $sub->id)->update(['slug' => $slug]);
        }
    }

    public function down()
    {
        Schema::table('category_main', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('category', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
        Schema::table('category_sub', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
