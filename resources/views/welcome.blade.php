@extends('layouts.front.app')
@section('content')

<section class="main-slider">
    <div id="mainSlider" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
        <li data-target="#mainSlider" data-slide-to="1"></li>
        <li data-target="#mainSlider" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="img-slider" style="background: url({{asset('frontend/images/slider/1.jpg')}})no-repeat center center  fixed;">
          <div class="overlay"></div>
          <div class="carousel-caption d-none d-md-block">
            <p class="lead">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
              العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها
              التطبيق.
              إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو
              مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير
              من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>
            <a href="#" class="btn btn-success btn-website">نص عشوائي</a>
          </div>
        </div>
        <div class="carousel-item">
          <img class="img-slider" style="background: url({{asset('frontend/images/slider/2.jpg')}})no-repeat center center  fixed;">
          <div class="overlay"></div>
          <div class="carousel-caption d-none d-md-block">
            <p class="lead">هذا نص عشوائي</p>
            <a href="#" class="btn btn-success btn-website">نص عشوائي</a>
          </div>
        </div>
        <div class="carousel-item">
          <img class="img-slider" style="background: url({{asset('frontend/images/slider/3.jpg')}})no-repeat bottom  fixed;">
          <div class="overlay"></div>
          <div class="carousel-caption d-none d-md-block">
            <p class="lead">هذا نص عشوائي</p>
            <a href="#" class="btn btn-success btn-website">نص عشوائي</a>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#mainSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#mainSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>
  <section class="services-sec section">
    <div class="container">
      <div class="title-sections text-center mb-5">
        <i class="fas fa-hand-holding-heart"></i>
        <h3>الخدمات</h3>
      </div>
      <ul class="list-unstyled services-content">
        <div class="main-link">
          <li>
            <i class="fab fa-gratipay"></i>
            <span class="d-block">
              احسب   وجباتك مع حاسبة <kbd>Fit Free</kbd>
            </span>
            <hr>
            <a href="{{route('frontend.nutrvalue')}}" class="btn btn-success btn-website">انقر هنا</a>
          </li>
        </div>
        <div class="main-link">
          <li>
            <i class="fas fa-comments"></i>
            <span class="d-block">
              التواصل مع اخصائيين تغذية موثوقين
            </span>
            <hr>
            <a href="{{route('frontend.docotors')}}" class="btn btn-success btn-website">انقر هنا</a>
          </li>
        </div>
        <div class="main-link">
          <li>
            <i class="fas fa-virus"></i>
            <span class="d-block">
              نصائح للياقة لمواجهة فايروس كورونا
            </span>
            <hr>
            <a href="{{route('frontend.posts')}}" class="btn btn-success btn-website">انقر هنا</a>
          </li>
        </div>
        <div class="main-link">
          <li>
            <i class="fas fa-utensils"></i>
            <span class="d-block">
              وصفات غذائية لاتباع حمية صحية
            </span>
            <hr>
            <a href="{{route('frontend.wasfas')}}" class="btn btn-success btn-website">انقر هنا</a>
          </li>
        </div>
        <div class="main-link">
          <li>
            <i class="fas fa-globe-europe"></i>
            <span class="d-block">
              نصائح عامة
            </span>
            <hr>
            <a href="{{route('frontend.wasfas')}}" class="btn btn-success btn-website">انقر هنا</a>
          </li>
        </div>
        <div class="main-link">
          <li>
            <i class="fas fa-user-circle"></i>
            <span class="d-block">
              استفسارت خاصة لمرضى السكر وكبار السن
            </span>
            <hr>
            <a href="{{route('frontend.docotors')}}" class="btn btn-success btn-website">انقر هنا</a>
          </li>
        </div>
      </ul>
    </div>
  </section>
  @if(!\Auth::check() ||\Auth::user()->role=='user')
  <section class="price-sec" id="subscirbe">
  <div class="container">
    <div class="title-sections text-center mb-5"><i class="fas fa-dollar-sign"></i>
      <h3>
      @if($subcribe)
    جدد اشتراكك معنا
    @else
      اشترك معنا

    @endif
    </h3>
    </div>
    <div class='pricing pricing-palden'>


@foreach ($services as $service)
@php if($service->price==0 && $issubcribe){
   continue;
  }
@endphp
<div class="pricing-item" style="margin-right:5px;margin-left:5px">
        <div class="pricing-deco">
          <svg class="pricing-deco-img" enable-background="new 0 0 300 100" height="100px" id="Layer_1" preserveAspectRatio="none" version="1.1" viewBox="0 0 300 100" width="300px" x="0px" xml:space="preserve" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" y="0px">
            <path class="deco-layer deco-layer--1" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729&#x000A;	c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" fill="#FFFFFF" opacity="0.6"></path>
            <path class="deco-layer deco-layer--2" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729&#x000A;	c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" fill="#FFFFFF" opacity="0.6"></path>
            <path class="deco-layer deco-layer--3" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716&#x000A;	H42.401L43.415,98.342z" fill="#FFFFFF" opacity="0.7"></path>
            <path class="deco-layer deco-layer--4" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428&#x000A;	c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" fill="#FFFFFF"></path>
          </svg>
          <div class="pricing-price"><span class="pricing-currency">$</span>{{$service->price}}

          </div>
          <h3 class="pricing-title">{{$service->name}}</h3>
        </div>
        <ul class="pricing-feature-list">

        @php
        $ds=explode(',',$service->benefits);
        @endphp
        <li class="pricing-feature"><i class="fas fa-check"></i> عدد استشارات:{{$service->consulted}}</li>

        @for($i=0;$i < count($ds);$i++)
          <li class="pricing-feature"><i class="fas fa-check"></i>{{$ds[$i]}}</li>

@endfor
        </ul>
        <a class="pricing-action" href="{{route('frontend.subscribes',$service->name)}}">اشترك</a>
      </div>
@endforeach
    </div>
</div>
</section>
@endif
<section class="serarch-sec section" style="background: url({{asset('frontend/images/bg-search2.jpg')}})no-repeat center center  fixed;">
    <div class="overlay">
      <!-- Start Form Search  -->
      <form>
        <div class="input-group input-search-sec">
          <div class="input-group-append">
            <button type="submit" class="btn btn-success btn-website">ابحث معنا</button>
          </div>
          <input type="text" class="form-control" placeholder="ابحث عن الوجبات التي تناولتها">

        </div>
      </form>
      <!-- End Form Search  -->
    </div>
  </section>
  <section class="section our-team bg-gray" id="team">
    <div class="container">
      <div class="title-sections text-center mb-5">
        <i class="fas fa-building"></i>
        <h3>فريق العمل</h3>
      </div>
      <div class="row text-center our-team">
@foreach ($users as $user)
<div class="col-lg-3 col-md-6 col-xs-12 our-team-item">
          <div class="our-team-image">
            <div class="overlay"></div>
            <img src="{{asset('assets/users/'.$user->image)}}">

          </div>

          <div class="content-team">

          <h4 class="title"><a href="#">{{$user->name}}</a></h4>
            <div class="regency">@if($user->role=='docotor') دكتور تغذية  @else  مدير @endif</div>
           @if($user->role=='docotor')   <button class="btn mt-3 btn-success btn-website">اشتراك</button>
  @endif  </div>
        </div>
@endforeach
        <!-- Start Coloumn - 3 -->

        <!-- End Coloumn - 3 -->
        <!-- Start Coloumn - 3 -->

        <!-- End Coloumn - 3 -->
      </div>
    </div>
  </section>
  <!-- End Our Team -->
  <!-- Start App Fit Free -->
  <section class="mobile-sec section text-center" style="background: url({{asset('frontend/images/bg-mobile.jpg')}})no-repeat   fixed;">
    <div class="overlay">
      <div class="content-m-app">
        <i class="fas fa-mobile-alt main-icon"></i>
        <h3 class="mt-3 mb-3">تطبيق Fit Free</h3>
        <p class="mt-3 mb-3">"هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص
          العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة</p>
        <div class="download-btns">
          <a href="#" class="btn btn-success btn-website"> <i class="fab fa-google-play"></i> جوجل بلاي</a>
          <a href="#" class="btn btn-success btn-website"> <i class="fab fa-apple"></i> اب ستور</a>
        </div>
      </div>
    </div>
  </section>

@include('sweetalert::alert')
@endsection
