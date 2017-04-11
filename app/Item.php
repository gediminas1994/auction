<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'description',
        'expirationDate',
        'quantity',
        'startingBid',
        'picture'
    ];

    public function createItem($user_id, $title, $type, $description, $expirationDate, $quantity, $startingBid, $picturePath){
        $item = Item::fill([
            'user_id' => $user_id,
            'title' => $title,
            'type' => $type,
            'description' => $description,
            'expirationDate' => $expirationDate,
            'quantity' => $quantity,
            'startingBid' => $startingBid,
            'picture' => $picturePath
        ]);
        $item->save();
    }
}
