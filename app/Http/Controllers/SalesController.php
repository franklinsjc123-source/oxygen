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
         $status = $request->sts;
         $curr_data = $request->formattedDate ?: date('Y-m-d');
         $allowedStatuses = ['Pending', 'Accept', 'Dispatch', 'Delivered', 'Return', 'Cancel'];
         if (!in_array($status, $allowedStatuses, true)) {
            return response()->json([
                'Success' => 'Failed',
                'message' => 'Invalid order status.',
            ], 422);
         }

        $orderProduct = Ecom_Order_product::where('id', $id)->first();
        if (!$orderProduct) {
            return response()->json([
                'Success' => 'Failed',
                'message' => 'Order item not found.',
            ], 404);
        }

        Ecom_Order_product::where('id', $id)->update(['order_status' => $status]);
        Ecom_Orders::where('order_id', $orderProduct->order_id)->update([
            'order_status' => $status,
            'delivery_date' => $curr_data,
        ]);

        $detailId = (int) ($orderProduct->product_id ?? 0);
        if ($detailId > 0) {
            $invoiceUpdate = ['status' => $status, 'updated_at' => now()];
            if (in_array($status, ['Delivered', 'delivery', 'delivered'], true)) {
                $invoiceUpdate['delivered_at'] = now();
            } else {
                $invoiceUpdate['delivered_at'] = null;
            }
            DB::table('ecom_invoice')
                ->whereRaw('FIND_IN_SET(?, product_detail_ids)', [$detailId])
                ->update($invoiceUpdate);

            $invoiceIds = DB::table('ecom_invoice')
                ->whereRaw('FIND_IN_SET(?, product_detail_ids)', [$detailId])
                ->pluck('invoice_id')
                ->toArray();

            $this->updateNewOrderStatusesByInvoiceIds($invoiceIds);
        }
        
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
      $curr_data= $request->formattedDate;
      $sts = $request->sts;
      $allowedStatuses = ['Pending', 'Accept', 'Dispatch', 'Delivered', 'Return', 'Cancel'];
      if (!in_array($sts, $allowedStatuses, true)) {
          return response()->json(['success' => "Invalid status."], 422);
      }

          $ids = $request->ids;
          $id = explode(",",$ids);
            //   print_r( $id );
            //   exit;
            //   $sts = $request->sts;
    $invoiceIds = [];
    foreach($id as $idr)
    {   
        if (empty($idr)) {
            continue;
        }
        Ecom_Order_product::where('id',$idr)->update(['order_status'=>$sts]);
        $ord1 = Ecom_Order_product::where('id', $idr)->first();
        if (!$ord1) {
            continue;
        }
        Ecom_Orders::where('order_id', $ord1->order_id)->update([
            'order_status' => $sts,
            'delivery_date' => $curr_data ?: date('Y-m-d'),
        ]);
       
        $notification =  new Notification();
        $userId = session('userId');
        $notification->details= $sts;
        $notification->orders_id = $ord1->order_id;
        $notification->product_id = $ord1->product_id;

        $notification->login_id= $userId;
        $notification->status=1;
        $notification->orders_date = date('Y-m-d');
        $notification->save();

        $detailId = (int) ($ord1->product_id ?? 0);
        if ($detailId > 0) {
            $invoiceUpdate = ['status' => $sts, 'updated_at' => now()];
            if (in_array($sts, ['Delivered', 'delivery', 'delivered'], true)) {
                $invoiceUpdate['delivered_at'] = now();
            } else {
                $invoiceUpdate['delivered_at'] = null;
            }
            DB::table('ecom_invoice')
                ->whereRaw('FIND_IN_SET(?, product_detail_ids)', [$detailId])
                ->update($invoiceUpdate);

            $matched = DB::table('ecom_invoice')
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
        return view('layout.admin.sales.order-transaction');
    }
}
