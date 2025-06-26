@extends('layouts.Authlayout')

@section('title', 'เข้าสู่ระบบ')

@section('content')

<div class="d-flex mx-auto justify-content-center align-items-center vw-100 " >
    <section class="background-radial-gradient overflow-hidden">
      <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
        <div class="row gx-lg-5 align-items-center mb-5">
          <div class="col-lg-4 mb-3 mb-lg-0" >
            <h1
              class="fw-bold"
            >
            Welcome back
            </h1>
          </div>

          <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
            <div class="card bg-glass">
              <div class="card-body px-4 py-5 px-md-5">
                <form onSubmit={handleSubmit}>


                  <div class="form-outline mb-4">
                    <label class="form-label" htmlFor="userName">User name:</label>
                    <input
                      type="text"
                      id="userName"
                      class="form-control"
                      required
                    />
                  </div>

      
                  <div class="form-outline mb-4">
                    <label class="form-label" htmlFor="password">Password:</label>
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      required
                    />
                  </div>

                

     
                  <button type="submit" class="pinkbutton mb-4">
                    เข้าสู่ระบบ
                  </button>
                 
                </form>

                <a href="/register">
                  <button type="submit" class="pinkbutton mb-4 mt-3">
                    สมัครสมาชิก
                </button>
                  </a>
                  
            
     

         
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    </div>


@endsection