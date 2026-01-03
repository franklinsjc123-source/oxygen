<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
     public function create()
    {
        return view('layout.staff.activity.activity-create');
    }
    public function list()
    {
        return view('layout.staff.activity.activity-list');
    }
}
