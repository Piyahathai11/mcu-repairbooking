@extends('layouts.UserLayout')

@section('title', 'แจ้งซ่อม')

@section('content')
@if (session('success'))
<script>
window.onload = function (){
  alert("{{session('success')}}");
}
</script>
@endif

<div class="col-lg-9 col-md-9">
    <div class="container mt-5 mb-3">
      <div class="row mx-auto">
        <div class="col-lg-10 col-md-10 col-sm-12 mx-auto">
          <div class="w-100 mb-3 ms-2 mb-4 p-4">
            <h1 class="fw-bold">ระบบแจ้งซ่อม</h1>
          </div>

          <!-- Progress Bar -->
          <div class="col-12 position-relative mt-3">
            <div class="position-relative m-4">
              <!-- <div class="progress" style="height: 1px;background-color:#ffc0cb;">
                <div class="progress-bar" role="progressbar" style="width: 50%;"></div>
              </div>
              <button type="button" class="progressButton position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill">1</button>
              <button type="button" class="progressButton position-absolute top-0 start-100 translate-middle btn btn-sm btn-primary rounded-pill">2</button>
            </div>
          </div> -->

          <form enctype="multipart/form-data" action="{{route('booking.form')}}"  method="POST" id="booking" name="booking"  class="mt-3">
              @csrf
            <!-- Step 1 -->
            <div id="step1">
              <h3>แจ้งซ่อม</h3>
              <div class="mb-3">
                <label class="form-label mb-2">กรุณาเลือก</label>
                <select class="form-select mb-3"name="category" required>
                  <option value="">-- กรุณาเลือก --</option>
                  <option value="อาคาร">อาคาร</option>
                  <option value="เครื่องใช้ไฟฟ้า">เครื่องใช้ไฟฟ้า</option>
                  <option value="ประปา">ประปา</option>
                </select>

                <label class="form-label">รายละเอียดปัญหา</label>
                <textarea class="form-control mb-3" name="detail"></textarea>

                <label class="form-label">สถานที่เกิดปัญหา</label>
                <input type="text" class="form-control mb-3" name="place"/>

                <label class="form-label">รูปภาพ:</label>
                <input class="form-control mb-3" type="file" name="image" accept="image/*" />

                <label class="form-label">เอกสารเพิ่มเติม (ถ้ามี):</label>
                <input class="form-control mb-3" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx" multiple />
              </div>
            </div>

            <!-- Step 2 -->
            <div id="userInfo" class="d-none">
              <h3>ข้อมูลเพิ่มเติม</h3>
              <div class="mb-3">
                <label class="form-label">ชื่อ นามสกุล</label>
                <input type="text" class="form-control mb-3" name="fullName" />

                <label class="form-label">ตำแหน่ง</label>
                <input type="text" class="form-control mb-3" name="position" required />

                <label class="form-label">บุคลากร</label>
                <select class="form-select mb-3" name="personnel"  required>
                  <option value="">-- กรุณาเลือก --</option>
                  <option value="บุคลากรภายใน">บุคลากรภายใน</option>
                  <option value="บุคลากรภายนอก">บุคลากรภายนอก</option>
                </select>

                <label class="form-label">เบอร์ติดต่อ</label>
                <input type="tel" class="form-control mb-3" name="phone" required />
              </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="d-flex justify-content-between mt-3">
              <button type="button" id="prevButton" class="pinkbutton d-none">ย้อนกลับ</button>
              <button type="button" id="nextButton" class="pinkbutton">ถัดไป</button>
              <button type="submit" id="submitButton" class="pinkbutton d-none">ส่ง</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Step Navigation Script -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const nextButton = document.getElementById("nextButton");
    const prevButton = document.getElementById("prevButton");
    const submitButton = document.getElementById("submitButton");
    const step1 = document.getElementById("step1");
    const step2 = document.getElementById("userInfo");

    nextButton.addEventListener("click", () => {
      step1.classList.add("d-none");
      step2.classList.remove("d-none");
      prevButton.classList.remove("d-none");
      nextButton.classList.add("d-none");
      submitButton.classList.remove("d-none");
    });

    prevButton.addEventListener("click", () => {
      step2.classList.add("d-none");
      step1.classList.remove("d-none");
      prevButton.classList.add("d-none");
      nextButton.classList.remove("d-none");
      submitButton.classList.add("d-none");
    });
  });
</script>


@endsection