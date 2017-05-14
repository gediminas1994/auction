<?php

namespace App\Http\Controllers\user;

use App\User;
use App\User_Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function show($user){
        $user = User::findOrFail($user);
        return view('user.show')->with('user', $user);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('user.edit')->with('user', $user);
    }

    public function update(Request $request, $id){
        if(User_Profile::where('user_id', $id)->first()){
            $profile = User_Profile::where('user_id', $id)->first();
        }else{
            $profile = new User_Profile();
        }
        $name = $request->input('name');
        $lastName = $request->input('last_name');
        $phoneNumber = $request->input('phone_number');
        $gender = $request->input('gender');
        $DOB = $request->input('birth_date');

        $profile->user_id = $id;
        $profile->name = $name;
        $profile->last_name = $lastName;
        $profile->phone_number = $phoneNumber;
        $profile->gender = $gender;
        $profile->birth_date = $DOB;
        $saved = $profile->save();

        if($saved){
            Session::flash('message', 'Successfully updated!');
        }

        return back();

    }
}
