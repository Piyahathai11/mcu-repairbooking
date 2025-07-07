<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


// Public routes
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.form');
Route::get('register',[AuthController::class, 'showregister']);
Route::post('register',[AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/setting', [SettingController::class, 'setting'])->name('setting');


// Routes for SUPER_ADMIN & ADMIN
Route::middleware(['web','auth', 'role:SUPER_ADMIN,ADMIN'])->group(function () {
    Route::get('/adminsidebar', fn() => view('layouts.AdminSidebar'));
    Route::get('/repairorder', [BookingController::class, 'repairOrder']);
    Route::post('/repairorder/{id}', [BookingController::class, 'UpdateStatus'])->name('updateStatus');
    Route::get('/update_form/{id}', fn() => view('admin.update_form'))->name('showForm');
    Route::post('/update_form/update/{id}',[BookingController::class, 'updateNote'])->name('updateNote');
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

});

//SUPER_ADMIN only
Route::middleware(['web','auth', 'role:SUPER_ADMIN'])->group(function () {

    Route::get('/user_management', [AuthController::class, 'userManagement']);
    Route::post('/user_management/update/{id}',[AuthController::class, 'UpdateUserStatus'])->name('UpdateUserStatus');
    Route::post('/user_management/delete/{id}',[AuthController::class, 'userDelete'])->name('userDelete');
    Route::post('/user_management',[AuthController::class, 'AddAdmin'])->name('AddAdmin');
    Route::post('/user_management/updateUser/{id}',[AuthController::class,'UpdateUser'])->name('UpdateUser');

});

// Routes for USER only
Route::middleware(['auth', 'web', 'role:USER'])->group(function () {
    Route::get('/home', [BookingController::class, 'bookingHistory']);
    Route::get('/booking', [BookingController::class, 'showForm'])->name('booking');
    Route::post('/booking', [BookingController::class, 'create'])->middleware('auth')->name('booking.form');
    Route::get('/myrepair', [BookingController::class, 'myRepair'])->name('myrepair');
});
