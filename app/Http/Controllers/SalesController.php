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

    public function returns()
    {
        $returns = DB::table('ecom_return_requests')
            ->leftJoin('ecom_invoice', 'ecom_invoice.invoice_id', '=', 'ecom_return_requests.invoice_id')
            ->leftJoin('ecom_customer_info', 'ecom_customer_info.customer_id', '=', 'ecom_return_requests.customer_id')
            ->select(
                'ecom_return_requests.*',
                'ecom_customer_info.customer_firstname',
                'ecom_customer_info.customer_lastname',
                'ecom_customer_info.customer_mobileno',
                'ecom_customer_info.customer_email',
                'ecom_invoice.product_detail_ids',
                'ecom_invoice.line_qty',
                'ecom_invoice.total_amount'
            )
            ->orderBy('ecom_return_requests.id', 'desc')
            ->get();

        foreach ($returns as $item) {
            $detailIds = collect(explode(',', (string) ($item->product_detail_ids ?? '')))
                ->map(fn($val) => (int) trim($val))
                ->filter()
                ->values();

            $item->products = $detailIds->isNotEmpty()
                ? DB::table('products_details')
                    ->join('products', 'products.product_id', '=', 'products_details.products_id')
                    ->whereIn('products_details.id', $detailIds->all())
                    ->select('products.product_name', 'products.product_image')
                    ->get()
                : collect();
        }

        return view('layout.admin.sales.returns', compact('returns'));
    }

    public function updateReturnStatus(Request $request, $id)
    {
        $status = $request->input('status');
        $allowedStatuses = ['Pending', 'Approved', 'Rejected'];
        if (!in_array($status, $allowedStatuses, true)) {
            return redirect()->back()->with('error', 'Invalid status.');
        }

        $returnRequest = DB::table('ecom_return_requests')->where('id', $id)->first();
        if (!$returnRequest) {
            return redirect()->back()->with('error', 'Request not found.');
        }

        DB::table('ecom_return_requests')->where('id', $id)->update([
            'status' => $status,
            'updated_at' => now(),
        ]);

        if ($status === 'Rejected') {
            DB::table('ecom_invoice')
                ->where('invoice_id', $returnRequest->invoice_id)
                ->update([
                    'status' => 'Delivered',
                    'updated_at' => now(),
                ]);

            $invoice = DB::table('ecom_invoice')
                ->where('invoice_id', $returnRequest->invoice_id)
                ->first();

            if ($invoice) {
                $detailIds = collect(explode(',', (string) ($invoice->product_detail_ids ?? '')))
                    ->map(fn($val) => (int) trim($val))
                    ->filter()
                    ->values();

                $orderRow = DB::table('ecom_order')
                    ->whereRaw("FIND_IN_SET(?, invoice_ids)", [$returnRequest->invoice_id])
                    ->first();

                if ($orderRow && $detailIds->isNotEmpty()) {
                    DB::table('ecom_order_product')
                        ->where('order_id', $orderRow->order_id)
                        ->whereIn('product_id', $detailIds->all())
                        ->update(['order_status' => 'Delivered']);

                    DB::table('ecom_order_info')
                        ->where('order_id', $orderRow->order_id)
                        ->update(['order_status' => 'Delivered']);
                }
            }
        } elseif ($status === 'Approved') {
            $newInvoiceStatus = ($returnRequest->request_type === 'Replacement') ? 'Replacement' : 'Return';
            DB::table('ecom_invoice')
                ->where('invoice_id', $returnRequest->invoice_id)
                ->update([
                    'status' => $newInvoiceStatus,
                    'updated_at' => now(),
                ]);

            $invoice = DB::table('ecom_invoice')
                ->where('invoice_id', $returnRequest->invoice_id)
                ->first();

            if ($invoice) {
                $detailIds = collect(explode(',', (string) ($invoice->product_detail_ids ?? '')))
                    ->map(fn($val) => (int) trim($val))
                    ->filter()
                    ->values();

                $orderRow = DB::table('ecom_order')
                    ->whereRaw("FIND_IN_SET(?, invoice_ids)", [$returnRequest->invoice_id])
                    ->first();

                if ($orderRow && $detailIds->isNotEmpty()) {
                    DB::table('ecom_order_product')
                        ->where('order_id', $orderRow->order_id)
                        ->whereIn('product_id', $detailIds->all())
                        ->update(['order_status' => $newInvoiceStatus]);

                    DB::table('ecom_order_info')
                        ->where('order_id', $orderRow->order_id)
                        ->update(['order_status' => $newInvoiceStatus]);
                }
            }
        }

        return redirect()->back()->with('success', 'Return status updated to ' . $status);
    }
}
