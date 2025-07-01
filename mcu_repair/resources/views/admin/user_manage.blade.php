@extends('layouts.NormLayout')

@section('title', 'จัดการสมาชิก')

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
/>

@section('content')

<div class="container mt-4">
  <div class="col-12 col-md-10 col-lg-8 mx-auto">
    <h1 class="text-xl font-bold mb-4">จัดการสมาชิก</h1>

    <div class="card p-4 rounded bg-white">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0">Admin Users</h5>
          <div class="d-flex">
            <input type="text" class="form-control me-2" id="searchInput" />
            <button class="btn btn-primary" id="addForm" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <form method="POST" action="{{ route('AddAdmin') }}">
                @csrf
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">เพิ่มผู้ดูแลระบบ</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <div class="form-outline mb-3">
                    <label for="fullName" class="form-label">ชื่อ-นามสกุล:</label>
                    <input type="text" id="fullName" name="fullName" class="form-control" required />
                  </div>

                  <div class="form-outline mb-3">
                    <label for="userName" class="form-label">Username:</label>
                    <input type="text" id="userName" name="username" class="form-control" required />
                  </div>

                  <div class="form-outline mb-3">
                    <label for="email" class="form-label">อีเมลล์:</label>
                    <input type="email" id="email" name="email" class="form-control" required />
                  </div>

                  <div class="form-outline mb-3">
                    <label for="tel" class="form-label">เบอร์ติดต่อ:</label>
                    <input type="tel" id="tel" name="phone" class="form-control" required />
                  </div>

                  <div class="form-outline mb-3">
                    <label for="position" class="form-label">ตำแหน่ง:</label>
                    <input type="text" id="position" name="position" class="form-control" required />
                  </div>

                  <div class="form-outline mb-3">
                    <label for="personnel" class="form-label">บุคลากร:</label>
                    <select class="form-select" name="personnel" required>
                      <option value="">-- กรุณาเลือก --</option>
                      <option value="บุคลากรภายใน">บุคลากรภายใน</option>
                      <option value="บุคลากรภายนอก">บุคลากรภายนอก</option>
                    </select>
                  </div>

                  <div class="form-outline mb-3">
                    <label for="password" class="form-label">รหัสผ่าน:</label>
                    <input type="password" id="password" name="password" class="form-control" required />
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                  <button type="submit" class="btn btn-primary">ลงทะเบียน</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped w-100">
            <thead class="table-light">
              <tr>
                <th>ชื่อ-นามสกุล</th>
                <th>Username</th>
                <th>ตำแหน่ง</th>
                <th>บุคลากร</th>
                <th>อีเมลล์</th>
                <th>เบอร์ติดต่อ</th>
                <th>สถานะ</th>
                <th>ดำเนินการ</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $u)
              <tr>
                <td>{{ $u->fullName }}</td>
                <td>{{ $u->username }}</td>
                <td>{{ $u->position }}</td>
                <td>{{ $u->personnel }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->phone }}</td>
                <td>{{ $u->status ?? '-' }}</td>
                <td>
                  <form method="POST" action="{{ route('userDelete', ['id' => $u->id]) }}">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                      <i class="fas fa-minus"></i>
                    </button>
                  </form>
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
