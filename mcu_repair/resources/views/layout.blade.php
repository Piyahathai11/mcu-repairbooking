<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'ระบบการแจ้งซ่อม')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  @vite(['resources/css/style.css', 'resources/js/app.js'])

</head>
<body>

  <div class="container">

      
      <div class="col-lg-3 col-md-3">
        @include('sidebar')
      </div>
<div class="row mx-auto ms-5">
      <div class="col-lg-8 col-md-10 mx-auto">
        @yield('content')
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
