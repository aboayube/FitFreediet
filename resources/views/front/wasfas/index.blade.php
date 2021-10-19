@extends('layouts.front.app')
@section('content')
<section class="subPageTitle text-right">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
          <li class="breadcrumb-item active" aria-current="page"> الوصفات </li>
        </ol>
      </nav>
    </div>
  </section>



  <section class="section wsafat-sec">
    <div class="container">
      <div class="food-galary">
          @foreach ($wasfas as $wasfa)

        <div class="one box">
          <a href="{{route('frontend.wasfa',$wasfa->title)}}">

            <img src="{{asset('assets/wasfas/'.$wasfa->image)}}" alt="">
            <div class="overlay">
              <h2>{{$wasfa->title}}</h2>
            </div>
          </a>
        </div>

        @endforeach
      </div>
    </div>
  </section>

@endsection
