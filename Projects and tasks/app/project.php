<?php

namespace App;
//use App\Mail\ProjectCreated;
use App\Events\ProjectCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    /*
    ** that define the accpted parameters
    protected $fillable=[
        'title','description'
    ];

    */
   
    
    
    protected $guarded=[];


    protected static function boot(){
        parent::boot();

        static::created(function ($project){
 
            
        });
    }

    public function owner(){
        return $this->belongsTo(User::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    public function addTask($task){
        //this will bind the project id automatically
        $this->tasks()->create($task);

        
        
    }
}
