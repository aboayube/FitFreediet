<?php

namespace App\Http\Controllers;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;
use App\Models\User;
use App\Notifications\ContactUsNotification;
class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Contactus::paginate(10);
        return view('admin.contactus',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("front.contactUs");
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    $validator = Validator::make($request->all(), [
        'name'         => 'required',
        'email'   => 'required|email',
        'phone'      =>'required|max:11',
        'message'        => 'required|max:100|min:10',
    ]);
    if($validator->fails()) {
        \Alert::error('تصنيفات', 'هناك خطا ما');

        return redirect()->back()->withErrors($validator)->withInput();
        }
        $data['name']=$request->post('name');
        $data['email']=$request->post('email');
        $data['phone']=$request->post('phone');
        $data['message']=Purify::clean($request->post('message'));

        $user=Contactus::create($data);


        $user=User::where('role','admin')->first();
        if($user){
        $user->notify(new ContactUsNotification($user));
        }


        \Alert::success('تم اضافة بنجاح', 'تم ارسال الرسالة الي ادارة FitFree سوف نتواصل معك قريبا');
        return redirect()->route('contact-us');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cat = Contactus::where('id',$id)->first();
        if($cat){
		return Response::json($cat);
    }
    return false;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    { $contactus=Contactus::where('id',$request->id)->first();
        if($contactus){
            $contactus->delete();
           \Alert::warning('طلبات المستخدمين', 'تم حذف طلبات المستخدمين بنجاح');

             return redirect()->route('admin.contactus.index');
        }else{
        \Alert::error('طلبات المستخدمين', 'هناك خطا ما');
            return false;

        }
    }

}
