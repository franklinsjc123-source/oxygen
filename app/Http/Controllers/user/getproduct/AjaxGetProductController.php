<?php
namespace App\Http\Controllers\user\getproduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Products\ProductsDetails;
use App\Models\Products\Products;
use App\Models\order\Orders;
use App\Models\order\ordersproduct;
use App\Models\coupon\coupon;
use App\Models\auction\auction;
use App\Http\Controllers\user\PhonePecontroller;
use App\Models\User\Userreg;
use App\Models\User;
use App\Models\User\rating;
use DB;
use Image;
use DateTime;
use Illuminate\Support\Facades\DB as FacadesDB;

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
		$color = $request->input('product_color');
		//$image = $request->input('product_image');
		
		$session = $request->session();
		// dd($session);
		$cartData = ($session->get('cart')) ? $session->get('cart') : array();
		//dd($cartData);
		if (array_key_exists($id, $cartData)) {
			$product = ProductsDetails::join('products','products.product_id','=','products_details.products_id')->where('products_details.id', '=', $id)->get()->toArray();
            // $product1 = Products::where('product_id', '=',  $value['pid'])->get();
			// print_r($product);
			// print_r($product['0']['product_detail_image']);
			// exit();
			$cartData[$id]['image'] =  $product['0']['product_detail_image'];
			$cartData[$id]['pid'] = $id;
			$cartData[$id]['qty'] = $qnty;
			$cartData[$id]['size'] = $size;
			$cartData[$id]['color'] = $color;
			$cartData[$id]['gst'] = $product['0']['gst_id'];
			$cartData[$id]['name'] = $name;
			$cartData[$id]['price'] = $price;
		} else {
			$product = ProductsDetails::join('products','products.product_id','=','products_details.products_id')->where('products_details.id', '=', $id)->get()->toArray();
			$cartData[$id]['image'] =  $product['0']['product_detail_image'];
			$cartData[$id]['pid'] = $id;
			$cartData[$id]['qty'] = $qnty;
			$cartData[$id]['size'] = $size;
			$cartData[$id]['color'] = $color;
			$cartData[$id]['gst'] = $product['0']['gst_id'];
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
	public function updatecart(Request $request)
	{
		$id = $request->input('product_id');
		$qnty = $request->input('product_qnty');
		
		$product = ProductsDetails::join('products','products.product_id','=','products_details.products_id')->where('products_details.id', '=', $id)->get();
 		// dd($product->quantity);
		foreach($product as $product1)
		{
			if($product1->quantity >= $qnty)
			{

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
		else{
			echo "<acript> alert('Product not Found') </script>";
			
		}
	}
	}


	/*buy now start*/

	public function buynow(Request $request)
	{
		//  echo 'test';
		 $pro = $request->all();
		// dd($pro);
		$id = $request->input('product_id');
		$name = $request->input('hidden_name');
		$price_price = $request->input('product_price');
		$price_img = $request->input('product_image');
		$size = $request->input('sizee');
		$qnty = $request->input('quantity');
		// $buy = array("pro_id"=>"pro_id");
		 $buy = array("pro_id"=>$id,'pro_name'=>$name,'pro_price'=>$price_price,'pro_img'=>$price_img,'pro_size'=>$size,'pro_qnty'=>$qnty);
		//  $buy = ['pro_id'=>$id,'pro_name'=>$name,'pro_price'=>$price_price,'pro_img'=>$price_img,'pro_size'=>$size,'pro_qnty'=>$qnty];
		 return view('website.front-end.buynow')->
				with([
				    "buy"=>$buy
				   
				   ]);
		
		
		// dd($pro);
	// 	return view('website.front-end.buynow');
	// 	// exit;
	// 	// $id = $request->input('product_id');
	// 	// $name = $request->input('product_name');
	// 	// $price = $request->input('product_price');
	// 	// $qnty = $request->input('product_qnty');
	// 	// $size = $request->input('product_size');

	// 	// $buy = [$id,$name,$price,$qnty,$size];
	// 	// //  print_r($buy);

	// 	// // exit;
	// 	// //return redirect('website.front-end.buynow');
	// 	// // $html = view('layouts.partials.cities')->with(compact('cities'))->render();
	// 	// // $html = view('website.front-end.buynow')->
	// 	// // 	with([
	// 	// // 	    "buy"=>$buy
			   
	// 	// // 	   ]);
	// 	// 	   return response()->json(['success' => true, 'buy' => $buy]);

	}
	/*buy now end*/


    public function getcart(Request $request)
	{
        //echo 'test';
		//Session::flush();
		 $cartData = $request->session()->get('cart');
// 		 dd($cartData);
		 $cart = [];
		 $sum = 0;

		 if ($request->session()->has('cart')) {
		 	foreach ($cartData as $key => $value) {
		 	     
		 		$product = ProductsDetails::where('id', '=', $key)->get()->toArray();
                
				$product1 = Products::where('product_id', '=',  $product['0']['products_id'])->get();
				// dd($product1);
		 		$cart_item['image'] =  $product['0']['product_detail_image'];
		 		$cart_item['foodtype'] =  '';
		 		$cart_item['pid'] =  $value['pid'];
		 		$cart_item['name'] =  $value['name'];
		 		$cart_item['price'] = $value['price'];
		 		$cart_item['size'] = $value['size'];
				$cart_item['color'] = $value['color'];
				$cart_item['gst'] = $product1['0']['gst_id'];
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
		if(session('username')){
		    
		 return view('website.front-end.checklogin');
	    }
	    else{
	     return redirect()->route('userlogin');   
	    }
 		 
	}

	public function order_tracking($orders_id)
	{
		
		$order_info = orders::where('orders_id',$orders_id)->first(); 
		 return view('website.front-end.order_tracking')->
		 with([
			"orders_id"=>$orders_id,
			"order_info"=>$order_info
		]);
	}


	public function ordersdetails(Request $request)
	{
		
		$userId = session('userId');
		//dd($userId);
		 $orders = orders::where('User_id',$userId) ->orderBy('id', 'desc')->get(); 
		 if(sizeof($orders) > 0)
		 {
			// echo '1';
			// exit;
			$orders_product = array();
			for($i=0; $i<sizeof($orders); $i++)
			{
				$orders_id = $orders[$i]->orders_id;
				
				$orders_product1 = ordersproduct::where('order_id',$orders_id)->get(); 
				array_push($orders_product, $orders_product1);
			}
			// print_r($orders_product);
			// exit;
			 //dd($orders_product);
			return view('website.front-end.orders_details')->
			with([
			   "orders"=>$orders,
			   "orders_product"=>$orders_product
			   ]);
		 }

		
		 else
		 {
			// echo '2';
			// exit;
			return view('website.front-end.orders_details')->
			with([
			   "orders"=>$orders,
			//    "orders_product"=>$orders_product
			   ]);
		 }
		
	}



public function userprofile()
{
	
	return view('website.front-end.userprofile');
// 	->
// 	with([
// 	   "orders_id"=>$orders_id
	   
//    ]);
// }
}



public function ordersreturn($id)
{
	$userId = session('userId');
    //dd($userId);
	$orders = orders::where('User_id',$userId)->orderBy('id', 'desc')->get(); 
	$orders_product = orders::find($id);
    // 	dd($orders_product);
	$orders_id = $orders_product->orders_id;
	
    // 	$orders_product->order_status = 'Return';
	ordersproduct::where('id',$id)->update(['order_status'=>'Return']);
	
    Orders::where('id',$id)->update(['order_status'=>'Return']);
	$orders_product = orders::where('orders_id',$orders_id)->get(); 
	// return view('website.front-end.orders_status')->
	return view('website.front-end.orders_details')->
		 with([
			"orders"=>$orders,
			"orders_product"=>$orders_product
			]);
	
}
/*rating start*/
public function rating(Request $request)
{
	// echo 'test';
	$rating = new rating();

	$rating->products_id = $request->input('product_id');
	$rating->customer_name = $request->input('name');
	$rating->star_rating = $request->input('rating');
	$rating->comments = $request->input('comments');
	$rating->save();
	return redirect()->back()->with('flash_msg_success','Your review has been submitted Successfully,');
}
/*rating end*/



public function orderscancel($id)
{
	
	$userId = session('userId');
	
	$orders = orders::where('User_id',$userId) ->orderBy('id', 'desc')->get(); 
	$orders_product = ordersproduct::find($id);
	
	if ($orders_product) {
	$orders_id = $orders_product->order_id;
	$orders_product->order_status = 'Cancel';
	$orders_product->update();
	orders::where('orders_id', $orders_id)->update(['order_status' => 'Cancel']);

	// Retrieve updated orders and order products
    $orders = orders::where('User_id', $userId)->orderBy('id', 'desc')->get();
    $orders_product = ordersproduct::where('order_id', $orders_id)->get();
	
	
	
	
	// return view('website.front-end.orders_status')->
	return view('website.front-end.orders_details')->
		 with([
			"orders"=>$orders,
			"orders_product"=>$orders_product
			]);
			
	} else {
    // Handle the case where the order product with the given ID is not found
    // You might want to return an error message or redirect the user
}
	
}



	public function auction()
	{
		$auction = auction::get(); 
		$product_details = ProductsDetails::get();
		$product = Products::get();

		// dd($auction[0]->product_id);
		// foreach($auction as $auct)
		// {
		// 	print_r($auct->product_id);
		// }
		// exit();

		//  return view('website.front-end.order_tracking')->
		//  with([
		// 	"orders_id"=>$orders_id
			
		// ]);
		return view('website.front-end.auction')->with([
			"auction" => $auction,
			
		]);

	}
	
	
	public function placeorder(Request $request)
	{

		$validated = $request->validate([
			'firstname' => 'required|',
			'lastname' => 'required',
			'phone' => 'required',
			'email' => 'required',
			'address' => 'required',
			'town' => 'required',
			'state' => 'required',
			'country' => 'required',
			'postelcode' => 'required',
		]);
		

		$userId = session('userId');
		
		// $value = json_encode($details);
		$orders = new orders();
		$statement = DB::select("SHOW TABLE STATUS LIKE 'orders'");
        $next_orders_id = $statement[0]->Auto_increment;
		$orders_id = 'ORD'.$next_orders_id;
		// exit();
	
	
		if($request->input('account-option')=='Update' || $request->input('account-option')=='on')
		{
		    	$re = $request->input('account-option');
// 			@dd($re);
			$User = User::where('id', $userId)->first();
			$User->login_id = $userId;
			$User->firstName = $request->input('firstname');
			$User->lastName = $request->input('lastname');
			$User->phone = $request->input('phone');
			$User->email = $request->input('email');
			$User->address = $request->input('address');
			$User->town = $request->input('town');
			$User->state = $request->input('state');
			$User->country = $request->input('country');
			$User->postelcode = $request->input('postelcode');
		    
			$User->update();
		}
		if($userId != null && session('cart') != '')
		{
			$orders->user_id = $userId;
			$orderid =$orders->orders_id = $orders_id;
			$orders->firstname = $request->input('firstname');
			$orders->lastname = $request->input('lastname');
			$orders->phone = $request->input('phone');
			$orders->email = $request->input('email');
			$orders->address = $request->input('address');
			$orders->town = $request->input('town');
			$orders->state = $request->input('state');
			$orders->country = $request->input('country');
			$orders->postelcode = $request->input('postelcode');
			$orders->value = 'null';
			$shipping = $orders->shipping = $request->input('shipping');
			$orderstot = $request->input('total');
			$orders->total = $request->input('total1');
			$disc = $orders->discount = intval($request->input('discount2'));
			//dd($disc);
			$gst = $orders->gst_charge = $request->input('gst');
			if(is_int($disc))
				{
			$orders->grandtotal = $orderstot+$shipping - $disc;
				}
				else
				{
					$orders->grandtotal = $orderstot+$shipping;
				}
			// $orders->grandtotal = $request->input('grandtotal');
			$orders->payment_status = $request->input('payment-group');
            $orders->order_status = 'New';
            
			// if($request->payment_1 == 'checked'){

            //     echo $orders->payment_status = 1;  
                

            // } 
			// echo $orders->payment_status;
			// exit();
			$ldate = new DateTime('now');
			$order_date = $orders->order_date = $ldate;
			//dd($orders);
			$orders->save();
			// $ord = $orders::find(7);

			// print_r(json_decode($ord->value));
			if(session('cart') != null ){
			$details =  session('cart');
		
			 ($details);
				foreach($details as $key => $value)
					{
					    
					    
					    $colorqty = explode(',' ,  $value['color']);
					    $colorcount = count($colorqty);
					  
					// print_r($value);
					$ordersproduct = new ordersproduct();			
						// echo $key;
						$ordersproduct->order_id = $orders_id;
						$ordersproduct->product_id = $value['pid'];
						$ordersproduct->product_name = $value['name'];
						$ordersproduct->product_image = $value['image'];
						$ordersproduct->product_gstin = $value['gst'];
						$ordersproduct->product_size = $value['size'];
						$ordersproduct->product_quantity = $value['qty'];
						
						$ordersproduct->product_price = $value['price'];
				// 		$ordersproduct->total_price = $orderstot;
						$ordersproduct->total_price = $value['qty'] * $value['price'];
						$ordersproduct->order_status = 'New';

						$ordersproduct->save();
				// 		dd($value['pid']);
						ProductsDetails::where('id', $value['pid'])
						
						->decrement('quantity', $colorcount);
					
					
				}
				
				if($orders->payment_status == 'onlinepayment')
				{
					$order_id= $ordersproduct->order_id;
					$product_id = $ordersproduct->product_id;
					$quantity = $ordersproduct->product_quantity;
					$grandtota1 =$orders->grandtotal;

					return redirect()->route('phonepe')->with([
						'order_id' => $order_id,
						'product_id' => $product_id,
						'quantity' => $quantity,
						'grandtotal' => $grandtota1
					]);
					
				}
				else
				{
					Session::forget('cart');
					return redirect()->route('order_success', ['orders_id' => $orders_id]);
				}
				
			}
			else
			{
				$ordersproduct = new ordersproduct();	
				$ordersproduct->order_id = $orders_id;
				$ordersproduct->product_id = $request->input('pro_id');
				$ordersproduct->product_name = $request->input('pro_name');
				$ordersproduct->product_image = $request->input('pro_img');
				

				$ordersproduct->product_gstin = 'null';
				$ordersproduct->product_size = $request->input('pro_size');
				$ordersproduct->product_quantity = $request->input('pro_qnty');
				$ordersproduct->product_price = $request->input('pro_price');
				$shipping =  $request->input('shipping');
				$orderstot = $request->input('total');
				$disc = $request->input('discount2');
			
				$gst = $request->input('gst');
				if(is_int($disc))
				{
					$ordersproduct->total_price = $orderstot+$shipping+$gst - $disc;
				}
				else
				{
					$ordersproduct->total_price = $orderstot+$shipping+$gst;
				}
				$ordersproduct->order_status = 'New';
				$ordersproduct->save();
				
				
				if($orders->payment_status == 'onlinepayment')
				{
					$order_id= $ordersproduct->order_id;
					$product_id = $ordersproduct->product_id;
					$quantity = $ordersproduct->product_quantity;
					$grandtota1 =$orders->grandtotal;

					return redirect()->route('phonepe')->with([
						'order_id' => $order_id,
						'product_id' => $product_id,
						'quantity' => $quantity,
						'grandtotal' => $grandtota1
					]);
					
				}
				else
				{
					Session::forget('cart');
					return redirect()->route('order_success', ['orders_id' => $orders_id]);
				}
				
			}
			// exit();

			
// 			Session::forget('cart');
// 			return redirect()->route('order_success', ['orders_id' => $orders_id]);
// 			return redirect()->route('order_success/'.$orders_id);
		}
		else{
			Session::forget('cart');
		    return redirect()->route('home');
// 			echo 'plaese login before purchese the order';
		}
		// dd($orders);
		
		// $productname = $request->input('productname');
		// $productqty = $request->input('productqty');
		// $productprice = $request->input('productprice');
		//  return view('website.front-end.order-success');
	}

	public function order_success(Request $request)
	{
		$orders_id=$request->orders_id;
		$order_info = orders::where('orders_id',$orders_id)->get(); 
			$orders_pro = ordersproduct::where('order_id',$orders_id)->get(); 
			//dd($order_info);
			return view('website.front-end.order-success')->
			with([
				"orders_id"=>$orders_id,
				'order_infos' =>$order_info,
				'orders_pro' =>$orders_pro
			]);

	}

/*Discount offer*/
	public function discountoffere(Request $request)
	{
		$decode = $request->dcode;
		
	    $dis_amt = 0;
		$coupon = coupon::where('status',1)->where('coupon_code',$decode)->get();
		// dd($coupon);
            if(!empty($coupon)){
        		 foreach($coupon as $coup){
        
        			$coupon_code = $coup->coupon_code;
        
        			if($coupon_code == $decode)
        			{
        		    	$dis_amt = $coup->discount_amount;
        				$start_date = $coup->start_date;
        				$end_date = $coup->end_date;
        				break;
        				// dd($dis_amt);
        			}
        			else
        			{
        		    	$dis_amt = "No Discount";
        				$start_date = $coup->start_date;
        				$end_date = $coup->end_date;
        				// dd($dis_amt);
        			}
        		 }
            }
		else{
			$dis_amt = "Coupon code Deactive";
		}
		//  dd($request->dcode);
		// echo$request->decode;
		// exit();

		return response()->json(['dis_amt' => $dis_amt, 'end_date' => $end_date ,'start_date' => $start_date ]);
		
	}
/*Discount end*/

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

