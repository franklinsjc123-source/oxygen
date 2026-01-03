<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banner()
    {
        return view('layout.admin.banner.advbanner');
    }
    public function oxygen()
    {
        return view('layout.admin.banner.advoxygen');
    }
    public function slider()
    {
        return view('layout.admin.banner.slider');
    }
}
