<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/booking', function () {
    return view('booking');
});

Route::get('/myrepair', function () {
    return view('myrepair');
});


Route::get('/setting', function () {
    return view('setting');
});

Route::get('/sidebar', function () {
    return view('sidebar'); 
});

