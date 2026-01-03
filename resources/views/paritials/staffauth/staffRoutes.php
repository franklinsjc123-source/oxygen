<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
