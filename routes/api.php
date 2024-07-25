<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\IndentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReturnController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/customer', function (Request $request) {
    return $request->user();
});*/

Route::resource('customer',CustomerController::class);
Route::resource('product',ProductController::class);
Route::resource('producttype',ProductTypeController::class);
Route::resource('indent',IndentController::class);
Route::get('/data',[IndentController::class,'data']);
Route::resource('location',LocationController::class);
Route::resource('country',CountryController::class);
Route::resource('states',StateController::class);
Route::resource('cities',CityController::class);
Route::get('getstates/{param1}', [StateController::class, 'getstates'])->name('getstates/{param1}');
Route::get('getcities/{param1}', [CityController::class, 'getcities'])->name('getcities/{param1}');
Route::resource('return',ReturnController::class);
Route::get('getReturnCustomers/{param1}', [ReturnController::class, 'getReturnCustomers'])->name('getReturnCustomers/{param1}');
Route::get('getCustomerReturns/{param1}/{param2}', [ReturnController::class, 'getCustomerReturns'])->name('getCustomerReturns/{param1}/{param2}');
Route::get('getCustomerReports', [ReturnController::class, 'getCustomerReports'])->name('getCustomerReports');