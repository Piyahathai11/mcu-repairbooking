<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('user.home');
});

Route::get('/login',[AuthController::class, 'showLogin'])->name('login.show');

Route::post('/login',[AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth:sanctum', 'role:ADMIN'])->get('/admin', function () {
    return view('admin.dashboard');
});


Route::get('/home', function () {
    return view('user.home');
});

Route::get('/booking', [BookingController::class, 'showForm'])->name('booking');

Route::post('/booking', [BookingController::class, 'create'])->name('booking.form');

Route::get('/myrepair', [BookingController::class, 'myRepair'])->name('myrepair');

Route::get('/setting', function () {
    return view('layouts.setting');
});

Route::get('/sidebar', function () {
    return view('sidebar'); 
});

Route::get('/adminsidebar', function () {
    return view('layouts.AdminSidebar'); 
});

Route::get('/dashboard', function(){
    return view('admin.dashboard');
});

Route::get('/update_form', function(){
    return view('admin.update_form');
});

