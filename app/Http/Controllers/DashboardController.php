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
        if (auth()->check() && (int) auth()->user()->status === 2) {
            $id = auth()->user()->login_id;
        } elseif (empty($id) && session()->has('login_id')) {
            $id = session()->get('login_id');
        }

        $productCount = DB::table('products')
            ->where('login_id', $id)
            ->where('logintype', 'Vendor')
            ->where('flag', 1)
            ->count();
        
        $orderCount = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->where('products.login_id', $id)
            ->where('products.logintype', 'Vendor')
            ->where('products.flag', 1)
            ->distinct('ecom_order_product.order_id')
            ->count('ecom_order_product.order_id');
            
        $customerCount = DB::table('ecom_order_info')
            ->join('ecom_order_product', 'ecom_order_info.order_id', '=', 'ecom_order_product.order_id')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->where('products.login_id', $id)
            ->where('products.logintype', 'Vendor')
            ->where('products.flag', 1)
            ->distinct('ecom_order_info.customer_id')
            ->count('ecom_order_info.customer_id');

        $vendorProfileViews = DB::table('vendor_details')->where('id', $id)->value('view_count') ?? 0;
        $productViews = DB::table('products')
            ->where('login_id', $id)
            ->where('logintype', 'Vendor')
            ->where('flag', 1)
            ->sum('view_count') ?? 0;
        $totalViews = $vendorProfileViews + $productViews;

        // 1. Sales & Orders Trend (Last 12 Months)
        $salesTrendLabels = [];
        $salesTrendRevenue = [];
        $salesTrendOrders = [];
        for ($i = 11; $i >= 0; $i--) {
            $monthKey = date('Y-m', strtotime("-$i months"));
            $monthLabel = date('M Y', strtotime("-$i months"));
            $salesTrendLabels[] = $monthLabel;
            $salesTrendRevenue[$monthKey] = 0;
            $salesTrendOrders[$monthKey] = 0;
        }

        $dbSalesTrend = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->where('products.login_id', $id)
            ->where('products.logintype', 'Vendor')
            ->where('products.flag', 1)
            ->selectRaw('DATE_FORMAT(ecom_order_product.created_at, "%Y-%m") as month, SUM(ecom_order_product.total_price) as total_sales, COUNT(DISTINCT ecom_order_product.order_id) as total_orders')
            ->groupBy('month')
            ->get();

        foreach ($dbSalesTrend as $trend) {
            if (isset($salesTrendRevenue[$trend->month])) {
                $salesTrendRevenue[$trend->month] = (float) $trend->total_sales;
                $salesTrendOrders[$trend->month] = (int) $trend->total_orders;
            }
        }

        $salesTrendRevenue = array_values($salesTrendRevenue);
        $salesTrendOrders = array_values($salesTrendOrders);

        // 2. Sales by Payment Method
        $paymentTypes = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->join('ecom_order_info', 'ecom_order_product.order_id', '=', 'ecom_order_info.order_id')
            ->where('products.login_id', $id)
            ->where('products.logintype', 'Vendor')
            ->where('products.flag', 1)
            ->selectRaw('ecom_order_info.payment_type, COUNT(DISTINCT ecom_order_product.order_id) as count')
            ->groupBy('ecom_order_info.payment_type')
            ->get();

        $paymentLabels = [];
        $paymentCounts = [];
        foreach ($paymentTypes as $pt) {
            $label = $pt->payment_type ?: 'Unknown';
            $paymentLabels[] = $label;
            $paymentCounts[] = $pt->count;
        }

        if (empty($paymentLabels)) {
            $paymentLabels = ['Cash On Delivery', 'Online Transaction'];
            $paymentCounts = [0, 0];
        }

        // 3. Category wise Products (Main Category Name and Product Count)
        $allCategories = DB::table('category_main')->where('status', 1)->get();
        $vendorProductCounts = DB::table('products')
            ->where('login_id', $id)
            ->where('logintype', 'Vendor')
            ->where('flag', 1)
            ->selectRaw('category_main, COUNT(*) as count')
            ->groupBy('category_main')
            ->pluck('count', 'category_main')
            ->toArray();

        $categoryLabels = [];
        $categoryCounts = [];
        foreach ($allCategories as $cat) {
            $categoryLabels[] = $cat->category_main_name;
            $categoryCounts[] = isset($vendorProductCounts[$cat->id]) ? (int)$vendorProductCounts[$cat->id] : 0;
        }

        if (empty($categoryLabels)) {
            $categoryLabels = ['Other'];
            $categoryCounts = [0];
        }

        // 4. Orders by Status
        $orderStatuses = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->where('products.login_id', $id)
            ->where('products.logintype', 'Vendor')
            ->where('products.flag', 1)
            ->selectRaw('order_status, COUNT(*) as count')
            ->groupBy('order_status')
            ->get();

        $statusLabels = [];
        $statusCounts = [];
        foreach ($orderStatuses as $os) {
            $statusLabels[] = $os->order_status ?: 'Pending';
            $statusCounts[] = $os->count;
        }

        if (empty($statusLabels)) {
            $statusLabels = ['Pending', 'Delivered', 'Dispatch', 'Accept'];
            $statusCounts = [0, 0, 0, 0];
        }

        // 5. Recent Activities (Latest Orders)
        $recentActivities = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->join('ecom_order_info', 'ecom_order_product.order_id', '=', 'ecom_order_info.order_id')
            ->where('products.login_id', $id)
            ->where('products.logintype', 'Vendor')
            ->where('products.flag', 1)
            ->select(
                'ecom_order_product.product_name',
                'ecom_order_product.product_quantity',
                'ecom_order_product.total_price',
                'ecom_order_product.product_image',
                'ecom_order_product.order_status',
                'ecom_order_product.created_at',
                'ecom_order_info.customer_firstname',
                'ecom_order_info.customer_lastname'
            )
            ->orderByDesc('ecom_order_product.id')
            ->take(5)
            ->get();

        return view('layout.vendor.dashboard.dashboard')->with([
            'vendorid' => $id,
            'productCount' => $productCount,
            'orderCount' => $orderCount,
            'customerCount' => $customerCount,
            'totalViews' => $totalViews,
            'salesTrendLabels' => $salesTrendLabels,
            'salesTrendRevenue' => $salesTrendRevenue,
            'salesTrendOrders' => $salesTrendOrders,
            'paymentLabels' => $paymentLabels,
            'paymentCounts' => $paymentCounts,
            'categoryLabels' => $categoryLabels,
            'categoryCounts' => $categoryCounts,
            'statusLabels' => $statusLabels,
            'statusCounts' => $statusCounts,
            'recentActivities' => $recentActivities
        ]);
    }

    public function staffdashboard($id)
    {
        //$vendor_id = Auth::user()->login_id;

        
       $Staffcreates    = Staffcreates::where('employee_id',$id )->get();
       if ($Staffcreates->isEmpty()) {
           return redirect()->route('stafflogin')->with('error', 'Staff details not found.');
       }
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
