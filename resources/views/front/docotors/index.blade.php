@extends('layouts.front.app')
@section('content')
<section class="subPageTitle text-right">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
          <li class="breadcrumb-item active" aria-current="page"> إستشارات تغذية أونلاين </li>
        </ol>
      </nav>
    </div>
  </section>
  <section class="section estesharat">
    <div class="container">
      <div class="row">


    @foreach($docotors  as $docotor)
      <div class=" col-lg-6 col-sm-12">
          <div class="about-author">
            <div class="author-avatar">
              <img src="{{asset('assets/users/'.$docotor->image)}}" alt="">
            </div>
            <div class="author-bio">
              <div class="author-top">
                <a class="name" href="#"> {{$docotor->name}}</a>
                <p class="job">{{$docotor->docotor->specialty	}}</p>
              </div>

            </div>
            <div class="author-description text-center">
           {{$docotor->docotor->discription}}
        </div>
            <div class="mb-4 text-center">
              <a href="javascript:void(0)"
 class=" modal-effect btn btn btn-success btn-website"
 id="showModelCalenderDocotor"
 data-id="{{ $docotor->id }}"
 data-docotorname="{{$docotor->name}}"
 data-toggle="modal"


 >حجز موعد</a>


            </div>
          </div>
        </div>

        <div class="modal" id="showElementModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">مواعيد <span id="docotorName"></span></h6><button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <table class="table key-buttons text-md-nowrap" id="element_details">
<thead>
<tr>
  <td>يوم</td>
  <td>من ساعة</td>
  <td>الي الساعة</td>
  <td>حجز</td>
</tr>
</thead>
<tbody>



</tbody>

</table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    </div>
            </div>
        </div>
    </div>

@endforeach








</div>
</div>
</secction>
<script src="{{asset('js/app.js')}}"></script>
<script>
  
    $('body').on('click', '#showModelCalenderDocotor', function () {
var cat_id = $(this).data('id');
var docotor_name=$(this).data('docotorname');

  $.get('/docotors/'+cat_id, function (data) {
    $('#showElementModel').modal('show');
    $('#docotorName').text(docotor_name);
    data.forEach(function(el){
    $('#cat_id').val(data.id);
        id=el['user_id'];
        day=el['day'];
        from_hour=el['from_hour'];
        to_hour=el['to_hour'];
        $('#element_details').find('tbody').append($(''+
        '<tr>'+
        '<td>'+el['day']+'</td>'+
        '<td>'+el['from_hour']+'</td>'+
        '<td>'+el['to_hour']+'</td>'+
        `<td>
        <form method="post" action="{{url("docotorDate/`+id+`/`+day+`")}}">
        @csrf
        <input type="hidden" name="from_hour" value="`+from_hour+`">
        <input type="hidden" name="to_hour" value="`+to_hour+`">
        <button type="submit" id="subscripe" class="btn btn-primary">حجز</button>
        </form></td>`+
        '<tr>'
        ));});
});


//لما يروح الضغط عن اضهار العناصر
$('#showElementModel').on('hidden.bs.modal', function (event) {

$('#element_details').find('tbody tr').remove();
})
});


    </script>
@endsection
