<?php

namespace App\Http\Controllers;
use App\Models\DocotorDate;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\Subscribe;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Conversation;
use App\Notifications\UserSubscribeDateDocotorNotification;
use Illuminate\Support\Facades\DB as FacadesDB;

class DocotorController extends Controller
{
    public function index(){
   
if(\Auth::check() && \Auth::user()->role=='docotor'){
    return redirect()->route("index");
}

    $docotors=User::where('status',1)->where("role",'docotor')->whereHas('dataDocotor',function(Builder $q ){
        $q->where('status','فعال');
    })->get();


        return view('front.docotors.index',compact('docotors'));

}

    public function showCalender($id){
        $docotor=User::where("status",1)->where('role','docotor')->whereId($id)->first();

    if($docotor){
        $calender=DocotorDate::where('user_id',$docotor->id)->where("status", "فعال")->get();
   
		return Response::json($calender);

    }else{
        \Alert::error('مواعيد اطباء', 'هناك خطا ما');

    }
    }
    public function subscribeUser(Request $request){

       //تاكد من ان الدكتور وموعد موجود
$date=DocotorDate::where('user_id',$request->id)->where('day',$request->day)
->where('from_hour',$request->from_hour)
->where('to_hour',$request->to_hour)
->where('status','فعال')
->first();

if($date){
    //تاكد المستخدم مشترك ومفعل
    $subscribe=Subscribe::where("user_id",\Auth::id())->where('status_pay','completed')->first();
 //تاكد المستخدم مشترك ومفعل
 if($subscribe){
    $sub=$subscribe->status_pay=='completed'?1:0;

    if($sub){

//يضيف علي جدول محاثات
//اسم المريض +دكتور+موعد
$conversations=Conversation::create([
    'name'=>\Auth::user()->name,
    'user_id'=>\Auth::id(),
    'status'=>1,
]);
DB::table('conversation_user')->insert([
    'conversation_id' => $conversations->id,
    'user_id' => \Auth::user()->id,
    'created_at'=>now(),
     'updated_at'=>now(),

]);
DB::table('conversation_user')->insert([
    'conversation_id' => $conversations->id,
    'user_id' => $date->docotor->id,
    'created_at'=>now(),
     'updated_at'=>now(),

]);

$date->update(['status'=>'محجوز','user_name'=>\Auth::user()->name]);

$consulted=$subscribe->consulted - 1; 
if($consulted==0){
    $subscribe->update(['status_pay'=>'finish']);

}
$subscribe->update(['consulted'=>$consulted]);
 alert()->success("<br>
 سوف يكون موعدك مع طبيب يوم $request->day من ساعه $request->from_hour الي $request->to_hour
 تم حجز موعد مع طبيب','سوف يكون موعدك مع الطبيب في قريب");

// يرسل اشعار للطبيب وللادارة انو تم حجز موعود
$users=User::whereId($date->docotor->id)->orWhere('role','admin')->get();

foreach($users as $user){
$user->notify(new UserSubscribeDateDocotorNotification($date));
}

 return redirect()->route('index');
}else{

    \Alert::error(' موعد مع طبيب', 'هناك خطا ما');
    return redirect()->route("frontend.docotors");

}
}else{
    \Alert::error(' موعد مع طبيب', 'يجيب عليك ان تشترك معنا');
    return redirect()->route("frontend.docotors");
}
       }else{
        \Alert::error(' لا تسطيع اخذ موعد مع الطبيب الا باشتراك', 'يجيب عليك  تجديد اشتراك معنا');
return redirect()->route("frontend.docotors");
       }
    }
}
