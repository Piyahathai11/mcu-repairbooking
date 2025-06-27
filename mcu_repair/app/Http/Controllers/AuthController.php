<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }
    public function login(Request $request){
        $credentials = request()->only(['username','password']);
        $user = User::where('username',$credentials['username'])->first();

        if(!$user || !Hash::check($credentials['password'],$user->password)){
            abort(401);
        }else{
        
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'role' => $user->role
            ]);
            
        }

    }

    public function logout(Request $request){

        $request->user()-> currentAccessToken()->delete();
        return response()->json(['message'=>'Logged out successfully']);


    }

}
