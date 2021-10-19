<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Stevebauman\Purify\Facades\Purify;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Validator;
class SettingsController extends Controller
{
 public function index(){
$setting=Settings::first();
return view('admin.setting',compact('setting'));
 }
 public function update(Request $request){
    $validator = Validator::make($request->all(), [
       'name' => 'required',
        'discription' => 'required',
        'logo' => 'nullable|image',
        'email' => 'required',
        'facebook' => 'required',
        'twiter' => 'required',
        'linked_in' => 'required',
        'instagram' => 'required',
        'whatsapp' => 'required',
    ]);
 if($validator->fails()) {
    \Alert::error('تصنيفات', 'هناك خطا ما');

    return redirect()->back()->withErrors($validator)->withInput();
    }
    $setting=Settings::where('id',1)->first();

    $data['name']=$request->post('name');
    $data['discription']=Purify::clean($request->post('discription'));
    $data['email']=$request->post('email');
    $data['facebook']=$request->post('facebook');
    $data['twiter']=$request->post('twiter');
    $data['linked_in']=$request->post('linked_in');
    $data['instagram']=$request->post('instagram');
    $data['whatsapp']=$request->post('whatsapp');


    $setting->update($data);
    $file=$request->logo;
            if($request->logo){
                $filename = $request->name.'.'.$file->getClientOriginalExtension();
                $path = public_path('assets/' . $filename);
                Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($path, 100);

    $setting->update([
        'logo'=>$filename,
    ]);
              }
              alert()->success('اعدادات','تم  تعديل اعدادات الموقع بنجاح');

              return redirect()->route('admin.settings.index');


 }
}
