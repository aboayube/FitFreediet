@extends('layouts.front.app')
@section('content')

<section class="subPageTitle text-right">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
          <li class="breadcrumb-item active" aria-current="page"> تواصل معنا </li>
        </ol>
      </nav>
    </div>
  </section>
  <!-- End Title Sub Pages -->
  <!-- Start About Us Section  -->
  <section class="section contact-us-form">
    <div class="container">
      <div class="row">
        <form class="w-75 text-right" method="POST" action="{{route('contact-us.store')}}">
@csrf
          <div class="inputs">
            <div class="form-group">
              <input class="form-control mb-20" type="text" placeholder="الإسم" name="name" value="{{ old('name')}}">
              @error('name')
<div class="text-danger">{{$message}}</div>
              @enderror
            </div>
            <div class="form-group">
              <input class="form-control mb-20" type="email" placeholder="البريد الإلكتروني" name="email" value="{{old('email')}}">
              @error('email')
<div class="text-danger">{{$message}}</div>
              @enderror</div>
            <div class="form-group">
              <input class="form-control mb-20" type="text" placeholder="رقم الهاتف"  name="phone" value="{{old('phone')}}">
              @error('phone')
<div class="text-danger">{{$message}}</div>
              @enderror  </div>
            <div class="form-group">
              <textarea class="form-control" name="message" placeholder="الموضوع">{{old('message')}}</textarea>
              @error('message')
<div class="text-danger">{{$message}}</div>
              @enderror

            </div>
            <div class="form-group">
              <input type="submit" class=" btn btn-success btn-website btn-block" value="تواصل معنا">
            </div>

          </div>
        </form>
      </div>
    </div>
  </section>

  @include('sweetalert::alert')
@endsection
