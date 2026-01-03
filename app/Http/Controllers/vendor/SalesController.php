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
         
           
        
        $ordersproduct = Ecom_Order_product::
            //  join('ecom_order_product','ecom_order_product.order_id','=','ecom_order_info.order_id')
                select('ecom_order_product.*','ecom_order_info.order_date','ecom_order_info.payment_type','ecom_order_info.payment_status')                
               ->join('ecom_order_info','ecom_order_product.order_id','=','ecom_order_info.order_id')
               ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
               ->join('products', 'products.product_id', '=', 'products_details.products_id')
              ->where('ecom_order_product.order_status', '=', 'Pending')
             ->where('products.logintype', '=', 'Vendor')
	         ->where('products.created_by', '=', $vendor_id)
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
                  
                   $ordersproductaccept = Ecom_Order_product::
                   select('ecom_order_product.*','ecom_order_info.order_date','ecom_order_info.payment_type','ecom_order_info.payment_status')                             
                   ->join('ecom_order_info','ecom_order_product.order_id','=','ecom_order_info.order_id')
                            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                           ->join('products', 'products.product_id', '=', 'products_details.products_id')
                           ->where('ecom_order_product.order_status', '=', 'Accept')
                          ->where('products.logintype', '=', 'Vendor')
                          ->where('products.created_by', '=', $vendor_id)
                         ->get();
                         
                 //  dd($ordersproductaccept);
                   
          
                   $ordersproductdispatch = Ecom_Order_product::
                   select('ecom_order_product.*','ecom_order_info.order_date','ecom_order_info.payment_type','ecom_order_info.payment_status')                              
                   ->join('ecom_order_info','ecom_order_product.order_id','=','ecom_order_info.order_id')
                            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                           ->join('products', 'products.product_id', '=', 'products_details.products_id')
                           ->where('ecom_order_product.order_status', '=', 'Dispatch')
                           ->where('products.logintype', '=', 'Vendor')
                           ->where('products.created_by', '=', $vendor_id)
                           ->get();
                   
          $ordersproductdelivered = Ecom_Order_product::
          select('ecom_order_product.*','ecom_order_info.order_date','ecom_order_info.payment_type','ecom_order_info.payment_status')                            
          ->join('ecom_order_info','ecom_order_product.order_id','=','ecom_order_info.order_id')
                            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                           ->join('products', 'products.product_id', '=', 'products_details.products_id')
                          ->where('ecom_order_product.order_status', '=', 'Delivered')
                          ->where('products.logintype', '=', 'Vendor')
                          ->where('products.created_by', '=', $vendor_id)
                          ->get();
                   
                   
                   
                //   dd($ordersproductdelivered);
                   
                   
          $ordersproductreturn = Ecom_Order_product::
          select('ecom_order_product.*','ecom_order_info.order_date','ecom_order_info.payment_type','ecom_order_info.payment_status')                 
          ->join('ecom_order_info','ecom_order_product.order_id','=','ecom_order_info.order_id')
                            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                           ->join('products', 'products.product_id', '=', 'products_details.products_id')
                  ->where('ecom_order_product.order_status', '=', 'Return')
                  ->where('products.logintype', '=', 'Vendor')
			      ->where('products.created_by', '=', $vendor_id)
                  ->get();
                   
          $ordersproductcancel = Ecom_Order_product::
          select('ecom_order_product.*','ecom_order_info.order_date','ecom_order_info.payment_type','ecom_order_info.payment_status')                    
          ->join('ecom_order_info','ecom_order_product.order_id','=','ecom_order_info.order_id')
                            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                           ->join('products', 'products.product_id', '=', 'products_details.products_id')
                            ->where('ecom_order_product.order_status', '=', 'Cancel')
                            ->where('products.logintype', '=', 'Vendor')
				            ->where('products.created_by', '=', $vendor_id)
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
        $orderdetails = Ecom_Order_product::where('id',$id)->first();
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
        
        
        $productdetails = ProductsDetails::where('id',$id)->first();
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
        // echo $status;
        // echo $id;
        // exit;
        // $status = $request->input('status');
        $dd = Ecom_Order_product::where('id',$id)->update(['order_status'=>$status]);
    

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
           // dd($sts);
              $ids = $request->ids;
              $id = explode(",",$ids);
             // print_r( $id );
        //   $sts = $request->sts;
        foreach($id as $idr)
        {
            Ecom_Order_product::where('id',$idr)->update(['order_status'=>$sts]);
        //   DB::table("ordersproduct")->whereIn('id',$idr)->update(['order_status'=>$sts]);
        }
        
          return response()->json(['success'=>"Products Updated successfully."]);

    }


    public function transaction()
    {
        return view('layout.vendor.sales.order-transaction');
    }
}
