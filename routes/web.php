<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyGoodsController;
use App\Http\Controllers\CompanyPaymentController;
use App\Http\Controllers\DailyExpenseController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\MerchantGoodsController;
use App\Http\Controllers\MerchantPaymentController;
use App\Http\Controllers\people;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ReservedStockController;
use App\Http\Controllers\search;

use App\Http\Controllers\SeasonController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;












Route::get('/', function () {
    return view('welcome');
});

Route::resource('farmers', FarmerController::class);
Route::resource('people', PeopleController::class);
Route::resource('workers/{pearson_id}/workers', WorkerController::class);
Route::resource('drivers/{person_id}/drivers', DriverController::class);
Route::resource('merchants', MerchantController::class);
Route::resource('companies', CompanyController::class);
Route::resource('seasons', SeasonController::class);
Route::resource('reserved_stock', ReservedStockController::class);
Route::resource('daily_expenses', DailyExpenseController::class);
Route::resource('merchants/{merchant_id}/goods', MerchantGoodsController::class);
Route::resource('companies/{companyId}/transactions', CompanyGoodsController::class);
Route::resource('companies/{companyId}/pays', CompanyPaymentController::class);

// Add this line below the resource route for merchants
Route::get('search', [MerchantController::class, 'search'])->name('search');


// Resource Route for Merchant Payments
Route::resource('merchants/{merchant_id}/payments', MerchantPaymentController::class);

