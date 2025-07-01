<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


// Public routes
Route::get('/', function () {
    return view('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.form');
Route::get('register',[AuthController::class, 'showregister']);
Route::post('register',[AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes for SUPER_ADMIN only
Route::middleware(['web','auth', 'role:SUPER_ADMIN'])->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'));
    Route::get('/adminsidebar', fn() => view('layouts.AdminSidebar'));
    Route::get('/repairorder', [BookingController::class, 'repairOrder']);
    Route::post('/repairorder/{id}', [BookingController::class, 'UpdateStatus'])->name('updateStatus');
    Route::get('/update_form', fn() => view('admin.update_form'));
    Route::get('/user_management', [AuthController::class, 'userManagement']);
    Route::post('/user_management/{id}',[AuthController::class, 'userDelete'])->name('userDelete');
    Route::post('/user_management',[AuthController::class, 'AddAdmin'])->name('AddAdmin');
});

// Routes for USER only
Route::middleware(['auth', 'web', 'role:USER'])->group(function () {
    Route::get('/home', function () {
        Log::info(' Route /home hit.');
        Log::info(' User:', ['user' => Auth::user()]);
        return view('user.home');
    });
    Route::get('/booking', [BookingController::class, 'showForm'])->name('booking');
    Route::post('/booking', [BookingController::class, 'create'])->middleware('auth')->name('booking.form');
    Route::get('/myrepair', [BookingController::class, 'myRepair'])->name('myrepair');
    Route::get('/setting', [SettingController::class, 'setting'])->name('setting');
});
