<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
<<<<<<< HEAD
<<<<<<< HEAD
    public function user(){
        return $this->belongsTo(User::class);
=======
=======
>>>>>>> 5b178bbb2e212e90c6fca23020b0dfbab5d5f53f
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
<<<<<<< HEAD
>>>>>>> 5b178bbb2e212e90c6fca23020b0dfbab5d5f53f
=======
>>>>>>> 5b178bbb2e212e90c6fca23020b0dfbab5d5f53f
    }
}
