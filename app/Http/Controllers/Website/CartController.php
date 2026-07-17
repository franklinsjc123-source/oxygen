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
use App\Models\Payment;

use Illuminate\Support\Facades\Session;
use DB;

class CartController extends Controller
{
    public function getAdjustedCartPrices($cartData) {
        $prices = [];
        $offerGroups = [];
        
        if (!is_array($cartData)) return $prices;
        
        foreach ($cartData as $pid => $item) {
            $product = ProductsDetails::where('id', '=', $pid)->first();
            $offer_id = null;
            if ($product) {
                $productMain = Products::where('product_id', '=', $product->products_id)->first();
                if ($productMain && $productMain->offers) {
                    $offer_id = $productMain->offers;
                }
            }
            if ($offer_id) {
                $offerGroups[$offer_id][] = [
                    'pid' => $pid,
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'raw_total' => $item['qty'] * $item['price']
                ];
            }
            $prices[$pid] = $item['qty'] * $item['price'];
        }
        
        foreach ($offerGroups as $oid => $items) {
            $offer = Offers::find($oid);
            if (!$offer || $offer->status != 1) continue;
            
            if ($offer->type == 'Fixed Discount') {
                foreach ($items as $itm) {
                    $discount = 0;
                    if ($offer->discount_type == 'Percentage') {
                        $discount = ($itm['raw_total'] * $offer->value) / 100;
                    } else {
                        $discount = $offer->value * $itm['qty'];
                    }
                    $prices[$itm['pid']] = max(0, $itm['raw_total'] - $discount);
                }
            } elseif ($offer->type == 'Buy X @ Y') {
                $buyproduct = max(1, (int)$offer->buyproduct);
                $getamt = (float)$offer->getamt;
                
                $flatItems = [];
                foreach ($items as $itm) {
                    for ($i=0; $i<$itm['qty']; $i++) $flatItems[] = ['pid' => $itm['pid'], 'price' => $itm['price']];
                }
                usort($flatItems, function($a, $b) { return $b['price'] <=> $a['price']; });
                
                $finalMap = [];
                $totalItems = count($flatItems);
                $bundles = intdiv($totalItems, $buyproduct);
                
                foreach ($flatItems as $index => $fItem) {
                    if (!isset($finalMap[$fItem['pid']])) $finalMap[$fItem['pid']] = 0;
                    if ($index < $bundles * $buyproduct) {
                        $finalMap[$fItem['pid']] += ($getamt / $buyproduct);
                    } else {
                        $finalMap[$fItem['pid']] += $fItem['price'];
                    }
                }
                foreach ($items as $itm) {
                    $prices[$itm['pid']] = $finalMap[$itm['pid']];
                }
            } elseif ($offer->type == 'Buy X Get Y Free') {
                $buy = max(1, (int)$offer->buy);
                $getoffer = max(1, (int)$offer->getoffer);
                
                // Separate items into two categories: "Requested as Free" and "Normal Added"
                $paidItemsFlat = [];
                $freeItemsFlat = [];
                
                foreach ($items as $itm) {
                    $itemData = $cartData[$itm['pid']];
                    $isFree = isset($itemData['is_free_offer']) && $itemData['is_free_offer'] == 1;
                    
                    for ($i=0; $i<$itm['qty']; $i++) {
                        if ($isFree) {
                            $freeItemsFlat[] = ['pid' => $itm['pid'], 'price' => $itm['price']];
                        } else {
                            $paidItemsFlat[] = ['pid' => $itm['pid'], 'price' => $itm['price']];
                        }
                    }
                }
                
                // Group units of 'buy' items from paid pool to 'unlock' slots from free pool
                $numPaid = count($paidItemsFlat);
                $maxPossibleFree = intdiv($numPaid, $buy) * $getoffer;
                $allowedFreeSlots = min($maxPossibleFree, count($freeItemsFlat));
                
                // The most expensive items in the FREE pool that fit in slots become free (0 price)
                usort($freeItemsFlat, function($a, $b) { return $b['price'] <=> $a['price']; });
                
                $finalMap = [];
                foreach ($paidItemsFlat as $fItem) {
                    $finalMap[$fItem['pid']] = ($finalMap[$fItem['pid']] ?? 0) + $fItem['price'];
                }
                
                // Only first allowedFreeSlots items in free pool get 0 price
                foreach ($freeItemsFlat as $index => $fItem) {
                    if ($index >= $allowedFreeSlots) {
                        $finalMap[$fItem['pid']] = ($finalMap[$fItem['pid']] ?? 0) + $fItem['price'];
                    } else {
                        $finalMap[$fItem['pid']] = ($finalMap[$fItem['pid']] ?? 0) + 0;
                    }
                }
                
                foreach ($items as $itm) {
                    $prices[$itm['pid']] = $finalMap[$itm['pid']] ?? 0;
                }
            }
        }
        return $prices;
    }

    public function getAlertMessage($totalQty, $offer_id) {
        if (!$offer_id) return '';
        $offer = Offers::find($offer_id);
        if (!$offer || $offer->status != 1) return '';
        
        if ($offer->type == 'Buy X Get Y Free') {
            $buy = max(1, (int)$offer->buy);
            $getoffer = max(1, (int)$offer->getoffer);
            $groupSize = $buy + $getoffer;
            // The user wants an alert when they choose the X product.
            if ($totalQty > 0 && ($totalQty % $groupSize) == $buy) {
                return "This product is in offer. Kindly please choose $getoffer product free of cost.";
            }
        }
        return '';
    }

    public function calculateCashbackAmount($pid, $qty, $raw_price) {
        $product = ProductsDetails::where('id', '=', $pid)->first();
        if (!$product) return 0;
        $productMain = Products::where('product_id', '=', $product->products_id)->first();
        if (!$productMain || !$productMain->offers) return 0;
        $offer = Offers::find($productMain->offers);
        if (!$offer || $offer->status != 1) return 0;
        
        $cashback = 0;
        if ($offer->type == 'Cashback Offer') {
            $total_price = $qty * $raw_price;
            if ($offer->cashbacktype == 'Percentage') {
                $cashback = ($total_price * $offer->cashbackvalue) / 100;
            } else {
                $cashback = max(0, (float)$offer->cashbackvalue);
            }
        }
        return $cashback;
    }

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
		$is_free_offer = $request->input('is_free_offer', 0);

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
			$cartData[$id]['is_free_offer'] = $is_free_offer;
			
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
			$cartData[$id]['is_free_offer'] = $is_free_offer;
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

		// Determine offer_id and total qty across all cart items sharing this offer
		$offer_id = null;
		$current_products_id = null;
		$productDetail = ProductsDetails::where('id', '=', $id)->first();
		if ($productDetail) {
			$current_products_id = $productDetail->products_id;
			$pMain = Products::where('product_id', '=', $productDetail->products_id)->first();
			if ($pMain && $pMain->offers) {
				$offer_id = $pMain->offers;
			}
		}

		// Calculate total qty of all cart items that share this offer, separated by paid vs free-choice
		$paidQtyInOffer = 0;
		$freeQtyInOffer = 0;
		if ($offer_id) {
			foreach ($cartData as $cpid => $citem) {
				$cpd = ProductsDetails::where('id', '=', $cpid)->first();
				if ($cpd) {
					$cpm = Products::where('product_id', '=', $cpd->products_id)->first();
					if ($cpm && $cpm->offers == $offer_id) {
						if (isset($citem['is_free_offer']) && $citem['is_free_offer'] == 1) {
							$freeQtyInOffer += $citem['qty'];
						} else {
							$paidQtyInOffer += $citem['qty'];
						}
					}
				}
			}
		}

		$free_msg = '';
		$offer = Offers::find($offer_id);
		if ($offer && $offer->status == 1 && $offer->type == 'Buy X Get Y Free') {
			$buy = max(1, (int)$offer->buy);
			$getoffer = max(1, (int)$offer->getoffer);
			$neededFreeTotal = intdiv($paidQtyInOffer, $buy) * $getoffer;
			
			if ($neededFreeTotal > $freeQtyInOffer && $is_free_offer == 0) {
				$free_msg = "This product is in offer. You are eligible for ".($neededFreeTotal - $freeQtyInOffer)." free product(s)! Kindly please choose your free product(s).";
			}
		}

		return response()->json([
			'msg' => $cart_qty,
			'free_alert' => $free_msg,
			'offer_id' => $offer_id,
			'products_id' => $current_products_id,
			'buy' => $offer ? $offer->buy : 1,
			'getoffer' => $offer ? $offer->getoffer : 1
		], 200);
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
			$adjustedPrices = $this->getAdjustedCartPrices($cartData);
			foreach ($cartData as $key => $value) {
				$product = ProductsDetails::where('id', '=', $key)->get()->toArray();
				$images=explode(',',$product['0']['product_detail_image']);
				$cart_item['image'] = $images['0'];
				$cart_item['foodtype'] =  '';
				$cart_item['pid'] =  $value['pid'];
				$cart_item['name'] =  $value['name'];
				$cart_item['price'] = $value['price'];
				$cart_item['size'] = $value['size'];
				$cart_item['total_price'] = isset($adjustedPrices[$key]) ? $adjustedPrices[$key] : ($value['qty'] * $value['price']);
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
			$adjustedPrices = $this->getAdjustedCartPrices($cartData);
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
				$order_product->total_price = isset($adjustedPrices[$key]) ? $adjustedPrices[$key] : ($value['qty'] * $value['price']);
				$order_product->order_status = 'Pending';
				$order_product->save();

				$cashback_amt = $this->calculateCashbackAmount($value['pid'], $value['qty'], $value['price']);
				if ($cashback_amt > 0) {
				    \DB::table('ecom_customer_wallet_transactions')->insert([
				        'customer_id' => $customer_id,
				        'order_id' => $order_id,
				        'product_id' => $product->products_id,
				        'product_detail_id' => $value['pid'],
				        'offer_id' => $products->offers,
				        'offer_title' => 'Cashback Offer',
				        'amount' => $cashback_amt,
				        'type' => 'Credit',
				        'status' => 'Pending',
				        'remarks' => 'Cashback for order '.$order_id,
				        'created_at' => now(),
				        'updated_at' => now(),
				    ]);
				}
			}
		}

		// Razorpay Payment Handling
		if ($paymentType === 'onlinepayment' && $request->has('razorpay_payment_id')) {
			$payment = new Payment();
			$payment->order_id = $order_id;
			$payment->razorpay_payment_id = $request->razorpay_payment_id;
			$payment->razorpay_signature = $request->razorpay_signature;
			$payment->amount = $grandTotal;
			$payment->status = 'Captured';
			$payment->payment_data = json_encode($request->all());
			$payment->save();

			// Update Order Payment Status
			$order->payment_status = 'Completed';
			$order->order_status = 'Processing';
			$order->save();
		}

		Session::forget('cart');
		// Order Product insert end 
		Session::put('order_id', $order_id);

		// Send order confirmation email to customer
		if (!empty($customerEmail)) {
			try {
				$orderProducts = Ecom_Order_product::where('order_id', $order_id)->get();
				$productList = [];
				foreach ($orderProducts as $op) {
					$productList[] = [
						'name' => $op->product_name,
						'size' => $op->product_size,
						'qty' => $op->product_quantity,
						'price' => $op->product_price,
						'total' => $op->total_price,
					];
				}

				$orderData = [
					'order_id' => $order_id,
					'order_date' => $order->order_date,
					'customer_name' => trim($customerFirstname . ' ' . $customerLastname),
					'mobile' => $customerMobile,
					'address' => $customerAddress,
					'address1' => $customerAddress1,
					'city' => $customerCity,
					'state' => $customerState,
					'pincode' => $customerPincode,
					'payment_type' => $paymentType,
					'total_amount' => $totalAmount,
					'discount_amount' => $discountAmount,
					'shipping_charge' => $shippingCharge,
					'gst_charge' => $gstCharge,
					'grand_total' => $grandTotal,
					'products' => $productList,
				];

				\Mail::to($customerEmail)->send(new \App\Mail\OrderMail($orderData));
			} catch (\Exception $e) {
				\Log::error('Order confirmation email failed for order ' . $order_id . ': ' . $e->getMessage());
			}
		}

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

	/**
	 * Get all offer products (excluding the current product) with their variants (sizes, colors).
	 * Used by the Buy X Get Y Free modal so user can choose a DIFFERENT product.
	 */
	public function getOfferProducts(Request $request)
	{
		$offer_id = $request->input('offer_id');
		$exclude_products_id = $request->input('exclude_products_id'); // the product user already added

		if (!$offer_id) {
			return response()->json(['products' => [], 'offer' => null], 200);
		}

		$offer = Offers::find($offer_id);
		if (!$offer || $offer->status != 1) {
			return response()->json(['products' => [], 'offer' => null], 200);
		}

		// Get all products that have this offer, EXCLUDING the one user already added
		$query = Products::where('offers', $offer_id)->where('status', 1);
		if ($exclude_products_id) {
			$query->where('product_id', '!=', $exclude_products_id);
		}
		$offerProducts = $query->get();

		$result = [];
		foreach ($offerProducts as $prod) {
			$details = ProductsDetails::where('products_id', $prod->product_id)->get();
			
			$sizes = [];
			$colors = [];
			$variants = [];
			
			foreach ($details as $det) {
				$sizeVal = $det->attributevalue2 ?? '';
				$colorVal = $det->attributevalue1 ?? '';
				
				if ($sizeVal && !in_array($sizeVal, $sizes)) {
					$sizes[] = $sizeVal;
				}
				if ($colorVal && !in_array($colorVal, $colors)) {
					$colors[] = $colorVal;
				}
				
				$images = explode(',', $det->product_detail_image);
				$firstImage = '';
				if (is_array($images) && count($images) > 0) {
					$firstImage = trim($images[0]);
				}
				
				$variants[] = [
					'detail_id' => $det->id,
					'size' => $sizeVal,
					'color' => $colorVal,
					'selling_price' => $det->selling_price,
					'retail_price' => $det->retail_price,
					'quantity' => $det->quantity,
					'image' => $firstImage
				];
			}
			
			$result[] = [
				'product_id' => $prod->product_id,
				'product_name' => $prod->product_name,
				'product_image' => $prod->product_image,
				'sizes' => $sizes,
				'colors' => $colors,
				'variants' => $variants
			];
		}

		return response()->json([
			'products' => $result,
			'offer' => [
				'id' => $offer->id,
				'title' => $offer->title,
				'type' => $offer->type,
				'buy' => $offer->buy,
				'getoffer' => $offer->getoffer
			]
		], 200);
	}
}
