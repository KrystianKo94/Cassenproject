<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\SalesReportPeriodsController;
use App\Http\Controllers\SalesReportYearsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password');
Route::get('/sales-report-periods', [SalesReportPeriodsController::class, 'index'])->name('sales-report-periods');
Route::get('/sales-report-years', [SalesReportYearsController::class, 'index'])->name('sales-report-years');
Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password');
Route::post('/update-password', [ChangePasswordController::class, 'update'])->name('update-password');

