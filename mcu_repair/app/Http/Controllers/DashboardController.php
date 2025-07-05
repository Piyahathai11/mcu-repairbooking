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

        // Base query for bookings
        $query = Booking::query();

        if ($filterYear && $filterMonth) {
            $query->whereYear('created_at', $filterYear)
                  ->whereMonth('created_at', $filterMonth);
        }

        if ($filterCategory) {
            $query->where('category', $filterCategory);
        }

        if ($filterStatus) {
            $query->where('status', $filterStatus);
        }

        $bookings = $query->get();

        // Category counts
        $categoryCounts = $bookings->groupBy('category')->map->count();

        // Status counts
        $statusCounts = $bookings->groupBy('status')->map->count();

        // For category chart (group by month + year)
        $categoryChart = Booking::select(
                DB::raw("EXTRACT(YEAR FROM created_at) as year"),
                DB::raw("EXTRACT(MONTH FROM created_at) as month"),
                'category',
                DB::raw("COUNT(*) as count")
            )
            ->when($filterYear, fn($q) => $q->whereYear('created_at', $filterYear))
            ->when($filterMonth, fn($q) => $q->whereMonth('created_at', $filterMonth))
            ->groupBy('category', DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();

        // For status chart (group by month + year)
        $statusChart = Booking::select(
                DB::raw("EXTRACT(YEAR FROM created_at) as year"),
                DB::raw("EXTRACT(MONTH FROM created_at) as month"),
                'status',
                DB::raw("COUNT(*) as count")
            )
            ->when($filterYear, fn($q) => $q->whereYear('created_at', $filterYear))
            ->when($filterMonth, fn($q) => $q->whereMonth('created_at', $filterMonth))
            ->groupBy('status', DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();

        return view('admin.dashboard', compact(
            'bookings',
            'categoryCounts',
            'statusCounts',
            'filterCategory',
            'filterStatus',
            'categoryChart',
            'statusChart',
            'filterYear',
            'filterMonth'
        ));
    }
}
