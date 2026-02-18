<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;
use App\Models\Category\CategoryMain;
use App\Models\Category\Category;
use App\Models\Category\CategorySub;
use App\Models\Products\productcollection;
use App\Models\Products\Products;
use App\Models\Master\Offers\Offers;
use App\Models\User\Userreg;
use App\Models\User;
use App\Models\Banners\mainslider;
use App\Models\Banners\oxygen_adv;
use App\Models\Banners\paid_adv;
use App\Models\bidamount;
use Illuminate\Http\Request;
use App\Models\Products\ProductsDetails;
use App\Models\vendor\vendorcreate;
use App\Models\vendor\Category\CategoryMain as vendorcategorymain;
use App\Models\vendor\Category\Category as vendorcategory;
use App\Models\vendor\Category\CategorySub as vendorcategorysub;
use App\Models\Ecom_Orders;
use App\Models\Ecom_Order_product;
use App\Models\Ecom_Customer_info;
use App\Models\wishlist;

use Illuminate\Support\Facades\Session;
use DB;

class CartController extends Controller
{
	public function index(Request $request)
	{
		$cartData = $request->session()->get('cart');
		$cart = [];
		$sum = 0;
		if ($request->session()->has('cart')) {
			foreach ($cartData as $key => $value) {

				$product = ProductsDetails::where('id', '=', $key)->first();
				$cart_item['item'] = $product;
				$cart_item['total_price'] = $value['qty'] * $product['selling_price'];
				$cart_item['qty'] = $value['qty'];
				$sum = $sum + $cart_item['total_price'];
				array_push($cart, $cart_item);
			}
		}
		return view('frontview.checkout')->with('cart', $cart)->with('sum', $sum);
	}
	public function viewcart(Request $request)
	{
		//Session::flush();
		$cartData = $request->session()->get('cart');
		$cart = [];
		$sum = 0;
		$n = 0;
		if ($request->session()->has('cart')) {
			foreach ($cartData as $key => $value) {
				$n += $value['qty'];
				$product = Ecom_Product::where('ecom_product_id', '=', $key)->get()->toArray();
				$cart_item['image'] =  $product['0']['ecom_product_images_first'];
				$cart_item['foodtype'] = '';
				$cart_item['pid'] =  $value['pid'];
				$cart_item['name'] =  $value['name'];
				$cart_item['price'] = $value['price'];				
				$cart_item['mrp'] = $product['0']['retail_price'];
				$cart_item['size'] = $value['size'];
				$cart_item['gstin'] = $product['0']['product_gstin'];
				$cart_item['total_price'] = $value['qty'] * $value['price'];
				$cart_item['qty'] = $value['qty'];
				$sum = $sum + $cart_item['total_price'];
				array_push($cart, $cart_item);
			}
		}
		//dd($cart);
		return view('checkout')->with('cart', $cart)->with('sum', $sum)->with('count', $n);
	}

	public function postAdd(Request $request)
	{
		$id = $request->input('product_id');
		$session = $request->session();
		$cartData = ($session->get('cart')) ? $session->get('cart') : array();
		if (array_key_exists($id, $cartData)) {
			$cartData[$id]['qty']++;
		} else {
			$cartData[$id] = array(
				'qty' => 1
			);
		}
		$n = 0;
		if ($request->session()->has('cart')) {
			foreach ($cartData as $key => $value) {
				$n++;
			}
		}
		$request->session()->put('cartcount', $n);
		$request->session()->put('cart', $cartData);

		return redirect()->back()->with('message', 'product Added Successfully!');
	}

	public function ajaxAdd(Request $request)
	{
		//Session::flush();
		$id = $request->input('product_id');
		$name = $request->input('product_name');
		$price = $request->input('product_price');
		$qnty = $request->input('product_qnty');
		$size = $request->input('product_size');
		$color = $request->input('product_color', '');

		$session = $request->session();
		$cartData = ($session->get('cart')) ? $session->get('cart') : array();
		if (array_key_exists($id, $cartData)) {
			$product = ProductsDetails::where('id', '=', $id)->get()->toArray();
			$productMain = Products::where('product_id', '=', $product['0']['products_id'])->first();
			$images=explode(',',$product['0']['product_detail_image']);
			$cartData[$id]['image'] = $images[0];
			$cartData[$id]['pid'] = $id;
			$cartData[$id]['qty'] = $qnty;
			
			$cartData[$id]['size'] = $size;
			$cartData[$id]['color'] = $color;
			$cartData[$id]['name'] = $name;
			$cartData[$id]['price'] = $price;
			$cartData[$id]['gst'] = $productMain ? $productMain->gst_id : 0;
			
			$cartData[$id]['mrp'] = $product['0']['retail_price'];
		} else {
			$product = ProductsDetails::where('id', '=', $id)->get()->toArray();
			$productMain = Products::where('product_id', '=', $product['0']['products_id'])->first();
			$images=explode(',',$product['0']['product_detail_image']);
			$cartData[$id]['image'] = $images[0];
			$cartData[$id]['pid'] = $id;
			$cartData[$id]['qty'] = $qnty;
			$cartData[$id]['size'] = $size;
			$cartData[$id]['color'] = $color;
			$cartData[$id]['name'] = $name;
			$cartData[$id]['price'] = $price;
			$cartData[$id]['gst'] = $productMain ? $productMain->gst_id : 0;
			$cartData[$id]['mrp'] = $product['0']['retail_price'];
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
	public function clear_cart()
	{
		session()->forget('cart');
		return redirect()->back()->with('success', 'Your cart cleard!');
	}
	public function getcart(Request $request)
	{
		//Session::flush();
		$cartData = $request->session()->get('cart');
		$cart = [];
		$sum = 0;

		if ($request->session()->has('cart')) {
			foreach ($cartData as $key => $value) {
				$product = ProductsDetails::where('id', '=', $key)->get()->toArray();
				$images=explode(',',$product['0']['product_detail_image']);
				$cart_item['image'] = $images['0'];
				$cart_item['foodtype'] =  '';
				$cart_item['pid'] =  $value['pid'];
				$cart_item['name'] =  $value['name'];
				$cart_item['price'] = $value['price'];
				$cart_item['size'] = $value['size'];
				$cart_item['total_price'] = $value['qty'] * $value['price'];
				$cart_item['qty'] = $value['qty'];
				$cart_item['mrp'] = $product['0']['retail_price'];
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
		$ip = $request->ip();
		$request->session()->put('cartcount', $n);
		$wishlist=wishlist::where ('ecom_wishlist_ipaddress' ,$ip)->get();
		$wishCount = count($wishlist);
		//$wishCount = 0;
		return response()->json(['cart' => $cart, 'sum' => $sum, 'count' => $n,'wishcount'=> $wishCount], 200);
		//return json_encode($service);
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
	public function updatecart(Request $request)
	{
		$id = $request->input('product_id');
		$qnty = $request->input('product_qnty');

		$session = $request->session();
		$cartData = ($session->get('cart')) ? $session->get('cart') : array();
		if (array_key_exists($id, $cartData)) {
			$cartData[$id]['pid'] = $id;
			$cartData[$id]['qty'] = $qnty;
		} else {
		}
		$request->session()->put('cart', $cartData);
		$cart_qty =  Session::get('cart') ? array_sum(array_column(Session::get('cart'), 'qty')) : 0;
		//return redirect()->back()->with('message', 'product Added Successfully!');

		return response()->json(['msg' => 'success'], 200);
	}

	public function GetCity(Request $request)
	{

		$pincode = $request->id;
		$getpincode = Ecom_Pincode::where(['pincode' => $pincode])->first();
		$count1 = Ecom_Pincode::where(['pincode' => $pincode])->count();


		if ($count1 > 0) {

			$city = $getpincode->district;
			$state = $getpincode->state;
			return response()->json(['city' => $city, 'state' => $state, 'msg' => 'Success'], 200);
		} else {
			return response()->json(['msg' => 'Failed'], 200);
		}
	}
	public function placeorder(Request $request)
	{
		$customerFirstname = $request->input('customer_firstname', $request->input('firstname', ''));
		$customerLastname = $request->input('customer_lastname', $request->input('lastname', ''));
		$customerEmail = $request->input('customer_email', $request->input('email', ''));
		$customerMobile = $request->input('customer_mobileno', $request->input('phone', ''));
		$customerAddress = $request->input('customer_address', $request->input('address', ''));
		$customerAddress1 = $request->input('customer_address1', $request->input('address1', ''));
		$customerCity = $request->input('customer_city', $request->input('town', ''));
		$customerState = $request->input('customer_state', $request->input('state', ''));
		$customerPincode = $request->input('customer_pincode', $request->input('postelcode', ''));
		$paymentType = $request->input('payment_type', $request->input('payment-group', 'cashondelivery'));
		$discountAmount = $request->input('discount_amount', $request->input('discount2', 0));
		$shippingCharge = $request->input('shipping_charge', $request->input('shipping', 0));
		$gstCharge = $request->input('gst_charge', $request->input('gst', 0));
		$totalAmount = $request->input('total_amount', $request->input('total', 0));
		$grandTotal = $request->input('grand_total', $request->input('grandtotal', 0));
		$couponCode = $request->input('coupon_code', $request->input('discountCode', ''));
		$customerCompanyName = $request->input('customer_company_name', '');

		if (trim((string) $customerMobile) === '') {
			return redirect()->back()->with('error', 'Phone number is required for placing order.');
		}

		$customer_id = Session::get('customer_id');
		//dd($customer_id);
		if ($customer_id == '') {

			$cusdata = Ecom_Customer_info::where('customer_mobileno', '=', $customerMobile)->first();
			$cuscount = Ecom_Customer_info::where('customer_mobileno', '=', $customerMobile)->count();
			if ($cuscount == 0) {
				$statement = DB::select("SHOW TABLE STATUS LIKE 'ecom_customer_info'");
				$next_customer_id = $statement[0]->Auto_increment;
				$customer_id = "OXY-C" . str_pad($next_customer_id, 5, "0", STR_PAD_LEFT);
				$customer = new Ecom_Customer_info;
				$customer->customer_id = $customer_id;
				$customer->customer_firstname = $customerFirstname;
				$customer->customer_lastname = $customerLastname;
				$customer->customer_email = $customerEmail;
				$customer->customer_mobileno = $customerMobile;
				$customer->customer_address = $customerAddress;
				$customer->customer_address1 = $customerAddress1;
				$customer->customer_city = $customerCity;
				$customer->customer_state = $customerState;
				$customer->customer_pincode = $customerPincode;
				$customer->customer_password = base64_encode(base64_encode('welcome'));
				$customer->save();
				Session::put('customer_id', $customer_id);
			} else {
				$customer_id = $cusdata->customer_id;
				Session::put('customer_id', $customer_id);
			}
		} else {
			$customer_id = Session::get('customer_id');
			// customer shipping address update start
			Ecom_Customer_info::where('customer_id', $customer_id)->update(
				[
					'customer_email' => $customerEmail,
					'customer_address' => $customerAddress,
					'customer_address1' => $customerAddress1,
					'customer_city' => $customerCity,
					'customer_state' => $customerState,
					'customer_pincode' => $customerPincode
				]
			);
			// customer shipping address update End
		}
		// Order inser start
		$statement = DB::select("SHOW TABLE STATUS LIKE 'ecom_order_info'");
		$next_id = $statement[0]->Auto_increment;
		$order_id = "OXY-O" . str_pad($next_id, 4, "0", STR_PAD_LEFT);
		$order = new Ecom_Orders;
		$order->order_id = $order_id;
		$order->delivery_type = 'Normal';
		$order->customer_id = $customer_id;
		$order->customer_firstname = $customerFirstname;
		$order->customer_lastname = $customerLastname;
		$order->customer_company_name = $customerCompanyName;
		$order->customer_email = $customerEmail;
		$order->customer_mobileno = $customerMobile;
		$order->customer_address = $customerAddress;
		$order->customer_address1 = $customerAddress1;
		$order->customer_city = $customerCity;
		$order->customer_state = $customerState;
		$order->customer_pincode = $customerPincode;

		$order->payment_type = $paymentType;

		$order->discount_amount = $discountAmount;
		$order->shipping_charge = $shippingCharge;

		$order->gst_charge = $gstCharge;
		$order->total_amount = $totalAmount;

		$order->grand_total = $grandTotal;

		$order->coupon_code = $couponCode;
		$order->order_status = 'Pending';
		$order->payment_status = 'Pending';
		$order->order_date = date('Y-m-d H:i:s');
		$order->save();
		// order insert end
		$email=$customerEmail;

		// Order Product insert start
		$cartData = $request->session()->get('cart');
		$cart = [];
		$sum = 0;

		if ($request->session()->has('cart')) {
			foreach ($cartData as $key => $value) {

				$product =  ProductsDetails::where('id', '=', $key)->first();
				$images=explode(',',$product->product_detail_image);
				$img=substr($images[0], 2, -1);
				$products =  Products::where('product_id', '=', $product->products_id)->first();
				//dd($products);
				$order_product = new Ecom_Order_product;

				$order_product->product_gstin = $products->gst_id;
				$order_product->order_id = $order_id;
				$order_product->product_id = $value['pid'];
				$order_product->product_name = $value['name'];
				$order_product->product_image = $img;

				$order_product->product_size = $value['size'];
				$order_product->product_quantity = $value['qty'];
				$order_product->product_price = $value['price'];
				$order_product->total_price = $value['qty'] * $value['price'];
				$order_product->order_status = 'Pending';
				$order_product->save();
			}
		}

		Session::forget('cart');
		// Order Product insert end 
		Session::put('order_id', $order_id);

		$details = ['order_id' => $order_id];
		//$sendmail= \Mail::to($email)->send(new \App\Mail\OrderMail($details));
		//return redirect('/Successful');
		return redirect()->route('order_success', ['orders_id' => $order_id]);
	}
	public function order_list(Request $request, $id)
	{
		$order = Ecom_Orders::where('order_id', $id)->first();
		$order_product = Ecom_Order_product::where('order_id', '=', $id)->get();
		
		if($order)
        return view('frontend/order', compact('order', 'order_product'));      
        else
        return Redirect('/404');
	}
	public function neworder(Request $request)
	{
		$orderlist = Ecom_Orders::where('order_status', '=', 'Pending')->orderBy('id', 'DESC')->get();
		$neworder = $orderlist->count();
		return response()->json(['neworder' => $neworder], 200);
	}
}
