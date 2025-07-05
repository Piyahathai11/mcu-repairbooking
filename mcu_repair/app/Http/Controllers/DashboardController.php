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
        $filterYear = $request->query('year');
        $filterMonth = $request->query('month');
    
        $query = Booking::query();
    
        if ($filterCategory) {
            $query->where('category', $filterCategory);
        }
    
        if ($filterStatus) {
            $query->where('status', $filterStatus);
        }
    
        $bookings = $query->get();
    
        if($filterYear&&$filterMonth){
      //in case of empty

            $filterdBooking = Booking::whereYear('created_at',$filterYear)
                            ->whereMonth('created_at', $filterMonth)
                            ->get();
             if($filterdBooking->isEmpty()){
                $categoryCounts = $filterdBooking->collect();
                $statusCounts = $filterdBooking->collect();

             }else{
                $categoryCounts = $filterdBooking->groupBy('category')->map->count();
                $statusCounts = $filterdBooking->groupBy('status')->map->count();
             }
    
        } else {
        
            $categoryCounts = Booking::select('category', DB::raw('COUNT(*) as total'))
                ->groupBy('category')
                ->pluck('total', 'category');
        
            $statusCounts = Booking::select('status', DB::raw('COUNT(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status');
        }


        $categoryChartQuery = Booking::query();
        if ($filterCategory) {
            $categoryChartQuery->where('category', $filterCategory);
        }
        if ($filterYear && $filterMonth) {
            $categoryChartQuery->whereYear('created_at', $filterYear)
                               ->whereMonth('created_at', $filterMonth);
        }
        $categoryChart = $categoryChartQuery
            ->select(
                DB::raw("EXTRACT(YEAR from created_at) as year"),
                DB::raw("EXTRACT(MONTH from created_at) as month"),
                DB::raw("COUNT(*) as count")
            )
            ->groupBy('category')
            ->get();
    
  
        $statusChartQuery = Booking::query();
        if ($filterStatus) {
            $statusChartQuery->where('status', $filterStatus);
        }
        if ($filterYear && $filterMonth) {
            $statusChartQuery->whereYear('created_at', $filterYear)
                             ->whereMonth('created_at', $filterMonth);
        }


        $statusChart = $statusChartQuery
            ->select(
                DB::raw("EXTRACT(YEAR from created_at) as year"),
                DB::raw("EXTRACT(MONTH from created_at) as month"),
                DB::raw("COUNT(*) as count")
            )
            ->groupBy('status')
            ->get();
    

        if ($request->ajax()) {
            return response()->json([
                'categoryChart' => $categoryChart,
                'statusChart' => $statusChart,
            ]);
        }
    
        return view('admin.dashboard', compact(
            'bookings',
            'categoryCounts',
            'statusCounts',
            'filterCategory',
            'filterStatus',
            'categoryChart',
            'statusChart',
        ));
    }
    



}
