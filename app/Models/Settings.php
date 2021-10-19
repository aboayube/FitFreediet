<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable=['name','discription',
    'logo','email','facebook','twiter',
    'linked_in','instagram','whatsapp'];
}
