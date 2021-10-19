<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __consrtuct(){
        $this->middleware('auth');
    }
    public function index(){
        $user=\Auth::user();
        return view("notifications",[
        //    'not'=> $user->notifications
    //برجع رسائل غير مقرؤه
 //   'not'=> $user->unreadNotifications
   //رسائل المقرؤة
'not'=>$user->readNotifications
]);
//خلي كل كلو مقروء للمش مقروء
$user->unreadNotifications()->markAsRead();
    }
    public function read($id){
        $user=\Auth::user();
        $notification=$user->notifications()->findOrFail($id);
        $notification->markAsRead();



        return redirect()->back();
    }
}
