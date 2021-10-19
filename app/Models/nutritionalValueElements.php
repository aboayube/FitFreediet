<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nutritionalValueElements extends Model
{
    use HasFactory;
    protected $fillable=['element','element_value','nutrvalue_id'];

    public function nutrvalue()
    {
        return $this->belongsTo(nutritionalValue::class);
    }
}
