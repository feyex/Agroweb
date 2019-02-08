<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
//use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'student';
    protected $fillable = [
        'firstname', 
        'lastname', 
        'phone', 
        'sex',
        'course',
        'school',
        'interest',
        'address',
        'state',
        'country',
        'image',
        'bio_info',
        'experience',
      
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
  
    public function students(){
      return $this->belongsTo('App\user_reg');
   }
    
}
