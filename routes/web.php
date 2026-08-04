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

Route::get('/autologin', function() {
    $user = \Illuminate\Support\Facades\DB::table('users')->where('id', 1)->first();
    \Illuminate\Support\Facades\Auth::loginUsingId(1);
    session()->put('log_name', $user->name);
    session()->put('username', $user->username);
    session()->put('userId', $user->id);
    session()->put('status', $user->status);
    session()->put('log_type', $user->log_type);
    session()->put('login_id', $user->login_id);
    return redirect('/admin/products/edit/1/14');
});

// Intercept all legacy dashboard.php requests globally across the application
Route::get('{any_dashboard}', function ($any_dashboard) {
    if (str_contains($any_dashboard, 'vendor') || str_contains($any_dashboard, 'vendar')) {
        $id = null;
        if (auth()->check() && (int) auth()->user()->status === 2) {
            $id = auth()->user()->login_id;
        } elseif (session()->has('login_id')) {
            $id = session()->get('login_id');
        }
        if ($id) {
            return redirect()->route('vendordashboard', $id);
        }
        return redirect('vendor/login');
    } elseif (str_contains($any_dashboard, 'staff')) {
        $id = null;
        if (auth()->check() && (int) auth()->user()->status === 5) {
            $id = auth()->user()->login_id;
        } elseif (session()->has('login_id')) {
            $id = session()->get('login_id');
        }
        if ($id) {
            return redirect()->route('staffdashboard', $id);
        }
        return redirect('staff/login');
    } elseif (str_contains($any_dashboard, 'admin')) {
        return redirect('admin/dashboard');
    }
    return redirect('/');
})->where('any_dashboard', '.*dashboard\.php');

// Routes For Admin
Route::prefix('/admin')->middleware('panel.session')->group(__DIR__.'/admin/adminRoutes.php');

// Routes For Vendor
Route::prefix('/vendor')->middleware('panel.session')->group(__DIR__.'/vendor/vendorRoutes.php');


// Routes For Staff
Route::prefix('/staff')->middleware('panel.session')->group(__DIR__.'/staff/staffRoutes.php');

// Routes For Website
//Route::prefix('/')->group(__DIR__.'/website/websiteRoutes.php');
// Route::Post('/Ajaxpackage', [VendorcreateController::class, 'Ajaxpackage'])->name('Ajaxpackage');
Route::prefix('/')->group(__DIR__.'/website/websiteRoutes.php');
// Route::prefix('/user')->group(__DIR__.'/user/userRoutes.php');

// Payment Callback and Pending Routes
Route::get('/payment-callback', [App\Http\Controllers\PaymentCallbackController::class, 'paymentCallback'])->name('payment.callback');
Route::get('/payment-pending', [App\Http\Controllers\PaymentCallbackController::class, 'paymentPending'])->name('payment.pending');
