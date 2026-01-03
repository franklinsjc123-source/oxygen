<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\staff\SalesController;
use App\Http\Controllers\staff\coupon\CouponController;
use App\Http\Controllers\staff\OfferController;
use App\Http\Controllers\staff\Auction\auctionController;

use App\Http\Controllers\staff\Banners\main_slidvController;
use App\Http\Controllers\staff\Banners\oxygen_advController;
use App\Http\Controllers\staff\Banners\paid_adv_banerController;

use App\Http\Controllers\staff\StaffController;
use App\Http\Controllers\staff\VendorController;
use App\Http\Controllers\staff\VendorcreateController;

use App\Http\Controllers\staff\ActivityController;

use App\Http\Controllers\staff\PackageController;


use App\Http\Controllers\staff\GstController\GstController;

use App\Http\Controllers\staff\designation\designationController;
// use App\Http\Controllers\StaffController\StaffController;
use App\Http\Controllers\staff\CategoryController\CategoryController;
use App\Http\Controllers\staff\CategoryMainController\CategoryMainController;
use App\Http\Controllers\staff\CategorySubController\CategorySubController;
use App\Http\Controllers\staff\ProductsController\ProductsController;
use App\Http\Controllers\staff\ProductsController\CollectionController;
use App\Http\Controllers\staff\ProductsController\ProductCollectionController;
use App\Http\Controllers\staff\ProductsController\AttributeController;
use App\Http\Controllers\staff\ProductsController\SpecificationController;
use App\Http\Controllers\staff\MasterController;
use App\Http\Controllers\PinCodeController1\PinCodeController1;
//Marketting
use App\Http\Controllers\staff\Marketting\WhAppController;
use App\Http\Controllers\staff\Marketting\FaceBookController;
use App\Http\Controllers\staff\Marketting\InstaController;
use App\Http\Controllers\staff\Marketting\OxygenController;






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
    return view('auth.stafflogin');
});
Route::get('login', function () {
    $viewBag['error'] = '';     
    return view('auth.stafflogin');
})->name('stafferror');


Route::post('login', [AuthController::class, 'stafflogin'])->name('stafflogin');

Route::get('add_designation', [AdminController::class, 'designation']);

Route::get('dashboard/{id}', 
[DashboardController::class, 'staffdashboard'])
     ->name('staffdashboard')
    ->middleware('auth');
    
Route::get('slider', [BannerController::class, 'slider'])->name('banners.slider');
/*sales*/
Route::get('transaction', [SalesController::class, 'transaction'])->name('stafftransaction');

Route::get('order', [SalesController::class, 'order'])->name('stafforder');

Route::post('orderstatusupdate/{id}', [SalesController::class, 'stafforderstatusupdate'])->name('stafforderstatusupdate');

Route::post('orderbulkstatusupdate', [SalesController::class, 'stafforderbulkstatusupdate'])->name('stafforderbulkstatusupdate');


// Category Main
Route::resource('category_main', CategoryMainController::class, ['names' => 'staffcategory.main']);
Route::post('category_main/update/{id}', [CategoryMainController::class, 'update'])->name('staffcategory_main_update');
//category
Route::resource('category', CategoryController::class, ['names' => 'staffcategory']);
Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('staffcategory_update');

Route::post('subcategory/update/{id}', [CategorySubController::class, 'update'])->name('staffsubcategory_update');

// Category Sub
Route::resource('category_sub', CategorySubController::class, ['names' => 'staffcategory.sub']);



Route::resource("products_crud", ProductsController::class, ['names' => 'staffproducts.crud'])->middleware('auth');

Route::get("products/listing", [ProductsController::class, "listing"])->name('staffproducts.crud.listing');
Route::get("products/view/{id}", [ProductsController::class, "view"])->name('staffproducts.crud.view');


Route::post("products/productdetailsdelete", [ProductsController::class, "productdetailsdelete"])->name('staffproducts.crud.productdetailsdelete');

Route::get("products/edit/{id}/{sub_id?}", [ProductsController::class, "edit"])->name('staffproducts.crud.edit');

Route::post("products/offerupdate", [ProductsController::class, "offerupdate"])->name('offer.update');
Route::get('products/getsubproductdetails', [ProductsController::class, 'getsubproductdetails'])->name('getsubproductdetails');

Route::resource('attribute-listing', AttributeController::class, ['names' => 'staffattribute.master']);

Route::resource('product-collection', ProductCollectionController::class, ['names' => 'staffproductcollection.master']);
Route::resource('product-specification', SpecificationController::class, ['names' => 'staffproduct.specification']);

/*Coupan*/
Route::resource('coupon', CouponController::class, ['names' => 'staffcoupon']);
Route::get('couponlisting', [CouponController::class, "couponlisting"])->name('staffcoupon.couponlisting');

/*banner*/
Route::resource('advbanner', paid_adv_banerController::class, ['names' => 'staffadvbanner']);
Route::get('editadvbanner/{id}', [paid_adv_banerController::class, 'edit'])->name('staffeditadvbanner');

Route::resource('advoxygen', oxygen_advController::class, ['names' => 'staffadvoxygen']);
Route::get('editadvoxygen/{id}', [oxygen_advController::class, 'edit'])->name('staffeditadvoxygen');

Route::resource('slider', main_slidvController::class, ['names' => 'staffmain_slider']);
Route::get('editmain_slider/{id}', [main_slidvController::class, 'edit'])->name('staffeditmain_slider');

/*Auction*/

Route::resource('auction', AuctionController::class, ['names' => 'staffauction']);

//  Route::get('auction/create', [AuctionController::class, 'create'])->name('auction/create');

Route::get('auction_list', [AuctionController::class, 'list'])->name('staffauction/list');

Route::controller(AuctionController::class)->group(function(){

    Route::post('users-import', 'import')->name('staffimport');
});


/*Offer*/
Route::resource('offer/create', OfferController::class, ['names' => 'staffoffer.main']);

Route::resource('offer/list', OfferController::class, ['names' => 'staffoffer.list']);


//staff
Route::get('staff/create', [StaffController::class, 'create']);

Route::get('staff/list', [StaffController::class, 'list'])->name('sstaff-list');
Route::get('staff/store', [StaffController::class, 'store'])->name('sstaf-store');
Route::post('staff/update/{id}', [StaffController::class, 'update']);
Route::delete('staff/destroy/{id}', [StaffController::class, 'destroy'])->name('sstaff.destroy');
Route::get('staff/edit/{id}', [StaffController::class, 'edit'])->name('sstaff.edit');
Route::get('get-staffdepartment', [StaffController::class, 'getstaffdepartment'])->name('sgetstaffdepartment');

Route::get('vendor/create', [VendorController::class, 'create']);
Route::resource('vendorcreate', VendorcreateController::class, ['names' => 'staffvendorcreate']);

Route::get('vendor/list', [VendorcreateController::class, 'list'])->name('staffvendor-list');

Route::Post('/Ajaxpackage', [VendorcreateController::class, 'Ajaxpackage'])->name('staffAjaxpackage');



//activity
Route::get('activity/create', [ActivityController::class, 'create'])->name('staffactivitycreate');

Route::get('activity/list', [ActivityController::class, 'list'])->name('staffactivitylist');

//Master

Route::resource('pincode1', PinCodeController1::class, ['names' => 'staffpincode1']);

Route::get('department', [MasterController::class, 'department'])->name('staffdepartment');
Route::post('department', [MasterController::class, 'department']);


Route::get('editdepartment/{id}/edit', [MasterController::class, 'staffeditdepartment']);
Route::post('departmentdelete/{id}', [MasterController::class, 'departmentdelete'])->name('staffdepartmentdelete');
Route::post('departmentupdate/{id}/update', [MasterController::class, 'updatedepartment'])->name('staffdepartmentupdate');




Route::resource('gst_master', GstController::class, ['names' => 'staffgst.master']);
Route::post('/Departmentssave', [MasterController::class, 'saveDepartments'])->name('staffDepartmentssave');
Route::post('/checkDepartmentnamePost', [MasterController::class, 'checkDepartmentnamePost'])->name('staffcheckDepartmentnamePost');
//Route::get('designation', [MasterController::class, 'designation'])->name('designation');
//Route::get('add_designation', [AdminController::class, 'designation'])->name('add_designation');

Route::resource('designation_master', designationController::class,['names' => 'staffdesignation.master']);

Route::get('getdepartment', [designationController::class, 'getdepartment'])->name('staffgetdepartment');

Route::get('gst', [MasterController::class, 'gst']);

Route::get('package', [MasterController::class, 'package']);

Route::get('pincode', [MasterController::class, 'pincode']);
Route::post('/savePincodes', [MasterController::class, 'savePincodes'])->name('savePincodes');
Route::post('/checkPincodenamePost', [MasterController::class, 'checkPincodenamePost'])->name('checkPincodenamePost');
 
Route::get('route', [MasterController::class, 'route'])->name('staffroute');
Route::get('route_delete/{$id}', [MasterController::class, 'route_delete'])->name('staffroute_delete');


Route::get('editroute/{id}/edit', [MasterController::class, 'editroute'])->name('staffeditroute');
// Route::get('route_update/{$id}', [MasterController::class, 'route_update'])->name('route_update');
// Route::get('routedel/{{ $id }}', [MasterController::class, 'routedel'])->name('routedel');
Route::post('route_update/{id}', [MasterController::class, 'route_update'])->name('staffroute_update');

Route::post('routedelete/{id}', [MasterController::class, 'deleteroute'])->name('staffroutedelete');




Route::resource('package', PackageController::class, ['names' => 'staffpackage']);

Route::post('/saveRoute', [MasterController::class, 'saveRoute'])->name('saveRoute');
Route::post('/saveRoute', [MasterController::class, 'saveRoute'])->name('Route_save');
Route::post('/checRoutenamePost', [MasterController::class, 'checRoutenamePost'])->name('staffchecRoutenamePost');

Route::get('zonal', [MasterController::class, 'zonal'])->name('staffzonal');
//Route::post('/getZonalById', [MasterController::class, 'getZonalById'])->name('getZonalById');
Route::post('/saveZonals', [MasterController::class, 'saveZonals'])->name('staffsaveZonals');
Route::post('/checkZonalnamePost', [MasterController::class, 'checkZonalnamePost'])->name('staffcheckZonalnamePost');
Route::post('/zonalsListingPost', [MasterController::class, 'zonalsListingPost'])->name('staffzonalsListingPost');


Route::post('zonalupdate/{id}/update', [MasterController::class, 'updatezonal'])->name('staffzonalupdate');
Route::post('zonaldelete/{id}', [MasterController::class, 'deletezonal'])->name('staffzonaldelete');

//marketting   
Route::resource('whatsapp',  WhAppController::class,['names' => 'staffwhatsapp']);
Route::resource('facebook',  FaceBookController::class,['names' => 'stafffacebook']);
Route::resource('instagram',  InstaController::class,['names' => 'staffinstagram']);
Route::resource('oxygen',  OxygenController::class,['names' => 'staffoxygen']);








