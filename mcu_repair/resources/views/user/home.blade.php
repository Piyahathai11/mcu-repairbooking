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
  



  <div class="d-flex flex-row flex-nowrap overflow-auto gap-2">

          @foreach ($booking as $bookings)
          <div class="card" style="max-width:200px; flex:0 0 auto;" >
        
                <div class="card-header bg-light">
                  <small class="text-muted">
                  <i class="bi bi-calendar-check me-3"></i>
                    {{$bookings->created_at}}
                  </small>
                </div>

        
                  <div class="card-body">
                    <img src="{{asset($bookings->image_path)}}"
                    alt="รูปภาพ"
                    style="max-width: 100px; height: auto;"> 
                    
                        
                  
                    <h5 class="card-titl mb-2"></h5>
                    <p class="card-text">
                  
                    <i class="bi bi-journal-text me-2"></i>{{$bookings->detail}}<br />
                      <i class="bi bi-geo-fill me-1"></i>{{$bookings->place}}
                    </p>
                  </div>
          </div>
 
          @endforeach
</div>
</div>


@endsection
