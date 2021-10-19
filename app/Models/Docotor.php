<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docotor extends Model
{
    use HasFactory;
    public $fillable=['discription','cv','specialty','user_id'];
    
    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
