<?php

namespace App\Http\Controllers\user;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function show($user){
        $user = User::findOrFail($user);
        return view('user.show')->with('user', $user);
    }
}
