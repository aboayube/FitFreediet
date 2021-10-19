@extends('layouts.master')
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                 FitFree</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="container">
<div class="row">



<div class="col-xl-8">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
            <div class="main-content-label mg-b-5 text-center">
								اعدادات الخاصة بموقع
								</div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
               <form action="{{route('admin.settings.update')}}" method="POST" class="text-center"  enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">اسم</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="name" value="{{$setting->name}}" name="name">
      @error('name')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>

  <div class="form-group row">
    <label for="discription" class="col-sm-2 col-form-label">وصف</label>
    <div class="col-sm-10">
<textarea name="discription" class="form-control">{{$setting->discription}}</textarea>
    @error('discription')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>

  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">email</label>
    <div class="col-sm-10">
      <input type="email"  class="form-control" id="email" value="{{$setting->email}}" name="email">
      @error('email')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>

  <div class="form-group row">
    <label for="facebook" class="col-sm-2 col-form-label">facebook</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="facebook" value="{{$setting->facebook}}" name="facebook">
      @error('facebook')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>
  <div class="form-group row">
    <label for="twiter" class="col-sm-2 col-form-label">twiter</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="twiter" value="{{$setting->twiter}}" name="twiter">
      @error('twiter')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>
  <div class="form-group row">
    <label for="linked_in" class="col-sm-2 col-form-label">linked_in</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="linked_in" value="{{$setting->linked_in}}" name="linked_in">
      @error('linked_in')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>
  <div class="form-group row">
    <label for="instagram" class="col-sm-2 col-form-label">instagram</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="instagram" value="{{$setting->instagram}}" name="instagram">
      @error('instagram')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>
  <div class="form-group row">
    <label for="whatsapp" class="col-sm-2 col-form-label">whatsapp</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="whatsapp" value="{{$setting->whatsapp}}" name="whatsapp">
      @error('whatsapp')
                       <span class="text-danger">{{$message}}</span>
                   @enderror  </div>
  </div>
  <div class="form-group row">
    <label for="logo" class="col-sm-2 col-form-label">شعار الموقع</label>
    <div class="col-sm-10">
<input type="file" name="logo">
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
    <div class="col-xl-3">
    @if(isset($setting->logo))
               <img width="100" height="200" src="{{asset('assets/'.$setting->logo)}}">
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
