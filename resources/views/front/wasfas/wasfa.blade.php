@extends('layouts.front.app')
@section('content')  

<style>
.wasfa{
    width: 35px;
    z-index: 10;
    background-color: #d8207a;
    color: #fff;
    margin-top: -3px;
    margin-right: -4px;
    border: 2px solid #FFF;
    height: 29px;
    border-radius: 50%;
    text-align: center;
    position: absolute;
}

</style>


<section class="subPageTitle text-right">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('index')}}">الرئيسية</a></li>
          <li class="breadcrumb-item active" aria-current="page">  تفاصيل  الوصفة  {{$wasfa->title}}</li>
        </ol>
      </nav>
    </div>
  </section>

  <!-- End Title Sub Pages -->
  <!-- Start Terms Section  -->
  <section class="section page-details ">
    <div class="container">
      <div class="row text-right">
        <!-- Start Card -->
        <div class="col-lg-8 col-md-12 col-sm-12 mb-4">
          <div class="right-info">
            <h1 class="title-n text-center" >{{$wasfa->title}}</h1>
            <img class="p-n-img" src="{{asset('assets/wasfas/'.$wasfa->image)}}">
            <!-- Start Video -->
            <!-- <iframe src="https://www.youtube.com/embed/uSYF37zDhiE" frameborder="0" width="100%" height="300"></iframe> -->
            <!-- End Video -->
            <ul class="info-person-n list-inline">
              <li class="list-inline-item"> <i class="fas fa-calendar-day"></i> تاريخ النشر :{{$wasfa->created_at}} </li>
              <li class="list-inline-item"> <i class="fas fa-clock"></i> ساعه النشر : 06:30 مساءا</li>
            </ul>
            <p class="desc-n">
                {!!$wasfa->content!!}
        </p>
          </div>
          <hr>
          <div class="comments-user">
            <h2>اضف تعليقك </h2>

            <form>
              <div class="row">
                <div class="col-lg-6 col-md-12">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="الاسم الخاص بك">
                  </div>
                </div>
                <div class="col-lg-6 col-md-12">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="العنوان الخاص بك">
                  </div>
                </div>
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <textarea name="" class="form-control" placeholder="التعليق الخاص بك"></textarea>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12">
                  <div class="form-group">
                    <input type="submit" class="form-control btn btn-succes btn-website" value="اكتب تعليقك">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- End Card -->
        <!-- Start Card -->
        <div class="col-lg-4 col-md-12  mb-4">
<div class="container">
    <h1>مقالات FitFree</h1>
    <hr>
  <div class="row ">
    <div class=" wasfa">1</div>
    <img src="{{ asset('assets/posts/asdasdasdasd-1628942902.jpg')}}" width="100px" height="100px">    

    <div class="col-md-8">

<h2>dasadsdasad</h2>
<p>Lorem ipsum dolor sit amet coommodi s doloremque!</p>
</div>  
<div class="">
    <div class=" wasfa">2</div>
    <img src="{{ asset('assets/posts/asdasdasdasd-1628942902.jpg')}}" width="100px" height="100px">    
    </div>
    <div class="col-md-8">

<h2>dasadsdasad</h2>
<p>Lorem ipsum dolor sit amet coommodi s doloremque!</p>
</div>     <div class="">
    <div class=" wasfa">3</div>
    <img src="{{ asset('assets/posts/asdasdasdasd-1628942902.jpg')}}" width="100px" height="100px">    
    </div>
    <div class="col-md-8">

<h2>dasadsdasad</h2>
<p>Lorem ipsum dolor sit amet coommodi s doloremque!</p>
</div> 
   <div class="">
    <div class=" wasfa">4</div>
    <img src="{{ asset('assets/posts/asdasdasdasd-1628942902.jpg')}}" width="100px" height="100px">    
    </div>
    <div class="col-md-8">

<h2>dasadsdasad</h2>
<p>Lorem ipsum dolor sit amet coommodi s doloremque!</p>
</div>   
    </div>
    <hr>
    <h2>روابط تهمك</h2>
  <div class="tags" style="margin-top:15px">
  <i class="fas fa-arrow-left"></i><span style="margin-right:5px;font-size:16px;">123</span>
  </div> <div class="tags" style="margin-top:15px">
  <i class="fas fa-arrow-left"></i><span style="margin-right:5px;font-size:16px;">123</span>
  </div> <div class="tags" style="margin-top:15px">
  <i class="fas fa-arrow-left"></i><span style="margin-right:5px;font-size:16px;">123</span>
  </div> <div class="tags" style="margin-top:15px">
  <i class="fas fa-arrow-left"></i><span style="margin-right:5px;font-size:16px;">123</span>
  </div>
  </div>
</div>
        


      </div>
      <!-- End Card -->
    </div>
    </div>
  </section>
  <!-- End Terms Section  -->
  <!-- Start Terms Section  -->
  <section class="maqalat">
    <div class="container">
      <h4 class="text-right text-muted mb-3">وصفات أخرى يمكنك مشاهدتها</h4>
      <div class="row">
        <!-- Start Card -->
      @foreach ($wasfas as $was)

        <div class="col-lg-6 col-md-12 mb-4">
          <a href="{{route('frontend.wasfa',$was->title)}}">
            <div class="card text-right">
              <img class="card-img-top" height="120" src="{{asset('assets/wasfas/'.$was->image)}}">
              <div class="card-body">
                <h5 class="card-title">{{$was->title}}</h5>
                <p class="card-text">{!!$was->content!!}</p>
                <p class="card-text"><small class="text-muted">تم التحديث {{$was->created_at->diffForHumans()}}</small></p>
              </div>
            </div>
          </a>
        </div>
      @endforeach
        <!-- End Card -->


        <!-- End Card -->

      </div>
    </div>
  </section>
@endsection
