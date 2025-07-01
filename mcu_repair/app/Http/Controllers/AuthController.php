<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function showregister(){
        return view('auth.register');
    }

    public function login(Request $request){
        $credentials = request()->only(['username','password']);
       if(Auth::attempt($credentials)){
     
        $request->session()->regenerate();
        
        $user = Auth::user();
        $role = is_object($user->role) ? $user->role->value : $user->role;

        \Log::info('User Role:'.$role);
        if ($role === 'SUPER_ADMIN') {
            return redirect('/dashboard');
        } elseif ($role === 'ADMIN') {
            return redirect('/settings');
        } elseif ($role === 'USER') {
            return redirect('/home');
        } else {
            Auth::logout();
            return redirect('/login')->withErrors(['login' => 'Unauthorized role']);
        }
       }
       return back()->withErrors(['login' => 'Invalid credentials.']);
    }


    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function register(Request $request){
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password'=>'required',
        ]);

        $user = USER::create([
            'username' => $request->username,
            'fullName' => $request->fullName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
            'position' => $request->position,
            'personnel' => $request->personnel,
            'status'=> $request->status,
        ]);


        return redirect('/login')->with('success','Registration is success');
    }

    public function userManagement(){
        $users = USER::all();
        return view('admin.user_manage',compact('users'));
    }

    public function userDelete(Request $request, $id){

        $user = USER::find($id);
        $user->delete();

        return redirect()->back()->with('success','user is removed');

    }

}
