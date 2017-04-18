<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $items = Product::where('blocked', 0)->paginate(9);
        return view('welcome')->with('items', $items);
    }
}
