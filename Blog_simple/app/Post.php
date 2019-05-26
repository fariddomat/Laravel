<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\Category;
use App\User;
class Post extends Model
{
    //
    protected $fillable=[
      'title','body'  , 'user_id'
    ];

    public function comments()
    {
      return $this->hasMany(Comment::class)->orderBy('created_at');
    }

    public function category()
    {
      return $this->belongsTo(Category::class);
    }
    public function likes()
    {
      return $this->hasMany(Like::class);
        }
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
