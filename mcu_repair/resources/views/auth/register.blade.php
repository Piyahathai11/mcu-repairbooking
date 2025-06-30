@extends('layouts.AuthLayout')

@section('title','ลงทะเบียน')


@section('content')


<div class="d-flex mx-auto justify-content-center align-items-center vw-100 ">
    <section class="background-radial-gradient overflow-hidden">
      <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
          <div class="col-lg-12 mb-lg-1" >
            <h1
              class="fw-bold me-1 ">
              ลงทะเบียน
            </h1>
          </div>

          <div class="col-lg-10 mb-5 mb-lg-0 ms-5 position-relative">
            <div class="card bg-glass">
              <div class="card-body px-4 py-5 px-md-5">
                <form method="POST" action="{{route('register')}}">
                    @csrf
                  <div class="form-outline mb-4">
                    <label htmlFor="fullName" class="form-label">ชื่อ-นามสกุล:</label>
                    <input type="text" id="fullName" name="fullName" class="form-control" required />
                  </div>

                  <div class="form-outline mb-4">
                    <label htmlFor="userName" class="form-label">Username:</label>
                    <input type="text" id="userName" name="username" class="form-control" required  />
                  </div>

                  <div class="form-outline mb-4">
                    <label htmlFor="email" class="form-label">อีเมลล์:</label>
                    <input type="email" id="email" name="email" class="form-control" required  />
                  </div>

                  <div class="form-outline mb-4">
                    <label htmlFor="tel" class="form-label">เบอร์ติดต่อ:</label>
                    <input type="tel" id="tel" name="phone" class="form-control" required/>
                  </div>

                  <div class="form-outline mb-4">
                    <label htmlFor="position" class="form-label">ตำแหน่ง:</label>
                    <input type="text" id="position" name="position" class="form-control" required  />
                  </div>

                  <div class="form-outline mb-4">
                    <label htmlFor="personel" class="form-label">บุคลากร:</label>
                    <select
                        class="form-select mb-3"
                        value={personnel}
                        name="personnel"
                        required >
                <option value="">-- กรุณาเลือก --</option>
                <option value="บุคลากรภายใน">บุคลากรภายใน</option>
                <option value="บุคลากรภายนอก">บุคลากรภายนอก</option>
              </select>
              </div>

                  <div class="form-outline mb-4">
                    <label htmlFor="password" class="form-label">รหัสผ่าน:</label>
                    <input type="password" id="password" name="password" class="form-control" />
                  </div>

                  <button type="submit" class="pinkbutton mb-4">ลงทะเบียน</button>
                </form>

                <form id="logoutForm" action="{{ route('login')}}" method="POST">
                    @csrf
                    <button type="submit" class="pinkbutton">Logout</button>
                  </form>
                  
                    </a>
            
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>



@endsection