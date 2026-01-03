<?php

namespace App\Models\Master\Specification;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecificationGroup extends Model
{
    use HasFactory;
	protected $table = 'specification_group';

    protected $fillable = [
        'specification_group_name',
        'specification_group_refname',
        'specification_values',
        'status',
        'created_by',
        'created_byid'
    ];
}
