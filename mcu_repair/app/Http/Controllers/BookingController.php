<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function showForm(){
        $userId = Auth::id();
        $user_info = USER::where('id',$userId)->get();
        return view('user.booking',compact('user_info'));
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


        return redirect()->back()
        ->with('success','already summited the data');

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

    public function UpdateStatus(Request $request,$id){

        $status = $request->validate([
            'status' => 'required|string',
        ]);

        $booking = Booking::find($id);
        $booking->status = $request->input('status');
        $booking->save();

        return redirect()->back()->with('success','status changed');

        
    }

    public function bookingHistory(){
        $user = Auth::id();
        $booking= Booking::where('user_id',$user)
                    ->where('status','done')
                    ->get();

       return view('user.home',compact('booking'));
    }
}
