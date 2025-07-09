@extends('layouts.NormLayout')

@section('title', 'จัดการสมาชิก')

<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
/>

@if(session('failed'))
<script>
  window.onload = function (){
    alert("{{session('failed')}}");
  }
  </script>

@else

<script>
  window.onload = function (){
    alert("{{session('success')}}");
  }
  </script>


@endif

@section('content')
<script>
  document.addEventListener('DOMContentLoaded', function(){
      const searchingInput = document.getElementById('searchingInput');
      const tableRows = document.querySelectorAll('#userTable tbody tr');

      searchingInput.addEventListener('keyup',function(){
          const keyword = this.value.toLowerCase();

          tableRows.forEach(row => {
              const rowText =row.innerText.toLowerCase();
              row.style.display = rowText.includes(keyword) ? '': 'none';
          });
      });

  });
</script>
<div class="container mt-4">
  <div class="col-12  mx-auto">
    <h1 class="text-xl font-bold mb-4">จัดการสมาชิก</h1>

    <div class="card p-4 rounded bg-white">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0">สมาชิกทั้งหมด</h5>
          <div class="d-flex">
            <input type="text" class="form-control me-2" id="searchingInput" placeholder="Search..."/>
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
          <table class="table table-bordered table-striped w-100" id="userTable">
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
                <td> <form method="POST" action="{{ route('UpdateUserStatus', ['id' => $u->id]) }}" >
                  @csrf
                  <select class="form-select" name="status" onchange="this.form.submit()">
                    <option value="pending" {{ $u->status->value === 'pending' ? 'selected' : '' }}>ยื่นคำร้อง</option>
                    <option value="approved" {{ $u->status->value === 'approved' ? 'selected' : '' }}>รับคำร้อง</option>
                    <option value="reject" {{ $u->status->value === 'reject' ? 'selected' : '' }}>ยกเลิกคำร้อง</option>
                    
                </select>
                

                  </form>
                
                </td>
                <td>

                    <button type="button"class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#UserEditModal{{$u->id}}">
                      <i class="bi bi-pencil-square"></i>
                    </button>


   
                  <form method="POST" action="{{ route('userDelete', ['id' => $u->id]) }}">
                    @csrf
                    <button class="btn btn-primary btn-sm">
                      <i class="fas fa-minus"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- EditModal --}}

      @foreach ($users as $user)
          

      <div class="modal fade" id="UserEditModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $user->id }}" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">แก้ไขข้อมูลสมาชิก</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body table-responsive">
             
            <form method="POST" action="{{route('UpdateUser',['id'=> $user->id])}}">
              
              @csrf
                    
                <label class="form-label">user name</label>
                <input
                type="text"
                class="form-control mb-3"
                name="username"
                placeholder={{$user->username}}
                value={{$user->username}}
                required
                />
                <label class="form-label">ชื่อ นามสกุล</label>
                <input
                type="text"
                class="form-control mb-3"
                name="fullName"
                placeholder={{$user->fullName}} 
                value={{$user->fullName}}
                required
                />

                <label class="form-label">ตำแหน่ง</label>
                <input
                type="text"
                class="form-control mb-3"
                name="position"
                placeholder={{$user->position}} 
                value={{$user->position}}
                required
                />

                <label class="form-label">บุคลากร</label>
                <select
                class="form-select mb-3"
                name="personnel"
                value={{$user->personnel}}
                required
                >
                <option value="">-- กรุณาเลือก --</option>
                <option value="บุคลากรภายใน">บุคลากรภายใน</option>
                <option value="บุคลากรภายนอก">บุคลากรภายนอก</option>
                </select>

                <label class="form-label">อีเมลล์</label>
                <input
                type="tel"
                class="form-control mb-3"
                name="email"
                placeholder={{$user->email}}
                value={{$user->email}}
                required
                />

                <label class="form-label">เบอร์ติดต่อ</label>
                <input
                type="tel"
                class="form-control mb-3"
                name="phone"
                placeholder={{$user->phone}}
                value={{$user->phone}}
                required
                />

               
                  <label class="form-label">รหัสผ่าน</label>
                      <div class="input-group mb-3">
                        <input
                          type="password"
                          class="form-control"
                          id="passwordInput{{ $user->id }}"
                          name="password"
                          value="{{ $user->password }}"
                        />
                          <button 
                            type="button" 
                            class="btn btn-outline-secondary form-password-action" 
                            aria-label="Toggle password visibility"
                            onclick="togglePasswordVisibility('passwordInput{{ $user->id }}', this)"
                          >
                            <i class="bi bi-eye-slash-fill"></i>
                          </button>
                      </div>

            
              
                    <button type="submit" class="btn btn-primary w-100">
                    บันทึกข้อมูล
                    </button>
         
            </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endforeach


  </div>
</div>
<script>
  function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');

    if (input.type === 'password') {
      input.type = 'text';
      icon.classList.remove('bi-eye-slash-fill');
      icon.classList.add('bi-eye-fill');
    } else {
      input.type = 'password';
      icon.classList.remove('bi-eye-fill');
      icon.classList.add('bi-eye-slash-fill');
    }
  }
</script>
@endsection
