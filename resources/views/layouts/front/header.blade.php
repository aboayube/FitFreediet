<!doctype html>
<html lang="en" dir="rtl">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="This IS Discription">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{config('app.name')}}</title>

  <!--Css Files -->
  <link href="{{asset('frontend/css/fontawesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/css/brands.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/css/solid.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('frontend/css/price.css')}}">

  <!--FavIcone -->
  <link rel="shortcut icon" href="{{asset('frontend/favicon.ico')}}" type="image/x-icon">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js></script>
        <script src="js/respond.min.js"></script>
  <![endif]-->

</head>

<body>
  <!-- Start Main Header -->
  <header class="all-header" style="background: url({{asset('frontend/images/bg-header.png')}})no-repeat center center fixed;">
    <div class="overlay">
      <section class="top-header">
        <div class="container">
          <ul class="list-unstyled list-inline float-right right-list">
            <li class="list-inline-item"> <a href="{{isset($Setting->facebook)?$Setting->facebook:''}}" target="_blank" class="fb-a"><i class="fab fa-facebook-f"></i></a> </li>
            <li class="list-inline-item"> <a href="{{isset($Setting->facebook)?$Setting->twiter:''}}" target="_blank" class="tw-a"><i class="fab fa-twitter"></i></a> </li>

            <li class="list-inline-item"> <a href="{{isset($Setting->linked_in)?$Setting->linked_i:''}}" target="_blank" class="fb-a"><i class="fab fa-linkedin"></i></a> </li>
            <li class="list-inline-item"> <a href="{{isset($Setting->instagram)?$Setting->instagram:''}}" target="_blank" class="in-a"><i class="fab fa-instagram"></i></a> </li>
          </ul>
          <ul class="list-unstyled list-inline float-left left-list">
            <li class="list-inline-item icon-search"> <a href="#"><i class="fa fa-search"></i></a>
              <!-- <input class="form-control input-search" type="text"> -->
              <div class="popup-header">
                <div class="courses-searching">
                  <input class="thim-s form-control courses-search-input" type="text" value="" name="s" placeholder="ابحث هنا" autocomplete="off">
                  <button type="submit"><i class="fa fa-search"></i></button>
                </div>
                <a class="popup-close"><i class="fas fa-times"></i></a>
              </div>
            </li>
            @auth

            @if(\Auth::user()->role=='admin' || \Auth::user()->role=='docotor')
        <li class="list-inline-item"> <a href="{{route('admin')}}">{{\Auth::user()->name}}</a> </li>
        @else
        <li class="list-inline-item"> <a href="{{route('user.profile')}}">{{\Auth::user()->name}}</a> </li>
        <li class="list-inline-item"> <a href="{{route('user.cloultor')}}">حساب السعرات الحرارية</a> </li>
        @endif

        <li class="list-inline-item"> <a href="{{route('user.conversations.index')}}"><i class="far fa-envelope"></i></a> </li>
           <li class="list-inline-item"> 
            <!-- علامة اشعار -->
            <i class="fa fa-user fa-2x" style="color:green;margin-top:2px"></i>
        </li>





        <li class="list-inline-item"> 
       <form action="{{route('logout')}}" method="POST">   
        @csrf
        <button class="btn btn-primary" >تسجيل الخروج</button> </form></li>

            @else
               <li class="list-inline-item"> <a href="{{route('register')}}">إنشاء حساب</a> </li>
            <li class="list-inline-item li-login"> <a href="#" data-toggle="modal" data-target="#login">تسجيل دخول</a>

            @endauth
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
      </section>
      <section class="main-header">
        <div class="container">
          <!-- Start Navbar -->
          <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('frontend/images/logo-nr.png')}}" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span></span>
              <span></span>
              <span></span>
            </button>
            <div class="collapse navbar-collapse flex-end" id="navbarSupportedContent">
              <ul class="navbar-nav">
                @if(! \Auth::check() || \Auth::user()->role=='user')
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('frontend.docotors')}}"><span class="sr-only">(current)</span>استشارات تغذية اونلاين <span
                      class="hover-link"></span></a>
                </li> 
             
                @endif


                <li class="nav-item active">
                  <a class="nav-link" href="{{route('frontend.wasfas')}}">مطبخ <span class="en-font">Fit Free</span> <span
                      class="hover-link"></span></a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    أقسام الموقع
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">

@foreach ($categories as  $cat)
          
<a class="dropdown-item" href="{{route('frontend.category',$cat->name)}}">{{$cat->name}}</a>

@endforeach

                  </div>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('frontend.nutrvalue')}}">حاسبة القيمة الغذائية <span class="hover-link"></span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('frontend.posts')}}">مقالات<span class="hover-link"></span></a>
                </li>
                @if(! \Auth::check())
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('contact-us')}}">تواصل معنا <span class="hover-link"></span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="{{url('/#subscirbe')}}"><span class="sr-only">(current)</span>  معنا اشتراك <span
                      class="hover-link"></span></a>
                </li>
                @else
                <li class="nav-item active">
                  <a class="nav-link" href="{{url('/#subscirbe')}}"><span class="sr-only">(current)</span>تجديد الاشتراك <span
                      class="hover-link"></span></a>
                </li>
@endif
              </ul>
            </div>
          </nav>
          <div class="clearfix"></div>
          <!-- End Navbar -->
        </div>
      </section>
    </div>
  </header>
