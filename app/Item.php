<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
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

    public static function createItem(Item $user_id, $title, $type, $description, $expirationDate, $quantity, $startingBid, $picturePath){
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
