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
              <input
                type="text"
                class="form-control me-2"
                id="searchInput"
               
              />
              <button class="btn btn-primary" >
                <i class="fas fa-plus"></i>
              </button>
            </div>
          </div>

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
                @foreach ($users as $u)
                <tbody>
       
                    <tr >
                      <td>{{$u->fullName}}</td>
                      <td>{{$u->username}}</td>
                      <td>{{$u->position}}</td>
                      <td>{{$u->personnel}}</td>
                      <td>{{$u->email}}</td>
                      <td>{{$u->phone}}</td>
                      <td>7</td>
                      <td>
                        <form method="POST" action="{{route('userDelete', ['id' => $u->id])}}">
                            @csrf
                            <button class="btn btn-primary" >     
                          <i class="fas fa-minus">
                            </i></button>
                        </form>
                      
                      </td>

                    </tr>
                </tbody>
                @endforeach
              </table>

          </div>
        </div>
      </div>
    </div>
  </div>



@endsection