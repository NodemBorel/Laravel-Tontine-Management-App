<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\SanctionsController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard',[App\Http\Controllers\Admin\DashboardController::class, 'index']);

    Route::post('/share',[App\Http\Controllers\Admin\DashboardController::class, 'share']);

    Route::get('/users',[App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('/user/{user_id}',[App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::put('/update-user/{user_id}',[App\Http\Controllers\Admin\UserController::class, 'update']);
    
    Route::post('/sessions',[App\Http\Controllers\Admin\SessionsController::class, 'index']);

    Route::get('/payments', [PaymentsController::class, 'index']);

    Route::get('/sanction', [SanctionsController::class, 'index']);
});

Route::post('/home', [App\Http\Controllers\PaymentController::class, 'add_payment']);

Route::get('/user-profile', [App\Http\Controllers\HomeController::class, 'profile']);

Route::get('/edit-profile', [App\Http\Controllers\HomeController::class, 'edit']);

Route::put('/update-profile', [App\Http\Controllers\HomeController::class, 'update']);

//i want to get the user name form the user table using the user_id foreign key which is in the payment table