@extends('layouts.NormLayout')

@section('title', 'หน้าแรก')

@section('content')

<canvas id="bookingChart" width="400" height="200"></canvas>
{{-- 
<script>
    const ctx = document.getElementById('bookingChart').getContext('2d');

    const bookingChart = new Chart(ctx, {
        type: 'bar', // or 'line', 'pie', etc.
        data: {
            labels: {!! json_encode($months) !!}, // e.g. ["Jan", "Feb", ...]
            datasets: [{
                label: 'จำนวนการแจ้งซ่อม',
                data: {!! json_encode($counts) !!}, // e.g. [5, 12, 8, ...]
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
 --}}



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection