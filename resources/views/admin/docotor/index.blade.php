@extends('layouts.master')
@section('css')

<link rel="stylesheet" href="{{ asset('frontend/js/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/js/select2/css/select2.min.css') }}">
@section('title')
الاطباء
@stop

@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                الاطباء</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')



@if (session()->has('errors'))
<div class="alert alert-success alert-dismissible fade show  text-center" role="alert">
    <strong>{{ session()->get('errors') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('delete'))
<div class="alert alert-danger alert-dismissible fade show  text-center" role="alert">
    <strong>{{ session()->get('delete') }}</strong>
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
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة الاطباء</a>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">صورة</th>
                                <th class="border-bottom-0">اسم</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">رقم الجوال</th>
                                <th class="border-bottom-0">التخصص</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($elements as $x)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td><img src="{{asset($x->image)}}" width="100" height="100"></td>
                                <td>{{ $x->name }}</td>

                                <td>
                                    @if($x->status)
                                    مفعل
                                    @else
 غير مفعل
                                    @endif
                                </td>
                                <td>{{$x->mobile}}</td>
                                <td>{{$x->specialty}}</td>
                                <td>
                                    <a class="modal-effect btn btn-sm btn-info" data-id="{{ $x->id }}" data-status="{{$x->status}}" data-toggle="modal" id="showEditModelPost" href="javascript:void(0)" title="تعديل"><i class="las la-pen"></i></a>

                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $x->id }}" data-title="{{ $x->name }}" data-toggle="modal" href="#deletePostModel" title="حذف"><i class="las la-trash"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        {{$elements->links()}}
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- اضافة مقاله -->
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> (كلمة السر من 1 الي 6 )اضافة طبيب</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.docotor.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">اسم الطبيب</label>
                            <input type="text" class="form-control" id="" name="name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> ايميل</label>
                            <input type="email" class="form-control" id="" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">جوال</label>
                            <input type="text" class="form-control" name="mobile">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">تخصص</label>
                            <input class="form-control" name="specialty">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">cv</label>
                            <input type="file" name="cv">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">الحالة</label>
                            <select name="status">
                                <option value="0"> غير مفعل</option>
                                <option value="1">مفعل</option>
                            </select>
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
    <div class="modal" id="postEditModel">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">تعديل حالة الطبيب</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.docotor.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="exampleInputEmail1">حاله</label>
                            <select name="status" id="status">
                                <option value="0">غير مفعل</option>
                                <option value="1">مفعل</option>

                            </select>
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

    <!-- delete -->
    <div class="modal" id="deletePostModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.docotor.delete')}}" method="POST">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="id" value="">
                        <input class="form-control" name="title" id="title" type="text" readonly>
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
<script src="{{ asset('frontend/js/summernote/summernote-bs4.min.js') }}"></script>


<script>
    // editor
    $('body').on('click', '#showEditModelPost', function() {
        var cat_id = $(this).data('id');
        var status = $(this).data('status');
        $('#postEditModel').modal('show');      
        $('#id').val(cat_id);
$(`#status option[value='${status}']`).prop('selected', true);
    })
    $('#deletePostModel').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var title = button.data('title')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #title').val(title);
    })
</script>

@include('sweetalert::alert')
@endsection