<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Response;

class ServicesController extends Controller
{
    public function index()
    {

 $elements=Service::orderBy('id','DESC')->paginate(10);
        return view('admin.services',
        compact('elements'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'consulted'=>'required',
            'type'=>'required',
            'benefits'=>'required',
            'price'=>'required',
            'day'=>'required',
        ]);
     if($validator->fails()) {
        \Alert::error('خدمات ', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator)->withInput();
        }
        Service::create([
            'name'=>$request->post('name'),
            'consulted'=>$request->post('consulted'),
            'type'=>$request->post('type'),
            'benefits'=>$request->post('benefits'),
            'price'=>$request->post('price'),
            'day'=>$request->post('day'),
        ]);
        alert()->success('خدمة اشتراك','تم اضافة خدمة اشتراك بنجاح');

  return redirect()->route('admin.services.index');
    }

    public function edit($id)
    {
        $cat = Service::where('id',$id)->first();
        if($cat){
		return Response::json($cat);
    }
    return false;
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'consulted'=>'required',
            'type'=>'required',
            'benefits'=>'required',
            'price'=>'required',
            'day'=>'required',
        ]);
     if($validator->fails()) {
        \Alert::error('تصنيفات', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator)->withInput();
        }
        $service=Service::where('id',$request->id)->first();
        if(!$service){
            \Alert::error('تصنيفات', 'هناك خطا ما');


        }else{

            $data['name']=$request->post('name');
            $data['consulted']=$request->post('consulted');
            $data['type']=$request->post('type');
            $data['price']=$request->post('price');
            $data['day']=$request->post('day');
            $service->update($data);

            alert()->success('خدمه اشتراك','تم اضافة نوع اشتراك بنجاح');

      return redirect()->route('admin.services.index');
        }
    }
    public function delete(Request $request)
    {
        $service=Service::where('id',$request->id)->first();

        if($service){
            $service->delete();
           \Alert::warning('اشتراك', 'تم حذف اشتراك بنجاح');

             return redirect()->route('admin.services.index');
        }else{
        \Alert::error('اشتراك', 'هناك خطا ما');
            return false;

        }
    }
}
