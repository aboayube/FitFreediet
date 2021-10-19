@extends('layouts.master')
@section('css')

@section('title')

@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                مواعيد الطبيب</span>
        </div>
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
                                @if(\Auth::user()->role=='admin')
                                <th class="border-bottom-0">اسم الطبيب</th>
                                @endif
                                <th class="border-bottom-0">يوم</th>
                                <th class="border-bottom-0">من ساعة</th>
                                <th class="border-bottom-0">الي ساعة</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $x)

                                <tr>

                                    <td>{{$loop->iteration }}</td>
                                    <td>{{ $x->user_name   }}</td>
                                @if(\Auth::user()->role=='admin')
                                    <td>{{ $x->docotor->name }}</td>
                                    @endif
                                    <td>{{ $x->day }}</td>
                                    <td>{{ $x->from_hour }}</td>
                                    <td>{{ $x->to_hour }}</td>

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
