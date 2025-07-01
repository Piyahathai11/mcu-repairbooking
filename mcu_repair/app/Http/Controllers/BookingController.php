<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function showForm(){
        return view('user.booking');
    }




    public function create (Request $request){
        $imagePath = null;


        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads/images/'), $imageName);
            $imagePath = 'uploads/images/'. $imageName;

        }
    


        Booking::create([
            'user_id'=> Auth::id(),
            'category' => $request->input('category'),
            'detail' => $request->input('detail'),
            'place' => $request->input('place'),
            'fullName' => $request->input('fullName'),
            'position' => $request->input('position'),
            'personnel' => $request->input('personnel'),
            'phone' => $request->input('phone'),
            'image_path' => $imagePath,
       
        ]);


        return redirect()->back()->with('success','already summited the data');

    }

    public function myRepair(){
        $userId = Auth::id();
        $bookings = Booking::where('user_id',$userId)->get();
        
        return view('user.myrepair',compact('bookings'));


    }


    public function repairOrder(){
        $bookings = Booking::all();
        
        return view('admin.repairorder',compact('bookings'));


    }
}
