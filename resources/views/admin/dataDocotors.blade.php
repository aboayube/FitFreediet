@extends('layouts.master')
@section('css')

@section('title')
    مواعيد الدكتور 
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
                <div class="d-flex justify-content-between">
                <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">اضافة موعد</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">يوم</th>
                                <th class="border-bottom-0">من ساعة</th>
                                <th class="border-bottom-0">الي ساعة</th>
                                @if(\Auth::user()->role=='admin')
                                <th class="border-bottom-0">الطبيب </th>
                                @endif
                                <th class="border-bottom-0">الحالة </th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $x)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>
@php
if($x->day=='Friday'){
echo 'الجمعه';}
else if($x->day=='Saturday'){
echo 'السبت';}
else if($x->day=='Sunday'){
echo 'الاحد';}
else if($x->day=='Monday'){
echo 'الاثنين';}
else if($x->day=='Tuesday'){
echo 'الثلاثاء';}
else if($x->day=='Wednesday'){
echo 'الاربعاء';}
else if($x->day=='Thursday'){
echo 'الخميس';}   


@endphp

                                    </td>
                                    <td>{{ $x->from_hour }}</td>
                                    <td>{{ $x->to_hour }}</td>
                                @if(\Auth::user()->role=='admin')
                                    <td>{{ $x->docotor->name }}</td> 
                                    @endif
                                    <td>{{ $x->status }}</td>

                                    @if($x->status!='محجوز')
                                    <td>
                                            <a class="modal-effect btn btn-sm btn-info"
                                                data-id="{{ $x->id }}"
                                             data-toggle="modal" id="showEditModelCategory"
                                             href="javascript:void(0)"       title="تعديل"><i class="las la-pen"></i></a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-name="{{ $x->name }}"
                                                data-toggle="modal" href="#deleteCoateoryModel" title="حذف"><i
                                                    class="las la-trash"></i></a>

                                    </td>
                                    @else
                                <td>    لا ينسطيتع عمل اي شي
                                    </td>@endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$data->links()}}
                    <div class="text-center">
                        </div>
                </div>
            </div>
        </div>
    </div>


    <!-- edit -->

    <div class="modal fade " id="categoryEditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('admin.dataDocotors.update')}}" method="POST" >

                                @csrf

                        <div class="form-group">
                            <input type="hidden" name="id" id="cat_id" >
                            <label for="recipient-name" class="col-form-label">يوم</label>
                            <select name="day" class="form-control" id="day">
<option value="Friday">الجمعة</option>
<option value="Saturday">السبت</option>
<option value="Sunday">الأحد</option>
<option value="Monday">الاثنين</option>
<option value="Tuesday">الثلاثاء</option>
<option value="Wednesday">الأربعاء</option>
<option value="Thursday">الخميس</option>
</select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">من الساعة</label>
                            <input type="number" class="form-control" id="from_hour" name="from_hour">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الي الساعة</label>
                            <input type="number" class="form-control" id="to_hour" name="to_hour">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">الحالة</label>
                            <select name="status" class="form-control"  id="status">
<option value="فعال">فعال</option>
<option value="غير فعال">غير فعال</option>

</select>
</div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
                </form>
            </div>
        </div>
    </div>


<!-- delete -->
     <div class="modal" id="deleteCoateoryModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.docotor.delete')}}" method="POST">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="name" id="name" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
            </div>
            </form>
        </div>
    </div>


    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.dataDocotors.store')}}" method="post">
                   @csrf

                        <div class="form-group">
                            <div class="container">
                                <div class="row">

                                <table class="table" id="invoice_details">
<thead>
<tr>
  <th>يوم</th>
  <th>من الساعة</th>
  <th>الي الساعة</th>
  <th>الحالة</th>

@if(\Auth::user()->role=='admin')
<th>طبيب</th>

@endif

</tr>
</thead>
<tbody>
<tr class="cloning_row" id="0">
<td>  <select name="day[0]" id="day"  class="form-control" id="day">
<option value="Friday">الجمعة</option>
<option value="Saturday">السبت</option>
<option value="Sunday">الأحد</option>
<option value="Monday">الاثنين</option>
<option value="Tuesday">الثلاثاء</option>
<option value="Wednesday">الأربعاء</option>
<option value="Thursday">الخميس</option>
</select>
@error('day')
<span class="text-danger help-block">{{$message}} </span>
@enderror
</td>
<td>
	<input type="number" name="from_hour[0]" id="from_hour" class="from_hour form-control" style="width:70px">
@error('from_hour')
<span class="text-danger help-block">{{$message}} </span>
@enderror
</td>
<td>
	<input type="number" name="to_hour[0]" id="to_hour" class="from_hour form-control" style="width:70px">
@error('to_hour')
<span class="text-danger help-block">{{$message}} </span>
@enderror
</td>
<td>

<select name="status[0]" class="form-control"  id="status">
<option value="فعال">فعال</option>
<option value="غير فعال">غير فعال</option>
</select>
@error('status')
<span class="text-danger help-block">{{$message}} </span>
@enderror
</td>

<td>

@if(\Auth::user()->role=='admin')

<select name="user_id[0]" class="form-control"  id="user_id">

@foreach($users as $docotor)
<option value="{{$docotor->id}}">{{$docotor->name}}</option>
@endforeach
</select>

@endif
</td>
<td colspan="6">
<button type="button" class="btn_add btn btn-primary">+</button>
  </td>
</tr>
</tbody>
</table>
                         </div>

</div>
</div>




                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->


    </div>

    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->

<script>
    $('body').on('click', '#showModelCalenderDocotor', function () {
var cat_id = $(this).data('id');
    console.log(cat_id);
$('#showElementModel').modal('show');



});




$('body').on('click', '#showEditModelCategory', function () {
var cat_id = $(this).data('id');
$.get('/admin/dataDocotors/edit/'+cat_id, function (data) {
$('#categoryEditModel').modal('show');

console.log(data.from_hour);
$('#cat_id').val(data.id);
$('#from_hour').val(data.from_hour);
$('#to_hour').val(data.to_hour);

$(`#day option[value='${data.day}']`).prop('selected', true);

$(`#status option[value='${data.status}']`).prop('selected', true);





})
});
$('#deleteCoateoryModel').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })


$(document).on('click','.btn_add',function(){
let trCount=$("#invoice_details").find('tr.cloning_row:last').length;
let numberIncr=trCount>0 ?parseInt($("#invoice_details").find('tr.cloning_row:last').attr('id'))+1:0;
$("#invoice_details").find('tbody').append($('' +
            '<tr class="cloning_row" id="' + numberIncr + '">' +
           
            `<td><select  name="day[${numberIncr}]" class="day form-control"  id="day">
            <option value="Friday">الجمعة</option>
<option value="Saturday">السبت</option>
<option value="Sunday">الأحد</option>
<option value="Monday">الاثنين</option>
<option value="Tuesday">الثلاثاء</option>
<option value="Wednesday">الأربعاء</option>
<option value="Thursday">الخميس</option>

            </select>
            </td>` +
            '<td><input type="number" name="from_hour[' + numberIncr + ']"  class="from_hour form-control" style="width:70px"></td>' +
            '<td><input type="number" name="to_hour[' + numberIncr + ']"  class="to_hour form-control" style="width:70px"></td>' +
           ` <td><select  name="status[${numberIncr}]"  class="status form-control">
           <option value="فعال">فعال</option>
<option value="غير فعال">غير فعال</option>

           </select></td>`
             +
             @if(\Auth::user()->role=='admin')
             ` <td><select  name="user_id[${numberIncr}]"  class="user_id form-control">

@foreach($users as $docotor)
<option value="{{$docotor->id}}">{{$docotor->name}}</option>
@endforeach
           </select></td>`
@endif

             +
             '<td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
             '</tr>'))

});

$(document).on('click','.delegated-btn',function(ee){
ee.preventDefault();
$(this).parent().parent().remove()});
</script>
@include('sweetalert::alert')
@endsection
