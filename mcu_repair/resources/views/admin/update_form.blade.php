@extends('layouts.layout')

@section('title','update form')


@section('content')
<div class="col-lg-10 col-md-8 ">
    <div class="container mt-5 ">
      <div class="card  p-4">
        <h2 class="mb-4">อัปเดตเพิ่มเติม</h2>
 
        <form >
          <div class="form-group mb-3">
            <label>วันที่เสร็จ/คาดว่าจะเสร็จ</label>
            <input
              type="date"
              class="form-control"
              value={finishedDate}
            />
          </div>
          <div class="form-group mb-3">
            <label>เพิ่มเติม</label>
            <textarea
              class="form-control"
              rows={3}
              value={updateNote}
            ></textarea>
          </div>
          <div class="form-group mb-3">
            <label>ค่าใช้จ่าย</label>
            <input
              type="number"
              class="form-control"
              value={totalPayment}
            />
          </div>
          <button type="submit" class="pinkbutton">
           บันทึก
          </button>
        </form>
      </div>
    </div>
  </div>

  @endsection