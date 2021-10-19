<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'image' ,
        'status',
         'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
        'role' => 'user',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function profile(){
        return $this->hasOne(Profile::class,'user_id','id');
    }
    public function docotor(){
        return $this->hasOne(Docotor::class,'user_id','id');
    }
    public function category(){
        return $this->hasMany(Category::class,'user_id','id');
    }
    public function tags(){
        return $this->hasMany(Tag::class,'user_id','id');
    }
    public function artical(){
        return $this->hasMany(Artical::class,'user_id','id');
    }
    public function nutritionalValue(){
        return $this->hasMany(nutritionalValue::class,'user_id','id');
    }


    public function dataDocotor(){
        return $this->hasMany(DocotorDate::class,'user_id','id');
    }


    public function conversations()
    {
        return $this->belongsToMany(Conversation::class)->withPivot('read_at');
    }

    public function inConversation($id)
    {
        //contains هل يحتوي علي هذا ID
        return $this->conversations->contains('id', $id);
    }

    public function hasRead(Conversation $conversation)
    {
        return $this->conversations->find($conversation->id)->pivot->read_at;
    }
}
