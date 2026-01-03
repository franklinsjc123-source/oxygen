<?php

namespace App\Http\Controllers;
use App\Models\order\Orders;
use App\Models\order\ordersproduct;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use App\Models\Notification;

use App\Models\Ecom_Orders;
use App\Models\Ecom_Order_product;
// use Illuminate\Support\Facades\DB;
use DB;

class SalesController extends Controller
{
    public function order()
    {
        $orders = Ecom_Orders::get();
        $ordersproduct = Ecom_Order_product::get();
        
        $new = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        ->where('ecom_order_product.order_status', '=', 'Pending')->count();
       
        $accept = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        ->where('ecom_order_product.order_status', '=', 'Accept')->count();
        $dispatch = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        ->where('ecom_order_product.order_status', '=', 'Dispatch')->count();

        $delivered = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        ->where('ecom_order_product.order_status', '=', 'Delivered')->count();
        $Return = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        ->where('ecom_order_product.order_status', '=', 'Return')->count();
        $cancel = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
        ->where('ecom_order_product.order_status', '=', 'Cancel')->count();


        return view('layout.admin.sales.order-list')
        ->with(
            [
                "orders" => $orders,
                "ordersproduct" =>$ordersproduct,
                "new"=>$new,
                "accept"=>$accept,
                "dispatch"=>$dispatch,
                "delivered"=>$delivered,
                "return"=>$Return,
                "cancel"=>$cancel
            ]
        );

    }
    public function orderstatusupdate(Request $request, $id)
    {
        //  echo $id;
         $status = $request->sts;
         $curr_data= $request->formattedDate;
         
        // $status = $request->input('status');
        Ecom_Order_product::where('id',$id)->update(['order_status'=>$status]);
        Ecom_Orders::where('id',$id)->update(['order_status'=>$status,'delivery_date'=>$curr_data]);
        // return view('layout.admin.sales.order-list');
        
        $notification =  new Notification();
        $ord1 = Ecom_Order_product::where('id',$id)->get();
        //dd($ord1);
        $userId = session('userId');
        $notification->details= $status;
        $notification->orders_id = $ord1[0]->order_id;
        $notification->product_id = $ord1[0]->product_id;
        $notification->login_id= $userId;
        $notification->status=1;
        $notification->orders_date = date('Y-m-d');
        $notification->save();
        
        return response()->json([
            'Success'=>'Success'
             //$zone_data
        ]);
    
    }
    public function orderbulkstatusupdate(Request $request)
    {
    //   dd($request->all());
      $curr_data= $request->formattedDate;
      $sts = $request->sts;

          $ids = $request->ids;
          $id = explode(",",$ids);
            //   print_r( $id );
            //   exit;
            //   $sts = $request->sts;
    foreach($id as $idr)
    {   
        //dd($idr);
        Ecom_Order_product::where('id',$idr)->update(['order_status'=>$sts]);
        Ecom_Orders::where('id',$id)->update(['order_status'=>$sts,'delivery_date'=>$curr_data]);
       
        $notification =  new Notification();
        
        $ord1 = Ecom_Order_product::where('id',$id)->get();
        
        $userId = session('userId');
        $notification->details= $sts;
        $notification->orders_id = $ord1[0]->order_id;
        $notification->product_id = $ord1[0]->product_id;

        $notification->login_id= $userId;
        $notification->status=1;
        $notification->orders_date = date('Y-m-d');
        $notification->save();
      //   DB::table("ordersproduct")->whereIn('id',$idr)->update(['order_status'=>$sts]);
    }
    
      return response()->json(['success'=>"Products Updated successfully."]);

    }


    public function transaction()
    {
        return view('layout.admin.sales.order-transaction');
    }
}
