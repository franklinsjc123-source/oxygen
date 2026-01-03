<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use App\Models\vendor\vendorcreate;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function create()
    {
        return view('layout.staff.vendor.vendor-create');
    }
    public function list()
    {

        $vendorlist = vendorcreate::All();
       // dd($vendorlist);
        return view('layout.staff.vendor.vendor-list')->with('vendorlist');
    }
}
