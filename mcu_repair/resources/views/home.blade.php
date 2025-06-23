
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ระบบการแจ้งซ่อม</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/assets/style.css" />
</head>
<body>

  <div class="container">
    <div class="row mx-auto ms-5">
      
      <!-- Sidebar: 3 columns on large screens -->


      <div class="col-lg-3 col-md-3">
        <div class="sidebar">
            @include('sidebar')
        </div>
      </div>

      <div class=" col-lg-8 col-md-10 mx-auto">
        <div class="container d-flex justify-content-center align-items-center mt-3 w-100">
          <div class="col-lg-12 col-md-10 col-sm-8 mx-auto">

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

          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">




    
  </script>

</body>
</html>
