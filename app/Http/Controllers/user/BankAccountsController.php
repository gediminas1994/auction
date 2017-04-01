<?php

namespace App\Http\Controllers\user;

use App\BankAccount;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BankAccountsController extends Controller
{
    public function index(){
        $user = Auth::user();
        $bankAccounts = BankAccount::where('user_id', $user->id)->get();
        return view('user.bankAccounts.index')->with('bankAccounts', $bankAccounts);
    }

    public function store(Request $request){
        $this->validate($request, [
            'bank_name' => 'required',
            'bank_account' => 'required'
        ]);

        //check if trying to store the same bank info
        $user = Auth::user();
        $bankAccounts = BankAccount::where('user_id', $user->id)->get();
        foreach ($bankAccounts as $bankAccount){
            if($bankAccount->bank_name == $request->input('bank_name')){
                return back()->withErrors('You already have a "' . $bankAccount->bank_name . '" bank account!');
            }
        }

        $bankAccount = new BankAccount();
        $bankAccount->user_id = Auth::user()->id;
        $bankAccount->bank_name = $request->input('bank_name');
        $bankAccount->bank_account = $request->input('bank_account');
        $bankAccount->save();

        return back();
    }

    public function edit($user, $bankRecord){
        $bankRecord = BankAccount::where('id', $bankRecord)->where('user_id', $user)->first();
        return view('user.bankAccounts.edit')->with('bankRecord', $bankRecord);
    }

    public function update($user, $bankRecord){
        $this->validate(request(), [
            'bank_account' => 'required'
        ]);

        $bankRecord = BankAccount::where('id', $bankRecord)->where('user_id', $user)->first();
        $bankRecord->bank_account = request()->input('bank_account');
        $bankRecord->save();

        Session::flash('message', 'Successfully updated!');
        $bankAccounts = BankAccount::where('user_id', $user)->get();
        return view('user.bankAccounts.index')->with('bankAccounts', $bankAccounts);
    }

    public function destroy($user, $bankRecord){
        $bankRecord = BankAccount::where('id', $bankRecord)->where('user_id', $user)->first();
        $bankRecord->delete();

        $bankAccounts = BankAccount::where('user_id', $user)->get();
        return view('user.bankAccounts.index')->with('bankAccounts', $bankAccounts);
    }
}
