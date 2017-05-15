<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(User_Profile::class);
    }

    public function bankAccount(){
        return $this->hasMany(BankAccount::class);
    }

    public function items(){
        return $this->hasMany(Product::class);
    }

    public function favorites(){
        return $this->belongsToMany(Product::class, 'favorites');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function bids(){
        return $this->belongsToMany(Product::class, 'bids', 'user_id', 'product_id')->withPivot('amount');
    }

    public function isProductFavorite($item_id){
        $answer = false;
        $favorites = Auth::user()->favorites;
        foreach ($favorites as $favorite){
            if($favorite->id == $item_id){
                $answer = true;
            }
        }
        return $answer;
    }

    public function isUsersProduct($item_id){
        $user = Auth::user();
        $product = Product::where('user_id', $user->id)->find($item_id);
        if(is_null($product)){
            return false;
        }else{
            return true;
        }
    }
}
