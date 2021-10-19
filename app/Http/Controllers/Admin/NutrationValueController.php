<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\nutritionalValueElements;
use App\Models\nutritionalValue;
use Illuminate\Support\Facades\Response;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NutrvalueNotification;
class NutrationValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=nutritionalValue::paginate(10);
        return view('admin.nutritional.index',compact('data'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required',
            'value'      => 'required',
        ]);

        if($validator->fails()) {
            \Alert::error('حاسبة الوجبات الغذائية', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator);
            }
            $elemnts=[];
            foreach($request->element as $key => $value){

                if(empty($value)){
                    \Alert::error('حاسبة الوجبات الغذائية', 'يجيب ان تدخل قيمة العنصر');

                    return redirect()->back()->withErrors($validator)->withInput();
                }

    $elemnts[$key]['element'] =$value;
    $elemnts[$key]['element_value'] =$request->element_value[$key];
            }
                try{
        $nutrl=nutritionalValue::create([
            'name'=>$request->name,
            'value'=>$request->value,
            'user_id'=>Auth::id(),
        ]);
        $send= $nutrl->elements()->createMany($elemnts);
      
$user=User::where('role','admin')->where('id','!=',\Auth::id())->first();
if($user){
$user->notify(new NutrvalueNotification($nutrl));
}

      
        alert()->success('حاسبة الوجبات الغذائية','تم اضافة وجبة بنجاح');

        return redirect()->route('admin.nutrs.index');



    }catch(Exception $e){
        \Alert::error('حاسبة الوجبات الغذائية', 'هناك خطا ما يرجي المحاولة مرة اخر');

        return redirect()->back()->withErrors($validator)->withInput();

    }
                echo $key .'=>'.$value;


    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {	$cat = nutritionalValueElements::where('nutrvalue_id',$id)->get();

        if($cat){
		return Response::json($cat);
	}

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {

        $nutrl=nutritionalValue::where('id',$request->id)->where('user_id',Auth::id())->first();
        if($nutrl){
            $nutrl->delete();
           \Alert::warning('وجبات الغذائية', 'تم حذف وجبة الغذائية بنجاح');

             return redirect()->route('admin.nutrs.index');
        }else{
        \Alert::error('وجبات الغذائية', 'هناك خطا ما');
            return false;

        }

    }
}
