<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use App\Models\order\Orders;
use App\Models\order\ordersproduct;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use DB;

class SalesController extends Controller
{
    public function order()
    {
        $orders = Orders::get();
        $ordersproduct = ordersproduct::get();

        return view('layout.staff.sales.order-list')
        ->with(
            [
                "orders" => $orders,
                "ordersproduct" =>$ordersproduct
                
            ]
        );

    }
    public function orderstatusupdate(Request $request, $id)
    {
        //  echo $id;
         $status = $request->sts;

        // $status = $request->input('status');
        ordersproduct::where('id',$id)->update(['order_status'=>$status]);

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

          $ids = $request->ids;
          $id = explode(",",$ids);
         // print_r( $id );
    //   $sts = $request->sts;
foreach($id as $idr)
{
    ordersproduct::where('id',$idr)->update(['order_status'=>$sts]);
//   DB::table("ordersproduct")->whereIn('id',$idr)->update(['order_status'=>$sts]);
}
    
      return response()->json(['success'=>"Products Updated successfully."]);

    }


    public function transaction()
    {
        return view('layout.staff.sales.order-transaction');
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

        return view('layout.staff.sales.returns', compact('returns'));
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
