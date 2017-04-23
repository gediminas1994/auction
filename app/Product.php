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
        'price',
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

    public function createAuction($user_id, $title, $type, $description, $expirationDate,$startingBid, $mailingServiceId, $picturePath, $submittedCategories){
        $item = Product::fill([
            'user_id' => $user_id,
            'title' => $title,
            'type' => $type,
            'description' => $description,
            'expirationDate' => $expirationDate,
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

    public function createRegularItem($user_id, $title, $type, $description, $quantity, $price, $mailingServiceId, $picturePath, $submittedCategories){
        $item = Product::fill([
            'user_id' => $user_id,
            'title' => $title,
            'type' => $type,
            'description' => $description,
            'quantity' => $quantity,
            'price' => $price,
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
