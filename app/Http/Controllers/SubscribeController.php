<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use App\Models\Service;
use App\Models\User;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Illuminate\Support\Facades\Auth;
use  App\Notifications\SubscribeUserNotification;
use DB;
class SubscribeController extends Controller
{
    public function index($name){


        $subscripe=Subscribe::where('user_id',\Auth::id())->first();
        $service=Service::whereName($name)->first();

        DB::beginTransaction();

        $total=$service->price;
        try{
// هل مشترك مسبقا 
        if($subscripe){
            echo 'تم تجديد اشتراكك';
            $end_at=$this->subscribeEnd($service->day,$subscripe->end_at);

            $subscripe->update(['end_at'=>$end_at]);
        }
        //غير مشترك مسبقا
        else{
            $end_at=$this->subscribeEnd($service->day);
           
            $subscripe=Subscribe::create([
        'user_id'=>Auth::id(),
        'services_id'=>$service->id,
        'status_pay'=>'pending',
        'consulted'=>$service->consulted,
        'end_at'=>$end_at,
    ]);
        }
        $user=User::where('role','admin')->first();
        if($user){
        $user->notify(new SubscribeUserNotification($subscripe));
        }  
    DB::commit();
if($total){
return  $this->paypal($subscripe,$total);
}else{
    $subscripe->update(['status_pay'=>'completed']);
 
    alert()->success('اشتراك بنجاح','تم اشتراك بنجاح في اشتراك مجاني');

    return redirect()->route('index');
    
}

}catch(Throwable $e){
    DB::rollback();
    throw $e;
}
    }



protected function subscribeEnd($days,$date=null){
if($date){
    $effectiveDate=$date;

}else{
        $effectiveDate=date('Y-m-d');
    }
        $effectiveDate = strtotime("+".$days."  day ", strtotime($effectiveDate));
      return   date('Y-m-d',$effectiveDate);
    
}



public function cancelPaypal(){

}

    protected function paypal(Subscribe $subscripe,$total){
        $client=$this->paypalClient();

        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');

        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" =>$subscripe->id,
                "amount" => [
                    "value" => $total,
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                 "cancel_url" =>url(route('paypal.cancel')),
                 "return_url" => url(route('paypal.return'))
            ]
        ];
        try {
            $response = $client->execute($request);

            if($response->statusCode==201){
                session()->put('paypal_subscripe_id',$response->result->id);
                session()->put('subscripe_id',$subscripe->id);
                foreach($response->result->links  as $link){
                    if($link->rel =='approve'){
                        return  redirect()->away($link->href);
                    }
                }
            }
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            print_r($response);
        }catch (Throwable $ex) {
            print_r($ex->getMessage());
        }

        return 'Uknown Error! '.$response->statusCode;
            }
            protected function paypalClient(){
                $config=config('services.paypal');
                $env=new SandboxEnvironment($config['client_id'],$config['client_secret']);
                $client=new PayPalHttpClient($env);

                return $client;
            }



    public function returnPaypal(){

        $paypal_subscripe_id=session()->get('paypal_subscripe_id');
        $request = new OrdersCaptureRequest($paypal_subscripe_id);
        $request->prefer('return=representation');
        try {

            // Call API with your client and get a response for your call
            $response = $this->paypalClient()->execute($request);
if($response->statusCode==201){
    if(strtoupper($response->result->status)=='COMPLETED'){
 $id=session()->get('subscripe_id');
        $order=Subscribe::findOrFail($id);

        $order->status_pay='completed';
        $order->save();

        session()->forget(['subscripe_id','paypal_subscripe_id']);
return route('index');

    }
}
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            print_r($response);
        }catch (Throwable $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }
}
