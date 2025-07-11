@extends('layouts.NormLayout')

@section('title','update form')
@if(session('success'))

<script>
  window.onload = function (){
    alert("{{session('success')}}");
  }
  </script>

@endif

@section('content')
<div class="col-lg-10 col-md-8 ">
    <div class="container mt-5 ">
      <div class="card  p-4">
        <h2 class="mb-4">อัปเดตเพิ่มเติม</h2>
        @foreach ($booking as $bookings)
        <form method="POST" action="{{route('updateNote',['id'=> $bookings->id])}}">
          @csrf
          <div class="form-group mb-3">
            <label>วันที่เสร็จ/คาดว่าจะเสร็จ</label>
            <input
              type="date"
              class="form-control"
              name="estimated_finish_date"
            />
          </div>
          <div class="form-group mb-3">
            <label>เพิ่มเติม</label>
            <textarea
              class="form-control"
              rows={3}
              name="updated_note"
            ></textarea>
          </div>
          <div class="form-group mb-3">
            <label>ค่าใช้จ่าย</label>
            <input
              type="number"
              class="form-control"
              name="total_cost"
            />
          </div>
          <button type="submit" class="btn btn-primary">
           บันทึก
          </button>

        </form>
        @endforeach
      </div>
    </div>
  </div>

  @endsection