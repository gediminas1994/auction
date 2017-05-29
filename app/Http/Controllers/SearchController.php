<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function keyword(Request $request){
        $keyword = $request->input('keyword');

        $items =  Product::search($keyword)->paginate(config('auction.paginate'));

        return view('items.searched')
            ->with('items', $items)
            ->with('keyword', $keyword);

    }

    public function category(Category $category){
        if(is_null($category->parent_id)){
            //Parent category
            $subcategories = Category::where('parent_id', $category->id)->get();
            $items = [];
            foreach($subcategories as $subcategory){
                $items[] = $subcategory->products;
            }
            $items = array_flatten($items);
            $categoryTitle = $category->title;
        }else{
            //Child category
            $items = $category->products;
            $categoryTitle = $category->title;
        }

        return view('items.searched')
            ->with('items', $items)
            ->with('category_title', $categoryTitle);
    }

}
