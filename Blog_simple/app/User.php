<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        # code...
        return $this->belongsToMany('App\Role','user_role','user_id','role_id');
    }

    public function hasAnyRole($roles)
    {
        if(is_array($roles)){
            //editor-user
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        }else{
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        
    }

    public function hasRole($role)
    {
        
        if ($this->roles()->where('name',$role)->first()) {
            return true;
        }
        else{
            return false;
        }
        
    }

    public function likes()
      {
        return $this->hasMany(Like::class);
      }

      public function comments()
      {
        return $this->hasMany(Comment::class);
      }

      public function posts()
      {
        return $this->hasMany(Post::class);
      }
}
