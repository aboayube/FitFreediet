<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable=['user_id',
    'docotor_id',
    'subscribedoctordate_id',
   'body',
   'attachment',
];
public function isOwn()
{
    return $this->user_id === auth()->id();
}


public function conversation()
{
    return $this->belongsTo(Conversation::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}
}
