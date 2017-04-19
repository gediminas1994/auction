<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'type',
        'description',
        'expirationDate',
        'quantity',
        'startingBid',
        'mailingService_id',
        'picture'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }


    public function categories(){
        return $this->belongsToMany(Category::class);
    }




    public function createItem($user_id, $title, $type, $description, $expirationDate, $quantity, $startingBid, $mailingServiceId, $picturePath, $submittedCategories){
        $item = Product::fill([
            'user_id' => $user_id,
            'title' => $title,
            'type' => $type,
            'description' => $description,
            'expirationDate' => $expirationDate,
            'quantity' => $quantity,
            'startingBid' => $startingBid,
            'mailingService_id' => $mailingServiceId,
            'picture' => $picturePath
        ]);

        $item->save();

        foreach ($submittedCategories as $submittedCategory){
            $category_id = intval($submittedCategory);
            $item->categories()->attach($category_id);
        }
    }
}
