@extends('layouts.master')
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                 حساب الشخصي</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="container">
<div class="row">


@if(auth()->user()->role=='docotor')
<div class="col-xl-8"><div class="card mg-b-20" >
            <div class="card-header pb-0">
            <div class="main-content-label mg-b-5 text-center">
						تعديل حساب الشخصي
								</div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
               <form   style="
    overflow: hidden;" action="{{route('admin.specialty.edit')}}" method="POST" class="text-center"  enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">تخصص</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="specialty" name="specialty" value="{{$user->docotor->specialty}}">
      @error('specialty')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>
  <div class="form-group row">
    <label for="discription" class="col-sm-2 col-form-label">وصف</label>
    <div class="col-sm-10">
      <textarea class="form-control" id="discription" name="discription">{{$user->docotor->discription}}</textarea>
      @error('discription')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div> <div class="form-group row">
    <label for="logo" class="col-sm-2 col-form-label">سيرة الذاتية</label>
    <div class="col-sm-10">
<input type="file" name="cv">
    @error('cv')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>

<button class="btn btn-info" >تعديل</button>
            </form>
                </div>
            </div>
        </div>

@endif
        <div class="card mg-b-20">
            <div class="card-header pb-0">
            <div class="main-content-label mg-b-5 text-center">
						تعديل حساب الشخصي
								</div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
               <form   style="
    overflow: hidden;" action="{{route('admin.profile.edit')}}" method="POST" class="text-center"  enctype="multipart/form-data">
        @csrf
       <input type="hidden" name="id" value="{{$user->id}}">
        <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">كلمة السر</label>
    <div class="col-sm-10">
      <input type="password"  class="form-control" id="password" name="password">
      @error('password')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label"> تاكيد كلمة السر</label>
    <div class="col-sm-10">
      <input type="password"  class="form-control" id="confirm_password" name="confirm_password">
      @error('password')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>









  <div class="form-group row">
    <label for="logo" class="col-sm-2 col-form-label">شعار الموقع</label>
    <div class="col-sm-10">
<input type="file" name="image">
    @error('logo')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>

<button class="btn btn-info" >تعديل</button>
            </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 text-center">
        <h1 class="text-center">صورة شخصية</h1>
    @if(isset($user->image))
               <img width="100" height="200" src="{{asset('assets/users/'.$user->image)}}">
@endif
</div>







    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
</div>

</div>
@include('sweetalert::alert')
@endsection
