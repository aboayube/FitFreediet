@extends('layouts.master')
@section('css')

@section('title')
    المستخدمين
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                المستخدمين</span>
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
                                <th class="border-bottom-0">اسم </th>
                                <th class="border-bottom-0">صورة الشخصية</th>
                                <th>الحالة</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $x)

                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{ $x->name }}</td>
                                    <td>
                                    @if ($x->image)
                                    <img src="{{asset($x->image) }}" width="50px" height="50px">

                                    @else

                                    <i class="fas fa-user fa-2x "></i>
                                    @endif
                                    </td>
                                    <td>
@if ($x->status==1)
مفعل
    @else
    غير مفعل
@endif

                                    </td>
                                    <td>
                                            <a class="modal-effect btn btn-sm btn-info"
                                                data-id="{{ $x->id }}"
                                             data-toggle="modal" id="showEditModelCategory"
                                             href="javascript:void(0)"       title="show"><i class="las la-eye"></i></a>

                                             <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-name="{{ $x->name }}"
                                                data-toggle="modal" href="#deleteCoateoryModel" title="حذف"><i
                                                    class="las la-trash"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{$users->links()}}
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- edit -->

    <div class="modal fade" id="categoryEditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
<h1 class="text-center">بيانات المريض</h1>
<p>وزن :<span id="weight"></span></p>
<p>طول :<span id="length"></span></p>
<p>جنس :<span id="gender"></span></p>
<p>نشاط :<span id="activity"></span></p>
<p>عمر :<span id="age"></span></p>
<p>اهداف :<span id="aims"></span></p>
<p>امراض التي يعاني منها :<span id="diseasesName"></span></p>
<p>bmi :<span id="bmi"></span></p>
<p>bmivalue :<span id="bmivalue"></span></p>
<p>سعرات الحرارية التي يحتاجها :<span id="calories"></span></p>
<p>هدف الذي يسعي الوصول اليه :<span id="target"></span></p>
<p>ملاحظات :<span id="notes"></span></p>
<p>الادوية التي يتناولها :<span id="medicine"></span></p>
<p>تاريخ الانشاء :<span id="created_at"></span></p>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="deleteCoateoryModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.users.delete')}}" method="POST">

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
$('body').on('click', '#showEditModelCategory', function () {
var cat_id = $(this).data('id');
$.get('/admin/users/edit/'+cat_id, function (data) {

$('#categoryEditModel').modal('show');
$('#weight').text(data.weight);
$('#length').text(data.length);
$('#gender').text(data.gender);
$('#activity').text(data.activity);
$('#age').text(data.age);
$('#aims').text(data.aims);
$('#diseasesName').text(data.diseasesName);
$('#bmi').text(data.bmi);
$('#bmivalue').text(data.bmivalue);
$('#calories').text(data.calories);
$('#target').text(data.target);
$('#medicine').text(data.medicine);
$('#created_at').text(data.created_at);

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
</script>

@endsection
