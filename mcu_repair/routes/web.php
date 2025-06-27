<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
});

Route::get('/login',[AuthController::class, 'showLogin'])->name('login.show');

Route::post('/login',[AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
});

Route::get('/booking', [BookingController::class, 'showForm'])->name('booking');

Route::post('/booking', [BookingController::class, 'create'])->name('booking.form');

Route::get('/myrepair', [BookingController::class, 'myRepair'])->name('myrepair');



Route::get('/setting', function () {
    return view('setting');
});

Route::get('/sidebar', function () {
    return view('sidebar'); 
});

Route::get('/adminsidebar', function () {
    return view('layouts.AdminSidebar'); 
});

Route::get('/update_form', function(){
    return view('admin.update_form');
});

