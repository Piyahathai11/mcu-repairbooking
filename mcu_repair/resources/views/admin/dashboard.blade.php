@extends('layouts.NormLayout')

@section('title', 'รายงาน')

@section('content')

@php
    use Carbon\Carbon;
    Carbon::setLocale('th');
@endphp

<canvas id="bookingChart" width="400" height="200"></canvas>


<script>
    const ctx = document.getElementById('bookingChart').getContext('2d');
    const bookingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'จำนวนการแจ้งซ่อม',
                data: {!! json_encode($counts) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>


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
            @foreach ($categoryCounts as $category => $count)
                <tr>
                    <td>{{ $category }}</td>
                    <td>{{ $count }}</td>
                    <td>
                        <a href="{{ route('dashboard', ['category' => $category]) }}" class="btn btn-primary">ดูรายการ</a>
                    </td>
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
            @foreach ($statusCounts as $status => $count)
                <tr>
                    <td>{{ $status }}</td>
                    <td>{{ $count }}</td>
                    <td>
                        <a href="{{ route('dashboard', ['status' => $status]) }}" class="btn btn-primary">ดูรายการ</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Single Modal for bookings --}}
@if(!empty($bookings) && count($bookings))
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <img src="{{ asset($booking->image_path) }}" alt="รูปภาพ" style="max-width: 100px; height: auto;">
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
                                <a href="/update_form"><button class="btn btn-sm btn-primary">อัปเดต</button></a>
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
@endif

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if(request()->has('category') || request()->has('status'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
            modal.show();
        });
    </script>
@endif

@endsection
