<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $items = Item::where('blocked', 0)->paginate(9);
        return view('welcome')->with('items', $items);
    }
}
