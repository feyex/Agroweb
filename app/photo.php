<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class photo extends Model
{
//use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'photo';
    protected $fillable = [
        'photo_title', 
        'image', 
      
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

    // public function students(){
    //     return $this->hasOne('App\student');
    //  }
    
}
