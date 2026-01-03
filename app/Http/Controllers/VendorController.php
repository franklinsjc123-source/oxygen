<?php

namespace App\Http\Controllers;
use App\Models\vendor\vendorcreate;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function create()
    {
        return view('layout.admin.vendor.vendor-create');
    }
    public function list()
    {

        $vendorlist = vendorcreate::All();
       // dd($vendorlist);
        return view('layout.admin.vendor.vendor-list')->with('vendorlist');
    }
}
