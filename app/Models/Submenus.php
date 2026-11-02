<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submenus extends Model
{
    use HasFactory;
	
    protected $table = 'sub_menu';

    protected static function booted()
    {
        try {
            \Illuminate\Support\Facades\DB::table('sub_menu')->updateOrInsert(
                ['link' => 'returns'],
                [
                    'main_menu' => 4,
                    'title' => 'Returns & Replacements',
                    'type' => 'route',
                    'link' => 'returns',
                    'route' => '',
                ]
            );

            \Illuminate\Support\Facades\DB::table('sub_menu')
                ->where(function ($q) {
                    $q->whereIn('link', ['attribute_groups.index', 'specification_groups.admin.index'])
                      ->orWhereIn('title', ['Attributes', 'Specification']);
                })
                ->where('main_menu', '!=', 2)
                ->update(['main_menu' => 2]);
        } catch (\Throwable $e) {
            // Silently pass if database is not reachable or during early bootstrap
        }

        static::addGlobalScope('custom_order', function ($builder) {
            $builder->orderByRaw("CASE 
                WHEN link = 'products.crud.listing' THEN 1
                WHEN link = 'products.crud.index' THEN 2
                WHEN link = 'product_colors.index' THEN 3
                WHEN link = 'productcollection.master.index' THEN 4
                WHEN link = 'category.main.index' THEN 5
                WHEN link = 'category.index' THEN 6
                WHEN link = 'category.sub.index' THEN 7
                WHEN link = 'attribute_groups.index' THEN 8
                WHEN link = 'specification_groups.admin.index' THEN 9
                WHEN link = 'order' THEN 10
                WHEN link = 'transaction' THEN 11
                WHEN link = 'returns' THEN 12
                WHEN link = 'department' THEN 30
                WHEN link = 'designation.master.index' THEN 31
                WHEN link = 'staffrole.index' THEN 32
                ELSE 99
            END ASC")->orderBy('id', 'asc');
        });
    }
}

