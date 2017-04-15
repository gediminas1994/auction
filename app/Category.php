<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function items(){
        return $this->belongsToMany(Category::class, 'tags', 'category_id', 'item_id');
    }
}
