<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function show($id){
    	$user = User::findOrFail($id);
    	return view('user.show')->with('user', $user);
    }
}
