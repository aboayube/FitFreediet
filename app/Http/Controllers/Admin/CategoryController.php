<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Artical;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Notifications\TasNotification;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $edit='/admin/categories/edit/';
        $store='admin.categories.store';
        $update='admin.categories.update';
        $delete='admin.categories.delete';
        $elements=Category::orderBy('id','DESC')->with(['user'])->paginate(6);
        return view('admin.department',
        compact('elements',
        'edit',
        'store',
        'update',
        'delete'  ));
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
       $category= Category::create([
            'name'=>$request->post('name'),
            'user_id'=>\Auth::user()->id,
        ]);
                
$user=User::where('role','admin')->where('id','!=',\Auth::id())->first();
if($user){
$user->notify(new TasNotification($category,'categories'));
}
        alert()->success('تصنيفات','تم اضافة تصنيف بنجاح');

  return redirect()->route('admin.categories.index');


        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$cat = Category::where('id',$id)->first();
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
        $cat=Category::where('id',$request->id)->first();
        if(!$cat){
            \Alert::error('تصنيفات', 'هناك خطا ما');

        }else{
            $data['name']=$request->post('name');
            $cat->update($data);
            alert()->success('تصنيفات','تم اضافة تصنيف بنجاح');

      return redirect()->route('admin.categories.index');
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
        $cat=Category::where('id',$request->id)->first();
        if($cat){

    $post=Artical::where('category_id',$request->id)->first();
    if($post){
        \Alert::warning('تصنيف', 'هناك مقالات يجيب حذفها بالاول لانها مرتبطه بقسم');
        return redirect()->back();

    }
            $cat->delete();
           \Alert::warning('تصنيف', 'تم حذف القسم بنجاح');

             return redirect()->route('admin.categories.index');
        }else{
        \Alert::error('تصنيفات', 'هناك خطا ما');
            return false;

        }
    }
}
