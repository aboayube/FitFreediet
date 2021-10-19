<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Artical extends Model
{
    use HasFactory,Notifiable;
  protected $fillable=['title','content',
  'discription','status','image','type',
  'user_id','category_id'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'articals_tags');
    }
}
