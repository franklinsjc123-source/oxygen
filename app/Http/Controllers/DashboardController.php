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
    public function admindashboard(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $staffId = $request->input('staff_id');
        $packageId = $request->input('package_id');

        // Fetch lists for filter dropdowns
        $staffList = DB::table('staffother')->select('id', 'fullname', 'username')->get();
        $packageList = DB::table('packages')->select('id', 'name')->get();

        // 1. Setup base vendor query with filters
        $vendorQuery = DB::table('vendor_details');
        if ($staffId) {
            $vendorQuery->where('vendor_details.staff_id', $staffId);
        }
        if ($packageId) {
            $vendorQuery->where('vendor_details.package_id', $packageId);
        }
        if ($startDate && $endDate) {
            $vendorQuery->whereBetween('vendor_details.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        
        $vendorCount = $vendorQuery->count();
        $vendorIds = $vendorQuery->pluck('id')->toArray();

        // Setup products query
        $productQuery = DB::table('products')->where('logintype', 'Vendor');
        if (!empty($vendorIds)) {
            $productQuery->whereIn('login_id', $vendorIds);
        } elseif ($staffId || $packageId || ($startDate && $endDate)) {
            $productQuery->whereIn('login_id', [-1]);
        }
        $productCount = $productQuery->count();

        // Setup orders query
        $orderIdsQuery = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id');
        if (!empty($vendorIds)) {
            $orderIdsQuery->whereIn('products.login_id', $vendorIds);
        } elseif ($staffId || $packageId || ($startDate && $endDate)) {
            $orderIdsQuery->whereIn('products.login_id', [-1]);
        }
        $matchingOrderIds = $orderIdsQuery->distinct('ecom_order_product.order_id')->pluck('ecom_order_product.order_id')->toArray();

        $orderQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $orderQuery->whereIn('order_id', $matchingOrderIds);
        } elseif ($staffId || $packageId || ($startDate && $endDate)) {
            $orderQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $orderQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $orderCount = $orderQuery->count();

        // Customers Count
        $customerCount = $orderQuery->distinct('customer_id')->count('customer_id');

        // Viewers (Number of viewers)
        // Recalculated based on filtered vendors and products
        $vendorQueryViews = DB::table('vendor_details');
        if ($staffId) {
            $vendorQueryViews->where('staff_id', $staffId);
        }
        if ($packageId) {
            $vendorQueryViews->where('package_id', $packageId);
        }
        $vendorProfileViews = $vendorQueryViews->sum('view_count') ?? 0;

        $productQueryViews = DB::table('products')->where('logintype', 'Vendor');
        if (!empty($vendorIds)) {
            $productQueryViews->whereIn('login_id', $vendorIds);
        } elseif ($staffId || $packageId) {
            $productQueryViews->whereIn('login_id', [-1]);
        }
        $productViews = $productQueryViews->sum('view_count') ?? 0;
        $totalViews = $vendorProfileViews + $productViews;

        // 2. Sales Over Time
        $salesTrendLabels = [];
        $salesTrendRevenue = [];
        $salesTrendOrders = [];

        if ($startDate && $endDate) {
            $period = new \DatePeriod(
                new \DateTime($startDate),
                new \DateInterval('P1D'),
                (new \DateTime($endDate))->modify('+1 day')
            );
            foreach ($period as $date) {
                $dayKey = $date->format('Y-m-d');
                $dayLabel = $date->format('d M');
                $salesTrendLabels[] = $dayLabel;
                $salesTrendRevenue[$dayKey] = 0;
                $salesTrendOrders[$dayKey] = 0;
            }

            $dbSalesTrendQuery = DB::table('ecom_order_product')
                ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                ->join('products', 'products.id', '=', 'products_details.products_id')
                ->whereBetween('ecom_order_product.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

            if (!empty($vendorIds)) {
                $dbSalesTrendQuery->whereIn('products.login_id', $vendorIds);
            } elseif ($staffId || $packageId) {
                $dbSalesTrendQuery->whereIn('products.login_id', [-1]);
            }

            $dbSalesTrend = $dbSalesTrendQuery
                ->selectRaw('DATE(ecom_order_product.created_at) as day, SUM(ecom_order_product.total_price) as total_sales, COUNT(DISTINCT ecom_order_product.order_id) as total_orders')
                ->groupBy('day')
                ->get();

            foreach ($dbSalesTrend as $trend) {
                if (isset($salesTrendRevenue[$trend->day])) {
                    $salesTrendRevenue[$trend->day] = (float) $trend->total_sales;
                    $salesTrendOrders[$trend->day] = (int) $trend->total_orders;
                }
            }
        } else {
            for ($i = 11; $i >= 0; $i--) {
                $monthKey = date('Y-m', strtotime("-$i months"));
                $monthLabel = date('M Y', strtotime("-$i months"));
                $salesTrendLabels[] = $monthLabel;
                $salesTrendRevenue[$monthKey] = 0;
                $salesTrendOrders[$monthKey] = 0;
            }

            $dbSalesTrendQuery = DB::table('ecom_order_product')
                ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                ->join('products', 'products.id', '=', 'products_details.products_id');

            if (!empty($vendorIds)) {
                $dbSalesTrendQuery->whereIn('products.login_id', $vendorIds);
            } elseif ($staffId || $packageId) {
                $dbSalesTrendQuery->whereIn('products.login_id', [-1]);
            }

            $dbSalesTrend = $dbSalesTrendQuery
                ->selectRaw('DATE_FORMAT(ecom_order_product.created_at, "%Y-%m") as month, SUM(ecom_order_product.total_price) as total_sales, COUNT(DISTINCT ecom_order_product.order_id) as total_orders')
                ->groupBy('month')
                ->get();

            foreach ($dbSalesTrend as $trend) {
                if (isset($salesTrendRevenue[$trend->month])) {
                    $salesTrendRevenue[$trend->month] = (float) $trend->total_sales;
                    $salesTrendOrders[$trend->month] = (int) $trend->total_orders;
                }
            }
        }

        $salesTrendRevenue = array_values($salesTrendRevenue);
        $salesTrendOrders = array_values($salesTrendOrders);

        // 3. Sales by Discount
        $salesDiscountQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $salesDiscountQuery->whereIn('order_id', $matchingOrderIds);
        } elseif ($staffId || $packageId || ($startDate && $endDate)) {
            $salesDiscountQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $salesDiscountQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $totalDiscountGiven = (float) $salesDiscountQuery->sum('discount_amount');
        
        $discountedQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $discountedQuery->whereIn('order_id', $matchingOrderIds);
        } elseif ($staffId || $packageId || ($startDate && $endDate)) {
            $discountedQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $discountedQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $discountedSales = (float) $discountedQuery->where('discount_amount', '>', 0)->sum('grand_total');

        $nonDiscountedQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $nonDiscountedQuery->whereIn('order_id', $matchingOrderIds);
        } elseif ($staffId || $packageId || ($startDate && $endDate)) {
            $nonDiscountedQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $nonDiscountedQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $nonDiscountedSales = (float) $nonDiscountedQuery->where(function($q) {
            $q->whereNull('discount_amount')->orWhere('discount_amount', 0);
        })->sum('grand_total');

        $salesDiscountLabels = ['Discounted Sales', 'Non-Discounted Sales'];
        $salesDiscountValues = [$discountedSales, $nonDiscountedSales];

        // 4. Sales by Location
        $salesLocationQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $salesLocationQuery->whereIn('order_id', $matchingOrderIds);
        } elseif ($staffId || $packageId || ($startDate && $endDate)) {
            $salesLocationQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $salesLocationQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $salesByLocation = $salesLocationQuery
            ->selectRaw('COALESCE(NULLIF(customer_state, ""), NULLIF(customer_city, ""), "Unknown") as location, SUM(grand_total) as total_sales')
            ->groupBy('location')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();

        $salesLocationLabels = [];
        $salesLocationValues = [];
        foreach ($salesByLocation as $loc) {
            $salesLocationLabels[] = $loc->location;
            $salesLocationValues[] = (float) $loc->total_sales;
        }
        if (empty($salesLocationLabels)) {
            $salesLocationLabels = ['No Data'];
            $salesLocationValues = [0];
        }

        // 5. Customers Over Time
        $customerTrendLabels = [];
        $customerTrendCounts = [];
        if ($startDate && $endDate) {
            $period = new \DatePeriod(
                new \DateTime($startDate),
                new \DateInterval('P1D'),
                (new \DateTime($endDate))->modify('+1 day')
            );
            foreach ($period as $date) {
                $dayKey = $date->format('Y-m-d');
                $dayLabel = $date->format('d M');
                $customerTrendLabels[] = $dayLabel;
                $customerTrendCounts[$dayKey] = 0;
            }

            $dbCustTrend = DB::table('ecom_customer_info')
                ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                ->selectRaw('DATE(created_at) as day, COUNT(*) as count')
                ->groupBy('day')
                ->get();

            foreach ($dbCustTrend as $trend) {
                if (isset($customerTrendCounts[$trend->day])) {
                    $customerTrendCounts[$trend->day] = (int) $trend->count;
                }
            }
        } else {
            for ($i = 11; $i >= 0; $i--) {
                $monthKey = date('Y-m', strtotime("-$i months"));
                $monthLabel = date('M Y', strtotime("-$i months"));
                $customerTrendLabels[] = $monthLabel;
                $customerTrendCounts[$monthKey] = 0;
            }

            $dbCustTrend = DB::table('ecom_customer_info')
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                ->groupBy('month')
                ->get();

            foreach ($dbCustTrend as $trend) {
                if (isset($customerTrendCounts[$trend->month])) {
                    $customerTrendCounts[$trend->month] = (int) $trend->count;
                }
            }
        }
        $customerTrendCounts = array_values($customerTrendCounts);

        // 6. Customers by Location
        $custLocationQuery = DB::table('ecom_customer_info');
        if ($startDate && $endDate) {
            $custLocationQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $customersByLocation = $custLocationQuery
            ->selectRaw('COALESCE(NULLIF(customer_state, ""), NULLIF(customer_city, ""), "Unknown") as location, COUNT(*) as count')
            ->groupBy('location')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        $custLocationLabels = [];
        $custLocationCounts = [];
        foreach ($customersByLocation as $loc) {
            $custLocationLabels[] = $loc->location;
            $custLocationCounts[] = $loc->count;
        }
        if (empty($custLocationLabels)) {
            $custLocationLabels = ['No Data'];
            $custLocationCounts = [0];
        }

        // 7. Returning Customers
        $retCustomersQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $retCustomersQuery->whereIn('order_id', $matchingOrderIds);
        } elseif ($staffId || $packageId || ($startDate && $endDate)) {
            $retCustomersQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $retCustomersQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $customerOrderCounts = $retCustomersQuery
            ->select('customer_id')
            ->selectRaw('COUNT(order_id) as orders_count')
            ->groupBy('customer_id')
            ->get();

        $returningCustomersCount = 0;
        $totalCustomersWhoOrdered = $customerOrderCounts->count();
        foreach ($customerOrderCounts as $coc) {
            if ($coc->orders_count > 1) {
                $returningCustomersCount++;
            }
        }
        $returningCustomersPercent = $totalCustomersWhoOrdered > 0 ? round(($returningCustomersCount / $totalCustomersWhoOrdered) * 100, 1) : 0;

        // 8. Vendors by Employees
        $vendorsByEmployeeQuery = DB::table('vendor_details')
            ->leftJoin('staffother', 'staffother.id', '=', 'vendor_details.staff_id');
        if ($startDate && $endDate) {
            $vendorsByEmployeeQuery->whereBetween('vendor_details.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        if ($packageId) {
            $vendorsByEmployeeQuery->where('vendor_details.package_id', $packageId);
        }
        
        $vendorsByEmployee = $vendorsByEmployeeQuery
            ->selectRaw('COALESCE(staffother.fullname, "Admin/Unknown") as employee_name, COUNT(vendor_details.id) as count')
            ->groupBy('employee_name')
            ->orderByDesc('count')
            ->get();

        $vendorsByEmployeeLabels = [];
        $vendorsByEmployeeCounts = [];
        foreach ($vendorsByEmployee as $vbe) {
            $vendorsByEmployeeLabels[] = $vbe->employee_name;
            $vendorsByEmployeeCounts[] = $vbe->count;
        }

        // 9. Vendors by Plans
        $vendorsByPlanQuery = DB::table('vendor_details')
            ->leftJoin('packages', 'packages.id', '=', 'vendor_details.package_id');
        if ($startDate && $endDate) {
            $vendorsByPlanQuery->whereBetween('vendor_details.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        if ($staffId) {
            $vendorsByPlanQuery->where('vendor_details.staff_id', $staffId);
        }

        $vendorsByPlan = $vendorsByPlanQuery
            ->selectRaw('COALESCE(packages.name, "No Plan") as plan_name, COUNT(vendor_details.id) as count')
            ->groupBy('plan_name')
            ->orderByDesc('count')
            ->get();

        $vendorsByPlanLabels = [];
        $vendorsByPlanCounts = [];
        foreach ($vendorsByPlan as $vbp) {
            $vendorsByPlanLabels[] = $vbp->plan_name;
            $vendorsByPlanCounts[] = $vbp->count;
        }

        // Recent Activities
        $recentActivitiesQuery = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->join('ecom_order_info', 'ecom_order_product.order_id', '=', 'ecom_order_info.order_id')
            ->where('products.flag', 1);

        if (!empty($vendorIds)) {
            $recentActivitiesQuery->whereIn('products.login_id', $vendorIds);
        } elseif ($staffId || $packageId) {
            $recentActivitiesQuery->whereIn('products.login_id', [-1]);
        }
        if ($startDate && $endDate) {
            $recentActivitiesQuery->whereBetween('ecom_order_product.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $recentActivities = $recentActivitiesQuery
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

        return view('layout.admin.dashboard.dashboard')->with([
            'startDate' => $startDate,
            'endDate' => $endDate,
            'staffId' => $staffId,
            'packageId' => $packageId,
            'staffList' => $staffList,
            'packageList' => $packageList,
            
            'productCount' => $productCount,
            'orderCount' => $orderCount,
            'customerCount' => $customerCount,
            'vendorCount' => $vendorCount,
            'totalViews' => $totalViews,

            'salesTrendLabels' => $salesTrendLabels,
            'salesTrendRevenue' => $salesTrendRevenue,
            'salesTrendOrders' => $salesTrendOrders,

            'salesDiscountLabels' => $salesDiscountLabels,
            'salesDiscountValues' => $salesDiscountValues,
            'totalDiscountGiven' => $totalDiscountGiven,

            'salesLocationLabels' => $salesLocationLabels,
            'salesLocationValues' => $salesLocationValues,

            'customerTrendLabels' => $customerTrendLabels,
            'customerTrendCounts' => $customerTrendCounts,

            'custLocationLabels' => $custLocationLabels,
            'custLocationCounts' => $custLocationCounts,

            'returningCustomersCount' => $returningCustomersCount,
            'returningCustomersPercent' => $returningCustomersPercent,

            'vendorsByEmployeeLabels' => $vendorsByEmployeeLabels,
            'vendorsByEmployeeCounts' => $vendorsByEmployeeCounts,

            'vendorsByPlanLabels' => $vendorsByPlanLabels,
            'vendorsByPlanCounts' => $vendorsByPlanCounts,

            'recentActivities' => $recentActivities
        ]);
    }

    public function vendordashboard(Request $request, $id = null)
    {
        if (auth()->check() && (int) auth()->user()->status === 2) {
            $id = auth()->user()->login_id;
        } elseif (empty($id) && session()->has('login_id')) {
            $id = session()->get('login_id');
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Setup base queries for this specific vendor
        $productQuery = DB::table('products')
            ->where('login_id', $id)
            ->where('logintype', 'Vendor')
            ->where('flag', 1);
        $productCount = $productQuery->count();

        // Setup orders query for this specific vendor
        $orderIdsQuery = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->where('products.login_id', $id)
            ->where('products.logintype', 'Vendor')
            ->where('products.flag', 1);

        if ($startDate && $endDate) {
            $orderIdsQuery->whereBetween('ecom_order_product.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $matchingOrderIds = $orderIdsQuery->distinct('ecom_order_product.order_id')->pluck('ecom_order_product.order_id')->toArray();

        $orderQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $orderQuery->whereIn('order_id', $matchingOrderIds);
        } else {
            $orderQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $orderQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $orderCount = $orderQuery->count();

        // Customers Count
        $customerCount = $orderQuery->distinct('customer_id')->count('customer_id');

        // Viewers (Number of viewers)
        $vendorProfileViews = DB::table('vendor_details')->where('id', $id)->value('view_count') ?? 0;
        $productViews = $productQuery->sum('view_count') ?? 0;
        $totalViews = $vendorProfileViews + $productViews;

        // 2. Sales Over Time
        $salesTrendLabels = [];
        $salesTrendRevenue = [];
        $salesTrendOrders = [];

        if ($startDate && $endDate) {
            $period = new \DatePeriod(
                new \DateTime($startDate),
                new \DateInterval('P1D'),
                (new \DateTime($endDate))->modify('+1 day')
            );
            foreach ($period as $date) {
                $dayKey = $date->format('Y-m-d');
                $dayLabel = $date->format('d M');
                $salesTrendLabels[] = $dayLabel;
                $salesTrendRevenue[$dayKey] = 0;
                $salesTrendOrders[$dayKey] = 0;
            }

            $dbSalesTrendQuery = DB::table('ecom_order_product')
                ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
                ->join('products', 'products.id', '=', 'products_details.products_id')
                ->where('products.login_id', $id)
                ->where('products.logintype', 'Vendor')
                ->where('products.flag', 1)
                ->whereBetween('ecom_order_product.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);

            $dbSalesTrend = $dbSalesTrendQuery
                ->selectRaw('DATE(ecom_order_product.created_at) as day, SUM(ecom_order_product.total_price) as total_sales, COUNT(DISTINCT ecom_order_product.order_id) as total_orders')
                ->groupBy('day')
                ->get();

            foreach ($dbSalesTrend as $trend) {
                if (isset($salesTrendRevenue[$trend->day])) {
                    $salesTrendRevenue[$trend->day] = (float) $trend->total_sales;
                    $salesTrendOrders[$trend->day] = (int) $trend->total_orders;
                }
            }
        } else {
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
        }

        $salesTrendRevenue = array_values($salesTrendRevenue);
        $salesTrendOrders = array_values($salesTrendOrders);

        // 3. Sales by Discount
        $salesDiscountQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $salesDiscountQuery->whereIn('order_id', $matchingOrderIds);
        } else {
            $salesDiscountQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $salesDiscountQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $totalDiscountGiven = (float) $salesDiscountQuery->sum('discount_amount');

        $discountedQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $discountedQuery->whereIn('order_id', $matchingOrderIds);
        } else {
            $discountedQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $discountedQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $discountedSales = (float) $discountedQuery->where('discount_amount', '>', 0)->sum('grand_total');

        $nonDiscountedQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $nonDiscountedQuery->whereIn('order_id', $matchingOrderIds);
        } else {
            $nonDiscountedQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $nonDiscountedQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $nonDiscountedSales = (float) $nonDiscountedQuery->where(function($q) {
            $q->whereNull('discount_amount')->orWhere('discount_amount', 0);
        })->sum('grand_total');

        $salesDiscountLabels = ['Discounted Sales', 'Non-Discounted Sales'];
        $salesDiscountValues = [$discountedSales, $nonDiscountedSales];

        // 4. Sales by Location
        $salesLocationQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $salesLocationQuery->whereIn('order_id', $matchingOrderIds);
        } else {
            $salesLocationQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $salesLocationQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $salesByLocation = $salesLocationQuery
            ->selectRaw('COALESCE(NULLIF(customer_state, ""), NULLIF(customer_city, ""), "Unknown") as location, SUM(grand_total) as total_sales')
            ->groupBy('location')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();

        $salesLocationLabels = [];
        $salesLocationValues = [];
        foreach ($salesByLocation as $loc) {
            $salesLocationLabels[] = $loc->location;
            $salesLocationValues[] = (float) $loc->total_sales;
        }
        if (empty($salesLocationLabels)) {
            $salesLocationLabels = ['No Data'];
            $salesLocationValues = [0];
        }

        // 5. Customers Over Time
        $vendorCustomersQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $vendorCustomersQuery->whereIn('order_id', $matchingOrderIds);
        } else {
            $vendorCustomersQuery->whereIn('order_id', [-1]);
        }
        $matchingCustomerIds = $vendorCustomersQuery->distinct('customer_id')->pluck('customer_id')->toArray();

        $customerTrendLabels = [];
        $customerTrendCounts = [];
        if ($startDate && $endDate) {
            $period = new \DatePeriod(
                new \DateTime($startDate),
                new \DateInterval('P1D'),
                (new \DateTime($endDate))->modify('+1 day')
            );
            foreach ($period as $date) {
                $dayKey = $date->format('Y-m-d');
                $dayLabel = $date->format('d M');
                $customerTrendLabels[] = $dayLabel;
                $customerTrendCounts[$dayKey] = 0;
            }

            $custQuery = DB::table('ecom_customer_info');
            if (!empty($matchingCustomerIds)) {
                $custQuery->whereIn('customer_id', $matchingCustomerIds);
            } else {
                $custQuery->whereIn('customer_id', [-1]);
            }
            $dbCustTrend = $custQuery
                ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
                ->selectRaw('DATE(created_at) as day, COUNT(*) as count')
                ->groupBy('day')
                ->get();

            foreach ($dbCustTrend as $trend) {
                if (isset($customerTrendCounts[$trend->day])) {
                    $customerTrendCounts[$trend->day] = (int) $trend->count;
                }
            }
        } else {
            for ($i = 11; $i >= 0; $i--) {
                $monthKey = date('Y-m', strtotime("-$i months"));
                $monthLabel = date('M Y', strtotime("-$i months"));
                $customerTrendLabels[] = $monthLabel;
                $customerTrendCounts[$monthKey] = 0;
            }

            $custQuery = DB::table('ecom_customer_info');
            if (!empty($matchingCustomerIds)) {
                $custQuery->whereIn('customer_id', $matchingCustomerIds);
            } else {
                $custQuery->whereIn('customer_id', [-1]);
            }
            $dbCustTrend = $custQuery
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
                ->groupBy('month')
                ->get();

            foreach ($dbCustTrend as $trend) {
                if (isset($customerTrendCounts[$trend->month])) {
                    $customerTrendCounts[$trend->month] = (int) $trend->count;
                }
            }
        }
        $customerTrendCounts = array_values($customerTrendCounts);

        // 6. Customers by Location
        $custLocationQuery = DB::table('ecom_customer_info');
        if (!empty($matchingCustomerIds)) {
            $custLocationQuery->whereIn('customer_id', $matchingCustomerIds);
        } else {
            $custLocationQuery->whereIn('customer_id', [-1]);
        }
        if ($startDate && $endDate) {
            $custLocationQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $customersByLocation = $custLocationQuery
            ->selectRaw('COALESCE(NULLIF(customer_state, ""), NULLIF(customer_city, ""), "Unknown") as location, COUNT(*) as count')
            ->groupBy('location')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        $custLocationLabels = [];
        $custLocationCounts = [];
        foreach ($customersByLocation as $loc) {
            $custLocationLabels[] = $loc->location;
            $custLocationCounts[] = $loc->count;
        }
        if (empty($custLocationLabels)) {
            $custLocationLabels = ['No Data'];
            $custLocationCounts = [0];
        }

        // 7. Returning Customers
        $retCustomersQuery = DB::table('ecom_order_info');
        if (!empty($matchingOrderIds)) {
            $retCustomersQuery->whereIn('order_id', $matchingOrderIds);
        } else {
            $retCustomersQuery->whereIn('order_id', [-1]);
        }
        if ($startDate && $endDate) {
            $retCustomersQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }

        $customerOrderCounts = $retCustomersQuery
            ->select('customer_id')
            ->selectRaw('COUNT(order_id) as orders_count')
            ->groupBy('customer_id')
            ->get();

        $returningCustomersCount = 0;
        $totalCustomersWhoOrdered = $customerOrderCounts->count();
        foreach ($customerOrderCounts as $coc) {
            if ($coc->orders_count > 1) {
                $returningCustomersCount++;
            }
        }
        $returningCustomersPercent = $totalCustomersWhoOrdered > 0 ? round(($returningCustomersCount / $totalCustomersWhoOrdered) * 100, 1) : 0;

        // Sales by Payment Method
        $paymentTypes = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->join('ecom_order_info', 'ecom_order_product.order_id', '=', 'ecom_order_info.order_id')
            ->where('products.login_id', $id)
            ->where('products.logintype', 'Vendor')
            ->where('products.flag', 1);
        if ($startDate && $endDate) {
            $paymentTypes->whereBetween('ecom_order_product.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $paymentTypes = $paymentTypes
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

        // Category wise products
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

        // Orders by Status
        $orderStatuses = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->where('products.login_id', $id)
            ->where('logintype', 'Vendor')
            ->where('products.flag', 1);
        if ($startDate && $endDate) {
            $orderStatuses->whereBetween('ecom_order_product.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $orderStatuses = $orderStatuses
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

        // Recent Activities
        $recentActivitiesQuery = DB::table('ecom_order_product')
            ->join('products_details', 'products_details.id', '=', 'ecom_order_product.product_id')
            ->join('products', 'products.id', '=', 'products_details.products_id')
            ->join('ecom_order_info', 'ecom_order_product.order_id', '=', 'ecom_order_info.order_id')
            ->where('products.login_id', $id)
            ->where('products.logintype', 'Vendor')
            ->where('products.flag', 1);
        if ($startDate && $endDate) {
            $recentActivitiesQuery->whereBetween('ecom_order_product.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        }
        $recentActivities = $recentActivitiesQuery
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
            'startDate' => $startDate,
            'endDate' => $endDate,
            'productCount' => $productCount,
            'orderCount' => $orderCount,
            'customerCount' => $customerCount,
            'totalViews' => $totalViews,

            'salesTrendLabels' => $salesTrendLabels,
            'salesTrendRevenue' => $salesTrendRevenue,
            'salesTrendOrders' => $salesTrendOrders,

            'salesDiscountLabels' => $salesDiscountLabels,
            'salesDiscountValues' => $salesDiscountValues,
            'totalDiscountGiven' => $totalDiscountGiven,

            'salesLocationLabels' => $salesLocationLabels,
            'salesLocationValues' => $salesLocationValues,

            'customerTrendLabels' => $customerTrendLabels,
            'customerTrendCounts' => $customerTrendCounts,

            'custLocationLabels' => $custLocationLabels,
            'custLocationCounts' => $custLocationCounts,

            'returningCustomersCount' => $returningCustomersCount,
            'returningCustomersPercent' => $returningCustomersPercent,

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
