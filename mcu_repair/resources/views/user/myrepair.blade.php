@extends('layouts.NormLayout')

@section('title', 'การแจ้งซ่อมของฉัน')

@php
    use Carbon\Carbon;
    Carbon::setLocale('th');
@endphp

@section('content')
<div class="container mx-auto mt-4">
    <div class="col-12 col-md-10 col-lg-8">
        <h1 class="text-xl font-bold mb-4">การแจ้งซ่อมของฉัน</h1>
        <div class="card p-4 w-100 rounded bg-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex">
                        <input type="text" class="form-control me-2" placeholder="Search..." />
                    </div>
                </div>

                <div class="table-responsive">
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
                                        <img src="{{ asset($booking->image_path) }}" alt="รูปภาพ"
                                            style="max-width: 100px; height: auto;">
                                    </td>
                                    <td>{{ $booking->status }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary">view</button>
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
