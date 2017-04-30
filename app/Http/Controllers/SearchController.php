<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function keyword(Request $request){
        $keyword = $request->input('keyword');

        $items = Product::where('title', 'LIKE', '%'.$keyword.'%')
            ->orWhere('description', 'LIKE', '%'.$keyword.'%')
            ->paginate(6);

        return view('items.searched')
            ->with('items', $items)
            ->with('keyword', $keyword);

    }

    public function category($category_id){
        dd($category_id);
    }

    public function subcategory($subcategory_id){
        dd($subcategory_id);
    }
}
