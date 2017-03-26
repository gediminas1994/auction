<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_accounts';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
