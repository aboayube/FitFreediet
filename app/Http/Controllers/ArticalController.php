<?php

namespace App\Http\Controllers;
use App\Models\Artical;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ArticalController extends Controller
{
public function wasfas(){
$wasfas=Artical::where('status','1')->where('type','wasfas')->get();
return view("front.wasfas.index",compact('wasfas'));
}
public function wasfa($title){
    $wasfas=Artical::where('status','1')->where('title','!=',$title)->where('type','wasfas')->limit(3)->get();

    $wasfa=Artical::where('status','1')->where('type','wasfas')->where('title',$title)->first();

    return view("front.wasfas.wasfa",compact('wasfas','wasfa'));

}
public function posts(){
    $posts=Artical::where('status','1')->where('type','posts')->get();
    return view("front.posts.index",compact('posts'));

}
public function post($title){
    $posts=Artical::where('status','1')->where('title','!=',$title)->where('type','posts')->limit(4)->get();

    $post=Artical::where('status','1')->where('type','posts')->where('title',$title)->first();

    return view("front.posts.post",compact('posts','post'));

}
public function postcomment(Request $request){
   
    $validator = Validator::make($request->all(), [
        'message'         => 'required|unique',
        ]);
     if($validator->fails()) {
        \Alert::error('مقالات', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator)->withInput();
        }
}


public function category($name){
$cats=Category::where('name',$name)->first();

$posts=Artical::where('category_id',$cats->id)->where('type','posts')->get();

return view("front.posts.index",compact('posts'));

}
}
