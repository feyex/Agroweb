<?php

namespace App\Http\Controllers;
use App\photo;
use illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// use Request;

class photoCtrl extends Controller
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

    public function image (Request $request) 
    {
        $response = 
        $this->validate(
            $request, [
                'image' => 'required'
               
            ]
            );
        
        $user = new photo();
        $user->photo_title = $request->photo_title;
        // $user->image = $request->image;

        if ($request->hasFile('image')) {
                
            $image = $request->file('image');
            $filename =  time() . '.' . $image->getClientOriginalExtension();
            $destinationPath =  storage_path('/storage/app');
            // $imagePath = $destinationPath. "/".  $name;
            $request->file('image')->move($destinationPath, $filename);
            // $image->move($destinationPath, $name);
            $user->image = $filename;
        }
    
        // $user = photo::file('image');
        // Storage::put($user->getClientOriginalName(), File::get($user));

        // $user->password =$hasher->make($request->password) ;
        // $user->api_key = $request->api_key;
        $user->save();

        if ($user->save () )
        {
            $response = response ()->json(
                [
                    'response' => [
                        'created' =>true,
                        'id' =>$user->id
                    ]
                    ],201
            );
        }
        return $response;
    }
}
