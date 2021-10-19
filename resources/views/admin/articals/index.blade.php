@extends('layouts.master')
@section('css')

<link rel="stylesheet" href="{{ asset('frontend/js/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/js/select2/css/select2.min.css') }}">
    <style>


</style>
@section('title')
    المقالات
@stop
 
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
            @if($imageName=='wasfas')
                    
                    وصفات
@else 
مقالات

@endif</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
@foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
<div class="row">
  <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                            data-toggle="modal" href="#modaldemo8">اضافة 
                        @if($imageName=='wasfas')
                    
                    وصفة
@else 
مقال

@endif</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">صورة</th>
                                <th class="border-bottom-0">عنوان</th>
                                <th class="border-bottom-0">الكاتب</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">قسم</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($elements as $x)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td><img src="{{asset('assets/'.$imageName.'/'.$x->image)}}" width="100" height="100"></td>
                                    <td>{{ $x->title }}</td>

                                    <td>{{ $x->user->name }}</td>
                                    <td>{{ $x->status ? 'مفعل':'غير مفعل'}}</td>
                                    <td>{{ $x->category->name}}</td>
                                    @if($x->user_id==auth()->id() || auth()->user()->role=='admin')

                                    <td>
                                            <a class="modal-effect btn btn-sm btn-info"
                                                data-id="{{ $x->id }}"
                                             data-toggle="modal" id="showEditModelPost"
                                             href="javascript:void(0)"       title="تعديل"><i class="las la-pen"></i></a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-id="{{ $x->id }}" data-title="{{ $x->title }}"
                                                data-toggle="modal" href="#deletePostModel" title="حذف"><i
                                                    class="las la-trash"></i></a>

                                    </td>
                                    @else
                                    <td>...</td>
                                    @endif
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
                    <h6 class="modal-title">اضافة @if($imageName=='wasfas')وصفة@elseمقالات@endif</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route($store)}}" method="post"  enctype="multipart/form-data">
                   @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">عنوان</label>
                            <input type="text" class="form-control" id="" name="title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> وصف  @if($imageName=='wasfas')
                    
                    وصفة
@else 
مقال

@endif</label>
                            <textarea class="form-control " id="" name="discription"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">محتوي  @if($imageName=='wasfas')
                    
                    وصفة
@else 
مقال

@endif</label>
                            <textarea name="content" class="form-control summernote" id="" ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">القسم</label>
                      <select name="category_id">
                      @foreach ($cats as $cat)
                          <option value="{{$cat->id}}">{{$cat->name}}</option>
                      @endforeach
 </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">تصنيف</label>
                      <select name="tags[]" multiple id="tags">
                      @foreach ($tags as $tag)
                          <option value="{{$tag->id}}">{{$tag->name}}</option>
                      @endforeach
 </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">حاله</label>
                      <select name="status" >
                          <option value="0">غير مفعل</option>
                          <option value="1">مفعل</option>

 </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">تعليقات المستخدمين</label>
                      <select name="comment_able" >
                          <option value="0">غير مفعل</option>
                          <option value="1">مفعل</option>

 </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">صورة مقال</label>
                            <input type="file" name="image">
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
                    <h6 class="modal-title">تعديل مقاله</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route($update)}}" method="post"  enctype="multipart/form-data">
                   @csrf
<input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">عنوان</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> وصف المقالة</label>
                            <textarea class="form-control " id="content" name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">محتوي مقاله</label>
                            <textarea name="discription" class="form-control summernote" id="discription"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">القسم</label>


                              <select name="category_id" id="category_id">
                      @foreach ($cats as $cat)
                          <option value="{{$cat->id}}">{{$cat->name}}</option>
                      @endforeach
 </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">تصنيف</label>
                      <select name="tags[]" id="tags" multiple>
                      @foreach ($tags as $tag)
                          <option value="{{$tag->id}}">{{$tag->name}}</option>
                      @endforeach
 </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">حاله</label>
                      <select name="status" id="status">
                          <option value="0">غير مفعل</option>
                          <option value="1">مفعل</option>

 </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">تعليقات المستخدمين</label>
                      <select name="comment_able" id="comment_able">
                          <option value="0">غير مفعل</option>
                          <option value="1">مفعل</option>

 </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">صورة مقال</label>
                            <input type="file" name="image">
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
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route($delete)}}" method="POST">

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

$(function () {
            $('.summernote').summernote({
                tabSize: 2,
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
});



$('body').on('click', '#showEditModelPost', function () {
var cat_id = $(this).data('id');
$.get('{{$edit}}'+cat_id, function (data) {
    console.log(data.tags);
$('#postEditModel').modal('show');
$('#id').val(data.id);
$('#title').val(data.title);
$('#content').val(data.discription);
$('#discription').summernote('code', data.content);
$('#status').val(data.status);
$('#comment_able').val(data.comment_able);
$('#image').val(data.image);
$(`#category_id option[value='${data.category_id}']`).prop('selected', true);
$(`#status option[value='${data.status}']`).prop('selected', true);


 for (let index = 0; index < data.tags.length; index++) {
     v=data.tags[index].id;
     console.log(v);

    $(`#tags option[value='${v}']`).prop('selected', true);

 }});

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
