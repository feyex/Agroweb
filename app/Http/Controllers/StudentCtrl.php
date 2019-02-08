<?php

namespace App\Http\Controllers;
use App\student;
use illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// use Request;


class StudentCtrl extends Controller
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

    public function reg_student (Request $request) 
    {
        $response = 
        $this->validate(
            $request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'phone' => 'required',
                'sex' => 'required',
                'course' => 'required',
                'school' => 'required',
                'interest' => 'required',
                'address' => 'required',
                'state' => 'required',
                'country' => 'required',
                'image' => 'required'

            ]
                
            );

    
            // if($request->hasFile('image')) { 

            //     $this->validate($request, [
            //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            //       ]);          
    
            //     $allowedfileExtension = ['pdf','jpg','png','docx'];
            //     $image = $request->file('image');
    
            //     $extension = $image->getClientOriginalExtension();
    
            //     $check = in_array($extension,$allowedfileExtension);
    
            //     if ($check) {
            //         # code...
                    
            //         $filename = time() . '.' . $image->getClientOriginalExtension();
            //         Connected::make($image)->resize(160, 160)->save( public_path() . '\\storage\\app\\image'. $filename );
            //         $person->image = $filename;
    
                   
            //         echo "Upload Successfully";
    
                    
            //             $user = new student();
            //             $user->firstname = $request->firstname;
            //             $user->lastname = $request->lastname;
            //             $user->phone = $request->phone;
            //             $user->sex = $request->sex;
            //             $user->course = $request->course;
            //             $user->school = $request->school;
            //             $user->interest = $request->interest;
            //             $user->address = $request->address;
            //             $user->state = $request->state;
            //             $user->country = $request->country;
            //             $user->image = $request->image;
            //             $user->bio_info = $request->bio_info;
            //             $user->experience = $request->experience;
                        
            //             $user->save();
            //             if ($user->save () )
            //             {
            //                 $response = response ()->json(
            //                     [
            //                         'response' => [
            //                             'created' =>true,
            //                             'student_id' =>$user->id,
            //                             'message' => "registration successful"
            //                         ]
            //                         ],201
            //                 );
            //             }

            //     }
            //     else {
            //         return response()->json(['status' => 'error','message' => "registration not successful"],401);	
            //       } 
            // }user = new Connected();   

           
    
    
            // $profile->talent = $request->input('talent');
            // $profile->username = $request->input('username');
            // $profile->phone = $request->input('phone');
            
            // $user->connected()->save($profile);
    

      
        $user = new student();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->sex = $request->sex;
        $user->course = $request->course;
        $user->school = $request->school;
        $user->interest = $request->interest;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->country = $request->country;
        // $user = Request::file(‘image’);
        // Storage::put($user->getClientOriginalName(), File::get($user));
        if ($request->hasFile('image')) {
                
            $image = $request->file('image');
            $filename =  time() . '.' . $image->getClientOriginalExtension();
            $destinationPath =  storage_path('/storage/app');
            $request->file('image')->move($destinationPath, $filename);
            $user->image = $filename;
        }
      
        $user->bio_info = $request->bio_info;
        $user->experience = $request->experience;
        
        $user->save();

        if ($user->save () )
        {
            $response = response ()->json(
                [
                    'response' => [
                        'created' =>true,
                        'student_id' =>$user->id,
                        'message' => "registration successful"
                    ]
                    ],201
            );
        }
        else {
          return response()->json(['status' => 'error','message' => "registration not successful"],401);	
        } 
    }
}
