<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function index(){
        $users = User::where('user_type', 1)->get();
        return view('admin.users.index')->with('users', $users);
    }

    public function show($id){
    	$user = User::findOrFail($id);
    	return view('admin.users.show')->with('user', $user);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit')->with('user', $user);
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();

        $users = User::where('user_type', 1)->get();
        return view('admin.users.index')->with('users', $users);
    }

    public function block_unblock($id){
        $user = User::findOrFail($id);
        if($user->blocked){
            $user->blocked = 0;
        }else{
            $user->blocked = 1;
        }
        $user->save();

        $success = true;

        return response($success);
    }
}
