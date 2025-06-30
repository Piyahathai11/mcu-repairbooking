@extends('layouts.NormLayout')

@section('title', 'หน้าแรก')

@section('content')
  <h2 class="mt-2 mb-4">คำแนะนำการลงทะเบียน</h2>
  
  <div class="row mt-5 mx-auto mb-5">
     <div class="d-flex flex-row justify-content-center flex-wrap gap-5">
        <div class="d-flex flex-column align-items-center">
            <div class="circle-number mb-3">1</div>
            <h5 class="mb-0 text-center">เข้าสู่ระบบ</h5>
        </div>

        <div class="d-flex flex-column align-items-center">
            <div class="circle-number mb-3">2</div>
            <h5 class="mb-0 text-center">กรอกข้อมูลให้ครบถ้วน</h5>
        </div>

        <div class="d-flex flex-column align-items-center">
            <div class="circle-number mb-3">3</div>
            <h5 class="mb-0 text-center">ตรวจสอบสถานะ</h5>
        </div>
    </div>
  </div>

  <div class="col-lg-10">
    <h2 class="fw-bold mb-4">ประวัติการแจ้งซ่อม</h2>
  </div>
@endsection
