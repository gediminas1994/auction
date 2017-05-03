<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

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

    public function users(){
        return $this->belongsToMany(User::class, 'bids')->withPivot('amount');
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

    //Algolia function 1
    public function searchableAs()
    {
        return 'title';
    }

    //Algolia function 2
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
}
