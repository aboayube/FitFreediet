<style>

.header-icon-svgs {
    width: 35px !important;
    height: 45px !important;
    color: #5b6e88 !important;
}
</style>
<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="{{ route('admin') }}"><img src="{{URL::asset('assets/logo.png')}}" class="logo-1" alt="logo"></a>
							<a href="{{ route('admin') }}"><img src="{{URL::asset('assets/logo.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ route('admin') }}"><img src="{{URL::asset('favicon.png')}}" class="logo-2" alt="logo"></a>
							<a href="{{ route('admin') }}"><img src="{{URL::asset('favicon.png')}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" placeholder="ابحث هنا.." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
						</div>
					</div>
					<div class="main-header-right">
						<ul class="nav">
							<li class="">
							<div class="dropdown  nav-itemd-none d-md-flex">
									<a href="" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown" aria-expanded="false">
										<span class="avatar country-Flag mr-0 align-self-center bg-transparent">
										@if (App::getLocale()=='ar')
										<img src="{{URL::asset('assets/img/flags/arab.png')}}" alt="img"></span>

											@else
											<img src="{{URL::asset('assets/img/flags/us_flag.jpg')}}" alt="img"></span>

										@endif

										<div class="my-auto">
											<strong class="mr-2 ml-2 my-auto">English</strong>
										</div>
									</a>
									<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
										<a href="{{ LaravelLocalization::getLocalizedURL('ar') }}" class="dropdown-item d-flex ">
											<span class="avatar  ml-3 align-self-center bg-transparent">
											<img src="{{URL::asset('assets/img/flags/arab.png')}}" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">لغة عربية</span>
											</div>
										</a>
										<a href="{{ LaravelLocalization::getLocalizedURL('en') }}" class="dropdown-item d-flex">
											<span class="avatar  ml-3 align-self-center bg-transparent"><img src="{{URL::asset('assets/img/flags/us_flag.jpg')}}" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">English</span>
											</div>
										</a>
									</div>
								</div>
							</li>
						</ul>
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form>
							</div>
							<div class="dropdown nav-item main-header-message ">
								<a class="new nav-link" href="#">
									<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
									<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
									<polyline points="22,6 12,13 2,6"></polyline></svg>
									<span style="

height: 22px;
  width:  22px;
  background-color: #d63031;
  border-radius: 20px;
  color: white;
  text-align: center;
  position: absolute;
  top: 23px;
  left: 60px;
  padding: 3px;
  border-style: solid;
  border-width: 2px;
	" >{{ auth()->user()->unreadNotifications->count() }}</span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Messages</h6>
											<span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have {{ auth()->user()->unreadNotifications->count() }} unread messages</p>
									</div>
									<div class="main-message-list chat-scroll">
@php
    $user=\Auth::user();
    $notifications=$user->Notifications;
@endphp
@foreach ($notifications as  $notify)
@if($notify->data['type']=='registerUser'|| $notify->data['type']=='contactus' ||$notify->data['type']=='deparments' || $notify->data['type']=='nutrvalue'
||$notify->data['type']=='subscribeuser'||$notify->data['type']=='subscribeuserDataDocotor'
)
<a href="{{$notify->data['action']}}?notify_id={{$notify->id}}" class="p-3 d-flex border-bottom  " @if($notify->unread()) style="background-color:red"  @endif>
											<div class="  drop-img  cover-image  " data-image-src="{{URL::asset('assets/posts/'.$notify->data['image'])}}">
												<span class="avatar-status bg-teal"></span>
											</div>
											<div class="wd-90p">
												<div class="d-flex">
													<h5 class="mb-1 name">{{$notify->data['message']}}</h5>
												</div>
												<p class="mb-0 desc"> {{$notify->data['message']}} </p>
												<p class="time mb-0 text-left float-right mr-2 mt-2">{{$notify->created_at->diffForHumans()}}</p>
											</div>
										</a>
@elseif($notify->data['type']=='postsCreated' || $notify->data['type']=='wasfaCreated')

<a href="{{$notify->data['action']}}" class="p-3 d-flex border-bottom">
											<div class="  drop-img  cover-image  " data-image-src="{{URL::asset('assets/posts/'.$notify->data['image'])}}">
												<span class="avatar-status bg-teal"></span>
											</div>
											<div class="wd-90p">
												<div class="d-flex">
													<h5 class="mb-1 name">{{$notify->data['message']}}</h5>
												</div>
												<p class="mb-0 desc"> {{$notify->data['msg']}}من قبل {{$notify->data['user-name']}}</p>
												<p class="time mb-0 text-left float-right mr-2 mt-2">{{$notify->created_at->diffForHumans()}}</p>
											</div>
										</a>
@endif
@endforeach

									</div>
									<div class="text-center dropdown-footer">
										<a href="text-center">VIEW ALL</a>
									</div>
								</div>
							</div>
							<div class="dropdown nav-item main-header-notification">
								<a class="new nav-link" href="#">
								<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class=" pulse"></span></a>
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
										<div class="d-flex">
											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
											<span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
										</div>
										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have 4 unread Notifications</p>
									</div>
									<div class="main-notification-list Notification-scroll">
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-pink">
												<i class="la la-file-alt text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">New files available</h5>
												<div class="notification-subtext">10 hour ago</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
										<a class="d-flex p-3" href="#">
											<div class="notifyimg bg-purple">
												<i class="la la-gem text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">Updates Available</h5>
												<div class="notification-subtext">2 days ago</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-success">
												<i class="la la-shopping-basket text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">New Order Received</h5>
												<div class="notification-subtext">1 hour ago</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-warning">
												<i class="la la-envelope-open text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">New review received</h5>
												<div class="notification-subtext">1 day ago</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-danger">
												<i class="la la-user-check text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">22 verified registrations</h5>
												<div class="notification-subtext">2 hour ago</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
										<a class="d-flex p-3 border-bottom" href="#">
											<div class="notifyimg bg-primary">
												<i class="la la-check-circle text-white"></i>
											</div>
											<div class="mr-3">
												<h5 class="notification-label mb-1">Project has been approved</h5>
												<div class="notification-subtext">4 hour ago</div>
											</div>
											<div class="mr-auto" >
												<i class="las la-angle-left text-left text-muted"></i>
											</div>
										</a>
									</div>
									<div class="dropdown-footer">
										<a href="">VIEW ALL</a>
									</div>
								</div>
							</div>
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{URL::asset('assets/users/'.auth()->user()->image)}}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{URL::asset('assets/users/'.auth()->user()->image)}}" class=""></div>
											<div class="mr-3 my-auto">
												<h6>{{\Auth::user()->name}}</h6>
											</div>
										</div>
									</div>
									<a class="dropdown-item" href="{{route('admin.profile')}}"><i class="bx bx-cog"></i> تعديل بيانات</a>
					 <form method="POST" action="{{route('logout')}}">
                                        @csrf
									<button class="dropdown-item" href="{{ route('logout') }}"><i class="bx bx-log-out"></i> logout</button>

</form>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->
