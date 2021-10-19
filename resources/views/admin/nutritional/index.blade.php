@extends('layouts.master')
@section('css')
@section('title') 
حاسبة الوجبات الغذائية
@stop
@endsection
@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
              حاسبة السعرات الغذائية</span>
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
                            data-toggle="modal" href="#modaldemo8">اضافة وجبة الغذائية</a>

                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم الوجبة</th>
                                <th class="border-bottom-0">قيمة</th>
                                <th class="border-bottom-0">طبيب</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $x)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{ $x->name }}</td>
                                    <td>{{ $x->value }}</td>
                                    <td>{{ $x->user->name }}</td>
                                    <td>
                                            <a class="modal-effect btn btn-sm btn-info"
                                                data-id="{{ $x->id }}"
                                             data-toggle="modal" id="showModelNutr"
                                             href="javascript:void(0)"       title="عرض"><i class="fas fa-eye"></i></a>
                                             @if(auth()->user()->role=='admin'  || auth()->id()==$x->user_id)
                                            <a class="modal-effect btn btn-sm btn-info"
                                                data-id="{{ $x->id }}"
                                             data-toggle="modal" id="showEditModelCategory"
                                             href="javascript:void(0)"       title="تعديل"><i class="las la-pen"></i></a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-name="{{ $x->name }}"
                                                data-toggle="modal" href="#deleteCoateoryModel" title="حذف"><i
                                                    class="las la-trash"></i></a>@endif

                                    </td>
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


    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">sadads قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.nutrs.store')}}" method="post">
                   @csrf

                        <div class="form-group">
                            <div class="container">
                                <div class="row">
                            <div class="col-md-6">
                            <label for="exampleInputEmail1">اسم الوجبة</label>
                            <input type="text" class="form-control" id="" name="name"></div>
                            <div class="col-md-6">
                            <label for="exampleInputEmail1">القيمة</label>
                            <input type="number" class="form-control" id="" name="value"></div>


                        </div>
                                <hr>
                                <table class="table" id="invoice_details">
<thead>
<tr>
  <th>#</th>
  <th>اسم</th>
  <th>قيمة</th>
</tr>
</thead>
<tbody>
<tr class="cloning_row" id="0">
<td>#</td>
<td>
	<input type="text" name="element[0]" id="element" class="name form-control">
@error('name')
<span class="text-danger help-block">{{$message}} </span>
@enderror
</td>
<td>
	<input type="number" name="element_value[0]" id="element_value" class="element_value form-control">
@error('element_value')
<span class="text-danger help-block">{{$message}} </span>
@enderror
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
<!-- edit model -->

<div class="modal" id="editmodelNutrl">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.nutrs.store')}}" method="post">
                   @csrf

                        <div class="form-group">
                            <div class="container">
                                <div class="row">
                            <div class="col-md-6">
                            <label for="exampleInputEmail1">اسم الوجبة</label>
                            <input type="text" class="form-control" id="" name="name"></div>
                            <div class="col-md-6">
                            <label for="exampleInputEmail1">القيمة</label>
                            <input type="number" class="form-control" id="" name="value"></div>


                        </div>
                                <hr>
                                <table class="table" id="invoice_details">
<thead>
<tr>
  <th>#</th>
  <th>اسم</th>
  <th>قيمة</th>
</tr>
</thead>
<tbody>
<tr class="cloning_row" id="0">
<td>#</td>
<td>
	<input type="text" name="element[0]" id="element" class="name form-control">
@error('name')
<span class="text-danger help-block">{{$message}} </span>
@enderror
</td>
<td>
	<input type="number" name="element_value[0]" id="element_value" class="element_value form-control">
@error('element_value')
<span class="text-danger help-block">{{$message}} </span>
@enderror
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
    </div>


<!-- showElementModel -->
<div class="modal" id="showElementModel">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

<table class="table key-buttons text-md-nowrap" id="element_details">
<thead>
<tr>
  <td>رقم</td>
  <td>اسم</td>
  <td>كميه</td>
</tr>
</thead>
<tbody>



</tbody>

</table>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->


    </div>

    


     <div class="modal" id="deleteCoateoryModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.nutrs.delete')}}" method="POST">

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




    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->

<script>

$('#deleteCoateoryModel').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
    })
</script>
<script>
/**show */
$('body').on('click', '#showModelNutr', function () {
var nutr_val = $(this).data('id');
$.get('/admin/nutrs/edit/'+nutr_val, function (data) {
$('#showElementModel').modal('show');
data.forEach(function(el){
$('#element_details').find('tbody').append($(''+
    '<tr>'+
    '<td>'+el['id']+'</td>'+
    '<td>'+el['element']+'</td>'+
    '<td>'+el['element_value']+'</td>'+
    '<tr>'
    ));});
});

});
//لما يروح الضغط عن اضهار العناصر
$('#showElementModel').on('hidden.bs.modal', function (event) {

$('#element_details').find('tbody tr').remove();
})
//edit
$('body').on('click', '#showEditModelCategory', function () {
var nutr_val = $(this).data('id');
$.get('/admin/nutrs/edit/'+nutr_val, function (data) {
$('#editmodelNutrl').modal('show');


    
let trCount=$("#invoice_details").find('tr.cloning_row:last').length;
let numberIncr=trCount>0 ?parseInt($("#invoice_details").find('tr.cloning_row:last').attr('id'))+1:0;

data.forEach(function(el){
$("#invoice_details").find('tbody').append($('' +
            `<tr class="cloning_row" id="${numberIncr}">
            <td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>
            <td><input type="text" value="${el['element']}" name="element[${numberIncr}]" class="element form-control"></td>
            <td><input type="number"  value="${el['element_value']}" name="element_value[${numberIncr}]"  class="element_value form-control"></td>
            </tr>`)
            )
            console.log(el);



});

});});
//لما يروح الضغط عن اضهار العناصر
$('#showElementModel').on('hidden.bs.modal', function (event) {

$('#element_details').find('tbody tr').remove();
})






$(document).on('click','.btn_add',function(){
let trCount=$("#invoice_details").find('tr.cloning_row:last').length;
let numberIncr=trCount>0 ?parseInt($("#invoice_details").find('tr.cloning_row:last').attr('id'))+1:0;
$("#invoice_details").find('tbody').append($('' +
            '<tr class="cloning_row" id="' + numberIncr + '">' +
            '<td><button type="button" class="btn btn-danger btn-sm delegated-btn"><i class="fa fa-minus"></i></button></td>' +
            '<td><input type="text" name="element[' + numberIncr + ']" class="element form-control"></td>' +
            '<td><input type="number" name="element_value[' + numberIncr + ']"  class="element_value form-control"></td>' +
            '</tr>'))
});












// حذف
$(document).on('click','.delegated-btn',function(ee){
ee.preventDefault();
$(this).parent().parent().remove()});
</script>
@include('sweetalert::alert')
@endsection
