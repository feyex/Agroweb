<?php

namespace App\Http\Controllers;
use App\user_reg;
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

    public function index()
    {
        $student_data = student::all();

        return $student_data;
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
                'country' => 'required'
                // 'image' => 'required'

            ]
                
            );
        
        $users = $request->input('user_id');   
        $user_id = user_reg::where('user_id',$users)->value('user_id');

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

        if ($request->hasFile('image')) {
                
            $image = $request->file('image');
            $filename =  time() . '.' . $image->getClientOriginalExtension();
            $destinationPath =  storage_path('/storage/app');
            $request->file('image')->move($destinationPath, $filename);
            $user->image = $filename;
        }
      
        $user->bio_info = $request->bio_info;
        $user->experience = $request->experience;
        $user->user_id = $user_id;

        
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

    public function show($id)
    {
        $student_data = student::findOrFail($id);
        return $student_data;
    }

    public function update(Request $request, $id)
    {
        # code...
  
        $std = student::findOrFail($id);
  
        if ($std->fill($request->all())->save()) {
              # code...
              return response()->json(['success' => true]);
        }
  
        return response()->json(['status' => 'failed']);
    }
  

    public function destroy($id)
    {
      # code...
      $student_data = student::findOrFail($id);
      $student_data->delete();

      return response()->json(['success' => true]);
    }
}
