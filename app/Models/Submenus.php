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
        static::addGlobalScope('custom_order', function ($builder) {
            $builder->orderByRaw("CASE 
                WHEN link = 'products.crud.listing' THEN 1
                WHEN link = 'products.crud.index' THEN 2
                WHEN link = 'attribute_groups.index' THEN 3
                WHEN link = 'specification_groups.admin.index' THEN 4
                ELSE 99
            END ASC")->orderBy('id', 'asc');
        });
    }
}

