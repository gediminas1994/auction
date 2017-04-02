<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class ItemsController extends Controller
{
    public function create(){
        $categories = Category::where('parent', 0)->get();
        $subcategories = Category::where('parent', '!=', 0)->get();
    	return view('items.create')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories);
    }

    public function show(Item $item){
    	return view('items.show')->with('item', $item);
    }
}
