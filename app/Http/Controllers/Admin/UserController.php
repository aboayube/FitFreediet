<?php

namespace App\Http\Controllers\Admin;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\DocotorDate;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class UserController extends Controller
{
    public function index(){
        if(Auth::user()->role=='admin'){
$users=User::where('role','user')->with(['profile'])->paginate(10);
return view('admin.users',compact('users'));
        }

        //هيجيب بس مرضا لي خاصين بدكتور فقط
        //else if(Auth::id){}
    }
    public function edit($id){
		$user = User::whereId($id)
        ->where('role','user')
        ->first();
        if($user){
            $data=$user->profile()->first();
		return Response::json($data);
    }}
    //
    public function delete(Request $request)
    {
        $user=User::where('id',$request->id)->first();
        if($user){
            $user->delete();
           \Alert::warning('مستخدم', 'تم حذف مستخدم بنجاح');

             return redirect()->route('admin.users.index');
        }else{
        \Alert::error('مستخدم', 'هناك خطا ما');
            return false;

        }
    }


  public function subscirbeUser(){
    $subs=Subscribe::with(['user','service'])->paginate(10);

    return view('admin.userSubscripe',compact('subs'));
  }

public function docotorSubscirbe(){
    $data=DocotorDate::where('status','محجوز')->where("user_name",'!=',null);
  
    if(\Auth::user()->role=='docotor'){

$data=$data->where('user_id',\Auth::id())->get();
    }else{
      $data=$data->paginate(5);
    }

    return view('admin.subscirbeUserDate',compact('data'));
}


    public function profile(){
        $user=Auth::user();
        return view('admin.profile',compact('user'));
    }
    public function editprofile(Request $request){

if($request->id== Auth::id()){
    $data=[];
    if($request->password){
        if($request->password == $request->confirm_password){
            $data['password']= bcrypt($request->password);

        }else{



            \Alert::error('تعديل بيانات الشخصية', 'كلمة السر غير متطابقة');
         }
    }
    if($request->mobile){
        $data['mobile']=$request->mobile;
    }
    $file=$request->image;
    if($request->image){
        $filename =Auth::user()->name.'-'.time().'.'.$file->getClientOriginalExtension();
        $path = public_path('assets/users/' . $filename);
        Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path, 100);
        $data['image']=$filename;
}
if(! empty($data)){
    User::whereId(Auth::id())
    ->update($data);
    alert()->success('تصنيفات','تم اضافة تصنيف بنجاح');

    return redirect()->route('admin.profile');
}else{
    return redirect()->back();

}
}else{
return redirect()->back();
}
    }

    public function editspecialty(Request $request){


        $validator = Validator::make($request->all(), [
            'specialty'         => 'required',
            'discription'   => 'required',
            ]);
         if($validator->fails()) {
            \Alert::error('ييانات الشخصية', 'هناك خطا ما');
    
            return redirect()->back()->withErrors($validator)->withInput();
            }
    
    $file=$request->cv;
    if($request->cv){

        if(auth()->user()->docotor->cv){
            if (File::exists('assets/cv/' . auth()->user()->docotor->cv)) {
                unlink('assets/cv/' . auth()->user()->docotor->cv);
            }
         }


        $filename = auth()->user()->name.'-cv-'.time().'.'.$file->getClientOriginalExtension();
        $path = public_path('assets/cv/' . $filename);
        Image::make($file->getRealPath())->save($path, 100);
        \Auth::user()->docotor->update([
             'cv'=>$filename,
         ]);
    }  
    
    \Auth::user()->docotor->update([
        'specialty'=>$request->post('specialty'),
        'discription'=>Purify::clean($request->post('discription')),
    
     ]);

     
  alert()->success('بيانات الشخصية','تم تعديل تصنيف بنجاح');
  return redirect()->route('admin.profile');}
}
