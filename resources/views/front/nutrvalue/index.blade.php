@extends('layouts.front.app')
@section('content')
<style>

.nutrl-value{
  overflow-x: hidden;
}

</style>
<section class="subPageTitle text-right">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
          <li class="breadcrumb-item active" aria-current="page"> نتيجة إنشاء الحساب </li>
        </ol>
      </nav>
    </div>
  </section>
  <!-- End Title Sub Pages -->
  <!-- Start After Reg Section  -->
  <section class="section nutrl-value">
    <h1 class="text-center">أدخل الوجبة التي تناولتها</h1>
<br>
    <div class="container text-center" style="margin-right:310px">
      <form class="text-right" action="{{route('frontend.nutrvalue.get')}}" method="POST">
        @csrf
       <div class="row">
          <div class="col-lg-4">
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="إسم الوجبة">
            </div>

          </div>
          <div class="col-lg-4">
            <div class="form-group">
              <input type="submit" class="btn btn-success btn-website btn-block" value="إحسب" id="getNutruval">
            </div>
          </div>
        </div>



      </form>

  </section>



@endsection
