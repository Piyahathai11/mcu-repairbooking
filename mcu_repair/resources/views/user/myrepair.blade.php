@extends('layouts.NormLayout')

@section('title', 'การแจ้งซ่อมของฉัน')

@php
    use Carbon\Carbon;
    Carbon::setLocale('th');

    $statusMap=[
        'pending'=>'ยื่นคำร้อง',
        'accepted' => 'รับคำร้อง',
        'in_progress' => 'กำลังดำเนินการ',
        'done' => 'ดำเนินการเสร็จ',
        'cancelled'=> 'ยกเลิกคำร้อง',
    ];
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
                        <input type="text" id="searchingInput" class="form-control me-2" placeholder="ค้นหา..." />
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped w-100" id="bookingTable">
                        <thead >
                            <tr>
                                <th>เลขที่</th>
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
                                    <td>{{ $booking->category }}</td>
                                    <td>{{ $booking->detail }}</td>
                                    <td>{{ $booking->place }}</td>
                                    <td>
                                        <img src="{{ asset($booking->image_path) }}" alt="รูปภาพ"
                                            style="max-width: 100px; height: auto;">
                                    </td>
                                    <td>{{ $statusMap[$booking->status]??$booking->status }}</td>
                                    <td>
                                    {{-- <a href="{{route('FetchUpdates',['id'=>$booking->id])}}"> --}}
                                        <button class="btn btn-sm btn-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#UpdatedModal"
                                        data-id="{{ $booking->id }}"
                                        >ดูรายละเอียด
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
                                  <tbody id="updateTableBody">
                                    <tr><td colspan="5" class="text-muted text-center">กำลังโหลด...</td></tr>
                                </tbody>
                                
                              </table>


            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('[data-bs-target="#UpdatedModal"]').forEach(btn => {
        btn.addEventListener('click', function () {
            const bookingId = this.getAttribute('data-id');
            const modalBody = document.getElementById('updateTableBody');
            modalBody.innerHTML = '<tr><td colspan="5" class="text-muted text-center">กำลังโหลด...</td></tr>';

            fetch(`/myrepair/update/${bookingId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('ไม่สามารถโหลดข้อมูลได้');
                    }
                    return response.json();
                })
                .then(data => {
                    if (!data.length) {
                        modalBody.innerHTML = '<tr><td colspan="5" class="text-muted text-center">ไม่พบข้อมูล</td></tr>';
                        return;
                    }

                    modalBody.innerHTML = ''; // clear previous
                    data.forEach(update => {
                        modalBody.innerHTML += `
                            <tr>
                                <td>${update.admin?.fullName ?? 'ไม่ทราบชื่อ'}</td>
                                <td>${update.admin?.phone ?? 'ไม่ทราบเบอร์'}</td>
                                <td>${formatDate(update.estimated_finish_date)}</td>
                                <td>${update.updated_note ?? '-'}</td>
                                <td>${update.price ?? '-'}</td>
                            </tr>
                        `;
                    });
                })
                .catch(error => {
                    modalBody.innerHTML = `<tr><td colspan="5" class="text-danger text-center">${error.message}</td></tr>`;
                });
        });
    });

    function formatDate(isoDate) {
        const date = new Date(isoDate);
        return date.toLocaleString('th-TH', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' });
    }
</script>


@endsection
