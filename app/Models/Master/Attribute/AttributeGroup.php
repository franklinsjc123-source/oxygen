<?php

namespace App\Models\Master\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    use HasFactory;
	protected $table = 'attribute_group';

    protected $fillable = [
        'attribute_group_name',
        'attribute_group_refname',
        'attribute_values',
        'status',
        'created_by',
        'created_byid'
    ];
}
