@extends('layouts.front.app')
@section('content')

    <div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
              <li class="breadcrumb-item"><a href="javascript:void(0)">{{$user->name}}</a></li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
    
          <div class="row gutters-sm">
            <div class="col-md-3 mb-2">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="{{asset('assets/users/'.$user->image)}}" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4>{{$user->name}}</h4>
                      <p class="text-secondary mb-1"> حالة الصحية:
                 <br>     <span class="  fa-2x                    @if($user->profile->bmivalue == 'طبيعي')   text-success @else text-danger @endif">{{$user->profile->bmivalue}}</span></p>
                    
                      <p class="text-muted font-size-sm">السعرات التي تحتاجها يوميا هي:
                      <span class="text-primary fa-2x"> 
                      
                      {{$user->profile->calories}}</span></p>
                      <button class="btn btn-outline-primary">تواصل مع طبيب</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <div class="card mb-3">
                <div class="card-body">
                    <form method="POST" action="{{route('user.calccloulors')}}" >
                  
                    @csrf
                    <div class="row">
                    <div class="col-sm-2">
                      <h6 class="mb-0">طول</h6>
                    </div>
                    <div class="col-sm-2 text-secondary">
                      <input type="number" name="length" id="length" value="{{$user->profile->length}}"  style="width:90px;">
                    </div>
                    <div class="col-sm-2">
                      <h6 class="mb-0">عمر</h6>
                    </div>
                    <div class="col-sm-2 text-secondary">
                      <input type="number" name="age" id="age" value="{{$user->profile->age}}"  style="width:90px;">
                    </div>
                    <div class="col-sm-2">
                      <h6 class="mb-0">وزن</h6>
                    </div>
                    <div class="col-sm-2 text-secondary">
                      <input type="number" name="weight" id="weight" value="{{$user->profile->weight}}"  style="width:90px;">
                    </div>
                  </div>
                 <hr>

                  <div class="row">
                   
                    <div class="col-sm-3">
                      <h6 class="mb-0">نشاط</h6>
                    </div>
                    <div class="col-sm-2 text-secondary">

                    <select name="activity" class="form-control" style="width:150px">
                 
                        <option value="1.2"
                        @php
                        
                        if($user->profile->activity==1.2){
                        echo 'selected';
                      }
                        @endphp
                        >خامل غير نشيط</option>
                        <option value="1.3" @php
                        
                        if($user->profile->activity==1.3){
                        echo 'selected';
                      }
                        @endphp>خامل (مكتبي) </option>
                        <option value="1.4" @php
                        
                        if($user->profile->activity==1.4){
                        echo 'selected';
                      }
                        @endphp>قليل نشاط</option>
                        <option value="1.6" @php
                        
                        if($user->profile->activity==1.6){
                        echo 'selected';
                      }
                        @endphp>متوسط نشاط</option>
                        <option value="1.8" @php
                        
                        if($user->profile->activity==1.8){
                        echo 'selected';
                      }
                        @endphp>قوي نشاط</option>
                        </select>                  </div>
                        
                    <div class="col-sm-2">
                      <h6 class="mb-0">الهدف</h6>
                    </div>
                    <div class="col-sm-2 text-secondary">
                    <select name="aims" class="form-control" style="width:150px">
                 
                 <option value="زيادة"
                 @php
                 
                 if($user->profile->aims=="زيادة"){
                 echo 'selected';
               }
                 @endphp
                 >زياده وزن</option>
                 <option value="نقصان"
                 @php
                 
                 if($user->profile->aims=="نقصان"){
                 echo 'selected';
               }
                 @endphp
                 >نقصان وزن</option>


              </select>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">امراض التي تعاني منها</h6>
                    </div>
                    <div class="col-sm-2 text-secondary">
<textarea class="form-control" cols="8" rows="5" class="diseasesName" style="width:220px">{{$user->profile->diseasesName}}</textarea>
                  </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">ملاحظات</h6>
                    </div>
                    <div class="col-sm-2 text-secondary">
<textarea class="form-control" cols="4" name="notes"  style="width:220px">{{$user->profile->notes	}}</textarea>
                  </div>
                  </div>
                  <hr>
<button class="btn btn-primary">حساب سعرات </button>
                </div>
</form>

              </div>
            </div>
          </div>

        </div>
    </div>
@endsection