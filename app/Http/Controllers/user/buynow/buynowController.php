<?php

namespace App\Http\Controllers\user\buynow;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Products\ProductsDetails;
use App\Models\Products\Products;
use App\Models\order\orders;
use App\Models\order\ordersproduct;
use App\Models\coupon\coupon;
use App\Models\auction\auction;
use App\Models\User\rating;
use DB;
use Image;
use DateTime;
use Illuminate\Support\Facades\DB as FacadesDB;

class buynowController extends Controller
{
    public function buynow(Request $request)
	{
	     return 'test';
        // return redirect('buynow');
		//    return view('website.front-end.buynow');
		// exit;
		// $id = $request->input('product_id');
		// $name = $request->input('product_name');
		// $price = $request->input('product_price');
		// $qnty = $request->input('product_qnty');
		// $size = $request->input('product_size');

		// $buy = [$id,$name,$price,$qnty,$size];
		// // //  print_r($buy);

		// // // exit;
		// // //return redirect('website.front-end.buynow');
		// // // $html = view('layouts.partials.cities')->with(compact('cities'))->render();
		// // $html = view('website.front-end.buynow')->
		// // 	with([
		// // 	    "buy"=>$buy
			   
		// // 	   ]);
		// 	   return response()->json(['success' => true, 'buy' => $buy]);

	}
}
