<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscribeDoctorDate;
use App\Models\Message;
use App\Models\Conversation;
use App\Models\DocotorDate;

class ConversationController extends Controller
{
    //
    public function index(){
if(auth()->user()->role=='user'){        
        $date=DocotorDate::where('user_name',auth()->user()->name)->first();

        if( $date->day==date("l") &&  date('h') >=$date->from_hour && date('h') <= $date->to_hour  && $date->status=='محجوز'){
            
            $conversations = auth()->user()->conversations()->where('status',1)->orderBy('last_message_at', 'desc')->get();
       
            if(empty($conversations->first())){
    
            \Alert::error('الرسائل', 'لا يوجد رسائل قريبا ان شاء الله ');
            return redirect()->back();
    
    
            }else{
    $conversation = auth()->user()->conversations()->where('status',1)->orderBy('last_message_at', 'desc')->first();

   return view('admin.conversation.showUser',compact('conversation'));
  
            }
    
     }else{dd("fali");
        \Alert::error('الرسائل', 'عليك ان تشترك معنا للتمكن من حصول علي استشارات ');
        return redirect()->back();
     }
        


    }
if(auth()->user()->role=='docotor'){
    $conversations = auth()->user()->conversations()->where('status',1)->orderBy('last_message_at', 'desc')->get();
    return view('admin.conversation.index',compact('conversations'));
          
    
    }





        // 

    }
    public function show(Conversation $conversation,Request $request){
        $conversations = auth()->user()->conversations()->orderBy('last_message_at', 'desc')->get();

return view('admin.conversation.show',compact('conversation','conversations'));
    }
}
