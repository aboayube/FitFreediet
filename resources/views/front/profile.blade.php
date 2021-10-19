@extends('layouts.front.app')
@section('content')

    <div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">{{$user->name}}</a></li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{asset('assets/users/'.$user->image)}}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{$user->name}}</h4>
                      <p class="text-secondary mb-1"> ايميل:
                      <span >{{$user->email}}</span></p>
                    
                      <p class="text-muted font-size-sm">حالة 
                      <span class="text-primary"> {{$user->status==1? "مفعل" : "غير مفعل"}}
                      </span></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
      
     <div class="card-body">
      
      
                <form action="{{route('user.profile.edit')}}" enctype="multipart/form-data" method="POST">
          @csrf
                  <div class="row">
                  
                

                  <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">كلمة السر</h6>
                    </div>
                    <div class="col-sm-2 text-secondary">
                      <input type="password" class="@error('password') is-invalid @enderror"  id="password" name="password" class="form-control"  style="width:190px;">
                    </div>
                    <div class="col-sm-4">
                      <h6 class="mb-0">تاكيد كلمة السر</h6>
                    </div>
                    <div class="col-sm-2 text-secondary">                      
                    <input type="password" class="@error('conf_password') is-invalid @enderror"  id="password" name="confirm_password" class="form-control"  style="width:190px;">

                  </div>
                  </div>
                  <br>
                  <hr>

                  <div class="row">
                  <div class="col-sm-4">
                  <br>
                      <h6 class="mb-0">صورة شخصية</h6>
                    </div>
                    <div class="col-sm-2 text-secondary">
                  <br>
                      <input type="file" name="image" class="@error('image') is-invalid @enderror"  >
                    </div></div>
                  </div>
                  <hr>
<button class="btn btn-primary">تعديل البيانات  </button>
                </div>

              </div>
                </form>

            </div>
          </div>

        </div>
    </div>
@endsection