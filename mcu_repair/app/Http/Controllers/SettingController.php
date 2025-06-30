<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingController extends Controller
{
   public function setting(){

    $userId = Auth::id();
    $info = User::where('id', $userId)->get();
    return view('layouts.setting',compact('info'));


   }
}
