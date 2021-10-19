<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\WasfasController;
use App\Http\Controllers\Admin\DocotorsController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\DocotorDateController;
use App\Http\Controllers\Admin\NutrationValueController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ConversationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\DocotorController;
use App\Http\Controllers\ArticalController;
use App\Mail\SubscribeDocotorDateMail;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

////////////////////////////

Route::get('/test',function(){
Mail::to('email@email.com')->send( new SubscribeDocotorDateMail());

});
//**صفحات التي تظهر للمستخدم */
Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/login_site', [HomeController::class,'index'])->name('login_site');




// حجز موعد عند طبيب
Route::get('/docotors',[DocotorController::class,'index'])->name('frontend.docotors');
Route::get('/docotors/{id}',[DocotorController::class,'showCalender'])->name('frontend.docotors.calender');
Route::post('/docotorDate/{id}/{day}',[DocotorController::class,'subscribeUser'])->middleware('auth')->name('frontend.docotors.subscribe');


/*مقالات والوصفات العامة*/
Route::get('/category/{name}',[ArticalController::class,'category'])->name('frontend.category');
Route::get('/wasfa',[ArticalController::class,'wasfas'])->name('frontend.wasfas');
Route::get('/wasfa/{title}',[ArticalController::class,'wasfa'])->name('frontend.wasfa');
//مقالات
Route::get('/posts',[ArticalController::class,'posts'])->name('frontend.posts');
Route::get('/posts/{title}',[ArticalController::class,'post'])->name('frontend.post');
Route::post('/posts',[ArticalController::class,'postcomment'])->name('frontend.postcomment');

//قيمة الغذائية
Route::get('/nutrvalue',[HomeController::class,'nutrvalue'])->name('frontend.nutrvalue');
Route::post('/nutrvalue',[HomeController::class,'getNutrvalue'])->name('frontend.nutrvalue.get');


//اشتراك
Route::get('/subscribes/{name}',[SubscribeController::class,'index'])->middleware('auth')->name('frontend.subscribes');
//ربط بpaypal
Route::get('paypal/return',[SubscribeController::class,'returnPaypal'])->name('paypal.return');
Route::get('paypal/cancel',[SubscribeController::class,'cancelPaypal'])->name('paypal.cancel');
//سياسة الخصوصية
Route::view('police','police')->name('frontend.police');
//تواصل معنا
Route::get('contactus',[ContactusController::class,'create'])->name('contact-us');
Route::post('contactus',[ContactusController::class,'store'])->name('contact-us.store');

Auth::routes(['verify'=>true]);

//مستخدم مسجل دخول
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'auth','verified'],

    ], function(){
   
//صفحة 
Route::get('/cloulors',[HomeController::class,'cloulors'])->name("user.cloultor");

Route::post('/cloulors',[HomeController::class,'calccloulors'])->name("user.calccloulors");

Route::get('/profile',[HomeController::class,'profile'])->name("user.profile");
Route::post('/profile',[HomeController::class,'editprofile'])->name("user.profile.edit");

//محادثة مع طبيب
Route::group([
    'prefix'=>'/user/conversations',
    'as'=>'user.conversations.'],  function(){
Route::get('/', [ConversationController::class,'index'])->name('index');
Route::get('/{conversation}', [ConversationController::class,'show'])->name('show');
Route::post('/store', [ConversationController::class,'store'])->name('store');
Route::get('/edit/{id}',[ConversationController::class,'edit'])->name('edit');
Route::post('/update', [ConversationController::class,'update'])->name('update');
Route::post('/delete', [ConversationController::class,'delete'])->name('delete');
});
    });


Route::get('notifications',[ App\Http\Controllers\NotificationsController::class,'index']);
Route::get('notifications/{id}',[ App\Http\Controllers\NotificationsController::class,'read'])->name('notification.read');

