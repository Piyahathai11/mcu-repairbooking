@extends('layouts.NormLayout')

@section('title', 'รายงาน')

@section('content')

@php
    use Carbon\Carbon;
    Carbon::setLocale('th');
@endphp





<div class="container my-4">
    <h2>รายงาน</h2>

    <!-- Year/Month Picker -->
    <button class="pinkbutton my-3" id="monthButton">เลือกเดือน/ปี</button>
    <div class="monthPicker d-none border p-3 rounded" id="monthPicker">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <button class="btn btn-outline" id="prevYearRange"><<</button>
            <span class="fw-bold currentYearRange"></span>
            <button class="btn btn-outline" id="nextYearRange">>></button>
        </div>
        <div class="d-flex flex-wrap justify-content-center" id="yearGrid"></div>
        <div class="d-flex flex-wrap justify-content-center mt-3" id="monthGrid" style="display:none;"></div>
    </div>

    <div class="row mt-4">

        <div class="col-md-6">
            <h4>แผนภูมิตามประเภท</h4>
            <canvas id="categoryChart" style="max-width: 200px"></canvas>
            <table class="table table-bordered table-sm mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>ประเภท</th>
                        <th>จำนวนงาน</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categoryCounts as $category => $count)
                    <tr>
                        <td>{{ $category }}</td>
                        <td>{{ $count }}</td>
                        <td>
                            <a href="{{ route('dashboard', ['category' => $category]) }}" class="btn btn-primary btn-sm">ดูรายการ</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">ไม่พบข้อมูล</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <!-- Status Chart & Table -->
        <div class="col-md-6 ">
            <h4>แผนภูมิตามสถานะ</h4>
            <canvas id="statusChart" style="max-width: 200px"></canvas>
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
                                <a href="{{ route('dashboard', ['status' => $status]) }}" class="btn btn-primary btn-sm">ดูรายการ</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


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

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


@if(request()->has('category') || request()->has('status'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
        modal.show();
    });
</script>
@endif

<script>
    let selectedYear = new Date().getFullYear();
    let selectedMonth = null;
    let currentStartYear = selectedYear - 5;
    let selectedCategory = "{{ request()->query('category') ?? '' }}";
    let selectedStatus = "{{ request()->query('status') ?? '' }}";

    const $monthButton = document.getElementById('monthButton');
    const $monthContent = document.getElementById('monthPicker');

    $monthButton.addEventListener('click', () => {
        $monthContent.classList.remove('d-none');
        renderYearGrid();
        renderMonthGrid();
    });
    $monthButton.addEventListener('dblclick', () => {
        $monthContent.classList.add('d-none');
    });

    document.getElementById('prevYearRange').addEventListener('click', () => {
        currentStartYear -= 10;
        renderYearGrid();
    });
    document.getElementById('nextYearRange').addEventListener('click', () => {
        currentStartYear += 10;
        renderYearGrid();
    });

    function renderYearGrid() {
        const yearGrid = document.getElementById('yearGrid');
        const yearRangeText = document.querySelector('.currentYearRange');
        yearGrid.innerHTML = '';

        for (let i = currentStartYear; i < currentStartYear + 10; i++) {
            const btn = document.createElement('button');
            btn.className = 'btn btn-outline-secondary m-1';
            btn.textContent = i;
            btn.onclick = () => {
                selectedYear = i;
                yearGrid.style.display = 'none';
                document.getElementById('monthGrid').style.display = 'flex';
            };
            yearGrid.appendChild(btn);
        }
        yearRangeText.textContent = `${currentStartYear} - ${currentStartYear + 9}`;
    }

    function renderMonthGrid() {
        const months = ['Jan.', 'Feb.', 'Mar.', 'Apr.', 'May', 'June', 'July', 'Aug.', 'Sep.', 'Oct.', 'Nov.', 'Dec.'];
        const monthGrid = document.getElementById('monthGrid');
        monthGrid.innerHTML = '';

        months.forEach((month, index) => {
            const btn = document.createElement('button');
            btn.className = 'btn btn-outline-secondary m-1';
            btn.textContent = month;
            btn.onclick = () => {
                selectedMonth = index + 1;
                fetchChartData();
            };
            monthGrid.appendChild(btn);
        });
    }
    Chart.register(ChartDataLabels); 

    const categoryChart = new Chart(document.getElementById('categoryChart').getContext('2d'), {
        type: 'pie',
        labels: {!! json_encode($categoryChart->pluck('category')) !!},
        data: {
            labels: {!! json_encode($categoryChart->map(fn($c) => \Carbon\Carbon::create($c->year, $c->month)->translatedFormat('F Y'))) !!},
            datasets: [{
                label: 'จำนวนตามประเภท',
                data: {!! json_encode($categoryChart->pluck('count')) !!},
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#66BB6A', '#BA68C8']
            }]
        }
    });

    const statusChart = new Chart(document.getElementById('statusChart').getContext('2d'), {
        type: 'pie',
        labels: {!! json_encode($statusChart->pluck('status')) !!},
        data: {
            labels: {!! json_encode($statusChart->map(fn($c) => \Carbon\Carbon::create($c->year, $c->month)->translatedFormat('F Y'))) !!},
            datasets: [{
                label: 'จำนวนตามสถานะ',
                data: {!! json_encode($statusChart->pluck('count')) !!},
                backgroundColor: ['#F06292', '#4FC3F7', '#FFD54F', '#81C784', '#E57373']
            }]
        }
    });

    function fetchChartData() {
    const baseUrl = `{{ route('dashboard') }}`;
    const url = new URL(baseUrl, window.location.origin);
    if (selectedYear) url.searchParams.append("year", selectedYear);
    if (selectedMonth) url.searchParams.append("month", selectedMonth);
    window.location.href = url.toString(); 
}

</script>

@endsection
