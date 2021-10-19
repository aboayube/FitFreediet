<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TasNotification;
class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $edit='/admin/tags/edit/';
        $store='admin.tags.store';
        $update='admin.tags.update';
        $delete='admin.tags.delete';
        $elements=Tag::orderBy('id','DESC')->with(['user'])->paginate(10);
        return view('admin.department',
        compact('elements',
        'edit',
        'store',
        'update',
        'delete'));
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
            'name' => 'required|unique:categories|max:50',
        ]);
     if($validator->fails()) {
        \Alert::error('تصنيفات', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator)->withInput();
        }
      $tag=  Tag::create([
            'name'=>$request->post('name'),
            'user_id'=>\Auth::user()->id,
        ]);

        
$user=User::where('role','admin')->where('id','!=',\Auth::id())->first();
if($user){
$user->notify(new TasNotification($tag,'tag'));
}
        alert()->success('تصنيفات','تم اضافة تصنيف بنجاح');

  return redirect()->route('admin.tags.index');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Tag::where('id',$id)->first();
        if($cat){
		return Response::json($cat);
    }
    return false;
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
            'name' => 'required|unique:categories|max:50',
        ]);
     if($validator->fails()) {
        \Alert::error('تصنيفات', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator)->withInput();
        }
        $tag=Tag::where('id',$request->id)->first();
        if(!$tag){
            \Alert::error('تصنيفات', 'هناك خطا ما');

        }else{
            $data['name']=$request->post('name');
            $tag->update($data);
            alert()->success('تصنيفات','تم اضافة تصنيف بنجاح');

      return redirect()->route('admin.tags.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $tag=Tag::where('id',$request->id)->first();
        if($tag){
            $tag->delete();
           \Alert::warning('تصنيف', 'تم حذف القسم بنجاح');

             return redirect()->route('admin.tags.index');
        }else{
        \Alert::error('تصنيفات', 'هناك خطا ما');
            return false;

        }
    }
}
