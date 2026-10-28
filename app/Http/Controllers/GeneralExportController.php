<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductColorExport;
use App\Exports\ProductCollectionExport;
use App\Exports\CouponExport;
use App\Exports\VendorExport;
use App\Exports\OrderExport;
use App\Exports\OfferExport;
use App\Exports\DepartmentExport;
use App\Exports\DesignationExport;
use App\Exports\GstExport;
use App\Exports\PackageExport;
use App\Exports\ActivityTrackerExport;
use App\Exports\StateExport;
use App\Exports\CityExport;
use App\Exports\AttributeGroupExport;
use App\Exports\SpecificationGroupExport;
use App\Exports\CategoryMainExport;
use App\Exports\CategoryExport;
use App\Exports\CategorySubExport;

class GeneralExportController extends Controller
{
    public function exportColor()
    {
        return Excel::download(new ProductColorExport, 'product_colors_report.xlsx');
    }

    public function exportCollection()
    {
        return Excel::download(new ProductCollectionExport, 'product_collections_report.xlsx');
    }

    public function exportCoupon()
    {
        return Excel::download(new CouponExport, 'coupons_report.xlsx');
    }

    public function exportVendor()
    {
        return Excel::download(new VendorExport, 'vendors_report.xlsx');
    }

    public function exportOrder(Request $request)
    {
        $vendorId = null;
        if (request()->is('vendor/*') || (session()->has('login_id') && session()->get('role') == 'vendor')) {
            $vendorId = session()->get('login_id');
        }
        return Excel::download(new OrderExport($vendorId), 'orders_report.xlsx');
    }

    public function exportOffer()
    {
        return Excel::download(new OfferExport, 'offers_report.xlsx');
    }

    public function exportDepartment()
    {
        return Excel::download(new DepartmentExport, 'departments_report.xlsx');
    }

    public function exportDesignation()
    {
        return Excel::download(new DesignationExport, 'designations_report.xlsx');
    }

    public function exportGst()
    {
        return Excel::download(new GstExport, 'gst_report.xlsx');
    }

    public function exportPackage()
    {
        return Excel::download(new PackageExport, 'packages_report.xlsx');
    }

    public function exportActivity()
    {
        return Excel::download(new ActivityTrackerExport, 'activities_report.xlsx');
    }

    public function exportState()
    {
        return Excel::download(new StateExport, 'states_report.xlsx');
    }

    public function exportCity()
    {
        return Excel::download(new CityExport, 'cities_report.xlsx');
    }

    public function exportAttribute()
    {
        return Excel::download(new AttributeGroupExport, 'attribute_groups_report.xlsx');
    }

    public function exportSpecification()
    {
        $vendor_id = session()->get('log_type') === 'Vendor' ? session()->get('login_id') : null;
        return Excel::download(new SpecificationGroupExport($vendor_id), 'specification_groups_report.xlsx');
    }

    public function exportMainCategory()
    {
        return Excel::download(new CategoryMainExport, 'category_main_report.xlsx');
    }

    public function exportCategory()
    {
        return Excel::download(new CategoryExport, 'category_report.xlsx');
    }

    public function exportSubCategory()
    {
        return Excel::download(new CategorySubExport, 'subcategory_report.xlsx');
    }
}
