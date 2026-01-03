<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
     public function create()
    {
        return view('layout.admin.activity.activity-create');
    }
    public function list()
    {
        return view('layout.admin.activity.activity-list');
    }
}
