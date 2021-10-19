<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocotorDate extends Model
{
    use HasFactory;
protected $fillable=['day',
'from_hour',
'to_hour',
'user_id',
'status',
'user_name',
'created_at',
'updated_at',

];
public $timestamps = true;

public function docotor(){
    return $this->belongsTo(User::class,'user_id','id');
}
}
