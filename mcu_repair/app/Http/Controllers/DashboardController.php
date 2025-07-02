<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
 
    
    
        public function showDashboard(Request $request)
{
    $filterCategory = $request->query('category');
    $filterStatus = $request->query('status');

    $query = Booking::query();

    if ($filterCategory) {
        $query->where('category', $filterCategory);
    }

    if ($filterStatus) {
        $query->where('status', $filterStatus);
    }

    $bookings = $query->get();

    $categoryCounts = Booking::select('category', DB::raw('COUNT(*) as total'))
        ->groupBy('category')
        ->pluck('total', 'category');

    $statusCounts = Booking::select('status', DB::raw('COUNT(*) as total'))
        ->groupBy('status')
        ->pluck('total', 'status');

    $bookingChart = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $months = $bookingChart->pluck('month')->map(function ($m) {
        return Carbon::create()->month($m)->locale('th')->translatedFormat('F');
    });

    $counts = $bookingChart->pluck('count');

    return view('admin.dashboard', compact(
        'bookings',
        'categoryCounts',
        'statusCounts',
        'months',
        'counts',
        'filterCategory',
        'filterStatus'
    ));
}


    
    


public function fetchByCategory($category){
    $bookings = Booking::where('category',$category)->get();
    $categoryCounts = Booking::select('category', DB::raw('COUNT(*) as total'))
    ->groupBy('category')
    ->pluck('total', 'category');

    $statusCounts = Booking::select('status', DB::raw('COUNT(*) as total'))
    ->groupBy('status')
    ->pluck('total', 'status');

    return view('admin.dashboard',compact('bookings','categoryCounts','statusCounts'));

}
public function fetchByStatus($status){
    $bookings = Booking::where('status',$status)->get();
    $statusCounts = Booking::select('status', DB::raw('COUNT(*) as total'))
    ->groupBy('status')
    ->pluck('total', 'status');

    $categoryCounts = Booking::select('category', DB::raw('COUNT(*) as total'))
    ->groupBy('category')
    ->pluck('total', 'category');
    

    return view('admin.dashboard',compact('bookings','statusCounts','categoryCounts'));
}



}
