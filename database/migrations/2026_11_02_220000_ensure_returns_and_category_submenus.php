<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class EnsureReturnsAndCategorySubmenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Ensure 'Returns & Replacements' exists under Sales (main_menu = 4)
        $returns = DB::table('sub_menu')->where('link', 'returns')->first();
        if ($returns) {
            DB::table('sub_menu')->where('link', 'returns')->update([
                'main_menu' => 4,
                'title' => 'Returns & Replacements',
                'type' => 'route',
                'updated_at' => now(),
            ]);
        } else {
            DB::table('sub_menu')->insert([
                'main_menu' => 4,
                'title' => 'Returns & Replacements',
                'type' => 'route',
                'link' => 'returns',
                'route' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 2. Ensure 'Attributes' and 'Specification' are under Category (main_menu = 2)
        DB::table('sub_menu')
            ->where(function ($q) {
                $q->whereIn('link', ['attribute_groups.index', 'specification_groups.admin.index'])
                  ->orWhereIn('title', ['Attributes', 'Specification']);
            })
            ->update([
                'main_menu' => 2,
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
        // No-op rollback
    }
}
