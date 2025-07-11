<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\BookingUpdate;
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
        $order =['pending','accepted', 'in_progress', 'done'];
        $bookings = Booking::where('user_id',$userId)  
                    ->orderByRaw("FIELD(status, '" . implode("','", $order) . "')")    
                    ->get();

        $updates=[];
        
        return view('user.myrepair',compact('bookings','updates'));


    }

    public function repairOrder(){
        $order =['pending','accepted', 'in_progress', 'done'];
        $bookings = Booking::whereNotIn('status',['cancelled'])    
                            ->orderByRaw("FIELD(status, '" . implode("','", $order) . "')")    
                            ->get();
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


    // updateForm

    public function updateForm(Request $request,$id){
        $booking = Booking::where('id',$id)->get();
      
        
        return view('admin.update_form',compact('booking'));
    }

    public function updateNote(Request $request, $id){
        $booking = Booking::find($id);
        $user = Auth::id();
        $request->validate([
            'estimated_finish_date' => 'required|date',
            'updated_note' => 'required|string',
            'total_cost' => 'numeric'
        ]);

        BookingUpdate::create([
            'booking_id' => $id,
            'estimated_finish_date' => $request->input('estimated_finish_date'),
            'updated_note' => $request->input('updated_note'),
            'total_cost' => $request->input('total_cost'),
            'admin_id' => $user,
        ]);


        return redirect()->back()->with('success','update successfully');

    }

    public function fetchUpdateNote(Request $request, $id)
    {
        $userId = Auth::id();
    
        // Ensure the user owns the booking
        $booking = Booking::where('user_id', $userId)
                          ->where('id', $id)
                          ->first();
    
        if (!$booking) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    
        $updates = BookingUpdate::with('admin')
                                ->where('booking_id', $id)
                                ->get();
    
        return response()->json($updates);
    }
    
}
