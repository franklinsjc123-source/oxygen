<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function facebook()
    {
        return view('layout.vendar.marketing.facebook');
    }
    public function instagram()
    {
        return view('layout.admin.marketing.instagram');
    }
    public function whatsapp()
    {
        return view('layout.vendar.marketing.whatsapp');
    }
    public function oxygen()
    {
        return view('layout.admin.marketing.oxygen');
    }
}
