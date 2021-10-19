<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory;


    protected $fillable=[
'user_id','services_id','status_pay','end_at','consulted'
    ];
    public function service(){
        return $this->belongsTo(Service::class,'services_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
