<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Roll;
use App\Models\Staffcreates;
use Illuminate\Support\Facades\Session; 

// use App\Models\User;


use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function admindashboard()
    {
        $productCount = DB::table('products')->count();
        $orderCount = DB::table('ecom_order_info')->count();
        $customerCount = DB::table('ecom_customer_info')->count();
        $vendorCount = DB::table('vendor_details')->count();

        return view('layout.admin.dashboard.dashboard')->with([
            'productCount' => $productCount,
            'orderCount' => $orderCount,
            'customerCount' => $customerCount,
            'vendorCount' => $vendorCount
        ]);
    }

    public function vendordashboard($id)
    {
       // return $id;
    //    $login_id = session()->get('login_id','status') == 1;
    //    dd($login_id);
        $productCount = DB::table('products')->where('created_by', $id)->count();
        
        $orderCount = DB::table('ecom_order_product')
            ->join('products', 'ecom_order_product.product_id', '=', 'products.id')
            ->where('products.created_by', $id)
            ->distinct('ecom_order_product.order_id')
            ->count('ecom_order_product.order_id');
            
        $customerCount = DB::table('ecom_order_info')
            ->join('ecom_order_product', 'ecom_order_info.order_id', '=', 'ecom_order_product.order_id')
            ->join('products', 'ecom_order_product.product_id', '=', 'products.id')
            ->where('products.created_by', $id)
            ->distinct('ecom_order_info.customer_id')
            ->count('ecom_order_info.customer_id');

        return view('layout.vendor.dashboard.dashboard')->with([
            'vendorid' => $id,
            'productCount' => $productCount,
            'orderCount' => $orderCount,
            'customerCount' => $customerCount
        ]);
    }

    public function staffdashboard($id)
    {
        //$vendor_id = Auth::user()->login_id;

        
       $Staffcreates    = Staffcreates::where('employee_id',$id )->get();
         $department =  ($Staffcreates[0]->department);
            $roll   =  Roll::where('roll', $department)->get();
                //   $roll =  ($role[0]->permission_id);
                    Session::put('roll', $roll);
                //   $staffs = json_decode($roll->permission_id);
        //return ($roll);
        return view('layout.staff.dashboard.dashboard')->with([
            'vendorid' => $id,
            // 'roll' => $roll
        ]);
    }

}
