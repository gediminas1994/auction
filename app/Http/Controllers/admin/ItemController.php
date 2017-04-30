<?php

namespace App\Http\Controllers\admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index(){
        $items = Product::all();
        return view('admin.items.index')->with('items', $items);
    }
}
