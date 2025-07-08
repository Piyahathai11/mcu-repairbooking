@extends('layouts.NormLayout')

@section('title', 'การแจ้งซ่อมของฉัน')

@php
    use Carbon\Carbon;
    Carbon::setLocale('th');
@endphp
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const searchingInput = document.getElementById('searchingInput');
        const tableRows = document.querySelectorAll('#bookingTable tbody tr');

        searchingInput.addEventListener('keyup',function(){
            const keyword = this.value.toLowerCase();

            tableRows.forEach(row => {
                const rowText =row.innerText.toLowerCase();
                row.style.display = rowText.includes(keyword) ? '': 'none';
            });
        });

    });
</script>
@section('content')
<div class="container mx-auto mt-4">
    <div class="col-12 ">
        <h1 class="text-xl font-bold mb-4">การแจ้งซ่อมของฉัน</h1>
        <div class="card p-4 w-100 rounded bg-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex">
                        <input type="text" id="searchingInput" class="form-control me-2" placeholder="Search..." />
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped w-100" id="bookingTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>เลขที่</th>
                                <th>ชื่อ-นามสกุล</th>
                                <th>เบอร์ติดต่อ</th>
                                <th>ประเภท</th>
                                <th>รายละเอียดปัญหา</th>
                                <th>สถานที่เกิดปัญหา</th>
                                <th>รูปภาพ</th>
                                <th>สถานะ</th>
                                <th>เพิ่มเติม</th>
                                <th>แก้ไขล่าสุด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->fullName }}</td>
                                    <td>{{ $booking->phone }}</td>
                                    <td>{{ $booking->category }}</td>
                                    <td>{{ $booking->detail }}</td>
                                    <td>{{ $booking->place }}</td>
                                    <td>
                                        <img src="{{ asset($booking->image_path) }}" alt="รูปภาพ"
                                            style="max-width: 100px; height: auto;">
                                    </td>
                                    <td>{{ $booking->status }}</td>
                                    <td>
                                    {{-- <a href="{{route('FetchUpdates',['id'=>$booking->id])}}"> --}}
                                        <button class="btn btn-sm btn-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#UpdatedModal"
                                        >view
                                        </button>
                                    {{-- </a> --}}
                                    </td>
                                    <td>
                                        {{ Carbon::parse($booking->updated_at)->translatedFormat('j F Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>



                {{-- Modal --}}
                <div class="modal fade" id="UpdatedModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title">รายการแจ้งซ่อม</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body table-responsive">
                              <table class="table table-bordered table-striped w-100">
                                  <thead class="thead-dark">
                                      <tr>
                                      
                                          <th>ผู้ดูแล</th>
                                          <th>เบอร์ติดต่อผู้ดูแล</th>
                                          <th>วันที่คาดว่าจะเสร็จ</th>
                                          <th>เพิ่มเติม</th>
                                          <th>ราคา</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                   @foreach ($updates as $b)
                                          <tr>
                                             <td>{{ $b->admin->fullName?? 'ไม่ทราบชื่อ'  }}</td>
                                              <td>{{ $b->admin->phone?? 'ไม่ทราบชื่อ'  }}</td>
                                              <td>  {{ Carbon::parse($b->estimated_finish_date)->translatedFormat('j F Y H:i') }}</td>
                                              <td>{{ $b->updated_note }}</td>
                                              <td>{{ $b->price }}</td> 
                                             
                                             
                                          </tr>
                                     @endforeach 
                                  </tbody>
                              </table>


            </div>
        </div>
    </div>
</div>

<script>

    

</script>
@endsection
