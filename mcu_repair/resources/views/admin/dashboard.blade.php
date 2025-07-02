@extends('layouts.NormLayout')

@section('title', 'รายงาน')

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


 <div class="row justify-content-around flex-wrap">
    <h3>แบ่งงานตามประเภท</h3>
  
    <table class="table table-bordered table-sm mt-3">
        <thead class="thead-dark">
          <tr>
            <th>ประเภท</th>
            <th>จำนวนงาน</th>
            <th>รายละเอียด</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($categoryCounts as $category=>$count)
                
        
            <tr >
              <td>{{$category}}</td>
              <td>{{$count}}</td>
             
      
            </tr>
            @endforeach
        </tbody>
      </table>

 


      <h3>แบ่งงานตามสถานะ</h3>

    <table class="table table-bordered table-sm mt-3">
        <thead class="thead-dark">
          <tr>
            <th>สถานะ</th>
            <th>จำนวนงาน</th>
            <th>รายละเอียด</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($statusCounts as $status=>$count)
                
       
            <tr >
              <td>{{$status}}</td>
              <td>{{$count}}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
 </div>

 

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection