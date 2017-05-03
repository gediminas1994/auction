<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function keyword(Request $request){
        $keyword = $request->input('keyword');

        $items =  Product::search($request->input('keyword'))->paginate(config('auction.paginate'));

        return view('items.searched')
            ->with('items', $items)
            ->with('keyword', $keyword);

    }

    public function category(Category $category){
        $items = $category->products;
        $keyword = $category->title;

        return view('items.searched')
            ->with('items', $items)
            ->with('keyword', $keyword);
    }

}
