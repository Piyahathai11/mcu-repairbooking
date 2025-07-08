@extends('layouts.NormLayout')

@section('title', 'รายการแจ้งซ่อม')

@php
    use Carbon\Carbon;
    Carbon::setLocale('th');
@endphp



@if(session('success'))

<script>

window.onload= function(){
    alert("{{session('success')}}");
}

</script>
@endif
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
    <div class="col-12">
        <h1 class=" mb-4">รายการแจ้งซ่อม</h1>
        <div class="card p-4 w-100 rounded bg-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex">
                        <input type="text" id="searchingInput" class="form-control me-2" placeholder="Search..." />
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped w-100" id="bookingTable">
                        <thead >
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
                                    <td>
                                  
                                            <form method="POST" action="{{ route('updateStatus', ['id' => $booking->id]) }}">
                                                @csrf
                                                <select class="form-select" name="status" onchange="this.form.submit()">
                                                    <option value="pending" {{ $booking->status === 'pending' ? 'selected' : '' }}>ยื่นคำร้อง</option>
                                                    <option value="accepted" {{ $booking->status === 'accepted' ? 'selected' : '' }}>รับคำร้อง</option>
                                                    <option value="in_progress" {{ $booking->status === 'in_progress' ? 'selected' : '' }}>กำลังดำเนินการ</option>
                                                    <option value="done" {{ $booking->status === 'done' ? 'selected' : '' }}>ดำเนินการเสร็จ</option>
                                                    <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>ยกเลิกคำร้อง</option>
                                                </select>
                                            </form>
                                      
                                        

                                    </td>
                                    <td>
                                      
                                           <a href="{{route('UpdateForm',['id'=> $booking->id])}}"><button class="btn btn-sm btn-primary">อัปเดต</button></a>
                                        
                                    </td>
                                    <td>
                                        {{ Carbon::parse($booking->updated_at)->translatedFormat('j F Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
