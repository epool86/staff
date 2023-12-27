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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function(){

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function(){

        Route::get('/dashboard', [
            App\Http\Controllers\Admin\DashboardController::class, 'dashboard',
        ])->name('dashboard');
        Route::resource('leave', 'App\Http\Controllers\Admin\LeaveController');
        Route::get('/application/export', [
            App\Http\Controllers\Admin\ApplicationController::class, 'exportExcel',
        ])->name('application.export.excel');
        Route::resource('application', 'App\Http\Controllers\Admin\ApplicationController');

    });

    Route::group(['prefix' => 'staff', 'as' => 'staff.', 'middleware' => []], function(){

        Route::get('/dashboard', [
            App\Http\Controllers\Staff\DashboardController::class, 'dashboard',
        ])->name('dashboard');

        Route::resource('application', 'App\Http\Controllers\Staff\ApplicationController');

    });

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
