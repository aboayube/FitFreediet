<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\DocotorDate;
use App\Models\SubscribeDoctorDate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
class DocotorDateController extends Controller
{
    //
    public function index(Request $request)
    {
        $users=null;
        if($request->user()->role=='docotor'){
$data=DocotorDate::where('user_id',$request->user()->id)->paginate(10);
$users=\Auth::id();
        }else{
            $data=DocotorDate::paginate(10);
            $users=User::where("role",'docotor')->where('status',1)->get();
        }


return view('admin.dataDocotors',compact('data','users'));
        }


    //يتم الرجوع الها مستقبلا
    public function store(Request $request)
    {     $validator = Validator::make($request->all(), [
        'day.*'         => 'required',
        'from_hour.*'      => 'required',
        'to_hour.*'=>'required',
        'status.*'=>'required',
    ]);


    if($validator->fails()) {
        \Alert::error('مواعيد الاطباء', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator);
        }
        $elemnts=[];
        foreach($request->day as $key => $value){

            if(empty($value)){
                \Alert::error('مواعيد الاطباء', 'يجيب ان تدخل قيمة العنصر');

                return redirect()->back()->withErrors($validator)->withInput();
            }


$elemnts[$key]['day'] =$value;
$elemnts[$key]['from_hour'] =$request->from_hour[$key];

$elemnts[$key]['to_hour'] =$request->to_hour[$key];
$elemnts[$key]['status'] =$request->status[$key];
$elemnts[$key]['created_at'] =Carbon::now();
$elemnts[$key]['updated_at'] =Carbon::now();


if(\Auth::user()->role=='admin'){

    $elemnts[$key]['user_id']=$request->user_id[$key];

}else{    
$elemnts[$key]['user_id']=\Auth::id();

}
        }
            try{
    $send=DocotorDate::insert($elemnts);
    alert()->success('مواعيد الاطباء','تم اضافة المواعيد بنجاح');

    return redirect()->route('admin.dataDocotors.index');



}catch(Exception $e){
    \Alert::error('حاسبة الوجبات الغذائية', 'هناك خطا ما يرجي المحاولة مرة اخر');

    return redirect()->back()->withErrors($validator)->withInput();

}
            echo $key .'=>'.$value;


    }

    public function edit(Request $request,$id)
    {
        $cat = DocotorDate::where('id',$id);

        if(Auth::user()->role=='admin'){
            $cat=$cat->first();
        }else{
           $cat= $cat->where('user_id',$request->user()->id)->first();
        }
        if($cat){
		return Response::json($cat);
    }
    return false;
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'from_hour' => 'required',
            'to_hour' => 'required',
        ]);
     if($validator->fails()) {
        \Alert::error('مواعيد اطباء', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator)->withInput();
        }
        $docotorDate=DocotorDate::where('id',$request->id)->first();
        if(!$docotorDate){
            \Alert::error('موعد الطبيب', 'هناك خطا ما');

        }else{
            $data['day']=$request->post('day');
            $data['from_hour']=$request->post('from_hour');
            $data['to_hour']=$request->post('to_hour');
            $data['status']=$request->post('status');
            $docotorDate->update($data);
            alert()->success('موعد الطبيب','تم اضافة موعد الطبيب بنجاح');

      return redirect()->route('admin.dataDocotors.index');
        }
    }public function delete(Request $request)
    {
        $docotorDate=DocotorDate::where('id',$request->id)->first();
        if($docotorDate){
            $docotorDate->delete();
           \Alert::warning('موعد الطبيب', 'تم حذف موعد الطبيب بنجاح');

             return redirect()->route('admin.dataDocotors.index');
        }else{
        \Alert::error('موعد الطبيب', 'هناك خطا ما');
            return false;

        }
    }


  public function userSubscribe(){

      if(\Auth::user()->role=='docotor'){
          $data=DocotorDate::where('user_id',\Auth::id())->where("status",'محجوز')->get();



      }else{
          $data=DocotorDate::where("status",'محجوز')->paginate(10);
      }

      return view('admin.userSubscripeDate',compact('data'));
  }


}
