<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use App\Models\order\Orders;
use App\Models\order\ordersproduct;
use Illuminate\Http\Request;

class orderslist extends Controller
{
    public function orderlist()
    {
        // echo 'test';
        $orders = Orders::get();
        return view('layout.admin.order.order_list')
            ->with(
                [
                    "orders" => $orders,
                    
                ]
            );

    }
}
