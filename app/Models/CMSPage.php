<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMSPage extends Model
{
    protected $table = 'cmspage';
    protected $fillable = [
        'page_name',
        'page_title',
        'page_content',
        'status',
    ];
}