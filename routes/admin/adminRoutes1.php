<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\BannerController;

use App\Http\Controllers\Banners\main_slidvController;
use App\Http\Controllers\Banners\oxygen_advController;
use App\Http\Controllers\Banners\paid_adv_banerController;


use App\Http\Controllers\Auction\auctionController;
use App\Http\Controllers\OfferController;
// use App\Http\Controllers\MarketingController;
//Marketting
use App\Http\Controllers\Marketting\WhAppController;
use App\Http\Controllers\Marketting\FaceBookController;
use App\Http\Controllers\Marketting\InstaController;
use App\Http\Controllers\Marketting\OxygenController;

use App\Http\Controllers\StaffController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController\CategoryController;
use App\Http\Controllers\CategoryMainController\CategoryMainController;
use App\Http\Controllers\CategorySubController\CategorySubController;
use App\Http\Controllers\ProductsController\ProductsController;
use App\Http\Controllers\ProductsController\CollectionController;
use App\Http\Controllers\ProductsController\ProductCollectionController;
use App\Http\Controllers\ProductsController\AttributeController;
use App\Http\Controllers\GstController\GstController;
use App\Http\Controllers\vendor\PackageController;
use App\Http\Controllers\vendor\VendorcreateController;
use App\Http\Controllers\ProductsController\SpecificationController;
use App\Http\Controllers\coupon\CouponController;
use App\Http\Controllers\PinCodeController\PinCodeController;
use App\Http\Controllers\PinCodeController1\PinCodeController1;
use App\Http\Controllers\designation\designationController;
use App\Http\Controllers\ProductsController\AttributeGroupController;
use App\Http\Controllers\ProductsController\SpecificationGroupController;
// use App\Http\Controllers\StaffController\StaffController;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [AuthController::class, 'register']);
Route::get('/', function () {
    return view('auth.adminlogin');
});
Route::get('login', function () {
    $viewBag['error'] = '';
    return view('auth.adminlogin');
})->name('adminerror');
Route::post('login', [AuthController::class, 'adminlogin'])->name('adminlogin');


Route::get('dashboard', [DashboardController::class, 'admindashboard'])
    ->name('admindashboard')
    ->middleware('auth');

// Category Main
Route::resource('category_main', CategoryMainController::class, ['names' => 'category.main']);
Route::post('category_main/update/{id}', [CategoryMainController::class, 'update'])->name('category_main_update');
//category
Route::resource('category', CategoryController::class, ['names' => 'category']);
Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category_update');

Route::post('subcategory/update/{id}', [CategorySubController::class, 'update'])->name('subcategory_update');

// Category Sub
Route::resource('category_sub', CategorySubController::class, ['names' => 'category.sub']);
Route::resource('attribute_groups', AttributeGroupController::class);
Route::post('update_attributevalues', [AttributeGroupController::class, 'update_attributes'])->name('update_attributevalues');
Route::resource('specification_groups', SpecificationGroupController::class);
Route::post('update_specification', [SpecificationGroupController::class, 'update_specification'])->name('update_specification');

//Pincode
//Route::resource('pincode', PinCodeController::class, ['names' => 'pincode']);
// Route::resource('pincode', PinCodeController::class, ['names' => 'pincode']);
Route::resource('pincode1', PinCodeController1::class, ['names' => 'pincode1']);

// Route::match(['put', 'patch'], '/pincode1/update/{id}','PinCodeController1@update');
//  Route::post('pincode1/update/{id}', 'PinCodeController1@update');
//Staff Controller
// Route::resource('staff/create', StaffController::class, ['names' => 'staff']);
// Gst Controller 
Route::resource('gst_master', GstController::class, ['names' => 'gst.master']);

//Route::resource('gst_master', GstController::class, ['names' => 'gst.master']);
// php artisan make:controller <controller name>  --resource
//Route::post('/gst', [GstController::class, 'gst'])->name('gst');
Route::get('editgst/{id}/edit', [GstController::class, 'editgst']);

Route::post('gstupdate/{id}/update', [GstController::class, 'updategst'])->name('gstupdate');



Route::resource('offer/create', OfferController::class, ['names' => 'offer.main']);

Route::resource('offer/list', OfferController::class, ['names' => 'offer.list']);
// Route::get('offer/list', [OfferController::class, 'index'])->name('offer.list');

// Route::post('offer/offerupdate', OfferController::class, ['names' => 'offer.update']);

// Route::get('Offer/index', [OfferController::class, 'list'])->name('index');



//Route::get('offer/create', [OfferController::class, 'create']);
//Route::post('offer/create', [OfferController::class, 'create']);


Route::post("products/addinfo", [ProductsController::class, "addinfo"])->name('products.addinfo');
Route::resource("products_crud", ProductsController::class, ['names' => 'products.crud'])->middleware('auth');

Route::get("products/listing", [ProductsController::class, "listing"])->name('products.crud.listing');
Route::get("products/view/{id}", [ProductsController::class, "view"])->name('products.crud.view');


Route::get("vendor_products/view/{id}/{sub_id?}", [ProductsController::class, "v_p_view"])->name('vendor_products.admin.view');
Route::get("vendor_products/listing", [ProductsController::class, "vendorlisting"])->name('vendor_products.crud.listing');
Route::post("vendor_products/{id}", [ProductsController::class, "v_p_destroy"])->name('vendor_products.admin');

// Route::post("products/details_update", [ProductsController::class, "updateProductDetails"])->name('products.details.update');




Route::post('productbulkdelete', [ProductsController::class, 'productbulkdelete'])->name('productbulkdelete');
Route::post('productbulkactive', [ProductsController::class, 'productbulkactive'])->name('productbulkactive');
Route::post('productbulkdeactive', [ProductsController::class, 'productbulkdeactive'])->name('productbulkdeactive');

// /*Vendar bulk data*/
// Route::post('vendorproductbulkdelete', [ProductsController::class, 'vendorproductbulkdelete'])->name('vendorproductbulkdelete');
// Route::post('vendorproductbulkactive', [ProductsController::class, 'vendorproductbulkactive'])->name('vendorproductbulkactive');
// Route::post('vendorproductbulkdeactive', [ProductsController::class, 'vendorproductbulkdeactive'])->name('vendorproductbulkdeactive');

Route::post("products/productdetailsdelete", [ProductsController::class, "productdetailsdelete"])->name('products.crud.productdetailsdelete');

Route::get("products/edit/{id}/{sub_id?}", [ProductsController::class, "edit"])->name('products.crud.edit');

Route::post("products/offerupdate", [ProductsController::class, "offerupdate"])->name('offer.update');
Route::get('products/getsubproductdetails', [ProductsController::class, 'getsubproductdetails'])->name('getsubproductdetails');

Route::get('product_export',[ProductsController::class, 'get_product_data'])->name('product.export');

Route::resource('attribute-listing', AttributeController::class, ['names' => 'attribute.master']);

Route::resource('product-collection', ProductCollectionController::class, ['names' => 'productcollection.master']);
Route::post('productcollection/update/{id}', [ProductCollectionController::class, 'update'])->name('productcollection_update');
Route::resource('product-specification', SpecificationController::class, ['names' => 'product.specification']);

/*Edit Attribute*/
Route::get('editattribute/{id}/edit', [AttributeController::class, 'editattribute']);
Route::post('attributeupdate/{id}/update', [AttributeController::class, 'updateattribute'])->name('attributeupdate');


/*Edit specification*/
Route::get('editspec/{id}/edit', [SpecificationController::class, 'editspec']);
Route::post('specupdate/{id}/update', [SpecificationController::class, 'updatespec'])->name('specupdate');

Route::get('catedetails', [AttributeController::class, 'catedetails'])->name('catedetails');
Route::get('scatedetails', [SpecificationController::class, 'scatedetails'])->name('scatedetails');


// Get Value By On Change Fields
Route::get('get-category', [CategoryController::class, 'getCategory'])->name('getCategory');
Route::get('get-sub-category', [CategoryController::class, 'getSubCategory'])->name('getSubCategory');
Route::get('get-attribute', [AttributeController::class, 'getAttributes'])->name('getAttributes');
Route::post('adminsearchdetails', [AttributeController::class, 'adminsearchdetails'])->name('adminsearchdetails');
Route::get('get-spec-value', [SpecificationController::class, 'getSpecValue'])->name('getSpecValue');
Route::get('get-specification', [SpecificationController::class, 'getSpecifications'])->name('getSpecifications');
Route::get('get_product_details', [ProductsController::class, 'getProductDetails'])->name('getProductDetails');
Route::get('get_zonal', [MasterController::class, 'getZonalById'])->name('getZonal');
Route::get('get_route', [MasterController::class, 'getrouteById'])->name('getroute');
Route::post("products/productsdetailsdelete/{id?}", [ProductsController::class, "productsdetailsdelete"])->name('productdetailsdelete');

Route::get('editzonal/{id}/edit', [MasterController::class, 'editzonal'])->name('editzonal');


Route::post('zonalupdate/{id}/update', [MasterController::class, 'updatezonal'])->name('zonalupdate');
Route::post('zonaldelete/{id}', [MasterController::class, 'deletezonal'])->name('zonaldelete');
           
//sales
// Route::get('order', [SalesController::class, 'order'])->name('order');
Route::get('transaction', [SalesController::class, 'transaction'])->name('transaction');
// Route::post('orderstatusupdate/{id}', [SalesController::class, 'orderstatusupdate'])->name('orderstatusupdate');


Route::get('order', [SalesController::class, 'order'])->name('order');
Route::post('orderstatusupdate/{id}', [SalesController::class, 'orderstatusupdate'])->name('orderstatusupdate');

Route::post('orderbulkstatusupdate', [SalesController::class, 'orderbulkstatusupdate'])->name('orderbulkstatusupdate');

//coupon
Route::get('coupon/create', [CouponsController::class, 'create']);
Route::resource('coupon', CouponController::class, ['names' => 'coupon']);
//Route::resource('coupon', CouponController::class, ['names' => 'coupon']);
// Route::get("products/listing", [ProductsController::class, "listing"])->name('products.crud.listing');

Route::get('couponlisting', [CouponController::class, "couponlisting"])->name('coupon.couponlisting');


//banner
// Route::get('advbanner', [BannerController::class, 'banner'])->name('advbanner');

// Route::get('advoxygen', [BannerController::class, 'oxygen'])->name('advoxygen');

// Route::get('slider', [BannerController::class, 'slider'])->name('banners.slider');

Route::resource('advbanner', paid_adv_banerController::class, ['names' => 'advbanner']);
Route::get('editadvbanner/{id}', [paid_adv_banerController::class, 'edit'])->name('editadvbanner');

Route::resource('advoxygen', oxygen_advController::class, ['names' => 'advoxygen']);
Route::get('editadvoxygen/{id}', [oxygen_advController::class, 'edit'])->name('editadvoxygen');

Route::resource('slider', main_slidvController::class, ['names' => 'main_slider']);
Route::get('editmain_slider/{id}', [main_slidvController::class, 'edit'])->name('editmain_slider');


//auction

Route::resource('auction', AuctionController::class, ['names' => 'auction']);

//  Route::get('auction/create', [AuctionController::class, 'create'])->name('auction/create');

Route::get('auction_list', [AuctionController::class, 'list'])->name('auction/list');

Route::controller(AuctionController::class)->group(function(){

    Route::post('users-import', 'import')->name('import');
});

Route::controller(PinCodeController1::class)->group(function(){

    Route::post('importpincode','importpincode')->name('importpincode'); 
  });
//offer
//Route::get('offer/create', [OfferController::class, 'create']);

//Route::get('offer/list', [OfferController::class, 'list']);

//marketting   
Route::resource('whatsapp',  WhAppController::class,['names' => 'whatsapp']);
Route::resource('facebook',  FaceBookController::class,['names' => 'facebook']);
Route::resource('instagram',  InstaController::class,['names' => 'instagram']);
Route::resource('oxygen',  OxygenController::class,['names' => 'oxygen']);


// Route::get('marketing/facebook', [MarketingController::class, 'facebook']);
// Route::get('marketing/instagram', [MarketingController::class, 'instagram']);
// Route::get('marketing/whatsapp', [MarketingController::class, 'whatsapp']);
// Route::get('marketing/oxygen', [MarketingController::class, 'oxygen']);

//staff
Route::get('staff/create', [StaffController::class, 'create']);

Route::get('staff/list', [StaffController::class, 'list'])->name('staff-list');
Route::post('staff/store', [StaffController::class, 'store']);
Route::post('staff/update/{id}', [StaffController::class, 'update']);
Route::delete('staff/destroy/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
Route::get('staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
Route::get('get-staffdepartment', [StaffController::class, 'getstaffdepartment'])->name('getstaffdepartment');
Route::get('staff_export',[StaffController::class, 'get_staff_data'])->name('staff.export');

// Route::delete('staff/destroy/{id}', 'StaffController@destroy')->namfe('staff.destroy');
//role
Route::resource('role',  RollController::class,['names' => 'roll']);

Route::get('role_list', [RollController::class, 'list'])->name('rolelist');

//vendor
Route::get('vendor/create', [VendorController::class, 'create']);

//activity
Route::get('activity/create', [ActivityController::class, 'create']);

Route::get('activity/list', [ActivityController::class, 'list']);

//Master
Route::get('department', [MasterController::class, 'department'])->name('department');
Route::post('department', [MasterController::class, 'department']);


Route::get('editdepartment/{id}/edit', [MasterController::class, 'editdepartment']);
Route::post('departmentdelete/{id}', [MasterController::class, 'departmentdelete'])->name('departmentdelete');
Route::post('departmentupdate/{id}/update', [MasterController::class, 'updatedepartment'])->name('departmentupdate');


Route::post('/Departmentssave', [MasterController::class, 'saveDepartments'])->name('Departmentssave');
Route::post('/checkDepartmentnamePost', [MasterController::class, 'checkDepartmentnamePost'])->name('checkDepartmentnamePost');
//Route::get('designation', [MasterController::class, 'designation'])->name('designation');
//Route::get('add_designation', [AdminController::class, 'designation'])->name('add_designation');

Route::resource('designation_master', designationController::class,['names' => 'designation.master']);

Route::get('getdepartment', [designationController::class, 'getdepartment'])->name('getdepartment');

Route::get('gst', [MasterController::class, 'gst']);

Route::get('package', [MasterController::class, 'package']);

Route::get('pincode', [MasterController::class, 'pincode']);
Route::post('/savePincodes', [MasterController::class, 'savePincodes'])->name('savePincodes');
Route::post('/checkPincodenamePost', [MasterController::class, 'checkPincodenamePost'])->name('checkPincodenamePost');
 
Route::get('route', [MasterController::class, 'route'])->name('aroute');
Route::post('/saveRoute', [MasterController::class, 'saveRoute'])->name('saveRoute');
Route::get('route_delete/{{ $id }}', [MasterController::class, 'route_delete']);
Route::get('editroute/{id}/edit', [MasterController::class, 'editroute'])->name('editroute');
Route::post('route_update/{id}', [MasterController::class, 'route_update'])->name('route_update');

Route::post('routedelete/{id}', [MasterController::class, 'deleteroute'])->name('routedelete');


Route::post('/checRoutenamePost', [MasterController::class, 'checRoutenamePost'])->name('checRoutenamePost');

Route::get('zonal', [MasterController::class, 'zonal'])->name('zonal');
//Route::post('/getZonalById', [MasterController::class, 'getZonalById'])->name('getZonalById');
Route::post('/saveZonals', [MasterController::class, 'saveZonals'])->name('saveZonals');
Route::post('/checkZonalnamePost', [MasterController::class, 'checkZonalnamePost'])->name('checkZonalnamePost');
Route::post('/zonalsListingPost', [MasterController::class, 'zonalsListingPost'])->name('zonalsListingPost');

//Setting

Route::get('profile', [SettingController::class, 'profile']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

/*Export data*/
Route::get('route_export',[MasterController::class, 'get_route_data'])->name('route.export');
Route::get('zone_export',[MasterController::class, 'get_zone_data'])->name('zone.export');
Route::get('pincode_export',[MasterController::class, 'get_pincode_data'])->name('pincode.export');

//vendor

Route::resource('package', PackageController::class, ['names' => 'package']);
Route::resource('vendorcreate', VendorcreateController::class, ['names' => 'vendorcreate']);

Route::get('vendor/list', [VendorcreateController::class, 'list'])->name('vendor-list');

Route::Post('/Ajaxpackage', [VendorcreateController::class, 'Ajaxpackage'])->name('Ajaxpackage');
Route::Post('/picodedetailsreceived', [VendorcreateController::class, 'picodedetailsreceived'])->name('picodedetailsreceived');

// coupon


//Route::get('coupon/list', CouponsController::class, 'list');

//Route::resource('coupon', CouponController::class, ['names' => 'coupon']);







