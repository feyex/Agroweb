<?php

namespace App\Http\Controllers;

use App\user_reg;
use App\UserInfo;
use App\sendMails;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function authentication(Request $request){
       
      $this->validate($request, [
        'email' => 'required', 
        'password' => 'required'
      ]);

      $apikey = base64_encode(str_random(30));
      $hasher = app()->make('hash');
      $user =user_reg::where('email', $request->input('email'))->first();
      
      
      if( count($user) > 0){
    
        if($hasher->check( $request->input('password'),$user->password)) {

           user_reg::where('email', $request->input('email'))->update(['api_key' => $apikey]);
              return
                response()->json([
                    'status' => 'success',
                    'email' => $user->email,
                    'api_key' => $apikey
                  ]);

        }
        else {
          return 
            response()->json([
              'status' => 'error', 
              'message' => "user password is wrong"],401);
        }
      }
      else{
        return 
          response()->json([
            'status' => 'error',
            'message' => "user not found"],401);	
      }

  }

  public function logout(Request $request, $id) {

    $user = user_reg::where('user_id', $id)->first();

    if(count($user)>0){
      user_reg::where('user_id', $id)->update(['api_key' => ""]);
        return response()->json(['status' => 'success','logout' => "true"]);
    }
    else {
      return response()->json(['status' => 'error','message' => "user not found"],401);	
    } 

  }

}
