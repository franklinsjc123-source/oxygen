<?php
namespace App\Http\Controllers\user\getproduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Products\ProductsDetails;
use App\Models\Products\Products;

class AjaxGetProductController extends Controller
{
    public function ajaxAdd(Request $request)
	{
		//Session::flush();
		$id = $request->input('product_id');
		$name = $request->input('product_name');
		$price = $request->input('product_price');
		$qnty = $request->input('product_qnty');
		$size = $request->input('product_size');
		//$image = $request->input('product_image');
		
		$session = $request->session();
		// dd($session);
		$cartData = ($session->get('cart')) ? $session->get('cart') : array();
		//dd($cartData);
		if (array_key_exists($id, $cartData)) {
			$product = ProductsDetails::join('products','products.product_id','=','products_details.products_id')->where('products_details.id', '=', $id)->get()->toArray();
            // print_r($product);
			// print_r($product['0']['product_detail_image']);
			// exit();
			$cartData[$id]['image'] =  $product['0']['product_detail_image'];
			$cartData[$id]['pid'] = $id;
			$cartData[$id]['qty'] = $qnty;
			$cartData[$id]['size'] = $size;
			$cartData[$id]['name'] = $name;
			$cartData[$id]['price'] = $price;
		} else {
			$product = ProductsDetails::join('products','products.product_id','=','products_details.products_id')->where('products_details.id', '=', $id)->get()->toArray();
			$cartData[$id]['image'] =  $product['0']['product_detail_image'];
			$cartData[$id]['pid'] = $id;
			$cartData[$id]['qty'] = $qnty;
			$cartData[$id]['size'] = $size;
			$cartData[$id]['name'] = $name;
			$cartData[$id]['price'] = $price;
		}
		$n = 0;
		if ($request->session()->has('cart')) {
			foreach ($cartData as $key => $value) {
				$n++;
			}
		}
		$request->session()->put('cart', $cartData);
		$cart_qty =  Session::get('cart') ? array_sum(array_column(Session::get('cart'), 'qty')) : 0;
		//return redirect()->back()->with('message', 'product Added Successfully!');

		return response()->json(['msg' => $cart_qty], 200);
	}

    public function getcart(Request $request)
	{
        //echo 'test';
		//Session::flush();
		 $cartData = $request->session()->get('cart');
		// dd($cartData);
		 $cart = [];
		 $sum = 0;

		 if ($request->session()->has('cart')) {
		 	foreach ($cartData as $key => $value) {
		 		$product = ProductsDetails::where('id', '=', $key)->get()->toArray();
		 		$cart_item['image'] =  $product['0']['product_detail_image'];
		 		$cart_item['foodtype'] =  '';
		 		$cart_item['pid'] =  $value['pid'];
		 		$cart_item['name'] =  $value['name'];
		 		$cart_item['price'] = $value['price'];
		 		$cart_item['size'] = $value['size'];
		 		$cart_item['total_price'] = $value['qty'] * $value['price'];
		 		$cart_item['qty'] = $value['qty'];
		 		$sum = $sum + $cart_item['total_price'];
		 		array_push($cart, $cart_item);
		 	}
		 }
		 $n = 0;
		 if ($request->session()->has('cart')) {
		 	foreach ($cartData as $key => $value) {
		 		$n += $value['qty'];
		 	}
		 }
		 $request->session()->put('cartcount', $n);
		 // $wishlist=wishlist::where ('ecom_wishlist_ipaddress' ,\Request::ip())->get();
		// // $wishCount = count($wishlist);
		 return response()->json(['cart' => $cart, 'sum' => $sum, 'count' => $n], 200);
		// //return json_encode($service);
	}

	public function viewcart()
	{
		return view('website.front-end.cart');
	}

	public function checkout()
	{
		return view('website.front-end.checkout');
	}

	public function checklogin()
	{
		
		 return view('website.front-end.checklogin');
	}


	
	public function order_success()
	{
		
		 return view('website.front-end.order-success');
	}

	
	public function delete(Request $request)
	{
		$id = $request->input('product_id');
		$session = $request->session();
		$cartData = $session->get('cart');

		if (array_key_exists($id, $cartData)) {
			unset($cartData[$id]);
		}
		$request->session()->put('cart', $cartData);
		$cartTotal = 0;
		foreach ($cartData as $cartItem) {
			$cartTotal = $cartTotal + $cartItem['qty'];
		}

		$request->session()->put('total', $cartTotal);


		//return back();

		return response()->json(['msg' => 'success'], 200);
	}
}

