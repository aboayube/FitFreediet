<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nutritionalValue extends Model
{
    use HasFactory;
    protected $fillable=['name','value','user_id'];


    public function elements()
    {
        return $this->hasMany(nutritionalValueElements::class,'nutrvalue_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
