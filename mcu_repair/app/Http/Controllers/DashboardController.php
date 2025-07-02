<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
 
    
    public function showDashboard()
    {
        $categoryCounts = Booking::select('category', DB::raw('COUNT(*) as total'))
            ->groupBy('category')
            ->pluck('total', 'category');
    
        $statusCounts = Booking::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');
    
        return view('admin.dashboard', compact('categoryCounts', 'statusCounts'));
    }
    
public function dashboard()
{
    $bookings = Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $months = $bookings->pluck('month')->map(function ($m) {
        return Carbon::create()->month($m)->locale('th')->translatedFormat('F');
    });

    $counts = $bookings->pluck('count');

    return view('admin.dashboard', compact('months', 'counts'));
}

}
