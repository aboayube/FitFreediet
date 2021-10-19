@extends('layouts.front.app')
@section('content')
<section class="subPageTitle text-right">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
          <li class="breadcrumb-item active" aria-current="page"> المقالات </li>
        </ol>
      </nav>
    </div>
  </section>
  <section class="section maqalat">
    <div class="container">
      <div class="row">
        <!-- Start Card -->
        @foreach ($posts as $post)

        <div class="col-lg-6 col-md-12 mb-4">
          <a href="{{route('frontend.post',$post->title)}}">
            <div class="card text-right">
              <img class="card-img-top" src="{{asset('assets/posts/'.$post->image)}}" height="200px">
              <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{$post->discription}}</p>
                <p class="card-text"><small class="text-muted">{{$post->created_at->diffForHumans()}}</small></p>
              </div>
            </div>
          </a>
        </div>
        <!-- End Card -->
        @endforeach
        <!-- End Card -->
      </div>
    </div>
  </section>
@endsection
