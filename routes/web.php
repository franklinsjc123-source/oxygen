<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes For Admin
Route::prefix('/admin')->group(__DIR__.'/admin/adminRoutes.php');

// Routes For Vendor
Route::prefix('/vendar')->group(__DIR__.'/vendor/vendorRoutes.php');


// Routes For Staff
Route::prefix('/staff')->group(__DIR__.'/staff/staffRoutes.php');

// Routes For Website
//Route::prefix('/')->group(__DIR__.'/website/websiteRoutes.php');
// Route::Post('/Ajaxpackage', [VendorcreateController::class, 'Ajaxpackage'])->name('Ajaxpackage');
Route::prefix('/')->group(__DIR__.'/website/websiteRoutes.php');
// Route::prefix('/user')->group(__DIR__.'/user/userRoutes.php');

// if(Request::is('admin/*))
// {
//     require __DIR__.'/admin_routes.php;
// }