<?php

namespace App\Http\Livewire;

use App\Helpers\BMI;
use App\Models\Profile;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\UserRegisterNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Register extends Component
{
    public $successMessage = '';
    public $catchError;
    public $currentStep =1;
    //بيانات عادية
    public $name;
    public $email;
    public $password;
    public $confirmpassword;
    public $mobile;
    //بيانات مريض
    public $gender, $length, $weight, $age, $activity, $aims, $diseasesName = '';
    public $bmi = 0;
    public $calories;
    //معلومات اضافية
    public $notes, $medicine;
    // معاملات المعادلات
    public $bmivalue;
    public $agreePolice;
    public function render()
    {
        return view('livewire.register');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required|unique:users,name',
            'password' => 'required|min:6',
            'confirmpassword' => 'required|same:password|min:6',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|max:10',
            'agreePolice' => "required",
            'gender' => 'required',
            'length' => 'required',
            'weight' => 'required',
            'age' => 'required',
            'activity' => 'required',
            'aims' => 'required',
            'diseasesName' => 'nullable',
            'notes' => 'nullable',
            'agreePolice' => 'required',
        ]);
    }
    //firstStepSubmit
    public function firstStepSubmit()
    {

        $this->validate([
            'name' => 'required|unique:users,name',
            'password' => 'required',
            'confirmpassword' => 'required|same:password|min:6',
            'email' => 'required|unique:users,email',
            'mobile' => 'required|unique:users,mobile',
        ],[
            'name.required'=>'يجب ان تدخل اسم',
            'name.unique'=>'يجيب ان تدخل اسم اخر',
            'password.required'=>'يجب ان تدخل كلمة السر',
            'confirmpassword.required'=>'يجب ان تدخل  تاكيد كلمة السر',
            'password.min'=>'كلمةالسر قصيرة',
            'password.same'=>'يجب ان تكون متشابهه كلمة السر',
            'email.required'=>'يجب ان تدخل ايميل',
            'email.unique'=>'يجب ان تدخل ايميل  صحيح',
            'mobile.required'=>'يجب ان تدخل رقم الجوال',
            'mobile.unique'=>'رقم الجوال موجود',
        ]);
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'gender' => 'required',
            'length' => 'required',
            'weight' => 'required',
            'age' => 'required',
            'activity' => 'required',
            'aims' => 'required',
            'diseasesName' => 'nullable',
            'notes' => 'nullable',
            'agreePolice' => 'required',
        ]);
        DB::beginTransaction();
        try{
            $b=new BMI($this->length,$this->weight,$this->age,$this->gender,$this->activity);
       $a=$b->calculatorBmi();
            
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => 'user',
            'status' => '1',
            'image'=>'users/profile.png',
            'mobile' => $this->mobile,
        ]);
        $profile =  $user->profile()->create([
            'activity' => $this->activity,
            'gender' => $this->gender,
            'length' => $this->length,
            'age' => $this->age,
            'weight' => $this->weight,
            'bmi' => $a['bmi'],
            'bmivalue' => $a['bmivalue'],
            'aims' => $this->aims,
            'diseasesName' => $this->diseasesName,
            'calories' => $a['calories'],
            'notes' => $this->notes,
            'medicine' => $this->medicine,
            'user_id'=>$user['id'],
        ]);
        DB::commit();
        $admin = User::where("role", 'admin')->first();

        if ($admin) {
            $admin->notify(new UserRegisterNotification($user));
        }

          alert()->success('تم تسجيلك بنجاح');

          
        $p=Auth::loginUsingId($user->id);

        return redirect()->route('index');
        }catch(Throwable $e){
            DB::rollback();
            throw $e;
        }
    }
    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }


}
