@extends('layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/morris.js/morris.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex"><h4 class="content-title mb-0 my-auto">Apps</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Cards</span></div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<div class="container">
				<div class="row  " style="margin-top:50px">
				<div class="col-xl-3 col-lg-3 col-md-13 col-xm-12 text-center">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">

									<h6 class="mb-3 text-white text-center " style="font-size:18px">عدد المستخدمين</h6>

								<div class="pb-0 mt-0">
									<div class="d-flex" style="    justify-content: center;">

											<h4 class="tx-20 font-weight-bold mb-1 text-white"><i class="fa fa-user fa-2x" aria-hidden="true"></i> <span style="

  margin-right: 30px;
    font-size: 36px;
    color: white;
">{{--$users--}}</span>  </h4>
									</div>
								</div>
							</div>
							</div>
					</div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-xm-12 text-center">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">

									<h6 class="mb-3 text-white text-center " style="font-size:18px">عدد المقالات</h6>

								<div class="pb-0 mt-0">
									<div class="d-flex" style="    justify-content: center;">

											<h4 class="tx-20 font-weight-bold mb-1 text-white"><i class="fas fa-newspaper fa-2x"></i><span style="
margin-right: 30px;
    font-size: 36px;
    color: white;
">{{--$posts--}}</span>  </h4>
									</div>
								</div>
							</div>
							</div>
					</div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-xm-12 text-center">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">

									<h6 class="mb-3 text-white text-center " style="font-size:18px">عدد الوصفات</h6>

								<div class="pb-0 mt-0">
									<div class="d-flex" style="    justify-content: center;">

											<h4 class="tx-20 font-weight-bold mb-1 text-white"><i class="fas fa-hamburger fa-2x"></i> <span style="
   margin-right: 30px;
    font-size: 36px;
    color: white;
">{{--$wasfa--}}</span>  </h4>
									</div>
								</div>
							</div>
							</div>
					</div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-xm-12 text-center">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">

									<h6 class="mb-3 text-white text-center " style="font-size:18px">عدد قيم الغذائية</h6>

								<div class="pb-0 mt-0">
									<div class="d-flex" style="    justify-content: center;">

											<h4 class="tx-20 font-weight-bold mb-1 text-white"><i class="fas fa-calculator fa-2x"></i> <span style="
       margin-right: 30px;
    font-size: 36px;
    color: white;
">{{--$nutrvalue--}}</span>  </h4>
									</div>
								</div>
							</div>
							</div>
					</div>
				</div>

				</div>
                <div class="row  " style="margin-top:30px">
				<div class="col-xl-3 col-lg-3 col-md-13 col-xm-12 text-center">
						<div class="card overflow-hidden sales-card bg-success-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">

									<h6 class="mb-3 text-white text-center " style="font-size:18px">عدد  اطباء</h6>

								<div class="pb-0 mt-0">
									<div class="d-flex" style="    justify-content: center;">

											<h4 class="tx-20 font-weight-bold mb-1 text-white"><i class="fas fa-user-md fa-2x"></i><span style="

  margin-right: 30px;
    font-size: 36px;
    color: white;
">{{--$users--}}</span>  </h4>
									</div>
								</div>
							</div>
							</div>
					</div>

                    <div class="col-xl-3 col-lg-3 col-md-12 col-xm-12 text-center">
						<div class="card overflow-hidden sales-card bg-danger-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">

									<h6 class="mb-3 text-white text-center " style="font-size:18px">عدد مواعيد محجوزة</h6>

								<div class="pb-0 mt-0">
									<div class="d-flex" style="    justify-content: center;">

											<h4 class="tx-20 font-weight-bold mb-1 text-white"><i class="fas fa-calendar-week fa-2x"></i> <span style="
       margin-right: 30px;
    font-size: 36px;
    color: white;
">{{--$nutrvalue--}}</span>  </h4>
									</div>
								</div>
							</div>
							</div>
					</div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-xm-12 text-center">
						<div class="card overflow-hidden sales-card bg-primary-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">

									<h6 class="mb-3 text-white text-center " style="font-size:18px">عدد اقسام</h6>

								<div class="pb-0 mt-0">
									<div class="d-flex" style="    justify-content: center;">

											<h4 class="tx-20 font-weight-bold mb-1 text-white"><i class="fas fa-tags fa-2x"></i> <span style="
margin-right: 30px;
    font-size: 36px;
    color: white;
">{{--$category--}}</span>  </h4>
									</div>
								</div>
							</div>
							</div>
					</div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-xm-12 text-center">
						<div class="card overflow-hidden sales-card bg-warning-gradient">
							<div class="pl-3 pt-3 pr-3 pb-2 pt-0">

									<h6 class="mb-3 text-white text-center " style="font-size:18px">عدد التصنيفات</h6>

								<div class="pb-0 mt-0">
									<div class="d-flex" style="    justify-content: center;">

											<h4 class="tx-20 font-weight-bold mb-1 text-white"><i class="fas fa-hashtag fa-2x"></i> <span style="
   margin-right: 30px;
    font-size: 36px;
    color: white;
">{{--$tags--}}</span>  </h4>
									</div>
								</div>
							</div>
							</div>
					</div>
				</div>

				</div>

				</div>

				</div>


				<!-- row closed -->
			</div>
				</div>

				</div>


				<!-- row closed -->
			</div>






            </div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
