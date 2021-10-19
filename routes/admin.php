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
//لوحة التحكم
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect','verified','admin', 'localizationRedirect', 'localeViewPath'],

    ], function(){
        Route::get('/admin',function(){return view('admin.index');})->middleware('auth')->name('admin');

Route::group(['as'=>'admin.'],function(){

        //dashborad
Route::group([
    'prefix'=>'/admin/categories',
    'as'=>'categories.'],  function(){
Route::get('/', [CategoryController::class,'index'])->name('index');
Route::post('/store', [CategoryController::class,'store'])->name('store');
Route::get('edit/{id}',[CategoryController::class,'edit'])->name('edit');
Route::post('/update', [CategoryController::class,'update'])->name('update');
Route::post('/delete', [CategoryController::class,'delete'])->name('delete');
});
//tags
Route::group([
    'prefix'=>'/admin/tags',
    'as'=>'tags.'],  function(){
Route::get('/', [TagController::class,'index'])->name('index');
Route::post('/store', [TagController::class,'store'])->name('store');
Route::get('edit/{id}',[TagController::class,'edit'])->name('edit');
Route::post('/update', [TagController::class,'update'])->name('update');
Route::post('/delete', [TagController::class,'delete'])->name('delete');
});
//posts
Route::group([
    'prefix'=>'/admin/posts',
    'as'=>'posts.'],  function(){
Route::get('/', [PostsController::class,'index'])->name('index');
Route::post('/store', [PostsController::class,'store'])->name('store');
Route::get('/edit/{id}',[PostsController::class,'edit'])->name('edit');
Route::post('/update', [PostsController::class,'update'])->name('update');
Route::post('/delete', [PostsController::class,'delete'])->name('delete');
});
//wasfa
Route::group([
    'prefix'=>'/admin/wasfa',
    'as'=>'wasfa.'],  function(){
Route::get('/', [WasfasController::class,'index'])->name('index');
Route::post('/store', [WasfasController::class,'store'])->name('store');
Route::get('/edit/{id}',[WasfasController::class,'edit'])->name('edit');
Route::post('/update', [WasfasController::class,'update'])->name('update');
Route::post('/delete', [WasfasController::class,'delete'])->name('delete');
});

//حاسبة القيمة الغذائية
Route::group([
    'prefix'=>'/admin/nutrs',
    'as'=>'nutrs.'],  function(){
Route::get('/', [NutrationValueController::class,'index'])->name('index');
Route::post('/store', [NutrationValueController::class,'store'])->name('store');
Route::get('/edit/{id}',[NutrationValueController::class,'edit'])->name('edit');
Route::post('/update', [NutrationValueController::class,'update'])->name('update');
Route::post('/delete', [NutrationValueController::class,'delete'])->name('delete');
});
//Docotors
Route::group([
    'prefix'=>'/admin/docotors',
    'as'=>'docotor.'],  function(){
Route::get('/', [DocotorsController::class,'index'])->name('index');
Route::post('/store', [DocotorsController::class,'store'])->name('store');
Route::get('/edit/{id}',[DocotorsController::class,'edit'])->name('edit');
Route::post('/update', [DocotorsController::class,'update'])->name('update');
Route::post('/delete', [DocotorsController::class,'delete'])->name('delete');
});

//اشتركات وحجوزات المستخدمين
Route::group(['prefix'=>'/admin/users','as'=>'userSubscirbe.'],function(){
Route::get('/subscirbe',[UserController::class,'subscirbeUser'])->name('index');
Route::get('/docotorSubscirbe',[UserController::class,'docotorSubscirbe'])->name('docotorSubscirbe');
});
//مواعيد الاطباء
Route::group([
    'prefix'=>'/admin/dataDocotors',
    'as'=>'dataDocotors.'],  function(){
Route::get('/', [DocotorDateController::class,'index'])->name('index');
Route::post('/store', [DocotorDateController::class,'store'])->name('store');
Route::get('/edit/{id}',[DocotorDateController::class,'edit'])->name('edit');
Route::post('/update', [DocotorDateController::class,'update'])->name('update');
Route::post('/delete', [DocotorDateController::class,'delete'])->name('delete');

});
//بيانات الشخصية
Route::group([
    'prefix'=>'/admin/',
],function(){
    
Route::get('/profile',[UserController::class,'profile'])->name('profile');
Route::post('/profile',[UserController::class,'editprofile'])->name('profile.edit');
Route::post('/specialty',[UserController::class,'editspecialty'])->name('specialty.edit');

});

//مدير لي شوف بس 
Route::group(['middleware'=>'isAdmin'],function(){
//users
Route::group([
    'prefix'=>'/admin/users',
    'as'=>'users.'],  function(){
Route::get('/', [UserController::class,'index'])->name('index');
Route::get('/edit/{id}',[UserController::class,'edit'])->name('edit');
Route::post('/delete', [UserController::class,'delete'])->name('delete');
});


//خدمات
Route::group([
    'prefix'=>'/admin/services',
    'as'=>'services.'],  function(){
Route::get('/', [ServicesController::class,'index'])->name('index');
Route::post('/store', [ServicesController::class,'store'])->name('store');
Route::get('/edit/{id}',[ServicesController::class,'edit'])->name('edit');
Route::post('/update', [ServicesController::class,'update'])->name('update');
Route::post('/delete', [ServicesController::class,'delete'])->name('delete');
});

//طلبات التواصل
Route::group([
    'prefix'=>'/admin/contactus',
    'as'=>'contactus.'],  function(){
Route::get('/', [ContactusController::class,'index'])->name('index');
Route::get('/show/{id}',[ContactusController::class,'show'])->name('show');
Route::post('/delete', [ContactusController::class,'delete'])->name('delete');
});
//اعدادات الموقع
Route::group([
    'prefix'=>'/admin/settings',
    'as'=>'settings.'],  function(){
Route::get('/', [SettingsController::class,'index'])->name('index');
Route::post('/',[SettingsController::class,'update'])->name('update');
});

});

});

});

