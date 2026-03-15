<?php

namespace App\Http\Controllers\vendor;
use App\Http\Controllers\Controller;
use App\Models\order\Orders;
use App\Models\order\ordersproduct;
use GrahamCampbell\ResultType\Success;
use App\Models\Products\Products;
use App\Models\Products\ProductsDetails;
use Illuminate\Http\Request;
use App\Models\Ecom_Orders;
use App\Models\Ecom_Order_product;
use App\Models\Ecom_Customer_info;
use App\Models\vendor\vendorcreate;
// use Illuminate\Support\Facades\DB;
use DB;
use session;
class SalesController extends Controller
{
    private function updateNewOrderStatusesByInvoiceIds(array $invoiceIds): void
    {
        $invoiceIds = array_values(array_unique(array_filter($invoiceIds)));
        if (empty($invoiceIds)) {
            return;
        }

        $orders = DB::table('ecom_order')
            ->where(function ($query) use ($invoiceIds) {
                foreach ($invoiceIds as $invoiceId) {
                    $query->orWhereRaw('FIND_IN_SET(?, invoice_ids)', [$invoiceId]);
                }
            })
            ->get();

        foreach ($orders as $order) {
            $orderInvoiceIds = collect(explode(',', (string) ($order->invoice_ids ?? '')))
                ->map(fn($val) => trim($val))
                ->filter()
                ->values()
                ->all();

            if (empty($orderInvoiceIds)) {
                continue;
            }

            $statuses = DB::table('ecom_invoice')
                ->whereIn('invoice_id', $orderInvoiceIds)
                ->pluck('status')
                ->map(fn($s) => strtolower((string) $s))
                ->values();

            if ($statuses->isEmpty()) {
                continue;
            }

            if ($statuses->every(fn($s) => in_array($s, ['cancel', 'return'], true))) {
                DB::table('ecom_order')->where('id', $order->id)->update(['status' => 'Closed', 'updated_at' => now()]);
                continue;
            }

            if ($statuses->contains('pending')) {
                DB::table('ecom_order')->where('id', $order->id)->update(['status' => 'Pending', 'updated_at' => now()]);
                continue;
            }

            if ($statuses->contains(fn($s) => in_array($s, ['accept', 'accepted'], true))) {
                DB::table('ecom_order')->where('id', $order->id)->update(['status' => 'Accept', 'updated_at' => now()]);
                continue;
            }

            if ($statuses->contains(fn($s) => in_array($s, ['dispatch', 'dispatched'], true))) {
                DB::table('ecom_order')->where('id', $order->id)->update(['status' => 'Dispatch', 'updated_at' => now()]);
                continue;
            }

            if ($statuses->every(fn($s) => in_array($s, ['delivery', 'delivered'], true))) {
                DB::table('ecom_order')->where('id', $order->id)->update(['status' => 'Delivered', 'updated_at' => now()]);
            }
        }
    }

    private function vendorOrderProductsQuery($vendor_id)
    {
        return Ecom_Order_product::select(
                'ecom_order_product.*',
                'ecom_order_info.order_date',
                'ecom_order_info.payment_type',
                'ecom_order_info.payment_status'
            )
            ->join('ecom_order_info', 'ecom_order_product.order_id', '=', 'ecom_order_info.order_id')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.product_id', '=', 'products_details.products_id')
            ->where('products.logintype', '=', 'Vendor')
            ->where('products.created_by', '=', $vendor_id);
    }

    private function vendorOwnedOrderProductQuery($vendor_id, $orderProductId)
    {
        return Ecom_Order_product::select('ecom_order_product.*')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.product_id', '=', 'products_details.products_id')
            ->where('products.logintype', '=', 'Vendor')
            ->where('products.created_by', '=', $vendor_id)
            ->where('ecom_order_product.id', '=', $orderProductId);
    }

    public function order()
    {
        
        $vendor_id = session()->get('login_id');
        $orders = Ecom_Orders::
              join('ecom_order_product','ecom_order_product.order_id','=','ecom_order_info.order_id')
               ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
              ->join('products', 'products.product_id', '=', 'products_details.products_id')
              ->where('products.logintype', '=', 'Vendor')
	         ->where('products.created_by', '=', $vendor_id)
           ->get();
         
           
        
        $ordersproduct = $this->vendorOrderProductsQuery($vendor_id)
            ->where('ecom_order_product.order_status', '=', 'Pending')
            ->get();
            //   dd($ordersproduct);
        $product = Products::get();
	
      $new = Ecom_Orders::
                //   join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
      
                  join('ecom_order_product','ecom_order_product.order_id','=','ecom_order_info.order_id')
                 ->join('products_details', 'products_details.products_id', '=', 'ecom_order_product.product_id')
                 ->join('products', 'products.product_id', '=', 'products_details.products_id')
                 ->where('ecom_order_product.order_status', '=', 'Pending')->count();
       
        // $accept = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        // ->where('ecom_order_product.order_status', '=', 'Accept')->count();
        // $dispatch = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        // ->where('ecom_order_product.order_status', '=', 'Dispatch')->count();

        // $delivered = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        // ->where('ecom_order_product.order_status', '=', 'Delivered')->count();
        // $Return = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        // ->where('ecom_order_product.order_status', '=', 'Return')->count();
        // $cancel = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        // ->where('ecom_order_product.order_status', '=', 'Cancel')->count();
         // dd($vendor_id);

    //     $ordersproduct =  DB::table('orders')
    //     ->select('ecom_order_product.id','ecom_order_product.order_id','ecom_order_product.product_id','ecom_order_product.product_name','ecom_order_product.product_image','ecom_order_product.product_gstin','ecom_order_product.product_size','ecom_order_product.product_quantity','ecom_order_product.product_price','ecom_order_product.total_price','ecom_order_product.order_status','ecom_order_info.order_date','ecom_order_info.payment_status')
    //               ->join('ecom_order_product','ecom_order_product.order_id','=','ecom_order_info.order_id')
    //               ->join('products_details', 'products_details.products_id', '=', 'ecom_order_product.product_id')
    //               ->join('products', 'products.product_id', '=', 'products_details.products_id')
    //               ->where('ecom_order_product.order_status', '=', 'New')
    //               ->where('products.logintype', '=', 'Vendor')
				//  ->where('products.created_by', '=', $vendor_id)
    //               ->get();
                   
    //               dd($ordersproduct);
                   
        //   $ordersproductaccept = DB::table('orders')
        // ->select('ecom_order_product.id','ecom_order_product.order_id','ecom_order_product.product_id','ecom_order_product.product_name','ecom_order_product.product_image','ecom_order_product.product_gstin','ecom_order_product.product_size','ecom_order_product.product_quantity','ecom_order_product.product_price','ecom_order_product.total_price','ecom_order_product.order_status','ecom_order_info.order_date','ecom_order_info.payment_status')
        //           ->join('ecom_order_product','ecom_order_product.order_id','=','ecom_order_info.order_id')
        //           ->join('products_details', 'products_details.products_id', '=', 'ecom_order_product.product_id')
        //           ->join('products', 'products.product_id', '=', 'products_details.products_id')
        //           ->where('ecom_order_product.order_status', '=', 'Accept')
        //           ->where('products.logintype', '=', 'Vendor')
				    //->where('products.created_by', '=', $vendor_id)
        //           ->get
                  
                   $ordersproductaccept = $this->vendorOrderProductsQuery($vendor_id)
                       ->where('ecom_order_product.order_status', '=', 'Accept')
                       ->get();
                         
                 //  dd($ordersproductaccept);
                   
          
                   $ordersproductdispatch = $this->vendorOrderProductsQuery($vendor_id)
                       ->where('ecom_order_product.order_status', '=', 'Dispatch')
                       ->get();
                   
          $ordersproductdelivered = $this->vendorOrderProductsQuery($vendor_id)
              ->where('ecom_order_product.order_status', '=', 'Delivered')
              ->get();
                   
                   
                   
                //   dd($ordersproductdelivered);
                   
                   
          $ordersproductreturn = $this->vendorOrderProductsQuery($vendor_id)
              ->where('ecom_order_product.order_status', '=', 'Return')
              ->get();
                   
          $ordersproductcancel = $this->vendorOrderProductsQuery($vendor_id)
              ->where('ecom_order_product.order_status', '=', 'Cancel')
              ->get();



            /*product*/
             $new_product_count = Ecom_Order_product::
                        
                            join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                         ->join('products', 'products.product_id', '=', 'products_details.products_id')
                          ->where('ecom_order_product.order_status', '=', 'Pending')
                         ->where('products.logintype', '=', 'Vendor')
            	         ->where('products.created_by', '=', $vendor_id)
                         ->count();
                         
                         
                          $acc_product_count = Ecom_Order_product::
                        
                            join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                         ->join('products', 'products.product_id', '=', 'products_details.products_id')
                          ->where('ecom_order_product.order_status', '=', 'Accept')
                         ->where('products.logintype', '=', 'Vendor')
            	         ->where('products.created_by', '=', $vendor_id)
                         ->count();
                         
                         
                         $dis_product_count = Ecom_Order_product::
                        
                            join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                         ->join('products', 'products.product_id', '=', 'products_details.products_id')
                          ->where('ecom_order_product.order_status', '=', 'Dispatch')
                         ->where('products.logintype', '=', 'Vendor')
            	        ->where('products.created_by', '=', $vendor_id)
                         ->count();
                         
                         
                          $del_product_count = Ecom_Order_product::
                        
                            join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                         ->join('products', 'products.product_id', '=', 'products_details.products_id')
                          ->where('ecom_order_product.order_status', '=', 'Delivered')
                         ->where('products.logintype', '=', 'Vendor')
            	        ->where('products.created_by', '=', $vendor_id)
                         ->count();
                        
                        
                         $ret_product_count = Ecom_Order_product::
                        
                            join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                         ->join('products', 'products.product_id', '=', 'products_details.products_id')
                          ->where('ecom_order_product.order_status', '=', 'Return')
                         ->where('products.logintype', '=', 'Vendor')
            	        ->where('products.created_by', '=', $vendor_id)
                         ->count();
                         
                         
                            $can_product_count = Ecom_Order_product::
                        
                            join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                         ->join('products', 'products.product_id', '=', 'products_details.products_id')
                          ->where('ecom_order_product.order_status', '=', 'Cancel')
                         ->where('products.logintype', '=', 'Vendor')
            	        ->where('products.created_by', '=', $vendor_id)
                         ->count();
                    
            /*end*/


        return view('layout.vendor.sales.order-list')
        ->with(
            [
                // "orders" => $orders,
                // "ordersproduct" =>$ordersproduct
                
                "new_product_count" => $new_product_count,
                "acc_product_count" => $acc_product_count,
                "dis_product_count" => $dis_product_count,
                "del_product_count" => $del_product_count,
                "ret_product_count" => $ret_product_count,
                "can_product_count" => $can_product_count,


                "ordersproduct" =>$ordersproduct,
                "ordersproductaccept" =>$ordersproductaccept,
                "ordersproductdispatch" =>$ordersproductdispatch,
                "ordersproductdelivered" =>$ordersproductdelivered,
                "ordersproductreturn" =>$ordersproductreturn,
                "ordersproductcancel" =>$ordersproductcancel
                
            ]
        );

    }
    
    public function print_invoice(Request $request, $id)
    {
        
        $vendor_id = session()->get('login_id');
        $orderdetails = $this->vendorOwnedOrderProductQuery($vendor_id, $id)
            ->select('ecom_order_product.*')
            ->first();
        if (!$orderdetails) {
            abort(403, 'Unauthorized order access.');
        }
        //dd($orderdetails);
        $order = Ecom_Orders::where('order_id',$orderdetails->order_id)->first();
        $product = ProductsDetails::where('id',$orderdetails->product_id)->first();
        $vendorcreate = vendorcreate::where('id',$vendor_id)->first();
        // return view('layout.admin.sales.order-list');
        
        return view('layout.vendor.sales.print_invoice')
        ->with(
            [
                "order" =>$order,
                "order_product"=>$orderdetails,
                "vendorinfo"=>$vendorcreate,
                "product"=>$product,
        ]);
    
    }
    public function quickview_product(Request $request, $id)
    {
        
        $vendor_id = session()->get('login_id');
        $productdetails = ProductsDetails::join('products', 'products.product_id', '=', 'products_details.products_id')
            ->where('products.logintype', '=', 'Vendor')
            ->where('products.created_by', '=', $vendor_id)
            ->where('products_details.id', '=', $id)
            ->select('products_details.*')
            ->first();
        if (!$productdetails) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Unauthorized product access.',
            ], 403);
        }
        $product = Products::where('id',$productdetails->products_id)->first();
      
        
        return response()->json([
            'status'=>'Success',
            'productdetails'=>$productdetails,
            'product'=>$product,
        ]);
    
    }
    public function orderstatusupdate(Request $request, $id)
    {
        // echo 'test';
       $status = $request->sts;
       $vendor_id = session()->get('login_id');
       $allowedStatuses = ['Pending', 'Accept', 'Dispatch', 'Delivered', 'Return', 'Cancel'];
       if (!in_array($status, $allowedStatuses, true)) {
            return response()->json([
                'Success' => 'Failed',
                'message' => 'Invalid order status.',
            ], 422);
       }
        // echo $status;
        // echo $id;
        // exit;
        // $status = $request->input('status');
       $orderProduct = $this->vendorOwnedOrderProductQuery($vendor_id, $id)->first();
        if (!$orderProduct) {
            return response()->json([
                'Success' => 'Failed',
                'message' => 'Unauthorized order access.',
            ], 403);
        }

          $dd = Ecom_Order_product::where('id', $orderProduct->id)->update(['order_status' => $status]);
    
        $detailId = (int) ($orderProduct->product_id ?? 0);
        if ($detailId > 0) {
              $invoiceUpdate = ['status' => $status, 'updated_at' => now()];
              if (in_array($status, ['Delivered', 'delivery', 'delivered'], true)) {
                  $invoiceUpdate['delivered_at'] = now();
              } else {
                  $invoiceUpdate['delivered_at'] = null;
              }
              DB::table('ecom_invoice')
                  ->where('vendor_id', $vendor_id)
                  ->whereRaw('FIND_IN_SET(?, product_detail_ids)', [$detailId])
                  ->update($invoiceUpdate);

            $invoiceIds = DB::table('ecom_invoice')
                ->where('vendor_id', $vendor_id)
                ->whereRaw('FIND_IN_SET(?, product_detail_ids)', [$detailId])
                ->pluck('invoice_id')
                ->toArray();

            $this->updateNewOrderStatusesByInvoiceIds($invoiceIds);
        }

        // return view('layout.admin.sales.order-list');
        
        return response()->json([
            'Success'=>'Success'
             //$zone_data
        ]);
    
    }
    public function orderbulkstatusupdate(Request $request)
    {
        //   echo 'test';   
          $sts = $request->sts;
          $vendor_id = session()->get('login_id');
          $allowedStatuses = ['Pending', 'Accept', 'Dispatch', 'Delivered', 'Return', 'Cancel'];
          if (!in_array($sts, $allowedStatuses, true)) {
              return response()->json(['success' => "Invalid status."], 422);
          }
           // dd($sts);
              $ids = $request->ids;
              $id = explode(",",$ids);
             // print_r( $id );
        //   $sts = $request->sts;
        $invoiceIds = [];
        foreach($id as $idr)
        {
            $orderProduct = $this->vendorOwnedOrderProductQuery($vendor_id, $idr)->first();
            if (!$orderProduct) {
                continue;
            }

            Ecom_Order_product::where('id', $orderProduct->id)->update(['order_status' => $sts]);
            $detailId = (int) ($orderProduct->product_id ?? 0);
            if ($detailId > 0) {
                  $invoiceUpdate = ['status' => $sts, 'updated_at' => now()];
                  if (in_array($sts, ['Delivered', 'delivery', 'delivered'], true)) {
                      $invoiceUpdate['delivered_at'] = now();
                  } else {
                      $invoiceUpdate['delivered_at'] = null;
                  }
                  DB::table('ecom_invoice')
                      ->where('vendor_id', $vendor_id)
                      ->whereRaw('FIND_IN_SET(?, product_detail_ids)', [$detailId])
                      ->update($invoiceUpdate);

                $matched = DB::table('ecom_invoice')
                    ->where('vendor_id', $vendor_id)
                    ->whereRaw('FIND_IN_SET(?, product_detail_ids)', [$detailId])
                    ->pluck('invoice_id')
                    ->toArray();
                $invoiceIds = array_merge($invoiceIds, $matched);
            }
        //   DB::table("ordersproduct")->whereIn('id',$idr)->update(['order_status'=>$sts]);
        }

        $this->updateNewOrderStatusesByInvoiceIds($invoiceIds);
        
          return response()->json(['success'=>"Products Updated successfully."]);

    }


    public function transaction()
    {
        return view('layout.vendor.sales.order-transaction');
    }
}
