<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\Role;
use App\Enums\Status;
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
        $status = is_object($user->status) ? $user->status->value : $user->status;
        
        if ($role === Role::USER->value && $status !== Status::APPROVED->value) {
            Auth::logout();
            return back()->withErrors(['login' => 'Your account is not approved yet.']);
        }
        

        \Log::info('User Role:'.$role);
        if ($role === 'SUPER_ADMIN'|| $role === 'ADMIN') {
            return redirect('/dashboard');
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
            'status'=> Status::PENDING,
        ]);


        return redirect('/login')->with('success','Registration is success');
    }

    public function userManagement(){
        $users = USER::whereIn('role',[ROLE::ADMIN->value,ROLE::USER->value])->get();
        return view('admin.user_manage',compact('users'));
    }

    public function userDelete(Request $request, $id){

        $user = USER::find($id);
        $user->delete();

        return redirect()->back()->with('success','user is removed');

    }
    public function AddAdmin(Request $request){
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
            'role'=> Role::ADMIN,
        ]);

        return redirect()->back()->with('success','admin registration succeeded');
    }

        
   
     public function UpdateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'fullName' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'position' => 'required|string',
            'personnel' => 'required|string',
            'phone' => 'required',
        ]);
    
        $user->fullName = $request->input('fullName');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->position = $request->input('position');
        $user->personnel = $request->input('personnel');
        $user->phone = $request->input('phone');
        $user->password = $request->input('password');
  

    
       if($user->save()){
        return redirect()->back()->with('success', 'update successfully');
       }else{
        return redirect()->back()->with('failed', 'update failed');
       }
    }
    

}
