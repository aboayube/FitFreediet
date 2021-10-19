@extends('layouts.master')
@section('css')

@section('title')
    خدمات Fit Free
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                خدمات FitFree</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@if (session()->has('add'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <strong>{{ session()->get('add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session()->has('edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('edit') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<!-- row -->
<div class="row">


    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">

                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">اضافة خدمة</a>

                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم الخدمة</th>
                                <th class="border-bottom-0">عدد استشارات</th>
                                <th class="border-bottom-0">نوع</th>
                                <th class="border-bottom-0">سعر</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($elements as $x)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{ $x->name }}</td>
                                    <td>{{ $x->consulted }}</td>
                                    <td>{{ $x->type }}</td>
                                    <td>{{ $x->price }}</td>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$elements->links()}}</div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">اضافة خدمة</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.services.store')}}" method="post">
                   @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم الخدمة</label>
                            <input type="text" class="form-control" id="" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">عدد استشارات</label>
                            <input type="number" class="form-control" id="" name="consulted">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">مده اشتراك</label>
                            <select name="type" class="form-control" >
    <option value="مجاني">مجاني</option>
    <option value="اسبوع"> اسبوع </option>
    <option value="شهري">شهري</option>
</select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">عدد ايام الخدمة </label>
                            <input type="number" class="form-control" id="" name="day">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">مزايا الخدمة</label>
                            <textarea name="benefits" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">سعر </label>
                            <input type="number" class="form-control" id="" name="price">
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
    <!-- edit -->

    <div class="modal fade" id="categoryEditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل اشتراك</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="{{route('admin.services.update')}}" method="POST" >

                                @csrf
                                <input type="hidden" name="id" id="cat_id" >

                                <div class="form-group">
                            <label for="exampleInputEmail1">اسم الخدمة</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">عدد استشارات</label>
                            <input type="number" class="form-control" id="consulted" name="consulted">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">مده اشتراك</label>
                            <select name="type" class="form-control" id="type" >
    <option value="مجاني">مجاني</option>
    <option value="اسبوع"> اسبوع </option>
    <option value="شهري">شهري</option>
</select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">عدد ايام الخدمة </label>
                            <input type="number" class="form-control" id="day" name="day">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">مزايا الخدمة</label>
                            <textarea name="benefits" class="form-control" id="benefits"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">سعر </label>
                            <input type="number" class="form-control" id="price" name="price">
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



     <div class="modal" id="deleteCoateoryModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> حذف الاشتراك</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.services.delete')}}" method="POST">

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
$.get('/admin/services/edit/'+cat_id, function (data) {
$('#categoryEditModel').modal('show');
$('#cat_id').val(data.id);
$('#name').val(data.name);
$('#consulted').val(data.consulted);
$('#type').val(data.type);
$('#day').val(data.day);
$('#benefits').val(data.benefits);
$('#price').val(data.price);
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
@include('sweetalert::alert')
@endsection
