<?php

namespace App\Http\Controllers;
use App\user_reg;
use illuminate\Http\Request;

class UserCtrl extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request) 
    {
        $response = 
        $this->validate(
            $request, [
                'username' => 'required',
                'email' => 'required|email|unique:user',
                'password' => 'required'
            ]
            );

            
        
        $hasher = app()->make('hash');
        $user = new user_reg();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password =$hasher->make($request->password) ;
        // $user->api_key = $request->api_key;
        $user->save();

        if ($user->save () )
        {
            $response = response ()->json(
                [
                    'response' => [
                        'created' =>true,
                        'user_id' =>$user->id
                    ]
                    ],201
            );
        }
        return $response;
    }
}
