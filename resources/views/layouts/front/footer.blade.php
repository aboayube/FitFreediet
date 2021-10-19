 <!-- Start Footer Section  -->
 <section class="main-footer section">
    <div class="container">
      <!-- Start Gride System -->
      <div class="row">
        <div class="col-lg-3">
          <div class="info-1-box">
            <div class="info-1-box-i mb-2">
              <img class="logo-footer" src="{{asset('frontend/images/logo-nr.png')}}" alt="">
            </div>
            <p>
              @if($Setting)
            {{$Setting->discription}}

              @endif
            </p>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="info-2-box">
            <ul class="list-unstyled">
              <li><a href="{{route('index')}}">الرئيسية</a></li>
              <li><a href="#team">من نحن</a></li>
              <li><a href="{{route('frontend.police')}}">سياسة الخصوصية</a></li>
              <li><a href="{{route('contact-us')}}">إتصل بنا</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2">
            <h5 style="color:white">أقسام</h5>
          <div class="info-2-box">
            <ul class="list-unstyled">

@foreach ($categories as  $cat)
                    <a  href="{{route('frontend.category',$cat->name)}}">{{$cat->name}}</a>

@endforeach
            </ul>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="info-3-box">
            <div class="one mb-3">
              <i class="fas fa-map-marked-alt"></i>
              <h4>فلسطين - غزة - خانيونس المعسكر</h4>
            </div>
            <div class="one mb-3">
              <i class="fas fa-mobile"></i>
              <h4>@if(isset($Setting)){$Setting->whatsapp}@endif</h4>
            </div>
            <div class="one mb-3">
              <i class="fas fa-envelope-square"></i>
              <h4>@if(isset($Setting)){$Setting->email}@endif</h4>
            </div>
          </div>
        </div>
      </div>
      <!-- End Gride System -->
    </div>
  </section>
  <!-- End Footer Section  -->
  <!-- End Footer Section  -->
  <!-- Start Footer -->
  <section class="footer-s text-center text-muted">
    <div class="container">
      جميع حقوق النشر محفوظة &copy; 2021
    </div>
  </section>
  <!-- End Footer -->
  <!-- Start ScrolToTop Button -->
  <a class="scrollToTop" href="#">
    <i class="fa fa-chevron-up"></i>
  </a>
  <!-- End ScrolToTop Button -->

  <!-- Start Modals Page -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> <i class="fas fa-sign-in-alt icon-login"></i> تسجيل دخول</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>

        <div class="modal-body text-right">
          <!-- <img src="images/logo-nr.png" alt="" width="150"> -->
          <form method="POST" action="{{route('login')}}" id="registerForm">
              @csrf
            <div class="form-group">
              <label for="email">الإسم / البريد الإلكتروني:</label>
              <input type="email" name="email" class="form-control" placeholder="الإسم / البريد الإلكتروني:" id="email">
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
            </div>
            <div class="form-group">
              <label for="pwd">كلمة المرور:</label>
              <input type="password"  name="password" class="form-control" placeholder="كلمة المرور" id="pwd">
              @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror   </div>

            <button type="submit" class="btn btn-primary btn-website">تسجيل دخول</button>
          </form>
          <br>
          <p class="lead">هل انت مستخدم جديد؟<a href="{{route('register')}}"> سجل معنا</a></p>
        </div>
        <div class="modal-footer text-left">
          <button type="button" class="btn btn-danger " data-dismiss="modal">إغلاق</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Start Modals Page -->


@if(\Auth::check() && \Request::route()->getName()=='index' && \Auth::user()->role=='user')
<div class="modal fade" id="dataUser" tabindex="-1" role="dialog" aria-labelledby="login-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" >  مرحبا بعودتك</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i aria-hidden="true" class="ki ki-close"></i>
          </button>
        </div>

        <div class="modal-body text-right">
          <!-- <img src="images/logo-nr.png" alt="" width="150"> -->
         
          <div class="card-body" width="300px">
            <div class="container">
              <div class="row">
                <div class="col-md-6">  
                    <img src="{{asset('assets/users/'.auth()->user()->image)}}" alt="Admin" width="200" height="240px">
                  </div>
                <div class="col-md-5">  
                    <h4>{{auth()->user()->name}}</h4>
                      <p class="text-secondary mb-1"> حالة الصحية:<br>
                      <span style="
    font-size: 24px;" class="                  @if(auth()->user()->profile->bmivalue == 'طبيعي')   text-success @else text-danger @endif">{{auth()->user()->profile->bmivalue}}</span></p>
                    
                      <p class="text-muted font-size-sm">السعرات التي تحتاجها يوميا هي:
                    <br>  <span style="
    font-size: 24px;" class="text-primary"> 
                      
                      {{auth()->user()->profile->calories}}</span></p>
                      <a class="btn btn-outline-primary" href="{{route('frontend.docotors')}}">تواصل مع طبيب</a>              
</div>
              </div>
            </div>
                
                </div></div>
        <div class="modal-footer text-left">
          <button type="button" class="btn btn-danger " data-dismiss="modal">إغلاق</button>
        </div>
      </div>
    </div>
  </div>


@endif


  <!--JavaScript Files -->
  <script src="{{asset('frontend/js/jquery-3.2.1.js')}}"></script>
  <script src="{{asset('frontend/js/popper.min.js')}}"></script>
  <script defer src="{{asset('frontend/js/brands.min.js')}}"></script>
  <script defer src="{{asset('frontend/js/solid.min.js')}}"></script>
  <script defer src="{{asset('frontend/js/fontawesome.min.js')}}"></script>
  <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('frontend/js/all.min.js')}}"></script>
  <script src="{{asset('frontend/js/myjs.js')}}"></script>
<script>

@if(\Auth::check())
$('#dataUser').modal('show')


@endif


  </script>

  @include('sweetalert::alert')
</body>

</html>
