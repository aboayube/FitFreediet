<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocotorsController extends Controller
{

    public function index()
    {
        $elements=User::where('role','docotor')->orderBy('id','DESC')->paginate(10);
        //return view('admin.docotor.index',
       // compact('elements'));
            return view('admin.docotor.index')->with('elements',User::where('role','docotor')->orderBy('id','DESC')->paginate(10));

    
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
            'name' => 'required|max:50',
            'email' => 'required|email',
            'mobile' => 'required|unique:users,mobile',
            'status' => 'required',
            'specialty'=>'required',
            'cv'=>'file',
           
        ]);
     if($validator->fails()) {
        \Alert::error('اطباء', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try{
      $user=  User::create([
            'name'=>$request->post('name'),
            'email'=>$request->post('email'),

            'password' => bcrypt('123123123'),
            'role' => 'docotor',
            'mobile'=>$request->post('mobile'),
            'status'=>$request->post('status'),
            'image'=>'users/profile.png',
        ]);

        $file=$request->cv;
        // اضاف صورة
        if($request->cv){


            $filename = $request->name.'-cv'.time().'.'.$file->getClientOriginalExtension();
            $path = public_path('assets/cv/' . $filename);
            Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
        }
        $user->docotor()->create([
            'discription'=>'asdsad',
            'cv'=>$filename,
            'specialty'=>'asdasd',
        ]);
        DB::commit();
        alert()->success('اخصائي تغذية','تم اضافة اخصائي تغذية بنجاح');

  return redirect()->route('admin.docotor.index');
}catch(Throwable $e){
    DB::rollback();
    throw $e;
}

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //بديش ابعت json لو احتاج الامر سوف نقوم بلازم
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
     if($validator->fails()) {
        \Alert::error('اطباء', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator)->withInput();
        }

        $user=User::where('role','docotor')->where('id',$request->id)->first();


        $user->update([
            'status'=>$request->post('status'),
        ]);
        alert()->success('اطباء','تم تعديل حالة اطباء بنجاح');

  return redirect()->route('admin.docotor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $doc=User::where('role','docotor')->where("id",$request->id)->first();
        if(!$doc->image=='default.png'){
            if (File::exists('assets/docotors/' . $doc->image)) {
                unlink('assets/docotors/' . $doc->image);
            }
        }   $doc->delete();
        \Alert::warning('اخصائين التغذية', 'تم حذف طبيب بنجاح');

  return redirect()->route('admin.docotor.index');


    }
}
