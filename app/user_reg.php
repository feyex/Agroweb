<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_reg extends Model
{
//use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'user';
    protected $fillable = [
        'username', 
        'email', 
        'password', 
        'api_token',
       
      
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
  
    // public function products(){
    //     return $this->belongsTo('App\Product');
    //  }
    
}
