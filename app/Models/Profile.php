<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable=['mobile','activity',
    'gender','length','age','weight',
    'bmi','aims','diseasesName','bmivalue',
    'calories','target','notes','medicine',
    'user_id'];


    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
