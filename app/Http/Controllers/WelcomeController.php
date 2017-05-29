<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){

        $items = Product::where('blocked', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('welcome')->with('items', $items);
    }

    public function information(){
        return view('partials.information');
    }
}
