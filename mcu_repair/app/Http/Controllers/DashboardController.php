<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class DashboardController extends Controller
{


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
