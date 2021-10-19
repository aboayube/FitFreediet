@extends('layouts.master')
@section('css')

@section('title')

@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
      
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم المستخدم</th>
                                <th class="border-bottom-0">نوع الحجز</th>
                                <th class="border-bottom-0">حالة  </th>
                                <th class="border-bottom-0">متي يخلص الحجز</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($subs as $x)

                                <tr>

                                    <td>{{$loop->iteration }}</td>
                                    <td>{{$x->user->name }}</td>
                                    <td>{{ $x->service->name   }}</td>
                                    <td>{{ $x->status_pay  }}</td>
                                    <td>{{ $x->end_at->diffForHumans();  }}</td>
                                    

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- edit -->









    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->


@endsection
