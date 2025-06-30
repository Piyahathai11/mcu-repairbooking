@extends('layouts.layout')

@section('title', 'แจ้งซ่อม')
<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
@section('content')


<div class="row ms-5 mt-5">
    <div class="col-10 col-md-3 d-flex justify-content-center mx-5">
                <div style=" width: 700px; height: 700px;">
                        <dotlottie-player
                            src="https://lottie.host/fcf886d4-bb60-431c-a388-835b6a06d2b2/TuGHvjGkV4.lottie"
                            background="transparent"
                            speed="1"
                            style="width: 100%; height: 100%;"
                            loop
                            autoplay
                        ></dotlottie-player>

                </div>
        </div>


    <div class="col-8 col-md-6">
        <div class="card p-4 rounded bg-white w-100">
        <div class="card-body">

            <form method="GET" action="{{route('setting')}}">
                @foreach ($info as $u)
                    
                <label class="form-label">user name</label>
                <input
                type="text"
                class="form-control mb-3"
                placeholder={{$u->username}}
                required
                />
                <label class="form-label">ชื่อ นามสกุล</label>
                <input
                type="text"
                class="form-control mb-3"
                placeholder={{$u->fullName}}
                required
                />

                <label class="form-label">ตำแหน่ง</label>
                <input
                type="text"
                class="form-control mb-3"
                placeholder={{$u->position}}
                required
                />

                <label class="form-label">บุคลากร</label>
                <select
                class="form-select mb-3"
                placeholder={{$u->personnel}}
                required
                >
                <option value="">-- กรุณาเลือก --</option>
                <option value="บุคลากรภายใน">บุคลากรภายใน</option>
                <option value="บุคลากรภายนอก">บุคลากรภายนอก</option>
                </select>

                <label class="form-label">เบอร์ติดต่อ</label>
                <input
                type="tel"
                class="form-control mb-3"
                placeholder={{$u->phone}}
                required
                />

                <label class="form-label">รหัสผ่าน</label>
                <div class="input-group mb-3">
                <input
                    type="password"
                    class="form-control">
                <button
                    type="button"
                    class="btn btn-outline-secondary"
                >
                    <i class="bi bi-eye-slash-fill"></i> : <i class="bi bi-eye"></i>
                </button>
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary w-100">
                บันทึกข้อมูล
                </button>
            </form>
        
        </div>
        </div>
    </div>
    </div>



@endsection