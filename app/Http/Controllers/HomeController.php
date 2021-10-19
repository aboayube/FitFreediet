<?php

namespace App\Http\Controllers;

use App\Helpers\BMI;
use App\Models\nutritionalValue;
use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;
use App\Models\Service;
use App\Models\Subscribe;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{



    public function index(Request  $request)
    {
        $data=0;
$users=User::where("role",'admin')->orWhere('role','docotor')->where('status',1)->limit(4)->get();
$services=Service::limit(3)->get();
$subcribe=null;
$issubcribe=null;
if(\Auth::check()){
    $subcribe=Subscribe::where("user_id",\Auth::id())->first();
if($subcribe){
    $issubcribe=Subscribe::where("user_id",auth()->id())->where('services_id',1)->first();
}
}

       
        return view('welcome',compact('users','issubcribe','services','subcribe','data'));
    }

    public function nutrvalue(){
        return view('front.nutrvalue.index');
    }
    public function getNutrvalue(Request $request){

        $nutrals=nutritionalValue::where('name',$request->name)->first();

        if($nutrals){
           $values=$nutrals->elements()->get();
           $labels=[];
           $data=[];
foreach($values as $val){
$labels[]=$val->element;
$data[]=$val->element_value;
}

           $chartjs = app()->chartjs
           ->name('pieChartTest')
           ->type('pie')
           ->size(['width' => 400, 'height' => 200])
           ->labels($labels)
           ->datasets([
               [
                   'backgroundColor' => ['red', 'green','blue','black','yellow','orange'],
                   'hoverBackgroundColor' => ['#FF6384', '#36A2EB','#FF6384', '#36A2EB'],
                   'data' =>$data
               ]
           ])
           ->options([]);
        return view("front.nutrvalue.getNutrvalue",compact('chartjs'));
        }else{
            
        \Alert::error('حاسبة الوجبات الغذائية', "لا يوجد وجبة  بهذا الاسم");
        return view('front.nutrvalue.index');
        }

            }


            //حساب السعرات الحرارية
            public function cloulors(Request $request){
                $user=\Auth::user();
            
                if($user->role=='admin' || $user->role=='docotor'){
                    return false;
                }
            return view("front.clourse",compact('user'));
            }
            public function calccloulors(Request $request){
                $user=auth()->user();
                $validator = Validator::make($request->all(), [
                    'length'         => 'required',
                    'age'   => 'required',
                    'weight'      =>'required',
                       ]);
         if($validator->fails()) {
                    \Alert::error('مقالات', 'هناك خطا ما');
        
                    return redirect()->back()->withErrors($validator)->withInput();
                    }
                    $data['length']=$request->post('length');
                    $data['age']=$request->post('age');
                    $data['weight']=$request->post('weight');
                    $data['diseasesName']=$request->post('diseasesName');
                    $data['notes']=$request->post('notes');
                    $data['activity']=$request->post('activity');
                    $data['aims']=$request->post('aims');

$e=auth()->user()->profile;
 $bmi=new BMI($data['length'],$data['weight'],$data['age'],$e->gender,$data['activity']);
           $bmidata=$bmi->calculatorBmi();         
                    $data['bmi']=$bmidata['bmi'];
                    $data['bmivalue']=$bmidata['bmivalue'];
                    $data['calories']=$bmidata['calories'];
      auth()->user()->profile()->update($data);

      
      alert()->success('تصنيفات','تم اضافة تصنيف بنجاح');
                
      return redirect()->route('index');
            }
            //حساب السعرات الحرارية
            public function profile(Request $request){
        
                $user=\Auth::user();
                if($user->role=='admin' || $user->role=='docotor'){
                    return false;
                }
                return view("front.profile",compact('user'));
            }
            public function editprofile(Request $request){
          
                    $data=[];
                    if($request->password){
                        if($request->password == $request->confirm_password){
                            $data['password']= bcrypt($request->password);
                
                            
                        }else{
                            \Alert::error('تعديل بيانات الشخصية', 'كلمة السر غير متطابقة');
                         }
                    }
                    $file=$request->image;
                    
                    if($request->image){

                        if(!auth()->user()->image=='profile.png'){
                        if(file_exists(
                            public_path('assets/' . auth()->user()->image))){
                            unlink(public_path('assets/users/' . auth()->user()->image));
                        }
                        }
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
                }
     

}
