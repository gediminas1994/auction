<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_accounts';

    protected $fillable = [
        'bank_name',
        'bank_account'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
