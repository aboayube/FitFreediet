<?php

namespace App\Http\Controllers\Admin;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artical;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use Intervention\Image\Facades\Image;
use  App\Notifications\PostCreatedNotification;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements=Artical::where('type','posts')->orderBy('id','DESC')->with(['user','category','tags'])->paginate(10);
        $cats=Category::get();
        $tags=Tag::get();

        if($cats->isEmpty()){
            \Alert::warning('مقالات', 'يجيب اضافة اقسام');
       return redirect()-> route('admin.categories.index');
        }else if($tags->isEmpty()){
            \Alert::warning('مقالات', 'يجيب اضافة تصنيفات');
            return redirect()->route('admin.tags.index');
        }else{


        $edit='/admin/posts/edit/';
        $store='admin.posts.store';
        $update='admin.posts.update';
        $delete='admin.posts.delete';
        $imageName='posts';

        return view('admin.articals.index',
        compact('elements','cats','tags'
    ,'edit','store','update','delete','imageName'
    ));
}
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
        'title'         => 'required|unique:articals,title',
        'discription'   => 'required',
        'status'        => 'required',
        'category_id'   => 'required|exists:categories,id',
        'tags.*'        => 'required|exists:tags,id',
        'image'        => 'required',
        ]);
     if($validator->fails()) {
        \Alert::error('مقالات', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator)->withInput();
        }

$file=$request->image;
if($request->image){
    $filename = time().'-'.time().'.'.$file->getClientOriginalExtension();
    $path = public_path('assets/posts/' . $filename);
    Image::make($file->getRealPath())->resize(538, 200)->save($path, 100);
    $artical =   Artical::create([
        'title'=>$request->post('title'),
        'discription'=>$request->post('discription'),
        'content'=>Purify::clean($request->post('content')),
        'status'=>$request->post('status'),
        'comment_able'=>$request->post('comment_able'),
        'user_id'=>Auth::id(),
        'category_id'=>$request->post('category_id'),
        'image'=>$filename,
        'type'=>'posts',
     ]);


     if(count($request->tags)>0){

        $artical->tags()->sync($request->tags);
      }

$user=User::where('role','admin')->where('id','!=',\Auth::id())->first();
if($user){
$user->notify(new PostCreatedNotification($artical,'post'));
}

      alert()->success('تصنيفات','تم اضافة تصنيف بنجاح');
      return redirect()->route('admin.posts.index');
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

		$artical = Artical::where('id',$id)->where('type','posts')->with(['tags'])->first();

                if($artical){
                return Response::json($artical);

            }
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
        $artical=Artical::where('id',$request->id)->where('type','posts')->first();

        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'discription'   => 'required',
            'content'      =>'required',
            'status'        => 'required',
            'category_id'   => 'required|exists:categories,id',
            'tags.*'        => 'required|exists:tags,id',
            ]);
 if($validator->fails()) {
            \Alert::error('مقالات', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
            }
            if($artical){

                $filename=$artical->image;
$file=$request->image;
                // اضاف صورة
                if($request->image){
                    if($artical->image){
                        if (File::exists('assets/posts/' . $artical->image)) {
                            unlink('assets/posts/' . $artical->image);
                        }
                     }


                    $filename = $request->title.'-'.time().'.'.$file->getClientOriginalExtension();
                    $path = public_path('assets/posts/' . $filename);
                    Image::make($file->getRealPath())->resize(800, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);
                }
                $data['title']=$request->post('title');
                $data['content']=$request->post('content');
                $data['discription']=$request->post('discription');
                $data['discription']=$request->post('discription');
                $data['category_id']=$request->post('category_id');
                $data['status']=$request->post('status');
                $data['comment_able']=$request->post('comment_able');
                $data['image']=$filename;
                $artical->update($data);
                if (count($request->tags) > 0) {
                    $new_tags = [];
                    foreach ($request->tags as $tag) {
                        $tag = Tag::firstOrCreate([
                            'id' => $tag
                        ], [
                            'name' => $tag
                        ]);

                        $new_tags[] = $tag->id;
                    }
                    $artical->tags()->sync($new_tags);
                }
                 alert()->success('مقالات','تم اضافة تصنيف بنجاح');

                return redirect()->route('admin.posts.index');





            }else{
                \Alert::error('مقالات', 'هناك خطا ما');

                return redirect()->back()->withErrors($validator)->withInput();

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
        $artical=Artical::where('id',$request->id)
     ->where('title',$request->title)->where('type','posts')->first();
     if($artical->image){
        if (File::exists('assets/posts/' . $artical->image)) {
            unlink('assets/posts/' . $artical->image);
        }
        $artical->delete();
              \Alert::warning('مقالات', 'تم حذف مقال بنجاح');

        return redirect()->route('admin.posts.index');
     }
    }
}
