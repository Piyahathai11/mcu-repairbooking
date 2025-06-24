@extends('layouts.layout')

@section('title', 'การแจ้งซ่อมของฉัน')

@section('content')



<div class="container mx-auto mt-4">
    <div class="col-12 col-md-10 col-lg-8">
      <h1 class="text-xl font-bold mb-4">การแจ้งซ่อมของฉัน</h1>
      <div class="card p-4  w-100 rounded bg-white">
        <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex">
                  <input
                    type="text"
                    class="form-control me-2"
                    placeholder="Search..."
                />
                
                </div>
          </div>
   
   
            <table class="table table-bordered table-striped w-100">
              <thead class="thead-dark">
                <tr>
                  <th>เลขที่</th>
                  <th>ประเภท</th>
                  <th>รายละเอียดปัญหา</th>
                  <th>สถานที่เกิดปัญหา</th>
                  <th>สถานะ</th>
                  <th>เพิ่มเติม</th>
                  <th>แก้ไขล่าสุด</th>
                </tr>
              </thead>
              <tbody>

                  <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td></td>
                    <td>
                      <button class="btn btn-sm btn-primary">
                        view
                      </button>
                    </td>
                    <td>
                        date
                    </td>

                  </tr>

              </tbody>
      
        </div>
      </div>
    </div>
  </div>


  
      </div>
    </div>


@endsection