<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function create()
    {
        return view('layout.admin.auction.create-auction');
    }
    public function list()
    {
        return view('layout.admin.auction.list-auction');
    }
}
