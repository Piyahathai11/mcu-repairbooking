<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>

<!-- small & medium screen-->


      <nav class=" navbar navbar-light bg-light d-lg-none d-md-none d-sm-block px-3 " style="background: linear-gradient(135deg, #FFFFFF, #F8B4E9);">
        <a href="/" class="navbar-brand">
          <img src="{{ asset('images/mcu_loco.png') }}" alt="icon" width="60" height="60" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#mobileNav"
          aria-controls="mobileNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>


      <ul class="collapse nav nav-pills bg-light flex-column  p-3 d-lg-none d-md-none" id="mobileNav">

       <li> <a href="#" class="nav-link text-start">รายงาน</a></li>
       <li> <a href="#" class="nav-link text-start">รายการแจ้งซ่อม</a></li>
       <li><a href="/myrepair" class="nav-link text-start">จัดการสมาชิก</a></li>
       <li><a href="/setting" class="nav-link text-start">แจ้งลงทะเบียน</a></li>
       <li><a href="/logout" class="nav-link text-start">โปรไฟล์</a></li>
       <li><a href="/logout" class="nav-link text-start">ออกจากระบบ</a></li>
</ul>

<!-- Desktop Sidebar -->
<div class="d-none d-lg-flex d-md-flex flex-column position-fixed top-0 start-0 p-3 me-3 border" style="width: 220px; height: 100vh;  background: linear-gradient(135deg, #FFFFFF, #F8B4E9);">
  <a href="/" class="d-flex align-items-center mb-3 text-decoration-none">
    <img src="{{ asset('images/mcu_loco.png') }}"  alt="icon" width="100" height="100" class="me-2" />
  </a>
  <hr />
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item"><a href="/home" class="nav-link">รายงาน</a></li>
    <li class="nav-item"><a href="/booking" class="nav-link">รายการแจ้งซ่อม</a></li>
    <li class="nav-item"><a href="/booking" class="nav-link">จัดการสมาชิก</a></li>
    <li class="nav-item"><a href="/myrepair"  class="nav-link">แจ้งลงทะเบียน</a></li>


  </ul>
  <hr />
  <div class="dropdown">
    <a
      href="#"
      class="d-flex align-items-center text-decoration-none  dropdown-toggle"
      id="userDropdown"
      data-bs-toggle="dropdown"
      aria-expanded="false"
      role="button"
    >
      <i class="bi bi-person-circle fs-4 me-2"></i> 
    </a>
    <ul class="dropdown-menu text-small" aria-labelledby="userDropdown">
      <li><a class="dropdown-item" href="/setting">โปรไฟล์</a></li>
      <li><hr class="dropdown-divider" /></li>
      <li><a class="dropdown-item" href="/php-basic/public/logout">ออกจากระบบ</a></li>
    </ul>
  </div>
</div>






</body>
</html>
