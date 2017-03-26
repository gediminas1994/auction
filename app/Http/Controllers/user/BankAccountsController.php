<?php

namespace App\Http\Controllers\user;

use App\BankAccount;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BankAccountsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $bankAccounts = BankAccount::where('user_id', $user->id)->get();
        return view('user.bankAccounts.index')->with('bankAccounts', $bankAccounts);
    }
}
